<?php
require '../Model/Usuario.php';
require '../Model/Usuarios_Setores.php';
$user = new Usuarios_Setores();
$user->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$user->set_setor(filter_input(INPUT_POST, 'setor', FILTER_SANITIZE_STRING));
$user->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$confirm = $user->edit_Usuarios_Setores($user->get_id(), $user->get_setor(), $user->get_status());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Setor Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}