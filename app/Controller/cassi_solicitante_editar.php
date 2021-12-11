<?php
require '../Model/Cassi.php';
require '../Model/Cassi_Solicitante.php';
$cassi = new Cassi_Solicitante();
$cassi->set_nome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$cassi->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$confirm = $cassi->edit_Cassi_Solicitante($cassi->get_id(), $cassi->get_nome(), 1);
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Solicitante Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}