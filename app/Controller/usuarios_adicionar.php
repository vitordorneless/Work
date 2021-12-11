<?php
require '../Model/Usuario.php';
require '../Model/Usuarios.php';
$user = new Usuarios();
$user->set_nome_extenso(filter_input(INPUT_POST, 'nome_extenso', FILTER_SANITIZE_STRING));
$user->set_setor(filter_input(INPUT_POST, 'setor', FILTER_SANITIZE_NUMBER_INT));
$user->set_nome(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING));
$user->set_pass(filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING));
$user->set_foto(filter_input(INPUT_POST, 'foto', FILTER_SANITIZE_STRING));
$user->set_email(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
$user->set_crm(filter_input(INPUT_POST, 'crm', FILTER_SANITIZE_STRING));
$user->set_estado_crm(filter_input(INPUT_POST, 'estado_crm', FILTER_SANITIZE_STRING));
$user->set_admin(filter_input(INPUT_POST, 'admin', FILTER_SANITIZE_NUMBER_INT));
$confirm = $user->saveUser($user->get_nome(), $user->get_pass(), 
        $user->get_email(), $user->get_admin(), $user->get_nome_extenso(), 
        $user->get_setor(), $user->get_foto(), $user->get_crm(), $user->get_estado_crm());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Usuário Gravado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}