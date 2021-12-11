<?php
require '../Model/Herval.php';
require '../Model/Herval_Tipo_Agendamento.php';
$herval = new Herval_Tipo_Agendamento();
$herval->set_nome_agendamento(filter_input(INPUT_POST, 'nome_agendamento', FILTER_SANITIZE_STRING));
$herval->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$confirm = $herval->edit_Herval_Tipo_Agendamento($herval->get_id(), $herval->get_nome_agendamento(), 1);
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Tipo de Agendamento Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}