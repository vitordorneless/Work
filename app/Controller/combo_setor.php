<?php

include '../config/database_mysql.php';

$empresa = filter_input(INPUT_GET, 'empresa', FILTER_SANITIZE_NUMBER_INT);
$estabelecimento = filter_input(INPUT_GET, 'estabelecimento', FILTER_SANITIZE_NUMBER_INT);

$pdo = Database::connect();
$sql = "select  distinct funfun.cod_centro_custo as setor, setor.desc_centro_custo as nome_setor
        from wal_funcionarios funfun
        inner join wal_centro_custo_setor setor on setor.cod_centro_custo = funfun.cod_centro_custo
        where funfun.cod_empresa = $empresa and funfun.cod_estabelecimento = $estabelecimento 
        order by setor.desc_centro_custo asc";
echo '<option value="0">Escolher...</option>';
foreach ($pdo->query($sql) as $value) {
    echo '<option value="' . $value['setor'] . '">' . $value['setor'] . ' - ' . utf8_encode($value['nome_setor']) . '</option>';
}
Database::disconnect();