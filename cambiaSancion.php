<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>cambiar sancion</h1>
    <?php
    $codigo = $_POST['codigo'];
    $cambio = $_POST['boton'];


    
    $fichero = fopen("sancionados.txt", "r+");
    $ficheroAux = fopen("aux.txt", "a+");
    if ($fichero) {
        while (($linea = fgets($fichero)) != false) {
            $contenido = explode(",", $linea);
            if ($contenido[0] == $codigo) {
                if (trim($cambio) == "Finalizar") {
                    fwrite($ficheroAux, "$contenido[0],$contenido[1],$contenido[2],$contenido[3],$contenido[4],C\n");
                } else if (trim($cambio) == "Iniciar") {
                    fwrite($ficheroAux, "$contenido[0],$contenido[1],$contenido[2],$contenido[3],$contenido[4],EP\n");
                }
            } else {
                fwrite($ficheroAux, "$contenido[0],$contenido[1],$contenido[2],$contenido[3],$contenido[4],$contenido[5]");
            }
        }
        rename("aux.txt", "sancionados.txt");
    } else {
        die("no se ha podido encontrar el fichero");
    }
    ?>
    <h2>Si ves este mensaje la sanción ha sido actualizada</h2>
    <h2><a href="sanciona.php">[Inicio]</a></h2>
</body>

</html>
