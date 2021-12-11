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
        $('#funcionarios').DataTable({
            "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"},
            "lengthMenu": [[-1], ["Tudinho..."]],
            scrollCollapse: true,
            scrollY: "600px",
            paging: true
        });
    });
</script>
<style type="text/css">
    td.vcenter {
        vertical-align: middle;
        text-align: center;
    }
</style>
<table id="funcionarios" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th><small>Matrícula</small></th>
            <th><small>Nome</small></th>            
            <th><small>CPF</small></th>
            <th><small>Cargo</small></th>
            <th class="text-error"><small><acronym title="teste da hora!!!">Erro</acronym></small></th>
            <th class="text-error"><small><acronym title="Erro na Identificação!!!">Iden.</acronym></small></th>
            <th class="text-error"><small><acronym title="Erro nos Riscos!!!">Riscos</acronym></small></th>
            <th class="text-error"><small><acronym title="Erro na Data do ASO!!!">Dt ASO</acronym></small></th>
            <th class="text-error"><small><acronym title="Erro na(s) data(s) do(s) Exame(s) (Inclui complementares)!!!">Exame</acronym></small></th>
            <th class="text-error"><small><acronym title="Erro na Assinatura do Associado!!!">Assi. Ativo</acronym></small></th>
            <th class="text-error"><small><acronym title="Erro na Assinatura do Médico!!!">Assi. med.</acronym></small></th>
            <th class="text-error"><small><acronym title="Erro no Carimbo!!!">Car.</acronym></small></th>
            <th class="text-error"><small><acronym title="Erro, ASO com Rasura!!!">Ras.</acronym></small></th>
            <th class="text-error"><small><acronym title="Erro, APTO não Marcado!!!">Ft Apto</acronym></small></th>
            <th class="text-error"><small><acronym title="Erro, Habilitado não Marcado!!!">Ft Hab.</acronym></small></th>
            <th class="text-error"><small><acronym title="Erro, Telefone não Descrito!!!">Ft tel</acronym></small></th>
            <th class="text-error"><small><acronym title="Erro, Sem Médico Coordenador no ASO!!!">Ft Co</acronym></small></th>
            <th class="text-error"><small><acronym title="Erro, ASO Duplicado, triplicado, quadriplicado!!!">2x</acronym></small></th>
            <th class="text-error"><small><acronym title="Falta ASO!!!">Ft ASO</acronym></small></th>
        </tr>
    </thead>
    <tfoot>
    <th></th>
    <th><small>Matrícula</small></th>
    <th><small>Nome</small></th>    
    <th><small>CPF</small></th>    
    <th><small>Cargo</small></th>
    <th class="text-error"><small>Erro</small></th>    
    <th class="text-error"><small>Iden.</small></th>
    <th class="text-error"><small>Riscos</small></th>
    <th class="text-error"><small>Dt ASO</small></th>
    <th class="text-error"><small>Exame</small></th>
    <th class="text-error"><small>Assi. Ativo</small></th>
    <th class="text-error"><small>Assi. med.</small></th>
    <th class="text-error"><small>Car.</small></th>
    <th class="text-error"><small>Ras.</small></th>
    <th class="text-error"><small>Ft Apto</small></th>
    <th class="text-error"><small>Ft Hab.</small></th>
    <th class="text-error"><small>Ft tel</small></th>
    <th class="text-error"><small>Ft Co</small></th>
    <th class="text-error"><small>2x</small></th>
    <th class="text-error"><small>Ft ASO</small></th>
</tfoot>
<tbody>
    <?php
    $pdo = Database::connect();
    $sql = "SELECT funcionarios.id as 'id', funcionarios.matricula AS 'matricula', funcionarios.nome_funcionario AS 'nome', funcionarios.flg_periodico AS 'flg_periodico', 
                funcionarios.cpf AS 'cpf', funcionarios.cod_cargo as 'cargo', funcionarios.id as 'id', funcionarios.erro as 'erro', 
                funcionarios.erro_identificacao as 'erro_identificacao', funcionarios.erro_riscos as 'erro_riscos',
                funcionarios.erro_data_ASO as 'erro_data_ASO', funcionarios.erro_data_exames as 'erro_data_exames',
                funcionarios.erro_assinatura_ativo as 'erro_assinatura_ativo',funcionarios.erro_assinatura_medico as 'erro_assinatura_medico',
                funcionarios.erro_carimbo as 'erro_carimbo',funcionarios.erro_rasuras as 'erro_rasuras',
                funcionarios.erro_falta_apto as 'erro_falta_apto',funcionarios.erro_falta_habilitado as 'erro_falta_habilitado',
                funcionarios.erro_tel as 'erro_tel',funcionarios.erro_coord as 'erro_coord',funcionarios.erro_duplicado as 'erro_duplicado',funcionarios.erro_falta_aso as 'falta_aso' 
            FROM wal_funcionarios funcionarios  
            WHERE funcionarios.flg_periodico in (0,1) and periodo in ('2016a') and funcionarios.cod_empresa > 0 $empresa_work $estabelecimento_work 
            ORDER BY funcionarios.cod_empresa, funcionarios.cod_cargo asc";
    foreach ($pdo->query($sql) as $value) {

        $sql_cargo = "SELECT desc_cargo FROM wal_cargo_2016 WHERE cod_cargo = ?";
        $qsql_cargo = $pdo->prepare($sql_cargo);
        $qsql_cargo->execute(array($value['cargo']));
        $cargo_consult = $qsql_cargo->fetch(PDO::FETCH_ASSOC);

        $erro = $value['erro'] == 1 ? "checked" : "";
        $erro_identificacao = $value['erro_identificacao'] == 1 ? "checked" : "";
        $erro_riscos = $value['erro_riscos'] == 1 ? "checked" : "";
        $erro_data_ASO = $value['erro_data_ASO'] == 1 ? "checked" : "";
        $erro_data_exames = $value['erro_data_exames'] == 1 ? "checked" : "";
        $erro_assinatura_ativo = $value['erro_assinatura_ativo'] == 1 ? "checked" : "";
        $erro_assinatura_medico = $value['erro_assinatura_medico'] == 1 ? "checked" : "";
        $erro_carimbo = $value['erro_carimbo'] == 1 ? "checked" : "";
        $erro_rasuras = $value['erro_rasuras'] == 1 ? "checked" : "";
        $erro_falta_apto = $value['erro_falta_apto'] == 1 ? "checked" : "";
        $erro_falta_habilitado = $value['erro_falta_habilitado'] == 1 ? "checked" : "";
        $erro_tel = $value['erro_tel'] == 1 ? "checked" : "";
        $erro_coord = $value['erro_coord'] == 1 ? "checked" : "";
        $erro_duplicado = $value['erro_duplicado'] == 1 ? "checked" : "";
        $falta_aso = $value['falta_aso'] == 1 ? "checked" : "";
        
        if (($value['flg_periodico'] == '1') or ($value['erro'] == '1')){
            $flg_periodico = "text-primary";
        }
        else{
            $flg_periodico = "text-danger";
        }

        echo '<tr class="' . $flg_periodico . '">';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="matricula"></small></td>';
        echo '<td><small>' . $value['matricula'] . '</small></td>';
        echo '<td class="text-uppercase"><small>' . $value['nome'] . '</small></td>';
        echo '<td class="text-uppercase"><small>' . $value['cpf'] . '</small></td>';
        echo '<td><small>' . utf8_encode($cargo_consult['desc_cargo']) . '</small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro" ' . $erro . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro_identificacao" ' . $erro_identificacao . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro_riscos" ' . $erro_riscos . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro_data_ASO" ' . $erro_data_ASO . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro_data_exames" ' . $erro_data_exames . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro_assinatura_ativo" ' . $erro_assinatura_ativo . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro_assinatura_medico" ' . $erro_assinatura_medico . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro_carimbo" ' . $erro_carimbo . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro_rasuras" ' . $erro_rasuras . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro_falta_apto" ' . $erro_falta_apto . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro_falta_habilitado" ' . $erro_falta_habilitado . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro_tel" ' . $erro_tel . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro_coord" ' . $erro_coord . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="erro_duplicado" ' . $erro_duplicado . '></small></td>';
        echo '<td class="vcenter"><small><input type="checkbox" value="' . $value['id'] . '" name="falta_aso" ' . $falta_aso . '></small></td>';
        echo '</tr>';
    }
    Database::disconnect();
    ?>
</tbody>
</table>