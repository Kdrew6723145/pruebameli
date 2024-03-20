<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Panel de Control</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- DATATABLE -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.2/fc-3.3.1/fh-3.1.7/kt-2.5.3/r-2.2.6/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.0/sp-1.2.1/sl-1.3.1/datatables.min.css"/>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.2/fc-3.3.1/fh-3.1.7/kt-2.5.3/r-2.2.6/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.0/sp-1.2.1/sl-1.3.1/datatables.min.js"></script>
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
           <li class="active">
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
                 <li class="active"><a href="listar.php">Listar</a></li>
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
      <div class="container">
        <table id="example" class="display" style="width:100%">
          <thead>
              <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Tipo</th>              
                <th>Emision</th>
                <th></th>
              </tr>
              </thead>
          <tbody>
  <?php
    include('./php/conexion.php');
    $archivos_query = mysqli_query($con,"SELECT * FROM archivo");
    while($archivos_data = mysqli_fetch_assoc($archivos_query)){
      $categoria_archivo_query = mysqli_query($con,"SELECT * FROM categoria WHERE id='".$archivos_data['tipo_documento']."'");
      $categoria_archivo_data = mysqli_fetch_assoc($categoria_archivo_query);
      $categoria_archivo = $categoria_archivo_data['categoria'];

      $documento_archivo_query = mysqli_query($con,"SELECT * FROM documento WHERE id='".$archivos_data['documento_id']."'");
      $documento_archivo_data = mysqli_fetch_assoc($documento_archivo_query);
      $documento_archivo = $documento_archivo_data['nombre'];

      $ruta_archivo = substr($archivos_data['archivo'],1);
  ?>          
            <tr>
              <td><?php echo $archivos_data['codigo']; ?></td>
              <td><?php echo $archivos_data['nombre']; ?></td>
              <td><?php echo $categoria_archivo; ?></td>
              <td><?php echo $documento_archivo; ?></td>
              <td><?php echo $archivos_data['emision']; ?></td>
              <td>
                <a class="tooltipped" data-position="bottom" data-tooltip="Ver Documento" href="<?php echo $ruta_archivo; ?>" target="_blank" rel="noopener noreferrer"><i class="material-icons">remove_red_eye</i>  </a>
                <a class="tooltipped" data-position="right" data-tooltip="Descargar Documento" href="<?php echo $ruta_archivo; ?>" target="_blank" rel="noopener noreferrer" Download><i class="material-icons">file_download</i></a>
              </td>
            </tr>
  <?php
    }
  ?>
          </tbody>
        </table>
      </div>



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
    <script>
      $(document).ready(function() {
          $('#example').DataTable();
          $('.tooltipped').tooltip();
      } );
    </script>
  </body>
</html>
