<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
include '../../class/ayuadame.php';
$demanda = new Demandas_Registros_Execute();
$demandas = new Demandas();
$mail = new SuperEmail();
$user = new Usuarios();
$prazo = new Demandas_Prazos();
$status_demanda = new Demandas_Status();
$tipo_demanda = new Demandas_Tipos();
$demanda->set_id_demanda(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_id(filter_input(INPUT_POST, 'id_demandaR', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_id_status_qualidade(filter_input(INPUT_POST, 'status_qualidade', FILTER_SANITIZE_NUMBER_INT));

$dados_demanda = $demandas->Dados_Demandas($demanda->get_id_demanda());
$array_user_abertura = $user->Dados_User($dados_demanda['id_user_abertura']);
$array_executante = $user->Dados_User($dados_demanda['executantes']);
$array_demanda = $tipo_demanda->Dados_Demandas($dados_demanda['id_demanda']);
$array_prazo = $prazo->Dados_Demandas($dados_demanda['id_prazo']);
$array_status = $status_demanda->Dados_Demandas($demanda->get_status());
$array_status_qualidade = $status_demanda->Dados_Demandas_Qualidade($demanda->get_id_status_qualidade());
$array_demandas_Registros = $demanda->Dados_DemandasR($demanda->get_id());
$voucher = date('Y') . '0' . $demanda->get_id_demanda();

$confirm = $demanda->editDemandaStatusR($demanda->get_id(), $demanda->get_status(), $demanda->get_id_status_qualidade());
$confirm1 = $demandas->editDemandaStatus($demanda->get_id_demanda(), $demanda->get_status());

$body = '<div class="containerr">';
$body = $body . '<h2>' . $array_status['status'] . '</h2><h3> Demanda: ' . $array_demanda['tipo_demanda'] . '</h3>';
$body = $body . '<p>Qualidade: ' . strtoupper(utf8_encode($array_status_qualidade['status'])) . '</p>';
$body = $body . '<p>ID: ' . $voucher . '</p>';
$body = $body . '<p>Responsável: ' . $array_user_abertura['nome_extenso'] . '</p>';
$body = $body . '<p>Executante: ' . $array_executante['nome_extenso'] . '</p>';
$body = $body . '<p>Prazo: ' . $array_prazo['prazo'] . ' ' . $array_prazo['tipo'] . '</p>';
$body = $body . '<p>Nome Ativo: ' . $array_demandas_Registros['nome_ativo'] . '</p>';
$body = $body . '<p>CPF Ativo: ' . $array_demandas_Registros['cpf_ativo'] . '</p>';
$body = $body . '<p>Empresa: ' . $array_demandas_Registros['empresa'] . '</p>';
$body = $body . '<p>Obs/Email: <small>' . $array_demandas_Registros['copy_mail'] . '</small></p>';
if ($array_demandas_Registros['nome_dep'] !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $array_demandas_Registros['nome_dep'] . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $array_demandas_Registros['cpf_dep'] . '</p>';
}
if ($array_demandas_Registros['nome_dep1'] !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $array_demandas_Registros['nome_dep1'] . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $array_demandas_Registros['cpf_dep1'] . '</p>';
}
if ($array_demandas_Registros['nome_dep2'] !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $array_demandas_Registros['nome_dep2'] . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $array_demandas_Registros['cpf_dep2'] . '</p>';
}
if ($array_demandas_Registros['nome_dep3'] !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $array_demandas_Registros['nome_dep3'] . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $array_demandas_Registros['cpf_dep3'] . '</p>';
}
if ($array_demandas_Registros['nome_dep4'] !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $array_demandas_Registros['nome_dep4'] . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $array_demandas_Registros['cpf_dep4'] . '</p>';
}
if ($array_demandas_Registros['nome_dep5'] !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $array_demandas_Registros['nome_dep5'] . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $array_demandas_Registros['cpf_dep5'] . '</p>';
}
if ($array_demandas_Registros['nome_dep6'] !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $array_demandas_Registros['nome_dep6'] . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $array_demandas_Registros['cpf_dep6'] . '</p>';
}
if ($array_demandas_Registros['nome_dep7'] !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $array_demandas_Registros['nome_dep7'] . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $array_demandas_Registros['cpf_dep7'] . '</p>';
}
if ($array_demandas_Registros['nome_dep8'] !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $array_demandas_Registros['nome_dep8'] . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $array_demandas_Registros['cpf_dep8'] . '</p>';
}

$body = $body . '</div>';
$cuerpo = beginHTML() . $body . endHTML();
$subject = $voucher . ' ' . strtoupper($array_status['status']) . ' ' . $array_demanda['tipo_demanda'];
if (($confirm === TRUE) and ( $confirm1 === TRUE)) {
    $mail->EnviarSuperEmail($array_user_abertura['email'], $array_executante['email'], 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', $subject, $cuerpo);
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Executado com Sucesso!!<br>ID: ' . $voucher . '</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}