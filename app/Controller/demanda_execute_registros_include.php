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
$demanda->set_id_f(filter_input(INPUT_POST, 'id_executante', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_cpf_ativo(filter_input(INPUT_POST, 'cpf_ativo', FILTER_SANITIZE_STRING));
$demanda->set_nome_ativo(filter_input(INPUT_POST, 'nome_ativo', FILTER_SANITIZE_STRING));
$demanda->set_empresa(filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_STRING));
$demanda->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$demanda->set_cpf_dep(filter_input(INPUT_POST, 'cpf_dependente', FILTER_SANITIZE_STRING));
$demanda->set_cpf_dep1(filter_input(INPUT_POST, 'cpf_dependente1', FILTER_SANITIZE_STRING));
$demanda->set_cpf_dep2(filter_input(INPUT_POST, 'cpf_dependente2', FILTER_SANITIZE_STRING));
$demanda->set_cpf_dep3(filter_input(INPUT_POST, 'cpf_dependente3', FILTER_SANITIZE_STRING));
$demanda->set_cpf_dep4(filter_input(INPUT_POST, 'cpf_dependente4', FILTER_SANITIZE_STRING));
$demanda->set_cpf_dep5(filter_input(INPUT_POST, 'cpf_dependente5', FILTER_SANITIZE_STRING));
$demanda->set_cpf_dep6(filter_input(INPUT_POST, 'cpf_dependente6', FILTER_SANITIZE_STRING));
$demanda->set_cpf_dep7(filter_input(INPUT_POST, 'cpf_dependente7', FILTER_SANITIZE_STRING));
$demanda->set_cpf_dep8(filter_input(INPUT_POST, 'cpf_dependente8', FILTER_SANITIZE_STRING));
$demanda->set_nome_dep(filter_input(INPUT_POST, 'nome_dependente', FILTER_SANITIZE_STRING));
$demanda->set_nome_dep1(filter_input(INPUT_POST, 'nome_dependente1', FILTER_SANITIZE_STRING));
$demanda->set_nome_dep2(filter_input(INPUT_POST, 'nome_dependente2', FILTER_SANITIZE_STRING));
$demanda->set_nome_dep3(filter_input(INPUT_POST, 'nome_dependente3', FILTER_SANITIZE_STRING));
$demanda->set_nome_dep4(filter_input(INPUT_POST, 'nome_dependente4', FILTER_SANITIZE_STRING));
$demanda->set_nome_dep5(filter_input(INPUT_POST, 'nome_dependente5', FILTER_SANITIZE_STRING));
$demanda->set_nome_dep6(filter_input(INPUT_POST, 'nome_dependente6', FILTER_SANITIZE_STRING));
$demanda->set_nome_dep7(filter_input(INPUT_POST, 'nome_dependente7', FILTER_SANITIZE_STRING));
$demanda->set_nome_dep8(filter_input(INPUT_POST, 'nome_dependente8', FILTER_SANITIZE_STRING));
$demanda->set_copyemail(filter_input(INPUT_POST, 'copyemail', FILTER_SANITIZE_STRING));
$demanda->set_mail1(filter_input(INPUT_POST, 'mail1', FILTER_SANITIZE_STRING));
$demanda->set_mail2(filter_input(INPUT_POST, 'mail2', FILTER_SANITIZE_STRING));
$demanda->set_mail3(filter_input(INPUT_POST, 'mail3', FILTER_SANITIZE_STRING));
$demanda->set_mail4(filter_input(INPUT_POST, 'mail4', FILTER_SANITIZE_STRING));
$demanda->set_mail5(filter_input(INPUT_POST, 'mail5', FILTER_SANITIZE_STRING));
$demanda->set_mail6(filter_input(INPUT_POST, 'mail6', FILTER_SANITIZE_STRING));
$demanda->set_mail7(filter_input(INPUT_POST, 'mail7', FILTER_SANITIZE_STRING));
$dados_demanda = $demandas->Dados_Demandas($demanda->get_id_demanda());
$array_user_abertura = $user->Dados_User($dados_demanda['id_user_abertura']);
$array_executante = $user->Dados_User($dados_demanda['executantes']);
$array_demanda = $tipo_demanda->Dados_Demandas($dados_demanda['id_demanda']);
$array_prazo = $prazo->Dados_Demandas($dados_demanda['id_prazo']);
$array_status = $status_demanda->Dados_Demandas($demanda->get_status());
$voucher = date('Y') . '0' . $demanda->get_id_demanda();

$confirm = $demanda->saveDemandaR($demanda->get_id_demanda(), $demanda->get_id_f(), $demanda->get_copyemail(), $demanda->get_empresa(), $demanda->get_nome_ativo(), $demanda->get_cpf_ativo(), $demanda->get_nome_dep(), $demanda->get_cpf_dep(), $demanda->get_nome_dep1(), $demanda->get_cpf_dep1(), $demanda->get_nome_dep2(), $demanda->get_cpf_dep2(), $demanda->get_nome_dep3(), $demanda->get_cpf_dep3(), $demanda->get_nome_dep4(), $demanda->get_cpf_dep4(), $demanda->get_nome_dep5(), $demanda->get_cpf_dep5(), $demanda->get_nome_dep6(), $demanda->get_cpf_dep6(), $demanda->get_nome_dep7(), $demanda->get_cpf_dep7(), $demanda->get_nome_dep8(), $demanda->get_cpf_dep8(), $demanda->get_status());

$confirm1 = $demandas->editDemandaStatus($demanda->get_id_demanda(), $demanda->get_status());
$body = '<div class="containerr">';
$body = $body . '<h2>' . $array_status['status'] . '</h2><h3> Demanda: ' . $array_demanda['tipo_demanda'] . '</h3>';
$body = $body . '<p>ID: ' . $voucher . '</p>';
$body = $body . '<p>Responsável: ' . $array_user_abertura['nome_extenso'] . '</p>';
$body = $body . '<p>Executante: ' . $array_executante['nome_extenso'] . '</p>';
$body = $body . '<p>Prazo: ' . $array_prazo['prazo'] . ' ' . $array_prazo['tipo'] . '</p>';
$body = $body . '<p>Nome Ativo: ' . $demanda->get_nome_ativo() . '</p>';
$body = $body . '<p>CPF Ativo: ' . $demanda->get_cpf_ativo() . '</p>';
$body = $body . '<p>Empresa: ' . $demanda->get_empresa() . '</p>';
$body = $body . '<p>Obs/Email: <small>' . $demanda->get_copyemail() . '</small></p>';
if ($demanda->get_nome_dep() !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $demanda->get_nome_dep() . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $demanda->get_cpf_dep() . '</p>';
}
if ($demanda->get_nome_dep1() !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $demanda->get_nome_dep1() . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $demanda->get_cpf_dep1() . '</p>';
}
if ($demanda->get_nome_dep2() !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $demanda->get_nome_dep2() . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $demanda->get_cpf_dep2() . '</p>';
}
if ($demanda->get_nome_dep3() !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $demanda->get_nome_dep3() . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $demanda->get_cpf_dep3() . '</p>';
}
if ($demanda->get_nome_dep4() !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $demanda->get_nome_dep4() . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $demanda->get_cpf_dep4() . '</p>';
}
if ($demanda->get_nome_dep5() !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $demanda->get_nome_dep5() . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $demanda->get_cpf_dep5() . '</p>';
}
if ($demanda->get_nome_dep6() !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $demanda->get_nome_dep6() . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $demanda->get_cpf_dep6() . '</p>';
}
if ($demanda->get_nome_dep7() !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $demanda->get_nome_dep7() . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $demanda->get_cpf_dep7() . '</p>';
}
if ($demanda->get_nome_dep8() !== "No Informado") {
    $body = $body . '<p>Nome Dependente: ' . $demanda->get_nome_dep8() . '</p>';
    $body = $body . '<p>CPF Dependente: ' . $demanda->get_cpf_dep8() . '</p>';
}

$body = $body . '</div>';
$cuerpo = beginHTML() . $body . endHTML();
$subject = $voucher . ' ' . $array_status['status'] . ' ' . $array_demanda['tipo_demanda'];
if (($confirm === TRUE) and ( $confirm1 === TRUE)) {
    $mail->EnviarSuperEmail($array_user_abertura['email'], $array_executante['email'], $demanda->get_mail1(), $demanda->get_mail2(), $demanda->get_mail3(), $demanda->get_mail4(), $demanda->get_mail5(), $demanda->get_mail6(), $demanda->get_mail7(), 'na', 'na', $subject, $cuerpo);
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Executado com Sucesso!!<br>ID: ' . $voucher . '</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}