document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form-proyecto");
    const BASE_URL = form.dataset.baseUrl;
    if (!form) return;
    const button = form.querySelector(".btn-style");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        if (!form.checkValidity()) {
            button.classList.add("error");
            setTimeout(() => button.classList.remove("error"), 1000);
            return;
        }

        button.classList.add("rainbow");

        const formData = new FormData(form);

        try {
            const response = await fetch(BASE_URL + "/Guardando_Proyecto", {
                method: "POST",
                body: formData
            });

            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Proyecto registrado correctamente',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = BASE_URL + "/Home/Proyectos";
                });
            } else {
                button.classList.add("error");
                setTimeout(() => button.classList.remove("error"), 1000);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo guardar el proyecto',
                    confirmButtonColor: '#d33'
                });
            }
        } catch (err) {
            button.classList.add("error");
            setTimeout(() => button.classList.remove("error"), 1000);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un problema al conectar con el servidor',
                confirmButtonColor: '#d33'
            });
        } finally {
            button.classList.remove("rainbow");
        }
    });
});
