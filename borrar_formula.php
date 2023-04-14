<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Borrar Fórmula</title>
        <link rel="stylesheet" href="estilo_altas_formula_nuevo1.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="images/icono.png">
    </head>

    <body>

        <button class="button button3" onclick="window.location.href='index.html'">Página principal</button>

        <?php
            $formula_nom = $_GET["nom_re"];

            require("conectar.php");

            $connexion = mysqli_connect("localhost","root","");
                
            if( mysqli_connect_errno()){
                echo "Hubo un problema con la base de datos error al conectar";
                exit() ;
            }

            mysqli_select_db($connexion,"fabrica_galletas") or die ("No se encuentra la Base de datos");
            mysqli_set_charset($connexion,"utf8");

            $instruccion_SQL1 = "SELECT * FROM formulas WHERE form_nom='$formula_nom'";
            $resultado1 = mysqli_query($connexion,$instruccion_SQL1);
            $reg=mysqli_fetch_array($resultado1);

            if ($reg==mysqli_fetch_object($resultado1)){
                $msg="La fórmula no existe en la base de datos";
            }else{
                $msg="La formula se eliminó con éxito";
            }

            $instruccion_SQL = "DELETE FROM formulas WHERE form_nom='$formula_nom'";
            $resultado = mysqli_query($connexion,$instruccion_SQL);
            mysqli_close($connexion);
            

            formulario();

            function formulario(){
                global $msg;
                echo'
                    <h1 class="titulo">Administración de fórmulas</h1>
                    <h2>Nombre de la receta:</h2>
                    <h3 class="subEnca">Ingredientes</h3>
                    <h3 class="subEnca subEnca2">Cantidad</h3>
                    
                    <form name="f_formulas" method="get">
                        <input name="nom_re" type="text" size="40" class="camp">
                        <input name="ingr_re" type="text" size="25" class="campo">
                        <input name="cant_re" type="number" size="10" class="campo camp2">
                        <div id="archivo" class="historial">'; echo $msg,'</div>
                        <input type="submit" value="Nuevo ingrediente" formaction="modificar_formula.php" name="Agregar" class="button button2">
                        <input type="submit" value="Borrar fórmula" formaction="borrar_formula.php" class="button" >
                    </form>
                ';
            }
            
            #header('Location: altas_formula.html');

        ?>
            
    </body>

</html>