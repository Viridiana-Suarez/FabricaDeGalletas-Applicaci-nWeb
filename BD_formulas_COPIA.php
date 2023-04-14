<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Altas Fórmula</title>
        <link rel="stylesheet" href="estilo_altas_formula.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="images/icono.png">
    </head>

    <body>
        
        <?php
            $ingr_nom = $_GET["ingr_re"];
            $ingr_cant = $_GET["cant_re"];
            $formula_nom = $_GET["nom_re"];

            require("conectar.php");
            $connexion = mysqli_connect("localhost","root","");
            
            if( mysqli_connect_errno()){
                echo "Hubo un problema con la base de datos error al conectar";
                exit() ;
            }
            
            mysqli_select_db($connexion,"fabrica_galletas") or die ("No se encuentra la Base de datos");
            mysqli_set_charset($connexion,"utf8");

            $instruccion_SQL = "INSERT INTO formulas (form_nom, form_ingr, form_cant) VALUES ('$formula_nom','$ingr_nom', '$ingr_cant')";
            $resultado = mysqli_query($connexion,$instruccion_SQL);

            formulario($formula_nom);
            
            function formulario($formula_nom){
                global $ingr_nom, $ingr_cant, $formula_nom,$connexion;

                $q="SELECT * FROM formulas WHERE form_nom='$formula_nom'";
                $sql=mysqli_query($connexion,$q);

                echo'

                    <h1 class="titulo titPHP">Alta de nueva fórmula</h1>
                    <h2>Nombre de la receta:</h2>
                    <h3 class="subEnca">Ingredientes</h3>
                    <h3 class="subEnca subEnca2">Cantidad</h3>

                    <form name="f_formulas" method="get">
                        <input name="nom_re" type="text" size="40" class="camp campPHP" value="'; echo $formula_nom,'">
                        <input name="ingr_re" type="text" size="25" class="campo ingrePHP">
                        <input name="cant_re" type="number" size="10" class="campo camp2 ingrePHP">
                        <div id="archivo" class="historial histoPHP">
                            <table border="3" width="100%" style="background-color: pink">
                                <tr>
                                    <td><b>Ingrediente</b></td>
                                    <td><b>Cantidad</b></td>
                                </tr>';
                                while ($reg=mysqli_fetch_array($sql)){
                                    echo '
                                    <tr>
                                        <td>'; echo $reg[1],'</font></td>
                                        <td>'; echo $reg[2],'</font></td>
                                    </tr>';
                                }
                        echo '</table></div>
                        <input type="submit" value="Nuevo ingrediente" name="Agregar" class="button button2PHP">
                    </form>
                ';
                mysqli_close($connexion);
            }


        ?>

        <button class="button buttonPHP">¡Hecho!</button>
        <button class="button button3 button3PHP" onclick="window.location.href='index.html'">Página principal</button>

    </body>
</html>