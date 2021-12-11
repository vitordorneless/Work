<?php

class DMED {
    private $nome;
    private $id;
    private $data;
    private $data_dmed;
    private $RPPSS;
    private $cpf_RPPSS;
    private $BRPPSS;
    private $cpf_BRPPSS;
    private $dn;
    private $valor;
    private $recibo;
    private $unidade;
    
    public function set_data($data) {
        $this->data = $data;
    }

    public function get_data() {
        return $this->data;
    }
    
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }
    
    public function set_data_dmed($data_dmed) {
        $this->data_dmed = $data_dmed;
    }

    public function get_data_dmed() {
        return $this->data_dmed;
    }
    
    public function set_RPPSS($RPPSS) {
        $this->RPPSS = $RPPSS;
    }

    public function get_RPPSS() {
        return $this->RPPSS;
    }
    
    public function set_cpf_RPPSS($cpf_RPPSS) {
        $this->cpf_RPPSS = $cpf_RPPSS;
    }

    public function get_cpf_RPPSS() {
        return $this->cpf_RPPSS;
    }
    
    public function set_BRPPSS($BRPPSS) {
        $this->BRPPSS = $BRPPSS;
    }

    public function get_BRPPSS() {
        return $this->BRPPSS;
    }
    
    public function set_cpf_BRPPSS($cpf_BRPPSS) {
        $this->cpf_BRPPSS = $cpf_BRPPSS;
    }

    public function get_cpf_BRPPSS() {
        return $this->cpf_BRPPSS;
    }
    
    public function set_dn($dn) {
        $this->dn = $dn;
    }

    public function get_dn() {
        return $this->dn;
    }
    
    public function set_valor($valor) {
        $this->valor = $valor;
    }

    public function get_valor() {
        return $this->valor;
    }
    
    public function set_recibo($recibo) {
        $this->recibo = $recibo;
    }

    public function get_recibo() {
        return $this->recibo;
    }
    
    public function set_unidade($unidade) {
        $this->unidade = $unidade;
    }

    public function get_unidade() {
        return $this->unidade;
    }
    
    public function set_nome($nome) {
        $this->nome = $nome;
    }

    public function get_nome() {
        return $this->nome;
    }
}