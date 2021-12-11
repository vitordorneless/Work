<?php

require '../Model/Chamado.php';
require '../Model/Chamados.php';
require '../Model/Mail.php';
require '../Model/Email.php';
include '../../class/ayuadame.php';
$chamado = new Chamados();
$protocolo = $chamado->Protocolo_Chamados();
$id_ativo = filter_input(INPUT_POST, 'id_ativo', FILTER_SANITIZE_NUMBER_INT);
$cpf_ativo = filter_input(INPUT_POST, 'cpf_ativo', FILTER_SANITIZE_NUMBER_INT);
$id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);
$nome_ativo = filter_input(INPUT_POST, 'nome_ativo', FILTER_SANITIZE_STRING);
$email_user = filter_input(INPUT_POST, 'email_user', FILTER_SANITIZE_STRING);
$loja = filter_input(INPUT_POST, 'loja', FILTER_SANITIZE_STRING);
$id_dependente = filter_input(INPUT_POST, 'id_dependente', FILTER_SANITIZE_NUMBER_INT);
$cpf_dependente = filter_input(INPUT_POST, 'cpf_dependente', FILTER_SANITIZE_NUMBER_INT);
$nome_dependente = filter_input(INPUT_POST, 'nome_dependente', FILTER_SANITIZE_STRING);
$demanda1 = filter_input(INPUT_POST, 'demanda1', FILTER_SANITIZE_STRING);
$demanda2 = filter_input(INPUT_POST, 'demanda2', FILTER_SANITIZE_STRING);
$demanda3 = filter_input(INPUT_POST, 'demanda3', FILTER_SANITIZE_STRING);
$demanda4 = filter_input(INPUT_POST, 'demanda4', FILTER_SANITIZE_STRING);
$demanda_1_complemento = filter_input(INPUT_POST, 'demanda_1_complemento', FILTER_SANITIZE_STRING);
$demanda_3_complemento = filter_input(INPUT_POST, 'demanda_3_complemento', FILTER_SANITIZE_STRING);
$demanda_4_complemento = filter_input(INPUT_POST, 'demanda_4_complemento', FILTER_SANITIZE_STRING);

if(($demanda1 !== "na") and ($demanda2 === "na") and ($demanda3 === "na") and ($demanda4 === "na")){
    $chamado->set_id_demanda($demanda1);
    $chamado->set_complemento_demanda($demanda_1_complemento);
}  else {
    if(($demanda1 === "na") and ($demanda2 !== "na") and ($demanda3 === "na") and ($demanda4 === "na")){
        $chamado->set_id_demanda($demanda2);
        $chamado->set_complemento_demanda("na");
    }  else {
        if(($demanda1 === "na") and ($demanda2 === "na") and ($demanda3 !== "na") and ($demanda4 === "na")){
            $chamado->set_id_demanda($demanda3);
            $chamado->set_complemento_demanda($demanda_3_complemento);
        }else{
            if(($demanda1 === "na") and ($demanda2 === "na") and ($demanda3 === "na") and ($demanda4 !== "na")){
                $chamado->set_id_demanda($demanda4);
                $chamado->set_complemento_demanda($demanda_4_complemento);
            }
        }
    }
}

$chamado->set_id_ativo($id_ativo);
$chamado->set_cpf_ativo($cpf_ativo);
$chamado->set_id_usuario($id_usuario);
$chamado->set_nome_ativo($nome_ativo);
$chamado->set_id_dependente($id_dependente);
$chamado->set_cpf_dependente($cpf_dependente);
$chamado->set_nome_dependente($nome_dependente);
$chamado->set_loja($loja);
$chamado->set_emergencial(filter_input(INPUT_POST, 'emergencial', FILTER_SANITIZE_NUMBER_INT));

$cpf_ativo_verify = valCpf($cpf_ativo);

if($cpf_ativo_verify === TRUE){
$confirm = $chamado->save_Chamado($chamado->get_id_usuario(), $chamado->get_id_ativo(), $chamado->get_cpf_ativo(), 
        $chamado->get_nome_ativo(), $chamado->get_id_demanda(), $chamado->get_complemento_demanda(), 
        $chamado->get_id_dependente(), $chamado->get_cpf_dependente(), $chamado->get_nome_dependente(), $chamado->get_loja(), $chamado->get_emergencial());
if ($confirm === TRUE) {
    $mail = new Email();
    $body2 = "<h1>Chamado aberto com Sucesso</h1>
              <p>Olá Seu chamado foi gravado em nosso sistema.</p>
              <p>O mesmo será analisado e em breve você irá receber o retorno com o prazo do mesmo.</p>
              <p>Nome do Funcionário(Ativo): $nome_ativo</p>
              <p>Protocolo número:<strong> $protocolo</strong></p>";
    $body = beginHTML() . $body2 . endHTML() . assinatura_HTML();
    $subject = "Chamado Aberto com Sucesso - Protocolo: " . $protocolo;
    $file = FALSE;
    $mail->EnviarEmail($email_user, $subject, $body, $file);
    echo '<div class="alert alert-success" role="alert">Chamado Gravado e Aberto com Sucesso! <br>Em breve você irá receber via <strong>Email</strong> o <strong>Protocolo</strong> do mesmo ou visualize o mesmo na tela "Meus Chamados".</div>';
} else{
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';
}
}else{
    echo '<div class="alert alert-danger" role="alert">CPF Inválido do Ativo...</div>';
}