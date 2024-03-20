<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Panel de Control</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/main-index.css">
    <!-- JQUERY -->
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
        <li class="active"><a href="./"><i class="material-icons">home</i>Inicio</a></li>
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

      <!-- INICIO DE LA PAGINA DE INICIO -->
      <div class="container">
        <ul>
<?php
include('./php/conexion.php');
$documentos_query = mysqli_query($con,"SELECT * FROM documento");
$total_documentos = mysqli_num_rows($documentos_query);
$fechas_programadas = 0;
$fechas_faltantes = 0;
while($documentos_data = mysqli_fetch_assoc($documentos_query)){
  if(isset($documentos_data['fecha_programada'])){
    $fechas_programadas++;
  }else{
    $fechas_faltantes++;
  }
}

// print_r($total_documentos);
// print_r($fechas_faltantes);

if($total_documentos == $fechas_faltantes){
  echo "<li>Los documentos aun no han sido programados, quiere programarlos ahora?</li>";
}elseif ($total_documentos > $fechas_faltantes && $fechas_faltantes > 1) {
  echo "<li>Algunos documentos aun no tienen una fecha programada, quiere programarlos ahora?</li>";
}elseif ($fechas_faltantes == 1) {
  echo "<li>El siguiente documento aun no han sido programado, quiere programarlo ahora?</li>";
}
?>

</ul>
<div class="calendario-index-container">
<table class="calendario-index centered">
    <tr>
      <td></td>
      <td>Enero</td>
      <td>Febrero</td>
      <td>Marzo</td>
      <td>Abril</td>
      <td>Mayo</td>
      <td>Junio</td>
      <td>Julio</td>
      <td>Agosto</td>
      <td>Septiembre</td>
      <td>Octubre</td>
      <td>Noviembre</td>
      <td>Diciembre</td>
    </tr>

<?php
$documentos_query_calendario = mysqli_query($con,"SELECT * FROM documento");
while($documentos_data_calendario = mysqli_fetch_assoc($documentos_query_calendario)){
  $temp_color_documento = (isset($documentos_data_calendario['fecha_programada'])) ? "<tr> <td>" : "<tr class='documento_sin_fecha'> <td>";
  echo $temp_color_documento.$documentos_data_calendario['nombre']." </td>";
  if((isset($documentos_data_calendario['fecha_programada']))){
    $fecha_programada_documentos =  $documentos_data_calendario['fecha_programada'];
    $fecha_array = explode('-', $fecha_programada_documentos);
    for ($i=1; $i<=12 ; $i++) { 
      $datos_fecha = ($i == intval($fecha_array[1])) ? $fecha_array[0] : "";
      echo "<td class='".$i."' rowS='".$i."'>".$datos_fecha."</td>";
    }  
    echo "</tr>";
  }else{
    echo "<td colspan='12'>Fecha no programada, <a href='programar.php'>programar ahora?</a></td>";
    echo "</tr>";
  }  
}
?>

  </table>
</div>
</div>

    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  </body>
  <script type="text/javascript">

  document.addEventListener('DOMContentLoaded', function() {
      var sideN = document.querySelectorAll('.sidenav');
      var instancesSideNav = M.Sidenav.init(sideN, {}, true);

      var collapsibleSideNav = document.querySelectorAll('.collapsible');
      var instancesCollapsibleSideNav = M.Collapsible.init(collapsibleSideNav, {});
    });

  </script>
  <script>
    $("table tr td").mouseover(function(){
      $('table tr td.' + $(this).attr('rowS')).css("background-color",'rgba(255,0,0,0.2)')
    });
    $("table tr td").mouseout(function(){
      $('table tr td.' + $(this).attr('rowS')).css("background-color",'transparent')
    });
  </script>
</html>
