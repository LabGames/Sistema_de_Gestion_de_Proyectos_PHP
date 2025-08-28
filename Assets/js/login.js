function login() {
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (!email || !password) {
    Swal.fire({
      icon: "warning",
      title: "Campos incompletos",
      text: "Todos los campos son obligatorios.",
      background: "#1e293b",
      color: "#e2e8f0",
      iconColor: "#facc15",
      confirmButtonColor: "#6366f1",
      customClass: {
        title: "swal-title",
        popup: "swal-popup",
        confirmButton: "swal-confirm",
      },
    });
    return;
  }

  const formData = new FormData();
  formData.append("email", email);
  formData.append("password", password);

  fetch(`${BASE_URL}/Login/Ingresar`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        window.location.href = data.redirect;
      } else {
        Swal.fire({
          icon: "warning",
          title: data.message,
          background: "#1e293b",
          color: "#e2e8f0",
          iconColor: "#facc15",
          confirmButtonColor: "#6366f1",
          customClass: {
            title: "swal-title",
            popup: "swal-popup",
            confirmButton: "swal-confirm",
          },
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

async function logout() {
  const response = await fetch(`${BASE_URL}/Logout`, {
    method: "POST",
  });
  const data = await response.json();
  window.location.href = data.redirect;
}
