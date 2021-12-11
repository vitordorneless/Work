<?php
include '../config/database_mysql.php';
$nome = filter_input(INPUT_POST, 'query', FILTER_SANITIZE_STRING);
$pdo = Database::connect();
$stmt = $pdo->prepare('select nome_funcionario from wal_funcionarios where nome_funcionario like "%'.$nome.'%"order by nome_funcionario asc');
$stmt->execute();
$results = array();
foreach ($stmt->fetchAll(PDO::FETCH_COLUMN) as $row) {
    $results[] = $row;
}
print_r($results);