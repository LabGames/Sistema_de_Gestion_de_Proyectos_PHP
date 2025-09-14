$(document).ready(function () {
  listar();
  listarContactos();
  datosCliente();
});
let tabla;

function showTab(tabId, event) {
  document
    .querySelectorAll(".tab-content")
    .forEach((c) => c.classList.remove("active"));
  document
    .querySelectorAll(".tab")
    .forEach((t) => t.classList.remove("active"));
  document.getElementById(tabId).classList.add("active");
  event.target.classList.add("active");
}

function datosCliente() {
  const formData = new FormData();
  formData.append("id", clienteId);

  fetch(`${BASE_URL}/Clientes/ObtenerCliente`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((cliente) => {
      console.log(cliente)
      document.getElementById("nombre_cliente").value = cliente.nombre_cliente;
      document.getElementById("empresa_cliente").value = cliente.empresa;
      document.getElementById("rubro_cliente").value = cliente.rubro;
    })
    .catch((error) => console.error("Error al obtener cliente:", error));
}

function listarContactos() {
  const formData = new FormData();
  formData.append("id", clienteId);

  fetch(`${BASE_URL}/Contactos/Listar`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((contactos) => {
      const select = document.getElementById("contacto_cliente");
      select.innerHTML = "";

      contactos.forEach((c) => {
        const option = document.createElement("option");
        option.value = c.id;
        option.textContent = c.nombre;
        select.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Error al cargar contactos:", error);
    });
}

function nuevoContacto(){
  const modal = document.getElementById("contactoModalAgregar");
  modal.classList.add("show");
}

function cerrarModalAgregar() {
  const modal = document.getElementById("contactoModalAgregar");
  modal.classList.remove("show");
  document.getElementById("formRegistrarContacto").reset();
}

function cerrarModal() {
  const modal = document.getElementById("contactoModal");
  modal.classList.remove("show");
  document.getElementById("formActualizarContacto").reset();
}

function listar() {
  const formData = new FormData();
  formData.append("id", clienteId);
  fetch(`${BASE_URL}/Contactos/Listar`, { method: "POST", body: formData })
    .then((response) => response.json())
    .then((data) => {
      if (tabla) {
        tabla.clear();
        tabla.rows.add(data);
        tabla.draw();
      } else {
        tabla = new DataTable("#tablaContactos", {
          pageLength: 5,
          lengthMenu: [5, 10, 25, 50],
          data: data,
          columns: [
            { data: "nombre" },
            { data: "correo" },
            {
              data: "telefono",
            },
            {
              data: null,
              render: function (row) {
                return `
                      <button title="Editar" class="btn-accion btn-editar" onclick="editarContacto(${row.id})">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </button>
                      <button title="Eliminar" class="btn-accion btn-eliminar" onclick="eliminarContacto(${row.id})">
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
    .catch((error) => console.error("Error al cargar contactos:", error));
}

function editarContacto(id) {
  const modal = document.getElementById("contactoModal");
  const formData = new FormData();
  formData.append("id", id);

  fetch(`${BASE_URL}/Contactos/Registrar`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((contacto) => {
      document.getElementById("id_contacto").value = contacto.id;
      document.getElementById("nombre_modal").value = contacto.nombre;
      document.getElementById("correo_modal").value = contacto.correo;
      document.getElementById("telefono_modal").value = contacto.telefono;

      modal.classList.add("show");
    })
    .catch((error) => console.error("Error al obtener contacto:", error));
}

function registrarContacto() {
  const nombre = document.getElementById("nombre").value.trim();
  const correo = document.getElementById("correo").value.trim();
  const telefono = document.getElementById("telefono").value.trim();

  const formData = new FormData();
  formData.append("nombre", nombre);
  formData.append("correo", correo);
  formData.append("telefono", telefono);

  fetch(`${BASE_URL}/Contactos/Registrar`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        cerrarModalAgregar();
        Swal.fire({
          icon: "success",
          title: data.message,
          text: "El contacto fue registrado correctamente.",
          background: "#1e293b",
          color: "#e2e8f0",
          iconColor: "#22c55e",
          confirmButtonColor: "#6366f1",
        }).then(() => {
          document.getElementById("formRegistrarContacto").reset();
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
      console.error("Error al registrar el contacto:", error);
      Swal.fire({
        icon: "error",
        title: "Error de servidor",
        text: "Hubo un problema al registrar el contacto.",
        confirmButtonColor: "#ef4444",
      });
    });
}

function actualizarContacto() {
  const id = document.getElementById("id_contacto").value.trim();
  const nombre = document.getElementById("nombre_modal").value.trim();
  const correo = document.getElementById("correo_modal").value.trim();
  const telefono = document.getElementById("telefono_modal").value.trim();

  const formData = new FormData();
  formData.append("id", id);
  formData.append("nombre", nombre);
  formData.append("correo", correo);
  formData.append("telefono", telefono);

  fetch(`${BASE_URL}/Contactos/Actualizar`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        cerrarModal();
        Swal.fire({
          icon: "success",
          title: data.message,
          text: "El contacto fue actualizado correctamente.",
          background: "#1e293b",
          color: "#e2e8f0",
          iconColor: "#22c55e",
          confirmButtonColor: "#6366f1",
        }).then(() => {
          document.getElementById("formActualizarContacto").reset();
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
      console.error("Error al actualizar contacto:", error);
      Swal.fire({
        icon: "error",
        title: "Error de servidor",
        text: "Hubo un problema al actualizar el contacto.",
        confirmButtonColor: "#ef4444",
      });
    });
}

function eliminarContacto(id) {
  Swal.fire({
    title: "¿Estás seguro?",
    text: "¡No podrás revertir esto!",
    icon: "warning",
    background: "#1e293b",
    color: "#e2e8f0",
    iconColor: "#facc15",
    showCancelButton: true,
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
    customClass: {
      popup: "swal-popup",
      title: "swal-title",
      htmlContainer: "swal-text",
      confirmButton: "swal-confirm",
      cancelButton: "swal-cancel",
    },
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append("id", id);

      fetch(`${BASE_URL}/Contactos/Eliminar`, {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            Swal.fire({
              icon: "success",
              title: "¡Eliminado!",
              text: data.message ,
              background: "#1e293b",
              color: "#e2e8f0",
              confirmButtonColor: "#6366f1",
            });
            listar();
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message || "No se pudo eliminar el contacto.",
              background: "#1e293b",
              color: "#e2e8f0",
              confirmButtonColor: "#ef4444",
            });
          }
        })
        .catch((err) => {
          console.error("Error al eliminar contacto:", err);
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Hubo un problema en el servidor.",
            background: "#1e293b",
            color: "#e2e8f0",
            confirmButtonColor: "#ef4444",
          });
        });
    }
  });
}