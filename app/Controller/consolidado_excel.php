<?php

include '../config/database_mysql.php';
include '../../class/ayuadame.php';
$pdo = Database::connect();
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$querie = new Queries();
$html = '';
$html = $html . '<table border="1">';
$html = $html . '<thead><tr>';
$html = $html . '<th colspan="2" class="text-center">Nome Prestador</th><th class="text-center">CNES</th><th class="text-center">Cadastro</th><th class="text-center">Valor</th><th class="text-center">Reacerto</th><th class="text-center">Reacerto 2</th>';
$html = $html . '</tr>';
$html = $html . '</thead><tbody>';

$cont = 0;
foreach ($pdo->query($querie->consolidado()) as $value) {
    $html = $html . '<tr>';
    $html = $html . '<td colspan="1"><strong>' . $value['razao_social'] . '</strong></td>';
    $html = $html . '<td><strong>' . $value['CNES'] . '</strong></td>';
    $html = $html . '<td><strong>' . transformaEmDataBrasileira($value['data_cadastro']) . '</strong></td>';
    $html = $html . '<td class="text-center text-danger"><small>R$ ' . transformaEmReal(str_replace(",", ".", $value['valor_consulta'] == NULL ? 0 : $value['valor_consulta'])) . '</small></td>';
    $html = $html . '<td class="text-center text-danger"><small>R$ ' . transformaEmReal(str_replace(",", ".", $value['valor_consulta_2'] == NULL ? 0 : $value['valor_consulta_2'])) . '</small></td>';
    $html = $html . '<td class="text-center text-danger"><small>R$ ' . transformaEmReal(str_replace(",", ".", $value['valor_consulta_3'] == NULL ? 0 : $value['valor_consulta_3'])) . '</small></td>';
    $html = $html . '</tr>';
    $sql_medicos = "select count(*) as tem from wal_medico where id_prestador = " . $value['id'];
    $q = $pdo->prepare($sql_medicos);
    $q->execute();
    $data = $q->fetch(PDO::FETCH_ASSOC);
    if ($data['tem'] > 0) {
        $html = $html . '<tr><td colspan="2" class="text-center text-danger"><small><strong>Nome M&eacute;dico</strong></small></td>';
        $html = $html . '<td class="text-center text-danger"><small><strong>CRM</strong></small></td>';
        $html = $html . '<td class="text-center text-danger"><small><strong>Conselho</strong></small></td>';
        $html = $html . '<td class="text-center text-danger"><small><strong>CNES</strong></small></td>';
        $html = $html . '<td class="text-center text-danger"><small><strong>Valor Consulta</strong></small></td></tr>';
        $sql_medico = "select id_medico, nome, crm, conselho, if(CNES = 0,'N&atilde;o Informado',CNES) as CNES from wal_medico where id_prestador = " . $value['id'];
        foreach ($pdo->query($sql_medico) as $values) {            
            $html = $html . '<tr class="accordion-toggle">';
            $html = $html . '<td>*</td>';
            $html = $html . '<td class="text-center text-danger"><small><strong>' . utf8_decode($values['nome']) . '</strong></small></td>';
            $html = $html . '<td class="text-center text-danger"><small>' . utf8_decode($values['crm']) . '</small></td>';
            $html = $html . '<td class="text-center text-danger"><small>' . utf8_decode($values['conselho']) . '</small></td>';
            $html = $html . '<td class="text-center text-danger"><small>' . utf8_decode($values['CNES']) . '</small></td>';
            $sql_medicos_tutu = "select consulta from medicos_valores_exames where crm = " . $values['crm'];
            $qq = $pdo->prepare($sql_medicos_tutu);
            $qq->execute();
            $dataq = $qq->fetch(PDO::FETCH_ASSOC);
            $html = $html . '<td class="text-center text-danger"><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['consulta'] == NULL ? 0 : $dataq['consulta'])) . '</small></td>';
            $html = $html . '</tr>';            
            ++$cont;
        }
    }
}
Database::disconnect();
$html = $html . '</tbody>';
$html = $html . '</table>';
header("Content-type: application/vnd.ms-excel");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=clinicas_x_medicos_consolidado.xls");
header("Pragma: no-cache");
echo $html;