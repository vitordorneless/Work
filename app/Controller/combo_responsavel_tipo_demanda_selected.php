<?php
include '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' no foi encontrado!');
}
$querie = new Queries();
$execu = filter_input(INPUT_GET, 'execu', FILTER_SANITIZE_NUMBER_INT);
$setor = filter_input(INPUT_GET, 'setor', FILTER_SANITIZE_NUMBER_INT);
$pdo = Database::connect();
echo '<option value="0">Escolher...</option>';
foreach ($pdo->query($querie->listar_executantes_setor($setor)) as $value) {    
    $option = $value['id'] == $execu ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['cod_estabelecimento'] . '"';
    echo '<option ' . $option . '>' . $value['nome_extenso'] . '</option>';
}
Database::disconnect();