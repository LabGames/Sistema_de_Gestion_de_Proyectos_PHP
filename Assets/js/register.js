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
