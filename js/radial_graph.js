document.addEventListener("DOMContentLoaded", function () {

    if (typeof Chart === 'undefined') {
        console.error('Chart.js NO está cargado. Asegúrate de incluirlo antes de radial_graph.js.');
        return;
    }

    if (typeof ChartDataLabels === 'undefined') {
        console.error('chartjs-plugin-datalabels NO está cargado. Inclúyelo antes de radial_graph.js.');
        return;
    }

    const valores = window.graficoValores || [0,0,0,0,0,0,0,0];
    const labels  = window.graficoLabels  || [
        "Valor 1","Valor 2","Valor 3","Valor 4",
        "Valor 5","Valor 6","Valor 7","Valor 8"
    ];

    const colores = [
        "#10c03cff", "#3ebec2ff", "#568bffff", "#ff85d0ff",
        "#b3ff3aff", "#ffb340ff", "#ff4a4aff", "#525252ff"
    ];

    const canvas = document.getElementById("bake_circle_graph");
    if (!canvas) {
        console.error('No encontré el canvas #bake_circle_graph');
        return;
    }
    const ctx = canvas.getContext("2d");

    if (window.__miPieChart) {
        try { window.__miPieChart.destroy(); } catch(e){/* swallow */ }
    }

    function getTextColorForBackground(hexColor) {
        hexColor = hexColor.replace("#", "").substring(0, 6);
        const r = parseInt(hexColor.substring(0, 2), 16);
        const g = parseInt(hexColor.substring(2, 4), 16);
        const b = parseInt(hexColor.substring(4, 6), 16);

        const luminance = (0.299 * r + 0.587 * g + 0.114 * b);
        return luminance > 186 ? "#000000" : "#ffffff";
    }

    window.__miPieChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: labels,
            datasets: [{
                data: valores,
                backgroundColor: colores,
                borderColor: "#ffffff",
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#ffffff',
                        font: {
                            family: 'Franklin Gothic Medium, Arial, sans-serif',
                            size: 14
                        }
                    }
                },
                datalabels: {
                    color: function(context) {
                        const bgColor = context.dataset.backgroundColor[context.dataIndex];
                        return getTextColorForBackground(bgColor);
                    },
                    font: {
                        family: 'Franklin Gothic Medium, Arial, sans-serif',
                        size: 12
                    },
                    formatter: (value, ctx) => {
                        if (value === 0) return "";
                        const sum = ctx.chart.data.datasets[0].data
                            .reduce((a, b) => a + b, 0);
                        const porcentaje = ((value / sum) * 100).toFixed(1) + '%';
                        return (porcentaje === "0.0%") ? "" : porcentaje;
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
});
