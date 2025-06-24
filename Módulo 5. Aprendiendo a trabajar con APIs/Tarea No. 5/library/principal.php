<?php
include("plantilla.php");

function showAlert($mensaje, $tipo = "success", $ruta_final = "index.php")
{
    echo "
    <div class='text-center'>
        <div class='alert alert-$tipo'>$mensaje</div>
        <a href='$ruta_final' class='btn btn-primary'>Volver</a>
    </div>
    ";
}

function fetchApiData($apiUrl)
{
    // Iniciar cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    if ($response === false) {
        $error = "Error cURL: " . curl_error($ch);
        curl_close($ch);
        return array(null, $error);
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpCode >= 200 && $httpCode < 300) {
        $data = json_decode($response, true);
        if ($data === null) {
            $error = "La respuesta no es JSON válido.";
            curl_close($ch);
            return array(null, $error);
        }

        curl_close($ch);
        return array($data, null);
    }

    $error = "La API respondió con código HTTP $httpCode. Contenido: $response";
    curl_close($ch);
    return array(null, $error);
}
