document.addEventListener("DOMContentLoaded", () => {
  console.log("Gestor de tareas cargado ✅");

  // Inicializar Select2 en el campo de colaboradores (si existe)
  if (window.jQuery && typeof $ !== "undefined" && $('#colaboradores').length) {
    $('#colaboradores').select2({
      placeholder: "Buscar o seleccionar colaboradores...",
      allowClear: true
    });
  }

  // =========================
  // 🔎 Buscador: Asignar Tareas (TAB 1)
  // =========================
  const searchAssign = document.getElementById('search-assign-tasks');
  const assignList = document.getElementById('assign-task-list');

  if (searchAssign && assignList) {
    const assignItems = assignList.querySelectorAll('li');

    // Solo el texto visible (ignora botones "Asignar")
    const getAssignText = (li) => {
      return Array.from(li.childNodes)
        .filter(n => n.nodeType === Node.TEXT_NODE) // solo nodos de texto
        .map(n => n.textContent)
        .join(' ')
        .toLowerCase()
        .trim();
    };

    const showAllAssign = () => assignItems.forEach(li => li.style.display = 'flex');

    const filterAssign = () => {
      const term = searchAssign.value.toLowerCase().trim();
      if (!term) { showAllAssign(); return; }
      assignItems.forEach(li => {
        const txt = getAssignText(li);
        li.style.display = txt.includes(term) ? 'flex' : 'none';
      });
    };

    // Usamos 'input' para que responda a pegar/borrar también
    searchAssign.addEventListener('input', filterAssign);
  }

  // =========================
  // 🔎 Buscador: Mis Tareas (TAB 2)
  // =========================
  const searchMy = document.getElementById('search-my-tasks');
  const myList = document.getElementById('my-task-list');

  if (searchMy && myList) {
    const myItems = myList.querySelectorAll('li');
    const showAllMy = () => myItems.forEach(li => li.style.display = 'flex');

    const filterMy = () => {
      const term = searchMy.value.toLowerCase().trim();
      if (!term) { showAllMy(); return; }
      myItems.forEach(li => {
        const label = li.querySelector('.form-check-label');
        const txt = (label ? label.textContent : li.textContent).toLowerCase();
        li.style.display = txt.includes(term) ? 'flex' : 'none';
      });
    };

    searchMy.addEventListener('input', filterMy);
  }

  // =========================
  // 📊 Métricas + Gráfico (TAB 2)
  // =========================
  const ctx = document.getElementById('task-progress-chart');
  let myChart;

  const updateChart = (completed, pending, total) => {
    // Evita romper si Chart.js no cargó
    if (!window.Chart || !ctx) return;

    const chartData = [completed, pending];
    const chartLabels = ['Completadas', 'Pendientes'];

    if (myChart) {
      myChart.data.datasets[0].data = chartData;
      myChart.update();
    } else {
      myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: chartLabels,
          datasets: [{
            data: chartData,
            backgroundColor: ['#28a745', '#ffc107'],
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
              labels: {
                color: '#fff'
              }
            },
            tooltip: {
              callbacks: {
                label: (context) => {
                  const label = context.label || '';
                  const value = context.parsed;
                  const percentage = (total > 0) ? (value / total * 100).toFixed(1) : 0;
                  return `${label}: ${percentage}%`;
                }
              }
            }
          }
        }
      });
    }
  };

  const updateMetrics = () => {
    const checkboxes = document.querySelectorAll('#my-task-list input[type="checkbox"]');
    const totalTasks = checkboxes.length;
    const completedTasks = document.querySelectorAll('#my-task-list input[type="checkbox"]:checked').length;
    const pendingTasks = totalTasks - completedTasks;

    const totalEl = document.getElementById('total-tareas');
    const compEl = document.getElementById('tareas-completadas');
    const pendEl = document.getElementById('tareas-pendientes');

    if (totalEl) totalEl.textContent = totalTasks;
    if (compEl) compEl.textContent = completedTasks;
    if (pendEl) pendEl.textContent = pendingTasks;

    updateChart(completedTasks, pendingTasks, totalTasks);
  };

  // Estado al marcar/desmarcar tareas
  document.querySelectorAll('#my-task-list input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      const listItem = checkbox.closest('li');
      const statusBadge = listItem.querySelector('.status-badge');
      const sendBtn = listItem.querySelector('.send-proofs-btn');
      const viewBtn = listItem.querySelector('.view-proofs-btn');

      if (checkbox.checked) {
        if (statusBadge) {
          statusBadge.textContent = 'Completada';
          statusBadge.classList.remove('bg-warning');
          statusBadge.classList.add('bg-success');
        }
        if (sendBtn) sendBtn.classList.add('d-none');
        if (viewBtn) viewBtn.classList.remove('d-none');
      } else {
        if (statusBadge) {
          statusBadge.textContent = 'En progreso';
          statusBadge.classList.remove('bg-success');
          statusBadge.classList.add('bg-warning');
        }
        if (sendBtn) sendBtn.classList.remove('d-none');
        if (viewBtn) viewBtn.classList.add('d-none');
      }
      updateMetrics();
    });
  });

  // Inicializa métricas
  updateMetrics();

  // Modal "Crear Tarea"
  const form = document.querySelector("#nuevaTareaModal form");
  if (form) {
    form.addEventListener("submit", e => {
      e.preventDefault();
      Swal.fire({
        icon: "success",
        title: "Tarea añadida",
        text: "La tarea se agregó correctamente"
      });
      // Aquí podrías añadir la nueva tarea al listado y llamar updateMetrics()
    });
  }
});
