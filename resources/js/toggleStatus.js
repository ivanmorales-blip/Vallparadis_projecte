document.addEventListener('DOMContentLoaded', () => {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    document.querySelectorAll('.activar-desactivar').forEach(button => {
        button.addEventListener('click', async function (event) {
            event.stopPropagation();
            const row = this.closest('tr');
            const id = row.dataset.id;
            const estadoCell = row.querySelector('.estado');
            const text = estadoCell.textContent.trim();

            const isActive = text === 'Actiu' || text === 'Activo';
            const basePath = window.location.pathname.split('/')[1];
            const url = isActive
                ? `/${basePath}/${id}`
                : `/${basePath}/${id}/active`;
            const method = isActive ? 'DELETE' : 'PATCH';

            try {
                const response = await fetch(url, {
                    method,
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                });

                if (response.ok) {
                    const svg = this.querySelector('svg');
                    const useEl = svg.querySelector('use');

                    if (isActive) {
                        estadoCell.textContent = text === 'Actiu' ? 'Inactiu' : 'Inactivo';
                        estadoCell.classList.remove('bg-green-200', 'text-green-800');
                        estadoCell.classList.add('bg-red-200', 'text-red-800');

                        svg.classList.remove('text-red-400', 'hover:text-red-500');
                        svg.classList.add('text-green-400', 'hover:text-green-500');
                        useEl.setAttribute('href', '/icons/sprite.svg#icon-check');
                        useEl.setAttribute('xlink:href', '/icons/sprite.svg#icon-check');
                        this.title = text === 'Actiu' ? 'Activar' : 'Activar';
                    } else {
                        estadoCell.textContent = text === 'Inactiu' ? 'Actiu' : 'Activo';
                        estadoCell.classList.remove('bg-red-200', 'text-red-800');
                        estadoCell.classList.add('bg-green-200', 'text-green-800');

                        svg.classList.remove('text-green-400', 'hover:text-green-500');
                        svg.classList.add('text-red-400', 'hover:text-red-500');
                        useEl.setAttribute('href', '/icons/sprite.svg#icon-x');
                        useEl.setAttribute('xlink:href', '/icons/sprite.svg#icon-x');
                        this.title = text === 'Inactiu' ? 'Desactivar' : 'Desactivar';
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
