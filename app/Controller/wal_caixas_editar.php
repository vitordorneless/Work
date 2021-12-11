<?php
session_start();
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$box = new Wal_Caixa();
$box->set_etiqueta(filter_input(INPUT_POST, 'etiqueta', FILTER_SANITIZE_STRING));
$box->set_id_wal_box(filter_input(INPUT_POST, 'id_wal_box', FILTER_SANITIZE_NUMBER_INT));
$box->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$box->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$box->set_id_usuario($_SESSION['user_id']);
$confirm = $box->edit_Caixa($box->get_id(), $box->get_etiqueta(), $box->get_id_usuario(), $box->get_id_wal_box(), $box->get_status());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <p>Etiqueta Editada, cole ela na Caixa agora amiguinho!!</p></div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Erro!! Contate a TI-AMA...</div>';
}