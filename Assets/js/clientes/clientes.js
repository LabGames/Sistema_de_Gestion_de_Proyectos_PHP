$(document).ready(function () {
  smartWizard();
  listar();
  listarEstados();
  listarEstadosModal();
  listarContactos();
});
let tabla;

function cerrarModal() {
  const modal = document.getElementById("clienteModal");
  modal.classList.remove("show");
  document.getElementById("formActualizarCliente").reset();
}

function listarEstados() {
  fetch(`${BASE_URL}/Clientes/ListarEstados`)
    .then((response) => response.json())
    .then((roles) => {
      const select = document.getElementById("estado");
      roles.forEach((r) => {
        const option = document.createElement("option");
        option.value = r.id;
        option.textContent = r.nombre;
        select.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Error al cargar estados:", error);
    });
}

function listarContactos(id, contactoSeleccionado = null) {
  const formData = new FormData();
  formData.append("id", id);

  fetch(`${BASE_URL}/Contactos/Listar`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((contactos) => {
      const select = document.getElementById("contacto_modal");
      select.innerHTML = "";

      contactos.forEach((c) => {
        const option = document.createElement("option");
        option.value = c.id;
        option.textContent = c.nombre;
        select.appendChild(option);
      });

      if (contactoSeleccionado) {
        select.value = contactoSeleccionado;
      }
    })
    .catch((error) => {
      console.error("Error al cargar contactos:", error);
    });
}



function listarEstadosModal() {
  fetch(`${BASE_URL}/Clientes/ListarEstados`)
    .then((response) => response.json())
    .then((roles) => {
      const select = document.getElementById("estado_modal");
      roles.forEach((r) => {
        const option = document.createElement("option");
        option.value = r.id;
        option.textContent = r.nombre;
        select.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Error al cargar estados:", error);
    });
}

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
              data: "estado_nombre",
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
  const empresa = document.getElementById("empresa").value.trim();
  const rubro = document.getElementById("rubro").value.trim();
  const estado = document.getElementById("estado").value.trim();

  const nombreContacto = document
    .getElementById("nombre_contacto")
    .value.trim();
  const correoContacto = document.getElementById("correo").value.trim();
  const telefonoContacto = document.getElementById("telefono").value.trim();

  const correoUsuario = document.getElementById("correo_usuario").value.trim();
  const password = document.getElementById("password").value.trim();

  const formData = new FormData();
  formData.append("nombreCliente", nombreCliente);
  formData.append("empresa", empresa);
  formData.append("rubro", rubro);
  formData.append("estado", estado);

  formData.append("nombreContacto", nombreContacto);
  formData.append("correoContacto", correoContacto);
  formData.append("telefonoContacto", telefonoContacto);

  formData.append("correoUsuario", correoUsuario);
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
          title: data.message,
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
          erroresHtml = "<ul style='text-align:center; padding:0;'>";
          data.message.forEach((error) => {
            erroresHtml += `<li style="list-style:none; margin:4px 0;">${error}</li>`;
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

function editarCliente(id) {
  const modal = document.getElementById("clienteModal");
  const formData = new FormData();
  formData.append("id", id);

  fetch(`${BASE_URL}/Clientes/ObtenerCliente`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((cliente) => {
      document.getElementById("id_user").value = cliente.user_id;
      document.getElementById("id_cliente").value = cliente.id;
      document.getElementById("nombre_modal").value = cliente.nombre_cliente;
      document.getElementById("empresa_modal").value = cliente.empresa;
      document.getElementById("rubro_modal").value = cliente.rubro;
      document.getElementById("estado_modal").value = cliente.estado_id;

      listarContactos(id, cliente.contacto_principal);

      modal.classList.add("show");
    })
    .catch((error) => console.error("Error al obtener cliente:", error));
}


function actualizarCliente() {
  const id = document.getElementById("id_cliente").value.trim();
  const nombreCliente = document.getElementById("nombre_modal").value.trim();
  const empresa = document.getElementById("empresa_modal").value.trim();
  const rubro = document.getElementById("rubro_modal").value.trim();
  const estado = document.getElementById("estado_modal").value.trim();
  const contacto = document.getElementById("contacto_modal").value.trim();
  const user_id = document.getElementById("id_user").value.trim();

  const formData = new FormData();
  formData.append("id", id);
  formData.append("nombreCliente", nombreCliente);
  formData.append("empresa", empresa);
  formData.append("rubro", rubro);
  formData.append("estado", estado);
  formData.append("contacto", contacto);
  formData.append("user_id", user_id);

  fetch(`${BASE_URL}/Clientes/Actualizar`, {
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
          text: "El cliente fue actualizado correctamente.",
          background: "#1e293b",
          color: "#e2e8f0",
          iconColor: "#22c55e",
          confirmButtonColor: "#6366f1",
        }).then(() => {
          document.getElementById("formActualizarCliente").reset();
          listar();
        });
      } else {
        let erroresHtml = "";
        if (Array.isArray(data.message)) {
          erroresHtml = "<ul style='text-align:center; padding:0;'>";
          data.message.forEach((error) => {
            erroresHtml += `<li style="list-style:none; margin:4px 0;">${error}</li>`;
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
      console.error("Error al actualizar cliente:", error);
      Swal.fire({
        icon: "error",
        title: "Error de servidor",
        text: "Hubo un problema al actualizar el cliente.",
        confirmButtonColor: "#ef4444",
      });
    });
}

function eliminarCliente(id) {
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

      fetch(`${BASE_URL}/Clientes/Eliminar`, {
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
              text: data.message || "No se pudo eliminar el usuario.",
              background: "#1e293b",
              color: "#e2e8f0",
              confirmButtonColor: "#ef4444",
            });
          }
        })
        .catch((err) => {
          console.error("Error al eliminar usuario:", err);
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