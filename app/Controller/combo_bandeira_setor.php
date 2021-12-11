<?php

include '../config/database_mysql.php';

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$querie = new Queries();
$bandeira = filter_input(INPUT_GET, 'bandeira', FILTER_SANITIZE_NUMBER_INT);

$pdo = Database::connect();
echo '<option value="na">Escolher...</option>';
foreach ($pdo->query($querie->listar_setores_por_bandeira($bandeira)) as $value) {
    $qq = $pdo->prepare($querie->listar_setores_por_bandeira_nomes($value['setor']));
    $qq->execute();
    $data = $qq->fetch(PDO::FETCH_ASSOC);
    echo '<option value="' . $value['setor'] . '">' . utf8_encode($data['desc_depto']) . '</option>';
}
Database::disconnect();
