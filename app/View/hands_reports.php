<?php
include '../config/database_mysql.php';
$arquivo = 'convocacao.xls';
include '../../class/ayuadame.php';
$pdo = Database::connect();
$sql = "select evento.id as id_evento,evento.loja as loja, lojim.desc_estabelecimento as lojim,valores.id_medico as id_medico,doctors.nome as nome_medico, valores.valor as valor, evento.atendimentos as atendimentos,  (valores.valor * evento.atendimentos) as total
from evento_convocacao evento
inner join medicos_valores valores on valores.id_evento_convocacao = evento.id
inner join wal_medico doctors on doctors.id_medico = valores.id_medico
inner join wal_estabelecimento lojim on lojim.cod_estabelecimento = evento.loja
where evento.id not in (1,2,3,4,5)
order by valores.valor asc, doctors.nome";
$table = '<table><hr></hr>';
$table = $table . '<tr><h1>Convocação x Médicos x Valores</h1></tr>';
$table = $table . '<hr></hr>';
$table = $table . '<tr>Hoje ' . date('d/m/Y') . '</tr>';
$table = $table . '<tr><hr></hr></tr>';
$table = $table . '<thead>';
$table = $table . '<tr><th>Código Loja</th>';
$table = $table . '<th>Loja</th>';
$table = $table . '<th>Nome Médico</th>';
$table = $table . '<th>Valor</th>';
$table = $table . '<th>Atendimentos</th>';
$table = $table . '<th>Total</th>';
$table = $table . '</thead>';
$table = $table . '<tbody>';
foreach ($pdo->query($sql) as $value) {


    $table = $table . '<tr>';
    $table = $table . '<td>' . $value['loja'] . '</td>';
    $table = $table . '<td>' . utf8_encode($value['lojim']) . '</td>';
    $table = $table . '<td>' . utf8_encode($value['nome_medico']) . '</td>';
    $table = $table . '<td>' . $value['valor'] . '</td>';
    $table = $table . '<td>' . $value['atendimentos'] . '</td>';
    $table = $table . '<td>' . $value['total'] . '</td>';
    $table = $table . '</tr>';
}

Database::disconnect();

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
header("Content-Description: PHP Generated Data");
echo $table;
exit;
