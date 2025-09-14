$(document).ready(function () {
  datosUsuario();
});

function datosUsuario() {
  const formData = new FormData();
  formData.append("id", userId);

  fetch(`${BASE_URL}/Usuarios/ObtenerUsuario`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((user) => {
      document.getElementById("nombre").value = user.nombre;
      document.getElementById("correo").value = user.email;
    })
    .catch((error) => console.error("Error al obtener datos:", error));
}

function ActualizarDatos() {
    const name = document.getElementById("nombre").value.trim();
    const email = document.getElementById("correo").value.trim();
    const password = document.getElementById("password").value.trim();
    
    const formData = new FormData();
    formData.append("name", name);
    formData.append("email", email);
    formData.append("password", password);
  
    fetch(`${BASE_URL}/Usuarios/ActualizarDatos`, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          Swal.fire({
            icon: "success",
            title: "Datos actualizados",
            text: "Los datos fueron actualizados correctamente.",
            background: "#1e293b",
            color: "#e2e8f0",
            iconColor: "#22c55e",
            confirmButtonColor: "#6366f1",
          }).then(() => {
            datosUsuario();
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
        console.error("Error al actualizar datos:", error);
        Swal.fire({
          icon: "error",
          title: "Error de servidor",
          text: "Hubo un problema al registrar los datos.",
          confirmButtonColor: "#ef4444",
        });
      });
  }