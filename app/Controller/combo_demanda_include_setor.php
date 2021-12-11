<?php

include '../config/database_mysql.php';

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' no foi encontrado!');
}
$querie = new Queries();
$setor = filter_input(INPUT_GET, 'setor', FILTER_SANITIZE_NUMBER_INT);
$pdo = Database::connect();
echo '<option value="na">Escolher...</option>';
foreach ($pdo->query($querie->demanda_admin_listar_tiposs($setor)) as $value) {
    echo '<option value="' . $value['id'] . '">' . $value['tipo_demanda'] . '</option>';
}
Database::disconnect();
