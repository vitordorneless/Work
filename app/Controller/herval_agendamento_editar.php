<?php
session_start();
require '../Model/Herval.php';
require '../Model/Herval_Agendamento.php';
$herval = new Herval_Agendamento();
$herval->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$herval->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$herval->set_valor_consulta(filter_input(INPUT_POST, 'consulta', FILTER_SANITIZE_STRING));
$herval->set_id_medico(filter_input(INPUT_POST, 'medico', FILTER_SANITIZE_NUMBER_INT));
$herval->set_id_situacao(filter_input(INPUT_POST, 'situacao', FILTER_SANITIZE_NUMBER_INT));
$herval->set_data_agendamento(filter_input(INPUT_POST, 'data_agendamento', FILTER_SANITIZE_STRING));
$herval->set_id_unidade(filter_input(INPUT_POST, 'unidade', FILTER_SANITIZE_STRING));
$herval->set_id_tipo_agendamento(filter_input(INPUT_POST, 'id_tipo_agendamento', FILTER_SANITIZE_NUMBER_INT));
$herval->set_user_cad($_SESSION['user_id']);
$array_herval = $herval->Dados_Herval_agendamentos($herval->get_id());
$confirm = $herval->edit_Herval_agendamento($herval->get_id(), $herval->get_id_unidade(), $herval->get_id_tipo_agendamento(), 
        $herval->get_data_agendamento(), $herval->get_id_situacao(), $herval->get_id_medico(), $herval->get_valor_consulta(), 
        $array_herval['voucher'], $herval->get_user_cad(), $herval->get_status());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Agendamento Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}