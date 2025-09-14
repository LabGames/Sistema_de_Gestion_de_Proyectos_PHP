<?php
require_once __DIR__ . "/../Models/User.php";

class UserController
{

    private $user;

    public function __construct($pdo)
    {
        $this->user = new User($pdo);
    }

    public function index()
    {
        $view = __DIR__ . "/../Views/usuarios/index.php";
        include __DIR__ . "/../Views/home/index.php";
    }

    public function listar()
    {
        $usuarios = $this->user->getAll();
        echo json_encode($usuarios);
    }

    public function obtenerUsuario()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo json_encode(["success" => false, "message" => "ID no recibido"]);
            return;
        }

        $usuario = $this->user->findById($id);

        if ($usuario) {
            echo json_encode($usuario);
        } else {
            echo json_encode(["success" => false, "message" => "Usuario no encontrado"]);
        }
    }


    public function registrar()
    {
        $name     = $_POST['name'] ?? null;
        $rol      = $_POST['rol'] ?? null;
        $email    = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $estado   = 0;

        $errores = [];

        if (empty($name)) {
            $errores[] = "El nombre es obligatorio";
        }
        if (empty($rol)) {
            $errores[] = "El rol es obligatorio";
        }
        if (empty($email)) {
            $errores[] = "El correo es obligatorio";
        }
        if (empty($password)) {
            $errores[] = "La contraseña es obligatoria";
        }
        $userVerify = $this->user->findByEmail($email);
        if ($userVerify) {
            $errores[] = "Este correo ya esta registrado";
        }

        if (!empty($errores)) {
            echo json_encode([
                "success" => false,
                "message" => $errores
            ]);
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $resultado = $this->user->create($name, $rol, $email, $hashedPassword, $estado);

        if ($resultado) {
            echo json_encode([
                "success" => true,
                "message" => "Usuario registrado correctamente"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => ["Error al registrar usuario"]
            ]);
        }
    }


    public function actualizar()
    {
        $id       = $_POST['id'] ?? null;
        $name     = $_POST['name'] ?? null;
        $rol      = $_POST['rol'] ?? null;
        $email    = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $errores = [];

        if (empty($id)) {
            $errores[] = "No se encontro el id";
        }
        if (empty($name)) {
            $errores[] = "El nombre es obligatorio";
        }
        if (empty($rol)) {
            $errores[] = "El rol es obligatorio";
        }
        if (empty($email)) {
            $errores[] = "El correo es obligatorio";
        }

        if (!empty($errores)) {
            echo json_encode([
                "success" => false,
                "message" => $errores
            ]);
            return;
        }

        $hashedPassword = null;
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        }

        $resultado = $this->user->update($id, $name, $rol, $email, $hashedPassword);

        if ($resultado) {
            echo json_encode([
                "success" => true,
                "message" => "Usuario actualizado correctamente"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Error al actualizar usuario"
            ]);
        }
    }

    public function actualizarDatos()
    {
        $id       = $_SESSION["user_id"];
        $name     = $_POST['name'] ?? null;
        $email    = $_POST['email'] ?? null;
        $rol      = $_SESSION["rol_id"];
        $password = $_POST['password'] ?? null;
        $errores = [];

        if (empty($name)) {
            $errores[] = "El nombre es obligatorio";
        }
        if (empty($email)) {
            $errores[] = "El correo es obligatorio";
        }
        if(!empty($password) && $password < 8){
            $errores[] = "La contraseña debe tener minimo 8 digitos";
        }


        if (!empty($errores)) {
            echo json_encode([
                "success" => false,
                "message" => $errores
            ]);
            return;
        }

        $hashedPassword = null;
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        }

        $resultado = $this->user->update($id, $name, $rol, $email, $hashedPassword);

        if ($resultado) {
            echo json_encode([
                "success" => true,
                "message" => "Datos actualizados correctamente"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Error al actualizar datos"
            ]);
        }
    }

    public function eliminar()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo json_encode([
                "success" => false,
                "message" => "ID no recibido"
            ]);
            return;
        }

        $resultado = $this->user->delete($id);

        if ($resultado) {
            echo json_encode([
                "success" => true,
                "message" => "Usuario eliminado correctamente"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "No se pudo eliminar el usuario"
            ]);
        }
    }

    public function activar()
    {
        $id = $_POST['id'] ?? null;
        if ($this->user->activar($id)) {
            echo json_encode([
                "success" => true,
                "message" => "El usuario fue activado correctamente"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "No se pudo activar el usuario"
            ]);
        }
    }

    public function inhabilitar()
    {
        $id = $_POST['id'] ?? null;

        if ($this->user->inhabilitar($id)) {
            echo json_encode([
                "success" => true,
                "message" => "El usuario fue inhabilitado correctamente"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "No se pudo inhabilitar el usuario"
            ]);
        }
    }
}
