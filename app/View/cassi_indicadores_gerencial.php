<?php
include '../../class/ayuadame.php';
require '../Model/Cassi.php';
require '../Model/Cassi_Indicadores.php';
include '../config/database_mysql.php';
$pdo = Database::connect();
$cassi = new Cassi_Indicadores();
$total_agencias = $cassi->Quantas_Agencias_Cassi();
$total_ativos = $cassi->Quantas_Ativos_Cassi();
$total_agendamentos = $cassi->Quantas_Agendamentos_Cassi();
$total_agendamentos_concluidos = $cassi->Quantas_Agendamentos_Concluidos_Cassi();
$total_agendamentos_no_concluidos = $cassi->Quantas_Agendamentos_No_Concluidos_Cassi();
$total_carta_remessa = $cassi->Quantas_Carta_Remessa();
$total_formularios = $cassi->Quantos_Formularios();
$muie = $cassi->Quantas_Girl_and_Man_Cassi();
$situacao = $cassi->Situacao_Ativos_CASSI();
?>
<script src="../js/justGage.1.0.1/resources/js/raphael.2.1.0.min.js"></script>
<script src="../js/justGage.1.0.1/resources/js/justgage.1.0.1.min.js"></script>
<div class="row">
    <div class="col-md-12 portlets">
        <div class="widget">
            <div class="widget-header transparent">
                <h2><strong>Indicadores</strong> CASSI</h2>
                <div class="additional-btn">
                    <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                </div>
            </div>
            <div class="widget-content padding">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div id="gauge" class="171x180px"></div>                            
                        </div>
                    </div>                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div id="gauge1" class="171x180px"></div>                            
                        </div>
                    </div>                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div id="gauge2" class="171x180px"></div>
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div id="gauge3" class="171x180px"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div id="gauge33" class="171x180px"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div id="gauge6" class="171x180px"></div>
                        </div>
                    </div>                    
                </div>
                <div class="row">                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div id="gauge7" class="171x180px"></div>
                        </div>
                    </div>                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div id="gauge8" class="171x180px"></div>
                        </div>
                    </div>                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div id="gauge9" class="171x180px"></div>
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div id="gauge4" class="171x180px"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div id="gauge5" class="171x180px"></div>
                        </div>
                    </div>                    
                </div>
            </div>                
        </div>            
    </div>            
</div>
<?php
Database::disconnect();
?>
<script>
    var g = new JustGage({
        id: "gauge",
        value: <?php echo $total_agencias; ?>,
        min: 0,
        max: <?php echo $total_agencias; ?>,
        title: "Agências",
        label: "Total",
        levelColors: [
            "#3CB371",
            "#BDB76B",
            "#00BFFF"
        ]
    });
</script>
<script>
    var g = new JustGage({
        id: "gauge1",
        value: <?php echo $total_ativos; ?>,
        min: 0,
        max: <?php echo $total_ativos; ?>,
        title: "Ativos",
        label: "Total",
        levelColors: [
            "#3CB371",
            "#BDB76B",
            "#00BFFF"
        ]
    });
</script>
<script>
    var g = new JustGage({
        id: "gauge2",
        value: <?php echo $total_agendamentos; ?>,
        min: 0,
        max: <?php echo $total_agencias; ?>,
        title: "Agências Agendadas",
        label: "<?php
$dividi = bcdiv($total_agendamentos, $total_agencias, 4);
echo ceil(bcmul($dividi, 100, 4)) . '%';
?>",
        levelColors: [
            "#3CB371",
            "#BDB76B",
            "#00BFFF"
        ]
    });
</script>
<script>
    var g = new JustGage({
        id: "gauge3",
        value: <?php echo $total_agendamentos_concluidos; ?>,
        min: 0,
        max: <?php echo $total_agencias; ?>,
        title: "Agências Realizadas",
        label: "<?php
$age_rea = bcdiv($total_agendamentos_concluidos, $total_agencias, 2);
echo bcmul($age_rea, 100, 0) . '%';
?>",
        levelColors: [
            "#3CB371",
            "#BDB76B",
            "#00BFFF"
        ]
    });
</script>
<script>
    var g = new JustGage({
        id: "gauge33",
        value: <?php echo bcsub($total_agencias, $total_agendamentos); ?>,
        min: 0,
        max: <?php echo $total_agencias; ?>,
        title: "Agências Não Agendadas",
        label: "<?php
$age_no_rea = bcdiv(bcsub($total_agencias, $total_agendamentos), $total_agencias, 2);
echo bcmul($age_no_rea, 100, 0) . '%';
?>",
        levelColors: [
            "#3CB371",
            "#BDB76B",
            "#00BFFF"
        ]
    });
</script>
<script>
    var g = new JustGage({
        id: "gauge4",
        value: <?php echo $muie['hominho']; ?>,
        min: 0,
        max: <?php echo $total_ativos; ?>,
        title: "Quantos Homens",
        label: "<?php
$homi = bcdiv($muie['hominho'], $total_ativos, 2);
echo bcmul($homi, 100, 0) . '%';
?>",
        levelColors: [
            "#3CB371",
            "#BDB76B",
            "#00BFFF"
        ]
    });
</script>
<script>
    var g = new JustGage({
        id: "gauge5",
        value: <?php echo $muie['muie']; ?>,
        min: 0,
        max: <?php echo $total_ativos; ?>,
        title: "Quantas Mulheres",
        label: "<?php
$female = bcdiv($muie['muie'], $total_ativos, 4);
echo ceil(bcmul($female, 100, 4)) . '%';
?>",
        levelColors: [
            "#3CB371",
            "#BDB76B",
            "#00BFFF"
        ]
    });
</script>
<script>
    var g = new JustGage({
        id: "gauge6",
        value: <?php echo $situacao['no_agends']; ?>,
        min: 0,
        max: <?php echo $total_ativos; ?>,
        title: "Ativos EPS Não Agendados",
        levelColorsGradient: true,
        label: "<?php
$eps_no_age = bcdiv($situacao['no_agends'], $total_ativos, 2);
echo bcmul($eps_no_age, 100, 0) . '%';
?>",
        levelColors: [
            "#3CB371",
            "#BDB76B",
            "#00BFFF"
        ]
    });
</script>
<script>
    var g = new JustGage({
        id: "gauge7",
        value: <?php echo $situacao['agends']; ?>,
        min: 0,
        max: <?php echo $total_ativos; ?>,
        title: "Ativos EPS Agendados",
        levelColorsGradient: true,
        label: "<?php
$eps_age = bcdiv($situacao['agends'], $total_ativos, 4);
echo ceil(bcmul($eps_age, 100, 4)) . '%';
?>",
        levelColors: [
            "#3CB371",
            "#BDB76B",
            "#00BFFF"
        ]
    });
</script>
<script>
    var g = new JustGage({
        id: "gauge8",
        value: <?php echo $situacao['realizadis']; ?>,
        min: 0,
        max: <?php echo $total_ativos; ?>,
        title: "Ativos EPS Realizados",
        levelColorsGradient: true,
        label: "<?php
$eps_rea = bcdiv($situacao['realizadis'], $total_ativos, 2);
echo bcmul($eps_rea, 100, 0) . '%';
?>",
        levelColors: [
            "#3CB371",
            "#BDB76B",
            "#00BFFF"
        ]
    });
</script>
<script>
    var g = new JustGage({
        id: "gauge9",
        value: <?php echo $total_formularios; ?>,
        min: 0,
        max: <?php echo $total_ativos; ?>,
        title: "Formulários Enviados",
        levelColorsGradient: true,
        label: "<?php
$form_envi = bcdiv($total_formularios, $total_ativos, 2);
echo bcmul($form_envi, 100, 0) . '%';
?>",
        levelColors: [
            "#3CB371",
            "#BDB76B",
            "#00BFFF"
        ]
    });
</script>