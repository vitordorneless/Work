<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$demanda = new Demandas_Tipos();
$demanda->set_desc_demanda(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$demanda->set_sla(filter_input(INPUT_POST, 'sla', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_setor(filter_input(INPUT_POST, 'setor', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_executantes(filter_input(INPUT_POST, 'user_executante', FILTER_SANITIZE_NUMBER_INT));
$confirm = $demanda->editDemanda($demanda->get_id(), $demanda->get_desc_demanda(), $demanda->get_sla(), $demanda->get_setor(), $demanda->get_executantes(), $demanda->get_status());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}