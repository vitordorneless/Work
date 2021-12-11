<?php

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$prestadores = new Prestadores_PJ();
$tutus = new Prestador_Valores_Exames();
$mail = new SuperEmail();
$estados = new Paises_Estados();
$prestadores->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$prestadores->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$prestadores->set_data_cadastro(filter_input(INPUT_POST, 'data_cadastro', FILTER_SANITIZE_STRING));
$prestadores->set_id_tipo_prestador(filter_input(INPUT_POST, 'tipo_prestador', FILTER_SANITIZE_NUMBER_INT));
$prestadores->set_razao_social(filter_input(INPUT_POST, 'razao_social', FILTER_SANITIZE_STRING));
$prestadores->set_cnpj(filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING));
$prestadores->set_cnes(filter_input(INPUT_POST, 'CNES', FILTER_SANITIZE_STRING));
$prestadores->set_endereco(filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING));
$prestadores->set_numero(filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING));
$prestadores->set_complemento(filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING));
$prestadores->set_id_estado_UF(filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_NUMBER_INT));
$prestadores->set_id_cidade(filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_NUMBER_INT));
$prestadores->set_bairro(filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING));
$prestadores->set_cep(filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_NUMBER_INT));
$prestadores->set_ddd_comercial(filter_input(INPUT_POST, 'ddd_comercial', FILTER_SANITIZE_NUMBER_INT));
$prestadores->set_telefone_comercial(filter_input(INPUT_POST, 'telefone_comercial', FILTER_SANITIZE_NUMBER_INT));
$prestadores->set_ddd_telefone(filter_input(INPUT_POST, 'ddd_celular', FILTER_SANITIZE_NUMBER_INT));
$prestadores->set_telefone(filter_input(INPUT_POST, 'telefone_celular', FILTER_SANITIZE_NUMBER_INT));
$prestadores->set_valor_consulta(filter_input(INPUT_POST, 'valor_consulta', FILTER_SANITIZE_STRING));
$prestadores->set_obs(filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING));
$prestadores->set_id_banco(filter_input(INPUT_POST, 'banco', FILTER_SANITIZE_NUMBER_INT));
$prestadores->set_agencia(filter_input(INPUT_POST, 'agencia', FILTER_SANITIZE_STRING));
$prestadores->set_contacorrente(filter_input(INPUT_POST, 'conta', FILTER_SANITIZE_STRING));
$prestadores->set_email(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
$prestadores->set_valor_consulta_2(filter_input(INPUT_POST, 'valor_consulta_2', FILTER_SANITIZE_STRING));
$prestadores->set_data_acerto_2(filter_input(INPUT_POST, 'data_acerto_2', FILTER_SANITIZE_STRING));
$prestadores->set_valor_consulta_3(filter_input(INPUT_POST, 'valor_consulta_3', FILTER_SANITIZE_STRING));
$prestadores->set_data_acerto_3(filter_input(INPUT_POST, 'data_acerto_3', FILTER_SANITIZE_STRING));

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
$tutus->set_hemograma_com_plaquetas(filter_input(INPUT_POST, 'hemograma_com_plaquetas', FILTER_SANITIZE_STRING));
$tutus->set_antibiograma(filter_input(INPUT_POST, 'antibiograma', FILTER_SANITIZE_STRING));
$tutus->set_id_medico_valores(filter_input(INPUT_POST, 'id_medico_valores', FILTER_SANITIZE_NUMBER_INT));

$confirm = $prestadores->edit_Prestadores_PJ($prestadores->get_id(), $prestadores->get_data_cadastro(), 
        $prestadores->get_id_tipo_prestador(), $prestadores->get_razao_social(), $prestadores->get_cnpj(), $prestadores->get_cnes(), 
        $prestadores->get_endereco(), $prestadores->get_numero(), $prestadores->get_complemento(), $prestadores->get_id_estado_UF(), 
        $prestadores->get_id_cidade(), $prestadores->get_bairro(), $prestadores->get_cep(), $prestadores->get_ddd_comercial(), 
        $prestadores->get_telefone_comercial(), $prestadores->get_ddd_telefone(), $prestadores->get_telefone(), $prestadores->get_email(), $prestadores->get_status(), 
        $prestadores->get_valor_consulta(), $prestadores->get_valor_consulta_2(), $prestadores->get_data_acerto_2(), 
        $prestadores->get_valor_consulta_3(), $prestadores->get_data_acerto_3(), 
        $prestadores->get_obs(), $prestadores->get_id_banco(), $prestadores->get_agencia(), $prestadores->get_contacorrente());

$verify_valores_exame = $tutus->Possui_Dados_Prestador_Valores_Exames($prestadores->get_cnpj());
$verify_valores_exames = $verify_valores_exame['temos'] > 0 ? TRUE : FALSE;

if ($confirm === TRUE) {
    if ($verify_valores_exames === TRUE) {
        $tutus->edit_Prestador_Valores_Exames($tutus->get_id_medico_valores(), $prestadores->get_cnpj(), $tutus->get_exame_clinico(), $tutus->get_acido_metil_hipurico(), $tutus->get_hemograma(), $tutus->get_acido_mandelico(), $tutus->get_vdrl(), $tutus->get_reticulocitos(), $tutus->get_parasitologico_fezes(), $tutus->get_cultural_de_orofaringe(), $tutus->get_coprocultura(), $tutus->get_micologico_de_unha(), $tutus->get_audiometria(), $tutus->get_ecg(), $tutus->get_acuidade_visual(), $tutus->get_eeg(), $tutus->get_plaquetas(), $tutus->get_eritrograma(), $tutus->get_acido_tt_muconico(), $tutus->get_glicemia_em_jejum(), $tutus->get_acido_hipurico(), $tutus->get_hemograma_com_plaquetas(), $tutus->get_antibiograma(), 1);
    } else {
        $tutus->save_Prestador_Valores_Exames($prestadores->get_cnpj(), $tutus->get_exame_clinico(), $tutus->get_acido_metil_hipurico(), $tutus->get_hemograma(), $tutus->get_acido_mandelico(), $tutus->get_vdrl(), $tutus->get_reticulocitos(), $tutus->get_parasitologico_fezes(), $tutus->get_cultural_de_orofaringe(), $tutus->get_coprocultura(), $tutus->get_micologico_de_unha(), $tutus->get_audiometria(), $tutus->get_ecg(), $tutus->get_acuidade_visual(), $tutus->get_eeg(), $tutus->get_plaquetas(), $tutus->get_eritrograma(), $tutus->get_acido_tt_muconico(), $tutus->get_glicemia_em_jejum(), $tutus->get_acido_hipurico(), $tutus->get_hemograma_com_plaquetas(), $tutus->get_antibiograma());
    }
    $estado = $estados->Busca_Estado($prestadores->get_id_estado_UF());
    $cidade = $estados->Busca_Cidade($prestadores->get_id_cidade());
    $subject = 'Prestador Editado: '.$prestadores->get_razao_social();
    $body = 'Prestador Editado no Sistema Periódicos: ' . $prestadores->get_razao_social() . '<br>' . 'Dados:<br>Prestador:'
            . $prestadores->get_razao_social() . '<br>Telefone: ' . $prestadores->get_ddd_comercial() . '-' . $prestadores->get_telefone_comercial() . ' ou ' .
            $prestadores->get_ddd_telefone() . '-' . $prestadores->get_telefone() . '<br>CNPJ: ' . $prestadores->get_cnpj()
            . '<br>Valor ASO:' . $prestadores->get_valor_consulta() . 
            '<br>Valor ASO 2:' . $prestadores->get_valor_consulta_2() . 
            '<br>Endereço: ' . $prestadores->get_endereco() . ',' .
            $prestadores->get_numero() . ' Complemento ' . $prestadores->get_complemento() . ' - ' . $cidade['nom_cidade'] . '/' . $estado['sgl_estado'] .
            '<br>Email: ' . $prestadores->get_email() . '<br>Observações: ' . $prestadores->get_obs();
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
Prestador Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}