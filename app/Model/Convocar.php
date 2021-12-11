<?php

class Convocar {
    private $id;
    private $nome_convocacao;
    private $status;
    private $data_ultima_alteracao;
    private $id_datas_eventos_convocacao;
    private $data_evento;    
    private $id_convocacao;
    private $id_datas_evento;
    private $id_responsavel_walmart;
    private $turnos;
    private $empresa;
    private $loja;
    private $kit_entregue;
    private $observacao;
    private $vencimento_anterior;
    private $atendimentos;
    private $email_walmart;
    private $email_ama;
    private $ativos_lojas;
    private $horario;
    private $horario_final;
    private $rastreamento;
    private $data_envio;
    
    public function set_rastreamento($rastreamento) {
        $this->rastreamento = $rastreamento;
    }

    public function get_rastreamento() {
        return $this->rastreamento;
    }
    
    public function set_data_envio($data_envio) {
        $this->data_envio = $data_envio;
    }

    public function get_data_envio() {
        return $this->data_envio;
    }
    
    public function set_horario($horario) {
        $this->horario = $horario;
    }

    public function get_horario() {
        return $this->horario;
    }
    
    public function set_horario_final($horario_final) {
        $this->horario_final = $horario_final;
    }

    public function get_horario_final() {
        return $this->horario_final;
    }
    
    public function set_ativos_lojas($ativos_lojas) {
        $this->ativos_lojas = $ativos_lojas;
    }

    public function get_ativos_lojas() {
        return $this->ativos_lojas;
    }
    
    public function set_id_convocacao($id_convocacao) {
        $this->id_convocacao = $id_convocacao;
    }

    public function get_id_convocacao() {
        return $this->id_convocacao;
    }
    
    public function set_id_datas_evento($id_datas_evento) {
        $this->id_datas_evento = $id_datas_evento;
    }

    public function get_id_datas_evento() {
        return $this->id_datas_evento;
    }
    
    public function set_id_responsavel_walmart($id_responsavel_walmart) {
        $this->id_responsavel_walmart = $id_responsavel_walmart;
    }

    public function get_id_responsavel_walmart() {
        return $this->id_responsavel_walmart;
    }
    
    public function set_turnos($turnos) {
        $this->turnos = $turnos;
    }

    public function get_turnos() {
        return $this->turnos;
    }
    
    public function set_empresa($empresa) {
        $this->empresa = $empresa;
    }

    public function get_empresa() {
        return $this->empresa;
    }
    
    public function set_loja($loja) {
        $this->loja = $loja;
    }

    public function get_loja() {
        return $this->loja;
    }
    
    public function set_kit_entregue($kit_entregue) {
        $this->kit_entregue = $kit_entregue;
    }

    public function get_kit_entregue() {
        return $this->kit_entregue;
    }
    
    public function set_observacao($observacao) {
        $this->observacao = $observacao;
    }

    public function get_observacao() {
        return $this->observacao;
    }
    
    public function set_vencimento_anterior($vencimento_anterior) {
        $this->vencimento_anterior = $vencimento_anterior;
    }

    public function get_vencimento_anterior() {
        return $this->vencimento_anterior;
    }
    
    public function set_atendimentos($atendimentos) {
        $this->atendimentos = $atendimentos;
    }

    public function get_atendimentos() {
        return $this->atendimentos;
    }
    
    public function set_email_walmart($email_walmart) {
        $this->email_walmart = $email_walmart;
    }

    public function get_email_walmart() {
        return $this->email_walmart;
    }
    
    public function set_email_ama($email_ama) {
        $this->email_ama = $email_ama;
    }

    public function get_email_ama() {
        return $this->email_ama;
    }
    
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }
    
    public function set_nome_convocacao($nome_convocacao) {
        $this->nome_convocacao = $nome_convocacao;
    }

    public function get_nome_convocacao() {
        return $this->nome_convocacao;
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
    
    public function set_id_datas_eventos_convocacao($id_datas_eventos_convocacao) {
        $this->id_datas_eventos_convocacao = $id_datas_eventos_convocacao;
    }

    public function get_id_datas_eventos_convocacao() {
        return $this->id_datas_eventos_convocacao;
    }
    
    public function set_data_evento($data_evento) {
        $this->data_evento = $data_evento;
    }

    public function get_data_evento() {
        return $this->data_evento;
    }
}