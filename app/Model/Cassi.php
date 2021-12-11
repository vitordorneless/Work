<?php

class Cassi {

    private $id;
    private $matricula;
    private $prefixo_agencia;
    private $nome_ativo;
    private $id_sexo;
    private $data_nascimento;
    private $data_posse;
    private $status;
    private $data_ultima_alteracao;
    private $prefixo;
    private $dependencia;
    private $municipio;
    private $jurisdicao;
    private $cod_comissao;
    private $desc_comissao;    
    private $data_agendamento;
    private $horario;
    private $id_cassi_situacao;
    private $id_medico;
    private $valor_consulta;
    private $user_agendamento;    
    private $finalizado;
    private $pendente;
    private $nao_realizou;
    private $funcionario_ausente;
    private $obs_gerais;    
    private $peg;
    private $guias_anexas;
    private $valor_total;
    private $data_envio;
    private $data_recebido_cassi;
    private $usuario_ama;
    private $nota_fiscal_ama;
    private $nome_arquivo;
    private $nome;
    private $nome_combo;
    private $id_exame;
    private $data_solicitacao;
    private $identidade;
    private $cpf;
    private $nascimento;
    private $funcao;
    private $id_cassi_solicitante;
    private $id_prestador;
    private $id_cidade_solicitada;
    private $id_cidade_realizada;
    private $turno;
    private $prazo_limite;    
    private $data_exame;
    private $obs;
    private $usuario;
    
    public function set_nome_combo($nome_combo) {
        $this->nome_combo = $nome_combo;
    }

    public function get_nome_combo() {
        return $this->nome_combo;
    }
    
    public function set_id_exame($id_exame) {
        $this->id_exame = $id_exame;
    }

    public function get_id_exame() {
        return $this->id_exame;
    }
    
    public function set_data_solicitacao($data_solicitacao) {
        $this->data_solicitacao = $data_solicitacao;
    }

    public function get_data_solicitacao() {
        return $this->data_solicitacao;
    }
    
    public function set_identidade($identidade) {
        $this->identidade = $identidade;
    }

    public function get_identidade() {
        return $this->identidade;
    }
    
    public function set_cpf($cpf) {
        $this->cpf = $cpf;
    }

    public function get_cpf() {
        return $this->cpf;
    }
    
    public function set_nascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    public function get_nascimento() {
        return $this->nascimento;
    }
    
    public function set_funcao($funcao) {
        $this->funcao = $funcao;
    }

    public function get_funcao() {
        return $this->funcao;
    }
    
    public function set_id_cassi_solicitante($id_cassi_solicitante) {
        $this->id_cassi_solicitante = $id_cassi_solicitante;
    }

    public function get_id_cassi_solicitante() {
        return $this->id_cassi_solicitante;
    }
    
    public function set_id_prestador($id_prestador) {
        $this->id_prestador = $id_prestador;
    }

    public function get_id_prestador() {
        return $this->id_prestador;
    }
    
    public function set_id_cidade_solicitada($id_cidade_solicitada) {
        $this->id_cidade_solicitada = $id_cidade_solicitada;
    }

    public function get_id_cidade_solicitada() {
        return $this->id_cidade_solicitada;
    }
    
    public function set_id_cidade_realizada($id_cidade_realizada) {
        $this->id_cidade_realizada = $id_cidade_realizada;
    }

    public function get_id_cidade_realizada() {
        return $this->id_cidade_realizada;
    }
    
    public function set_turno($turno) {
        $this->turno = $turno;
    }

    public function get_turno() {
        return $this->turno;
    }
    
    public function set_prazo_limite($prazo_limite) {
        $this->prazo_limite = $prazo_limite;
    }

    public function get_prazo_limite() {
        return $this->prazo_limite;
    }
    
    public function set_data_exame($data_exame) {
        $this->data_exame = $data_exame;
    }

    public function get_data_exame() {
        return $this->data_exame;
    }
    
    public function set_obs($obs) {
        $this->obs = $obs;
    }

    public function get_obs() {
        return $this->obs;
    }
    
    public function set_usuario($usuario) {
        $this->usuario = $usuario;
    }

    public function get_usuario() {
        return $this->usuario;
    }
    
    public function set_nome($nome) {
        $this->nome = $nome;
    }

    public function get_nome() {
        return $this->nome;
    }
    
    public function set_nome_arquivo($nome_arquivo) {
        $this->nome_arquivo = $nome_arquivo;
    }

    public function get_nome_arquivo() {
        return $this->nome_arquivo;
    }
    
    public function set_peg($peg) {
        $this->peg = $peg;
    }

    public function get_peg() {
        return $this->peg;
    }
    
    public function set_guias_anexas($guias_anexas) {
        $this->guias_anexas = $guias_anexas;
    }

    public function get_guias_anexas() {
        return $this->guias_anexas;
    }
    
    public function set_valor_total($valor_total) {
        $this->valor_total = $valor_total;
    }

    public function get_valor_total() {
        return $this->valor_total;
    }
    
    public function set_data_envio($data_envio) {
        $this->data_envio = $data_envio;
    }

    public function get_data_envio() {
        return $this->data_envio;
    }
    
    public function set_data_recebido_cassi($data_recebido_cassi) {
        $this->data_recebido_cassi = $data_recebido_cassi;
    }

    public function get_data_recebido_cassi() {
        return $this->data_recebido_cassi;
    }
    
    public function set_usuario_ama($usuario_ama) {
        $this->usuario_ama = $usuario_ama;
    }

    public function get_usuario_ama() {
        return $this->usuario_ama;
    }
    
    public function set_nota_fiscal_ama($nota_fiscal_ama) {
        $this->nota_fiscal_ama = $nota_fiscal_ama;
    }

    public function get_nota_fiscal_ama() {
        return $this->nota_fiscal_ama;
    }    
    
    public function set_finalizado($finalizado) {
        $this->finalizado = $finalizado;
    }

    public function get_finalizado() {
        return $this->finalizado;
    }
    
    public function set_pendente($pendente) {
        $this->pendente = $pendente;
    }

    public function get_pendente() {
        return $this->pendente;
    }
    
    public function set_nao_realizou($nao_realizou) {
        $this->nao_realizou = $nao_realizou;
    }

    public function get_nao_realizou() {
        return $this->nao_realizou;
    }
    
    public function set_funcionario_ausente($funcionario_ausente) {
        $this->funcionario_ausente = $funcionario_ausente;
    }

    public function get_funcionario_ausente() {
        return $this->funcionario_ausente;
    }
    
    public function set_obs_gerais($obs_gerais) {
        $this->obs_gerais = $obs_gerais;
    }

    public function get_obs_gerais() {
        return $this->obs_gerais;
    }
    
    public function set_data_agendamento($data_agendamento) {
        $this->data_agendamento = $data_agendamento;
    }

    public function get_data_agendamento() {
        return $this->data_agendamento;
    }
    
    public function set_horario($horario) {
        $this->horario = $horario;
    }

    public function get_horario() {
        return $this->horario;
    }
    
    public function set_id_cassi_situacao($id_cassi_situacao) {
        $this->id_cassi_situacao = $id_cassi_situacao;
    }

    public function get_id_cassi_situacao() {
        return $this->id_cassi_situacao;
    }
    
    public function set_id_medico($id_medico) {
        $this->id_medico = $id_medico;
    }

    public function get_id_medico() {
        return $this->id_medico;
    }
    
    public function set_valor_consulta($valor_consulta) {
        $this->valor_consulta = $valor_consulta;
    }

    public function get_valor_consulta() {
        return $this->valor_consulta;
    }
    
    public function set_user_agendamento($user_agendamento) {
        $this->user_agendamento = $user_agendamento;
    }

    public function get_user_agendamento() {
        return $this->user_agendamento;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_matricula($matricula) {
        $this->matricula = $matricula;
    }

    public function get_matricula() {
        return $this->matricula;
    }

    public function set_prefixo_agencia($prefixo_agencia) {
        $this->prefixo_agencia = $prefixo_agencia;
    }

    public function get_prefixo_agencia() {
        return $this->prefixo_agencia;
    }

    public function set_nome_ativo($nome_ativo) {
        $this->nome_ativo = $nome_ativo;
    }

    public function get_nome_ativo() {
        return $this->nome_ativo;
    }

    public function set_id_sexo($id_sexo) {
        $this->id_sexo = $id_sexo;
    }

    public function get_id_sexo() {
        return $this->id_sexo;
    }

    public function set_data_nascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    public function get_data_nascimento() {
        return $this->data_nascimento;
    }

    public function set_data_posse($data_posse) {
        $this->data_posse = $data_posse;
    }

    public function get_data_posse() {
        return $this->data_posse;
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

    public function set_prefixo($prefixo) {
        $this->prefixo = $prefixo;
    }

    public function get_prefixo() {
        return $this->prefixo;
    }

    public function set_dependencia($dependencia) {
        $this->dependencia = $dependencia;
    }

    public function get_dependencia() {
        return $this->dependencia;
    }

    public function set_municipio($municipio) {
        $this->municipio = $municipio;
    }

    public function get_municipio() {
        return $this->municipio;
    }

    public function set_jurisdicao($jurisdicao) {
        $this->jurisdicao = $jurisdicao;
    }

    public function get_jurisdicao() {
        return $this->jurisdicao;
    }

    public function set_cod_comissao($cod_comissao) {
        $this->cod_comissao = $cod_comissao;
    }

    public function get_cod_comissao() {
        return $this->cod_comissao;
    }

    public function set_desc_comissao($desc_comissao) {
        $this->desc_comissao = $desc_comissao;
    }

    public function get_desc_comissao() {
        return $this->desc_comissao;
    }
}