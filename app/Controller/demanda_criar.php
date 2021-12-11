<?php
require '../Model/Demanda.php';
require '../Model/Demandas.php';
$nome_demanda = filter_input(INPUT_POST, 'nome_demanda', FILTER_SANITIZE_STRING);
$desc_demanda = filter_input(INPUT_POST, 'desc_demanda', FILTER_SANITIZE_STRING);
$demanda = new Demandas();
$demanda->set_title_demanda($nome_demanda);
$demanda->set_desc_demanda($desc_demanda);
$confirm = $demanda->saveDemanda($demanda->get_title_demanda(), $demanda->get_desc_demanda());
if($confirm === TRUE)
    echo '<div class="alert alert-success" role="alert">Demanda gravada com Absoluto Sucesso</div>';
else
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';