<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$demanda = new Demandas_Prazos();
$demanda->set_desc_demanda(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$demanda->set_tipo(filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING));
$confirm = $demanda->saveDemanda($demanda->get_desc_demanda(), $demanda->get_tipo());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Gravado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}