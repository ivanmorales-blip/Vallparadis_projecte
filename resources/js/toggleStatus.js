document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.activar-desactivar').forEach(button => {
        button.addEventListener('click', async function() {
            const row = this.closest('tr');
            const itemId = row.dataset.id;
            const estadoCell = row.querySelector('.estado');
            const text = estadoCell.textContent.trim();
            const isActive = text === 'Actiu' || text === 'Activo';
            const isCatalan = text === 'Actiu' || text === 'Inactiu';
            const url = isActive ? `${window.location.pathname}/${itemId}` : `${window.location.pathname}/${itemId}/active`;
            const method = isActive ? 'DELETE' : 'PATCH';

            try {
                const response = await fetch(url, {
                    method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const svg = this.querySelector('svg');
                    const useEl = svg.querySelector('use');
                    if (isActive) {
                        estadoCell.textContent = isCatalan ? 'Inactiu' : 'Inactivo';
                        estadoCell.classList.remove('bg-green-200', 'text-green-800');
                        estadoCell.classList.add('bg-red-200', 'text-red-800');
                        svg.classList.remove('text-red-400', 'hover:text-red-500');
                        svg.classList.add('text-green-400', 'hover:text-green-500');
                        this.title = isCatalan ? 'Activar' : 'Activar';
                        useEl.setAttribute('href', '/icons/sprite.svg#icon-check');
                        useEl.setAttribute('xlink:href', '/icons/sprite.svg#icon-check');
                    } else {
                        estadoCell.textContent = isCatalan ? 'Actiu' : 'Activo';
                        estadoCell.classList.remove('bg-red-200', 'text-red-800');
                        estadoCell.classList.add('bg-green-200', 'text-green-800');
                        svg.classList.remove('text-green-400', 'hover:text-green-500');
                        svg.classList.add('text-red-400', 'hover:text-red-500');
                        this.title = isCatalan ? 'Desactivar' : 'Desactivar';
                        useEl.setAttribute('href', '/icons/sprite.svg#icon-x');
                        useEl.setAttribute('xlink:href', '/icons/sprite.svg#icon-x');
                    }
                } else {
                    console.error('Error en la petición');
                }
            } catch (err) {
                console.error(err);
            }
        });
    });
});
