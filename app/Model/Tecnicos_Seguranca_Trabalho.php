<?php

class Tecnicos_Seguranca_Trabalho {
    private $id;
    private $cnpj;
    private $nome_unidade;
    private $palavra_chave;
    private $endereco;
    private $bairro;
    private $id_cidade;
    private $id_estado;
    private $cep;
    private $numero;
    private $complemento;
    private $user;
    private $status;
    private $data_ultima_alteracao;
    private $tarefa;
    private $data_tarefa;
    private $tarefa_concluida;
    private $nome_agendamento;
    private $nome_cargo;    
    private $nome;
    private $registro;
    private $cpf;
    private $id_cargo;    
    private $id_tipo_agendamento;
    private $id_unidade;
    private $id_turnos;
    private $id_situacao;
    private $id_data_agendamento;
    private $id_tecnicos;
    private $obs;
    private $db;
    private $lux;
    private $funcao;
    private $setor;    
    private $id_agendamento;
    private $horario_trabalho;
    private $inicio_vistoria;
    private $termino_vistoria;
    private $data_vistoria;
    private $area_total;
    private $pe_direito;
    private $id_paredes;
    private $id_piso;
    private $id_forro;
    private $id_iluminacao;
    private $id_lampadas;
    private $id_ventilacao;
    private $id_tst_checklist_controle_limpeza_arcondicionado;
    private $agua_pc;
    private $agua_validade;
    private $po_pc;
    private $po_validade;
    private $gas_pc;
    private $gas_validade;
    private $luz_emergencia_sim;
    private $luz_emergencia_quantas;
    private $luz_emergencia_nao;
    private $id_saida_de_emergencia;
    private $id_tst_checklist_rota_saida_extintores;
    private $numero_funcionarios_quantos;
    private $numero_funcionarios_no_possui_cipa;
    private $numero_funcionarios_possui_cipa;
    private $numero_funcionarios_colaborador_designado;
    private $id_tst_checklist_epi;
    private $id_tst_checklist_trei_epi_epc;
    private $id_tst_checklist_entrega_epi;
    private $id_tst_checklist_insta_eletrica;
    private $id_tst_checklist_atividades_ambiente;
    private $id_tst_checklist_atividades_ambiente_interno;
    private $id_tst_checklist_refeicoes;
    private $id_tst_checklist_local_refeicoes;
    private $id_tst_checklist_insta_sanitarias;
    private $id_tst_checklist_pertence_funcionarios;
    private $id_tst_checklist_avaliacao_ambiente_trab;
    private $id_tst_checklist_seg_integracao;
    private $id_tst_checklist_trein_seg;
    private $sugestao_melhoria;
        
    public function set_id_agendamento($id_agendamento) {
        $this->id_agendamento = $id_agendamento;
    }

    public function get_id_agendamento() {
        return $this->id_agendamento;
    }
    
    public function set_horario_trabalho($horario_trabalho) {
        $this->horario_trabalho = $horario_trabalho;
    }

    public function get_horario_trabalho() {
        return $this->horario_trabalho;
    }
    
    public function set_inicio_vistoria($inicio_vistoria) {
        $this->inicio_vistoria = $inicio_vistoria;
    }

    public function get_inicio_vistoria() {
        return $this->inicio_vistoria;
    }
    
    public function set_termino_vistoria($termino_vistoria) {
        $this->termino_vistoria = $termino_vistoria;
    }

    public function get_termino_vistoria() {
        return $this->termino_vistoria;
    }
    
    public function set_data_vistoria($data_vistoria) {
        $this->data_vistoria = $data_vistoria;
    }

    public function get_data_vistoria() {
        return $this->data_vistoria;
    }
    
    public function set_area_total($area_total) {
        $this->area_total = $area_total;
    }

    public function get_area_total() {
        return $this->area_total;
    }
    
    public function set_pe_direito($pe_direito) {
        $this->pe_direito = $pe_direito;
    }

    public function get_pe_direito() {
        return $this->pe_direito;
    }
    
    public function set_id_paredes($id_paredes) {
        $this->id_paredes = $id_paredes;
    }

    public function get_id_paredes() {
        return $this->id_paredes;
    }
    
    public function set_id_piso($id_piso) {
        $this->id_piso = $id_piso;
    }

    public function get_id_piso() {
        return $this->id_piso;
    }
    
    public function set_id_forro($id_forro) {
        $this->id_forro = $id_forro;
    }

    public function get_id_forro() {
        return $this->id_forro;
    }
    
    public function set_id_iluminacao($id_iluminacao) {
        $this->id_iluminacao = $id_iluminacao;
    }

    public function get_id_iluminacao() {
        return $this->id_iluminacao;
    }
    
    public function set_id_lampadas($id_lampadas) {
        $this->id_lampadas = $id_lampadas;
    }

    public function get_id_lampadas() {
        return $this->id_lampadas;
    }
    
    public function set_id_ventilacao($id_ventilacao) {
        $this->id_ventilacao = $id_ventilacao;
    }

    public function get_id_ventilacao() {
        return $this->id_ventilacao;
    }
    
    public function set_id_tst_checklist_controle_limpeza_arcondicionado($id_tst_checklist_controle_limpeza_arcondicionado) {
        $this->id_tst_checklist_controle_limpeza_arcondicionado = $id_tst_checklist_controle_limpeza_arcondicionado;
    }

    public function get_id_tst_checklist_controle_limpeza_arcondicionado() {
        return $this->id_tst_checklist_controle_limpeza_arcondicionado;
    }
    
    public function set_agua_pc($agua_pc) {
        $this->agua_pc = $agua_pc;
    }

    public function get_agua_pc() {
        return $this->agua_pc;
    }
    
    public function set_agua_validade($agua_validade) {
        $this->agua_validade = $agua_validade;
    }

    public function get_agua_validade() {
        return $this->agua_validade;
    }
    
    public function set_po_pc($po_pc) {
        $this->po_pc = $po_pc;
    }

    public function get_po_pc() {
        return $this->po_pc;
    }
    
    public function set_po_validade($po_validade) {
        $this->po_validade = $po_validade;
    }

    public function get_po_validade() {
        return $this->po_validade;
    }
    
    public function set_gas_pc($gas_pc) {
        $this->gas_pc = $gas_pc;
    }

    public function get_gas_pc() {
        return $this->gas_pc;
    }
    
    public function set_gas_validade($gas_validade) {
        $this->gas_validade = $gas_validade;
    }

    public function get_gas_validade() {
        return $this->gas_validade;
    }
    
    public function set_luz_emergencia_sim($luz_emergencia_sim) {
        $this->luz_emergencia_sim = $luz_emergencia_sim;
    }

    public function get_luz_emergencia_sim() {
        return $this->luz_emergencia_sim;
    }
    
    public function set_luz_emergencia_quantas($luz_emergencia_quantas) {
        $this->luz_emergencia_quantas = $luz_emergencia_quantas;
    }

    public function get_luz_emergencia_quantas() {
        return $this->luz_emergencia_quantas;
    }
    
    public function set_luz_emergencia_nao($luz_emergencia_nao) {
        $this->luz_emergencia_nao = $luz_emergencia_nao;
    }

    public function get_luz_emergencia_nao() {
        return $this->luz_emergencia_nao;
    }
    
    public function set_id_saida_de_emergencia($id_saida_de_emergencia) {
        $this->id_saida_de_emergencia = $id_saida_de_emergencia;
    }

    public function get_id_saida_de_emergencia() {
        return $this->id_saida_de_emergencia;
    }
    
    public function set_id_tst_checklist_rota_saida_extintores($id_tst_checklist_rota_saida_extintores) {
        $this->id_tst_checklist_rota_saida_extintores = $id_tst_checklist_rota_saida_extintores;
    }

    public function get_id_tst_checklist_rota_saida_extintores() {
        return $this->id_tst_checklist_rota_saida_extintores;
    }
    
    public function set_numero_funcionarios_quantos($numero_funcionarios_quantos) {
        $this->numero_funcionarios_quantos = $numero_funcionarios_quantos;
    }

    public function get_numero_funcionarios_quantos() {
        return $this->numero_funcionarios_quantos;
    }
    
    public function set_numero_funcionarios_no_possui_cipa($numero_funcionarios_no_possui_cipa) {
        $this->numero_funcionarios_no_possui_cipa = $numero_funcionarios_no_possui_cipa;
    }

    public function get_numero_funcionarios_no_possui_cipa() {
        return $this->numero_funcionarios_no_possui_cipa;
    }
    
    public function set_numero_funcionarios_possui_cipa($numero_funcionarios_possui_cipa) {
        $this->numero_funcionarios_possui_cipa = $numero_funcionarios_possui_cipa;
    }

    public function get_numero_funcionarios_possui_cipa() {
        return $this->numero_funcionarios_possui_cipa;
    }
    
    public function set_numero_funcionarios_colaborador_designado($numero_funcionarios_colaborador_designado) {
        $this->numero_funcionarios_colaborador_designado = $numero_funcionarios_colaborador_designado;
    }

    public function get_numero_funcionarios_colaborador_designado() {
        return $this->numero_funcionarios_colaborador_designado;
    }
    
    public function set_id_tst_checklist_epi($id_tst_checklist_epi) {
        $this->id_tst_checklist_epi = $id_tst_checklist_epi;
    }

    public function get_id_tst_checklist_epi() {
        return $this->id_tst_checklist_epi;
    }
    
    public function set_id_tst_checklist_trei_epi_epc($id_tst_checklist_trei_epi_epc) {
        $this->id_tst_checklist_trei_epi_epc = $id_tst_checklist_trei_epi_epc;
    }

    public function get_id_tst_checklist_trei_epi_epc() {
        return $this->id_tst_checklist_trei_epi_epc;
    }
    
    public function set_id_tst_checklist_entrega_epi($id_tst_checklist_entrega_epi) {
        $this->id_tst_checklist_entrega_epi = $id_tst_checklist_entrega_epi;
    }

    public function get_id_tst_checklist_entrega_epi() {
        return $this->id_tst_checklist_entrega_epi;
    }
    
    public function set_id_tst_checklist_insta_eletrica($id_tst_checklist_insta_eletrica) {
        $this->id_tst_checklist_insta_eletrica = $id_tst_checklist_insta_eletrica;
    }

    public function get_id_tst_checklist_insta_eletrica() {
        return $this->id_tst_checklist_insta_eletrica;
    }
    
    public function set_id_tst_checklist_atividades_ambiente($id_tst_checklist_atividades_ambiente) {
        $this->id_tst_checklist_atividades_ambiente = $id_tst_checklist_atividades_ambiente;
    }

    public function get_id_tst_checklist_atividades_ambiente() {
        return $this->id_tst_checklist_atividades_ambiente;
    }
    
    public function set_id_tst_checklist_atividades_ambiente_interno($id_tst_checklist_atividades_ambiente_interno) {
        $this->id_tst_checklist_atividades_ambiente_interno = $id_tst_checklist_atividades_ambiente_interno;
    }

    public function get_id_tst_checklist_atividades_ambiente_interno() {
        return $this->id_tst_checklist_atividades_ambiente_interno;
    }
    
    public function set_id_tst_checklist_refeicoes($id_tst_checklist_refeicoes) {
        $this->id_tst_checklist_refeicoes = $id_tst_checklist_refeicoes;
    }

    public function get_id_tst_checklist_refeicoes() {
        return $this->id_tst_checklist_refeicoes;
    }
    
    public function set_id_tst_checklist_local_refeicoes($id_tst_checklist_local_refeicoes) {
        $this->id_tst_checklist_local_refeicoes = $id_tst_checklist_local_refeicoes;
    }

    public function get_id_tst_checklist_local_refeicoes() {
        return $this->id_tst_checklist_local_refeicoes;
    }
    
    public function set_id_tst_checklist_insta_sanitarias($id_tst_checklist_insta_sanitarias) {
        $this->id_tst_checklist_insta_sanitarias = $id_tst_checklist_insta_sanitarias;
    }

    public function get_id_tst_checklist_insta_sanitarias() {
        return $this->id_tst_checklist_insta_sanitarias;
    }
    
    public function set_id_tst_checklist_pertence_funcionarios($id_tst_checklist_pertence_funcionarios) {
        $this->id_tst_checklist_pertence_funcionarios = $id_tst_checklist_pertence_funcionarios;
    }

    public function get_id_tst_checklist_pertence_funcionarios() {
        return $this->id_tst_checklist_pertence_funcionarios;
    }
    
    public function set_id_tst_checklist_avaliacao_ambiente_trab($id_tst_checklist_avaliacao_ambiente_trab) {
        $this->id_tst_checklist_avaliacao_ambiente_trab = $id_tst_checklist_avaliacao_ambiente_trab;
    }

    public function get_id_tst_checklist_avaliacao_ambiente_trab() {
        return $this->id_tst_checklist_avaliacao_ambiente_trab;
    }
    
    public function set_id_tst_checklist_seg_integracao($id_tst_checklist_seg_integracao) {
        $this->id_tst_checklist_seg_integracao = $id_tst_checklist_seg_integracao;
    }

    public function get_id_tst_checklist_seg_integracao() {
        return $this->id_tst_checklist_seg_integracao;
    }
    
    public function set_id_tst_checklist_trein_seg($id_tst_checklist_trein_seg) {
        $this->id_tst_checklist_trein_seg = $id_tst_checklist_trein_seg;
    }

    public function get_id_tst_checklist_trein_seg() {
        return $this->id_tst_checklist_trein_seg;
    }
    
    public function set_sugestao_melhoria($sugestao_melhoria) {
        $this->sugestao_melhoria = $sugestao_melhoria;
    }

    public function get_sugestao_melhoria() {
        return $this->sugestao_melhoria;
    }
    
    public function set_db($db) {
        $this->db = $db;
    }

    public function get_db() {
        return $this->db;
    }
    
    public function set_lux($lux) {
        $this->lux = $lux;
    }

    public function get_lux() {
        return $this->lux;
    }
    
    public function set_funcao($funcao) {
        $this->funcao = $funcao;
    }

    public function get_funcao() {
        return $this->funcao;
    }
    
    public function set_setor($setor) {
        $this->setor = $setor;
    }

    public function get_setor() {
        return $this->setor;
    }
    
    public function set_id_tipo_agendamento($id_tipo_agendamento) {
        $this->id_tipo_agendamento = $id_tipo_agendamento;
    }

    public function get_id_tipo_agendamento() {
        return $this->id_tipo_agendamento;
    }
    
    public function set_id_unidade($id_unidade) {
        $this->id_unidade = $id_unidade;
    }

    public function get_id_unidade() {
        return $this->id_unidade;
    }
    
    public function set_id_turnos($id_turnos) {
        $this->id_turnos = $id_turnos;
    }

    public function get_id_turnos() {
        return $this->id_turnos;
    }
    
    public function set_id_situacao($id_situacao) {
        $this->id_situacao = $id_situacao;
    }

    public function get_id_situacao() {
        return $this->id_situacao;
    }
    
    public function set_id_data_agendamento($id_data_agendamento) {
        $this->id_data_agendamento = $id_data_agendamento;
    }

    public function get_id_data_agendamento() {
        return $this->id_data_agendamento;
    }
    
    public function set_id_tecnicos($id_tecnicos) {
        $this->id_tecnicos = $id_tecnicos;
    }

    public function get_id_tecnicos() {
        return $this->id_tecnicos;
    }
    
    public function set_obs($obs) {
        $this->obs = $obs;
    }

    public function get_obs() {
        return $this->obs;
    }
    
    public function set_nome($nome) {
        $this->nome = $nome;
    }

    public function get_nome() {
        return $this->nome;
    }
    
    public function set_registro($registro) {
        $this->registro = $registro;
    }

    public function get_registro() {
        return $this->registro;
    }
    
    public function set_cpf($cpf) {
        $this->cpf = $cpf;
    }

    public function get_cpf() {
        return $this->cpf;
    }
    
    public function set_id_cargo($id_cargo) {
        $this->id_cargo = $id_cargo;
    }

    public function get_id_cargo() {
        return $this->id_cargo;
    }
    
    public function set_nome_cargo($nome_cargo) {
        $this->nome_cargo = $nome_cargo;
    }

    public function get_nome_cargo() {
        return $this->nome_cargo;
    }
    
    public function set_nome_agendamento($nome_agendamento) {
        $this->nome_agendamento = $nome_agendamento;
    }

    public function get_nome_agendamento() {
        return $this->nome_agendamento;
    }
    
    public function set_tarefa($tarefa) {
        $this->tarefa = $tarefa;
    }

    public function get_tarefa() {
        return $this->tarefa;
    }
    
    public function set_data_tarefa($data_tarefa) {
        $this->data_tarefa = $data_tarefa;
    }

    public function get_data_tarefa() {
        return $this->data_tarefa;
    }
    
    public function set_tarefa_concluida($tarefa_concluida) {
        $this->tarefa_concluida = $tarefa_concluida;
    }

    public function get_tarefa_concluida() {
        return $this->tarefa_concluida;
    }
    
    public function set_user($user) {
        $this->user = $user;
    }

    public function get_user() {
        return $this->user;
    }
    
    public function set_numero($numero) {
        $this->numero = $numero;
    }

    public function get_numero() {
        return $this->numero;
    }
    
    public function set_complemento($complemento) {
        $this->complemento = $complemento;
    }

    public function get_complemento() {
        return $this->complemento;
    }
    
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }
    
    public function set_cnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function get_cnpj() {
        return $this->cnpj;
    }
    
    public function set_nome_unidade($nome_unidade) {
        $this->nome_unidade = $nome_unidade;
    }

    public function get_nome_unidade() {
        return $this->nome_unidade;
    }
    
    public function set_palavra_chave($palavra_chave) {
        $this->palavra_chave = $palavra_chave;
    }

    public function get_palavra_chave() {
        return $this->palavra_chave;
    }
    
    public function set_endereco($endereco) {
        $this->endereco = $endereco;
    }

    public function get_endereco() {
        return $this->endereco;
    }
    
    public function set_bairro($bairro) {
        $this->bairro = $bairro;
    }

    public function get_bairro() {
        return $this->bairro;
    }
    
    public function set_id_cidade($id_cidade) {
        $this->id_cidade = $id_cidade;
    }

    public function get_id_cidade() {
        return $this->id_cidade;
    }
    
    public function set_id_estado($id_estado) {
        $this->id_estado = $id_estado;
    }

    public function get_id_estado() {
        return $this->id_estado;
    }
    
    public function set_status($status) {
        $this->status = $status;
    }

    public function get_status() {
        return $this->status;
    }
    
    public function set_cep($cep) {
        $this->cep = $cep;
    }

    public function get_cep() {
        return $this->cep;
    }
    
    public function set_data_ultima_alteracao($data_ultima_alteracao) {
        $this->data_ultima_alteracao = $data_ultima_alteracao;
    }

    public function get_data_ultima_alteracao() {
        return $this->data_ultima_alteracao;
    }
}