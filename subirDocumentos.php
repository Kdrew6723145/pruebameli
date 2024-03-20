<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Panel de Control</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- DROPZONE -->
    <link href="./dropzone/dropzone.css" type="text/css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
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
                 <li><div class="divider"></div></li>
                 <li><a href="listar.php">Listar</a></li>
                 <li><a href="programar.php">Programar</a></li>
                 <li><div class="divider"></div></li>
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
      <ul class="collapsible collapsible-documentos popout">
        <?php
        $categoria_subir_query = mysqli_query($con,"SELECT * FROM tipo_documentacion WHERE nombre='".$_REQUEST['TIPO']."'");
        $categoria_nombre = mysqli_fetch_assoc($categoria_subir_query);
        $documentos_subir_query = mysqli_query($con,"SELECT * FROM documento WHERE tipo_documento='".$categoria_nombre['id']."' ");
        $modal_temp = 1;
        while($documentos_subir_datos = mysqli_fetch_assoc($documentos_subir_query)){
          $estado_query = mysqli_query($con, "SELECT * FROM estado_documentos WHERE id='".$documentos_subir_datos['estado_documento']."' ");
          $estado_data = mysqli_fetch_assoc($estado_query);

          $date1 = new DateTime();
          $date2 = new DateTime($documentos_subir_datos['fecha_programada']);
          $interval = $date1->diff($date2);
          $tiempo_restante = $interval->m." Meses, ".($interval->d + 1)." Dias ";
        ?>
       <li>
         <div class="collapsible-header"><i class="material-icons">filter_drama</i><?php echo $documentos_subir_datos['nombre']; ?></div>
         <div class="collapsible-body">
           <div class="row">
              <div class="col s2">
                <!-- Modal Trigger -->
<div class="modal-trigger" href="#modal<?php echo $modal_temp; ?>"><i class="material-icons">file_upload</i></div>

<!-- Modal Structure -->
<div id="modal<?php echo $modal_temp; $modal_temp++;?>" class="modal" style="width:500px; padding-top: 50px;">
  <div class="modal-content form-upload-<?php echo $documentos_subir_datos['id']; ?>">
    <div class="row form-upload-fs">
       <div class="col s12">
         <div class="input-field col s12">
            <select>
              <option value="" disabled selected>Escoga una opcion</option>
              <?php
                $categoria_select_query = mysqli_query($con,"SELECT * FROM `categoria`");
                while ($categoria_select_data = mysqli_fetch_assoc($categoria_select_query)) {
              ?>
                  <option value="<?php echo $categoria_select_data['id'];?>"><?php echo $categoria_select_data['categoria'];?></option>
              <?php
                }
              ?>
            </select>
            <label>Tipo de Documento</label>
          </div>
       </div>
       <div class="col s12">
         <div class="input-field col s12">
           <input disabled value="<?php echo date('d-m-yy'); ?>" type="text">
           <label>Fecha actual</label>
          </div>
       </div>
       <div class="col s12">

       </div>
    </div>
    <div class="row form-upload-ss" style="display:none;">
      <div class="col s12">
        <form action="./php/subirDocumentos.php" class="dropzone">
          <input type="hidden" name="idDocumento" value="<?php echo $documentos_subir_datos['id']; ?>">
          <input type="hidden" name="tipoDoc" class="tipoDoc-<?php echo $documentos_subir_datos['id']; ?>" value="">
          <input type="hidden" name="emisionDoc" value="<?php echo date('d-m-yy'); ?>">
        </form>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#!" class="waves-effect waves-green btn-flat modal-back" idDoc="<?php echo $documentos_subir_datos['id']; ?>">Atras</a>
    <a href="#!" class="waves-effect waves-light btn red accent-2 modal-next" idDoc="<?php echo $documentos_subir_datos['id']; ?>">Siguiente</a>
  </div>
</div>

              </div>
              <div class="col s10">
                <div class="row">
                  <!-- FECHA PROGRAMADA -->
                  <div class="input-field col s6">
                    <input disabled type="text" value="<?php echo $documentos_subir_datos['fecha_programada']; ?>" class="validate">
                    <label>Fecha Programada</label>
                  </div>
                  <!-- ESTADO -->
                  <div class="input-field col s6">
                    <input disabled type="text" value="<?php echo ($estado_data['estado'] == 's/e') ? 'Estado No asignado' : $estado_data['estado']; ?>" class="validate">
                    <label>Estado</label>
                  </div>
                  <!-- TIMPO RESTANTE -->
                  <div class="input-field col s6">
                    <input disabled type="text" value="<?php echo $tiempo_restante; ?>" class="validate">
                    <label>Tiempo Restante</label>
                  </div>
                </div>
              </div>
            </div>
         </div>
       </li>
       <?php
        }
       ?>
      </ul>
    </div>

    <script src="./dropzone/dropzone.js"></script>
    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function() {
        Dropzone.autoDiscover = false;
        var sideN = document.querySelectorAll('.sidenav');
        var instancesSideNav = M.Sidenav.init(sideN, {}, true);

        var collapsibleSideNav = document.querySelectorAll('.collapsible');
        var instancesCollapsibleSideNav = M.Collapsible.init(collapsibleSideNav, {});

        var collapsibleDoc = document.querySelectorAll('.collapsible-documentos');
        var instancesCollapsibleDoc = M.Collapsible.init(collapsibleDoc, {});

        var elemsModal = document.querySelectorAll('.modal');
        var instancesModal = M.Modal.init(elemsModal, {});

        var elemsSelect = document.querySelectorAll('select');
        var instancesSelect = M.FormSelect.init(elemsSelect, {});
        // $("#my-awesome-dropzone").dropzone({});

        $(".modal-next").on('click',function(){
          $(".form-upload-" + $(this).attr('idDoc') + " .form-upload-fs").css('display','none');
          $(".form-upload-" + $(this).attr('idDoc') + " .form-upload-ss").css('display','block');
          $(".form-upload-" + $(this).attr('idDoc') + " .tipoDoc-" + $(this).attr('idDoc')).val($(".form-upload-" + $(this).attr('idDoc') + " .form-upload-fs select").val());
        });
        $(".modal-back").on('click',function(){
          $(".form-upload-" + $(this).attr('idDoc') + " .form-upload-ss").css('display','none');
          $(".form-upload-" + $(this).attr('idDoc') + " .form-upload-fs").css('display','block');
        });
      });

    </script>
  </body>
</html>
