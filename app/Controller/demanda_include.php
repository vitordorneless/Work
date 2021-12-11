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
$demanda->set_id(filter_input(INPUT_POST, 'criador_demanda', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_setor(filter_input(INPUT_POST, 'setor', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_destinosetor(filter_input(INPUT_POST, 'setor_destino', FILTER_SANITIZE_STRING));
$demanda->set_id_responsavel(filter_input(INPUT_POST, 'demanda_responsavel', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_executantes(filter_input(INPUT_POST, 'executante', FILTER_SANITIZE_STRING));
$demanda->set_id_demanda(filter_input(INPUT_POST, 'demanda', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_copyemail(filter_input(INPUT_POST, 'copyemail', FILTER_SANITIZE_STRING));
$demanda->set_prazo(filter_input(INPUT_POST, 'prazo', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_status(filter_input(INPUT_POST, 'id_status', FILTER_SANITIZE_NUMBER_INT));
$array_user_abertura = $user->Dados_User($demanda->get_id());
$array_id_responsavel = $user->Dados_User($demanda->get_id_responsavel());
$array_executante = $user->Dados_User($demanda->get_executantes());
$array_demanda = $tipo_demanda->Dados_Demandas($demanda->get_id_demanda());
$array_prazo = $prazo->Dados_Demandas($demanda->get_prazo());
$voucher = $demanda->Next_ID();
$confirm = $demanda->saveDemanda($demanda->get_id(), $demanda->get_setor(), $demanda->get_destinosetor(), $demanda->get_id_responsavel(), $demanda->get_executantes(), $demanda->get_id_demanda(), $demanda->get_copyemail(), $demanda->get_prazo(), $demanda->get_status());
$body = '<div class="containerr">';
$body = $body . '<h3>Demanda: ' . $array_demanda['tipo_demanda'] . '</h3>';
$body = $body . '<p>ID: ' . $voucher . '</p>';
$body = $body . '<p>Responsável: ' . $array_user_abertura['nome_extenso'] . '</p>';
$body = $body . '<p>Executante: ' . $array_executante['nome_extenso'] . '</p>';
$body = $body . '<p>Prazo: ' . $array_prazo['prazo'] . ' ' . $array_prazo['tipo'] . '</p>';
$body = $body . '<p>Email: <small>' . $demanda->get_copyemail() . '</small></p>';
$body = $body . '</div>';
$cuerpo = beginHTML() . $body . endHTML();
$subject = $voucher . ' ' . $array_demanda['tipo_demanda'];
if ($confirm === TRUE) {
    $mail->EnviarSuperEmail($array_user_abertura['email'], $array_id_responsavel['email'], $array_executante['email'], 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', $subject, $cuerpo);
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Gravado com Sucesso!!<br>ID: '.$voucher.'</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}