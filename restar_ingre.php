<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Ajustar almacén</title>
        <link rel="stylesheet" href="estilo_altas_formula.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="images/icono.png">
    </head>

    <body>

        <?php
            global $form_ingr, $form_cant, $dispo;
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

            $q="SELECT * FROM formulas WHERE form_nom='$formula_nom'";
            $sql=mysqli_query($connexion,$q);
            
            while ($reg=mysqli_fetch_object($sql)){
                disponibles($reg->form_ingr,$reg->form_cant,$ingr_cant);
            }

            mysqli_close($connexion);
            
            
            function disponibles($dispo,$galleta, $cant){
                global $connexion;
                $q="SELECT * FROM ingredientes WHERE ingr_nom='$dispo'";
                $sql=mysqli_query($connexion,$q);
                $reg=mysqli_fetch_array($sql);

                $resta = $reg[1]-($galleta*$cant);

                $modifica = "UPDATE ingredientes SET ingr_cant='$resta' WHERE ingr_nom='$dispo'";
                $sql=mysqli_query($connexion,$modifica);
            }

            formulario();

            function formulario(){
                global $ingr_cant, $formula_nom;
                echo'
                <form action="preparacion3.php" name="f_ingrediente" method="get">
                <input name="cant_re" type="number" size="10" class="campo" style="display:none;" value="'; echo $ingr_cant,'">
                <input name="nom_re" type="text" size="10" class="campo" style="display:none;" value="'; echo $formula_nom,'">
                </form>
                
                <script language="JavaScript">
                    document.f_ingrediente.submit()
                </script>';
            }

        ?>
    </body>
</html>