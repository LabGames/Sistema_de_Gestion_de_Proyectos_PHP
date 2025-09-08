$(document).ready(function () {
    metricas();
});

function metricas() {
    const dataElement = document.getElementById("metricas-data");
    const metricas = JSON.parse(dataElement.dataset.metricas);

    const ctxTareas = document.getElementById("tareasChart").getContext("2d");
    new Chart(ctxTareas, {
        type: "doughnut",
        data: {
            labels: ["Pendientes", "Completadas"],
            datasets: [{
                data: [metricas.tareasPendientes, metricas.tareasCompletadas],
                backgroundColor: ["#ff6b6b", "#4ea8ff"]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: "bottom" },
                title: { display: true, text: "Estado de Tareas" }
            }
        }
    });
}
