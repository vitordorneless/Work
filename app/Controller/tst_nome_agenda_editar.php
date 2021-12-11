<?php
require '../Model/Tecnicos_Seguranca_Trabalho.php';
require '../Model/TST_Tipo_Agendamento.php';
require '../Model/TST_Log.php';
$log = new TST_Log();
$tst = new TST_Tipo_Agendamento();
$tst->set_nome_agendamento(filter_input(INPUT_POST, 'nome_agendamento', FILTER_SANITIZE_STRING));
$tst->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$confirm = $tst->edit_TST_Tipo_Agendamento($tst->get_id(), $tst->get_nome_agendamento(), 1);
$confirm == TRUE ? $log->save_TST_Log('Edição de Nome de Agendamento '.$tst->get_nome_agendamento(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 1) : $log->save_TST_Log('Edição de Nome de Agendamento '.$tst->get_nome_agendamento(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 0);
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Tipo de Agendamento Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}