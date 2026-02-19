<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Listado de sanciones por alumno</h2>
    <form method="post" action="sancionAlumno.php">
        <?php
        echo "Alumno: <select name='nombre'>";
        $alumnos = fopen("alumnos.txt", "r");
        if (!$alumnos) {
            die("No se ha podido leer el fichero");
        }
        while (($linea = fgets($alumnos)) != false) {
            $contenido = explode(",", $linea);
            echo "<option value='{$contenido[0]}'>{$contenido[0]} {$contenido[1]}</option>";
            //echo "<option value=$opcion>$opcion</option>";
        }
        echo "</select>";
        fclose($alumnos);
        echo "<br><br>";
        echo "<input type='submit' value='Listar Sanciones' name='enviar'>"
        ?>
    </form>
    <h2><a href="sanciona.php">[Inicio]</a></h2>
</body>

</html>
