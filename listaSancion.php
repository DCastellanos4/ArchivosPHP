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
    <h2>Listado de Sanciones</h2>
    <?php
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
                $contenido = explode(",", $linea);
                echo "<tr>";
                foreach ($contenido as $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            fclose($fichero);
        }
        echo "</table>";
    }
    ?>
    <h2><a href="sanciona.php">[Inicio]</a></h2>
</body>

</html>
