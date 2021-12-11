<?php

class Herval {
    private $id;
    private $id_individual;
    private $id_tipo_unidade;
    private $id_empresa;
    private $id_unidade;
    private $cnpj;
    private $inscricao_estadual;
    private $cnae;
    private $grau_risco;
    private $endereco;
    private $atividades_realizadas;
    private $local_atividades_realizadas;
    private $media_empregados;
    private $status;
    private $data_ultima_alteracao;    
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
    private $avaliacao_psicossocial;
    private $obs_1;
    private $obs_2;
    private $obs_3;
    private $obs_4;
    private $obs_5;
    private $obs_6;
    private $obs_7;
    private $obs_8;    
    private $obs_9;
    private $obs_10;
    private $data_agendamento;
    private $id_situacao;
    private $id_medico;
    private $valor_consulta;
    private $voucher;
    private $user_cad;
    private $nome_agendamento;
    private $id_herval_funcao;
    private $id_herval_setor;
    private $id_tipo_agendamento;
    private $mostrar_data;
    private $id_convocacao;
    private $data;
    private $horario;
    
    public function set_id_tipo_unidade($id_tipo_unidade) {
        $this->id_tipo_unidade = $id_tipo_unidade;
    }

    public function get_id_tipo_unidade() {
        return $this->id_tipo_unidade;
    }
    
    public function set_id_individual($id_individual) {
        $this->id_individual = $id_individual;
    }

    public function get_id_individual() {
        return $this->id_individual;
    }
    
    public function set_data($data) {
        $this->data = $data;
    }

    public function get_data() {
        return $this->data;
    }
    
    public function set_horario($horario) {
        $this->horario = $horario;
    }

    public function get_horario() {
        return $this->horario;
    }
    
    public function set_id_convocacao($id_convocacao) {
        $this->id_convocacao = $id_convocacao;
    }

    public function get_id_convocacao() {
        return $this->id_convocacao;
    }
    
    public function set_mostrar_data($mostrar_data) {
        $this->mostrar_data = $mostrar_data;
    }

    public function get_mostrar_data() {
        return $this->mostrar_data;
    }
    
    public function set_id_tipo_agendamento($id_tipo_agendamento) {
        $this->id_tipo_agendamento = $id_tipo_agendamento;
    }

    public function get_id_tipo_agendamento() {
        return $this->id_tipo_agendamento;
    }
    
    public function set_id_herval_setor($id_herval_setor) {
        $this->id_herval_setor = $id_herval_setor;
    }

    public function get_id_herval_setor() {
        return $this->id_herval_setor;
    }
    
    public function set_id_herval_funcao($id_herval_funcao) {
        $this->id_herval_funcao = $id_herval_funcao;
    }

    public function get_id_herval_funcao() {
        return $this->id_herval_funcao;
    }
    
    public function set_nome_agendamento($nome_agendamento) {
        $this->nome_agendamento = $nome_agendamento;
    }

    public function get_nome_agendamento() {
        return $this->nome_agendamento;
    }
    
    public function set_data_agendamento($data_agendamento) {
        $this->data_agendamento = $data_agendamento;
    }

    public function get_data_agendamento() {
        return $this->data_agendamento;
    }
    
    public function set_id_situacao($id_situacao) {
        $this->id_situacao = $id_situacao;
    }

    public function get_id_situacao() {
        return $this->id_situacao;
    }
    
    public function set_id_medico($id_medico) {
        $this->id_medico = $id_medico;
    }

    public function get_id_medico() {
        return $this->id_medico;
    }
    
    public function set_valor_consulta($valor_consulta) {
        $this->valor_consulta = $valor_consulta;
    }

    public function get_valor_consulta() {
        return $this->valor_consulta;
    }
    
    public function set_voucher($voucher) {
        $this->voucher = $voucher;
    }

    public function get_voucher() {
        return $this->voucher;
    }
    
    public function set_user_cad($user_cad) {
        $this->user_cad = $user_cad;
    }

    public function get_user_cad() {
        return $this->user_cad;
    }
    
    
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }
    
    public function set_id_empresa($id_empresa) {
        $this->id_empresa = $id_empresa;
    }

    public function get_id_empresa() {
        return $this->id_empresa;
    }
    
    public function set_id_unidade($id_unidade) {
        $this->id_unidade = $id_unidade;
    }

    public function get_id_unidade() {
        return $this->id_unidade;
    }
    
    public function set_cnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function get_cnpj() {
        return $this->cnpj;
    }
    
    public function set_inscricao_estadual($inscricao_estadual) {
        $this->inscricao_estadual = $inscricao_estadual;
    }

    public function get_inscricao_estadual() {
        return $this->inscricao_estadual;
    }
    
    public function set_cnae($cnae) {
        $this->cnae = $cnae;
    }

    public function get_cnae() {
        return $this->cnae;
    }
    
    public function set_grau_risco($grau_risco) {
        $this->grau_risco = $grau_risco;
    }

    public function get_grau_risco() {
        return $this->grau_risco;
    }
    
    public function set_endereco($endereco) {
        $this->endereco = $endereco;
    }

    public function get_endereco() {
        return $this->endereco;
    }
    
    public function set_atividades_realizadas($atividades_realizadas) {
        $this->atividades_realizadas = $atividades_realizadas;
    }

    public function get_atividades_realizadas() {
        return $this->atividades_realizadas;
    }
    
    public function set_local_atividades_realizadas($local_atividades_realizadas) {
        $this->local_atividades_realizadas = $local_atividades_realizadas;
    }

    public function get_local_atividades_realizadas() {
        return $this->local_atividades_realizadas;
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
    
    public function set_media_empregados($media_empregados) {
        $this->media_empregados = $media_empregados;
    }

    public function get_media_empregados() {
        return $this->media_empregados;
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
    
    public function set_avaliacao_psicossocial($avaliacao_psicossocial) {
        $this->avaliacao_psicossocial = $avaliacao_psicossocial;
    }

    public function get_avaliacao_psicossocial() {
        return $this->avaliacao_psicossocial;
    }
    
    public function set_obs_1($obs_1) {
        $this->obs_1 = $obs_1;
    }

    public function get_obs_1() {
        return $this->obs_1;
    }
    
    public function set_obs_2($obs_2) {
        $this->obs_2 = $obs_2;
    }

    public function get_obs_2() {
        return $this->obs_2;
    }
    
    public function set_obs_3($obs_3) {
        $this->obs_3 = $obs_3;
    }

    public function get_obs_3() {
        return $this->obs_3;
    }
    
    public function set_obs_4($obs_4) {
        $this->obs_4 = $obs_4;
    }

    public function get_obs_4() {
        return $this->obs_4;
    }
    
    public function set_obs_5($obs_5) {
        $this->obs_5 = $obs_5;
    }

    public function get_obs_5() {
        return $this->obs_5;
    }
    
    public function set_obs_6($obs_6) {
        $this->obs_6 = $obs_6;
    }

    public function get_obs_6() {
        return $this->obs_6;
    }
    
    public function set_obs_7($obs_7) {
        $this->obs_7 = $obs_7;
    }

    public function get_obs_7() {
        return $this->obs_7;
    }
    
    public function set_obs_8($obs_8) {
        $this->obs_8 = $obs_8;
    }

    public function get_obs_8() {
        return $this->obs_8;
    }
    
    public function set_obs_9($obs_9) {
        $this->obs_9 = $obs_9;
    }

    public function get_obs_9() {
        return $this->obs_9;
    }
    
    public function set_obs_10($obs_10) {
        $this->obs_10 = $obs_10;
    }

    public function get_obs_10() {
        return $this->obs_10;
    }
}