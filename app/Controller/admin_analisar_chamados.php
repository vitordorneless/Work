<?php
session_start();
require '../Model/Chamado.php';
require '../Model/Chamados_Analise.php';
require '../Model/Chamados.php';
require '../Model/Mail.php';
require '../Model/Email.php';
require '../Model/Status.php';
include '../../class/ayuadame.php';

$id_chamado = filter_input(INPUT_POST, 'id_chamado', FILTER_SANITIZE_NUMBER_INT);
$protocolo = filter_input(INPUT_POST, 'protocolo', FILTER_SANITIZE_NUMBER_INT);
$data_ultima_alteracao = filter_input(INPUT_POST, 'data_ultima_alteracao', FILTER_SANITIZE_STRING);
$prazo = filter_input(INPUT_POST, 'prazo', FILTER_SANITIZE_NUMBER_INT);
$procedencia = 'procedente';
$id_usuario = $_SESSION['user_id'];
$chamado = new Chamados_Analise();
$chamado->set_id_chamado($id_chamado);
$chamado->set_protocolo($protocolo);
$chamado->set_data_entrada($data_ultima_alteracao);
$chamado->set_prazo($prazo);
$chamado->set_validade($prazo);
$chamado->set_procedente($procedencia);
$chamado->set_id_usuario($id_usuario);
$chamado->set_executante(filter_input(INPUT_POST, 'executante', FILTER_SANITIZE_NUMBER_INT));
$chamado->set_emergencial(filter_input(INPUT_POST, 'emergencial', FILTER_SANITIZE_NUMBER_INT));
if($chamado->get_procedente() === "procedente"){
    $chamado->set_status(2);
}  else {
    $chamado->set_status(1);
}
$confirm = $chamado->save_Chamado_Analise($chamado->get_id_chamado(), $chamado->get_protocolo(), 
        $chamado->get_id_usuario(), $chamado->get_data_entrada(), $chamado->get_prazo(), $chamado->get_validade(), 
        $chamado->get_procedente(), $chamado->get_status(), $chamado->get_executante(), $chamado->get_emergencial());

$status_obj = new Status();
$id_status = $status_obj->Dados_Status($chamado->get_status());
$desc_status = $id_status['desc_status'];
if ($confirm === TRUE) {    
    $chamado_aberto = new Chamados();
    $chamado_aberto->edit_status_Chamado($chamado->get_id_chamado(), $chamado->get_status(), $chamado->get_executante());    
    echo '<div class="alert alert-success" role="alert">Chamado Analisado com Sucesso! <br>Agora deves executar o mesmo!!</div>';
} else{
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';
}