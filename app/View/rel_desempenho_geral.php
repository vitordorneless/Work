<?php
session_start();
include '../config/database_mysql.php';
$pdo = Database::connect();

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' no foi encontrado!');
}

$querie = new Queries();
$demandas = new Demandas();
$setor = new Usuarios_Setores();
$abertos = array();
$fechados = array();
$nomes = array();
$abertos1 = array();
$fechados1 = array();
$nomes1 = array();
$count = $counts = $contse = 0;
$array_demandas = $demandas->Total_demandas_funcionario_Geral();
$array_demandas_line = $demandas->Line_chart_estilo();

$dt_ult_alt = new DateTime($array_demandas_line['data_ultima_alteracao']);
$data_abertura = $dt_ult_alt->format('H-i');
$dt_fechamento = new DateTime($array_demandas_line['data_fechamento']);
$data_fechamento = $dt_fechamento->format('H-i');
switch ($array_demandas_line['tipo']) {
    case 'horas':
        $dt_ult_alt->add(new DateInterval("PT" . $array_demandas_line['id_prazo'] . "H"));
        $prazo = $dt_ult_alt->format('H-i');
        break;
    case 'dias':
        $dt_ult_alt->add(new DateInterval("P" . $array_demandas_line['id_prazo'] . "D"));
        $prazo = $dt_ult_alt->format('H-i');
        break;
    case 'semanas':
        $dt_ult_alt->add(new DateInterval("P" . $array_demandas_line['id_prazo'] . "W"));
        $prazo = $dt_ult_alt->format('H-i');
        break;
    case 'meses':
        $dt_ult_alt->add(new DateInterval("P" . $array_demandas_line['id_prazo'] . "M"));
        $prazo = $dt_ult_alt->format('H-i');
        break;
}

$demandas_open = $demandas->Total_demandas_open_Geral();
$demandas_qualidade = $demandas->Total_demandas_Qualidade();
$array_media = $demandas->media_tempo_Geral();
foreach ($pdo->query($querie->grafico_barra_setor_Geral()) as $value) {
    array_push($abertos, $value['abertos']);
    array_push($fechados, $value['fechados']);
    array_push($nomes, '"' . $value['nome'] . '"');
    $count = bcadd($count, bcadd($value['abertos'], $value['fechados']));
}
$seps = implode(",", $nomes);
$open = implode(",", $abertos);
$close = implode(",", $fechados);

foreach ($pdo->query($querie->grafico_barra_setor_que_mais_pede_Geral()) as $value) {
    array_push($abertos1, $value['abertos']);
    array_push($fechados1, $value['fechados']);
    array_push($nomes1, '"' . $value['setor'] . '"');
    $contse = bcadd($contse, bcadd($value['abertos'], $value['fechados']));
}
$seps1 = implode(",", $nomes1);
$open1 = implode(",", $abertos1);
$close1 = implode(",", $fechados1);

$temtop2 = $temtop3 = $temtop4 = $temtop5 = NULL;
$megastring = "";
foreach ($pdo->query($querie->top_five_demandas_Geral()) as $value) {
    switch ($counts) {
        case 0:
            $top_1 = array('tipo_demanda' => '"' . $value['tipo_demanda'] . '"', 'total' => $value['demandas']);
            break;
        case 1:
            $top_2 = array('tipo_demanda' => '"' . $value['tipo_demanda'] . '"', 'total' => $value['demandas']);
            $megastring = ',{
                value: ' . $top_2['total'] . ',
                color: "#00a65a",
                highlight: "#00a65a",
                label: ' . $top_2['tipo_demanda'] . '
            }';
            break;
        case 2:
            $top_3 = array('tipo_demanda' => '"' . $value['tipo_demanda'] . '"', 'total' => $value['demandas']);
            $megastring = $megastring . ',{
                value: ' . $top_3['total'] . ',
                color: "#f39c12",
                highlight: "#f39c12",
                label: ' . $top_3['tipo_demanda'] . '
            }';
            break;
        case 3:
            $top_4 = array('tipo_demanda' => '"' . $value['tipo_demanda'] . '"', 'total' => $value['demandas']);
            $megastring = $megastring . ',{
                value: ' . $top_4['total'] . ',
                color: "#00c0ef",
                highlight: "#00c0ef",
                label: ' . $top_4['tipo_demanda'] . '
            }';
            break;
        case 4:
            $top_5 = array('tipo_demanda' => '"' . $value['tipo_demanda'] . '"', 'total' => $value['demandas']);
            $megastring = $megastring . ',{
                value: ' . $top_5['total'] . ',
                color: "#3c8dbc",
                highlight: "#3c8dbc",
                label: ' . $top_5['tipo_demanda'] . '
            }';
            break;
    }
    ++$counts;
}
?>
<script src="../js/justGage.1.0.1/resources/js/raphael.2.1.0.min.js"></script>
<script src="../js/justGage.1.0.1/resources/js/justgage.1.0.1.min.js"></script>	
<script src="../js/charts/jquery-2.2.3.min.js"></script>
<script src="../js/charts/bootstrap.min.js"></script>
<script src="../js/charts/Chart.min.js"></script>
<script src="../js/charts/fastclick.js"></script>
<script>
    $(function () {
        var areaChartData = {
            labels: [<?php echo $seps; ?>],
            datasets: [
                {
                    label: "Abertos",
                    fillColor: "rgba(210, 214, 222, 1)",
                    strokeColor: "rgba(210, 214, 222, 1)",
                    pointColor: "rgba(210, 214, 222, 1)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php echo $open; ?>]
                },
                {
                    label: "Fechados",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [<?php echo $close; ?>]
                }
            ]
        };

        var areaChartData1 = {
            labels: [<?php echo $seps1; ?>],
            datasets: [
                {
                    label: "Abertos",
                    fillColor: "rgba(210, 214, 222, 1)",
                    strokeColor: "rgba(210, 214, 222, 1)",
                    pointColor: "rgba(210, 214, 222, 1)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php echo $open1; ?>]
                },
                {
                    label: "Fechados",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [<?php echo $close1; ?>]
                }
            ]
        };

        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
            scaleBeginAtZero: true,
            scaleShowGridLines: true,
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleGridLineWidth: 1,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            barShowStroke: true,
            barStrokeWidth: 2,
            barValueSpacing: 4,
            barDatasetSpacing: 1,
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            responsive: true,
            maintainAspectRatio: true
        };

        var barChartCanvas1 = $("#barChart1").get(0).getContext("2d");
        var barChart1 = new Chart(barChartCanvas1);
        var barChartData1 = areaChartData1;
        barChartData1.datasets[1].fillColor = "#00a65a";
        barChartData1.datasets[1].strokeColor = "#00a65a";
        barChartData1.datasets[1].pointColor = "#00a65a";
        var barChartOptions1 = {
            scaleBeginAtZero: true,
            scaleShowGridLines: true,
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleGridLineWidth: 1,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            barShowStroke: true,
            barStrokeWidth: 2,
            barValueSpacing: 4,
            barDatasetSpacing: 1,
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            responsive: true,
            maintainAspectRatio: true
        };

        barChartOptions1.datasetFill = false;
        barChart1.Bar(barChartData1, barChartOptions1);

        var g = new JustGage({
            id: "gauge",
            value: <?php echo $array_demandas['demandas']; ?>,
            min: 0,
            max: <?php echo bcadd($demandas_open['aberto'], $demandas_open['fechado']); ?>,
            title: "Funcionário com + Demandas",
            label: "<?php echo $array_demandas['nome_extenso']; ?>"
        });

        var gg = new JustGage({
            id: "gauge1",
            value: <?php echo round($array_media['media'], 0); ?>,
            min: 0,
            max: 120,
            title: "Média de Tempo para Execução de Demanda",
            label: "Minutos"
        });

        var ggg = new JustGage({
            id: "gauge2",
            value: <?php echo $demandas_open['aberto']; ?>,
            min: 0,
            max: <?php echo bcadd($demandas_open['aberto'], $demandas_open['fechado']); ?>,
            title: "Demandas Abertas",
            label: "Total"
        });

        var gggg = new JustGage({
            id: "gauge3",
            value: <?php echo $demandas_open['fechado']; ?>,
            min: 0,
            max: <?php echo bcadd($demandas_open['aberto'], $demandas_open['fechado']); ?>,
            title: "Demandas Finalizadas",
            label: "Total"
        });

        var ggggg = new JustGage({
            id: "gauge4",
            value: <?php echo $demandas_qualidade['bom']; ?>,
            min: 0,
            max: <?php echo bcadd($demandas_qualidade['bom'], bcadd($demandas_qualidade['ruim'], bcadd($demandas_qualidade['ruim_demaise'], $demandas_qualidade['nada']))); ?>,
            title: "Realizada de Acordo",
            label: "Total"
        });

        var gggggg = new JustGage({
            id: "gauge5",
            value: <?php echo $demandas_qualidade['ruim']; ?>,
            min: 0,
            max: <?php echo bcadd($demandas_qualidade['bom'], bcadd($demandas_qualidade['ruim'], bcadd($demandas_qualidade['ruim_demaise'], $demandas_qualidade['nada']))); ?>,
            title: "Não Realizada de Acordo",
            label: "Total"
        });

        var ggggggg = new JustGage({
            id: "gauge6",
            value: <?php echo $demandas_qualidade['ruim_demaise']; ?>,
            min: 0,
            max: <?php echo bcadd($demandas_qualidade['bom'], bcadd($demandas_qualidade['ruim'], bcadd($demandas_qualidade['ruim_demaise'], $demandas_qualidade['nada']))); ?>,
            title: "Processo a melhorar",
            label: "Total"
        });

        var gggggggg = new JustGage({
            id: "gauge7",
            value: <?php echo $demandas_qualidade['nada']; ?>,
            min: 0,
            max: <?php echo bcadd($demandas_qualidade['bom'], bcadd($demandas_qualidade['ruim'], bcadd($demandas_qualidade['ruim_demaise'], $demandas_qualidade['nada']))); ?>,
            title: "Demandas sem Avaliação",
            label: "Total"
        });

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);

        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
            {
                value: <?php echo $top_1['total']; ?>,
                color: "#f56954",
                highlight: "#f56954",
                label: <?php echo $top_1['tipo_demanda']; ?>
            }<?php
if (!empty($counts)) {
    echo $megastring;
}
?>
        ];
        var pieOptions = {
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 1,
            percentageInnerCutout: 50,
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
            responsive: true,
            maintainAspectRatio: true,
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        pieChart.Doughnut(PieData, pieOptions);        

    });
</script>
<div class="row top-summary">
    <div class="col-md-12 portlets">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Desempenho Geral</strong></h2>
            </div>
            <div class="widget-content padding">
                <div class="chart">
                    <canvas id="barChart" style="height:150px; width: 60%"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 portlets">
        <div class="widget">            
            <div class="widget-content padding">                    
                <div id="gauge"></div>                    
            </div>
        </div>
    </div>
    <div class="col-md-3 portlets">
        <div class="widget">            
            <div class="widget-content padding">                    
                <div id="gauge1"></div>
            </div>
        </div>
    </div>    
    <div class="col-md-3 portlets">
        <div class="widget">            
            <div class="widget-content padding">                    
                <div id="gauge2"></div>
            </div>
        </div>
    </div>    
    <div class="col-md-3 portlets">
        <div class="widget">            
            <div class="widget-content padding">                    
                <div id="gauge3"></div>
            </div>
        </div>
    </div>    
    <div class="col-md-3 portlets">
        <div class="widget">            
            <div class="widget-content padding">                    
                <div id="gauge4"></div>                    
            </div>
        </div>
    </div>
    <div class="col-md-3 portlets">
        <div class="widget">            
            <div class="widget-content padding">                    
                <div id="gauge5"></div>
            </div>
        </div>
    </div>    
    <div class="col-md-3 portlets">
        <div class="widget">            
            <div class="widget-content padding">                    
                <div id="gauge6"></div>
            </div>
        </div>
    </div>    
    <div class="col-md-3 portlets">
        <div class="widget">            
            <div class="widget-content padding">                    
                <div id="gauge7"></div>
            </div>
        </div>
    </div>    
    <div class="col-md-6 portlets">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Demandas + </strong> Solicitadas</h2>
            </div>
            <div class="widget-content padding">
                <canvas id="pieChart" style="height:150px; width: 40%"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 portlets">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Demandas Solicitadas</strong> por Outros Setores</h2>
            </div>
            <div class="widget-content padding">
                <canvas id="barChart1" style="height:150px; width: 40%"></canvas>
            </div>
        </div>
    </div>    
</div>
<?php
Database::disconnect();
