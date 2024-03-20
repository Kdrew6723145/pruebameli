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
    <!-- CHART JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
    <!-- DATATABLE -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.2/fc-3.3.1/fh-3.1.7/kt-2.5.3/r-2.2.6/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.0/sp-1.2.1/sl-1.3.1/datatables.min.css"/>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.2/fc-3.3.1/fh-3.1.7/kt-2.5.3/r-2.2.6/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.0/sp-1.2.1/sl-1.3.1/datatables.min.js"></script>
    <!-- CSS PERSONALIZADO -->
    <link rel="stylesheet" href="./css/seguimiento.css">
    
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>

    <?php
      include('./php/conexion.php');
      $estados_query = mysqli_query($con,"SELECT * FROM estado_documentos");      
      echo "<script>";
      echo "var estados_array = [];";
      echo "var estados_data = [];";
      echo "var estados_array_emp = [];";      
      // 
      echo "var DatosSecundarios_Planear    = [];";
      echo "var DatosSecundarios_Hacer      = [];";
      echo "var DatosSecundarios_Verificar  = [];";      
      echo "var DatosSecundarios_Actuar     = [];";
      // 
      while($estados_data = mysqli_fetch_assoc($estados_query)){
        $estados_nombre = ($estados_data['estado'] == 'programado') ? 'faltante' : $estados_data['estado'];
        echo "estados_array.push('".$estados_nombre."');";
        echo "estados_array_emp.push('');";
        echo "estados_data.push(0);";
        // 
        echo "DatosSecundarios_Planear.push(0);";
        echo "DatosSecundarios_Hacer.push(0);";
        echo "DatosSecundarios_Verificar.push(0);";
        echo "DatosSecundarios_Actuar.push(0);";
      }
      $documentos_chart_query = mysqli_query($con, "SELECT tipo_documento, estado_documento FROM documento");
      while($documentos_chart_data = mysqli_fetch_assoc($documentos_chart_query)){
        $estado_valor_entero = intval($documentos_chart_data['estado_documento']);
        echo "estados_data[".$estado_valor_entero." - 1] = estados_data[".$estado_valor_entero." - 1] + 1;";
        // 
        switch ($documentos_chart_data['tipo_documento']) {
          case '1':
            echo "DatosSecundarios_Planear[".$estado_valor_entero." - 1] = DatosSecundarios_Planear[".$estado_valor_entero." - 1] + 1;";
            break;
          case '2':
            echo "DatosSecundarios_Hacer[".$estado_valor_entero." - 1] = DatosSecundarios_Hacer[".$estado_valor_entero." - 1] + 1;";
            break;
          case '3':
            echo "DatosSecundarios_Verificar[".$estado_valor_entero." - 1] = DatosSecundarios_Verificar[".$estado_valor_entero." - 1] + 1;";
            break;
          case '4':
            echo "DatosSecundarios_Actuar[".$estado_valor_entero." - 1] = DatosSecundarios_Actuar[".$estado_valor_entero." - 1] + 1;";
            break;
        }
      }      
      // echo "console.log(estados_data);";
      echo "</script>";
    ?>

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
                 <li><a href="listar.php">Listar</a></li>
                 <li><a href="programar.php">Programar</a></li>
               </ul>
             </div>
           </li>
           <li class="active">
             <a style="padding-left: 32px" class="collapsible-header">Seguimiento<i class="material-icons">arrow_drop_down</i></a>
             <div class="collapsible-body">
               <ul>
               <li class="active"><a href="seguimiento-actividades.php">Actividades de sistema de gestion</a></li>
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
      <div class="container-custom">
        <div class="table-datos-container">
          <div class="row">
            <div class="col s12">
              <ul class="tabs tabs-fixed-width tab-demo z-depth-0">
                <li class="tab col s3"><a href="#general">General</a></li>
                <li class="tab col s3"><a href="#planear">Planear</a></li>
                <li class="tab col s3"><a href="#hacer">Hacer</a></li>
                <li class="tab col s3"><a href="#verificar">Verificar</a></li>                
                <li class="tab col s3"><a href="#actuar">Actuar</a></li>
              </ul>
            </div>
<?php
  include('./php/conexion.php');
  
  $datos_planear    = mysqli_query($con,"SELECT * FROM documento WHERE tipo_documento = '1' ");
  $datos_hacer      = mysqli_query($con,"SELECT * FROM documento WHERE tipo_documento = '2' ");
  $datos_verificar  = mysqli_query($con,"SELECT * FROM documento WHERE tipo_documento = '3' ");
  $datos_actuar     = mysqli_query($con,"SELECT * FROM documento WHERE tipo_documento = '4' ");

  $documentos_seguimiento_query = mysqli_query($con,"SELECT * FROM documento");
  
?>
            <div id="general" class="col s12">
              <table class="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Estado</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    while($documentos_seguimiento_datos = mysqli_fetch_assoc($documentos_seguimiento_query)){

                      $estados_tabla_query = mysqli_query($con,"SELECT * FROM estado_documentos WHERE id = '".$documentos_seguimiento_datos['estado_documento']."' ");
                      $estados_data_tabla = mysqli_fetch_assoc($estados_tabla_query);
                      $estados_nombre_tabla = ($estados_data_tabla['estado'] == 'programado') ? 'faltante' : $estados_data_tabla['estado'];

                      $tipo_data_tabla = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tipo_documentacion WHERE id = '".$documentos_seguimiento_datos['tipo_documento']."' "));

                      echo  "<tr>";
                      echo "<td>" .$documentos_seguimiento_datos['nombre']. "</td>";
                      echo "<td>" .$estados_nombre_tabla. "</td>";
                      echo "<td>" .$tipo_data_tabla['nombre']. "</td>";
                      echo "</tr>";
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <!--  -->
            <div id="planear" class="col s12">
            <table class="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    while($documentos_seguimiento_datos = mysqli_fetch_assoc($datos_planear)){

                      $estados_tabla_query = mysqli_query($con,"SELECT * FROM estado_documentos WHERE id = '".$documentos_seguimiento_datos['estado_documento']."' ");
                      $estados_data_tabla = mysqli_fetch_assoc($estados_tabla_query);
                      $estados_nombre_tabla = ($estados_data_tabla['estado'] == 'programado') ? 'faltante' : $estados_data_tabla['estado'];

                      echo  "<tr>";
                      echo "<td>" .$documentos_seguimiento_datos['nombre']. "</td>";
                      echo "<td>" .$estados_nombre_tabla. "</td>";
                      echo "</tr>";
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <!--  -->
            <div id="hacer" class="col s12">
            <table class="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    while($documentos_seguimiento_datos = mysqli_fetch_assoc($datos_hacer)){

                      $estados_tabla_query = mysqli_query($con,"SELECT * FROM estado_documentos WHERE id = '".$documentos_seguimiento_datos['estado_documento']."' ");
                      $estados_data_tabla = mysqli_fetch_assoc($estados_tabla_query);
                      $estados_nombre_tabla = ($estados_data_tabla['estado'] == 'programado') ? 'faltante' : $estados_data_tabla['estado'];

                      echo  "<tr>";
                      echo "<td>" .$documentos_seguimiento_datos['nombre']. "</td>";
                      echo "<td>" .$estados_nombre_tabla. "</td>";
                      echo "</tr>";
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <!--  -->
            <div id="verificar" class="col s12">
            <table class="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    while($documentos_seguimiento_datos = mysqli_fetch_assoc($datos_verificar)){

                      $estados_tabla_query = mysqli_query($con,"SELECT * FROM estado_documentos WHERE id = '".$documentos_seguimiento_datos['estado_documento']."' ");
                      $estados_data_tabla = mysqli_fetch_assoc($estados_tabla_query);
                      $estados_nombre_tabla = ($estados_data_tabla['estado'] == 'programado') ? 'faltante' : $estados_data_tabla['estado'];

                      echo  "<tr>";
                      echo "<td>" .$documentos_seguimiento_datos['nombre']. "</td>";
                      echo "<td>" .$estados_nombre_tabla. "</td>";
                      echo "</tr>";
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <!--  -->
            <div id="actuar" class="col s12">
            <table class="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    while($documentos_seguimiento_datos = mysqli_fetch_assoc($datos_actuar)){

                      $estados_tabla_query = mysqli_query($con,"SELECT * FROM estado_documentos WHERE id = '".$documentos_seguimiento_datos['estado_documento']."' ");
                      $estados_data_tabla = mysqli_fetch_assoc($estados_tabla_query);
                      $estados_nombre_tabla = ($estados_data_tabla['estado'] == 'programado') ? 'faltante' : $estados_data_tabla['estado'];

                      echo  "<tr>";
                      echo "<td>" .$documentos_seguimiento_datos['nombre']. "</td>";
                      echo "<td>" .$estados_nombre_tabla. "</td>";
                      echo "</tr>";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="container-chart-general">
          <canvas id="myChartGeneral"></canvas>
        </div>
        <div class="container-chart-individuales">
          <div class="chart--show"><canvas id="myChartPlanear"   ></canvas></div>
          <div class="chart--show"><canvas id="myChartHacer"     ></canvas></div>
          <div class="chart--show"><canvas id="myChartVerificar" ></canvas></div>
          <div class="chart--show"><canvas id="myChartActuar"    ></canvas></div>
        </div>        
      </div>

    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function() {
        var sideN = document.querySelectorAll('.sidenav');
        var instancesSideNav = M.Sidenav.init(sideN, {}, true);

        var collapsibleSideNav = document.querySelectorAll('.collapsible');
        var instancesCollapsibleSideNav = M.Collapsible.init(collapsibleSideNav, {});

        $('.tabs').tabs();
        $('.example').DataTable();
      });

    </script>
    <script>
      ctx = $("#myChartGeneral");

      ctxPlanear    = $("#myChartPlanear");
      ctxHacer      = $("#myChartHacer");
      ctxVerificar  = $("#myChartVerificar");
      ctxActuar     = $("#myChartActuar");

      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: estados_data,
                backgroundColor: [
                  'rgba(208, 79, 62, 0.2)',
                  'rgba(196, 207, 220, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(99, 255, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                  'rgba(208, 79, 62, 0.2)',
                  'rgba(196, 207, 220, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(99, 255, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)'
                ],
                boderAlign: 'inner'
            }], labels: estados_array,
            },
        options: {}
      });
      // GRAFICAS INDIVIDUALES
      // PLANEAR
      var myPieChart = new Chart(ctxPlanear, {
        type: 'pie',
        data: {
            datasets: [{
                data: DatosSecundarios_Planear,
                backgroundColor: [
                  'rgba(208, 79, 62, 0.2)',
                  'rgba(196, 207, 220, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(99, 255, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                  'rgba(208, 79, 62, 0.2)',
                  'rgba(196, 207, 220, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(99, 255, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)'
                ]
            }], labels: estados_array,
            },
        options: {
          legend: {
            display: false
          }
        }
      });
      // HACER
      var myPieChart = new Chart(ctxHacer, {
        type: 'pie',
        data: {
            datasets: [{
                data: DatosSecundarios_Hacer,
                backgroundColor: [
                  'rgba(208, 79, 62, 0.2)',
                  'rgba(196, 207, 220, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(99, 255, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                  'rgba(208, 79, 62, 0.2)',
                  'rgba(196, 207, 220, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(99, 255, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)'
                ]
            }], labels: estados_array,
            },
        options: {
          legend: {
            display: false
          }
        }
      });
      // VERIFICAR
      var myPieChart = new Chart(ctxVerificar, {
        type: 'pie',
        data: {
            datasets: [{
                data: DatosSecundarios_Verificar,
                backgroundColor: [
                  'rgba(208, 79, 62, 0.2)',
                  'rgba(196, 207, 220, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(99, 255, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                  'rgba(208, 79, 62, 0.2)',
                  'rgba(196, 207, 220, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(99, 255, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)'
                ]
            }], labels: estados_array,
            },
        options: {
          legend: {
            display: false
          }
        }
      });
      // ACTUAR
      var myPieChart = new Chart(ctxActuar, {
        type: 'pie',
        data: {
            datasets: [{
                data: DatosSecundarios_Actuar,
                backgroundColor: [
                  'rgba(208, 79, 62, 0.2)',
                  'rgba(196, 207, 220, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(99, 255, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                  'rgba(208, 79, 62, 0.2)',
                  'rgba(196, 207, 220, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(99, 255, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)'
                ]
            }], labels: estados_array,
            },
        options: {
          legend: {
            display: false
          }
        }
      });
    </script>
  </body>
</html>
