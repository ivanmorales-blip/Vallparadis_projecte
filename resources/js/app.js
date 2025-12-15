import './bootstrap';
import './toggleStatus';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("sidebarSearch");
  if (!searchInput) return;

  // Todos los bloques del menú
  const menuBlocks = Array.from(document.querySelectorAll('aside [x-data]'));

  // Guardamos el HTML original de cada enlace
  menuBlocks.forEach(block => {
    const links = block.querySelectorAll('a');
    links.forEach(link => {
      link.dataset.originalHTML = link.innerHTML;
    });
  });

  // Función para restaurar todo el menú
  const showAllBlocks = () => {
    menuBlocks.forEach(block => {
      block.style.display = ""; // mostrar bloque
      const submenu = block.querySelector('[x-show]');
      if (submenu) submenu.style.display = ""; // mostrar submenú si existe
      block.querySelectorAll('a').forEach(link => {
        link.innerHTML = link.dataset.originalHTML; // restaurar texto original
      });
    });
  };

  // Función para filtrar el menú según la búsqueda
  const filterBlocks = (searchText) => {
    const query = searchText.toLowerCase();

    menuBlocks.forEach(block => {
      const button = block.querySelector('button');
      const titleSpan = button?.querySelector('span .text-sm') || button?.querySelector('span');
      const titleText = titleSpan?.textContent.toLowerCase() || "";

      const links = Array.from(block.querySelectorAll('a'));
      const linksText = links.map(link => link.textContent.toLowerCase()).join(" ");

      const shouldShow = titleText.includes(query) || linksText.includes(query);

      // Mostrar u ocultar bloque y submenú
      block.style.display = shouldShow ? "" : "none";
      const submenu = block.querySelector('[x-show]');
      if (submenu) submenu.style.display = shouldShow ? "" : "none";

      // Restaurar el texto original de los enlaces
      links.forEach(link => {
        link.innerHTML = link.dataset.originalHTML;
      });

      // Restaurar texto del título
      if (titleSpan) titleSpan.innerHTML = titleSpan.textContent;
    });
  };

  // Evento de búsqueda
  searchInput.addEventListener("input", () => {
    const query = searchInput.value.trim();
    if (query === "") {
      showAllBlocks();
    } else {
      filterBlocks(query);
    }
  });
});
