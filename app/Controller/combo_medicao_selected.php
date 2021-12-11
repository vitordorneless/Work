<?php
include '../config/database_mysql.php';
$id_loja = filter_input(INPUT_GET, 'id_loja', FILTER_SANITIZE_NUMBER_INT);
$id_funcao = filter_input(INPUT_GET, 'id_funcao', FILTER_SANITIZE_NUMBER_INT);
$pdo = Database::connect();
$sql = "select nome_funcao, id from tst_checklist_funcao where id_loja in ($id_loja)";
echo '<option value="0">Escolher...</option>';
foreach ($pdo->query($sql) as $value) {
    $option = $value['id'] == $id_funcao ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
    echo '<option ' . $option . '>' . utf8_encode($value['nome_funcao']) . '</option>';
}
Database::disconnect();