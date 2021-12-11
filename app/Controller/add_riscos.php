<?php

require '../Model/Riscos.php';
require '../Model/Riscos_Operations.php';
require '../Model/Wal_Apto_Altura.php';
$riscos = new Riscos_Operations();
$apto = new Wal_Apto_Altura();
$riscos->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_trab_altura(filter_input(INPUT_POST, 'trab_altura', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_apto_altura(filter_input(INPUT_POST, 'apto_trab_altura', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_acuidade_visual(filter_input(INPUT_POST, 'acuidade_visual', FILTER_SANITIZE_NUMBER_INT));

if ($riscos->get_trab_altura() === '1') {
    $confirm = $riscos->save_Exames_por_Ativos_Walmart($riscos->get_id(), 21);
} else {
    $confirm = FALSE;
}

if ($riscos->get_apto_altura() === '1') {
    $confirm1 = $apto->save_Apto($riscos->get_id(), $riscos->get_apto_altura());
} else {
    $confirm1 = FALSE;
}

if ($riscos->get_acuidade_visual() === '1') {
    $confirm = $riscos->save_Exames_por_Ativos_Walmart($riscos->get_id(), 13);
} else {
    $confirm = FALSE;
}

if (($confirm === TRUE) or ( $confirm1 === TRUE) or ( $confirm2 === TRUE)) {
    if ($confirm === TRUE) {
        echo '<div class="alert alert-success" role="alert">Risco Adicionado!</div>';
    }
    if ($confirm1 === TRUE) {
        echo '<div class="alert alert-success" role="alert">Quando o ASO for Impresso pela gráfica, irá aparecer a Opção APTO PARA TRABALHO EM ALTURA para ser marcada pelo médico!!</div>';
    }
} else {
    echo '<div class="alert alert-danger" role="alert">Marque Alguma opção em Negrito Amigo!!...</div>';
}