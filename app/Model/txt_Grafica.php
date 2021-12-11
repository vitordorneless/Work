<?php

class txt_Grafica {
    private $empresa;
    private $estabelecimento;
    private $nome_medico;
    private $crm;
    private $funcao;
        
    public function set_empresa($empresa) {
        $this->empresa = $empresa;
    }

    public function get_empresa() {
        return $this->empresa;
    }
    
    public function set_estabelecimento($estabelecimento) {
        $this->estabelecimento = $estabelecimento;
    }

    public function get_estabelecimento() {
        return $this->estabelecimento;
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
    
    public function set_funcao($funcao) {
        $this->funcao = $funcao;
    }

    public function get_funcao() {
        return $this->funcao;
    }
}