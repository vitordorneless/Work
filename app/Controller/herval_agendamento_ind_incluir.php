<?php
require '../Model/Herval.php';
require '../Model/Herval_Agendamento.php';
require '../Model/Herval_Agendamento_Individual.php';

$herval = new Herval_Agendamento();
$individual = new Herval_Agendamento_Individual();

$herval->set_id_unidade(filter_input(INPUT_POST, 'id_unidade', FILTER_SANITIZE_NUMBER_INT));
$herval->set_id(filter_input(INPUT_POST, 'id_ativo', FILTER_SANITIZE_NUMBER_INT));
$herval->set_id_convocacao(filter_input(INPUT_POST, 'id_convocacao', FILTER_SANITIZE_NUMBER_INT));
$herval->set_data(filter_input(INPUT_POST, 'data_agendamento', FILTER_SANITIZE_STRING));
$herval->set_horario(filter_input(INPUT_POST, 'horario', FILTER_SANITIZE_STRING));
$array_herval = $herval->Dados_Herval_agendamentos($herval->get_id_convocacao());
$confirm = $individual->save_Herval_Agendamento_Individual($herval->get_id(), $herval->get_id_convocacao(), 
        $herval->get_id_unidade(), $array_herval['id_medico'], $array_herval['id_situacao'], $herval->get_data(), $herval->get_horario());

if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Agendamento Gravado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}