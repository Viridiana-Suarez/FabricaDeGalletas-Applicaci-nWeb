<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Producción</title>
        <link rel="stylesheet" href="estilo_fabrica_nuevo1.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="images/icono.png">
    </head>
    <body>
        <h1>Bienvenido a producción</h1>
        <h3 class="subEnca">Tipo de galleta a preparar</h3>
        <h3 class="subEnca sub2">Cantidad</h3>
        
        <button class="button b2" onclick="window.location.href='index.html'">Página principal</button>

            <?php
                require("conectar.php");
                $connexion = mysqli_connect("localhost","root","");
    
                if( mysqli_connect_errno()){
                    echo "Hubo un problema con la base de datos error al conectar";
                    exit() ;
                }
                
                mysqli_select_db($connexion,"fabrica_galletas") or die ("No se encuentra la Base de datos");
                mysqli_set_charset($connexion,"utf8");
                inventario_form();

                function inventario_form(){
                    global $connexion;
                    $q="SELECT * FROM formulas";
                    $sql=mysqli_query($connexion,$q);
                    $formula=" ";

                    echo' <form name="f_galleta" method="get" action="disponibilidad.php">
                        <select name="tipoGalleta" id="tipoGalleta" class="tiposGalleta">';
                            while ($reg=mysqli_fetch_object($sql)){
                                if ($formula!=$reg->form_nom){
                                        
                                    echo'<option value="'; echo $reg->form_nom,'">'; echo $reg->form_nom,' </option>';
                                    $formula=$reg->form_nom;
                                        
                                }
                            }
                        echo'</select>
                        <input name="cant_re" type="number" size="10" maxlength="4" class="campo">
                        <input type="submit" value="Preparar" class="button">
                    </form>';

                }
                mysqli_close($connexion);
            ?>
    </body>
</html>