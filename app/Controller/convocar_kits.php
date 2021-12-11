<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$kit = new Wal_Kit();
$evento = new Evento_Convocacao();
$kit->set_id_convocacao(filter_input(INPUT_POST, 'id_convocacao', FILTER_SANITIZE_NUMBER_INT));
$kit->set_rastreamento(filter_input(INPUT_POST, 'rastreamento', FILTER_SANITIZE_STRING));
$kit->set_data_envio(filter_input(INPUT_POST, 'data_envio', FILTER_SANITIZE_STRING));
$confirm = $kit->save_Wal_Kit($kit->get_id_convocacao(), $kit->get_rastreamento(), $kit->get_data_envio());
$evento->edit_Evento_Convocacao_Kit($kit->get_id_convocacao(), 1, 1);

if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Gravado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}