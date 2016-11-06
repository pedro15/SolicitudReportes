<script type = "text/javascript" src="chartist-js\chartist.min.js"></script>
<!--  Formulario Principal donse se establece la informacion de las fechas !-->
<form class = "form-inline" method="POST" action = "#">
  <div class="container">
    <div class="row">
        <div class='col-md-4'>
          <div class="form-group">
            <label>Desde: </label>
            <input type='text'  class="form-control" id='datetimepicker1' name="Date1" required = "" />
           </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker(
                  {
                    format : 'YYYY-MM-DD',
                    locale: 'es'
                  });
            });
        </script>
        <div class='col-md-6'>
          <div class="form-group">
            <label>Hasta:</label>
            <input type='text' class="form-control" id='datetimepicker2' name="Date2" required = "" />
            <button type="submit" class="btn btn-default btn-lg">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </button>
            <buttun id = "printbtn" class="btn btn-default btn-lg">
                  <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir
            </buttun>
           </div>
        </div>

        <script type="text/javascript">
            $(function () {
                $('#datetimepicker2').datetimepicker(
                  {
                    format : 'YYYY-MM-DD',
                    locale: 'es'
                  });
            });
        </script> 
    </div>
    
</div>
</form>


<!-- div usado para dibujar la grafica  !-->
<div class = "col-md-5 col-md-offset-1">
<div class="ct-chart ct-perfect-fourth chart-fixedsize" id = "print"></div>
</div>
<!--  Formulario oculto que almacena la informacion de las graficas !-->
<form>
  <?php
     include_once('Program.php');
    if (isset($_POST['Date1']) && isset($_POST['Date2']) )
    {
        $d1 = $_POST['Date1'];
        $d2 = $_POST['Date2'];
        $count_teclado = Program::CountCategoryReports("TECLADO NO SIRVE" , $d1 , $d2 ); // A
        $count_monitor = Program::CountCategoryReports("MONITOR NO SIRVE" , $d1 , $d2 ); // B
        $count_mouse = Program::CountCategoryReports("MOUSE NO SIRVE" , $d1 , $d2 ); // C
        $count_pc = Program::CountCategoryReports("PC NO ENCIENDE" , $d1 , $d2 ); // D
        $count_so = Program::CountCategoryReports("NO INICIA SISTEMA OPERATIVO" , $d1 , $d2 ); // E
        $count_pw = Program::CountCategoryReports("CLAVE DE INICIAR SESION PERDIDA" , $d1 , $d2); // F
        $count_other = Program::CountCategoryReports("OTRO",$d1,$d2); // G
        echo "<input type='hidden' name='Serie-A' value=" . $count_teclado .">";
        echo "<input type='hidden' name='Serie-B' value=" . $count_monitor .">";
        echo "<input type='hidden' name='Serie-C' value=" . $count_mouse .">";
        echo "<input type='hidden' name='Serie-D' value=" . $count_pc .">";
        echo "<input type='hidden' name='Serie-E' value=" . $count_so .">";
        echo "<input type='hidden' name='Serie-F' value=" . $count_pw .">";
        echo "<input type='hidden' name='Serie-G' value=" . $count_other .">";
    }
  ?>
</form>

<script type = "text/javascript">

var data_a = document.querySelector('[name="Serie-A"]').value;
var data_b = document.querySelector('[name="Serie-B"]').value;
var data_c = document.querySelector('[name="Serie-C"]').value;
var data_d = document.querySelector('[name="Serie-D"]').value;
var data_e = document.querySelector('[name="Serie-E"]').value;
var data_f = document.querySelector('[name="Serie-F"]').value;
var data_g = document.querySelector('[name="Serie-G"]').value;

var data = {
  labels: ["Teclado no sirve: " + data_a , "Monitor no sirve: " + data_b , 
  "Mouse no sirve: " + data_c , "PC no enciende: " + data_d , "No inicia S.O: " + data_e , 
  "Clave Perdida: " + data_f , "Otro: " + data_g  ],

  series: [data_a,data_b,data_c,data_d,data_e,data_f,data_g]
};

var options = {
   distributeSeries: true
};

var responsiveOptions = [
  ['screen and (min-width: 641px) and (max-height: 1024px)', {
    showPoint: false,
    axisX: {
      
    }
  }],
  ['screen and (max-width: 640px)', {
    showLine: false,
    axisX: {
      
    }
  }]
];

var chart = new Chartist.Bar('.ct-chart',data,options,responsiveOptions);

 $(document).ready(function() 
   {
        $("#printbtn").click(function()
        {
            PrintElem("print");
            window.focus();
		   });
  });
</script>