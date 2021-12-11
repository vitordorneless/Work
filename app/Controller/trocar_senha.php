<?php

session_start();

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
include '../../class/alertas.php';

$user = new Usuarios();
$user->set_nova_senha(filter_input(INPUT_POST, 'nova_senha', FILTER_SANITIZE_STRING));
$user->set_nova_senha1(filter_input(INPUT_POST, 'nova_senha1', FILTER_SANITIZE_STRING));
if ($user->get_nova_senha() === $user->get_nova_senha1()) {
    $confirm = $user->edit_Pass_User($_SESSION['user_id'], $user->get_nova_senha());
    if ($confirm === TRUE) {
        echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Editado com Sucesso!!</div>';
        session_destroy();
        sleep(1);
        alerta('Deve logar novamente com a nova Senha, não a esqueça!!!!', '../../index.html');        
    } else {
        echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
    }
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Senhas Diferentes...</div>';
}