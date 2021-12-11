<?php
require '../Model/Herval.php';
require '../Model/Herval_Tipo_Agendamento.php';
$herval = new Herval_Tipo_Agendamento();
$herval->set_nome_agendamento(filter_input(INPUT_POST, 'nome_agendamento', FILTER_SANITIZE_STRING));
$confirm = $herval->save_Herval_Tipo_Agendamento($herval->get_nome_agendamento());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Tipo de Agendamento Gravado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}