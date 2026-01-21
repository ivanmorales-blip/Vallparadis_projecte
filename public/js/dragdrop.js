let draggedItem = null;

/**
 * Marca el elemento que se está arrastrando
 */
function drag(event) {
    draggedItem = event.target;
}

/**
 * Permite que se pueda soltar un elemento en el target
 */
function allowDrop(event) {
    event.preventDefault();
}

/**
 * Soltar un elemento en una lista
 * @param {Event} event 
 * @param {string} target - 'assigned' o 'available'
 */
function drop(event, target) {
    event.preventDefault();

    if (!draggedItem) return;

    // Determinar UL destino según target
    const ul = target === 'assigned' 
        ? document.getElementById('assigned-professionals') 
        : document.getElementById('available-professionals');

    if (!ul) return;

    ul.appendChild(draggedItem);
    draggedItem = null;

    // Actualizar contadores
    updateCounters();
}

/**
 * Actualiza los contadores de disponibles y asignados dinámicamente
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
 * Guarda los profesionales asignados
 * @param {string} url - Endpoint Laravel
 * @param {string} assignedSelector - Selector UL de elementos asignados
 * @param {string|null} assignedCountSelector - Selector del contador de asignados (opcional)
 * @param {string|null} availableCountSelector - Selector del contador de disponibles (opcional)
 */
async function saveDragDrop(url, assignedSelector, assignedCountSelector = null, availableCountSelector = null) {
    const assignedIds = Array.from(document.querySelectorAll(`${assignedSelector} li`))
        .map(li => li.dataset.id);

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ professionals: assignedIds }),
        });

        if (!response.ok) throw new Error('Error al guardar los cambios');

        // Actualizar contadores si se pasaron
        if (assignedCountSelector) {
            const assignedSpan = document.querySelector(assignedCountSelector);
            if (assignedSpan) assignedSpan.textContent = assignedIds.length;
        }

        if (availableCountSelector) {
            const availableSpan = document.querySelector(availableCountSelector);
            if (availableSpan) {
                const total = document.querySelectorAll(`${assignedSelector} li`).length +
                              document.querySelectorAll('#available-professionals li').length;
                availableSpan.textContent = total - assignedIds.length;
            }
        }

        showToast('Profesionales actualizados correctamente!');

        // Volver atrás tras 1s
        setTimeout(() => {
            if (document.referrer) window.location.href = document.referrer;
            else window.history.back();
        }, 1000);

    } catch (error) {
        console.error(error);
        showToast('Error al guardar los cambios', true);
    }
}

/**
 * Muestra un toast de notificación
 * @param {string} message 
 * @param {boolean} isError 
 */
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
    setTimeout(() => toast.classList.add('opacity-0'), 2000);
}

// Inicializar contadores al cargar la página
document.addEventListener('DOMContentLoaded', updateCounters);
