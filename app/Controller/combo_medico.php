<?php
include '../config/database_mysql.php';
$id_prestador = filter_input(INPUT_GET, 'id_prestador', FILTER_SANITIZE_NUMBER_INT);
$pdo = Database::connect();
$sql = "select id_medico, nome from wal_medico where status = 1 and id_prestador = $id_prestador order by nome asc";
echo '<option value="0">Escolher...</option>';
foreach ($pdo->query($sql) as $value) {
    echo '<option value="' . $value['id_medico'] . '">' . $value['nome'] . '</option>';
}
Database::disconnect();
