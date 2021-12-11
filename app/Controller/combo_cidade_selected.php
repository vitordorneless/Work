<?php

include '../config/database_mysql.php';

$uf = filter_input(INPUT_GET, 'uf', FILTER_SANITIZE_NUMBER_INT);
$id_cidade = filter_input(INPUT_GET, 'id_cidade', FILTER_SANITIZE_NUMBER_INT);

$pdo = Database::connect();
$sql = "select cod_cidade, nom_cidade from cidade where cod_estado = $uf order by nom_cidade";
echo '<option value="0">Escolher...</option>';
foreach ($pdo->query($sql) as $value) {
    $option = $value['cod_cidade'] == $id_cidade ? 'value="' . $value['cod_cidade'] . '" selected' : 'value="' . $value['cod_cidade'] . '"';
    echo '<option ' . $option . '>' . utf8_encode($value['nom_cidade']) . '</option>';
}
Database::disconnect();