<?php

class Medico {

    private $id_medico;
    private $nome;
    private $crm;
    private $id_funcao;
    private $cod_sig;
    private $ddd_telefone;
    private $telefone;
    private $status;
    private $data_ultima_alteracao;
    private $funcao;    
    private $id_medico_valores;
    private $id_evento_convocacao;
    private $id;
    private $turnos;
    private $id_convocacao;
    private $valor;
    private $data_fechamento_valores;    
    private $cpf;
    private $rg;
    private $data_nascimento;
    private $conselho;
    private $cnes;    
    private $id_banco;
    private $agencia;
    private $contacorrente;
    private $id_cc;    
    private $data_cadastro;
    private $id_tipo_prestador;
    private $razao_social;
    private $cnpj;
    private $endereco;
    private $numero;
    private $complemento;
    private $id_estado_UF;
    private $id_cidade;
    private $bairro;
    private $cep;
    private $ddd_comercial;
    private $telefone_comercial;
    private $id_prestador;    
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
    private $consulta;
    private $obs;
    private $valor_consulta;
    private $email;
    private $hemograma_com_plaquetas;
    private $antibiograma;
    private $valor_consulta_2;
    private $valor_consulta_3;
    private $data_acerto_2;
    private $data_acerto_3;    
    private $data_prospeccao;
    private $historico_prospeccao;
    private $lojas_negociadas;
    private $cargo;
    
    public function set_cargo($cargo) {
        $this->cargo = $cargo;
    }

    public function get_cargo() {
        return $this->cargo;
    }
    
    public function set_data_prospeccao($data_prospeccao) {
        $this->data_prospeccao = $data_prospeccao;
    }

    public function get_data_prospeccao() {
        return $this->data_prospeccao;
    }
    
    public function set_historico_prospeccao($historico_prospeccao) {
        $this->historico_prospeccao = $historico_prospeccao;
    }

    public function get_historico_prospeccao() {
        return $this->historico_prospeccao;
    }
    
    public function set_lojas_negociadas($lojas_negociadas) {
        $this->lojas_negociadas = $lojas_negociadas;
    }

    public function get_lojas_negociadas() {
        return $this->lojas_negociadas;
    }
    
    public function set_valor_consulta_2($valor_consulta_2) {
        $this->valor_consulta_2 = $valor_consulta_2;
    }

    public function get_valor_consulta_2() {
        return $this->valor_consulta_2;
    }
    
    public function set_valor_consulta_3($valor_consulta_3) {
        $this->valor_consulta_3 = $valor_consulta_3;
    }

    public function get_valor_consulta_3() {
        return $this->valor_consulta_3;
    }
    
    public function set_data_acerto_2($data_acerto_2) {
        $this->data_acerto_2 = $data_acerto_2;
    }

    public function get_data_acerto_2() {
        return $this->data_acerto_2;
    }
    
    public function set_data_acerto_3($data_acerto_3) {
        $this->data_acerto_3 = $data_acerto_3;
    }

    public function get_data_acerto_3() {
        return $this->data_acerto_3;
    }
    
    public function set_hemograma_com_plaquetas($hemograma_com_plaquetas) {
        $this->hemograma_com_plaquetas = $hemograma_com_plaquetas;
    }

    public function get_hemograma_com_plaquetas() {
        return $this->hemograma_com_plaquetas;
    }
    
    public function set_antibiograma($antibiograma) {
        $this->antibiograma = $antibiograma;
    }

    public function get_antibiograma() {
        return $this->antibiograma;
    }
    
    public function set_email($email) {
        $this->email = $email;
    }

    public function get_email() {
        return $this->email;
    }
    
    public function set_valor_consulta($valor_consulta) {
        $this->valor_consulta = $valor_consulta;
    }

    public function get_valor_consulta() {
        return $this->valor_consulta;
    }
    
    public function set_consulta($consulta) {
        $this->consulta = $consulta;
    }

    public function get_consulta() {
        return $this->consulta;
    }
    
    public function set_obs($obs) {
        $this->obs = $obs;
    }

    public function get_obs() {
        return $this->obs;
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
    
    public function set_id_prestador($id_prestador) {
        $this->id_prestador = $id_prestador;
    }

    public function get_id_prestador() {
        return $this->id_prestador;
    }
    
    public function set_data_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    public function get_data_cadastro() {
        return $this->data_cadastro;
    }
    
    public function set_id_tipo_prestador($id_tipo_prestador) {
        $this->id_tipo_prestador = $id_tipo_prestador;
    }

    public function get_id_tipo_prestador() {
        return $this->id_tipo_prestador;
    }
    
    public function set_razao_social($razao_social) {
        $this->razao_social = $razao_social;
    }

    public function get_razao_social() {
        return $this->razao_social;
    }
    
    public function set_cnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function get_cnpj() {
        return $this->cnpj;
    }
    
    public function set_endereco($endereco) {
        $this->endereco = $endereco;
    }

    public function get_endereco() {
        return $this->endereco;
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
    
    public function set_id_estado_UF($id_estado_UF) {
        $this->id_estado_UF = $id_estado_UF;
    }

    public function get_id_estado_UF() {
        return $this->id_estado_UF;
    }
    
    public function set_id_cidade($id_cidade) {
        $this->id_cidade = $id_cidade;
    }

    public function get_id_cidade() {
        return $this->id_cidade;
    }
    
    public function set_bairro($bairro) {
        $this->bairro = $bairro;
    }

    public function get_bairro() {
        return $this->bairro;
    }
    
    public function set_cep($cep) {
        $this->cep = $cep;
    }

    public function get_cep() {
        return $this->cep;
    }
    
    public function set_ddd_comercial($ddd_comercial) {
        $this->ddd_comercial = $ddd_comercial;
    }

    public function get_ddd_comercial() {
        return $this->ddd_comercial;
    }
    
    public function set_telefone_comercial($telefone_comercial) {
        $this->telefone_comercial = $telefone_comercial;
    }

    public function get_telefone_comercial() {
        return $this->telefone_comercial;
    }    
    
    public function set_id_cc($id_cc) {
        $this->id_cc = $id_cc;
    }

    public function get_id_cc() {
        return $this->id_cc;
    }
    
    public function set_id_banco($id_banco) {
        $this->id_banco = $id_banco;
    }

    public function get_id_banco() {
        return $this->id_banco;
    }
    
    public function set_agencia($agencia) {
        $this->agencia = $agencia;
    }

    public function get_agencia() {
        return $this->agencia;
    }
    
    public function set_contacorrente($contacorrente) {
        $this->contacorrente = $contacorrente;
    }

    public function get_contacorrente() {
        return $this->contacorrente;
    }
    
    public function set_cpf($cpf) {
        $this->cpf = $cpf;
    }

    public function get_cpf() {
        return $this->cpf;
    }
    
    public function set_rg($rg) {
        $this->rg = $rg;
    }

    public function get_rg() {
        return $this->rg;
    }
    
    public function set_data_nascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    public function get_data_nascimento() {
        return $this->data_nascimento;
    }
    
    public function set_conselho($conselho) {
        $this->conselho = $conselho;
    }

    public function get_conselho() {
        return $this->conselho;
    }
    
    public function set_cnes($cnes) {
        $this->cnes = $cnes;
    }

    public function get_cnes() {
        return $this->cnes;
    }
    
    public function set_id_convocacao($id_convocacao) {
        $this->id_convocacao = $id_convocacao;
    }

    public function get_id_convocacao() {
        return $this->id_convocacao;
    }
    
    public function set_turnos($turnos) {
        $this->turnos = $turnos;
    }

    public function get_turnos() {
        return $this->turnos;
    }
    
    public function set_valor($valor) {
        $this->valor = $valor;
    }

    public function get_valor() {
        return $this->valor;
    }
    
    public function set_data_fechamento_valores($data_fechamento_valores) {
        $this->data_fechamento_valores = $data_fechamento_valores;
    }

    public function get_data_fechamento_valores() {
        return $this->data_fechamento_valores;
    }
    
    public function set_id_medico_valores($id_medico_valores) {
        $this->id_medico_valores = $id_medico_valores;
    }

    public function get_id_medico_valores() {
        return $this->id_medico_valores;
    }
    
    public function set_id_evento_convocacao($id_evento_convocacao) {
        $this->id_evento_convocacao = $id_evento_convocacao;
    }

    public function get_id_evento_convocacao() {
        return $this->id_evento_convocacao;
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
    
    public function set_nome($nome) {
        $this->nome = $nome;
    }

    public function get_nome() {
        return $this->nome;
    }
    
    public function set_crm($crm) {
        $this->crm = $crm;
    }

    public function get_crm() {
        return $this->crm;
    }
    
    public function set_id_funcao($id_funcao) {
        $this->id_funcao = $id_funcao;
    }

    public function get_id_funcao() {
        return $this->id_funcao;
    }
    
    public function set_cod_sig($cod_sig) {
        $this->cod_sig = $cod_sig;
    }

    public function get_cod_sig() {
        return $this->cod_sig;
    }
    
    public function set_ddd_telefone($ddd_telefone) {
        $this->ddd_telefone = $ddd_telefone;
    }

    public function get_ddd_telefone() {
        return $this->ddd_telefone;
    }
    
    public function set_telefone($telefone) {
        $this->telefone = $telefone;
    }

    public function get_telefone() {
        return $this->telefone;
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
    
    public function set_funcao($funcao) {
        $this->funcao = $funcao;
    }

    public function get_funcao() {
        return $this->funcao;
    }
}