<?php
require '../Model/Responsavel_Walmart.php';
require '../Model/Responsaveis_Walmart.php';
$responsavel = new Responsaveis_Walmart();
$responsavel->set_nome_responsavel(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$responsavel->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$responsavel->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$responsavel->set_id_empresa(filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_NUMBER_INT));
$responsavel->set_id_loja(filter_input(INPUT_POST, 'estabelecimento', FILTER_SANITIZE_NUMBER_INT));
$responsavel->set_ddd(filter_input(INPUT_POST, 'ddd', FILTER_SANITIZE_NUMBER_INT));
$responsavel->set_telefone(filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_NUMBER_INT));
$responsavel->set_email(filter_input(INPUT_POST, 'email_responsavel', FILTER_SANITIZE_STRING));
$confirm = $responsavel->edit_Responsaveis_Walmart($responsavel->get_id(), $responsavel->get_id_empresa(), $responsavel->get_id_loja(), 
        $responsavel->get_nome_responsavel(), $responsavel->get_ddd(), $responsavel->get_telefone(), $responsavel->get_email(), $responsavel->get_status());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Médico Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}