<?php
include '../config/database_mysql.php';
$empresa = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_NUMBER_INT);
$estabelecimento = filter_input(INPUT_POST, 'estabelecimento', FILTER_SANITIZE_NUMBER_INT);
$empresa_work = $empresa == 0 ? ' ' : " and funcionarios.cod_empresa = $empresa ";
$estabelecimento_work = $estabelecimento == 0 ? ' ' : " and funcionarios.cod_estabelecimento = $estabelecimento ";
?>

<link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
<style type="text/css" class="init"></style>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {
        $('#funcionarios').DataTable();
    });
</script>
<table id="funcionarios" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>            
            <th>Matrícula</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Cargo</th>
            <th>Médico</th>
        </tr>
    </thead>
    <tfoot>    
    <th>Matrícula</th>
    <th>Nome</th>
    <th>CPF</th>
    <th>Cargo</th>
    <th>Médico</th>
</tfoot>
<tbody>
    <?php
    $pdo = Database::connect();
    $sql = "SELECT funcionarios.id as 'id', funcionarios.matricula AS 'matricula', funcionarios.nome_funcionario AS 'nome', 
                funcionarios.cpf AS 'cpf', funcionarios.cod_cargo as 'cargo', funcionarios.id as 'id', funcionarios.id_medico as 'id_medico' 
            FROM wal_funcionarios funcionarios  
            WHERE funcionarios.flg_periodico = 1 and funcionarios.erro = 0 and funcionarios.cod_empresa > 0 $empresa_work $estabelecimento_work 
            ORDER BY funcionarios.cod_empresa, funcionarios.cod_cargo asc";
    foreach ($pdo->query($sql) as $value) {

        $sql_cargo = "SELECT desc_cargo FROM wal_cargo WHERE cod_cargo = ?";
        $qsql_cargo = $pdo->prepare($sql_cargo);
        $qsql_cargo->execute(array($value['cargo']));
        $cargo_consult = $qsql_cargo->fetch(PDO::FETCH_ASSOC);
        
        $sql_medico = "select nome_extenso from usuarios where id = ?";
        $qsql_medico = $pdo->prepare($sql_medico);
        $qsql_medico->execute(array($value['id_medico']));
        $medico_consult = $qsql_medico->fetch(PDO::FETCH_ASSOC);
        $nome_medico = $medico_consult['nome_extenso'] == NULL ? 'Não Informado' : $medico_consult['nome_extenso'];

        echo '<tr>';        
        echo '<td>' . $value['matricula'] . '</td>';
        echo '<td>' . $value['nome'] . '</td>';
        echo '<td>' . $value['cpf'] . '</td>';
        echo '<td>' . utf8_encode($cargo_consult['desc_cargo']) . '</td>';
        echo '<td>' . $nome_medico . '</td>';
        echo '</tr>';
    }
    Database::disconnect();
    ?>
</tbody>
</table>
