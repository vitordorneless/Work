<?php
require '../Model/Herval.php';
require '../Model/Herval_Sintese_Cabecalho.php';
$herval = new Herval_Sintese_Cabecalho();
$herval->set_id_unidade(filter_input(INPUT_POST, 'id_unidade', FILTER_SANITIZE_NUMBER_INT));
$herval->set_cnpj(filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING));
$herval->set_inscricao_estadual(filter_input(INPUT_POST, 'ins_est', FILTER_SANITIZE_STRING));
$herval->set_cnae(filter_input(INPUT_POST, 'cnae', FILTER_SANITIZE_STRING));
$herval->set_grau_risco(filter_input(INPUT_POST, 'grau_de_risco', FILTER_SANITIZE_STRING));
$herval->set_endereco(filter_input(INPUT_POST, 'ende', FILTER_SANITIZE_STRING));
$herval->set_media_empregados(filter_input(INPUT_POST, 'media_emp', FILTER_SANITIZE_NUMBER_INT));
$herval->set_atividades_realizadas(filter_input(INPUT_POST, 'ativ_reali', FILTER_SANITIZE_STRING));
$herval->set_local_atividades_realizadas(filter_input(INPUT_POST, 'local_ativ_reali', FILTER_SANITIZE_STRING));
$herval->set_id_empresa(filter_input(INPUT_POST, 'id_empresa', FILTER_SANITIZE_NUMBER_INT));


$confirm = $herval->save_Herval_Agendamento($herval->get_id_empresa(), $herval->get_id_unidade(), $herval->get_cnpj(), 
        $herval->get_inscricao_estadual(), $herval->get_cnae(), $herval->get_grau_risco(), $herval->get_media_empregados(), 
        $herval->get_endereco(), $herval->get_atividades_realizadas(), $herval->get_local_atividades_realizadas());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Cabeçalho Gravado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}