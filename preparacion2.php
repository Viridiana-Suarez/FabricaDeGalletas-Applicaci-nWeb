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
        <h1>Proceso de fabricación</h1>
        
        <h2 style="text-align:center;">Proceso de mezcla</h2>
        <p style="text-align: center;">Para comenzar a mezclar los ingredientes dar click en el botón de mezclar.</p>


        <div class="w3-light-grey">
          <div id="myBar" class="w3-container w3-pink w3-center" style="width:20%">0%</div>
        </div>
        <br>
        <button class="w3-button w3-pink" onclick="move()">Mezclar</button> 
        </div>

        <script>
        function move() {
          var elem = document.getElementById("myBar");   
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
          }
        }
        </script>
        <button  disabled=true class="w3-button w3-pink" onclick="move()">Siguiente</button> 

        <?php

        ?>

        <h2 style="text-align:center;">Proceso de hornear</h2>
        <p style="text-align: center;">Para comenzar a hornear la mezcla dar click en el botón de hornear.</p>


        <div class="w3-light-grey">
          <div id="miHorno" class="w3-container w3-pink w3-center" style="width:20%">0%</div>
        </div>
        <br>
        <button class="w3-button w3-pink" onclick="move2()">Hornear</button> 

        </div>

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
          }
        }
        </script>
        <button  disabled=true class="w3-button w3-pink" onclick="move()">Siguiente</button> 
        <button class="w3-button w3-pink" onclick="move()">Siguiente</button> 

        <h2 style="text-align:center;">¡Listo tus galletas están listas!</h2>
        <button  class="button" onclick="window.location.href='index.html'">Página principal</button>

    </body>
</html>