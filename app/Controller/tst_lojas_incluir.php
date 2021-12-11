<?php
session_start();
require '../Model/Tecnicos_Seguranca_Trabalho.php';
require '../Model/TST_Lojas.php';
require '../Model/TST_Log.php';
$log = new TST_Log();
$tst = new TST_Lojas();
$tst->set_cnpj(filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING));
$tst->set_nome_unidade(filter_input(INPUT_POST, 'nome_unidade', FILTER_SANITIZE_STRING));
$tst->set_palavra_chave(filter_input(INPUT_POST, 'palavra_chave', FILTER_SANITIZE_STRING));
$tst->set_endereco(filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING));
$tst->set_numero(filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING));
$tst->set_complemento(filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING));
$tst->set_id_estado(filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_cidade(filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_NUMBER_INT));
$tst->set_bairro(filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING));
$tst->set_cep(filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING));

$confirm = $tst->save_TST_Lojas($tst->get_cnpj(), $tst->get_nome_unidade(), $tst->get_palavra_chave(), 
        $tst->get_endereco().','.$tst->get_numero().' complemento: '.$tst->get_complemento(), $tst->get_bairro(), 
        $tst->get_id_cidade(), $tst->get_id_estado(), $tst->get_cep());

$confirm == TRUE ? $log->save_TST_Log('Inclusão de Loja '.$tst->get_nome_unidade(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 1) : $log->save_TST_Log('Inclusão de Loja', $_SESSION['user_id'], date('Y-m-d H:i:s'), 0);
echo $confirm == TRUE ? '<div class="alert alert-success" role="alert">Loja Criada!</div>' : '<div class="alert alert-danger" role="alert">Errou!</div>';