<?php
require '../Model/Medico.php';
require '../Model/Medico_Convocacao.php';
require '../Model/Medicos_Valores.php';
$medico_convocacao = new Medico_Convocacao();
$medico_valores = new Medicos_Valores();    
$medico_convocacao->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$medico_convocacao->set_nome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$medico_convocacao->set_id_medico(filter_input(INPUT_POST, 'medico', FILTER_SANITIZE_NUMBER_INT));
$medico_convocacao->set_valor(filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING));
$medico_convocacao->set_turnos(filter_input(INPUT_POST, 'turnos', FILTER_SANITIZE_STRING));
$medico_convocacao->set_data_fechamento_valores(filter_input(INPUT_POST, 'data_fechamento', FILTER_SANITIZE_STRING));
$medico_convocacao->set_id_convocacao(filter_input(INPUT_POST, 'id_convocacao', FILTER_SANITIZE_NUMBER_INT));
$confirm_one = $medico_valores->save_Medicos_Valores($medico_convocacao->get_id_medico(), 
        $medico_convocacao->get_id_convocacao(), 
        $medico_convocacao->get_id(), 
        $medico_convocacao->get_turnos(), 
        $medico_convocacao->get_valor(), 
        $medico_convocacao->get_data_fechamento_valores());        
$confirm_two = $medico_convocacao->save_Medico_Convocacao($medico_convocacao->get_id_medico(), 0, $medico_convocacao->get_id());
$dado = $medico_valores->Dados_Medicos_Valores_max_id();
$confirm_three = $medico_convocacao->edit_Medico_Convocacao_id($dado, $medico_convocacao->get_id());
if (($confirm_one === TRUE) and ($confirm_two === TRUE) and ($confirm_three === TRUE)) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<p>Médico Gravado com Sucesso!!</p><p>Caso queira inserir mais médicos, apenas preencher novamente o formulário!!</p></div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}