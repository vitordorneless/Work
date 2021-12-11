<?php

function permissaoAdmin($usuario) {
    require '../Model/Permissoes.php';
    $user = new Permissoes();
    $confirm = $user->PermitUser($usuario);
    return $confirm;
}