<?php

namespace App\Controllers;

use App\Core\Template;
use App\Helpers\Utils;

class LoginController
{
    public function handle(Template $template, $pdo)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_GET['logout'])) {
            self::logout();
            session_start();
            header('Location: /login.php');
            exit;
        }

        if ($_POST) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $user = Utils::getUserPassByName($pdo, $username);

            // Validar usuario
            if (!$user || $password != $user->user_password) {
                Utils::showAlert("Contraseña incorrecta!", "danger", "login.php");
                exit;
            }

            // Guardar usuario en sesión
            $_SESSION['user'] = $username;
            header('Location: /home.php');
            exit;
        }

        $template->apply('login');
    }

    public static function logout()
    {
        // Limpiar todas las variables de sesión
        $_SESSION = [];

        // Eliminar la cookie de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
    }
}
