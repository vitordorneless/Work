<?php

require '../Model/Chamado.php';
require '../Model/Chamados.php';

$chamado = new Chamados();
$chamado->set_protocolo(filter_input(INPUT_POST, 'protocolo', FILTER_SANITIZE_NUMBER_INT));
$chamado->set_novo_executante(filter_input(INPUT_POST, 'novo_executante', FILTER_SANITIZE_NUMBER_INT));

$confirm1 = $chamado->novo_executante_Chamado($chamado->get_protocolo(), $chamado->get_novo_executante());
$confirm2 = $chamado->novo_executante_Chamado_Analise($chamado->get_protocolo(), $chamado->get_novo_executante());

if(($confirm1 === TRUE) and ($confirm2 === TRUE)){
    echo '<div class="alert alert-success" role="alert">Parabéns!! Executante trocado com Sucesso!</div>';
}  else {
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';
}
