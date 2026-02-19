<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
    <?php
    $nombreAlum = $_POST['nombre'];
    $fichero = fopen("sancionados.txt", "r");
    if (!$fichero) {
        die("No hay sanciones registradas");
    } else {
        echo "<table style='border: 1px';>";
        echo "<tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Tipo Sanción</th>
            <th>Sanción</th>
            <th>Estado</th>
        </tr>";

        if ($fichero) {
            while (($linea = fgets($fichero)) != false) {
                if (stripos($linea, $nombreAlum)) {
                    $contenido = explode(",", $linea);
                    echo "<tr>";
                    foreach ($contenido as $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "<form method='post' action='cambiaSancion.php'>";
                    echo "<input type='hidden' name='codigo' value='$contenido[0]'>";
                    echo "<input type='hidden' name='nombre' value='$contenido[1]'>";
                    if (trim($contenido[5]) == "EP") {
                        echo "<td><input type='submit' value='Finalizar' name='boton'></td>";
                    }
                    if (trim($contenido[5]) == "P") {
                        echo "<td><input type='submit' value='Iniciar' name='boton'></td>";
                    }
                    echo "</form>";
                    echo "</tr>";
                }
            }
            fclose($fichero);
        }
        echo "</table>";
    }
    ?>
    <h2><a href="sanciona.php">[Inicio]</a></h2>
</body>

</html>
