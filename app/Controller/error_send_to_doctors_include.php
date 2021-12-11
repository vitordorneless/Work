<?php

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
include '../config/database_mysql.php';
$pdo = Database::connect();
$wal = new Wal_Envelope();
$wal->set_periodicos(filter_input(INPUT_GET, 'periodico', FILTER_SANITIZE_STRING));
$wal->set_data_retorno(filter_input(INPUT_GET, 'data_retorno', FILTER_SANITIZE_STRING));
$wal->set_data_envio_loja(filter_input(INPUT_GET, 'data_envio_loja', FILTER_SANITIZE_STRING));
$wal->set_id_forma_envio(filter_input(INPUT_GET, 'forma', FILTER_SANITIZE_NUMBER_INT));
$wal->set_id_medico(filter_input(INPUT_GET, 'id_medico', FILTER_SANITIZE_NUMBER_INT));
$wal->set_protocolo(date('Y') . $wal->get_id_medico() . date('d') . date('s'));
$periodico = $wal->get_periodicos();
if ($periodico != '') {
    $confirm = $wal->save_Wal_Envelope($wal->get_id_medico(), $wal->get_protocolo(), $wal->get_data_envio_loja(), $wal->get_id_forma_envio(), $wal->get_data_retorno(), $wal->get_periodicos());
    
    if ($confirm === TRUE) {
        echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Envelope Criado com Sucesso!!</div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Erro!! Contate a TI-AMA...<br></div>';
    }
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Tens que setar os ativos que realizaram o Periódico, apenas marque e clique no botão vermelho novamente!!</div>';
}
Database::disconnect();
