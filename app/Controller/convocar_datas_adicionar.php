<?php
require '../Model/Convocar.php';
require '../Model/Evento_Convocacao.php';
require '../Model/Datas_Eventos_Convocacao.php';
$datinha = new Datas_Eventos_Convocacao();
$evento = new Evento_Convocacao();
$evento->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$evento->set_data_evento(filter_input(INPUT_POST, 'data_evento', FILTER_SANITIZE_STRING));
$evento->set_horario(filter_input(INPUT_POST, 'horario', FILTER_SANITIZE_STRING));
$evento->set_horario_final(filter_input(INPUT_POST, 'horario_final', FILTER_SANITIZE_STRING));
$confirm = $datinha->save_Datas_Eventos_Convocacao($evento->get_id(), $evento->get_data_evento(), $evento->get_horario(), $evento->get_horario_final());
if($confirm === TRUE)
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Data Adicionada com Sucesso!!</div>';
else
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Erro!! Contate a TI-AMA...</div>';
