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

    <!--Optimizar el contenido a dispositivos moviles-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
      <!-- Menu -->
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
        <li><div class="divider"></div></li>
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
                 <li class="active"><a href="programar.php">Programar</a></li>
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

      <!-- <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a> -->

      <!-- INICIO DE LA PAGINA PROGRAMAR -->
      <div class="container">
        <ul class="collapsible expandable">
<!-- LENGUAJE PHP PARA TENER UNA COMUNICACION SERVIDOR - BASE DE DATOS -->
<?php
// LLAMAMOS A LA CONEXION CON LA BASE DE DATOS
include('./php/conexion.php');
// SE REALIZA EL QUERY PARA BUSCAR TODOS LAS CATEGORIAS GUARDADAS EN LA BASE DE DATOS
$area_documento_query = mysqli_query($con,"SELECT * FROM tipo_documentacion");
// SE REALIZA ITERACIONES CADA VEZ QUE SE ENCUENTREN LAS CATEGORIAS, EN ESTE CASO SON 4: PLANEAR, HACER, VERIFICAR Y ACTUAR
while($area_documento_data = mysqli_fetch_assoc($area_documento_query)){
    echo "<li>";
    echo "<div class='collapsible-header'><i class='material-icons'>filter_drama</i>" .$area_documento_data['nombre']. "</div>";
    // SE REALIZA OTRO QUERY PARA BUSCAR DOCUMENTOS QUE PERTENEZCAN A CADA CATEGORIA EN PARTICULAR
    $documentos_query = mysqli_query($con,"SELECT * FROM documento WHERE tipo_documento='".$area_documento_data['id']."'");
    echo "<div class='collapsible-body'>";
    echo "<table>";
    echo "<tbody>";
    // SE REALIZA UNA SEGUNDA ITERACION CUANDO SE ENCUENTRAN O SE FILTRAN LOS DOCUMENTOS
    while($documentos_data = mysqli_fetch_assoc($documentos_query)){
      echo "<tr>";
      echo "<td>" .$documentos_data['nombre']. "</td>";
      // CONDICION PARA MOSTRAR LA FECHA EN CASO DE QUE EL DOCUMENTO ESTE PROGRAMADO, SI NO TIENE UNA FECHA PROGRAMADA
      // ENTONCES SE MUESTRA EL INPUT PARA INGRESAR UNA FECHA
      echo (isset($documentos_data['fecha_programada'])) ? "<td>" .$documentos_data['fecha_programada']. "</td>" : "<td><input type='text' class='datepicker datePicker-fecha-programar' idDocumento='".$documentos_data['id']."' placeholder='Ingresar Fecha'></td>";
      // FECHA ACTUAL
      if(isset($documentos_data['fecha_programada'])){
        $today_date_mes = intval(date("m"));
        $today_date_dia = intval(date("d"));
        $fecha_pro_array = explode('-',$documentos_data['fecha_programada']);
        // print_r($fecha_pro_array);
        if($today_date_mes > $fecha_pro_array[1]){
          if($today_date_mes == $fecha_pro_array[1] && $today_date_dia > $fecha_pro_array[0]){
            echo "<td>ATRASADO</td>";
          }elseif($today_date_mes == $fecha_pro_array[1] && $today_date_dia == $fecha_pro_array[0]){
            echo "<td>ULTIMO DIA</td>";
          }else{
            $fecha_progr_str = new Datetime($documentos_data['fecha_programada']);
            $date_today = new Datetime('now');
            $interval = $fecha_progr_str->diff($date_today);
            $tiempo_atraso = $interval->m." Meses, ".$interval->d." dias "; 
            echo "<td>ATRASADO POR ".$tiempo_atraso." <a href='#' class='reprogramar_fecha' idDocumento='".$documentos_data['id']."'>Reprogramar</a> </td>";
          }
        }
      }
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</li>";
}
?>

        </ul>
      </div>
    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- SE LLAMA A LA LIBRERIA PARA LAS ALERTAS O NOTIFICACIONES -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  </body>
  <!-- INICIO DE JAVASCRIPT PARA MANEJAR LOS DATOS EN EL LADO DEL CLIENTE -->
  <script type="text/javascript">
  // SE LLAMA A UN EVENTO CUANDO LA PAGINA HAYA CARGADO COMPLETAMENTE
  document.addEventListener('DOMContentLoaded', function() {
    // SE GUARDA UN ID TEMPORAL PARA UBICAR EL DOCUMENTO QUE SE VA A PROGRAMAR
    var idDocumento_temp = "";
    // SE CREA UNA FUNCION PARA CONVERTIR EL DATO DEL INPUT DE LA FECHA EN UNA CADENA QUE ACEPTE LA BASE DE DATOS
    Date.prototype.yyyymmdd = function() {
      var mm = this.getMonth() + 1; // LOS MESES SE CUENTAN DESDE 0, POR ESO SE SUMA UN 1
      var dd = this.getDate();
      return [
              (dd>9 ? '' : '0') + dd,
              (mm>9 ? '' : '0') + mm,
              this.getFullYear()
              ].join('-');
    };
    // SE INCLUYEN LAS LINEAS REQUERIDAS POR LAS LIBRERIAS PARA CARGAR LOS COMPONENTES
    var elemsCollapsible = document.querySelectorAll('.collapsible');
    var instancesCollapsible = M.Collapsible.init(elemsCollapsible, {});
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems,
      {
        autoClose: true,
        format:'dd-mm-yyyy',
        // EVENTO EN EL QUE SE SELECCIONA LA FECHA
        onSelect: function(time){
          let fecha_seleccionada = new Date(Date.parse(time));
          // SE REALIZA UNA COMUNICACION DIRECTA CLIENTE - SERVIDOR PARA GUARDAR LOS DATOS EN TIEMPO REAL
          $.ajax({
            // UBICACION DE DESTINO DEL ARCHIVO DEL SERVIDOR
            url: './php/ajax.php',
            // METODO DE TRANSFERENCIA DE DATOS
            method: 'POST',
            // DATOS
            data: {
              programarFecha: 1,
              idDocumento: idDocumento_temp,
              fecha: fecha_seleccionada.yyyymmdd()
            },
            // EN CASO DE UNA RESPUESTA SATISFACTORIA SE MUESTRA UNA NOTIFICACION CON LA LIBRERIA SWEETALERT2
            success: function(response){
              Swal.fire({
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
              });
            }
          });
        }
      }
    );
    // SE GUARDA EL ID TEMPORAL DEL DOCUMENTO CUANDO SE HACE CLICK AL INPUT DE LA FECHA
    $(".datePicker-fecha-programar").on('click',function(){
      idDocumento_temp = $(this).attr('idDocumento');
    });
    $(".reprogramar_fecha").on('click',function(){
      $.ajax({
        url: './php/ajax.php',
        method: "POST",
        data: {
          reprogramar: 1,
          id: $(this).attr('idDocumento')
        },
        success: function(respuesta){
          console.log(respuesta);
          Swal.fire({
                icon: 'success',
                title: 'Listo, la actividad ha sido modificada',
                text: 'Al recargar la pagina tendra la opcion de programar una nueva fecha',
                footer: '<a href="programar.php">Realizar la nueva programacion</a>'
              });
        }
      });
    });
  });

  </script>
  <script type="text/javascript">
  </script>
</html>
