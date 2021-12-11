<?php
include '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' no foi encontrado!');
}
$querie = new Queries();
$sla = new Demandas_Tipos();
$array = $sla->Dados_Demandas(filter_input(INPUT_GET, 'id_demanda', FILTER_SANITIZE_NUMBER_INT));
$pdo = Database::connect();
echo '<option value="0">Escolher...</option>';
foreach ($pdo->query($querie->combo_demanda()) as $value) {
    $option = $value['id'] == $array['sla'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
    echo '<option ' . $option . '>' . $value['prazo'] . '</option>';
}
Database::disconnect();
