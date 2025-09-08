
window.myTasks = JSON.parse(localStorage.getItem("myTasks")) || [];

// Cargar tareas desde API
async function loadTasks() {
    try {
        const res = await fetch(`${BASE_URL}/api/tareas.php`);
        if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);

        const tareas = await res.json();
        renderTasks(tareas);
        setupSearchAssign(tareas);
    } catch (err) {
        console.error("❌ Error cargando tareas:", err);
        const container = document.getElementById("assign-task-list");
        if (container) container.innerHTML = "<li class='list-group-item text-danger'>No se pudieron cargar las tareas.</li>";
    }
}

function saveTasksToLocalStorage() {
    localStorage.setItem("myTasks", JSON.stringify(window.myTasks));
}

function renderTasks(tareas) {
    const container = document.getElementById("assign-task-list");
    if (!container) return;

    container.innerHTML = "";

    tareas.forEach(tarea => {
        const yaAsignada = window.myTasks.find(t => t.id === tarea.id);
        const li = document.createElement("li");
        li.className = "list-group-item d-flex justify-content-between align-items-center";
        li.innerHTML = `
            <span>${tarea.nombre}</span>
            <div>
                <button class="btn btn-info btn-sm me-1">Detalles</button>
                <button class="btn btn-${yaAsignada ? 'success' : 'primary'} btn-sm me-1" ${yaAsignada ? 'disabled' : ''}>
                    ${yaAsignada ? 'Asignada' : 'Asignar'}
                </button>
                ${yaAsignada ? `<button class="btn btn-danger btn-sm">Cancelar</button>` : ''}
            </div>
        `;

        const [btnDetalles, btnAsignar, btnCancelar] = li.querySelectorAll("button");

        // Botón Detalles
        btnDetalles.addEventListener("click", () => {
            alert(`Detalles de la tarea:\n\nNombre: ${tarea.nombre}\nID: ${tarea.id}`);
        });

        // Botón Asignar
        if (btnAsignar && !yaAsignada) {
            btnAsignar.addEventListener("click", () => assignTask(tarea, li));
        }

        // Botón Cancelar
        if (btnCancelar) {
            btnCancelar.addEventListener("click", () => cancelTask(tarea.id));
        }

        container.appendChild(li);
    });
}

async function assignTask(tarea, li) {
    if (window.myTasks.find(t => t.id === tarea.id)) return;

    window.myTasks.push({ ...tarea, completada: false });
    saveTasksToLocalStorage();
    showAssignMessage(`Tarea "${tarea.nombre}" asignada correctamente`);

    try {
        await fetch(`${BASE_URL}/api/asignar.php`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id: tarea.id })
        });
    } catch (err) {
        console.error("❌ Error asignando tarea:", err);
    }

    renderTasks(await getAllTasks());
    renderTaskCards(window.myTasks);
    renderMyTasks(window.myTasks);
    renderChart(window.myTasks);
}

function cancelTask(id) {
    window.myTasks = window.myTasks.filter(t => t.id !== id);
    saveTasksToLocalStorage();
    renderTasks(window.lastTasks);
    renderTaskCards(window.myTasks);
    renderMyTasks(window.myTasks);
    renderChart(window.myTasks);
    showAssignMessage("Tarea cancelada");
}

async function getAllTasks() {
    try {
        const res = await fetch(`${BASE_URL}/api/tareas.php`);
        const data = await res.json();
        window.lastTasks = data;
        return data;
    } catch {
        return [];
    }
}

function setupSearchAssign(tareas) {
    const input = document.getElementById("search-assign");
    input.addEventListener("input", () => {
        const query = input.value.toLowerCase();
        const filtered = tareas.filter(t => t.nombre.toLowerCase().includes(query));
        renderTasks(filtered);
    });
}

function showAssignMessage(msg) {
    const message = document.createElement("div");
    message.style.position = "fixed";
    message.style.top = "20px";
    message.style.right = "20px";
    message.style.background = "#4CAF50";
    message.style.color = "white";
    message.style.padding = "10px 15px";
    message.style.borderRadius = "5px";
    message.style.zIndex = 1000;
    message.textContent = msg;
    document.body.appendChild(message);
    setTimeout(() => message.remove(), 3000);
}

// Inicializar
document.addEventListener("DOMContentLoaded", async () => {
    const tareas = await getAllTasks();
    renderTasks(tareas);
    setupSearchAssign(tareas);
});

