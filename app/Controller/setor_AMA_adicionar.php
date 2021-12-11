<?php
require '../Model/Usuario.php';
require '../Model/Usuarios_Setores.php';
$user = new Usuarios_Setores();
$user->set_setor(filter_input(INPUT_POST, 'setor', FILTER_SANITIZE_STRING));
$confirm = $user->save_Usuarios_Setores($user->get_setor());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Setor Gravado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}