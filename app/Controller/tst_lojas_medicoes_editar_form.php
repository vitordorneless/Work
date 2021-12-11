<?php
session_start();
require '../Model/Tecnicos_Seguranca_Trabalho.php';
require '../Model/TST_checklist_Medicao.php';
require '../Model/TST_Log.php';

$tst = new TST_checklist_Medicao();
$log = new TST_Log();

$tst->set_id_unidade(filter_input(INPUT_POST, 'id_unidade', FILTER_SANITIZE_NUMBER_INT));
$tst->set_setor(filter_input(INPUT_POST, 'setor', FILTER_SANITIZE_STRING));
$tst->set_funcao(filter_input(INPUT_POST, 'funcao', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$tst->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$tst->set_db(filter_input(INPUT_POST, 'db', FILTER_SANITIZE_STRING));
$tst->set_lux(filter_input(INPUT_POST, 'lux', FILTER_SANITIZE_STRING));

$confirm = $tst->edit_TST_checklist_Medicao($tst->get_id(), $tst->get_id_unidade(), $tst->get_setor(), $tst->get_funcao(), $tst->get_db(), $tst->get_lux(), $tst->get_status());
$confirm == TRUE ? $log->save_TST_Log('Edição de Medição na loja '.$tst->get_id_unidade(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 1) : $log->save_TST_Log('Edição de Medição com erro na loja '.$tst->get_id_unidade(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 0);

if ($confirm === TRUE) {    
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Medição Gravada com Sucesso!!</div>';
} else {    
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}