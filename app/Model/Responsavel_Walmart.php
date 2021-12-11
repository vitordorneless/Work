<?php

class Responsavel_Walmart {
    private $id;
    private $id_empresa;
    private $id_loja;
    private $nome_responsavel;
    private $ddd;
    private $telefone;
    private $email;
    private $status;
    private $data_ultima_alteracao;
    
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }
    
    public function set_id_empresa($id_empresa) {
        $this->id_empresa = $id_empresa;
    }

    public function get_id_empresa() {
        return $this->id_empresa;
    }
    
    public function set_id_loja($id_loja) {
        $this->id_loja = $id_loja;
    }

    public function get_id_loja() {
        return $this->id_loja;
    }
    
    public function set_nome_responsavel($nome_responsavel) {
        $this->nome_responsavel = $nome_responsavel;
    }

    public function get_nome_responsavel() {
        return $this->nome_responsavel;
    }
    
    public function set_ddd($ddd) {
        $this->ddd = $ddd;
    }

    public function get_ddd() {
        return $this->ddd;
    }
    
    public function set_telefone($telefone) {
        $this->telefone = $telefone;
    }

    public function get_telefone() {
        return $this->telefone;
    }
    
    public function set_email($email) {
        $this->email = $email;
    }

    public function get_email() {
        return $this->email;
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