<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
include '../../class/ayuadame.php';
$demanda = new Demandas();
$tipo_demanda = new Demandas_Tipos();
$mail = new SuperEmail();
$user = new Usuarios();
$prazo = new Demandas_Prazos();
$demanda->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_id_f(filter_input(INPUT_POST, 'ant', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_executantes(filter_input(INPUT_POST, 'executante', FILTER_SANITIZE_STRING));
$confirm = $demanda->TransfereditDemanda($demanda->get_id(), $demanda->get_executantes());
$array_demanda = $demanda->Dados_Demandas($demanda->get_id());
$voucher = date('Y') . '0' . $demanda->get_id();
$array_user_abertura = $user->Dados_User($array_demanda['id_user_abertura']);
$array_executante = $user->Dados_User($demanda->get_executantes());
$array_demandaty = $tipo_demanda->Dados_Demandas($array_demanda['id_demanda']);
$array_prazo = $prazo->Dados_Demandas($array_demanda['id_prazo']);
$array_executante_anterior = $user->Dados_User($demanda->get_id_f());
$body = '<div class="containerr">';
$body = $body . '<h3>Demanda: ' . $array_demandaty['tipo_demanda'] . ' Transferência de Executante</h3>';
$body = $body . '<p>ID: ' . $voucher . '</p>';
$body = $body . '<p><i>Executante Anterior: ' . $array_executante_anterior['nome_extenso'] . '</i></p>';
$body = $body . '<p><strong>Novo Executante: ' . $array_executante['nome_extenso'] . '</strong></p>';
$body = $body . '<p>Prazo: ' . $array_prazo['prazo'] . ' ' . $array_prazo['tipo'] . '</p>';
$body = $body . '</div>';
$cuerpo = beginHTML() . $body . endHTML();
$subject = $voucher . ' ' . $array_demandaty['tipo_demanda'].' Transferência de Executante';
if ($confirm === TRUE) {
    $mail->EnviarSuperEmail($array_user_abertura['email'],$array_executante_anterior['email'], $array_executante['email'], 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', $subject, $cuerpo);
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Transferido com Sucesso!!<br>ID: '.$voucher.'</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}