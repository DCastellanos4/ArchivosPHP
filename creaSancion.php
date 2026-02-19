<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Gestión de sanciones</h1>
    <hr>
    <?php
    echo "<form action='creaSancion.php' method='post'>";
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
    echo "<br>";
    echo "Tipo de falta:";
    echo "<br>";
    echo "Leve <input type='radio' name='tipo' value='L' checked>";
    echo " Grave <input type='radio' name='tipo' value='G'>";
    echo " Muy Grave <input type='radio' name='tipo' value='MG'>";
    echo "<br>";
    echo "Sanción: <input type='text' name='sancion'>";
    if (empty($_POST['sancion']) && isset($_POST['enviar'])) {
        echo "<p style='color:red'>Rellena el campo matricula</p>";
    }
    echo "<br><br>";
    echo "<input type='submit' value='Crear Sancion' name='enviar'>";
    echo "</form>";
    if (!empty($_POST['sancion'])) {
        creaSolicitud("sancionados", $_POST['nombre'], $_POST['tipo'], $_POST['sancion']);
        header("location: sanciona.php");
    }

    //BLOQUE DE GESTION DE DATOS E INSERCION DENTRO DE FICHEROS
    function creaSolicitud($nombreArchivo, $nombre, $falta, $sancion)
    { //SUDO CHMOD 777 [nombreFichero/Directorio]
        $nombreArchivo = $nombreArchivo . ".txt";
        $file = fopen($nombreArchivo, "a+");
        if ($file === false) {
            echo "<p>Error: no se pudo crear o abrir el archivo.</p>";
            return;
        }
        $codigo = 1;
        $fecha = date("Y-m-d");
        if (!$file) {
            fwrite($file, "$codigo,$nombre,$fecha,$falta,$sancion,P\n");
        } else {
            while (($linea = fgets($file)) != false) {
                $contenido = explode("|", $linea);
                $codigo++;
            }
            fwrite($file, "$codigo,$nombre,$fecha,$falta,$sancion,P\n");
        }
        //CODIGO,APELLIDOS Y NOMBRE,FECHA,SANCIÓN,ESTADO
        fclose($file);
    }
    ?>
</body>

</html>
