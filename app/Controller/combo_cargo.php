<?php

include '../config/database_mysql.php';

$empresa = filter_input(INPUT_GET, 'empresa', FILTER_SANITIZE_NUMBER_INT);
$estabelecimento = filter_input(INPUT_GET, 'estabelecimento', FILTER_SANITIZE_NUMBER_INT);
$setor = filter_input(INPUT_GET, 'setor', FILTER_SANITIZE_NUMBER_INT);

$pdo = Database::connect();
$sql = "select distinct funfun.cod_cargo as cargo, cargo.desc_cargo as nome_cargo
        from wal_funcionarios funfun
        inner join wal_cargo cargo on cargo.cod_cargo = funfun.cod_cargo
        where funfun.cod_empresa = $empresa and funfun.cod_estabelecimento = $estabelecimento and funfun.cod_centro_custo = $setor 
        order by cargo.desc_cargo asc";
echo '<option value="0">Escolher...</option>';
foreach ($pdo->query($sql) as $value) {
    echo '<option value="' . $value['cargo'] . '">' . $value['cargo'] . ' - ' . utf8_encode($value['nome_cargo']) . '</option>';
}
Database::disconnect();
