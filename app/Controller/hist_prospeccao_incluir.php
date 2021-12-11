<?php
session_start();
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$prospeccao = new Prospeccao_Medicos_e_Prestadores();
$prospeccao->set_id_prestador(filter_input(INPUT_POST, 'id_prestador', FILTER_SANITIZE_NUMBER_INT));
$prospeccao->set_id_medico(filter_input(INPUT_POST, 'id_medico', FILTER_SANITIZE_NUMBER_INT));
$prospeccao->set_data_prospeccao(filter_input(INPUT_POST, 'data_prospeccao', FILTER_SANITIZE_STRING));
$prospeccao->set_valor(filter_input(INPUT_POST, 'valor_exame', FILTER_SANITIZE_STRING));
$prospeccao->set_lojas_negociadas(filter_input(INPUT_POST, 'lojas_negociadas', FILTER_SANITIZE_STRING));
$prospeccao->set_historico_prospeccao(filter_input(INPUT_POST, 'historico', FILTER_SANITIZE_STRING));
$confirm = $prospeccao->save_Prospeccao_Medicos_e_Prestadores($prospeccao->get_id_prestador(), 
        $prospeccao->get_id_medico(), $prospeccao->get_data_prospeccao(), $prospeccao->get_historico_prospeccao(), 
        $prospeccao->get_valor(), $prospeccao->get_lojas_negociadas(), $_SESSION['user_id']);
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Gravado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}