<?php

class Chamado {

    private $id;
    private $protocolo;
    private $id_usuario;
    private $id_ativo;
    private $cpf_ativo;
    private $nome_ativo;
    private $id_demanda;
    private $status;
    private $data_ultima_alteracao;
    private $id_dependente;
    private $cpf_dependente;
    private $nome_dependente;
    private $loja;
    private $complemento_demanda;    
    private $id_chamado;
    private $data_entrada;
    private $prazo;
    private $validade;
    private $procedente;
    private $motivo_encerramento;
    private $obs;
    private $usuario_encerramento;
    private $data_abertura_chamado;
    private $anexo;
    private $executante;
    private $novo_executante;
    private $emergencial;
    
    public function set_novo_executante($novo_executante) {
        $this->novo_executante = $novo_executante;
    }

    public function get_novo_executante() {
        return $this->novo_executante;
    }
    
    public function set_emergencial($emergencial) {
        $this->emergencial = $emergencial;
    }

    public function get_emergencial() {
        return $this->emergencial;
    }

    public function set_executante($executante) {
        $this->executante = $executante;
    }

    public function get_executante() {
        return $this->executante;
    }

    public function set_anexo($anexo) {
        $this->anexo = $anexo;
    }

    public function get_anexo() {
        return $this->anexo;
    }
    
    public function set_motivo_encerramento($motivo_encerramento) {
        $this->motivo_encerramento = $motivo_encerramento;
    }

    public function get_motivo_encerramento() {
        return $this->motivo_encerramento;
    }
    
    public function set_obs($obs) {
        $this->obs = $obs;
    }

    public function get_obs() {
        return $this->obs;
    }
    
    public function set_usuario_encerramento($usuario_encerramento) {
        $this->usuario_encerramento = $usuario_encerramento;
    }

    public function get_usuario_encerramento() {
        return $this->usuario_encerramento;
    }
    
    public function set_data_abertura_chamado($data_abertura_chamado) {
        $this->data_abertura_chamado = $data_abertura_chamado;
    }

    public function get_data_abertura_chamado() {
        return $this->data_abertura_chamado;
    }


    public function set_id_chamado($id_chamado) {
        $this->id_chamado = $id_chamado;
    }

    public function get_id_chamado() {
        return $this->id_chamado;
    }
    
    public function set_data_entrada($data_entrada) {
        $this->data_entrada = $data_entrada;
    }

    public function get_data_entrada() {
        return $this->data_entrada;
    }
    
    public function set_prazo($prazo) {
        $this->prazo = $prazo;
    }

    public function get_prazo() {
        return $this->prazo;
    }
    
    public function set_validade($validade) {
        $this->validade = $validade;
    }

    public function get_validade() {
        return $this->validade;
    }
    
    public function set_procedente($procedente) {
        $this->procedente = $procedente;
    }

    public function get_procedente() {
        return $this->procedente;
    }    

    public function set_id_dependente($id_dependente) {
        $this->id_dependente = $id_dependente;
    }

    public function get_id_dependente() {
        return $this->id_dependente;
    }
    
    public function set_cpf_dependente($cpf_dependente) {
        $this->cpf_dependente = $cpf_dependente;
    }

    public function get_cpf_dependente() {
        return $this->cpf_dependente;
    }
    
    public function set_nome_dependente($nome_dependente) {
        $this->nome_dependente = $nome_dependente;
    }

    public function get_nome_dependente() {
        return $this->nome_dependente;
    }
    
    public function set_loja($loja) {
        $this->loja = $loja;
    }

    public function get_loja() {
        return $this->loja;
    }
    
    public function set_complemento_demanda($complemento_demanda) {
        $this->complemento_demanda = $complemento_demanda;
    }

    public function get_complemento_demanda() {
        return $this->complemento_demanda;
    }
    
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_protocolo($protocolo) {
        $this->protocolo = $protocolo;
    }

    public function get_protocolo() {
        return $this->protocolo;
    }

    public function set_id_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function get_id_usuario() {
        return $this->id_usuario;
    }

    public function set_id_ativo($id_ativo) {
        $this->id_ativo = $id_ativo;
    }

    public function get_id_ativo() {
        return $this->id_ativo;
    }

    public function set_cpf_ativo($cpf_ativo) {
        $this->cpf_ativo = $cpf_ativo;
    }

    public function get_cpf_ativo() {
        return $this->cpf_ativo;
    }

    public function set_nome_ativo($nome_ativo) {
        $this->nome_ativo = $nome_ativo;
    }

    public function get_nome_ativo() {
        return $this->nome_ativo;
    }

    public function set_id_demanda($id_demanda) {
        $this->id_demanda = $id_demanda;
    }

    public function get_id_demanda() {
        return $this->id_demanda;
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