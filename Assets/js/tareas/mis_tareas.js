
window.myTasks = JSON.parse(localStorage.getItem("myTasks")) || [];

function saveTasksToLocalStorage() {
    localStorage.setItem("myTasks", JSON.stringify(window.myTasks));
}

function loadMyTasks() {
    renderTaskCards(window.myTasks);
    renderMyTasks(window.myTasks);
    renderChart(window.myTasks);
}

function renderTaskCards(tareas) {
    const container = document.getElementById("my-task-cards");
    if (!container) return;

    const totalAsignadas = tareas.length;
    const completadas = tareas.filter(t => t.completada).length;
    const pendientes = tareas.filter(t => !t.completada).length;

    container.innerHTML = `
        <div class="card text-center flex-fill bg-primary text-white p-3">
            <h5>Tareas Asignadas</h5>
            <p class="fs-4 mb-0">${totalAsignadas}</p>
        </div>
        <div class="card text-center flex-fill bg-success text-white p-3">
            <h5>Tareas Completadas</h5>
            <p class="fs-4 mb-0">${completadas}</p>
        </div>
        <div class="card text-center flex-fill bg-warning text-dark p-3">
            <h5>Tareas Pendientes</h5>
            <p class="fs-4 mb-0">${pendientes}</p>
        </div>
    `;
}

function renderMyTasks(tareas) {
    const container = document.getElementById("my-task-list");
    if (!container) return;
    container.innerHTML = "";

    tareas.forEach(tarea => {
        const li = document.createElement("li");
        li.className = "list-group-item d-flex justify-content-between align-items-center";
        li.innerHTML = `
            <span>${tarea.nombre}</span>
            <div>
                <button class="btn btn-info btn-sm me-1">Detalles</button>
                ${!tarea.completada 
                    ? `<button class="btn btn-outline-success btn-sm me-1">Marcar como completada</button>` 
                    : `<button class="btn btn-success btn-sm me-1" disabled>Completada</button>`}
                <button class="btn btn-danger btn-sm">Cancelar</button>
            </div>
        `;

        const [btnDetalles, btnCompletar, btnCancelar] = li.querySelectorAll("button");

        btnDetalles.addEventListener("click", () => {
            alert(`Detalles de la tarea:\n\nNombre: ${tarea.nombre}\nID: ${tarea.id}`);
        });

        if (!tarea.completada) {
            btnCompletar.addEventListener("click", () => markAsCompleted(tarea.id));
        }

        btnCancelar.addEventListener("click", () => cancelTask(tarea.id));

        container.appendChild(li);
    });
}

async function markAsCompleted(id) {
    window.myTasks = window.myTasks.map(t => t.id === id ? { ...t, completada: true } : t);
    saveTasksToLocalStorage();
    renderTaskCards(window.myTasks);
    renderMyTasks(window.myTasks);
    renderChart(window.myTasks);

    try {
        await fetch(`${BASE_URL}/api/completar.php`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id })
        });
    } catch (err) {
        console.error("❌ Error completando tarea:", err);
    }
}

function cancelTask(id) {
    window.myTasks = window.myTasks.filter(t => t.id !== id);
    saveTasksToLocalStorage();
    renderTaskCards(window.myTasks);
    renderMyTasks(window.myTasks);
    renderChart(window.myTasks);
}

function renderChart(tareas) {
    const canvas = document.getElementById('task-progress-chart');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const completadas = tareas.filter(t => t.completada).length;
    const pendientes = tareas.filter(t => !t.completada).length;

    if (window.taskChart) window.taskChart.destroy();

    window.taskChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Completadas', 'Pendientes'],
            datasets: [{
                data: [completadas, pendientes],
                backgroundColor: ['#4CAF50', '#FFCA28']
            }]
        },
        options: { responsive: true }
    });
}

function setupSearchMy() {
    const input = document.getElementById("search-my");
    input.addEventListener("input", () => {
        const query = input.value.toLowerCase();
        const filtered = window.myTasks.filter(t => t.nombre.toLowerCase().includes(query));
        renderMyTasks(filtered);
    });
}

document.addEventListener("DOMContentLoaded", () => {
    loadMyTasks();
    setupSearchMy();
});

