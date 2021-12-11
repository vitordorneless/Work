<?php
require '../Model/Demanda.php';
require '../Model/Solucao_Demandas.php';
$demanda = filter_input(INPUT_POST, 'demanda', FILTER_SANITIZE_NUMBER_INT);
$desc_demanda = filter_input(INPUT_POST, 'desc_demanda', FILTER_SANITIZE_STRING);
$prazo = filter_input(INPUT_POST, 'prazo', FILTER_SANITIZE_NUMBER_INT);
$solucao = new Solucao_Demandas();
$solucao->set_id_demanda($demanda);
$solucao->set_desc_demanda($desc_demanda);
$solucao->set_prazo($prazo);
$confirm = $solucao->save_Solucao_Demanda($solucao->get_id_demanda(), $solucao->get_desc_demanda(), $solucao->get_prazo());
if($confirm === TRUE)
    echo '<div class="alert alert-success" role="alert">Solução de Demanda gravada com Absoluto Sucesso</div>';
else
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';