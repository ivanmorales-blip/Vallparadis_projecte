let draggedItem = null;

function drag(event) {
    draggedItem = event.target;
}

function allowDrop(event) {
    event.preventDefault();
}

function drop(event, target) {
    event.preventDefault();
    const ul = document.getElementById(
        target === 'assigned' ? 'assigned-professionals' : 'available-professionals'
    );
    ul.appendChild(draggedItem);

    // 🔥 Actualizamos contadores dinámicamente
    updateCounters();
}

/**
 * Actualiza dinámicamente los contadores de disponibles y asignados.
 */
function updateCounters() {
    const availableCount = document.querySelectorAll('#available-professionals li').length;
    const assignedCount = document.querySelectorAll('#assigned-professionals li').length;

    const availableSpan = document.getElementById('available-count');
    const assignedSpan = document.getElementById('assigned-count');

    if (availableSpan) availableSpan.textContent = availableCount;
    if (assignedSpan) assignedSpan.textContent = assignedCount;
}

/**
 * Guarda la lista de elementos asignados vía POST y vuelve a la página anterior.
 * 
 * @param {string} url - Endpoint para enviar la lista de IDs.
 * @param {string} assignedSelector - Selector del UL de asignados.
 * @param {string} assignedCountSelector - Selector del contador de asignados (opcional).
 * @param {string} availableCountSelector - Selector del contador de disponibles (opcional).
 */
async function saveDragDrop(url, assignedSelector, assignedCountSelector = null, availableCountSelector = null) {
    const assignedIds = Array.from(document.querySelectorAll(`${assignedSelector} li`))
        .map(li => li.dataset.id);

    try {
        const response = await fetch(url, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ professionals: assignedIds }),
        });

        if (!response.ok) throw new Error('Error en la actualización');

        // Actualizamos contadores si se han pasado
        if (assignedCountSelector) {
            document.querySelector(assignedCountSelector).textContent = assignedIds.length;
        }
        if (availableCountSelector) {
            const total = document.querySelectorAll(`${assignedSelector} li`).length +
                          document.querySelectorAll('#available-professionals li').length;
            document.querySelector(availableCountSelector).textContent = total - assignedIds.length;
        }

        // Toast de éxito
        showToast('Professionals actualitzats correctament!');

        // Volver a la página anterior tras 800ms
        setTimeout(() => {
            if (document.referrer) {
                window.location.href = document.referrer;
            } else {
                window.history.back();
            }
        }, 1000);

    } catch (error) {
        showToast('Error al guardar els canvis.', true);
        console.error(error);
    }
}

function showToast(message, isError = false) {
    let toast = document.getElementById('toast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toast';
        document.body.appendChild(toast);
    }
    toast.textContent = message;
    toast.className = `fixed bottom-6 right-6 px-6 py-3 rounded-xl shadow-lg transition-opacity duration-300 
                       ${isError ? 'bg-red-500 text-white' : 'bg-green-500 text-white'} opacity-100`;
    setTimeout(() => {
        toast.classList.add('opacity-0');
    }, 2000);
}
