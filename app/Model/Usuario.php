<?php

class Usuario {

    private $id;
    private $second_id;
    private $nome;
    private $pass;
    private $status;
    private $admin;
    private $email;
    private $nome_extenso;
    private $setor;
    private $foto;
    private $data_ultima_alteracao;
    private $id_usuario;
    private $super_admin;
    private $lojas;
    private $convocacao;
    private $cassi;
    private $medicos_externo;
    private $medicos_walmart;
    private $walmart_gerencial;
    private $cassi_gerencial;
    private $indicadores_cassi;
    private $indicadores_walmart;
    private $relatorios;
    private $id_usuario_cadastro;
    private $herval;
    private $herval_gerencial;
    private $herval_indicadores;
    private $tst;
    private $crm;
    private $tst_gerencial;
    private $tst_indicadores;
    private $demandas;
    private $estado_crm;
    private $nova_senha;
    private $nova_senha1;

    public function set_demandas($demandas) {
        $this->demandas = $demandas;
    }

    public function get_demandas() {
        return $this->demandas;
    }
    
    public function set_nova_senha($nova_senha) {
        $this->nova_senha = $nova_senha;
    }

    public function get_nova_senha() {
        return $this->nova_senha;
    }
    
    public function set_nova_senha1($nova_senha1) {
        $this->nova_senha1 = $nova_senha1;
    }

    public function get_nova_senha1() {
        return $this->nova_senha1;
    }
    
    public function set_estado_crm($estado_crm) {
        $this->estado_crm = $estado_crm;
    }

    public function get_estado_crm() {
        return $this->estado_crm;
    }
    
    public function set_crm($crm) {
        $this->crm = $crm;
    }

    public function get_crm() {
        return $this->crm;
    }
    
    public function set_second_id($second_id) {
        $this->second_id = $second_id;
    }

    public function get_second_id() {
        return $this->second_id;
    }
    
    public function set_tst($tst) {
        $this->tst = $tst;
    }

    public function get_tst() {
        return $this->tst;
    }

    public function set_tst_gerencial($tst_gerencial) {
        $this->tst_gerencial = $tst_gerencial;
    }

    public function get_tst_gerencial() {
        return $this->tst_gerencial;
    }

    public function set_tst_indicadores($tst_indicadores) {
        $this->tst_indicadores = $tst_indicadores;
    }

    public function get_tst_indicadores() {
        return $this->tst_indicadores;
    }
    
    public function set_herval($herval) {
        $this->herval = $herval;
    }

    public function get_herval() {
        return $this->herval;
    }

    public function set_herval_gerencial($herval_gerencial) {
        $this->herval_gerencial = $herval_gerencial;
    }

    public function get_herval_gerencial() {
        return $this->herval_gerencial;
    }

    public function set_herval_indicadores($herval_indicadores) {
        $this->herval_indicadores = $herval_indicadores;
    }

    public function get_herval_indicadores() {
        return $this->herval_indicadores;
    }

    public function set_id_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function get_id_usuario() {
        return $this->id_usuario;
    }

    public function set_relatorios($relatorios) {
        $this->relatorios = $relatorios;
    }

    public function get_relatorios() {
        return $this->relatorios;
    }

    public function set_super_admin($super_admin) {
        $this->super_admin = $super_admin;
    }

    public function get_super_admin() {
        return $this->super_admin;
    }

    public function set_lojas($lojas) {
        $this->lojas = $lojas;
    }

    public function get_lojas() {
        return $this->lojas;
    }

    public function set_convocacao($convocacao) {
        $this->convocacao = $convocacao;
    }

    public function get_convocacao() {
        return $this->convocacao;
    }

    public function set_cassi($cassi) {
        $this->cassi = $cassi;
    }

    public function get_cassi() {
        return $this->cassi;
    }

    public function set_medicos_externo($medicos_externo) {
        $this->medicos_externo = $medicos_externo;
    }

    public function get_medicos_externo() {
        return $this->medicos_externo;
    }

    public function set_medicos_walmart($medicos_walmart) {
        $this->medicos_walmart = $medicos_walmart;
    }

    public function get_medicos_walmart() {
        return $this->medicos_walmart;
    }

    public function set_walmart_gerencial($walmart_gerencial) {
        $this->walmart_gerencial = $walmart_gerencial;
    }

    public function get_walmart_gerencial() {
        return $this->walmart_gerencial;
    }

    public function set_cassi_gerencial($cassi_gerencial) {
        $this->cassi_gerencial = $cassi_gerencial;
    }

    public function get_cassi_gerencial() {
        return $this->cassi_gerencial;
    }

    public function set_indicadores_cassi($indicadores_cassi) {
        $this->indicadores_cassi = $indicadores_cassi;
    }

    public function get_indicadores_cassi() {
        return $this->indicadores_cassi;
    }

    public function set_indicadores_walmart($indicadores_walmart) {
        $this->indicadores_walmart = $indicadores_walmart;
    }

    public function get_indicadores_walmart() {
        return $this->indicadores_walmart;
    }

    public function set_id_usuario_cadastro($id_usuario_cadastro) {
        $this->id_usuario_cadastro = $id_usuario_cadastro;
    }

    public function get_id_usuario_cadastro() {
        return $this->id_usuario_cadastro;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_setor($setor) {
        $this->setor = $setor;
    }

    public function get_setor() {
        return $this->setor;
    }

    public function set_nome_extenso($nome_extenso) {
        $this->nome_extenso = $nome_extenso;
    }

    public function get_nome_extenso() {
        return $this->nome_extenso;
    }

    public function set_email($email) {
        $this->email = $email;
    }

    public function get_email() {
        return $this->email;
    }

    public function set_nome($nome) {
        $this->nome = $nome;
    }

    public function get_nome() {
        return $this->nome;
    }

    public function set_pass($pass) {
        $this->pass = $pass;
    }

    public function get_pass() {
        return $this->pass;
    }

    public function set_status($status) {
        $this->status = $status;
    }

    public function get_status() {
        return $this->status;
    }

    public function set_admin($admin) {
        $this->admin = $admin;
    }

    public function get_admin() {
        return $this->admin;
    }

    public function set_data_ultima_alteracao($data_ultima_alteracao) {
        $this->data_ultima_alteracao = $data_ultima_alteracao;
    }

    public function get_data_ultima_alteracao() {
        return $this->data_ultima_alteracao;
    }

    public function set_foto($foto) {
        $this->foto = $foto;
    }

    public function get_foto() {
        return $this->foto;
    }
}