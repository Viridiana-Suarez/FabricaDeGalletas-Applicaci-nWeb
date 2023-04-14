<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Preparación</title>
        <link rel="stylesheet" href="estilo_preparacion_nuevo.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="images/icono.png">
    </head>
    <body>
        <h1>Proceso de fabricación</h1>
        
        <?php
            $nombre_formula=$_GET['tipoGalleta'];
            $cantidad_form=$_GET['cant_re'];
            global $form_ingr, $form_cant, $dispo;
            

            echo "<h2>$nombre_formula</h2>";

            require("conectar.php");
            $connexion = mysqli_connect("localhost","root","");

            if( mysqli_connect_errno()){
                echo "Hubo un problema con la base de datos error al conectar";
                exit() ;
            }
            
            mysqli_select_db($connexion,"fabrica_galletas") or die ("No se encuentra la Base de datos");
            mysqli_set_charset($connexion,"utf8");

            formulario();

            function formulario(){
                global $nombre_formula, $connexion, $cantidad_form;
                $continuar = TRUE;

                $q="SELECT * FROM formulas WHERE form_nom='$nombre_formula'";
                $sql=mysqli_query($connexion,$q);
                echo ' <div style = "width: 79%; height: 250px; line-height: 3em; overflow:auto; border: thin #000 solid; padding: 5px; background-color: white; position:relative; top: -28px; left: 136px;">
                    <form action="restar_ingre.php" name="f_ingrediente" method="get">
                        <table border="3" width="100%" style="background-color: pink">
                            <tr>
                                <td><b>Ingrediente</b></td>
                                <td><b>Cantidad por unidad</b></td>
                                <td><b>Estatus</b></td>
                            </tr>';

                            while ($reg=mysqli_fetch_object($sql)){
                                echo "<tr>
                                    <td>$reg->form_ingr</font></td>
                                    <td>$reg->form_cant</font></td>";
                                    $existencias = disponibles($reg->form_ingr);
                                    if(($reg->form_cant)*$cantidad_form > $existencias){
                                        echo"<td>Insuficiente</td>";
                                        $continuar = FALSE;
                                    } else{
                                        echo"<td>Suficiente</td>";
                                    }
                                echo"</tr>";
                            }

                    echo '</table> </div>';

                    echo'
                    <input name="cant_re" type="number" size="10" class="campo" style="display:none;" value="'; echo $cantidad_form,'">
                    <input name="nom_re" type="text" size="10" class="campo" style="display:none;" value="'; echo $nombre_formula,'">
                    ';

                    if($continuar==TRUE){
                        echo '<input type="submit" value="Continuar" name="Cocinar" class="button">';
                    } 

                echo'</form>';

            }

            

            function disponibles($dispo){
                global $connexion;
                $q="SELECT * FROM ingredientes WHERE ingr_nom='$dispo'";
                $sql=mysqli_query($connexion,$q);
                $reg=mysqli_fetch_array($sql);

                if ($reg!=mysqli_fetch_object($sql)){
                    $almacen = $reg[1];
                    return $almacen;
                } else {
                    return 0;
                }

            }
        ?>

        <button class="button button2" onclick="window.location.href='index.html'">Página principal</button>

    </body>
</html>