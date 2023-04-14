<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Preparación</title>
        <link rel="stylesheet" href="estilo_preparacion.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="images/icono.png">
        <link rel="stylesheet" href="librerias.css">
    </head>
    <body>
        
        <h1>Preparación</h1>
        <h2 style="text-align:center;">Proceso de mezcla</h2>
        <p style="text-align: center;">Para comenzar a mezclar los ingredientes dar click en el botón de mezclar.</p>


        <div class="w3-light-grey">
          <div id="myBar" class="w3-container w3-pink w3-center" style="width:20%">0%</div>
        </div>
        <br>
        <button id="myButton" class="w3-button w3-pink" onclick="move()">Mezclar</button> 
        </div>

        <h2 style="text-align:center;">Proceso de hornear</h2>
        <p style="text-align: center;">Para comenzar a hornear la mezcla dar click en el botón de hornear.</p>


        <div class="w3-light-grey">
          <div id="miHorno" class="w3-container w3-pink w3-center" style="width:20%">0%</div>
          </div>
          <br>
          <button style="display:none;" id="myButton2" class="w3-button w3-pink" onclick="move2()">Hornear</button> 
        </div>

        <?php
            $nombre_formula=$_GET['nom_re'];
            $cantidad_form=$_GET['cant_re'];
            global $form_ingr, $form_cant, $dispo, $canti;

            require("conectar.php");
            $connexion = mysqli_connect("localhost","root","");

            if( mysqli_connect_errno()){
                echo "Hubo un problema con la base de datos error al conectar";
                exit() ;
            }
            
            mysqli_select_db($connexion,"fabrica_galletas") or die ("No se encuentra la Base de datos");
            mysqli_set_charset($connexion,"utf8");

            $q="SELECT * FROM formulas WHERE form_nom='$nombre_formula'";
            $sql=mysqli_query($connexion,$q);

            $dispo="";

            while ($reg=mysqli_fetch_object($sql)){
                
                $canti=($reg->form_cant)*$cantidad_form;

                $dispo=$dispo.$canti." ".$reg->form_ingr.",";

            }

            echo'<input id="fin" name="fin" type="text" style="display:none;" value="'; echo $dispo,'">';

        ?>

        <script>

          function move() {
            
            var elem = document.getElementById("myBar");
            var msg =  document.getElementById("fin").value;
            var msg2 = "Los ingredientes : "  + msg + " han sido añadidos";
            var width = 20;
            var id = setInterval(frame, 10);
            function frame() {
              if (width >= 100) {
                clearInterval(id);
                alert(msg2);
              } else {
                width++; 
                elem.style.width = width + '%'; 
                elem.innerHTML = width * 1  + '%';
              }

              if (width == 100){
                document.getElementById("myButton2").style.display = 'block';
              } 
            }
          }

        </script>

        <script>

        function move2() {
          var elem = document.getElementById("miHorno");   
          var width = 20;
          var id = setInterval(frame, 10);
          function frame() {
            if (width >= 100) {
              clearInterval(id);
            } else {
              width++; 
              elem.style.width = width + '%'; 
              elem.innerHTML = width * 1  + '%';
            }

            if (width == 100){
                document.getElementById("myButton3").style.display = 'block';
              }

          }
        }
        </script>

        <h2 style="text-align:center;">¡Tus galletas están listas!</h2>
        <button id="myButton3" style="display:none;" class="button" onclick="window.location.href='index.html'">Página principal</button>

    </body>
</html>