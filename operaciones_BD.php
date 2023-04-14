<!DOCTYPE html>

<html>

    <head> 
        <meta charset="utf-8">
        <title>Ingredientes en almacén</title>
        <link rel="stylesheet" href="estilo_altas_ingrediente.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="images/icono.png">
    </head>

    <body>
                    
        <?php

            $ingr_nom = $_GET["nombre_ingr"] ;
            $ingr_cant = $_GET["cantidad_ingr"] ;

            require("conectar.php");
            $connexion = mysqli_connect("localhost","root","");

            if( mysqli_connect_errno()){
                echo "Hubo un problema con la base de datos error al conectar";
                exit() ;
            }
            
            mysqli_select_db($connexion,"fabrica_galletas") or die ("No se encuentra la Base de datos");
            mysqli_set_charset($connexion,"utf8");

            $q="SELECT * FROM ingredientes WHERE ingr_nom='$ingr_nom'";
            $sql=mysqli_query($connexion,$q);
            $reg=mysqli_fetch_array($sql);

            if ($reg!=mysqli_fetch_object($sql)){
                $cantidadNew=$ingr_cant+$reg[1];
                $modifica = "UPDATE ingredientes SET ingr_cant='$cantidadNew' WHERE ingr_nom='$ingr_nom'";
                $sql=mysqli_query($connexion,$modifica);
                mysqli_close($connexion);
            } else{
                $instruccion_SQL = "INSERT INTO ingredientes (ingr_nom, ingr_cant) VALUES ('$ingr_nom','$ingr_cant')";
                $resultado = mysqli_query($connexion,$instruccion_SQL);

                if($resultado == FALSE){
                    echo "error en la consulta";
                } 

                mysqli_close($connexion);
            }

            formulario();

            function formulario(){
                global $ingr_cod, $ingr_nom, $ingr_cant;
                echo"
                    <h1>Ingredientes en almacén</h1> 
                    <h3 class='subEnca'>Ingredientes</h3>
                    <h3 class='subEnca subEnca2'>Cantidad</h3>
                    
                    <form action='operaciones_BD.php' name='f_ingrediente' method='get'>
                        <input name='nombre_ingr' type='text' size='30' maxlength='30' class='campo campPHP'>
                        <input name='cantidad_ingr' type='number' size='10' maxlength='5' class='campo campPHP2'>
                        <input type='submit' value='Agregar' name='Agregar' class='boton botonPHP'>
                    </form>
                ";
            }
        ?>

        <button class="boton boton2PHP" onclick="window.location.href='index.html'">Página principal</button>

    </body>
</html>