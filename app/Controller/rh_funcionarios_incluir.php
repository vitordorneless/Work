<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$rh = new RH_Funcionarios();
$rh->set_nome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$rh->set_id_sexo(filter_input(INPUT_POST, 'id_sexo', FILTER_SANITIZE_NUMBER_INT));
$rh->set_matricula(filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_STRING));
$rh->set_nome_pai(filter_input(INPUT_POST, 'nome_pai', FILTER_SANITIZE_STRING));
$rh->set_nome_mae(filter_input(INPUT_POST, 'nome_mae', FILTER_SANITIZE_STRING));
$rh->set_nascimento(filter_input(INPUT_POST, 'nascimento', FILTER_SANITIZE_STRING));
$rh->set_ctps(filter_input(INPUT_POST, 'ctps', FILTER_SANITIZE_STRING));
$rh->set_data_ctps(filter_input(INPUT_POST, 'data_ctps', FILTER_SANITIZE_STRING));
$rh->set_titulo_eleitor(filter_input(INPUT_POST, 'titulo_eleitor', FILTER_SANITIZE_STRING));
$rh->set_identidade(filter_input(INPUT_POST, 'identidade', FILTER_SANITIZE_STRING));
$rh->set_org_emissor_identidade(filter_input(INPUT_POST, 'org_emissor_identidade', FILTER_SANITIZE_STRING));
$rh->set_emissao_identidade(filter_input(INPUT_POST, 'emissao_identidade', FILTER_SANITIZE_STRING));
$rh->set_cpf(filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING));
$rh->set_pis(filter_input(INPUT_POST, 'pis', FILTER_SANITIZE_STRING));
$rh->set_data_cad_pis(filter_input(INPUT_POST, 'data_cad_pis', FILTER_SANITIZE_STRING));
$rh->set_admissao(filter_input(INPUT_POST, 'admissao', FILTER_SANITIZE_STRING));
$rh->set_exame_admissional(filter_input(INPUT_POST, 'exame_admissional', FILTER_SANITIZE_STRING));
$rh->set_exame_medico(filter_input(INPUT_POST, 'exame_medico', FILTER_SANITIZE_STRING));
$rh->set_nome_conselho_regional(filter_input(INPUT_POST, 'nome_conselho_regional', FILTER_SANITIZE_STRING));
$rh->set_id_rh_estado_civil(filter_input(INPUT_POST, 'id_rh_estado_civil', FILTER_SANITIZE_NUMBER_INT));
$rh->set_id_rh_grau_instrucao_escolar(filter_input(INPUT_POST, 'id_rh_grau_instrucao_escolar', FILTER_SANITIZE_NUMBER_INT));
$rh->set_id_rh_cor_pessoa(filter_input(INPUT_POST, 'id_rh_cor_pessoa', FILTER_SANITIZE_NUMBER_INT));
$rh->set_id_rh_deficiencia_pessoa(filter_input(INPUT_POST, 'id_rh_deficiencia_pessoa', FILTER_SANITIZE_NUMBER_INT));
$rh->set_endereco(filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING));
$rh->set_numero(filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING));
$rh->set_complemento(filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING));
$rh->set_uf(filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_NUMBER_INT));
$rh->set_cidade(filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_NUMBER_INT));
$rh->set_bairro(filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING));
$rh->set_cep(filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING));
$rh->set_id_rh_departamentos(filter_input(INPUT_POST, 'id_rh_departamento', FILTER_SANITIZE_NUMBER_INT));
$rh->set_id_rh_funcoes(filter_input(INPUT_POST, 'id_rh_funcoes', FILTER_SANITIZE_NUMBER_INT));
$rh->set_uf2(filter_input(INPUT_POST, 'uf2', FILTER_SANITIZE_NUMBER_INT));
$rh->set_cidade2(filter_input(INPUT_POST, 'cidade2', FILTER_SANITIZE_NUMBER_INT));
$rh->set_id_rateio_folha(filter_input(INPUT_POST, 'id_rh_rateio_folha', FILTER_SANITIZE_NUMBER_INT));
$rh->set_membro_cipa(filter_input(INPUT_POST, 'membro_cipa', FILTER_SANITIZE_NUMBER_INT));
$rh->set_anotacoes_gerais(filter_input(INPUT_POST, 'anotacoes_gerais', FILTER_SANITIZE_STRING));
$rh->set_data_saida(filter_input(INPUT_POST, 'data_saida', FILTER_SANITIZE_STRING));
$rh->set_exame_demissional(filter_input(INPUT_POST, 'exame_demissional', FILTER_SANITIZE_STRING));
$rh->set_id_status_vinculo(filter_input(INPUT_POST, 'id_rh_vinculo', FILTER_SANITIZE_NUMBER_INT));
$rh->set_id_rh_empresas(filter_input(INPUT_POST, 'id_rh_empresas', FILTER_SANITIZE_NUMBER_INT));
$rh->set_id_rh_unidades(filter_input(INPUT_POST, 'id_rh_unidades', FILTER_SANITIZE_NUMBER_INT));

$confirm = $rh->save_RH_Funcionarios($rh->get_nome(), $rh->get_matricula(), $rh->get_nome_pai(), $rh->get_nome_mae(), 
        $rh->get_nascimento(), $rh->get_ctps(), $rh->get_data_ctps(), $rh->get_titulo_eleitor(), $rh->get_admissao(), 
        $rh->get_exame_admissional(), $rh->get_exame_medico(), $rh->get_identidade(), $rh->get_emissao_identidade(), 
        $rh->get_org_emissor_identidade(), $rh->get_cpf(), $rh->get_pis(), $rh->get_data_cad_pis(), $rh->get_nome_conselho_regional(), 
        $rh->get_id_rh_estado_civil(), $rh->get_id_rh_grau_instrucao_escolar(), $rh->get_id_sexo(), $rh->get_id_rh_cor_pessoa(), 
        $rh->get_id_rh_deficiencia_pessoa(), $rh->get_endereco(), $rh->get_numero(), $rh->get_complemento(), $rh->get_bairro(), 
        $rh->get_id_cidade(), $rh->get_id_estado(), $rh->get_cep(), $rh->get_id_rh_departamentos(), $rh->get_id_rh_funcoes(), 
        $rh->get_salario_atual(), $rh->get_id_local_trabalho_cidade(), $rh->get_id_rateio_folha(), $rh->get_membro_cipa(), 
        $rh->get_anotacoes_gerais(), $rh->get_data_saida(), $rh->get_exame_demissional(), $rh->get_id_status_vinculo(), 
        $rh->get_id_rh_empresas(), $rh->get_id_rh_unidades());

if ($confirm === TRUE) {    
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Incluído com Sucesso!!</div>';
} else {    
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}