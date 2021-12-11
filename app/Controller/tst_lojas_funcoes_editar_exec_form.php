<?php
session_start();
require '../Model/Tecnicos_Seguranca_Trabalho.php';
require '../Model/TST_checklist_funcao.php';
require '../Model/TST_Log.php';
$log = new TST_Log();
$tst = new TST_checklist_funcao();
$tst->set_id_unidade(filter_input(INPUT_POST, 'id_unidade', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$tst->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$tst->set_nome_cargo(filter_input(INPUT_POST, 'nome_funcao', FILTER_SANITIZE_STRING));
$tst->set_obs(filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING));
$confirm = $tst->edit_TST_checklist_funcao($tst->get_id(), $tst->get_id_unidade(), $tst->get_nome_cargo(), $tst->get_obs(), $tst->get_status());
$confirm == TRUE ? $log->save_TST_Log('Edição da função na loja '.$tst->get_id_unidade(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 1) : $log->save_TST_Log('Edição da função com erro na loja '.$tst->get_id_unidade(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 0);
if ($confirm === TRUE) {    
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Função Editada com Sucesso!!</div>';
} else {    
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}