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
echo '<option value="0">Escolher...</option>';
foreach ($pdo->query($querie->usuarios_setor()) as $value) {
    $optionn = $value['id'] == $setor ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
    echo '<option ' . $optionn . '>' . $value['setor'] . '</option>';
}
Database::disconnect();
