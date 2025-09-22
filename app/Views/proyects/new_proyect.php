<link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/proyects/popup.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
<script src="<?= BASE_URL ?>/Assets/js/load_button.js"></script>
<script src="<?= BASE_URL ?>/Assets/js/date_system.js"></script>

<button id="openForm">Nuevo Proyecto</button>

<script>
document.getElementById("openForm").addEventListener("click", function () {
    Swal.fire({
        title: "NUEVO PROYECTO",
        width: "60%",
        html: `
            <div class="swal-form">
                <form id="form-proyecto" enctype="multipart/form-data">
                    <label class="mini-title">Nombre del Proyecto:</label><br>
                    <input type="text" name="project_name" required><br><br>

                    <label class="mini-title">Tipo de Proyecto:</label><br>
                    <select name="project_type" required>
                        <?php foreach ($tipos_value as $tipo): ?>
                            <option value="<?= $tipo['id'] ?>"><?= htmlspecialchars($tipo['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select><br><br>

                    <label class="mini-title">Asociar Colaboradores:</label><br>
                    <select name="collab-asso" required>
                        <?php foreach ($clientes_value as $cliente): ?>
                            <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nombre_cliente']) ?></option>
                        <?php endforeach; ?>
                    </select><br><br>

                    <label class="mini-title">Estado:</label><br>
                    <select name="state" required>
                        <?php foreach ($estados_value as $estado): ?>
                            <option value="<?= $estado['id'] ?>"><?= htmlspecialchars($estado['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select><br><br>

                    <label class="mini-title">Comentario:</label><br>
                    <textarea name="forecast_comment" required></textarea><br><br>

                    <label class="mini-title">Ingresos Estimados:</label><br>
                    <input type="number" name="estimated_income" required><br><br>

                    <button type="submit" class="btn-style">Registrar Proyecto</button>
                </form>
            </div>
        `,
        showConfirmButton: false,
    });

    document.getElementById("form-proyecto").addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch("<?= BASE_URL ?>/Guardando_Proyecto", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            Swal.fire({
                icon: "success",
                title: "Guardado",
                text: "El proyecto fue registrado con éxito"
            }).then(() => {
                location.reload();
            });
        })
        .catch(err => {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "No se pudo guardar el proyecto"
            });
        });
    });
});
</script>
