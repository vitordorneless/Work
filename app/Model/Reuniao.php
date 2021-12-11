<?php

class Reuniao {
    private $tipo;
    private $status;
    private $data_ultima_alteracao;
    private $id;
    
    public function set_tipo($tipo) {
        $this->tipo = $tipo;
    }

    public function get_tipo() {
        return $this->tipo;
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
    
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }
}
