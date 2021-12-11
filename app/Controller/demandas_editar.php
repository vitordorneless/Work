<?php
require '../Model/Demanda.php';
require '../Model/Demandas.php';
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$demandas = filter_input(INPUT_POST, 'demanda', FILTER_SANITIZE_STRING);
$desc_demanda = filter_input(INPUT_POST, 'desc_demanda', FILTER_SANITIZE_STRING);
$ativo = filter_input(INPUT_POST, 'ativo', FILTER_SANITIZE_NUMBER_INT);
$demanda = new Demandas();
$demanda->set_id($id);
$demanda->set_title_demanda($demandas);
$demanda->set_desc_demanda($desc_demanda);
$demanda->set_ativo($ativo);
$confirm = $demanda->editDemanda($demanda->get_id(), $demanda->get_title_demanda(), $demanda->get_desc_demanda(), $demanda->get_ativo());
if($confirm === TRUE)
    echo '<div class="alert alert-success" role="alert">Demanda Editada com Absoluto Sucesso</div>';
else
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';
