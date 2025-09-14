let tabla;

listarRoles();
listarRolesModal();
listar();

function listarRoles() {
  fetch(`${BASE_URL}/Rol/Listar`)
    .then((response) => response.json())
    .then((roles) => {
      const select = document.getElementById("rol");
      roles.forEach((r) => {
        const option = document.createElement("option");
        option.value = r.id;
        option.textContent = r.nombre;
        select.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Error cargando roles:", error);
    });
}

function listarRolesModal() {
  fetch(`${BASE_URL}/Rol/Listar`)
    .then((response) => response.json())
    .then((roles) => {
      const select = document.getElementById("rol_modal");
      roles.forEach((r) => {
        const option = document.createElement("option");
        option.value = r.id;
        option.textContent = r.nombre;
        select.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Error cargando roles:", error);
    });
}

function listar() {
  fetch(`${BASE_URL}/Usuarios/Listar`)
    .then((response) => response.json())
    .then((data) => {
      if (tabla) {
        tabla.clear();
        tabla.rows.add(data);
        tabla.draw();
      } else {
        tabla = new DataTable("#tablaUsuarios", {
          pageLength: 5,
          lengthMenu: [5, 10, 25, 50],
          data: data,
          columns: [
            { data: "nombre" },
            { data: "email" },
            {
              data: "estado",
              render: function (estado) {
                return estado == 1
                  ? `<span class="badge badge-activo">Activo</span>`
                  : `<span class="badge badge-inactivo">Inactivo</span>`;
              },
            },
            {
              data: "estado",
              render: function (estado, type, row) {
                return `
                  <label class="switch">
                    <input type="checkbox" 
                           onchange="cambiarEstado(${row.id}, this.checked)" 
                           ${estado == 1 ? "checked" : ""}>
                    <span class="slider"></span>
                  </label>
                `;
              },
            },
            {
              data: null,
              render: function (row) {
                return `
                  <button title="Editar" class="btn-accion btn-editar" onclick="editarUsuario(${row.id})">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                  <button title="Eliminar" class="btn-accion btn-eliminar" onclick="eliminarUsuario(${row.id})">
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
    .catch((error) => console.error("Error al cargar usuarios:", error));
}

function editarUsuario(id) {
  const modal = document.getElementById("userModal");

  const formData = new FormData();
  formData.append("id", id);

  fetch(`${BASE_URL}/Usuarios/ObtenerUsuario`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((user) => {
      document.getElementById("id_user").value = user.id;
      document.getElementById("nombre_modal").value = user.nombre;
      document.getElementById("correo_modal").value = user.email;
      document.getElementById("password_modal").value = "";
      document.getElementById("rol_modal").value = user.rol_id;

      modal.classList.add("show");
    })
    .catch((error) => console.error("Error al obtener usuario:", error));
}

function cerrarModal() {
  const modal = document.getElementById("userModal");
  modal.classList.remove("show");
}

function registrarUsuario() {
  const name = document.getElementById("nombre").value.trim();
  const rol = document.getElementById("rol").value.trim();
  const email = document.getElementById("correo").value.trim();
  const password = document.getElementById("password").value.trim();

  const formData = new FormData();
  formData.append("name", name);
  formData.append("rol", rol);
  formData.append("email", email);
  formData.append("password", password);

  fetch(`${BASE_URL}/Usuarios/Registrar`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        Swal.fire({
          icon: "success",
          title: "Usuario registrado",
          text: "El usuario fue registrado correctamente.",
          background: "#1e293b",
          color: "#e2e8f0",
          iconColor: "#22c55e",
          confirmButtonColor: "#6366f1",
        }).then(() => {
          document.getElementById("formRegistrarUsuario").reset();
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
      console.error("Error al registrar usuarios:", error);
      Swal.fire({
        icon: "error",
        title: "Error de servidor",
        text: "Hubo un problema al registrar el usuario.",
        confirmButtonColor: "#ef4444",
      });
    });
}

function actualizarUsuario() {
  const id = document.getElementById("id_user").value;
  const name = document.getElementById("nombre_modal").value.trim();
  const rol = document.getElementById("rol_modal").value.trim();
  const email = document.getElementById("correo_modal").value.trim();
  const password = document.getElementById("password_modal").value.trim();
  
  const formData = new FormData();
  formData.append("id", id);
  formData.append("name", name);
  formData.append("rol", rol);
  formData.append("email", email);
  formData.append("password", password);

  fetch(`${BASE_URL}/Usuarios/Actualizar`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        cerrarModal();
        Swal.fire({
          icon: "success",
          title: "Usuario actualizado",
          text: "El usuario fue actualizado correctamente.",
          background: "#1e293b",
          color: "#e2e8f0",
          iconColor: "#22c55e",
          confirmButtonColor: "#6366f1",
        }).then(() => {
          document.getElementById("formActualizarUsuario").reset();
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
      console.error("Error al actualizar usuario:", error);
      Swal.fire({
        icon: "error",
        title: "Error de servidor",
        text: "Hubo un problema al registrar el usuario.",
        confirmButtonColor: "#ef4444",
      });
    });
}

function eliminarUsuario(id) {
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

      fetch(`${BASE_URL}/Usuarios/Eliminar`, {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            Swal.fire({
              icon: "success",
              title: "¡Eliminado!",
              text: data.message || "El usuario ha sido eliminado.",
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

function activarUsuario(id) {
  Swal.fire({
    title: "¿Activar usuario?",
    text: "El usuario podrá acceder al sistema nuevamente.",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Sí, activar",
    cancelButtonText: "Cancelar",
    background: "#1e293b",
    color: "#e2e8f0",
    confirmButtonColor: "#22c55e",
    cancelButtonColor: "#6b7280",
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append("id", id);

      fetch(`${BASE_URL}/Usuarios/Activar`, {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            Swal.fire({
              icon: "success",
              title: "¡Activado!",
              text: data.message,
              background: "#1e293b",
              color: "#e2e8f0",
              confirmButtonColor: "#6366f1",
            });
            listar();
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message,
              background: "#1e293b",
              color: "#e2e8f0",
              confirmButtonColor: "#ef4444",
            });
          }
        })
        .catch((err) => {
          console.error("Error al activar usuario:", err);
          Swal.fire({
            icon: "error",
            title: "Error de servidor",
            text: "Hubo un problema al activar el usuario.",
            background: "#1e293b",
            color: "#e2e8f0",
            confirmButtonColor: "#ef4444",
          });
        });
    }
  });
}

function inhabilitarUsuario(id) {
  Swal.fire({
    title: "¿Inhabilitar usuario?",
    text: "El usuario perderá acceso al sistema.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sí, inhabilitar",
    cancelButtonText: "Cancelar",
    background: "#1e293b",
    color: "#e2e8f0",
    confirmButtonColor: "#facc15",
    cancelButtonColor: "#6b7280",
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append("id", id);

      fetch(`${BASE_URL}/Usuarios/Inhabilitar`, {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            Swal.fire({
              icon: "success",
              title: "¡Inhabilitado!",
              text: data.message,
              background: "#1e293b",
              color: "#e2e8f0",
              confirmButtonColor: "#6366f1",
            });
            listar();
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message,
              background: "#1e293b",
              color: "#e2e8f0",
              confirmButtonColor: "#ef4444",
            });
          }
        })
        .catch((err) => {
          console.error("Error al inhabilitar usuario:", err);
          Swal.fire({
            icon: "error",
            title: "Error de servidor",
            text: "Hubo un problema al inhabilitar el usuario.",
            background: "#1e293b",
            color: "#e2e8f0",
            confirmButtonColor: "#ef4444",
          });
        });
    }
  });
}

function cambiarEstado(id, checked) {
  const url = checked
    ? `${BASE_URL}/Usuarios/Activar`
    : `${BASE_URL}/Usuarios/Inhabilitar`;

  const formData = new FormData();
  formData.append("id", id);

  fetch(url, {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        Swal.fire({
          icon: "success",
          title: "Éxito",
          text: data.message,
          background: "#1e293b",
          color: "#e2e8f0",
          confirmButtonColor: "#6366f1",
        });
        listar();
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: data.message,
          background: "#1e293b",
          color: "#e2e8f0",
          confirmButtonColor: "#ef4444",
        });
      }
    })
    .catch((err) => {
      console.error("Error:", err);
      Swal.fire({
        icon: "error",
        title: "Error de servidor",
        text: "No se pudo actualizar el estado del usuario.",
        background: "#1e293b",
        color: "#e2e8f0",
        confirmButtonColor: "#ef4444",
      });
    });
}
