<?php

class Llamados {

    public $id;
    public $id_chamado_tipo;
    public $id_chamado_status;
    public $id_usuario;
    public $mensagem;
    public $status;
    public $data_ultima_alteracao;
    public $id_chamado;
    public $id_status;
    public $id_mensagem;
    public $id_tecnico;
    public $nome_status;
    public $nome;
    public $apelido;
    public $tipo;
    public $id_chamado_mensagem;

    function __construct($id, $id_chamado_tipo, $id_chamado_status, $id_usuario, $mensagem, $status, $data_ultima_alteracao, $id_chamado, $id_status, $id_mensagem, $id_tecnico, $nome_status, $nome, $apelido, $tipo, $id_chamado_mensagem) {
        $this->id = $id;
        $this->id_chamado_tipo = $id_chamado_tipo;
        $this->id_chamado_status = $id_chamado_status;
        $this->id_usuario = $id_usuario;
        $this->mensagem = $mensagem;
        $this->status = $status;
        $this->data_ultima_alteracao = $data_ultima_alteracao;
        $this->id_chamado = $id_chamado;
        $this->id_status = $id_status;
        $this->id_mensagem = $id_mensagem;
        $this->id_tecnico = $id_tecnico;
        $this->nome_status = $nome_status;
        $this->nome = $nome;
        $this->apelido = $apelido;
        $this->tipo = $tipo;
        $this->id_chamado_mensagem = $id_chamado_mensagem;
    }
}