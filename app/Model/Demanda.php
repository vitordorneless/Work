<?php

class Demanda {

    private $id;
    private $id_f;
    private $desc_status;
    private $desc_demanda;
    private $title_demanda;
    private $ativo;
    private $data_ultima_alteracao;
    private $id_demanda;
    private $desc_solucao;
    private $prazo;
    private $tipo;
    private $status;
    private $posicao;
    private $sla;
    private $setor;    
    private $destinosetor;
    private $id_responsavel;
    private $executantes;
    private $copyemail;
    private $id_status_clone_demanda;
    private $id_status_qualidade;    
    private $empresa;
    private $nome_ativo;
    private $cpf_ativo;
    private $nome_dep;
    private $nome_dep1;
    private $nome_dep2;
    private $nome_dep3;
    private $nome_dep4;
    private $nome_dep5;
    private $nome_dep6;
    private $nome_dep7;
    private $nome_dep8;
    private $cpf_dep;
    private $cpf_dep1;
    private $cpf_dep2;
    private $cpf_dep3;
    private $cpf_dep4;
    private $cpf_dep5;
    private $cpf_dep6;
    private $cpf_dep7;
    private $cpf_dep8;    
    private $mail1;
    private $mail2;
    private $mail3;
    private $mail4;
    private $mail5;
    private $mail6;
    private $mail7;
    private $obs;
    private $data_fechamento;
    private $data_abertura;
    
    public function set_obs($obs) {
        $this->obs = $obs;
    }

    public function get_obs() {
        return $this->obs;
    }
    
    public function set_data_fechamento($data_fechamento) {
        $this->data_fechamento = $data_fechamento;
    }

    public function get_data_fechamento() {
        return $this->data_fechamento;
    }
    
    public function set_data_abertura($data_abertura) {
        $this->data_abertura = $data_abertura;
    }

    public function get_data_abertura() {
        return $this->data_abertura;
    }
    
    public function set_mail1($mail1) {
        $this->mail1 = $mail1;
    }

    public function get_mail1() {
        return $this->mail1;
    }
    
    public function set_mail2($mail2) {
        $this->mail2 = $mail2;
    }

    public function get_mail2() {
        return $this->mail2;
    }
    
    public function set_mail3($mail3) {
        $this->mail3 = $mail3;
    }

    public function get_mail3() {
        return $this->mail3;
    }
    
    public function set_mail4($mail4) {
        $this->mail4 = $mail4;
    }

    public function get_mail4() {
        return $this->mail4;
    }
    
    public function set_mail5($mail5) {
        $this->mail5 = $mail5;
    }

    public function get_mail5() {
        return $this->mail5;
    }
    
    public function set_mail6($mail6) {
        $this->mail6 = $mail6;
    }

    public function get_mail6() {
        return $this->mail6;
    }
    
    public function set_mail7($mail7) {
        $this->mail7 = $mail7;
    }

    public function get_mail7() {
        return $this->mail7;
    }
    
    public function set_empresa($empresa) {
        $this->empresa = $empresa;
    }

    public function get_empresa() {
        return $this->empresa;
    }
    
    public function set_nome_ativo($nome_ativo) {
        $this->nome_ativo = $nome_ativo;
    }

    public function get_nome_ativo() {
        return $this->nome_ativo;
    }
    
    public function set_cpf_ativo($cpf_ativo) {
        $this->cpf_ativo = $cpf_ativo;
    }

    public function get_cpf_ativo() {
        return $this->cpf_ativo;
    }
    
    public function set_nome_dep($nome_dep) {
        $this->nome_dep = $nome_dep;
    }

    public function get_nome_dep() {
        return $this->nome_dep;
    }
    
    public function set_posicao($posicao) {
        $this->posicao = $posicao;
    }

    public function get_posicao() {
        return $this->posicao;
    }
    
    public function set_nome_dep1($nome_dep1) {
        $this->nome_dep1 = $nome_dep1;
    }

    public function get_nome_dep1() {
        return $this->nome_dep1;
    }
    
    public function set_nome_dep2($nome_dep2) {
        $this->nome_dep2 = $nome_dep2;
    }

    public function get_nome_dep2() {
        return $this->nome_dep2;
    }
    
    public function set_nome_dep3($nome_dep3) {
        $this->nome_dep3 = $nome_dep3;
    }

    public function get_nome_dep3() {
        return $this->nome_dep3;
    }
    
    public function set_nome_dep4($nome_dep4) {
        $this->nome_dep4 = $nome_dep4;
    }

    public function get_nome_dep4() {
        return $this->nome_dep4;
    }
    
    public function set_nome_dep5($nome_dep5) {
        $this->nome_dep5 = $nome_dep5;
    }

    public function get_nome_dep5() {
        return $this->nome_dep5;
    }
    
    public function set_nome_dep6($nome_dep6) {
        $this->nome_dep6 = $nome_dep6;
    }

    public function get_nome_dep6() {
        return $this->nome_dep6;
    }
    
    public function set_nome_dep7($nome_dep7) {
        $this->nome_dep7 = $nome_dep7;
    }

    public function get_nome_dep7() {
        return $this->nome_dep7;
    }
    
    public function set_nome_dep8($nome_dep8) {
        $this->nome_dep8 = $nome_dep8;
    }

    public function get_nome_dep8() {
        return $this->nome_dep8;
    }
    
    public function set_cpf_dep($cpf_dep) {
        $this->cpf_dep = $cpf_dep;
    }

    public function get_cpf_dep() {
        return $this->cpf_dep;
    }
    
    public function set_cpf_dep1($cpf_dep1) {
        $this->cpf_dep1 = $cpf_dep1;
    }

    public function get_cpf_dep1() {
        return $this->cpf_dep1;
    }
    
    public function set_cpf_dep2($cpf_dep2) {
        $this->cpf_dep2 = $cpf_dep2;
    }

    public function get_cpf_dep2() {
        return $this->cpf_dep2;
    }
    
    public function set_cpf_dep3($cpf_dep3) {
        $this->cpf_dep3 = $cpf_dep3;
    }

    public function get_cpf_dep3() {
        return $this->cpf_dep3;
    }
    
    public function set_cpf_dep4($cpf_dep4) {
        $this->cpf_dep4 = $cpf_dep4;
    }

    public function get_cpf_dep4() {
        return $this->cpf_dep4;
    }
    
    public function set_cpf_dep5($cpf_dep5) {
        $this->cpf_dep5 = $cpf_dep5;
    }

    public function get_cpf_dep5() {
        return $this->cpf_dep5;
    }
    
    public function set_cpf_dep6($cpf_dep6) {
        $this->cpf_dep6 = $cpf_dep6;
    }

    public function get_cpf_dep6() {
        return $this->cpf_dep6;
    }
    
    public function set_cpf_dep7($cpf_dep7) {
        $this->cpf_dep7 = $cpf_dep7;
    }

    public function get_cpf_dep7() {
        return $this->cpf_dep7;
    }
    
    public function set_cpf_dep8($cpf_dep8) {
        $this->cpf_dep8 = $cpf_dep8;
    }

    public function get_cpf_dep8() {
        return $this->cpf_dep8;
    }

    public function set_id_status_clone_demanda($id_status_clone_demanda) {
        $this->id_status_clone_demanda = $id_status_clone_demanda;
    }

    public function get_id_status_clone_demanda() {
        return $this->id_status_clone_demanda;
    }
    
    public function set_id_status_qualidade($id_status_qualidade) {
        $this->id_status_qualidade = $id_status_qualidade;
    }

    public function get_id_status_qualidade() {
        return $this->id_status_qualidade;
    }
    
    public function set_id_f($id_f) {
        $this->id_f = $id_f;
    }

    public function get_id_f() {
        return $this->id_f;
    }
    
    public function set_destinosetor($destinosetor) {
        $this->destinosetor = $destinosetor;
    }

    public function get_destinosetor() {
        return $this->destinosetor;
    }
    
    public function set_id_responsavel($id_responsavel) {
        $this->id_responsavel = $id_responsavel;
    }

    public function get_id_responsavel() {
        return $this->id_responsavel;
    }
    
    public function set_executantes($executantes) {
        $this->executantes = $executantes;
    }

    public function get_executantes() {
        return $this->executantes;
    }
    
    public function set_copyemail($copyemail) {
        $this->copyemail = $copyemail;
    }

    public function get_copyemail() {
        return $this->copyemail;
    }
    
    public function set_sla($sla) {
        $this->sla = $sla;
    }

    public function get_sla() {
        return $this->sla;
    }
    
    public function set_setor($setor) {
        $this->setor = $setor;
    }

    public function get_setor() {
        return $this->setor;
    }
    
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }
    
    public function set_tipo($tipo) {
        $this->tipo = $tipo;
    }

    public function get_tipo() {
        return $this->tipo;
    }
    
    public function set_desc_demanda($desc_demanda) {
        $this->desc_demanda = $desc_demanda;
    }

    public function get_desc_demanda() {
        return $this->desc_demanda;
    }
    
    public function set_title_demanda($title_demanda) {
        $this->title_demanda = $title_demanda;
    }

    public function get_title_demanda() {
        return $this->title_demanda;
    }

    public function set_desc_status($desc_status) {
        $this->desc_status = $desc_status;
    }

    public function get_desc_status() {
        return $this->desc_status;
    }

    public function set_ativo($ativo) {
        $this->ativo = $ativo;
    }

    public function get_ativo() {
        return $this->ativo;
    }

    public function set_data_ultima_alteracao($data_ultima_alteracao) {
        $this->data_ultima_alteracao = $data_ultima_alteracao;
    }

    public function get_data_ultima_alteracao() {
        return $this->data_ultima_alteracao;
    }

    public function set_id_demanda($id_demanda) {
        $this->id_demanda = $id_demanda;
    }

    public function get_id_demanda() {
        return $this->id_demanda;
    }

    public function set_desc_solucao($desc_solucao) {
        $this->desc_solucao = $desc_solucao;
    }

    public function get_desc_solucao() {
        return $this->desc_solucao;
    }

    public function set_prazo($prazo) {
        $this->prazo = $prazo;
    }

    public function get_prazo() {
        return $this->prazo;
    }

    public function set_status($status) {
        $this->status = $status;
    }

    public function get_status() {
        return $this->status;
    }
}