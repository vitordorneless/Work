<?php

include '../config/database_mysql.php';

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$querie = new Queries();
$lojas = filter_input(INPUT_GET, 'lojas', FILTER_SANITIZE_NUMBER_INT);

$pdo = Database::connect();
echo '<option value="na">Escolher...</option>';
foreach ($pdo->query($querie->listar_prestadores($estado)) as $value) {
    echo '<option value="' . $value['id'] . '">' . utf8_encode($value['razao_social']) . '</option>';
}
Database::disconnect();
