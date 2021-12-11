<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$walmart = new Wal_funcionarios_adicionado_por_medicos();
$walmart->set_cod_empresa(filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_NUMBER_INT));
$walmart->set_cod_loja(filter_input(INPUT_POST, 'estabelecimento', FILTER_SANITIZE_NUMBER_INT));
$walmart->set_nome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$walmart->set_cpf(filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING));
$walmart->set_nascimento(filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_STRING));
$walmart->set_cod_setor(filter_input(INPUT_POST, 'setor', FILTER_SANITIZE_NUMBER_INT));
$walmart->set_cod_cargo(filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_NUMBER_INT));
$walmart->set_id_medico(filter_input(INPUT_POST, 'id_medico', FILTER_SANITIZE_NUMBER_INT));
$walmart->set_cpf_medico(filter_input(INPUT_POST, 'cpf_medico', FILTER_SANITIZE_STRING));
$walmart->set_ids_envelope(filter_input(INPUT_POST, 'id_medico_coordenador', FILTER_SANITIZE_STRING));

$codepf = filter_input(INPUT_POST, 'codepf', FILTER_SANITIZE_STRING);
$data_periodico = filter_input(INPUT_POST, 'data_periodico', FILTER_SANITIZE_STRING);
$caixa = filter_input(INPUT_POST, 'caixa', FILTER_SANITIZE_NUMBER_INT);
$comp_ACIDO_METIL_HIPURICO = filter_input(INPUT_POST, 'comp_ACIDO_METIL_HIPURICO', FILTER_SANITIZE_STRING);
$comp_HEMOGRAMA = filter_input(INPUT_POST, 'comp_HEMOGRAMA', FILTER_SANITIZE_STRING);
$comp_ACIDO_MANDELICO = filter_input(INPUT_POST, 'comp_ACIDO_MANDELICO', FILTER_SANITIZE_STRING);
$comp_VDRL = filter_input(INPUT_POST, 'comp_VDRL', FILTER_SANITIZE_STRING);
$comp_RETICULOCITOS = filter_input(INPUT_POST, 'comp_RETICULOCITOS', FILTER_SANITIZE_STRING);
$comp_PARASITOLOGICO_FEZES = filter_input(INPUT_POST, 'comp_PARASITOLOGICO_FEZES', FILTER_SANITIZE_STRING);
$comp_CULTURAL_DE_OROFARINGE = filter_input(INPUT_POST, 'comp_CULTURAL_DE_OROFARINGE', FILTER_SANITIZE_STRING);
$comp_COPROCULTURA = filter_input(INPUT_POST, 'comp_COPROCULTURA', FILTER_SANITIZE_STRING);
$comp_MICOLOGICO_DE_UNHA = filter_input(INPUT_POST, 'comp_MICOLOGICO_DE_UNHA', FILTER_SANITIZE_STRING);
$comp_AUDIOMETRIA = filter_input(INPUT_POST, 'comp_AUDIOMETRIA', FILTER_SANITIZE_STRING);
$comp_ECG = filter_input(INPUT_POST, 'comp_ECG', FILTER_SANITIZE_STRING);
$comp_ACUIDADE_VISUAL = filter_input(INPUT_POST, 'comp_ACUIDADE_VISUAL', FILTER_SANITIZE_STRING);
$comp_EEG = filter_input(INPUT_POST, 'comp_EEG', FILTER_SANITIZE_STRING);
$comp_PLAQUETAS = filter_input(INPUT_POST, 'comp_PLAQUETAS', FILTER_SANITIZE_STRING);
$comp_ERITROGRAMA = filter_input(INPUT_POST, 'comp_ERITROGRAMA', FILTER_SANITIZE_STRING);
$comp_ACIDO_TT_MUCONICO = filter_input(INPUT_POST, 'comp_ACIDO_TT_MUCONICO', FILTER_SANITIZE_STRING);
$comp_GLICEMIA_EM_JEJUM = filter_input(INPUT_POST, 'comp_GLICEMIA_EM_JEJUM', FILTER_SANITIZE_STRING);
$comp_ACIDO_HIPURICO = filter_input(INPUT_POST, 'comp_ACIDO_HIPURICO', FILTER_SANITIZE_STRING);
$comp_AVALIACAO_PSICOSSOCIAL = filter_input(INPUT_POST, 'comp_AVALIACAO_PSICOSSOCIAL', FILTER_SANITIZE_STRING);
$id_ACIDO_METIL_HIPURICO = filter_input(INPUT_POST, 'status_ACIDO_METIL_HIPURICO', FILTER_SANITIZE_NUMBER_INT);
$id_HEMOGRAMA = filter_input(INPUT_POST, 'status_HEMOGRAMA', FILTER_SANITIZE_NUMBER_INT);
$id_ACIDO_MANDELICO = filter_input(INPUT_POST, 'status_ACIDO_MANDELICO', FILTER_SANITIZE_NUMBER_INT);
$id_VDRL = filter_input(INPUT_POST, 'status_VDRL', FILTER_SANITIZE_NUMBER_INT);
$id_RETICULOCITOS = filter_input(INPUT_POST, 'status_RETICULOCITOS', FILTER_SANITIZE_NUMBER_INT);
$id_PARASITOLOGICO_FEZES = filter_input(INPUT_POST, 'status_PARASITOLOGICO_FEZES', FILTER_SANITIZE_NUMBER_INT);
$id_CULTURAL_DE_OROFARINGE = filter_input(INPUT_POST, 'status_CULTURAL_DE_OROFARINGE', FILTER_SANITIZE_NUMBER_INT);
$id_COPROCULTURA = filter_input(INPUT_POST, 'status_COPROCULTURA', FILTER_SANITIZE_NUMBER_INT);
$id_MICOLOGICO_DE_UNHA = filter_input(INPUT_POST, 'status_MICOLOGICO_DE_UNHA', FILTER_SANITIZE_NUMBER_INT);
$id_AUDIOMETRIA = filter_input(INPUT_POST, 'status_AUDIOMETRIA', FILTER_SANITIZE_NUMBER_INT);
$id_ECG = filter_input(INPUT_POST, 'status_ECG', FILTER_SANITIZE_NUMBER_INT);
$id_ACUIDADE_VISUAL = filter_input(INPUT_POST, 'status_ACUIDADE_VISUAL', FILTER_SANITIZE_NUMBER_INT);
$id_EEG = filter_input(INPUT_POST, 'status_EEG', FILTER_SANITIZE_NUMBER_INT);
$id_PLAQUETAS = filter_input(INPUT_POST, 'status_PLAQUETAS', FILTER_SANITIZE_NUMBER_INT);
$id_ERITROGRAMA = filter_input(INPUT_POST, 'status_ERITROGRAMA', FILTER_SANITIZE_NUMBER_INT);
$id_ACIDO_TT_MUCONICO = filter_input(INPUT_POST, 'status_ACIDO_TT_MUCONICO', FILTER_SANITIZE_NUMBER_INT);
$id_GLICEMIA_EM_JEJUM = filter_input(INPUT_POST, 'status_GLICEMIA_EM_JEJUM', FILTER_SANITIZE_NUMBER_INT);
$id_ACIDO_HIPURICO = filter_input(INPUT_POST, 'status_ACIDO_HIPURICO', FILTER_SANITIZE_NUMBER_INT);
$id_AVALIACAO_PSICOSSOCIAL = filter_input(INPUT_POST, 'status_AVALIACAO_PSICOSSOCIAL', FILTER_SANITIZE_NUMBER_INT);
$erro_coord = filter_input(INPUT_POST, 'erro_coord', FILTER_SANITIZE_NUMBER_INT);
$erro_tel = filter_input(INPUT_POST, 'erro_tel', FILTER_SANITIZE_NUMBER_INT);
$erro_falta_habilitado = filter_input(INPUT_POST, 'erro_falta_habilitado', FILTER_SANITIZE_NUMBER_INT);
$erro_falta_apto = filter_input(INPUT_POST, 'erro_falta_apto', FILTER_SANITIZE_NUMBER_INT);
$erro_rasuras =filter_input(INPUT_POST, 'erro_rasuras', FILTER_SANITIZE_NUMBER_INT);
$erro_assinatura_medico = filter_input(INPUT_POST, 'erro_assinatura_medico', FILTER_SANITIZE_NUMBER_INT);
$erro_assinatura_ativo = filter_input(INPUT_POST, 'erro_assinatura_ativo', FILTER_SANITIZE_NUMBER_INT);
$erro_data_exames = filter_input(INPUT_POST, 'erro_data_exames', FILTER_SANITIZE_NUMBER_INT);
$erro_data_ASO = filter_input(INPUT_POST, 'erro_data_ASO', FILTER_SANITIZE_NUMBER_INT);
$erro_riscos = filter_input(INPUT_POST, 'erro_riscos', FILTER_SANITIZE_NUMBER_INT);
$erro_identificacao = filter_input(INPUT_POST, 'erro_identificacao', FILTER_SANITIZE_NUMBER_INT);
$erro_carimbo = filter_input(INPUT_POST, 'erro_carimbo', FILTER_SANITIZE_NUMBER_INT);

if(($erro_coord === '1') or ($erro_tel === '1') or ($erro_falta_habilitado === '1') or ($erro_falta_apto === '1')
        or ($erro_rasuras === '1') or ($erro_assinatura_medico === '1') or ($erro_assinatura_ativo === '1')
        or ($erro_data_exames === '1') or ($erro_data_ASO === '1')
        or ($erro_riscos === '1') or ($erro_identificacao === '1') or ($erro_carimbo === '1')){
    $erro = 1;
    $flg_periodico = 0;    
}else{
    $erro = 0;
    $flg_periodico = 1;
}

$confirm = $walmart->save_Wal_funcionarios_por_Medicos($walmart->get_nome(), 0, '0000-00-00 00:00:00', $walmart->get_cpf(), 
        0, $walmart->get_nascimento(), $walmart->get_cod_empresa(), $walmart->get_cod_loja(), $walmart->get_cod_setor(), $walmart->get_cod_cargo(), $walmart->get_cod_setor(), 
        'WMB', '0000-00-00 00:00:00', $walmart->get_id_medico(), $flg_periodico, $data_periodico, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 
        0, 0, 0, $erro, $caixa, $comp_ACIDO_METIL_HIPURICO, $comp_HEMOGRAMA, $comp_ACIDO_MANDELICO, $comp_VDRL, $comp_RETICULOCITOS, 
        $comp_PARASITOLOGICO_FEZES, $comp_CULTURAL_DE_OROFARINGE, $comp_COPROCULTURA, $comp_MICOLOGICO_DE_UNHA, $comp_AUDIOMETRIA, 
        $comp_ECG, $comp_ACUIDADE_VISUAL, $comp_EEG, $comp_PLAQUETAS, $comp_ERITROGRAMA, $comp_ACIDO_TT_MUCONICO, $comp_GLICEMIA_EM_JEJUM, 
        $comp_ACIDO_HIPURICO, $comp_AVALIACAO_PSICOSSOCIAL, $id_ACIDO_METIL_HIPURICO, 
        $id_HEMOGRAMA, $id_ACIDO_MANDELICO, $id_VDRL, $id_RETICULOCITOS, $id_PARASITOLOGICO_FEZES, $id_CULTURAL_DE_OROFARINGE, 
        $id_COPROCULTURA, $id_MICOLOGICO_DE_UNHA, $id_AUDIOMETRIA, $id_ECG, $id_ACUIDADE_VISUAL, $id_EEG, $id_PLAQUETAS, $id_ERITROGRAMA, 
        $id_ACIDO_TT_MUCONICO, $id_GLICEMIA_EM_JEJUM, $id_ACIDO_HIPURICO, $id_AVALIACAO_PSICOSSOCIAL, $walmart->get_ids_envelope(), $codepf,
        $erro_coord,$erro_tel,$erro_falta_habilitado,$erro_falta_apto,$erro_rasuras,
        $erro_assinatura_medico,$erro_assinatura_ativo,$erro_data_exames,$erro_data_ASO,$erro_riscos,$erro_identificacao,$erro_carimbo);

if ($confirm === TRUE) {
    echo '<div class="alert alert-success" role="alert">Ativo Adicionado!</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Erro!!...</div>';
}