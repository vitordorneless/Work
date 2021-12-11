<?php

class Riscos {

    private $loja;
    private $bandeira;
    private $id;
    private $id_bd;
    private $cod_cargo;
    private $agente_fisico;
    private $agente_quimico;
    private $agente_biologico;
    private $agente_ergonomico;
    private $ausencia_de_risco;
    private $exame_clinico;
    private $acido_metil_hipurico;
    private $hemograma;
    private $acido_mandelico;
    private $vdrl;
    private $reticulocitos;
    private $parasitologico_fezes;
    private $cultural_de_orofaringe;
    private $coprocultura;
    private $micologico_de_unha;
    private $audiometria;
    private $ecg;
    private $acuidade_visual;
    private $eeg;
    private $plaquetas;
    private $eritrograma;
    private $acido_tt_muconico;
    private $glicemia_em_jejum;
    private $acido_hipurico;    
    private $obs_agente_fisico;
    private $obs_agente_quimico;
    private $obs_agente_biologico;
    private $obs_agente_ergonomico;
    private $obs_ausencia_de_risco;
    private $depto;
    private $avaliacao_psicossocial;
    private $trab_altura;
    private $apto_altura;    
    private $anti_hbs;
    private $hbs_ag;
    private $anti_hbc;
    
    public function set_anti_hbs($anti_hbs) {
        $this->anti_hbs = $anti_hbs;
    }

    public function get_anti_hbs() {
        return $this->anti_hbs;
    }
    
    public function set_hbs_ag($hbs_ag) {
        $this->hbs_ag = $hbs_ag;
    }

    public function get_hbs_ag() {
        return $this->hbs_ag;
    }
    
    public function set_anti_hbc($anti_hbc) {
        $this->anti_hbc = $anti_hbc;
    }

    public function get_anti_hbc() {
        return $this->anti_hbc;
    }
    
    public function set_id_bd($id_bd) {
        $this->id_bd = $id_bd;
    }

    public function get_id_bd() {
        return $this->id_bd;
    }
    
    public function set_apto_altura($apto_altura) {
        $this->apto_altura = $apto_altura;
    }

    public function get_apto_altura() {
        return $this->apto_altura;
    }
    
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }
    
    public function set_trab_altura($trab_altura) {
        $this->trab_altura = $trab_altura;
    }

    public function get_trab_altura() {
        return $this->trab_altura;
    }
    
    public function set_avaliacao_psicossocial($avaliacao_psicossocial) {
        $this->avaliacao_psicossocial = $avaliacao_psicossocial;
    }

    public function get_avaliacao_psicossocial() {
        return $this->avaliacao_psicossocial;
    }
    
    public function set_depto($depto) {
        $this->depto = $depto;
    }

    public function get_depto() {
        return $this->depto;
    }
    
    public function set_obs_agente_fisico($obs_agente_fisico) {
        $this->obs_agente_fisico = $obs_agente_fisico;
    }

    public function get_obs_agente_fisico() {
        return $this->obs_agente_fisico;
    }
    
    public function set_obs_agente_quimico($obs_agente_quimico) {
        $this->obs_agente_quimico = $obs_agente_quimico;
    }

    public function get_obs_agente_quimico() {
        return $this->obs_agente_quimico;
    }
    
    public function set_obs_agente_biologico($obs_agente_biologico) {
        $this->obs_agente_biologico = $obs_agente_biologico;
    }

    public function get_obs_agente_biologico() {
        return $this->obs_agente_biologico;
    }
    
    public function set_obs_agente_ergonomico($obs_agente_ergonomico) {
        $this->obs_agente_ergonomico = $obs_agente_ergonomico;
    }

    public function get_obs_agente_ergonomico() {
        return $this->obs_agente_ergonomico;
    }
    
    public function set_obs_ausencia_de_risco($obs_ausencia_de_risco) {
        $this->obs_ausencia_de_risco = $obs_ausencia_de_risco;
    }

    public function get_obs_ausencia_de_risco() {
        return $this->obs_ausencia_de_risco;
    }

    public function set_loja($loja) {
        $this->loja = $loja;
    }

    public function get_loja() {
        return $this->loja;
    }
    
    public function set_cod_cargo($cod_cargo) {
        $this->cod_cargo = $cod_cargo;
    }

    public function get_cod_cargo() {
        return $this->cod_cargo;
    }
    
    public function set_agente_fisico($agente_fisico) {
        $this->agente_fisico = $agente_fisico;
    }

    public function get_agente_fisico() {
        return $this->agente_fisico;
    }
    
    public function set_agente_quimico($agente_quimico) {
        $this->agente_quimico = $agente_quimico;
    }

    public function get_agente_quimico() {
        return $this->agente_quimico;
    }
    
    public function set_agente_biologico($agente_biologico) {
        $this->agente_biologico = $agente_biologico;
    }

    public function get_agente_biologico() {
        return $this->agente_biologico;
    }
    
    public function set_agente_ergonomico($agente_ergonomico) {
        $this->agente_ergonomico = $agente_ergonomico;
    }

    public function get_agente_ergonomico() {
        return $this->agente_ergonomico;
    }
    
    public function set_ausencia_de_risco($ausencia_de_risco) {
        $this->ausencia_de_risco = $ausencia_de_risco;
    }

    public function get_ausencia_de_risco() {
        return $this->ausencia_de_risco;
    }
    
    public function set_exame_clinico($exame_clinico) {
        $this->exame_clinico = $exame_clinico;
    }

    public function get_exame_clinico() {
        return $this->exame_clinico;
    }
    
    public function set_acido_metil_hipurico($acido_metil_hipurico) {
        $this->acido_metil_hipurico = $acido_metil_hipurico;
    }

    public function get_acido_metil_hipurico() {
        return $this->acido_metil_hipurico;
    }
    
    public function set_hemograma($hemograma) {
        $this->hemograma = $hemograma;
    }

    public function get_hemograma() {
        return $this->hemograma;
    }
    
    public function set_acido_mandelico($acido_mandelico) {
        $this->acido_mandelico = $acido_mandelico;
    }

    public function get_acido_mandelico() {
        return $this->acido_mandelico;
    }
    
    public function set_vdrl($vdrl) {
        $this->vdrl = $vdrl;
    }

    public function get_vdrl() {
        return $this->vdrl;
    }
    
    public function set_reticulocitos($reticulocitos) {
        $this->reticulocitos = $reticulocitos;
    }

    public function get_reticulocitos() {
        return $this->reticulocitos;
    }
    
    public function set_parasitologico_fezes($parasitologico_fezes) {
        $this->parasitologico_fezes = $parasitologico_fezes;
    }

    public function get_parasitologico_fezes() {
        return $this->parasitologico_fezes;
    }
    
    public function set_cultural_de_orofaringe($cultural_de_orofaringe) {
        $this->cultural_de_orofaringe = $cultural_de_orofaringe;
    }

    public function get_cultural_de_orofaringe() {
        return $this->cultural_de_orofaringe;
    }
    
    public function set_coprocultura($coprocultura) {
        $this->coprocultura = $coprocultura;
    }

    public function get_coprocultura() {
        return $this->coprocultura;
    }
    
    public function set_micologico_de_unha($micologico_de_unha) {
        $this->micologico_de_unha = $micologico_de_unha;
    }

    public function get_micologico_de_unha() {
        return $this->micologico_de_unha;
    }
    
    public function set_audiometria($audiometria) {
        $this->audiometria = $audiometria;
    }

    public function get_audiometria() {
        return $this->audiometria;
    }
    
    public function set_ecg($ecg) {
        $this->ecg = $ecg;
    }

    public function get_ecg() {
        return $this->ecg;
    }
    
    public function set_acuidade_visual($acuidade_visual) {
        $this->acuidade_visual = $acuidade_visual;
    }

    public function get_acuidade_visual() {
        return $this->acuidade_visual;
    }
    
    public function set_eeg($eeg) {
        $this->eeg = $eeg;
    }

    public function get_eeg() {
        return $this->eeg;
    }
    
    public function set_plaquetas($plaquetas) {
        $this->plaquetas = $plaquetas;
    }

    public function get_plaquetas() {
        return $this->plaquetas;
    }
    
    public function set_eritrograma($eritrograma) {
        $this->eritrograma = $eritrograma;
    }

    public function get_eritrograma() {
        return $this->eritrograma;
    }
    
    public function set_acido_tt_muconico($acido_tt_muconico) {
        $this->acido_tt_muconico = $acido_tt_muconico;
    }

    public function get_acido_tt_muconico() {
        return $this->acido_tt_muconico;
    }
    
    public function set_glicemia_em_jejum($glicemia_em_jejum) {
        $this->glicemia_em_jejum = $glicemia_em_jejum;
    }

    public function get_glicemia_em_jejum() {
        return $this->glicemia_em_jejum;
    }
    
    public function set_acido_hipurico($acido_hipurico) {
        $this->acido_hipurico = $acido_hipurico;
    }

    public function get_acido_hipurico() {
        return $this->acido_hipurico;
    }
    
    public function set_bandeira($bandeira) {
        $this->bandeira = $bandeira;
    }

    public function get_bandeira() {
        return $this->bandeira;
    }
}