<?php
include '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' no foi encontrado!');
}
$querie = new Queries();
$tipo = new Demandas_Tipos();
$tipo->set_id(filter_input(INPUT_GET, 'demanda', FILTER_SANITIZE_NUMBER_INT));
$array_tipo = $tipo->Dados_Demandas($tipo->get_id());
$pdo = Database::connect();
echo '<option value="0">Escolher...</option>';
foreach ($pdo->query($querie->listar_executantes_setor($array_tipo['id_setor'])) as $value) {    
    $option = $value['id'] == $array_tipo['user_executante'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
    echo '<option ' . $option . '>' . $value['nome_extenso'] . '</option>';
}
Database::disconnect();
