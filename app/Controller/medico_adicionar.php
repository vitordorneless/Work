<?php

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$medico = new Medicos();
$conta_corrente = new Medicos_Conta_Corrente();
$valores = new Medicos_Valores_Exames();
$mail = new SuperEmail();
$medico->set_nome(filter_input(INPUT_POST, 'nome_medico', FILTER_SANITIZE_STRING));
$medico->set_crm(filter_input(INPUT_POST, 'crm', FILTER_SANITIZE_STRING));
$medico->set_id_funcao(filter_input(INPUT_POST, 'funcao', FILTER_SANITIZE_NUMBER_INT));
$medico->set_id_prestador(filter_input(INPUT_POST, 'id_prestador', FILTER_SANITIZE_NUMBER_INT));
$medico->set_cod_sig(filter_input(INPUT_POST, 'cod_sig', FILTER_SANITIZE_NUMBER_INT));
$medico->set_ddd_telefone(filter_input(INPUT_POST, 'ddd', FILTER_SANITIZE_NUMBER_INT));
$medico->set_telefone(filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_NUMBER_INT));
$medico->set_cpf(filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING));
$medico->set_rg(filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_STRING));
$medico->set_data_nascimento(filter_input(INPUT_POST, 'nascimento', FILTER_SANITIZE_STRING));
$medico->set_conselho(filter_input(INPUT_POST, 'conselho', FILTER_SANITIZE_STRING));
$medico->set_cnes(filter_input(INPUT_POST, 'CNES', FILTER_SANITIZE_STRING));
$medico->set_id_banco(filter_input(INPUT_POST, 'banco', FILTER_SANITIZE_NUMBER_INT));
$medico->set_agencia(filter_input(INPUT_POST, 'agencia', FILTER_SANITIZE_NUMBER_INT));
$medico->set_contacorrente(filter_input(INPUT_POST, 'conta', FILTER_SANITIZE_NUMBER_INT));
$medico->set_obs(filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING));
$medico->set_email(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
$medico->set_consulta(filter_input(INPUT_POST, 'consulta', FILTER_SANITIZE_STRING));
$medico->set_exame_clinico(filter_input(INPUT_POST, 'exame_clinico', FILTER_SANITIZE_STRING));
$medico->set_acido_metil_hipurico(filter_input(INPUT_POST, 'acido_metil_hipurico', FILTER_SANITIZE_STRING));
$medico->set_hemograma(filter_input(INPUT_POST, 'hemograma', FILTER_SANITIZE_STRING));
$medico->set_acido_mandelico(filter_input(INPUT_POST, 'acido_mandelico', FILTER_SANITIZE_STRING));
$medico->set_vdrl(filter_input(INPUT_POST, 'vdrl', FILTER_SANITIZE_STRING));
$medico->set_reticulocitos(filter_input(INPUT_POST, 'reticulocitos', FILTER_SANITIZE_STRING));
$medico->set_parasitologico_fezes(filter_input(INPUT_POST, 'parasitologico_fezes', FILTER_SANITIZE_STRING));
$medico->set_cultural_de_orofaringe(filter_input(INPUT_POST, 'cultural_de_orofaringe', FILTER_SANITIZE_STRING));
$medico->set_coprocultura(filter_input(INPUT_POST, 'coprocultura', FILTER_SANITIZE_STRING));
$medico->set_micologico_de_unha(filter_input(INPUT_POST, 'micologico_de_unha', FILTER_SANITIZE_STRING));
$medico->set_audiometria(filter_input(INPUT_POST, 'audiometria', FILTER_SANITIZE_STRING));
$medico->set_ecg(filter_input(INPUT_POST, 'ecg', FILTER_SANITIZE_STRING));
$medico->set_acuidade_visual(filter_input(INPUT_POST, 'acuidade_visual', FILTER_SANITIZE_STRING));
$medico->set_eeg(filter_input(INPUT_POST, 'eeg', FILTER_SANITIZE_STRING));
$medico->set_plaquetas(filter_input(INPUT_POST, 'plaquetas', FILTER_SANITIZE_STRING));
$medico->set_eritrograma(filter_input(INPUT_POST, 'eritrograma', FILTER_SANITIZE_STRING));
$medico->set_acido_tt_muconico(filter_input(INPUT_POST, 'acido_tt_muconico', FILTER_SANITIZE_STRING));
$medico->set_glicemia_em_jejum(filter_input(INPUT_POST, 'glicemia_em_jejum', FILTER_SANITIZE_STRING));
$medico->set_acido_hipurico(filter_input(INPUT_POST, 'acido_hipurico', FILTER_SANITIZE_STRING));

$confirm = $medico->save_Medico($medico->get_nome(), $medico->get_crm(), $medico->get_id_funcao(), $medico->get_cod_sig(), $medico->get_ddd_telefone(), $medico->get_telefone(), $medico->get_cpf(), $medico->get_rg(), $medico->get_data_nascimento(), $medico->get_conselho(), $medico->get_cnes(), $medico->get_id_prestador(), $medico->get_obs(), $medico->get_email());
if ($confirm === TRUE) {
    $conta_corrente->save_Medico_conta_Corrente($medico->get_crm(), $medico->get_id_banco(), $medico->get_agencia(), $medico->get_contacorrente());
    $valores->save_Medico_Valores_Exames($medico->get_crm(), $medico->get_consulta(), $medico->get_exame_clinico(), $medico->get_acido_metil_hipurico(), $medico->get_hemograma(), $medico->get_acido_mandelico(), $medico->get_vdrl(), $medico->get_reticulocitos(), $medico->get_parasitologico_fezes(), $medico->get_cultural_de_orofaringe(), $medico->get_coprocultura(), $medico->get_micologico_de_unha(), $medico->get_audiometria(), $medico->get_ecg(), $medico->get_acuidade_visual(), $medico->get_eeg(), $medico->get_plaquetas(), $medico->get_eritrograma(), $medico->get_acido_tt_muconico(), $medico->get_glicemia_em_jejum(), $medico->get_acido_hipurico());

    $subject = 'Médico Incluído: ' . $medico->get_nome();
    $body = 'Médico Incluido no Sistema Periódicos: ' . $medico->get_nome() . '<br>' . 'Dados:<br>Nome Médico: '
            . $medico->get_nome() . '<br>Telefone: ' . $medico->get_ddd_telefone() . $medico->get_telefone() . '<br>'
            . 'CRM: ' . $medico->get_crm() . '<br>Valor Consulta: ' . $medico->get_consulta() . '<br>Contato: ' . $medico->get_nome() .
            '<br>Observações: ' . $medico->get_obs();
    $to = 'carine.pires@amars.com.br';
    $to2 = 'luciana.lima@amars.com.br';
    $to3 = 'andreia.silva@amars.com.br';
    $to4 = 'cristiana@amars.com.br';
    $to5 = 'mielly@amars.com.br';
    $to6 = 'debora.meneguetti@amars.com.br';
    $to7 = 'priscilla.ornil@amars.com.br';
    $to8 = 'juzmary@amars.com.br';    
    $to9 = 'debora.hickmann@amars.com.br';
    $to10 = 'eliude@amars.com.br';
    $to11 = 'nataly@amars.com.br';
    $mail->EnviarSuperEmail($to, $to2, $to3, $to4, $to5, $to6, $to7, $to8, $to9, $to10, $to11, $subject, $body);

    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Médico Gravado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}