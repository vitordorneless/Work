<?php

class Walmart {

    private $id;
    private $matricula;
    private $nome;
    private $rg;
    private $cpf;
    private $nascimento;
    private $cod_cargo;
    private $cod_setor;
    private $cod_empresa;
    private $cod_loja;
    private $status;
    private $id_medico;
    private $cpf_medico;
    private $data_ultima_alteracao;
    private $etiqueta;
    private $id_usuario;
    private $id_wal_box;
    private $comp_ACIDO_METIL_HIPURICO;
    private $comp_HEMOGRAMA;
    private $comp_ACIDO_MANDELICO;
    private $comp_VDRL;
    private $comp_RETICULOCITOS;
    private $comp_PARASITOLOGICO_FEZES;
    private $comp_CULTURAL_DE_OROFARINGE;
    private $comp_COPROCULTURA;
    private $comp_MICOLOGICO_DE_UNHA;
    private $comp_AUDIOMETRIA;
    private $comp_ECG;
    private $comp_ACUIDADE_VISUAL;
    private $comp_EEG;
    private $comp_PLAQUETAS;
    private $comp_ERITROGRAMA;
    private $comp_ACIDO_TT_MUCONICO;
    private $comp_GLICEMIA_EM_JEJUM;
    private $comp_ACIDO_HIPURICO;
    private $comp_AVALIACAO_PSICOSSOCIAL;    
    private $protocolo;
    private $data_envio_loja;
    private $id_forma_envio;
    private $data_retorno;
    private $periodicos;
    private $ids_envelope;
    private $flg_periodico;
    private $medico_coordenador;
    private $bandeira;
    
    public function set_bandeira($bandeira) {
        $this->bandeira = $bandeira;
    }

    public function get_bandeira() {
        return $this->bandeira;
    }
    
    public function set_medico_coordenador($medico_coordenador) {
        $this->medico_coordenador = $medico_coordenador;
    }

    public function get_medico_coordenador() {
        return $this->medico_coordenador;
    }
    
    public function set_flg_periodico($flg_periodico) {
        $this->flg_periodico = $flg_periodico;
    }

    public function get_flg_periodico() {
        return $this->flg_periodico;
    }
    
    public function set_ids_envelope($ids_envelope) {
        $this->ids_envelope = $ids_envelope;
    }

    public function get_ids_envelope() {
        return $this->ids_envelope;
    }
    
    public function set_periodicos($periodicos) {
        $this->periodicos = $periodicos;
    }

    public function get_periodicos() {
        return $this->periodicos;
    }
    
    public function set_protocolo($protocolo) {
        $this->protocolo = $protocolo;
    }

    public function get_protocolo() {
        return $this->protocolo;
    }
    
    public function set_data_envio_loja($data_envio_loja) {
        $this->data_envio_loja = $data_envio_loja;
    }

    public function get_data_envio_loja() {
        return $this->data_envio_loja;
    }
    
    public function set_id_forma_envio($id_forma_envio) {
        $this->id_forma_envio = $id_forma_envio;
    }

    public function get_id_forma_envio() {
        return $this->id_forma_envio;
    }
    
    public function set_data_retorno($data_retorno) {
        $this->data_retorno = $data_retorno;
    }

    public function get_data_retorno() {
        return $this->data_retorno;
    }

    public function set_comp_ACIDO_METIL_HIPURICO($comp_ACIDO_METIL_HIPURICO) {
        $this->comp_ACIDO_METIL_HIPURICO = $comp_ACIDO_METIL_HIPURICO;
    }

    public function get_comp_ACIDO_METIL_HIPURICO() {
        return $this->comp_ACIDO_METIL_HIPURICO;
    }

    public function set_comp_HEMOGRAMA($comp_HEMOGRAMA) {
        $this->comp_HEMOGRAMA = $comp_HEMOGRAMA;
    }

    public function get_comp_HEMOGRAMA() {
        return $this->comp_HEMOGRAMA;
    }

    public function set_comp_ACIDO_MANDELICO($comp_ACIDO_MANDELICO) {
        $this->comp_ACIDO_MANDELICO = $comp_ACIDO_MANDELICO;
    }

    public function get_comp_ACIDO_MANDELICO() {
        return $this->comp_ACIDO_MANDELICO;
    }

    public function set_comp_VDRL($comp_VDRL) {
        $this->comp_VDRL = $comp_VDRL;
    }

    public function get_comp_VDRL() {
        return $this->comp_VDRL;
    }

    public function set_comp_RETICULOCITOS($comp_RETICULOCITOS) {
        $this->comp_RETICULOCITOS = $comp_RETICULOCITOS;
    }

    public function get_comp_RETICULOCITOS() {
        return $this->comp_RETICULOCITOS;
    }

    public function set_comp_PARASITOLOGICO_FEZES($comp_PARASITOLOGICO_FEZES) {
        $this->comp_PARASITOLOGICO_FEZES = $comp_PARASITOLOGICO_FEZES;
    }

    public function get_comp_PARASITOLOGICO_FEZES() {
        return $this->comp_PARASITOLOGICO_FEZES;
    }

    public function set_comp_CULTURAL_DE_OROFARINGE($comp_CULTURAL_DE_OROFARINGE) {
        $this->comp_CULTURAL_DE_OROFARINGE = $comp_CULTURAL_DE_OROFARINGE;
    }

    public function get_comp_CULTURAL_DE_OROFARINGE() {
        return $this->comp_CULTURAL_DE_OROFARINGE;
    }

    public function set_comp_COPROCULTURA($comp_COPROCULTURA) {
        $this->comp_COPROCULTURA = $comp_COPROCULTURA;
    }

    public function get_comp_COPROCULTURA() {
        return $this->comp_COPROCULTURA;
    }

    public function set_comp_MICOLOGICO_DE_UNHA($comp_MICOLOGICO_DE_UNHA) {
        $this->comp_MICOLOGICO_DE_UNHA = $comp_MICOLOGICO_DE_UNHA;
    }

    public function get_comp_MICOLOGICO_DE_UNHA() {
        return $this->comp_MICOLOGICO_DE_UNHA;
    }

    public function set_comp_AUDIOMETRIA($comp_AUDIOMETRIA) {
        $this->comp_AUDIOMETRIA = $comp_AUDIOMETRIA;
    }

    public function get_comp_AUDIOMETRIA() {
        return $this->comp_AUDIOMETRIA;
    }

    public function set_comp_ECG($comp_ECG) {
        $this->comp_ECG = $comp_ECG;
    }

    public function get_comp_ECG() {
        return $this->comp_ECG;
    }

    public function set_comp_ACUIDADE_VISUAL($comp_ACUIDADE_VISUAL) {
        $this->comp_ACUIDADE_VISUAL = $comp_ACUIDADE_VISUAL;
    }

    public function get_comp_ACUIDADE_VISUAL() {
        return $this->comp_ACUIDADE_VISUAL;
    }

    public function set_comp_EEG($comp_EEG) {
        $this->comp_EEG = $comp_EEG;
    }

    public function get_comp_EEG() {
        return $this->comp_EEG;
    }

    public function set_comp_PLAQUETAS($comp_PLAQUETAS) {
        $this->comp_PLAQUETAS = $comp_PLAQUETAS;
    }

    public function get_comp_PLAQUETAS() {
        return $this->comp_PLAQUETAS;
    }

    public function set_comp_ERITROGRAMA($comp_ERITROGRAMA) {
        $this->comp_ERITROGRAMA = $comp_ERITROGRAMA;
    }

    public function get_comp_ERITROGRAMA() {
        return $this->comp_ERITROGRAMA;
    }

    public function set_comp_ACIDO_TT_MUCONICO($comp_ACIDO_TT_MUCONICO) {
        $this->comp_ACIDO_TT_MUCONICO = $comp_ACIDO_TT_MUCONICO;
    }

    public function get_comp_ACIDO_TT_MUCONICO() {
        return $this->comp_ACIDO_TT_MUCONICO;
    }

    public function set_comp_GLICEMIA_EM_JEJUM($comp_GLICEMIA_EM_JEJUM) {
        $this->comp_GLICEMIA_EM_JEJUM = $comp_GLICEMIA_EM_JEJUM;
    }

    public function get_comp_GLICEMIA_EM_JEJUM() {
        return $this->comp_GLICEMIA_EM_JEJUM;
    }

    public function set_comp_ACIDO_HIPURICO($comp_ACIDO_HIPURICO) {
        $this->comp_ACIDO_HIPURICO = $comp_ACIDO_HIPURICO;
    }

    public function get_comp_ACIDO_HIPURICO() {
        return $this->comp_ACIDO_HIPURICO;
    }

    public function set_comp_AVALIACAO_PSICOSSOCIAL($comp_AVALIACAO_PSICOSSOCIAL) {
        $this->comp_AVALIACAO_PSICOSSOCIAL = $comp_AVALIACAO_PSICOSSOCIAL;
    }

    public function get_comp_AVALIACAO_PSICOSSOCIAL() {
        return $this->comp_AVALIACAO_PSICOSSOCIAL;
    }

    public function set_etiqueta($etiqueta) {
        $this->etiqueta = $etiqueta;
    }

    public function get_etiqueta() {
        return $this->etiqueta;
    }

    public function set_id_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function get_id_usuario() {
        return $this->id_usuario;
    }

    public function set_id_wal_box($id_wal_box) {
        $this->id_wal_box = $id_wal_box;
    }

    public function get_id_wal_box() {
        return $this->id_wal_box;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_id_medico($id_medico) {
        $this->id_medico = $id_medico;
    }

    public function get_id_medico() {
        return $this->id_medico;
    }

    public function set_cpf_medico($cpf_medico) {
        $this->cpf_medico = $cpf_medico;
    }

    public function get_cpf_medico() {
        return $this->cpf_medico;
    }

    public function set_matricula($matricula) {
        $this->matricula = $matricula;
    }

    public function get_matricula() {
        return $this->matricula;
    }

    public function set_nome($nome) {
        $this->nome = $nome;
    }

    public function get_nome() {
        return $this->nome;
    }

    public function set_rg($rg) {
        $this->rg = $rg;
    }

    public function get_rg() {
        return $this->rg;
    }

    public function set_cpf($cpf) {
        $this->cpf = $cpf;
    }

    public function get_cpf() {
        return $this->cpf;
    }

    public function set_nascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    public function get_nascimento() {
        return $this->nascimento;
    }

    public function set_cod_cargo($cod_cargo) {
        $this->cod_cargo = $cod_cargo;
    }

    public function get_cod_cargo() {
        return $this->cod_cargo;
    }

    public function set_cod_setor($cod_setor) {
        $this->cod_setor = $cod_setor;
    }

    public function get_cod_setor() {
        return $this->cod_setor;
    }

    public function set_cod_empresa($cod_empresa) {
        $this->cod_empresa = $cod_empresa;
    }

    public function get_cod_empresa() {
        return $this->cod_empresa;
    }

    public function set_cod_loja($cod_loja) {
        $this->cod_loja = $cod_loja;
    }

    public function get_cod_loja() {
        return $this->cod_loja;
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