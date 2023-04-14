<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Almacén</title>
        <link rel="stylesheet" href="estilo_almacen.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="images/icono.png">
    </head>
    <body>
        <h1>Bienvenido al almacén</h1>
        <h4>Listado de ingredientes</h4>
        <h4>Listado de fórmulas</h4>

        <button class="button" onclick="window.location.href='altas_ingrediente.html'">Administrar ingredientes</button>
        <button class="button button2" onclick="window.location.href='altas_formula.html'">Administrar fórmulas</button>
        <button class="button button3" onclick="window.location.href='index.html'">Página principal</button> 


        <?php
            require("conectar.php");
            $connexion = mysqli_connect("localhost","root","");

            if( mysqli_connect_errno()){
                echo "Hubo un problema con la base de datos error al conectar";
                exit() ;
            }
            
            mysqli_select_db($connexion,"fabrica_galletas") or die ("No se encuentra la Base de datos");
            mysqli_set_charset($connexion,"utf8");

            inventario_ingr();
            inventario_form();

            function inventario_ingr(){
                global $connexion;
                $q="SELECT * FROM ingredientes";
                $sql=mysqli_query($connexion,$q);

                echo '<div style = "width: 37%; height: 250px; line-height: 3em; overflow:auto; border: thin #000 solid; padding: 5px; background-color: white; position:relative; top: -180px; left: 155px;">
                        <table border="3" width="100%" style="background-color: pink">
                            <tr>
                                <td><b>Ingrediente</b></td>
                                <td><b>Cantidad</b></td>
                            </tr>';

                        while ($reg=mysqli_fetch_object($sql)){
                            echo "
                                <tr>
                                    <td>$reg->ingr_nom</font></td>
                                    <td>$reg->ingr_cant</font></td>
                                </tr>
                            ";
                        }
                echo    '</table>
                    </div>';
            }

            function inventario_form(){
                global $connexion;
                $q="SELECT * FROM formulas";
                $sql=mysqli_query($connexion,$q);
                $formula=" ";

                echo '<div style = "width: 37%; height: 250px; line-height: 3em; overflow:auto; border: thin #000 solid; padding: 5px; background-color: white; position:relative; top: -442px; left: 645px;">';
                while ($reg=mysqli_fetch_object($sql)){
                        if ($formula!=$reg->form_nom){
                            echo '</table><br>';
                            echo '<table border="3" width="100%" style="background-color: pink">
                            <tr><th colspan="2">';
                                echo $reg->form_nom,'
                            </th></tr>

                            <tr>
                                <td><b>Ingrediente</b></td>
                                <td><b>Cantidad</b></td>
                            </tr>';

                            echo "
                                <tr>
                                    <td>$reg->form_ingr</font></td>
                                    <td>$reg->form_cant</font></td>
                                </tr>
                            "; 

                            $formula=$reg->form_nom;
                            
                        }else{
                            echo "
                                <tr>
                                    <td>$reg->form_ingr</font></td>
                                    <td>$reg->form_cant</font></td>
                                </tr>
                            "; 
                        }

                    }
                    echo '</table></div>';

                mysqli_close($connexion);
            }
            
        ?>

    </body>
</html>