<?php

function permissaoWalmart($usuario){
    require '../Model/Permissao_Walmart.php';
    $user = new Permissao_Walmart();
    $confirm = $user->PermitUser_Walmart($usuario);
    return $confirm;
}