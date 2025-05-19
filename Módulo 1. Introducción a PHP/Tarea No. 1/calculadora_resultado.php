<?php
$num1 = $_GET["num1"];
$num2 = $_GET["num2"];
$operacion = $_GET["operacion"];
$resultado = 0;
switch ($operacion) {
    case "suma":
        $resultado = $num1 + $num2;
        break;
    case "resta":
        $resultado = $num1 - $num2;
        break;
    case "multiplicacion":
        $resultado = $num1 * $num2;
        break;
    case "division":
        if ($num2 != 0) {
            $resultado = $num1 / $num2;
        } else {
            $resultado = "Error: División por cero.";
        }
        break;
    default:
        echo "Operación no válida.";
        exit();
}

if (is_numeric($resultado)) {
    $resultado = number_format($resultado, 2);
}

require("partes/head.php");
?>

<h2>Resultado de la calculadora:</h2>
<p>El resultado de la <?php echo $operacion; ?> entre <?php echo $num1; ?> y <?php echo $num2; ?> es: <?php echo $resultado; ?> </p>

<a href="calculadora.php">⬅ Volver a la calculadora</a>

<?php require("partes/foot.php"); ?>