<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$querie = new Queries();
include '../config/database_mysql.php';
$arquivo = "CASSI RS - EPS ".  date("Y")." - AMA.xls";
$table = '<table><hr></hr>';
$table = $table . '<tr><h1>CONTROLE DE EPS CASSI RS '.date("Y").'</h1></tr>';
$table = $table . '<hr></hr>';
$table = $table . '<tr>Hoje ' . date('d/m/Y') . '</tr>';
$table = $table . '<tr><hr></hr></tr>';
$table = $table . '<thead>';
$table = $table . '<tr><th>RESPONS&Aacute;VEL EPS</th>';
$table = $table . '<th>MATR&Iacute;CULA</th>';
$table = $table . '<th>FUNCI</th>';
$table = $table . '<th>PREFIXO</th>';
$table = $table . '<th>DEPENDENCIA</th>';
$table = $table . '<th>MUNICIPIO</th>';
$table = $table . '<th>SEXO</th>';
$table = $table . '<th>DATA NASCIMENTO</th>';
$table = $table . '<th>JURISDI&Ccedil;&Atilde;O</th>';
$table = $table . '<th>DATA EPS</th>';
$table = $table . '<th>HOR&Aacute;RIO</th>';
$table = $table . '<th>SITUA&Ccedil;&Atilde;O EPS</th>';
$table = $table . '<th>OBSERVA&Ccedil;&Otilde;ES GERAIS RESPONS&Aacute;VEL</th></tr>';
$table = $table . '</thead>';
$table = $table . '<tbody>';
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

foreach ($pdo->query($querie->excel_CASSI()) as $value) {    
    $qqq = $pdo->prepare($querie->Cassi_Agencia());
    $qqq->execute(array($value['prefixo_agencia']));
    $data3 = $qqq->fetch(PDO::FETCH_ASSOC);    
    $q = $pdo->prepare($querie->Cassi_Agenda());
    $q->execute(array($data3['id']));
    $data = $q->fetch(PDO::FETCH_ASSOC);    
    $qq = $pdo->prepare($querie->excel_CASSI_desc_situacao());
    $qq->execute(array($value['situacao']));
    $data2 = $qq->fetch(PDO::FETCH_ASSOC);    
    $table = $table . '<tr>';
    $table = $table . '<td>' . $value['prestador_ama'] . '</td>';
    $table = $table . '<td>' . $value['matricula'] . '</td>';
    $table = $table . '<td>' . $value['funci'] . '</td>';
    $table = $table . '<td>' . $value['prefixo'] . '</td>';
    $table = $table . '<td>' . $data3['dependencia'] . '</td>';
    $table = $table . '<td>' . $data3['municipio'] . '</td>';
    $table = $table . '<td>' . $value['sexo'] . '</td>';
    $table = $table . '<td>' . $value['data_nascimento'] . '</td>';
    $table = $table . '<td>' . $data3['jurisdicao'] . '</td>';
    $table = $table . '<td>' . $data['data_agendamento'] . '</td>';
    $table = $table . '<td>' . $data['horario'] . '</td>';
    if($value['situacao'] == 3){
        $desc_situation = "REALIZADO - AGUARDANDO DOCUMENTOS";
    }else{
        if($value['situacao'] == 2){
            $desc_situation = "AGENDADO";
        }else{
            if(($value['situacao'] == 0) or ($value['situacao'] == 1)){
                $desc_situation = "N&Atilde;O AGENDADO";
            }
        }
    }
    $table = $table . '<td>' . $desc_situation . '</td>';
    $table = $table . '<td>' . $value['obs'] . '</td>';
    $table = $table . '</tr>';
}
Database::disconnect();
$table = $table . '</tbody>';
$table = $table . '</table>';
$tables = utf8_decode($table);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
header("Content-Description: PHP Generated Data");
echo $tables;
exit;