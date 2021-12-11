<?php

require '../Model/Grafica.php';
$grafica = new Grafica();
$empresa = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_NUMBER_INT);
$estabelecimento = filter_input(INPUT_POST, 'estabelecimento', FILTER_SANITIZE_NUMBER_INT);
$funcao = filter_input(INPUT_POST, 'funcao', FILTER_SANITIZE_NUMBER_INT);
$gera = $grafica->Vai_gerar_TXT($empresa, $estabelecimento);

if ($gera === TRUE) {
    echo '<a class="btn btn-primary btn-facebook pull-right" href="../Controller/txt_grafica_gerar_link.php?empresa=' . $empresa . '&estabelecimento=' . $estabelecimento . '&funcao=' . $funcao . '">Download do TXT</a>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Não possui Ativos para Geração de ASOS...</div>';
}