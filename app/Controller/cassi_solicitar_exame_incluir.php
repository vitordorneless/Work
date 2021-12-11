<?php
require '../Model/Cassi.php';
require '../Model/Cassi_Solicitar_Exame.php';
$cassi = new Cassi_Solicitar_Exame();
$cassi->set_id_exame(filter_input(INPUT_POST, 'id_exame', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_data_solicitacao(filter_input(INPUT_POST, 'data_solicitacao', FILTER_SANITIZE_STRING));
$cassi->set_nome_combo(filter_input(INPUT_POST, 'nome_combo', FILTER_SANITIZE_STRING));
$cassi->set_nome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$cassi->set_identidade(filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_STRING));
$cassi->set_cpf(filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING));
$cassi->set_data_nascimento(filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_STRING));
$cassi->set_funcao(filter_input(INPUT_POST, 'funcao', FILTER_SANITIZE_STRING));
$cassi->set_id_cassi_solicitante(filter_input(INPUT_POST, 'id_cassi_solicitante', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_id_prestador(filter_input(INPUT_POST, 'id_prestador', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_id_medico(filter_input(INPUT_POST, 'id_medico', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_id_cidade_solicitada(filter_input(INPUT_POST, 'id_cidade_solicitada', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_id_cidade_realizada(filter_input(INPUT_POST, 'id_cidade_realizada', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_turno(filter_input(INPUT_POST, 'turno', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_prazo_limite(filter_input(INPUT_POST, 'prazo_limite', FILTER_SANITIZE_STRING));
$cassi->set_horario(filter_input(INPUT_POST, 'horario', FILTER_SANITIZE_STRING));
$cassi->set_data_exame(filter_input(INPUT_POST, 'data_exame', FILTER_SANITIZE_STRING));
$cassi->set_obs(filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING));
$cassi->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_user_agendamento(filter_input(INPUT_POST, 'user', FILTER_SANITIZE_NUMBER_INT));

$confirm = $cassi->save_Cassi_Solicitar_Exame($cassi->get_id_exame(), $cassi->get_data_solicitacao(), $nome = $cassi->get_nome_combo() == 'na' ? $cassi->get_nome() : $cassi->get_nome_combo(), 
        $cassi->get_identidade(), $cassi->get_cpf(), $cassi->get_data_nascimento(), $cassi->get_funcao(), $cassi->get_id_cassi_solicitante(), 
        $cassi->get_id_prestador(), $id_medico = $cassi->get_id_medico() == 0 ? 9999999 : $cassi->get_id_medico(), 
        $cassi->get_id_cidade_solicitada(), $cassi->get_id_cidade_realizada(), $cassi->get_turno(), $cassi->get_prazo_limite(), $cassi->get_horario(), 
        $cassi->get_data_exame(), $cassi->get_obs(), $cassi->get_user_agendamento(), $cassi->get_status());

if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Solicitação de Exame Incluído com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}