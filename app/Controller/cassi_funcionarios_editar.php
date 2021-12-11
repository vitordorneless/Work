<?php
require '../Model/Cassi.php';
require '../Model/Cassi_Ativos.php';
$cassi = new Cassi_Ativos();
$cassi->set_matricula(filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_prefixo(filter_input(INPUT_POST, 'agencia', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_nome_ativo(filter_input(INPUT_POST, 'nome_funcionario', FILTER_SANITIZE_STRING));
$cassi->set_id_sexo(filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_data_nascimento(filter_input(INPUT_POST, 'nascimento', FILTER_SANITIZE_STRING));
$cassi->set_user_agendamento(filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_data_posse(filter_input(INPUT_POST, 'data_posse', FILTER_SANITIZE_STRING));
$cassi->set_obs_gerais(filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING));

$confirm = $cassi->edit_Cassi_Ativos($cassi->get_id(), $cassi->get_matricula(), $cassi->get_prefixo(), $cassi->get_nome_ativo(), 
        $cassi->get_id_sexo(), 0, $cassi->get_data_nascimento(), $cassi->get_data_posse(), $cassi->get_status(), $cassi->get_obs_gerais());

if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Funcionário CASSI Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}