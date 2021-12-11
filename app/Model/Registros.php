<?php

class Registros {

    private $nome_arquivo;
    private $status;
    private $data_ultima_alteracao;
    private $id;
    private $data_retorno_webtran;
    private $id_usuario;
    private $arquivo_sig;
    private $data_arquivo_sig;
    private $header_geral;
    private $header_apolice;
    private $apolice;
    private $data_transmissao;
    private $tipo_registro;
    private $numero_registro_R;
    private $conteudo_R;
    private $brancos_R;
    private $numero_registro_E;
    private $cod_erro_E;
    private $descricao_erro_E;
    private $sequencia_E;
    private $brancos_E;

    public function set_data_retorno_webtran($data_retorno_webtran) {
        $this->data_retorno_webtran = $data_retorno_webtran;
    }

    public function get_data_retorno_webtran() {
        return $this->data_retorno_webtran;
    }

    public function set_id_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function get_id_usuario() {
        return $this->id_usuario;
    }

    public function set_arquivo_sig($arquivo_sig) {
        $this->arquivo_sig = $arquivo_sig;
    }

    public function get_arquivo_sig() {
        return $this->arquivo_sig;
    }

    public function set_data_arquivo_sig($data_arquivo_sig) {
        $this->data_arquivo_sig = $data_arquivo_sig;
    }

    public function get_data_arquivo_sig() {
        return $this->data_arquivo_sig;
    }

    public function set_header_geral($header_geral) {
        $this->header_geral = $header_geral;
    }

    public function get_header_geral() {
        return $this->header_geral;
    }

    public function set_header_apolice($header_apolice) {
        $this->header_apolice = $header_apolice;
    }

    public function get_header_apolice() {
        return $this->header_apolice;
    }

    public function set_apolice($apolice) {
        $this->apolice = $apolice;
    }

    public function get_apolice() {
        return $this->apolice;
    }

    public function set_data_transmissao($data_transmissao) {
        $this->data_transmissao = $data_transmissao;
    }

    public function get_data_transmissao() {
        return $this->data_transmissao;
    }

    public function set_tipo_registro($tipo_registro) {
        $this->tipo_registro = $tipo_registro;
    }

    public function get_tipo_registro() {
        return $this->tipo_registro;
    }

    public function set_numero_registro_R($numero_registro_R) {
        $this->numero_registro_R = $numero_registro_R;
    }

    public function get_numero_registro_R() {
        return $this->numero_registro_R;
    }

    public function set_conteudo_R($conteudo_R) {
        $this->conteudo_R = $conteudo_R;
    }

    public function get_conteudo_R() {
        return $this->conteudo_R;
    }

    public function set_brancos_R($brancos_R) {
        $this->brancos_R = $brancos_R;
    }

    public function get_brancos_R() {
        return $this->brancos_R;
    }

    public function set_numero_registro_E($numero_registro_E) {
        $this->numero_registro_E = $numero_registro_E;
    }

    public function get_numero_registro_E() {
        return $this->numero_registro_E;
    }

    public function set_cod_erro_E($cod_erro_E) {
        $this->cod_erro_E = $cod_erro_E;
    }

    public function get_cod_erro_E() {
        return $this->cod_erro_E;
    }

    public function set_descricao_erro_E($descricao_erro_E) {
        $this->descricao_erro_E = $descricao_erro_E;
    }

    public function get_descricao_erro_E() {
        return $this->descricao_erro_E;
    }

    public function set_sequencia_E($sequencia_E) {
        $this->sequencia_E = $sequencia_E;
    }

    public function get_sequencia_E() {
        return $this->sequencia_E;
    }

    public function set_brancos_E($brancos_E) {
        $this->brancos_E = $brancos_E;
    }

    public function get_brancos_E() {
        return $this->brancos_E;
    }

    public function set_nome_arquivo($nome_arquivo) {
        $this->nome_arquivo = $nome_arquivo;
    }

    public function get_nome_arquivo() {
        return $this->nome_arquivo;
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