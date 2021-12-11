<?php

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$conta_corrente = new Medicos_Conta_Corrente();
$medico = new Medicos();
$tutus = new Medicos_Valores_Exames();
$mail = new SuperEmail();
$medico->set_id_medico(filter_input(INPUT_POST, 'id_medico', FILTER_SANITIZE_NUMBER_INT));
$medico->set_nome(filter_input(INPUT_POST, 'nome_medico', FILTER_SANITIZE_STRING));
$medico->set_crm(filter_input(INPUT_POST, 'crm', FILTER_SANITIZE_STRING));
$medico->set_id_funcao(filter_input(INPUT_POST, 'funcao', FILTER_SANITIZE_NUMBER_INT));
$medico->set_id_prestador(filter_input(INPUT_POST, 'id_prestador', FILTER_SANITIZE_NUMBER_INT));
$medico->set_cod_sig(filter_input(INPUT_POST, 'cod_sig', FILTER_SANITIZE_NUMBER_INT));
$medico->set_ddd_telefone(filter_input(INPUT_POST, 'ddd', FILTER_SANITIZE_NUMBER_INT));
$medico->set_telefone(filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_NUMBER_INT));
$medico->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$medico->set_cpf(filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING));
$medico->set_rg(filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_STRING));
$medico->set_data_nascimento(filter_input(INPUT_POST, 'nascimento', FILTER_SANITIZE_STRING));
$medico->set_conselho(filter_input(INPUT_POST, 'conselho', FILTER_SANITIZE_STRING));
$medico->set_cnes(filter_input(INPUT_POST, 'CNES', FILTER_SANITIZE_STRING));
$medico->set_id_banco(filter_input(INPUT_POST, 'banco', FILTER_SANITIZE_NUMBER_INT));
$medico->set_agencia(filter_input(INPUT_POST, 'agencia', FILTER_SANITIZE_NUMBER_INT));
$medico->set_contacorrente(filter_input(INPUT_POST, 'conta', FILTER_SANITIZE_NUMBER_INT));
$medico->set_id_cc(filter_input(INPUT_POST, 'id_cc', FILTER_SANITIZE_NUMBER_INT));
$medico->set_obs(filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING));
$medico->set_email(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
$tutus->set_consulta(filter_input(INPUT_POST, 'consulta', FILTER_SANITIZE_STRING));
$tutus->set_exame_clinico(filter_input(INPUT_POST, 'exame_clinico', FILTER_SANITIZE_STRING));
$tutus->set_acido_metil_hipurico(filter_input(INPUT_POST, 'acido_metil_hipurico', FILTER_SANITIZE_STRING));
$tutus->set_hemograma(filter_input(INPUT_POST, 'hemograma', FILTER_SANITIZE_STRING));
$tutus->set_acido_mandelico(filter_input(INPUT_POST, 'acido_mandelico', FILTER_SANITIZE_STRING));
$tutus->set_vdrl(filter_input(INPUT_POST, 'vdrl', FILTER_SANITIZE_STRING));
$tutus->set_reticulocitos(filter_input(INPUT_POST, 'reticulocitos', FILTER_SANITIZE_STRING));
$tutus->set_parasitologico_fezes(filter_input(INPUT_POST, 'parasitologico_fezes', FILTER_SANITIZE_STRING));
$tutus->set_cultural_de_orofaringe(filter_input(INPUT_POST, 'cultural_de_orofaringe', FILTER_SANITIZE_STRING));
$tutus->set_coprocultura(filter_input(INPUT_POST, 'coprocultura', FILTER_SANITIZE_STRING));
$tutus->set_micologico_de_unha(filter_input(INPUT_POST, 'micologico_de_unha', FILTER_SANITIZE_STRING));
$tutus->set_audiometria(filter_input(INPUT_POST, 'audiometria', FILTER_SANITIZE_STRING));
$tutus->set_ecg(filter_input(INPUT_POST, 'ecg', FILTER_SANITIZE_STRING));
$tutus->set_acuidade_visual(filter_input(INPUT_POST, 'acuidade_visual', FILTER_SANITIZE_STRING));
$tutus->set_eeg(filter_input(INPUT_POST, 'eeg', FILTER_SANITIZE_STRING));
$tutus->set_plaquetas(filter_input(INPUT_POST, 'plaquetas', FILTER_SANITIZE_STRING));
$tutus->set_eritrograma(filter_input(INPUT_POST, 'eritrograma', FILTER_SANITIZE_STRING));
$tutus->set_acido_tt_muconico(filter_input(INPUT_POST, 'acido_tt_muconico', FILTER_SANITIZE_STRING));
$tutus->set_glicemia_em_jejum(filter_input(INPUT_POST, 'glicemia_em_jejum', FILTER_SANITIZE_STRING));
$tutus->set_acido_hipurico(filter_input(INPUT_POST, 'acido_hipurico', FILTER_SANITIZE_STRING));
$tutus->set_id_medico_valores(filter_input(INPUT_POST, 'id_medico_valores', FILTER_SANITIZE_NUMBER_INT));


$confirm = $medico->edit_Medico($medico->get_id_medico(), $medico->get_nome(), $medico->get_crm(), $medico->get_id_funcao(), $medico->get_cod_sig(), 
        $medico->get_ddd_telefone(), $medico->get_telefone(), $medico->get_cpf(), $medico->get_rg(), $medico->get_data_nascimento(), 
        $medico->get_conselho(), $medico->get_cnes(), $medico->get_status(), $medico->get_id_prestador(), $medico->get_obs(), $medico->get_email());
$array_conta = $conta_corrente->Dados_Medico_conta_Corrente($medico->get_crm());
$verify = $array_conta['crm'] == NULL ? TRUE : FALSE;
$verify_valores_exame = $tutus->Possui_Dados_Medico_Valores_Exames($medico->get_crm());
$verify_valores_exames = $verify_valores_exame['temos'] > 0 ? TRUE : FALSE;
if ($confirm === TRUE) {
    if ($verify === TRUE) {
        $conta_corrente->save_Medico_conta_Corrente($medico->get_crm(), $medico->get_id_banco(), $medico->get_agencia(), $medico->get_contacorrente());
    } else {
        $conta_corrente->edit_Medico_conta_Corrente($medico->get_id_cc(), $medico->get_crm(), $medico->get_id_banco(), $medico->get_agencia(), $medico->get_contacorrente(), 1);
    }
    
    if($verify_valores_exames === TRUE){
        $tutus->edit_Medico_Valores_Exames($tutus->get_id_medico_valores(), $medico->get_crm(), $tutus->get_consulta(), 
                $tutus->get_exame_clinico(), $tutus->get_acido_metil_hipurico(), $tutus->get_hemograma(), $tutus->get_acido_mandelico(), 
                $tutus->get_vdrl(), $tutus->get_reticulocitos(), $tutus->get_parasitologico_fezes(), $tutus->get_cultural_de_orofaringe(), 
                $tutus->get_coprocultura(), $tutus->get_micologico_de_unha(), $tutus->get_audiometria(), $tutus->get_ecg(), $tutus->get_acuidade_visual(), 
                $tutus->get_eeg(), $tutus->get_plaquetas(), $tutus->get_eritrograma(), $tutus->get_acido_tt_muconico(), $tutus->get_glicemia_em_jejum(), 
                $tutus->get_acido_hipurico(), 1);
    }else{
        $tutus->save_Medico_Valores_Exames($medico->get_crm(), $tutus->get_consulta(), 
                $tutus->get_exame_clinico(), $tutus->get_acido_metil_hipurico(), $tutus->get_hemograma(), $tutus->get_acido_mandelico(), 
                $tutus->get_vdrl(), $tutus->get_reticulocitos(), $tutus->get_parasitologico_fezes(), $tutus->get_cultural_de_orofaringe(), 
                $tutus->get_coprocultura(), $tutus->get_micologico_de_unha(), $tutus->get_audiometria(), $tutus->get_ecg(), $tutus->get_acuidade_visual(), 
                $tutus->get_eeg(), $tutus->get_plaquetas(), $tutus->get_eritrograma(), $tutus->get_acido_tt_muconico(), $tutus->get_glicemia_em_jejum(), 
                $tutus->get_acido_hipurico());
    }
    
    $subject = 'Médico Editado: '.$medico->get_nome();
    $body = 'Médico Editado no Sistema Periódicos: ' . $medico->get_nome() . '<br>' . 'Dados:<br>Nome Médico: '
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
Médico Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}