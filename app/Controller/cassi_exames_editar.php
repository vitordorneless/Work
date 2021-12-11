<?php
session_start();
require '../Model/Cassi.php';
require '../Model/Cassi_Agendamento.php';
$cassi = new Cassi_Agendamento();

$cassi->set_municipio(filter_input(INPUT_POST, 'municipio', FILTER_SANITIZE_STRING));
$cassi->set_data_agendamento(filter_input(INPUT_POST, 'data_agendamento', FILTER_SANITIZE_STRING));
$cassi->set_horario(filter_input(INPUT_POST, 'horario_chegada', FILTER_SANITIZE_STRING));
$cassi->set_id_cassi_situacao(filter_input(INPUT_POST, 'situacao', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_id_medico(filter_input(INPUT_POST, 'medico', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_valor_consulta(filter_input(INPUT_POST, 'consulta', FILTER_SANITIZE_STRING));
$cassi->set_user_agendamento($_SESSION['user_id']);
$cassi->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));

$confirm_agenda = $cassi->edit_Cassi_Agendamento($cassi->get_id(), $cassi->get_municipio(), 
        $cassi->get_data_agendamento(), $cassi->get_horario(), $cassi->get_id_cassi_situacao(), 
        $cassi->get_id_medico(), $cassi->get_valor_consulta(), $cassi->get_user_agendamento(), $cassi->get_status());

if ($confirm_agenda === TRUE) {
    echo '<div class="alert alert-success" role="alert">Agenda Editada com Sucesso!</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';
}    