<?php
require '../Model/Convocar.php';
require '../Model/Datas_Eventos_Convocacao.php';
$datim = new Datas_Eventos_Convocacao();
$datim->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$datim->set_horario(filter_input(INPUT_POST, 'horario', FILTER_SANITIZE_STRING));
$datim->set_horario_final(filter_input(INPUT_POST, 'horario_final', FILTER_SANITIZE_STRING));
$datim->set_data_evento(filter_input(INPUT_POST, 'data_evento', FILTER_SANITIZE_STRING));
$confirm = $datim->edit_Horarios_Datas_Eventos_Convocacao($datim->get_id(), $datim->get_data_evento(), $datim->get_horario(), $datim->get_horario_final());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <p>Editado esta Data!!</p></div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Erro!! Contate a TI-AMA...</div>';
}