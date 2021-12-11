<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
include '../../class/ayuadame.php';
$dmed = new DMED_Interacoes();
$dmed->set_data(filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING));
$dmed->set_data_dmed(filter_input(INPUT_POST, 'data_dmed', FILTER_SANITIZE_STRING));
$dmed->set_RPPSS(filter_input(INPUT_POST, 'rppss', FILTER_SANITIZE_STRING));
$dmed->set_cpf_RPPSS(filter_input(INPUT_POST, 'cpf_rppss', FILTER_SANITIZE_STRING));
$dmed->set_BRPPSS(filter_input(INPUT_POST, 'brppss', FILTER_SANITIZE_STRING));
$dmed->set_cpf_BRPPSS(filter_input(INPUT_POST, 'cpf_brppss', FILTER_SANITIZE_STRING));
$dmed->set_dn(filter_input(INPUT_POST, 'dn', FILTER_SANITIZE_STRING));
$dmed->set_valor(filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING));
$dmed->set_recibo(filter_input(INPUT_POST, 'recibo', FILTER_SANITIZE_STRING));
$dmed->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$data = $dmed->get_data() == '1970-01-01' ? date('Y-m-d H:i:s') : $dmed->get_data();

$confirm = $dmed->edit_DMED_Interacoes($dmed->get_id(), $data, data_DMED($dmed->get_data_dmed()), $dmed->get_RPPSS(), 
        $dmed->get_cpf_RPPSS(), $dmed->get_BRPPSS(), $dmed->get_cpf_BRPPSS(), data_DMED($dmed->get_dn()), 
        $dmed->get_valor(), $dmed->get_recibo(), 0);
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}
