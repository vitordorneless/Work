<?php
include '../../class/ayuadame.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
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
                <h2><strong>Indicadores</strong> Demandas</h2>
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
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div id="gauge10" class="171x180px"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div class="caption">                                
                                <h4 class="text-center">Valor a Receber CASSI</h4><br>
                                <h4 class="text-center text-danger">
                                    <strong>
                                        <?php
                                        $valor_recebido = $cassi->Valores_CASSI();
                                        echo 'R$ ' . transformaEmReal($valor_recebido['guias']);
                                        ?>
                                    </strong>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div class="caption">
                                <h4 class="text-center">Valor a Pagar ao Prestador</h4><br>
                                <h4 class="text-center text-danger"><strong>
                                        <?php
                                        $guarda_valores = 0;
                                        $sql30 = "select id_medico, valor_consulta, municipio as id_agencia from cassi_agendamento where id_medico = 598";
                                        foreach ($pdo->query($sql30) as $value) {
                                            $id_medico = $value['id_medico'];
                                            $valor = $value['valor_consulta'];
                                            $id_agencia = $value['id_agencia'];
                                            $sql31 = "select prefixo from cassi_agencia where id = $id_agencia";
                                            $q31 = $pdo->prepare($sql31);
                                            $q31->execute();
                                            $data31 = $q31->fetch(PDO::FETCH_ASSOC);
                                            $agencia = $data31['prefixo'];
                                            $sql32 = "select count(id) as temos from cassi_ativos where prefixo_agencia = $agencia and id_cassi_situacao = 3";
                                            $q32 = $pdo->prepare($sql32);
                                            $q32->execute();
                                            $data32 = $q32->fetch(PDO::FETCH_ASSOC);
                                            $result = bcmul($data32['temos'], (float) $valor, 2);
                                            $guarda_valores = bcadd($guarda_valores, $result, 2);
                                        }


                                        $sql33 = "select id_medico, valor_consulta, municipio as id_agencia from cassi_agendamento where id_medico = 599";
                                        foreach ($pdo->query($sql33) as $value) {
                                            $id_medico = $value['id_medico'];
                                            $valor = $value['valor_consulta'];
                                            $id_agencia = $value['id_agencia'];
                                            $sql34 = "select prefixo from cassi_agencia where id = $id_agencia";
                                            $q34 = $pdo->prepare($sql34);
                                            $q34->execute();
                                            $data34 = $q34->fetch(PDO::FETCH_ASSOC);
                                            $agencia = $data34['prefixo'];
                                            $sql35 = "select count(id) as temos from cassi_ativos where prefixo_agencia = $agencia and id_cassi_situacao = 3";
                                            $q35 = $pdo->prepare($sql35);
                                            $q35->execute();
                                            $data35 = $q35->fetch(PDO::FETCH_ASSOC);
                                            $result = bcmul($data35['temos'], (float) $valor, 2);
                                            $guarda_valores = bcadd($guarda_valores, $result, 2);
                                        }
                                        echo 'R$ ' . transformaEmReal($guarda_valores);
                                        ?>
                                    </strong></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div class="caption">
                                <h4 class="text-center">Receita / Lucro</h4><br>
                                <h4 class="text-center text-danger">
                                    <strong>
                                        <?php
                                        $valor_lucro = $cassi->Valores_CASSI_Lucro();
                                        $lucro = bcsub($valor_recebido['guias'], $valor_lucro, 2);
                                        echo 'R$ ' . transformaEmReal($lucro);
                                        ?>
                                    </strong>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div class="caption">                                
                                <h4 class="text-center">Prestador Ricardo Rossi</h4><br>
                                <h4 class="text-center text-danger"><strong>
                                        <?php
                                        $guarda_valor = 0;
                                        $sql = "select id_medico, valor_consulta, municipio as id_agencia from cassi_agendamento where id_medico = 598";
                                        foreach ($pdo->query($sql) as $value) {
                                            $id_medico = $value['id_medico'];
                                            $valor = $value['valor_consulta'];
                                            $id_agencia = $value['id_agencia'];
                                            $sql1 = "select prefixo from cassi_agencia where id = $id_agencia";
                                            $q1 = $pdo->prepare($sql1);
                                            $q1->execute();
                                            $data1 = $q1->fetch(PDO::FETCH_ASSOC);
                                            $agencia = $data1['prefixo'];
                                            $sql2 = "select count(id) as temos from cassi_ativos where prefixo_agencia = $agencia and id_cassi_situacao = 3";
                                            $q2 = $pdo->prepare($sql2);
                                            $q2->execute();
                                            $data = $q2->fetch(PDO::FETCH_ASSOC);
                                            $result = bcmul($data['temos'], (float) $valor, 2);
                                            $guarda_valor = bcadd($guarda_valor, $result, 2);
                                        }
                                        echo 'R$ ' . transformaEmReal($guarda_valor);
                                        ?>
                                    </strong>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div class="caption">
                                <h4 class="text-center">Prestador Valmir Brito</h4><br>
                                <h4 class="text-center text-danger">
                                    <strong>
                                        <?php
                                        $guarda_valor1 = 0;
                                        $sql5 = "select id_medico, valor_consulta, municipio as id_agencia from cassi_agendamento where id_medico = 599"; //599
                                        foreach ($pdo->query($sql5) as $value) {
                                            $id_medico = $value['id_medico'];
                                            $valor = $value['valor_consulta'];
                                            $id_agencia = $value['id_agencia'];
                                            $sql6 = "select prefixo from cassi_agencia where id = $id_agencia";
                                            $q6 = $pdo->prepare($sql6);
                                            $q6->execute();
                                            $data6 = $q6->fetch(PDO::FETCH_ASSOC);
                                            $agencia = $data6['prefixo'];
                                            $sql7 = "select count(id) as temos from cassi_ativos where prefixo_agencia = $agencia and id_cassi_situacao = 3";
                                            $q7 = $pdo->prepare($sql7);
                                            $q7->execute();
                                            $data7 = $q7->fetch(PDO::FETCH_ASSOC);
                                            $result = bcmul($data7['temos'], (float) $valor, 2);
                                            $guarda_valor1 = bcadd($guarda_valor1, $result, 2);
                                        }
                                        echo 'R$ ' . transformaEmReal($guarda_valor1);
                                        ?>
                                    </strong>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div class="caption">
                                <h4 class="text-center">Valor Autônomos</h4><br>
                                <h4 class="text-center text-danger">
                                    <strong>
                                        <?php
                                        $sql9746 = "select sum(replace(consulta,',','.')) as consulta from cassi_valores_autonomos where status = 1";
                                        $q = $pdo->prepare($sql9746);
                                        $q->execute();
                                        $data = $q->fetch(PDO::FETCH_ASSOC);
                                        echo 'R$ ' . transformaEmReal($data['consulta']);
                                        ?>   
                                    </strong>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">                            
                            <div class="caption">
                                <h4 class="text-center">Valor Global</h4><br>
                                <h4 class="text-center text-danger">
                                    <strong>
                                        <?php
                                        $sominha = bcmul($total_ativos, 72);
                                        echo 'R$ ' . transformaEmReal($sominha);
                                        ?>   
                                    </strong>
                                </h4>
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
                    $dividi = bcdiv($total_agendamentos,$total_agencias,4);
                    echo ceil(bcmul($dividi,100,4)).'%'; 
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
                    $age_rea = bcdiv($total_agendamentos_concluidos,$total_agencias,2);
                    echo bcmul($age_rea,100,0).'%';
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
                    value: <?php echo bcsub($total_agencias,$total_agendamentos); ?>,
                    min: 0,
                    max: <?php echo $total_agencias; ?>,
                    title: "Agências Não Agendadas",
                    label: "<?php                     
                    $age_no_rea = bcdiv(bcsub($total_agencias,$total_agendamentos),$total_agencias,2);
                    echo bcmul($age_no_rea,100,0).'%';
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
                    $homi = bcdiv($muie['hominho'],$total_ativos,2);
                    echo bcmul($homi,100,0).'%';
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
                    $female = bcdiv($muie['muie'],$total_ativos,4);
                    echo ceil(bcmul($female,100,4)).'%';
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
                    $eps_no_age = bcdiv($situacao['no_agends'],$total_ativos,2);
                    echo bcmul($eps_no_age,100,0).'%';
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
                    $eps_age = bcdiv($situacao['agends'],$total_ativos,4);
                    echo ceil(bcmul($eps_age,100,4)).'%';
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
                    $eps_rea = bcdiv($situacao['realizadis'],$total_ativos,2);
                    echo bcmul($eps_rea,100,0).'%';
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
                    id: "gauge10",
                    value: <?php echo $total_carta_remessa; ?>,
                    min: 0,
                    max: <?php echo $total_carta_remessa; ?>,
                    title: "Cartas Remessa Enviadas",
                    levelColorsGradient: true,
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
                    id: "gauge9",
                    value: <?php echo $total_formularios; ?>,
                    min: 0,
                    max: <?php echo $total_ativos; ?>,
                    title: "Formulários Enviados",
                    levelColorsGradient: true,
                    label: "<?php                     
                    $form_envi = bcdiv($total_formularios,$total_ativos,2);
                    echo bcmul($form_envi,100,0).'%';
                    ?>",
                    levelColors: [
                        "#3CB371",
                        "#BDB76B",
                        "#00BFFF"
                    ]
                });
            </script>