<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$demanda = new Demandas_Prazos();
$demanda->set_prazo(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$demanda->set_tipo(filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING));
$demanda->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$confirm = $demanda->editDemanda($demanda->get_id(), $demanda->get_prazo(), $demanda->get_tipo(), 1);
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}