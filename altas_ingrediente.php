<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ingredientes en almacén</title>
        <link rel="stylesheet" href="estilo_altas_ingrediente.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="images/icono.png">
        <!--  <script type="text/javascript" src="sube_datos.js"></script> !-->
        
    </head>
    <body>
        
        <h1>Ingredientes en almacén</h1>
        <h3 class="subEnca">Ingredientes</h3>
        <h3 class="subEnca subEnca2">Cantidad</h3>
        <button class="boton" onclick="altas()">Añadir</button>
        <button class="boton boton2" onclick="window.location.href='index.html'">Página principal</button>
        

        <form name="f_ingrediente">
            <input name="nombre_ingr" type="text" size="30" maxlength="30" class="campo">
            <input name="cantidad_ingr" type="number" size="10" maxlength="5" class="campo camp2">
            <input type="submit" value="Submit">
        </form>

        <?php

            $nombre_ingr=$_GET['ingr_nom'];
            $cantidad_ingr=$_GET['ingr_cant'];

            function formulario(){
                global $codigo_ingr, $nombre_ingr, $cantidad_ingr;
                echo"
                <form name='f_ingrediente'>
                    <input name='nombre_ingr' type='text' size='30' maxlength='30' class='campo' value='$nombre_ingr'>
                    <input name='cantidad_ingr' type='number' size='10' maxlength='5' class='campo camp2 value='$cantidad_ingr'>
                </form>
                ";
            }

            function altas(){

                global $codigo_ingr, $nombre_ingr, $cantidad_ingr;
                $codigo_ingr=1;

                $cs = mysqli_connect("localhost","","","fabrica_galletas");
                $sql= mysqli_query($cs,"INSERT INTO ingredientes VALUES ('$codigo_ingr','$nombre_ingr','$cantidad_ingr')");
				$codigo_ingr=$codigo_ingr+1;
            }
        ?>
    </body>
</html>