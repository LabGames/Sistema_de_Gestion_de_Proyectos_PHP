document.addEventListener("DOMContentLoaded", () => {
  const inputInicio = document.getElementById("start_date");
  const inputFin = document.getElementById("end_date");
  const inputTiempo = document.getElementById("estimated_time");

  const hoy = new Date();
  const year = hoy.getFullYear();
  const month = String(hoy.getMonth() + 1).padStart(2, '0');
  const day = String(hoy.getDate()).padStart(2, '0');
  inputInicio.value = `${year}-${month}-${day}`;

  inputFin.addEventListener("change", () => {
    if (!inputInicio.value || !inputFin.value) return;

    const inicio = new Date(inputInicio.value);
    const fin = new Date(inputFin.value);

    if (fin < inicio) {
      inputTiempo.value = "La fecha fin no puede ser menor que inicio";
      return;
    }

    const diffMs = fin - inicio;
    const diffDays = diffMs / (1000 * 60 * 60 * 24);

    const diffMonths = Math.floor(diffDays / 30);
    const diffYears = Math.floor(diffDays / 365);

    let resultado = "";
    if (diffYears >= 1) {
      resultado = `${diffYears} año(s) y ${diffMonths % 12} mes(es)`;
    } else if (diffMonths >= 1) {
      resultado = `${diffMonths} mes(es)`;
    } else {
      resultado = `${diffDays} día(s)`;
    }

    inputTiempo.value = resultado;
  });
});
