// admin.js

document.addEventListener("DOMContentLoaded", () => {
    console.log("✅ Admin JS cargado correctamente");

    // LocalStorage para todas las tareas disponibles
    window.allTasks = JSON.parse(localStorage.getItem("allTasks")) || [];

    const adminTableBody = document.querySelector("#admin-table tbody");
    const formCrear = document.getElementById("formCrear");

    // Guardar en localStorage
    function saveAllTasks() {
        localStorage.setItem("allTasks", JSON.stringify(window.allTasks));
    }

    // Renderizar tabla de Admin
    function renderAdminTable() {
        adminTableBody.innerHTML = "";
        if (window.allTasks.length === 0) {
            adminTableBody.innerHTML = `<tr><td colspan="4" class="text-center text-muted">No hay tareas registradas</td></tr>`;
            return;
        }

        window.allTasks.forEach((tarea, index) => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${tarea.id}</td>
                <td>${tarea.nombre}</td>
                <td>
                    <span class="badge ${tarea.estado === "Activa" ? "bg-success" : "bg-secondary"}">
                        ${tarea.estado}
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm btn-warning me-1 editar-btn">✏️</button>
                    <button class="btn btn-sm btn-danger eliminar-btn">🗑️</button>
                </td>
            `;

            // Botón editar
            tr.querySelector(".editar-btn").addEventListener("click", () => {
                document.getElementById("modalCrearLabel").textContent = "Editar Tarea";
                document.getElementById("crearBtn").textContent = "Guardar Cambios";

                document.getElementById("tareaNombre").value = tarea.nombre;
                document.getElementById("tareaDetalle").value = tarea.detalle;
                document.getElementById("tareaColaborador").value = tarea.colaborador;
                document.getElementById("tareaInicio").value = tarea.inicio;
                document.getElementById("tareaLimite").value = tarea.limite;

                formCrear.dataset.editIndex = index;

                new bootstrap.Modal(document.getElementById("modalCrear")).show();
            });

            // Botón eliminar
            tr.querySelector(".eliminar-btn").addEventListener("click", () => {
                if (confirm("¿Seguro que quieres eliminar esta tarea?")) {
                    window.allTasks.splice(index, 1);
                    saveAllTasks();
                    renderAdminTable();
                    renderTasks(window.allTasks); // refrescar Asignar Tareas
                }
            });

            adminTableBody.appendChild(tr);
        });
    }

    // Crear o editar tarea
    formCrear.addEventListener("submit", (e) => {
        e.preventDefault();

        const nuevaTarea = {
            id: Date.now(),
            nombre: document.getElementById("tareaNombre").value,
            detalle: document.getElementById("tareaDetalle").value,
            colaborador: document.getElementById("tareaColaborador").value,
            inicio: document.getElementById("tareaInicio").value,
            limite: document.getElementById("tareaLimite").value,
            estado: "Activa"
        };

        if (formCrear.dataset.editIndex) {
            // Editar tarea existente
            const index = formCrear.dataset.editIndex;
            window.allTasks[index] = { ...window.allTasks[index], ...nuevaTarea };
            delete formCrear.dataset.editIndex;
        } else {
            // Nueva tarea
            window.allTasks.push(nuevaTarea);
        }

        saveAllTasks();
        renderAdminTable();
        renderTasks(window.allTasks); // refrescar Asignar Tareas

        formCrear.reset();
        bootstrap.Modal.getInstance(document.getElementById("modalCrear")).hide();
    });

    // Inicializar tabla
    renderAdminTable();
});
