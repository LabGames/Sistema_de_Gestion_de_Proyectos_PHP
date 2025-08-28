<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa X</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/Assets/styles/login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
    <script src="<?= BASE_URL ?>/Assets/js/login.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
</head>

<body>
    <section class="login-page">
        <div class="login-glow"></div>
        <form class="login-card">
            <header class="login-header">
                <h1>Iniciar sesión</h1>
                <p>Bienvenido(a). Ingresa tus credenciales.</p>
            </header>
            <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
            <div class="field">
                <label>Correo</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope input-icon"></i>
                    <input
                        name="email"
                        type="email"
                        placeholder="tu@correo.com"
                        required />
                </div>
            </div>
            <div class="field">
                <label htmlFor="password">Contraseña</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input
                        name="password"
                        type="password"
                        placeholder="********"
                        required />
                </div>
            </div>
            <div class="row-between">
                <label class="check">
                    <input
                        type="checkbox" />
                    <span>Recuérdame</span>
                </label>
                <a class="link" href="">¿Olvidaste tu contraseña?</a>
            </div>
            <button class="btn-login" type="button" onclick="login()">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Entrar</span>
            </button>
            <p class="alt">
                ¿No tienes cuenta? <a class="link" href="<?= BASE_URL ?>/Registro">Crear cuenta</a>
            </p>
        </form>
    </section>
</body>

</html>