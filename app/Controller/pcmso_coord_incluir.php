<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$pcmso = new Coordenador_PCMSO();
$pcmso->set_nome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$pcmso->set_cargo(filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRING));
$pcmso->set_conselho(filter_input(INPUT_POST, 'conselho', FILTER_SANITIZE_STRING));
$pcmso->set_crm(filter_input(INPUT_POST, 'crm', FILTER_SANITIZE_STRING));
$confirm = $pcmso->save_Coordenador_PCMSO($pcmso->get_nome(), $pcmso->get_cargo(), $pcmso->get_conselho(), $pcmso->get_crm());

if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Gravado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}