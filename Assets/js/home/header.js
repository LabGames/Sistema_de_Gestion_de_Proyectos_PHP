$(document).ready(function () {
  estilo();
});

function estilo() {
  const btn = document.getElementById("themeToggleBtn");
  const body = document.body;
  if (localStorage.getItem("theme") === "light") {
    body.classList.add("light-mode");
    btn.innerHTML = '<i class="fa-solid fa-moon"></i> <span>Modo oscuro</span>';
  } else {
    btn.innerHTML = '<i class="fa-solid fa-sun"></i> <span>Modo claro</span>';
  }
}

function cambiarModo() {
  const btn = document.getElementById("themeToggleBtn");
  const body = document.body;
  body.classList.toggle("light-mode");

  if (body.classList.contains("light-mode")) {
    localStorage.setItem("theme", "light");
    btn.innerHTML = '<i class="fa-solid fa-moon"></i> <span>Modo oscuro</span>';
  } else {
    localStorage.setItem("theme", "dark");
    btn.innerHTML = '<i class="fa-solid fa-sun"></i> <span>Modo claro</span>';
  }
}
