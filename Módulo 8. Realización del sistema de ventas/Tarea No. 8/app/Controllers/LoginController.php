<?php

namespace App\Controllers;

use App\Core\Template;
use App\Helpers\Utils;

class LoginController
{
    public function handle(Template $template, $pdo)
    {
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
}
