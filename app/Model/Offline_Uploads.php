<?php

class Offline_Uploads {
    private $id;
    private $nome_arquivo;
    private $nome_medico;
    private $crm;
    private $status;
    private $data_ultima_alteracao;

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }
    
    public function set_nome_arquivo($nome_arquivo) {
        $this->nome_arquivo = $nome_arquivo;
    }

    public function get_nome_arquivo() {
        return $this->nome_arquivo;
    }
    
    public function set_nome_medico($nome_medico) {
        $this->nome_medico = $nome_medico;
    }

    public function get_nome_medico() {
        return $this->nome_medico;
    }
    
    public function set_crm($crm) {
        $this->crm = $crm;
    }

    public function get_crm() {
        return $this->crm;
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