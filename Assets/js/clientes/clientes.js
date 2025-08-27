$(document).ready(function () {
  smartWizard();
  listar();
});
let tabla;

function smartWizard() {
  $("#smartwizard").smartWizard({
    theme: "circles",
    autoAdjustHeight: false,
    transition: {
      animation: "fade",
    },
    toolbar: {
      showNextButton: true,
      showPreviousButton: true,
      position: "bottom",
    },
    lang: {
      next: "Siguiente",
      previous: "Anterior",
    },
  });
}

function listar() {
  fetch(`${BASE_URL}/Clientes/Listar`)
    .then((response) => response.json())
    .then((data) => {
      if (tabla) {
        tabla.clear();
        tabla.rows.add(data);
        tabla.draw();
      } else {
        tabla = new DataTable("#tablaClientes", {
          pageLength: 5,
          lengthMenu: [5, 10, 25, 50],
          data: data,
          columns: [
            { data: "nombre_cliente" },
            { data: "empresa" },
            {
              data: "rubro",
            },
            {
              data: "estado_id",
            },
            {
              data: null,
              render: function (row) {
                return `
                    <button title="Editar" class="btn-accion btn-editar" onclick="editarCliente(${row.id})">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button title="Eliminar" class="btn-accion btn-eliminar" onclick="eliminarCliente(${row.id})">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  `;
              },
            },
          ],
          language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
            emptyTable: "No hay datos registrados",
          },
        });
      }
    })
    .catch((error) => console.error("Error al cargar clientes:", error));
}

function registrarCliente() {
  const nombreCliente = document.getElementById("nombre").value.trim();
  const empresa = document.getElementById("rol").value.trim();
  const rubro = document.getElementById("correo").value.trim();
  const estado = document.getElementById("password").value.trim();

  const formData = new FormData();
  formData.append("name", name);
  formData.append("rol", rol);
  formData.append("email", email);
  formData.append("password", password);

  fetch(`${BASE_URL}/Clientes/Registrar`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        Swal.fire({
          icon: "success",
          title: "Cliente registrado",
          text: "El cliente fue registrado correctamente.",
          background: "#1e293b",
          color: "#e2e8f0",
          iconColor: "#22c55e",
          confirmButtonColor: "#6366f1",
        }).then(() => {
          document.getElementById("formClientes").reset();
          listar();
        });
      } else {
        let erroresHtml = "";
        if (Array.isArray(data.message)) {
          erroresHtml = "<div><ul style='text-align:center'></div>";
          data.message.forEach((errores) => {
            erroresHtml += `<li>${errores}</li>`;
          });
          erroresHtml += "</ul>";
        } else {
          erroresHtml = data.message;
        }
        Swal.fire({
          icon: "error",
          title: "Campos incompletos",
          html: erroresHtml,
          background: "#1e293b",
          color: "#e2e8f0",
          confirmButtonColor: "#ef4444",
        });
      }
    })
    .catch((error) => {
      console.error("Error al registrar cliente:", error);
      Swal.fire({
        icon: "error",
        title: "Error de servidor",
        text: "Hubo un problema al registrar el cliente.",
        confirmButtonColor: "#ef4444",
      });
    });
}
