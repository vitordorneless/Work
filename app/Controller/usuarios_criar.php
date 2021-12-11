<?php
require '../Model/Usuario.php';
require '../Model/Usuarios.php';
$user = new Usuarios();
$user->set_nome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$user->set_pass(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));
$user->set_email(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
$user->set_admin(filter_input(INPUT_POST, 'admin', FILTER_SANITIZE_NUMBER_INT));
$user->set_nome_extenso(filter_input(INPUT_POST, 'nome_extenso', FILTER_SANITIZE_STRING));
$user->set_setor(filter_input(INPUT_POST, 'setor', FILTER_SANITIZE_NUMBER_INT));
$confirm = $user->saveUser($user->get_nome(), $user->get_pass(), $user->get_email(), $user->get_admin(), $user->get_nome_extenso(), $user->get_setor());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success" role="alert">Usuário Criado com Sucesso!</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';
}