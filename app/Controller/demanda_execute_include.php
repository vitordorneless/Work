<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}           
$demanda = new Demanda_Execute();
$demanda_father = new Demandas();
$demanda->set_executantes(filter_input(INPUT_POST, 'id_executante', FILTER_SANITIZE_STRING));
$demanda->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_copyemail(filter_input(INPUT_POST, 'copyemail', FILTER_SANITIZE_STRING));

$confirm = $demanda->saveDemanda($demanda->get_id(), $demanda->get_executantes(), $demanda->get_copyemail(), $demanda->get_status(), 0);
$confirmfather = $demanda_father->editDemandaStatus($demanda->get_id(), $demanda->get_status());
if (($confirm === TRUE) and ($confirmfather === TRUE)) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Executada com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}