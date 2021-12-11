<?php
function sub_querie_Execucao($id){
    require '../Model/Chamado.php';
    require '../Model/Chamados_Analise.php';
    $chamado = new Chamados_Analise();
    $chamado->set_executante($id);
    $em_execucao = $chamado->Chamados_em_Execucao_Usuario($chamado->get_executante());
    return $em_execucao;
}