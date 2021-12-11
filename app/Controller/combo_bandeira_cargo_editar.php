<?php

include '../config/database_mysql.php';

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$pdo = Database::connect();
$querie = new Queries();
$setor = filter_input(INPUT_GET, 'setor', FILTER_SANITIZE_NUMBER_INT);
$bandeira = filter_input(INPUT_GET, 'bandeira', FILTER_SANITIZE_NUMBER_INT);
foreach ($pdo->query($querie->listar_cargos_por_bandeira_editar($setor, $bandeira)) as $value) {
    $qq = $pdo->prepare($querie->listar_cargos_por_bandeira_nomes($value['cargo']));
    $qq->execute();
    $data = $qq->fetch(PDO::FETCH_ASSOC);
    echo '<option value="' . $value['cargo'] . '">' . $value['cargo'].'-'.utf8_encode($data['desc_cargo']) . '</option>';
}
Database::disconnect();
