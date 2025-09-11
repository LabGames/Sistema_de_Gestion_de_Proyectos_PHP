
console.log("📌 BASE_URL cargado:", BASE_URL);

// Referencias al DOM
const formTareas = document.getElementById("formTareas");
const tituloInput = document.getElementById("titulo");
const descripcionTextarea = document.getElementById("descripcion");
const fechaLimiteInput = document.getElementById("fecha_limite");
const prioridadSelect = document.getElementById("prioridad");

const tbodyTareas = document.getElementById("tbodyTareas");
const tbodyMisTareas = document.getElementById("tbodyMisTareas");
const tbodyAdminTareas = document.getElementById("tbodyAdminTareas");

const countPendientes = document.getElementById("countPendientes");
const countFinalizadas = document.getElementById("countFinalizadas");
const countCanceladas = document.getElementById("countCanceladas");

// Usuario actual (ejemplo: luego lo obtienes de la sesión)
const usuarioId = 1;

let tareas = [];

/* ====================================
 * CARGA DE DATOS DESDE EL SERVIDOR
 * ==================================== */
async function cargarTareas() {
  try {
    const res = await fetch(`${BASE_URL}/GestorTareas/listar`);
    if (!res.ok) throw new Error("HTTP " + res.status);
    tareas = await res.json();
    renderAll();
  } catch (e) {
    console.error("❌ Error al cargar tareas:", e);
  }
}

/* ====================================
 * RENDERIZADO
 * ==================================== */
function renderAll() {
  renderTareas();
  renderMisTareas();
  renderAdminTareas();
  actualizarResumen();
}

function renderTareas() {
  tbodyTareas.innerHTML = "";
  tareas.filter(t => t.estado === "Disponible").forEach(tarea => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${tarea.titulo}</td>
      <td>${tarea.descripcion}</td>
      <td>${tarea.fecha_limite}</td>
      <td>${tarea.prioridad}</td>
      <td>
        <button onclick="asignarTarea(${tarea.id})">Asignar</button>
      </td>
    `;
    tbodyTareas.appendChild(row);
  });
}

function renderMisTareas() {
  tbodyMisTareas.innerHTML = "";
  const misTareas = tareas.filter(t => t.asignado_a == usuarioId);
  misTareas.forEach(tarea => {
    const row = document.createElement("tr");
    const estadoClass = `estado-${tarea.estado.toLowerCase()}`;

    let acciones = "";
    if (tarea.estado === "Pendiente") {
      acciones = `
        <button onclick="actualizarEstadoTarea(${tarea.id}, 'Finalizada')">Finalizar</button>
        <button onclick="actualizarEstadoTarea(${tarea.id}, 'Cancelada')">Cancelar</button>
      `;
    }

    row.innerHTML = `
      <td>${tarea.titulo}</td>
      <td class="${estadoClass}">${tarea.estado}</td>
      <td>${acciones}</td>
    `;
    tbodyMisTareas.appendChild(row);
  });
}

function renderAdminTareas() {
  tbodyAdminTareas.innerHTML = "";
  tareas.forEach(tarea => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${tarea.titulo}</td>
      <td>${tarea.descripcion}</td>
      <td>${tarea.fecha_limite}</td>
      <td>${tarea.prioridad}</td>
      <td>
        <button onclick="borrarTarea(${tarea.id})">Borrar</button>
      </td>
    `;
    tbodyAdminTareas.appendChild(row);
  });
}

function actualizarResumen() {
  const misTareas = tareas.filter(t => t.asignado_a == usuarioId);
  countPendientes.textContent = misTareas.filter(t => t.estado === "Pendiente").length;
  countFinalizadas.textContent = misTareas.filter(t => t.estado === "Finalizada").length;
  countCanceladas.textContent = misTareas.filter(t => t.estado === "Cancelada").length;
}

/* ====================================
 * CRUD DE TAREAS (con fetch)
 * ==================================== */
async function crearTarea() {
  const nuevaTarea = {
    titulo: tituloInput.value,
    descripcion: descripcionTextarea.value,
    fecha_limite: fechaLimiteInput.value,
    prioridad: prioridadSelect.value
  };

  if (!nuevaTarea.titulo || !nuevaTarea.descripcion) {
    alert("Por favor, completa todos los campos.");
    return;
  }

  try {
    const res = await fetch(`${BASE_URL}/GestorTareas/guardar`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(nuevaTarea)
    });
    const data = await res.json();

    if (data.success) {
      formTareas.reset();
      await cargarTareas();
      alert("✅ Tarea creada en la BD con éxito.");
    } else {
      alert("⚠️ Error al guardar la tarea.");
    }
  } catch (e) {
    console.error("❌ Error al crear tarea:", e);
  }
}

async function asignarTarea(id) {
  try {
    const res = await fetch(`${BASE_URL}/GestorTareas/asignar`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id, usuarioId })
    });
    const data = await res.json();

    if (data.success) {
      await cargarTareas();
      alert("📌 Tarea asignada correctamente.");
    }
  } catch (e) {
    console.error("❌ Error al asignar tarea:", e);
  }
}

async function actualizarEstadoTarea(id, nuevoEstado) {
  try {
    const res = await fetch(`${BASE_URL}/GestorTareas/actualizarEstado`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id, estado: nuevoEstado })
    });
    const data = await res.json();

    if (data.success) {
      await cargarTareas();
      alert(`🔄 Tarea marcada como ${nuevoEstado}.`);
    }
  } catch (e) {
    console.error("❌ Error al actualizar estado:", e);
  }
}

async function borrarTarea(id) {
  if (!confirm("¿Seguro que deseas borrar esta tarea?")) return;

  try {
    const res = await fetch(`${BASE_URL}/GestorTareas/borrar`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id })
    });
    const data = await res.json();

    if (data.success) {
      await cargarTareas();
      alert("🗑️ Tarea eliminada.");
    }
  } catch (e) {
    console.error("❌ Error al borrar tarea:", e);
  }
}

/* ====================================
 * BÚSQUEDA
 * ==================================== */
function crearBarraBusqueda(container, tableId) {
  if (!container) return;
  const inputId = `search-${tableId}`;
  if (document.getElementById(inputId)) return;

  const searchHtml = `
    <div style="margin-bottom: 15px; text-align: right;">
      <input type="text" id="${inputId}" placeholder="Buscar en la tabla..." 
        style="padding: 8px; border-radius: 6px; border: 1px solid #334155; background-color: #1e293b; color: #e2e8f0;">
    </div>
  `;
  const searchContainer = document.createElement("div");
  searchContainer.innerHTML = searchHtml;
  container.insertBefore(searchContainer, container.firstChild);

  document.getElementById(inputId).addEventListener("keyup", e => {
    const query = e.target.value.toLowerCase();
    const table = document.getElementById(tableId);
    const rows = table.querySelectorAll("tbody tr");
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(query) ? "" : "none";
    });
  });
}

/* ====================================
 * INICIALIZACIÓN
 * ==================================== */
document.addEventListener("DOMContentLoaded", () => {
  const root = document.getElementById("smartwizard2");
  if (!root) return;

  const tabs = Array.from(root.querySelectorAll(".nav .nav-link"));
  const panes = Array.from(root.querySelectorAll(".tab-pane"));

  panes.forEach((p, i) => {
    if (!p.id) p.id = `step-${i + 1}`;
  });

  function activate(index) {
    tabs.forEach((t, i) => {
      t.classList.toggle("active", i === index);
      t.setAttribute("aria-selected", i === index ? "true" : "false");
    });
    panes.forEach((p, i) => {
      p.classList.toggle("active", i === index);
      p.classList.toggle("show", i === index);
    });

    const prevBtn = document.querySelector(".sw-btn-prev");
    const nextBtn = document.querySelector(".sw-btn-next");
    if (prevBtn) prevBtn.style.display = index === 0 ? "none" : "";
    if (nextBtn) nextBtn.style.display = index === panes.length - 1 ? "none" : "";
  }

  tabs.forEach((tab, idx) => {
    tab.addEventListener("click", e => {
      e.preventDefault();
      activate(idx);
    });
  });

  let toolbar = root.querySelector(".wizard-toolbar");
  if (!toolbar) {
    toolbar = document.createElement("div");
    toolbar.className = "wizard-toolbar";

    const prevBtn = document.createElement("button");
    prevBtn.type = "button";
    prevBtn.className = "sw-btn-prev";
    prevBtn.textContent = "Anterior";
    prevBtn.addEventListener("click", () => {
      const cur = panes.findIndex(p => p.classList.contains("active"));
      if (cur > 0) activate(cur - 1);
    });

    const nextBtn = document.createElement("button");
    nextBtn.type = "button";
    nextBtn.className = "sw-btn-next";
    nextBtn.textContent = "Siguiente";
    nextBtn.addEventListener("click", () => {
      const cur = panes.findIndex(p => p.classList.contains("active"));
      if (cur < panes.length - 1) {
        activate(cur + 1);
      } else {
        alert("¡Has llegado al final! No hay más vistas.");
      }
    });

    toolbar.appendChild(prevBtn);
    toolbar.appendChild(nextBtn);
    root.appendChild(toolbar);
  }

  activate(0);
  cargarTareas(); // 🚀 carga inicial de tareas
  crearBarraBusqueda(document.querySelector("#step-1 .table-container"), "tablaTareas");
  crearBarraBusqueda(document.querySelector("#step-2 .table-container"), "tablaMisTareas");
  crearBarraBusqueda(document.querySelector("#step-3 .table-container"), "tablaAdminTareas");
});
