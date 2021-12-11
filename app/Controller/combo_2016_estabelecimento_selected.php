<?php

include '../config/database_mysql.php';

$empresa = filter_input(INPUT_GET, 'empresa', FILTER_SANITIZE_NUMBER_INT);
$id_loja = filter_input(INPUT_GET, 'id_loja', FILTER_SANITIZE_NUMBER_INT);

$pdo = Database::connect();
$sql = "SELECT cod_estabelecimento, desc_estabelecimento FROM wal_estabelecimento_2016 WHERE cod_empresa = $empresa ORDER BY desc_estabelecimento ASC";
echo '<option value="0">Escolher...</option>';
foreach ($pdo->query($sql) as $value) {
    $option = $value['cod_estabelecimento'] == $id_loja ? 'value="' . $value['cod_estabelecimento'] . '" selected' : 'value="' . $value['cod_estabelecimento'] . '"';
    echo '<option ' . $option . '>' . $value['cod_estabelecimento'] . ' - ' . utf8_encode($value['desc_estabelecimento']) . '</option>';
}
Database::disconnect();