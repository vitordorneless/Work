<?php
include '../config/database_mysql.php';
$estado = filter_input(INPUT_GET, 'estado', FILTER_SANITIZE_NUMBER_INT);
$pdo = Database::connect();
$sql = "select cod_cidade, nom_cidade from cidade where cod_estado = $estado order by nom_cidade";
echo '<option value="0">Escolher...</option>';
foreach ($pdo->query($sql) as $value) {
    echo '<option value="' . $value['cod_cidade'] . '">' . utf8_encode($value['nom_cidade']) . '</option>';
}
Database::disconnect();
