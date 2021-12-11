<?php
include '../Model/Herval.php';
include '../Model/Herval_Sintese_Cabecalho.php';
include '../Model/Herval_Sintese_Exames.php';
$herval = new Herval_Sintese_Cabecalho();
$sintese = new Herval_Sintese_Exames();
$herval->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_herval_cab = $herval->Dados_Herval_Agendamentos($herval->get_id());
$array_sintese = $sintese->Dados_Herval_sint_bodys($array_herval_cab['id']);
?>
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
        <h4 class="modal-title">Visualizar Síntese</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>1 - Identificação da Empresa</label>
        </div>
        <div class="form-group jumbotron">
            <p class="text-uppercase text-center"><small><?php echo $herval->Dados_Herval_Unidades($array_herval_cab['id_unidade']); ?></small></p>
            <p class="text-uppercase text-center"><small>PROGRAMA DE CONTROLE MÉDICO DE SAÚDE OCUPACIONAL</small></p>
            <p class="text text-center"><small>P.C.M.S.O. - NR.7 Portaria 24/94 da SSS</small></p>
        </div>
        <div class="form-group">
            <label>Dados da Empresa</label>
        </div>
        <div class="form-group">
            <label>Razão Social</label>
            <input type="text" class="form-control" value="<?php echo $herval->Dados_Herval_Unidades($array_herval_cab['id_unidade']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>CNPJ</label>
            <input type="text" class="form-control" value="<?php echo $array_herval_cab['cnpj']; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Inscrição Estadual</label>
            <input type="text" class="form-control" value="<?php echo $array_herval_cab['inscricao_estadual']; ?>" readonly>
        </div>
        <div class="form-group">
            <label>CNAE</label>
            <input type="text" class="form-control" value="<?php echo $array_herval_cab['cnae']; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Grau de Risco</label>
            <input type="text" class="form-control" value="<?php echo $array_herval_cab['grau_risco']; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Endereço</label>
            <input type="text" class="form-control" value="<?php echo $array_herval_cab['endereco']; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Nº Médio de Empregados</label>
            <input type="text" class="form-control" value="<?php echo $array_herval_cab['media_empregados']; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Atividades Realizadas</label>
            <input type="text" class="form-control" value="<?php echo $array_herval_cab['atividades_realizadas']; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Local das Atividades</label>
            <input type="text" class="form-control" value="<?php echo $array_herval_cab['local_atividades_realizadas']; ?>" readonly>
        </div>
    </div>
    <div class="modal-footer">Síntese Via Periódicos - Grupo AMA Saúde &copy;</div>
</div>