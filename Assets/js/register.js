document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".toggle-password").forEach((icon) => {
    icon.addEventListener("click", () => {
      const targetId = icon.getAttribute("data-target");
      const input = document.getElementById(targetId);

      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    });
  });

  const passwordInput = document.getElementById("password");
  const strengthBars = document.querySelectorAll("#password-strength span");
  const strengthText = document.getElementById("strength-text");

  passwordInput.addEventListener("input", () => {
    const val = passwordInput.value;
    let strength = 0;

    if (val.length >= 6) strength++;
    if (/[A-Z]/.test(val)) strength++;
    if (/[0-9]/.test(val)) strength++;
    if (/[^A-Za-z0-9]/.test(val)) strength++;
    if (val.length >= 10) strength++;

    strengthBars.forEach((bar) => (bar.style.background = ""));

    if (strength <= 2) {
      strengthBars[0].style.background = "#ff4d4d";
      strengthText.textContent = "Contraseña débil";
      strengthText.style.color = "#ff4d4d";
    } else if (strength === 3) {
      strengthBars[0].style.background = "#ffcc00";
      strengthBars[1].style.background = "#ffcc00";
      strengthText.textContent = "Contraseña media";
      strengthText.style.color = "#ffcc00";
    } else if (strength >= 4) {
      strengthBars[0].style.background = "#00cc66";
      strengthBars[1].style.background = "#00cc66";
      strengthBars[2].style.background = "#00cc66";
      strengthText.textContent = "Contraseña fuerte";
      strengthText.style.color = "#00cc66";
    } else {
      strengthText.textContent = "";
    }
  });
});

async function register() {
  const name = document.querySelector("input[name='name']").value.trim();
  const email = document.querySelector("input[name='email']").value.trim();
  const password = document
    .querySelector("input[name='password']")
    .value.trim();
  const password_confirm = document
    .querySelector("input[name='password_confirm']")
    .value.trim();

  if (!email || !password || !name || !password_confirm) {
    return Swal.fire({
      icon: "warning",
      title: "Campos vacíos",
      text: "Por favor completa todos los campos.",
    });
  }

  try {
    const formData = new FormData();
    formData.append("name", name);
    formData.append("email", email);
    formData.append("password", password);
    formData.append("password_confirm", password_confirm);

    const response = await fetch(`${BASE_URL}/Registro/Crear`, {
      method: "POST",
      body: formData,
    });

    const data = await response.json();

    if (data.success) {
      window.location.href = data.redirect;
    } else {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: data.error,
      });
    }
  } catch (error) {
    console.error("Error:", error);
    Swal.fire({
      icon: "error",
      title: "Error del servidor",
      text: "Intenta nuevamente más tarde.",
    });
  }
}

function registrarUsuario() {
  const name = document.getElementById("name").value.trim();
  const rol = 1;
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();
  const password_confirm = document
    .getElementById("password_confirm")
    .value.trim();

  if (!name || !rol || !email || !password) {
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
  } else if (password_confirm != password) {
    Swal.fire({
      icon: "warning",
      title: "Las contraseñas no coinciden",
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
          title: "Registro Completo",
          text: "Tu cuenta se encuentra a la espera de ser activada.",
          background: "#1e293b",
          color: "#e2e8f0",
          iconColor: "#22c55e",
          confirmButtonColor: "#6366f1",
          customClass: {
            title: "swal-title",
            popup: "swal-popup",
            confirmButton: "swal-confirm",
          },
        }).then(() => {
          document.getElementById("formRegistrarUsuario").reset();
          listar();
        });
      } else {
        console.log("Error: " + data.message);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: data.message || "No se pudo registrar el usuario",
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
