<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$rh = new RH_Grau_Instrucao_Escolar();
$rh->set_grau(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$rh->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$rh->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$confirm = $rh->edit_RH_Grau_Instrucao_Escolar($rh->get_id(), $rh->get_grau(), $rh->get_status());
if ($confirm === TRUE) {    
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Editado com Sucesso!!</div>';
} else {    
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}