<?php
include '../../class/ayuadame.php';

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$querie = new Queries();
include '../config/database_mysql.php';
$pdo = Database::connect();
$wal = new Wal_Indicadores();
$quantos_ativos_wal = $wal->Quantos_Ativos_wal2016();
$executados = $wal->Quantos_Ativos_wal2016executados();
$quantos_agendamentos = $wal->Quantos_Agendamentos2016();
$previsao = $wal->Quantos_Previsao2016();
$quantos_medicos_redes = $wal->Quantos_Médicos_via_redes();
$quantos_prestadores = $wal->Quantos_Prestadores_via_redes();
$media_valor_medico = $wal->Media_valor_Medicos();
$ponderada = $wal->Media_Ponderada_valor_Medicos();
?>
<script src="../js/justGage.1.0.1/resources/js/raphael.2.1.0.min.js"></script>
<script src="../js/justGage.1.0.1/resources/js/justgage.1.0.1.min.js"></script>
<div class="row">
    <div class="col-md-12 portlets">
        <div class="widget">
            <div class="widget-header transparent">
                <h2><strong>Indicadores</strong> Walmart</h2>
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
                            <div id="gauge4" class="171x180px"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div id="gauge5" class="171x180px"></div>
                        </div>
                    </div>                    
                </div>
                <div class="row">                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <h4 class="text-center">Valor Médio Médicos</h4><br>
                                <h4 class="text-center text-danger">
                                    <strong>
                                        <?php
                                        echo 'R$ ' . transformaEmReal($media_valor_medico['valor']);
                                        ?>   
                                    </strong>
                                </h4>
                            </div>
                        </div>
                    </div>                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div class="caption">
                                <h4 class="text-center">Média Ponderada Médicos</h4><br>
                                <h4 class="text-center text-danger">
                                    <strong>
                                        <?php
                                        echo 'R$ ' . transformaEmReal($ponderada);
                                        ?>   
                                    </strong>
                                </h4>
                            </div>
                        </div>
                    </div>                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <h4 class="text-center">Estados com mais Agendamentos</h4><br>                                
                                <table>
                                    <thead>
                                        <tr>
                                            <td class="text-center"><small>Qtd</small></td>
                                            <td class="text-center">UF</small></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($pdo->query($querie->estados_top_5()) as $value) {
                                            echo '<tr><small><td class="text-center text-danger">' . $value['quantos'] . '</td><td class="text-center text-danger">' . $value['uf'] . '</td></small></tr>';
                                        }
                                        ?>   
                                    </tbody>
                                </table>                                
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <h4 class="text-center">Média de tempo para realizar um Agendamento</h4><br>
                                <h4 class="text-center text-danger">
                                    <strong>
                                        6 Minutos
                                    </strong>
                                </h4>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <h4 class="text-center">5 Maiores Bandeiras</h4><br>                                
                                <table>
                                    <thead>
                                        <tr>
                                            <td class="text-center"><small>Qtd</small></td>
                                            <td class="text-center">Bandeira</small></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($pdo->query($querie->bandeira_top_5()) as $value) {
                                            echo '<tr><small><td class="text-center text-danger">' . $value['temos'] . '</td><td class="text-center text-danger">' . $value['bandeira'] . '</td></small></tr>';
                                        }
                                        ?>   
                                    </tbody>
                                </table>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <h4 class="text-center">5 Maiores Exames Complementares</h4><br>                                
                                <table>
                                    <thead>
                                        <tr>
                                            <td class="text-center"><small>Qtd</small></td>
                                            <td class="text-center">Exames</small></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($pdo->query($querie->exames_top_5()) as $value) {
                                            echo '<tr><small><td class="text-center text-danger">' . $value['temos'] . '</td><td class="text-center text-danger">' . utf8_encode($value['exame']) . '</td></small></tr>';
                                        }
                                        ?>   
                                    </tbody>
                                </table>                                
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>            
            <script>
                var g = new JustGage({
                    id: "gauge",
                    value: <?php echo $quantos_ativos_wal; ?>,
                    min: 0,
                    max: 80001,
                    title: "Ativos <?php echo date("Y"); ?>",
                    label: "Total"
                });
            </script>
            <script>
                var g = new JustGage({
                    id: "gauge1",
                    value: <?php echo $quantos_agendamentos['temos']; ?>,
                    min: 0,
                    max: 550,
                    title: "Agendamentos via Periódicos <?php echo date("Y"); ?>",
                    label: "Total"
                });
            </script>
            <script>
                var g = new JustGage({
                    id: "gauge2",
                    value: <?php echo $executados; ?>,
                    min: 0,
                    max: <?php echo $quantos_ativos_wal; ?>,
                    title: "Ativos <?php echo date("Y"); ?> executados!",
                    label: "Total"
                });
            </script>
            <script>
                var g = new JustGage({
                    id: "gauge3",
                    value: <?php echo $previsao['temos']; ?>,
                    min: 0,
                    max: <?php echo $quantos_ativos_wal; ?>,
                    title: "Total de Ativos Agendados",
                    label: "Total"
                });
            </script>
            <script>
                var g = new JustGage({
                    id: "gauge4",
                    value: <?php echo $quantos_medicos_redes['temos']; ?>,
                    min: 0,
                    max: 300,
                    title: "Médicos Cadastrados Global",
                    label: "Total"
                });
            </script>
            <script>
                var g = new JustGage({
                    id: "gauge5",
                    value: <?php echo $quantos_prestadores['temos']; ?>,
                    min: 0,
                    max: 300,
                    title: "Prestadores Cadastrados Global",
                    label: "Total"
                });
            </script>            
            <?php
            Database::disconnect();
            