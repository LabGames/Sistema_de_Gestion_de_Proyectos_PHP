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

function registrarUsuario() {
  const name = document.getElementById("nombre").value.trim();
  const rol = 1;
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();
  const password_confirm = document.getElementById("password_confirm").value.trim();
  console.log(name)

  const formData = new FormData();
  formData.append("name", name);
  formData.append("rol", rol);
  formData.append("email", email);
  formData.append("password", password);
  formData.append('password_hash',password_confirm);

  fetch(`${BASE_URL}/Registro/Validacion`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        Swal.fire({
          icon: "success",
          title: "Registro Exitoso",
          text: "Su usuario se encuentra a la espera de ser activado.",
          background: "#1e293b",
          color: "#e2e8f0",
          iconColor: "#22c55e",
          confirmButtonColor: "#6366f1",
        }).then(() => {
          document.getElementById("formRegistrarUsuario").reset();
          window.location.href = data.redirect;
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
      console.error("Error al registrarse:", error);
      Swal.fire({
        icon: "error",
        title: "Error de servidor",
        text: "Hubo un problema al registrarse.",
        confirmButtonColor: "#ef4444",
      });
    });
}
