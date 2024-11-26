<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto En capas</title>
    <!-- Plugins de css -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- Plugins de js-->
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fontawesone-->
    <script src="https://kit.fontawesome.com/e632f1f723.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Logotipo -->
    <header class="container-fluid">
        <h3 class="text-center py-3">Universidad Tecnologica de Tecamac</h3>
    </header>
    <!-- Botonera -->
    <nav class="container-fluid bg-light">
        <div class="container">
            <ul class="nav nav-justifed py-2 nav-pills">
              <?php if (isset($_GET["pagina"])): ?>

                

                <?php if ($_GET["pagina"] == "ingreso"): ?>
                  <a href="index.php?pagina=ingreso" class="nav-link active">Ingreso</a>
                <?php else: ?>
                  <a href="index.php?pagina=ingreso" class="nav-link">Ingreso</a>
                <?php endif ?>
                <?php if ($_GET["pagina"] == "registro"): ?>
                  <a href="index.php?pagina=registro" class="nav-link active">Registro</a>
                <?php else: ?>
                  <a href="index.php?pagina=registro" class="nav-link">Registro</a>
                <?php endif ?>

                <?php if ($_GET["pagina"] == "inicio"): ?>
                  <a href="index.php?pagina=inicio" class="nav-link active">Inicio</a>
                <?php else: ?>
                  <a href="index.php?pagina=inicio" class="nav-link">Inicio</a>
                <?php endif ?>

                

                <?php if ($_GET["pagina"] == "salir"): ?>
                  <a href="index.php?pagina=salir" class="nav-link active">Salir</a>
                <?php else: ?>
                  <a href="index.php?pagina=salir" class="nav-link">Salir</a>
                <?php endif ?>

              <?php else: ?>
                <li class="nav-item">
                    <a href="index.php?pagina=registro" class="nav-link active">Registro</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?pagina=ingreso" class="nav-link">Ingreso</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?pagina=inicio" class="nav-link">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?pagina=salir" class="nav-link">Salir</a>
                </li>        
              <?php endif ?>
              </ul>
        </div>
    </nav>

    <!-- Contenido -->
    <main class="container-fluid">
        <div class="container py-5">
          <?php 
          #isset: isset() Determinar si una variable esta definida y no es NULL
          if(isset($_GET["pagina"])){
            #Filtrar las página blancas
            if($_GET["pagina"] == "registro" ||
              $_GET["pagina"] == "ingreso" ||
              $_GET["pagina"] == "inicio" ||
              $_GET["pagina"] == "editar" ||
              $_GET["pagina"] == "salir"){
                include "paginas/" . $_GET["pagina"] . ".php";
              } else {
                include "paginas/error404.php";
              }

          } else {
            include "paginas/registro.php";
          }
          ?>
        </div>
    </main>
</body>
</html>