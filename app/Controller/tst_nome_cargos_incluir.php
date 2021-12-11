<?php
session_start();
require '../Model/Tecnicos_Seguranca_Trabalho.php';
require '../Model/TST_Cargo_Tecnicos.php';
require '../Model/TST_Log.php';
$log = new TST_Log();
$tst = new TST_Cargo_Tecnicos();
$tst->set_nome_agendamento(filter_input(INPUT_POST, 'nome_agendamento', FILTER_SANITIZE_STRING));
$confirm = $tst->save_TST_Cargos_Tecnicos($tst->get_nome_agendamento());
$confirm == TRUE ? $log->save_TST_Log('Inclusão de Nome de Cargo '.$tst->get_nome_agendamento(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 1) : $log->save_TST_Log('Inclusão de Nome de Cargo '.$tst->get_nome_agendamento(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 0);
if ($confirm === TRUE) {    
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Cargo Gravado com Sucesso!!</div>';
} else {    
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}