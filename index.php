<?php
//Inclusion del controlador
include "configs/config.php";
include "configs/funciones.php"; 

//Condición de instancia de los modelos que se encuentra en la carpeta modulos
if(!isset($p))
{
    $p = "inicio";
}
else
{
    $p = $p; 
}

?>

<!--Inicio de configuración pagina web-->
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>All Movie</title>

  <!-- Referencia a los Frameworks-->
  <script type = "text/javascript" src = "bootstrap/js/bootstrap.js" ></script>
  <script type = "text/javascript" src = "vendor/fontawesome/js/all.js" ></script>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
  <link href="css/business-casual.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilos.css">

</head>

<body>

  <h1 class="site-heading text-center text-white d-none d-lg-block">
    <span class="site-heading-upper text-primary mb-3">Todo lo que quieras ver en un solo lugar</span>
    <span class="site-heading-lower">All Movie</span>
  </h1>

  <!-- Menu de navegación -->
  <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
    <div class="container">
      <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Menu</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item active px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="?p=inicio">Inicio
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="?p=peliculas">Tienda</a>
          </li>
          <?php
            //Condicion de revisión de si existe un cliente logeado 
              if(isset($_SESSION['id_cliente']))
              {
              ?>
                <li class="nav-item px-lg-4">
                <a class="nav-link text-uppercase text-expanded" href="?p=carrito"> Carrito</a>
               </li>
              <?php
              }
              else
              {
                  ?>
                    <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="?p=registro">Registrarse</a>
                    </li>
                  <?php
              }
              ?>
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="?p=login">Inicio de Sesión</a>
          </li>
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="?p=admin">Admin</a>
          </li>
          <?php
                  if(isset($_SESSION['id_cliente'])){
                    ?>
                      <li class="nav-item px-lg-4">
                      <a href="#" class="nav-link text-uppercase text-expanded pull-right"><?=nombre_cliente($_SESSION['id_cliente'])?></a>
                      </li>
                      <li class="nav-item px-lg-4">
                      <a class="nav-link text-uppercase text-expanded pull-right" href="?p=salir" >Salir</a>
                      </li>
                <?php
                  }
                ?>
                    <?php
                  if(isset($_SESSION['id'])){
                    ?>
                      <li class="nav-item px-lg-4">
                      <a href="#" class="nav-link text-uppercase text-expanded pull-right"><?=nombre_admin($_SESSION['id'])?></a>
                      </li>
                      <li class="nav-item px-lg-4">
                      <a class="nav-link text-uppercase text-expanded pull-right" href="?p=salir" >Salir</a>
                      </li>
                <?php
                  }
                ?>
        </ul>
      </div>
    </div>
  </nav>

<!--Cuerpo de la pagina-->
  <div class="cuerpo">
    <?php
        if(file_exists("modulos/".$p.".php"))
        {
            include "modulos/".$p.".php"; 
        }
        else
        {
            echo "<i> No se ha encontrado el modulo <b>" .$p. "</b> <a href = './'> Regresar </a></i>"; 
        }
    ?>
</div>

<!--Pie de pagina-->
  <footer class="footer text-faded text-center py-5">
    <div class="container">
      <p class="m-0 small">Copyright &copy; AllMovie UNIR</p> 
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
