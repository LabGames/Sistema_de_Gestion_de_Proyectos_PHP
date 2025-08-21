async function login() {
  const email = document.querySelector("input[name='email']").value.trim();
  const password = document
    .querySelector("input[name='password']")
    .value.trim();

  if (!email || !password) {
    return Swal.fire({
      icon: "warning",
      title: "Campos vacíos",
      text: "Por favor completa todos los campos.",
    });
  }

  try {
    const formData = new FormData();
    formData.append("email", email);
    formData.append("password", password);

    const response = await fetch(`${BASE_URL}/Login/Ingresar`, {
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
        text: data.message || "Correo o contraseña incorrectos.",
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

async function logout() {
  const response = await fetch(`${BASE_URL}/Logout`, {
    method: "POST",
  });
  const data = await response.json();
  window.location.href = data.redirect;
}
