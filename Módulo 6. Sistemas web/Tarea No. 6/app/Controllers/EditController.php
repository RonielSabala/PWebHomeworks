<?php

namespace App\Controllers;

use App\Core\Template;
use function App\Helpers\{showAlert, modifyCharacter, getCharacterById};

class EditController
{
    public function handle(Template $template, $pdo)
    {
        // Obtener los datos del formulario
        if ($_POST) {
            $id = intval($_POST['id']);
            $nombre = trim($_POST['nombre']);
            $color = trim($_POST['color']);
            $tipo = trim($_POST['tipo']);
            $nivel = intval($_POST['nivel']);
            $foto = trim($_POST['foto']);

            if (empty($id)) {
                // Crear un nuevo personaje
                $sql = "INSERT INTO personajes (nombre, color, tipo, nivel, foto) VALUES (?, ?, ?, ?, ?)";
                $params = [$nombre, $color, $tipo, $nivel, $foto];
            } else {
                // Actualizar el personaje
                $sql = "UPDATE personajes SET nombre = ?, color = ?, tipo = ?, nivel = ?, foto = ? WHERE id = ?";
                $params = [$nombre, $color, $tipo, $nivel, $foto, $id];
            }

            if (!modifyCharacter($pdo, $sql, $params)) {
                exit;
            }

            $template->apply('home', [
                'pdo' => $pdo,
            ]);

            exit;
        }

        // Obtener el ID del personaje a editar
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $character = getCharacterById($pdo, $id);
        }

        // ID invalido
        if (isset($id) && $character == null) {
            showAlert('Personaje no encontrado!', 'danger');
            exit;
        }

        $template->apply('edit', [
            'id'   => $id ?? '',
            'nombre' => $character->nombre ?? '',
            'color' => $character->color ?? '',
            'tipo' => $character->tipo ?? '',
            'nivel' => $character->nivel ?? 0,
            'foto' => $character->foto ?? '',
        ]);
    }
}
