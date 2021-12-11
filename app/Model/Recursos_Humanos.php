<?php

class Recursos_Humanos {
    private $id;
    private $estado_civil;
    private $grau;
    private $status;
    private $data_ultima_alteracao;    
    private $nome;
    private $matricula;
    private $nome_pai;
    private $nome_mae;
    private $nascimento;
    private $ctps;
    private $data_ctps;
    private $titulo_eleitor;
    private $admissao;
    private $exame_admissional;
    private $exame_medico;
    private $identidade;
    private $emissao_identidade;
    private $org_emissor_identidade;
    private $cpf;
    private $pis;
    private $data_cad_pis;
    private $nome_conselho_regional;
    private $id_rh_estado_civil;
    private $id_rh_grau_instrucao_escolar;
    private $id_sexo;
    private $id_rh_cor_pessoa;
    private $id_rh_deficiencia_pessoa;
    private $endereco;
    private $numero;
    private $complemento;
    private $bairro;
    private $id_cidade;
    private $id_estado;
    private $cep;
    private $id_rh_departamentos;
    private $id_rh_funcoes;
    private $salario_atual;
    private $id_local_trabalho_cidade;
    private $id_rateio_folha;
    private $membro_cipa;
    private $anotacoes_gerais;
    private $data_saida;
    private $exame_demissional;
    private $id_status_vinculo;
    private $id_rh_empresas;
    private $id_rh_unidades;
    private $uf;
    private $cidade;
    private $uf2;
    private $cidade2;
    
    public function set_cidade2($cidade2) {
        $this->cidade2 = $cidade2;
    }

    public function get_cidade2() {
        return $this->cidade2;
    }
    
    public function set_uf2($uf2) {
        $this->uf2 = $uf2;
    }

    public function get_uf2() {
        return $this->uf2;
    }
    
    public function set_cidade($cidade) {
        $this->cidade = $cidade;
    }

    public function get_cidade() {
        return $this->cidade;
    }
    
    public function set_uf($uf) {
        $this->uf = $uf;
    }

    public function get_uf() {
        return $this->uf;
    }
    
    public function set_nome($nome) {
        $this->nome = $nome;
    }

    public function get_nome() {
        return $this->nome;
    }
    
    public function set_matricula($matricula) {
        $this->matricula = $matricula;
    }

    public function get_matricula() {
        return $this->matricula;
    }
    
    public function set_nome_pai($nome_pai) {
        $this->nome_pai = $nome_pai;
    }

    public function get_nome_pai() {
        return $this->nome_pai;
    }
    
    public function set_nome_mae($nome_mae) {
        $this->nome_mae = $nome_mae;
    }

    public function get_nome_mae() {
        return $this->nome_mae;
    }
    
    public function set_nascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    public function get_nascimento() {
        return $this->nascimento;
    }
    
    public function set_ctps($ctps) {
        $this->ctps = $ctps;
    }

    public function get_ctps() {
        return $this->ctps;
    }
    
    public function set_data_ctps($data_cps) {
        $this->data_cps = $data_cps;
    }

    public function get_data_ctps() {
        return $this->data_cps;
    }
    
    public function set_titulo_eleitor($titulo_eleitor) {
        $this->titulo_eleitor = $titulo_eleitor;
    }

    public function get_titulo_eleitor() {
        return $this->titulo_eleitor;
    }
    
    public function set_admissao($admissao) {
        $this->admissao = $admissao;
    }

    public function get_admissao() {
        return $this->admissao;
    }
    
    public function set_exame_admissional($exame_admissional) {
        $this->exame_admissional = $exame_admissional;
    }

    public function get_exame_admissional() {
        return $this->exame_admissional;
    }
    
    public function set_exame_medico($exame_medico) {
        $this->exame_medico = $exame_medico;
    }

    public function get_exame_medico() {
        return $this->exame_medico;
    }
    
    public function set_identidade($identidade) {
        $this->identidade = $identidade;
    }

    public function get_identidade() {
        return $this->identidade;
    }
    
    public function set_emissao_identidade($emissao_identidade) {
        $this->emissao_identidade = $emissao_identidade;
    }

    public function get_emissao_identidade() {
        return $this->emissao_identidade;
    }
    
    public function set_org_emissor_identidade($org_emissor_identidade) {
        $this->org_emissor_identidade = $org_emissor_identidade;
    }

    public function get_org_emissor_identidade() {
        return $this->org_emissor_identidade;
    }
    
    public function set_cpf($cpf) {
        $this->cpf = $cpf;
    }

    public function get_cpf() {
        return $this->cpf;
    }
    
    public function set_pis($pis) {
        $this->pis = $pis;
    }

    public function get_pis() {
        return $this->pis;
    }
    
    public function set_data_cad_pis($data_cad_pis) {
        $this->data_cad_pis = $data_cad_pis;
    }

    public function get_data_cad_pis() {
        return $this->data_cad_pis;
    }
    
    public function set_nome_conselho_regional($nome_conselho_regional) {
        $this->nome_conselho_regional = $nome_conselho_regional;
    }

    public function get_nome_conselho_regional() {
        return $this->nome_conselho_regional;
    }
    
    public function set_id_rh_estado_civil($id_rh_estado_civil) {
        $this->id_rh_estado_civil = $id_rh_estado_civil;
    }

    public function get_id_rh_estado_civil() {
        return $this->id_rh_estado_civil;
    }
    
    public function set_id_rh_grau_instrucao_escolar($id_rh_grau_instrucao_escolar) {
        $this->id_rh_grau_instrucao_escolar = $id_rh_grau_instrucao_escolar;
    }

    public function get_id_rh_grau_instrucao_escolar() {
        return $this->id_rh_grau_instrucao_escolar;
    }
    
    public function set_id_sexo($id_sexo) {
        $this->id_sexo = $id_sexo;
    }

    public function get_id_sexo() {
        return $this->id_sexo;
    }
    
    public function set_id_rh_cor_pessoa($id_rh_cor_pessoa) {
        $this->id_rh_cor_pessoa = $id_rh_cor_pessoa;
    }

    public function get_id_rh_cor_pessoa() {
        return $this->id_rh_cor_pessoa;
    }
    
    public function set_id_rh_deficiencia_pessoa($id_rh_deficiencia_pessoa) {
        $this->id_rh_deficiencia_pessoa = $id_rh_deficiencia_pessoa;
    }

    public function get_id_rh_deficiencia_pessoa() {
        return $this->id_rh_deficiencia_pessoa;
    }
    
    public function set_endereco($endereco) {
        $this->endereco = $endereco;
    }

    public function get_endereco() {
        return $this->endereco;
    }
    
    public function set_numero($numero) {
        $this->numero = $numero;
    }

    public function get_numero() {
        return $this->numero;
    }
    
    public function set_complemento($complemento) {
        $this->complemento = $complemento;
    }

    public function get_complemento() {
        return $this->complemento;
    }
    
    public function set_bairro($bairro) {
        $this->bairro = $bairro;
    }

    public function get_bairro() {
        return $this->bairro;
    }
    
    public function set_id_cidade($id_cidade) {
        $this->id_cidade = $id_cidade;
    }

    public function get_id_cidade() {
        return $this->id_cidade;
    }
    
    public function set_id_estado($id_estado) {
        $this->id_estado = $id_estado;
    }

    public function get_id_estado() {
        return $this->id_estado;
    }
    
    public function set_cep($cep) {
        $this->cep = $cep;
    }

    public function get_cep() {
        return $this->cep;
    }
    
    public function set_id_rh_departamentos($id_rh_departamentos) {
        $this->id_rh_departamentos = $id_rh_departamentos;
    }

    public function get_id_rh_departamentos() {
        return $this->id_rh_departamentos;
    }
    
    public function set_id_rh_funcoes($id_rh_funcoes) {
        $this->id_rh_funcoes = $id_rh_funcoes;
    }

    public function get_id_rh_funcoes() {
        return $this->id_rh_funcoes;
    }
    
    public function set_salario_atual($salario_atual) {
        $this->salario_atual = $salario_atual;
    }

    public function get_salario_atual() {
        return $this->salario_atual;
    }
    
    public function set_id_local_trabalho_cidade($id_local_trabalho_cidade) {
        $this->id_local_trabalho_cidade = $id_local_trabalho_cidade;
    }

    public function get_id_local_trabalho_cidade() {
        return $this->id_local_trabalho_cidade;
    }
    
    public function set_id_rateio_folha($id_rateio_folha) {
        $this->id_rateio_folha = $id_rateio_folha;
    }

    public function get_id_rateio_folha() {
        return $this->id_rateio_folha;
    }
    
    public function set_membro_cipa($membro_cipa) {
        $this->membro_cipa = $membro_cipa;
    }

    public function get_membro_cipa() {
        return $this->membro_cipa;
    }
    
    public function set_anotacoes_gerais($anotacoes_gerais) {
        $this->anotacoes_gerais = $anotacoes_gerais;
    }

    public function get_anotacoes_gerais() {
        return $this->anotacoes_gerais;
    }
    
    public function set_data_saida($data_saida) {
        $this->data_saida = $data_saida;
    }

    public function get_data_saida() {
        return $this->data_saida;
    }
    
    public function set_exame_demissional($exame_demissional) {
        $this->exame_demissional = $exame_demissional;
    }

    public function get_exame_demissional() {
        return $this->exame_demissional;
    }
    
    public function set_id_status_vinculo($id_status_vinculo) {
        $this->id_status_vinculo = $id_status_vinculo;
    }

    public function get_id_status_vinculo() {
        return $this->id_status_vinculo;
    }
    
    public function set_id_rh_empresas($id_rh_empresas) {
        $this->id_rh_empresas = $id_rh_empresas;
    }

    public function get_id_rh_empresas() {
        return $this->id_rh_empresas;
    }
    
    public function set_id_rh_unidades($id_rh_unidades) {
        $this->id_rh_unidades = $id_rh_unidades;
    }

    public function get_id_rh_unidades() {
        return $this->id_rh_unidades;
    }
    
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }
    
    public function set_estado_civil($estado_civil) {
        $this->estado_civil = $estado_civil;
    }

    public function get_estado_civil() {
        return $this->estado_civil;
    }
    
    public function set_grau($grau) {
        $this->grau = $grau;
    }

    public function get_grau() {
        return $this->grau;
    }
    
    public function set_status($status) {
        $this->status = $status;
    }

    public function get_status() {
        return $this->status;
    }
    
    public function set_data_ultima_alteracao($data_ultima_alteracao) {
        $this->data_ultima_alteracao = $data_ultima_alteracao;
    }

    public function get_data_ultima_alteracao() {
        return $this->data_ultima_alteracao;
    }
}
