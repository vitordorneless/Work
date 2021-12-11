<?php

require '../Model/Riscos.php';
require '../Model/Riscos_Operations.php';
require '../Model/Wal_Apto_Altura.php';
$riscos = new Riscos_Operations();
$apto = new Wal_Apto_Altura();
$riscos->set_id(filter_input(INPUT_POST, 'id_funcionario', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_id_bd(filter_input(INPUT_POST, 'id_apto', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_trab_altura(filter_input(INPUT_POST, 'trab_altura', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_apto_altura(filter_input(INPUT_POST, 'apto_trab_altura', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_acuidade_visual(filter_input(INPUT_POST, 'acuidade_visual', FILTER_SANITIZE_NUMBER_INT));

if ($riscos->get_trab_altura() === '1') {
    $id_exame = $riscos->id_Altura($riscos->get_id());
    $confirm = $riscos->edit_Exames_por_Ativos_Walmart($id_exame['id'], $riscos->get_id(), 21, $riscos->get_trab_altura());
} else {
    $id_exame = $riscos->id_Altura($riscos->get_id());
    $confirm = $riscos->edit_Exames_por_Ativos_Walmart($id_exame['id'], $riscos->get_id(), 21, $riscos->get_trab_altura());
}

if ($riscos->get_acuidade_visual() === '1') {
    $id_exame = $riscos->id_Altura($riscos->get_id());
    $confirm = $riscos->edit_Exames_por_Ativos_Walmart($id_exame['id'], $riscos->get_id(), 13, $riscos->get_acuidade_visual());
} else {
    $id_exame = $riscos->id_Altura($riscos->get_id());
    $confirm = $riscos->edit_Exames_por_Ativos_Walmart($id_exame['id'], $riscos->get_id(), 13, $riscos->get_acuidade_visual());
}

if ($riscos->get_apto_altura() === '1') {
    $confirm1 = $apto->edit_Apto($riscos->get_id_bd(), $riscos->get_id(), $riscos->get_apto_altura());
} else {
    $confirm1 = $apto->edit_Apto($riscos->get_id_bd(), $riscos->get_id(), $riscos->get_apto_altura());
}

if (($confirm === TRUE) or ($confirm1 === TRUE) or ( $confirm2 === TRUE)) {
    if ($confirm === TRUE) {
        echo '<div class="alert alert-success" role="alert">Risco Editado!</div>';
    }
    if ($confirm1 === TRUE) {
        echo '<div class="alert alert-success" role="alert">Quando o ASO for Impresso pela gráfica, irá aparecer a Opção APTO PARA TRABALHO EM ALTURA para ser marcada pelo médico!!</div>';
    }
} else {
    echo '<div class="alert alert-danger" role="alert">Marque Alguma opção em Negrito Amigo!!...</div>';
}