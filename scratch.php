<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Panel de Control</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>

      <nav> <!-- navbar content here  --> </nav>

      <ul id="slide-out" class="sidenav sidenav-fixed">
        <li><div class="user-view">
          <div class="background">
            <!-- <img src="images/office.jpg"> -->
          </div>
          <!-- <a href="#user"><img class="circle" src="images/yuna.jpg"></a> -->
          <a href="#name"><span class="white-text name">John Doe</span></a>
          <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
        </div></li>
        <li><a href="./"><i class="material-icons">home</i>Inicio</a></li>
        <!-- <li><a href="#!">Second Link</a></li> -->
        <li><div class="divider"></div></li>
        <!-- <li><a href="#!">First Sidebar Link</a></li>
        <li><a href="#!">Second Sidebar Link</a></li> -->
        <li class="no-padding">
          <ul class="collapsible">
           <li>
             <a style="padding-left: 32px" class="collapsible-header">Documentos<i class="material-icons">arrow_drop_down</i></a>
             <div class="collapsible-body">
               <ul>
                 <?php
                 include('./php/conexion.php');
                 $categoria_query = mysqli_query($con,"SELECT * FROM tipo_documentacion");
                 while($categoria_data = mysqli_fetch_assoc($categoria_query)){
                    $request_page = (isset($_REQUEST['TIPO']) &&  $_REQUEST['TIPO'] == $categoria_data['nombre']) ? "active" : "";
                    echo '<li class="'.$request_page.'"><a href="subirDocumentos.php?TIPO='.$categoria_data['nombre'].'">'.$categoria_data['nombre'].'</a></li>';
                 }
                 ?>
                 <li><a href="#!">Listar</a></li>
                 <li><a href="programar.php">Programar</a></li>
               </ul>
             </div>
           </li>
           <li>
             <a style="padding-left: 32px" class="collapsible-header">Seguimiento<i class="material-icons">arrow_drop_down</i></a>
             <div class="collapsible-body">
               <ul>
               <li><a href="seguimiento-actividades.php">Actividades de sistema de gestion</a></li>
                 <li><a href="seguimiento-mejoras">Mejoras</a></li>
               </ul>
             </div>
           </li>
           <li>
             <a style="padding-left: 32px" class="collapsible-header">Configuraciones<i class="material-icons">arrow_drop_down</i></a>
             <div class="collapsible-body">
               <ul>
                 <li><a href="#!">Temas</a></li>
                 <li><a href="#!">Fuente</a></li>
                 <li><a href="#!">Cerrar Sesi&oacute;n</a></li>
               </ul>
             </div>
           </li>
         </ul>
        </li>
      </ul>

      <!-- INICIO DE LA PAGINA DE SUBIR DOCUMENTO -->


    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function() {
        var sideN = document.querySelectorAll('.sidenav');
        var instancesSideNav = M.Sidenav.init(sideN, {}, true);

        var collapsibleSideNav = document.querySelectorAll('.collapsible');
        var instancesCollapsibleSideNav = M.Collapsible.init(collapsibleSideNav, {});
      });

    </script>
  </body>
</html>
