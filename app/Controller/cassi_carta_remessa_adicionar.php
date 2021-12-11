<?php
require '../Model/Cassi.php';
require '../Model/Cassi_Carta_Remessa.php';
$cassi = new Cassi_Carta_Remessa();
$cassi->set_peg(filter_input(INPUT_POST, 'peg', FILTER_SANITIZE_STRING));
$cassi->set_guias_anexas(filter_input(INPUT_POST, 'guias_anexas', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_valor_total(filter_input(INPUT_POST, 'valor_total', FILTER_SANITIZE_STRING));
$cassi->set_nota_fiscal_ama(filter_input(INPUT_POST, 'nf', FILTER_SANITIZE_STRING));
$cassi->set_data_envio(filter_input(INPUT_POST, 'data_envio', FILTER_SANITIZE_STRING));
$cassi->set_data_recebido_cassi(filter_input(INPUT_POST, 'data_recebido_cassi', FILTER_SANITIZE_STRING));
$cassi->set_nome_arquivo(filter_input(INPUT_POST, 'nome_arquivo', FILTER_SANITIZE_STRING));
$cassi->set_usuario_ama(filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_NUMBER_INT));

$confirm = $cassi->save_Cassi_Carta_Remessa($cassi->get_peg(), $cassi->get_guias_anexas(), $cassi->get_valor_total(), 
        $cassi->get_data_envio(), $cassi->get_data_recebido_cassi(), $cassi->get_usuario_ama(), 
        $cassi->get_nota_fiscal_ama(), $cassi->get_nome_arquivo());

if ($confirm === TRUE) {
    echo '<div class="alert alert-success" role="alert">Carta Remessa Criada!</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Erro!!...</div>';
}