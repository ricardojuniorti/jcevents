

<?php $__env->startSection('title', 'Eventos ativos por periodo'); ?>

<?php $__env->startSection('content'); ?>

<script type="text/javascript">

var data= JSON.parse('<?= $data ?>');


// ano atual
let currentTime = new Date();
let anoAtual = currentTime.getFullYear();

// pega mes atual para montar o trimestre
const month = ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
const d = new Date();
let mesAtual = month[d.getMonth()];
let mesanterior = month[d.getMonth()-1];
let mesanterior2 = month[d.getMonth()-2];

//retorno dos dados para o relatorio
const totalEvento =  parseInt(data.dadosEventos[0])
const totalTeatro =  parseInt(data.dadosEventos[1])
const totalShow =  parseInt(data.dadosEventos[2])
const totalCurso =  parseInt(data.dadosEventos[3])

 
google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Eventos ativos', 'Por periodo'],
    ['Eventos',     totalEvento],
    ['Teatros',      totalTeatro],
    ['Shows', totalShow],
    ['Cursos',  totalCurso],
  ]);

  var options = {
    title: 'Total de Eventos abertos por categoria',
    is3D: true,
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
  chart.draw(data, options);
}

// quantidade de eventos abertos nos ultimos 3 meses ------------------------------------------------>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChartCurve);
const desistenteMesAtual =  parseInt(data.dadosDesistentes[0])
const desistenteMesPassado =  parseInt(data.dadosDesistentes[1])
const desistenteMesRetrasado =  parseInt(data.dadosDesistentes[2])
const totalDesistentes =  parseInt(data.dadosDesistentes[3])

function drawChartCurve() {
var data = google.visualization.arrayToDataTable([
  ['Year', 'Desistencia em eventos'],
  [mesanterior2,  desistenteMesRetrasado],
  [mesanterior,  desistenteMesPassado],
  [mesAtual,  desistenteMesAtual]
]);

var options = {
  title: 'Total de participantes que desistiram de eventos dos ultimos 3 meses',
  curveType: 'function',
  legend: { position: 'bottom' }
};

var chart = new google.visualization.LineChart(document.getElementById('chart_curve'));

chart.draw(data, options);
}


// grafico de linha ------------------------------------------------------------------------------->
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart2);

//quantidade total de cadastros 
const cadastroMesAtual =  parseInt(data.dadosUsuarios[0])
const cadastroMesPassado =  parseInt(data.dadosUsuarios[1])
const cadastroMesRetrasado =  parseInt(data.dadosUsuarios[2])

function drawChart2() {
  var data = google.visualization.arrayToDataTable([
    ['', ''],
    [mesanterior2,  cadastroMesRetrasado],
    [mesanterior,  cadastroMesPassado],
    [mesAtual,  cadastroMesAtual]
  ]);

  var options = {
    title: 'Novos cadastros dos ultimos três meses',
    hAxis: {title: 'Trimestre atual',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };

  var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
  chart.draw(data, options);
}


// grafico de barra top 3 eventos com maior numero de participantes
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawAnnotations);


const eventoParticipanteQtde1 = parseInt(data.dadosParticipantes[0][0].qtde);
const eventoParticipanteTitulo1 = data.dadosParticipantes[0][0].title;

const eventoParticipanteQtde2 = parseInt(data.dadosParticipantes[0][1].qtde);
const eventoParticipanteTitulo2 = data.dadosParticipantes[0][1].title;

const eventoParticipanteQtde3 = parseInt(data.dadosParticipantes[0][2].qtde);
const eventoParticipanteTitulo3 = data.dadosParticipantes[0][2].title;

function drawAnnotations() {
     
  var data = google.visualization.arrayToDataTable([
    ['', '', { role: 'style' }],
    [eventoParticipanteTitulo1, eventoParticipanteQtde1, '#b87333'],            // RGB value
    [eventoParticipanteTitulo2, eventoParticipanteQtde2, 'silver'],    // English color name
    [eventoParticipanteTitulo3, eventoParticipanteQtde3, 'gold'],

  ]);

  var options = {
    title: 'Top 3 - Eventos com maior quantidade de participantes',
    annotations: {
      alwaysOutside: true,
      textStyle: {
        fontSize: 22,
        color: '#000',
        auraColor: 'none'
      }
    },
    hAxis: {
      title: anoAtual,
      format: 'h:mm a',
      viewWindow: {
        min: [7, 30, 0],
        max: [17, 30, 0]
      }
    },
    vAxis: {
      title: 'Quantidade de participantes'
    }
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_top3'));
  chart.draw(data, options);
}

// numero de visitas por mes
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawStacked);

//quantidade total de cadastros 
const visitanteMesAtual =  parseInt(data.dadosVisitantes[0])
const visitanteMesPassado =  parseInt(data.dadosVisitantes[1])
const visitanteMesRetrasado =  parseInt(data.dadosVisitantes[2])
const totalVisitantes =  parseInt(data.dadosVisitantes[3])

function drawStacked() {
  var data = google.visualization.arrayToDataTable([
         ['Element', '', { role: 'style' }],
         [mesanterior2, visitanteMesRetrasado, '#b87333'],            // RGB value
         [mesanterior, visitanteMesPassado, 'blue'],            // English color name
         [mesAtual, visitanteMesAtual, 'red'],
  ]);

  var options = {
    title: 'Quantidade de acessos ao sistema dos últimos três meses',
    chartArea: {width: '80%'},
    isStacked: true,
    hAxis: {
      title: 'Total de visitas: '+totalVisitantes,
      minValue: 0,
    },
    vAxis: {
    format: 'h:mm a', 
    }
  };
  var chart = new google.visualization.BarChart(document.getElementById('chart_visit'));
  chart.draw(data, options);
}

</script>

<div id="event-create-container" class="col-md-6 offset-md-3">
  <div id="piechart_3d"></div>
  <div id="chart_curve"></div><br><br>
  <div id="chart_div"></div><br><br><br><br>
  <div id="chart_top3"></div><br><br>
  <div id="chart_visit"></div><br><br>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\TCC\jcevents\resources\views/report/eventTime.blade.php ENDPATH**/ ?>