<?php
include '../config/database_mysql.php';
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
?>
<link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
<style type="text/css" class="init"></style>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {
        $('#funcionarios').DataTable({
            "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"},
            paging: true
        });
    });
</script>
<table id="funcionarios" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>           
            <th><small>Matrícula</small></th>
            <th><small>Nome</small></th>
            <th><small>Cargo</small></th>
            <th><small>Caixa</small></th>
            <th><small>Médico</small></th>
            <th><small>Coordenador</small></th>
            <th><small>Digitado?</small></th>
        </tr>
    </thead>
    <tfoot>    
    <th><small>Matrícula</small></th>
            <th><small>Nome</small></th>
            <th><small>Cargo</small></th>
            <th><small>Caixa</small></th>
            <th><small>Médico</small></th>
            <th><small>Coordenador</small></th>
            <th><small>Digitado?</small></th>
</tfoot>
<tbody>
    <?php
    $pdo = Database::connect();
    $sql = "SELECT funcionarios.id as 'id', funcionarios.matricula AS 'matricula', funcionarios.nome_funcionario AS 'nome', funcionarios.id_medico AS 'id_medico', funcionarios.id_medico_coordenador AS 'id_medico_coordenador',
                funcionarios.cpf AS 'cpf', funcionarios.cod_cargo as 'cargo', funcionarios.id_box as 'id_box', funcionarios.erro as 'erro', 
                funcionarios.erro_identificacao as 'erro_identificacao', funcionarios.erro_riscos as 'erro_riscos',
                funcionarios.erro_data_ASO as 'erro_data_ASO', funcionarios.erro_data_exames as 'erro_data_exames',
                funcionarios.erro_assinatura_ativo as 'erro_assinatura_ativo',funcionarios.erro_assinatura_medico as 'erro_assinatura_medico',
                funcionarios.erro_carimbo as 'erro_carimbo',funcionarios.erro_rasuras as 'erro_rasuras',
                funcionarios.erro_falta_apto as 'erro_falta_apto',funcionarios.erro_falta_habilitado as 'erro_falta_habilitado', funcionarios.flg_periodico as 'flg_periodico'
            FROM wal_funcionarios funcionarios  
            WHERE periodo in ('2015') and funcionarios.cpf in ('$cpf')
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
        
        $sql_coord = "select concat(nome,'/',cargo,'/',conselho,'/',crm) as tudo from pcmso_coordenadores where id = ?";
        $qsql_coord = $pdo->prepare($sql_coord);
        $qsql_coord->execute(array($value['id_medico_coordenador']));
        $cargo_coord = $qsql_coord->fetch(PDO::FETCH_ASSOC);        
        
        $sql_box = "select etiqueta from wal_caixa where id = ?";
        $qsql_box = $pdo->prepare($sql_box);
        $qsql_box->execute(array($value['id_box']));
        $cargo_box = $qsql_box->fetch(PDO::FETCH_ASSOC);        
        $fez = $value['flg_periodico'] == 1 ? 'Sim' : 'Não';
        echo '<tr>';        
        echo '<td><small>' . $value['matricula'] . '</small></td>';
        echo '<td class="text-uppercase"><small>' . $value['nome'] . '</small></td>';
        echo '<td><small>' . utf8_encode($cargo_consult['desc_cargo']) . '</small></td>';
        echo '<td><small>' . utf8_encode($cargo_box['etiqueta']) . '</small></td>';
        echo '<td><small>' . utf8_encode($medico_consult['nome_extenso']) . '</small></td>';
        echo '<td><small>' . utf8_encode($cargo_coord['tudo']) . '</small></td>';
        echo '<td><small><strong>' . $fez . '</strong></small></td>';
        echo '</tr>';
    }
    Database::disconnect();
    ?>
</tbody>
</table>