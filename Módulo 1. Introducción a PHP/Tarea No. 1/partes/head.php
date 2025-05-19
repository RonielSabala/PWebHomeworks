<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea 1</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 0;
            margin: 0;
        }

        #mitarea1 {
            width: 80%;
            max-width: 700px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #divMenu {
            margin: 20px 0;
            background-color: black;
            padding: 2px;
            border-radius: 5px;
            color: white;
            text-align: center;
        }

        #divMenu ul {
            list-style-type: none;
            padding: 0;
        }

        #divMenu li {
            display: inline;
            margin-right: 20px;
        }

        #divMenu a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        #divMenu a:hover {
            text-decoration: underline;
            color: #ccc
        }

        #divContenido {
            min-height: 400px;
        }

        #divFooter {
            background-color: #1e1e1e;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        #divFooter p {
            margin: 0;
            font-size: 16px;
            letter-spacing: 1px;
        }

        span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="mitarea1">
        <div>
            <h1>Tarea 1</h1>
            <p>Introducción a php.</p>
        </div>
        <div id="divMenu">
            <ul>
                <li>
                    <a href="tarjeta.php">Tarjeta</a>
                </li>
                <li>
                    <a href="calculadora.php">Calculadora</a>
                </li>
                <li>
                    <a href="adivina.php">Adivina</a>
                </li>
                <li>
                    <a href="acercade.php">Acerca de</a>
                </li>
            </ul>
        </div>
        <div id="divContenido">