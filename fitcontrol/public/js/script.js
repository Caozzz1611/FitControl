const sidebar = document.getElementById('sidebar');
const toggleTheme = document.getElementById('theme-toggle');
const collapseBtn = document.querySelector('.toggle-sidebar');
const collapseIcon = document.getElementById('collapse-icon');

// 🌙 Modo oscuro
toggleTheme.addEventListener('change', () => {
  sidebar.classList.toggle('dark');
  document.body.classList.toggle('dark');
});
// 📌 Colapsar sidebar
collapseBtn.addEventListener('click', () => {
  sidebar.classList.toggle('collapsed');
  if (sidebar.classList.contains('collapsed')) {
    collapseIcon.classList.remove('fa-angle-double-left');
    collapseIcon.classList.add('fa-angle-double-right');
  } else {
    collapseIcon.classList.remove('fa-angle-double-right');
    collapseIcon.classList.add('fa-angle-double-left');
  }
});

// 📂 Submenús desplegables (ej: Tablas)
document.querySelectorAll(".has-submenu").forEach(item => {
  item.addEventListener("click", e => {
    e.stopPropagation(); // evita que el click se propague al document
    // cerrar otros submenús al abrir uno nuevo
    document.querySelectorAll(".has-submenu").forEach(sub => {
      if (sub !== item) {
        sub.classList.remove("show");
      }
    });
    // alternar el menú actual
    item.classList.toggle("show");
  });
});

// 🔒 Cerrar submenús si se hace click fuera
document.addEventListener("click", () => {
  document.querySelectorAll(".has-submenu").forEach(sub => {
    sub.classList.remove("show");
  });
});

// 🔹 Prevenir cierre al hacer click dentro del submenu
document.querySelectorAll(".submenu").forEach(submenu => {
  submenu.addEventListener("click", e => e.stopPropagation());
});
