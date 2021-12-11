<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$rh = new RH_Grau_Instrucao_Escolar();
$rh->set_grau(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$confirm = $rh->save_RH_Grau_Instrucao_Escolar($rh->get_grau());
if ($confirm === TRUE) {    
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Gravado com Sucesso!!</div>';
} else {    
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}