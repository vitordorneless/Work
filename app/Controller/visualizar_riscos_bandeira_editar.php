<?php
set_time_limit(9900000000);
include '../config/database_mysql.php';

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' nao foi encontrado!');
}

$pdo = Database::connect();
$riscos = new Riscos_Operations();
$querie = new Queries();
$riscos->set_bandeira(filter_input(INPUT_POST, 'bandeira', FILTER_SANITIZE_NUMBER_INT));
?>
<div class="widget-content">
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th class="text-center">Setor</th>
                    <th class="text-center">Função</th>
                    <th class="text-center">Riscos</th>
                    <th class="text-center">Exames</th>                    
                    <th class="text-center">Situação</th>                    
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pdo->query($querie->listar_setores_cargos($riscos->get_bandeira())) as $value) {

                    $qq = $pdo->prepare($querie->listar_cargos_por_bandeira_nomes($value['cod_cargo']));
                    $qq->execute();
                    $cargo = $qq->fetch(PDO::FETCH_ASSOC);

                    $qqq = $pdo->prepare($querie->listar_setores($value['cod_depto']));
                    $qqq->execute();
                    $departamento = $qqq->fetch(PDO::FETCH_ASSOC);

                    $qqqqq = $pdo->prepare($querie->listar_pegar_um_id($riscos->get_bandeira(), $value['cod_depto'], $value['cod_cargo']));
                    $qqqqq->execute();
                    $tem_id = $qqqqq->fetch(PDO::FETCH_ASSOC);

                    $qqqq = $pdo->prepare($querie->listar_tem_risco($tem_id['id']));
                    $qqqq->execute();
                    $tem_risco = $qqqq->fetch(PDO::FETCH_ASSOC);

                    $qqqqe = $pdo->prepare($querie->listar_tem_exame($tem_id['id']));
                    $qqqqe->execute();
                    $tem_exame = $qqqqe->fetch(PDO::FETCH_ASSOC);

                    $busco_os_riscos = $tem_risco['tem'] > 0 ? 'sim' : 'nops';
                    $busco_os_exames = $tem_exame['tem'] > 0 ? 'sim' : 'nops';
                    $riscos_exames = 0;
                    $riscos_examess = 0;
                    $ids = array();
                    $idss = array();
                    if ($busco_os_riscos === 'sim') {
                        foreach ($pdo->query($querie->listar_um_id_risco($tem_id['id'])) as $value) {
                            $ids[$riscos_exames] = $value['risco_extenso'] . ' - ' . $value['obs_risco'];
                            ++$riscos_exames;
                        }
                        $riscos_descritos = implode("<br>", $ids);
                    } else {
                        $riscos_descritos = 'nada';
                    }

                    if ($busco_os_exames === 'sim') {
                        foreach ($pdo->query($querie->listar_um_id_exame($tem_id['id'])) as $value) {
                            $idss[$riscos_examess] = $value['exame_extenso'];
                            ++$riscos_examess;
                        }
                        $exames_descritos = implode("<br>", $idss);
                    } else {
                        $exames_descritos = 'nada';
                    }

                    $tem_riscoseexames = $exames_descritos != 'nada' ? '<td><small><span class="label label-success">Possui Riscos e Exames</span></small></td>' : '<td><small><span class="label label-danger">Não Possui</span></small></td>';

                    echo '<tr>';
                    echo '<td><small>' . utf8_encode($departamento['desc_depto']) . '</small></td>';
                    echo '<td><small>' . utf8_encode($cargo['desc_cargo']) . '</small></td>';
                    echo '<td><small>' . utf8_encode(strtoupper($riscos_descritos)) . '</small></td>';
                    echo '<td><small>' . utf8_encode(strtoupper($exames_descritos)) . '</small></td>';
                    echo '<td><small>' . $tem_riscoseexames . '</small></td>';
                    echo '</tr>';
                }
                Database::disconnect();
                ?>
            </tbody>
        </table>
    </div>
</div>