<?php
require '../Model/Demanda.php';
require '../Model/Solucao_Demandas.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$id_demanda = filter_input(INPUT_POST, 'id_demanda', FILTER_SANITIZE_NUMBER_INT);
$desc_demanda = filter_input(INPUT_POST, 'desc_demanda', FILTER_SANITIZE_STRING);
$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
$prazo = filter_input(INPUT_POST, 'prazo', FILTER_SANITIZE_NUMBER_INT);

$demanda = new Solucao_Demandas();
$demanda->set_id($id);
$demanda->set_id_demanda($id_demanda);
$demanda->set_desc_solucao($desc_demanda);
$demanda->set_ativo($status);
$demanda->set_prazo($prazo);

$confirm = $demanda->edit_Solucao_Demanda($demanda->get_id(), $demanda->get_id_demanda(), $demanda->get_desc_solucao(), $demanda->get_prazo(), $demanda->get_ativo());
if($confirm === TRUE)
    echo '<div class="alert alert-success" role="alert">Solução de Demanda Editada com Absoluto Sucesso</div>';
else
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';

 