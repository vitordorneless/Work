<?php
session_start();
require '../Model/Tecnicos_Seguranca_Trabalho.php';
require '../Model/TST_Cargo_Tecnicos.php';
require '../Model/TST_Log.php';
$log = new TST_Log();
$tst = new TST_Cargo_Tecnicos();
$tst->set_nome_cargo(filter_input(INPUT_POST, 'nome_cargo', FILTER_SANITIZE_STRING));
$tst->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$confirm = $tst->edit_TST_Cargos_Tecnicos($tst->get_id(), $tst->get_nome_cargo(), 1);
$confirm == TRUE ? $log->save_TST_Log('Edição de Nome de Cargo '.$tst->get_nome_cargo(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 1) : $log->save_TST_Log('Edição de Nome de Cargo '.$tst->get_nome_cargo(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 0);
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Tipo de Cargo Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}