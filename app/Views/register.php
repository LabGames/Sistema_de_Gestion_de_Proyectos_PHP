<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Empresa X</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <script src="<?= BASE_URL ?>/Assets/js/register.js"></script>
    <script>
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section class="register-page">
        <div class="register-glow"></div>
        <form class="register-card">
            <header class="register-header">
                <h1>Crear cuenta</h1>
                <p>Regístrate para gestionar tus proyectos.</p>
            </header>

            <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
            <div class="field">
                <label>Nombre completo</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-user input-icon"></i>
                    <input
                        type="text"
                        placeholder="Tu nombre"
                        name="name" required />
                </div>
            </div>

            <div class="field">
                <label>Correo</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope input-icon"></i>
                    <input
                        type="email"
                        placeholder="tu@correo.com"
                        name="email" required />
                </div>
            </div>

            <div class="field">
                <label>Contraseña</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input
                        type="password"
                        placeholder="Mínimo 8 caracteres"
                        name="password"
                        id="password" required />
                    <i class="fa-solid fa-eye toggle-password" data-target="password"></i>
                </div>
            </div>

            <div class="password-strength" id="password-strength">
                <span class="password-bar"></span>
                <span class="password-bar"></span>
                <span class="password-bar"></span>
                <span id="strength-text"></span>
            </div>

            <div class="field">
                <label>Confirmar contraseña</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input
                        type="password"
                        placeholder="Repite la contraseña"
                        name="password_confirm"
                        id="password_confirm" required />
                    <i class="fa-solid fa-eye toggle-password" data-target="password_confirm"></i>
                </div>
            </div>


            <label class="check">
                <input
                    type="checkbox" required />
                <span>
                    Acepto los <a href="" class="link">términos y condiciones</a>.
                </span>
            </label>
            <button class="btn-submit" type="button" onclick="register()">
                <i class="fa-solid fa-check"></i>
                <span>Registrarme</span>
            </button>

            <p class="alt">
                ¿Ya tienes cuenta? <a class="link" href="<?= BASE_URL ?>/Login">Inicia sesión</a>
            </p>
        </form>
    </section>
</body>

</html>