<?php

class Wal_Ativos extends Walmart {

    public function Dados_Wal_Ativos($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select nome_funcionario, matricula, cpf, identidade from wal_funcionarios where matricula = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Dados_Wal_Ativos_id($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, nome_funcionario, matricula, cpf, id_medico, id_medico_coordenador, id_box, identidade, data_periodico, cod_depto, cod_cargo, cod_empresa, cod_estabelecimento, flg_periodico from wal_funcionarios where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Dados_Wal_cargo($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select cod_cargo, desc_cargo from wal_cargo where cod_cargo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Dados_Wal_cargo_2016($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select cod_cargo, desc_cargo from wal_cargo_2016 where cod_cargo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Dados_Wal_Empresa($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select desc_empresa from wal_empresa where cod_empresa = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Wal_Ativos_bandeira_editar_referencia($bandeira, $setor, $cargo) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select funfun.id as id_funcionario
                from wal_funcionarios funfun
                where funfun.periodo in ('2016a') and funfun.id_wal_flags = '$bandeira'
                and funfun.cod_depto = '$setor' and funfun.cod_cargo = '$cargo'
                and funfun.exame = 1 and funfun.risco = 1
                limit 1";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Dados_Wal_Loja($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select desc_estabelecimento from wal_estabelecimento where cod_estabelecimento = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Dados_Wal_Loja_2016($empresa,$estabelecimento) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select desc_estabelecimento from wal_estabelecimento_2016 where cod_empresa = ? and cod_estabelecimento = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($empresa,$estabelecimento));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Dados_Wal_depto($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select desc_depto as desc_depto, cod_depto from wal_departamento where cod_depto = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Contar_Wal_Ativos() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as contar from wal_funcionarios where periodo in ('2015')";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $contei = $data['contar'];
        return $contei;
    }

    public function Contar_Wal_Ativos_fizeram_periodicos() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as contar from wal_funcionarios where flg_periodico = 1 and erro = 0";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $contei = $data['contar'];
        return $contei;
    }

    public function Contar_Wal_Ativos_error() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as contar from wal_funcionarios where erro = 1";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $contei = $data['contar'];
        return $contei;
    }

    public function Contar_Riscos_Ajustados() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select                
                (select count(*) from wal_funcionarios where periodo in ('2015')) as total_geral,
                (select count(*) from wal_funcionarios where exame = 1 and risco = 1 and periodo in ('2015')) as total_geral_com_riscos";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $percent = 100;
        $total_geral = $data['total_geral'];
        $total_geral_com_riscos = $data['total_geral_com_riscos'];
        $contei = bcmul(bcdiv($total_geral_com_riscos, $total_geral, 8), $percent, 2);
        return $contei;
    }

    public function Dados_Wal_Ativos_autocomplete() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select concat(cod_empresa," - ",desc_estabelecimento) as help_friend from wal_estabelecimento order by cod_empresa, desc_estabelecimento asc";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function edit_funcao_depto($id, $cod_cargo, $cod_depto, $nome, $cod_empresa, $cod_estabelecimento, $flg_periodico, $id_box, $id_medico, $pcmso_coord) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $smtpup = $pdo->prepare("UPDATE wal_funcionarios SET nome_funcionario = :nome_funcionario,
            cod_empresa = :cod_empresa,
            cod_estabelecimento = :cod_estabelecimento,
            cod_cargo = :cod_cargo, 
            cod_depto = :cod_depto, 
            id_medico = :id_medico, 
            id_medico_coordenador = :id_medico_coordenador, 
            id_box = :id_box, 
            flg_periodico = :flg_periodico,data_ultima_alteracao = :data_ultima_alteracao 
            WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':nome_funcionario' => $nome,
            ':cod_empresa' => $cod_empresa,
            ':cod_estabelecimento' => $cod_estabelecimento,
            ':cod_cargo' => $cod_cargo,
            ':cod_depto' => $cod_depto,
            ':id_medico' => $id_medico,
            ':id_medico_coordenador' => $pcmso_coord,
            ':id_box' => $id_box,
            ':flg_periodico' => $flg_periodico,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function count_Dados_Wal_Ativos_existe($nome) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'select count(id) as "temos" from wal_funcionarios where periodo in ("2015") and cpf = ?';
        $q = $pdo->prepare($sql);
        $q->execute(array($nome));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $confirm = $data['temos'] > 0 ? TRUE : FALSE;
    }

    public function Dados_Wal_Ativos_existe($cpf) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'select a.flg_periodico,a.nome_funcionario, d.desc_empresa, c.desc_estabelecimento,a.cod_depto, a.cod_cargo,
                a.data_periodico, a.comp_ACIDO_METIL_HIPURICO, a.comp_HEMOGRAMA, a.comp_ACIDO_MANDELICO, a.comp_VDRL, a.comp_RETICULOCITOS, a.comp_PARASITOLOGICO_FEZES, a.comp_CULTURAL_DE_OROFARINGE,
                a.comp_COPROCULTURA, a.comp_MICOLOGICO_DE_UNHA, a.comp_AUDIOMETRIA, a.comp_ECG, a.comp_ACUIDADE_VISUAL, a.comp_EEG, a.comp_PLAQUETAS, a.comp_ERITROGRAMA, a.comp_ACIDO_TT_MUCONICO,
                a.comp_GLICEMIA_EM_JEJUM, a.comp_ACIDO_HIPURICO, a.comp_AVALIACAO_PSICOSSOCIAL
                from wal_funcionarios a inner join wal_estabelecimento c on a.cod_estabelecimento = c.cod_estabelecimento                 
                inner join wal_empresa d on a.cod_empresa = d.cod_empresa where a.periodo in ("2015") and a.cpf = ? limit 1';
        $q = $pdo->prepare($sql);
        $q->execute(array($cpf));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $sql_setor = "select desc_depto from wal_departamento where cod_depto in (" . $data['cod_depto'] . ")";
        $qqq = $pdo->prepare($sql_setor);
        $qqq->execute();
        $data_setor = $qqq->fetch(PDO::FETCH_ASSOC);
        $sql_cargo = "select desc_cargo from wal_cargo where cod_cargo in ('" . $data['cod_cargo'] . "')";
        $qqqq = $pdo->prepare($sql_cargo);
        $qqqq->execute();
        $data_cargo = $qqqq->fetch(PDO::FETCH_ASSOC);
        $dados = array('nome_funcionario' => $data['nome_funcionario'], 'desc_empresa' => $data['desc_empresa'], 
            'desc_estabelecimento' => $data['desc_estabelecimento'], 'desc_cargo' => $data_cargo['desc_cargo'],             
            'data_periodico' => $data['data_periodico'], 'comp_ACIDO_METIL_HIPURICO' => $data['comp_ACIDO_METIL_HIPURICO'], 
            'comp_HEMOGRAMA' => $data['comp_HEMOGRAMA'], 'comp_ACIDO_MANDELICO' => $data['comp_ACIDO_MANDELICO'], 
            'comp_VDRL' => $data['comp_VDRL'], 'comp_RETICULOCITOS' => $data['comp_RETICULOCITOS'], 
            'comp_PARASITOLOGICO_FEZES' => $data['comp_PARASITOLOGICO_FEZES'], 'comp_CULTURAL_DE_OROFARINGE' => $data['comp_CULTURAL_DE_OROFARINGE'], 
            'comp_COPROCULTURA' => $data['comp_COPROCULTURA'], 'comp_MICOLOGICO_DE_UNHA' => $data['comp_MICOLOGICO_DE_UNHA'], 
            'comp_AUDIOMETRIA' => $data['comp_AUDIOMETRIA'], 'comp_ECG' => $data['comp_ECG'], 
            'comp_ACUIDADE_VISUAL' => $data['comp_ACUIDADE_VISUAL'], 'comp_EEG' => $data['comp_EEG'], 
            'comp_PLAQUETAS' => $data['comp_PLAQUETAS'], 'comp_ERITROGRAMA' => $data['comp_ERITROGRAMA'], 
            'comp_ACIDO_TT_MUCONICO' => $data['comp_ACIDO_TT_MUCONICO'], 'comp_GLICEMIA_EM_JEJUM' => $data['comp_GLICEMIA_EM_JEJUM'], 
            'comp_ACIDO_HIPURICO' => $data['comp_ACIDO_HIPURICO'], 'comp_AVALIACAO_PSICOSSOCIAL' => $data['comp_AVALIACAO_PSICOSSOCIAL'],             
            'desc_depto' => $data_setor['desc_depto'], 'flg_periodico' => $data['flg_periodico']);
        Database::disconnect();
        return $dados;
    }
    
    public function Dados_Wal_Ativos_existe2016($cpf) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'select a.flg_periodico,a.nome_funcionario, d.desc_empresa, c.desc_estabelecimento,a.cod_depto, a.cod_cargo,
                a.data_periodico, a.comp_ACIDO_METIL_HIPURICO, a.comp_HEMOGRAMA, a.comp_ACIDO_MANDELICO, a.comp_VDRL, a.comp_RETICULOCITOS, a.comp_PARASITOLOGICO_FEZES, a.comp_CULTURAL_DE_OROFARINGE,
                a.comp_COPROCULTURA, a.comp_MICOLOGICO_DE_UNHA, a.comp_AUDIOMETRIA, a.comp_ECG, a.comp_ACUIDADE_VISUAL, a.comp_EEG, a.comp_PLAQUETAS, a.comp_ERITROGRAMA, a.comp_ACIDO_TT_MUCONICO,
                a.comp_GLICEMIA_EM_JEJUM, a.comp_ACIDO_HIPURICO, a.comp_AVALIACAO_PSICOSSOCIAL
                from wal_funcionarios a inner join wal_estabelecimento c on a.cod_estabelecimento = c.cod_estabelecimento                 
                inner join wal_empresa d on a.cod_empresa = d.cod_empresa where a.periodo in ("2015") and a.cpf = ? limit 1';
        $q = $pdo->prepare($sql);
        $q->execute(array($cpf));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $sql_setor = "select desc_depto from wal_departamento where cod_depto in (" . $data['cod_depto'] . ")";
        $qqq = $pdo->prepare($sql_setor);
        $qqq->execute();
        $data_setor = $qqq->fetch(PDO::FETCH_ASSOC);
        $sql_cargo = "select desc_cargo from wal_cargo where cod_cargo in ('" . $data['cod_cargo'] . "')";
        $qqqq = $pdo->prepare($sql_cargo);
        $qqqq->execute();
        $data_cargo = $qqqq->fetch(PDO::FETCH_ASSOC);
        $dados = array('nome_funcionario' => $data['nome_funcionario'], 'desc_empresa' => $data['desc_empresa'], 
            'desc_estabelecimento' => $data['desc_estabelecimento'], 'desc_cargo' => $data_cargo['desc_cargo'],             
            'data_periodico' => $data['data_periodico'], 'comp_ACIDO_METIL_HIPURICO' => $data['comp_ACIDO_METIL_HIPURICO'], 
            'comp_HEMOGRAMA' => $data['comp_HEMOGRAMA'], 'comp_ACIDO_MANDELICO' => $data['comp_ACIDO_MANDELICO'], 
            'comp_VDRL' => $data['comp_VDRL'], 'comp_RETICULOCITOS' => $data['comp_RETICULOCITOS'], 
            'comp_PARASITOLOGICO_FEZES' => $data['comp_PARASITOLOGICO_FEZES'], 'comp_CULTURAL_DE_OROFARINGE' => $data['comp_CULTURAL_DE_OROFARINGE'], 
            'comp_COPROCULTURA' => $data['comp_COPROCULTURA'], 'comp_MICOLOGICO_DE_UNHA' => $data['comp_MICOLOGICO_DE_UNHA'], 
            'comp_AUDIOMETRIA' => $data['comp_AUDIOMETRIA'], 'comp_ECG' => $data['comp_ECG'], 
            'comp_ACUIDADE_VISUAL' => $data['comp_ACUIDADE_VISUAL'], 'comp_EEG' => $data['comp_EEG'], 
            'comp_PLAQUETAS' => $data['comp_PLAQUETAS'], 'comp_ERITROGRAMA' => $data['comp_ERITROGRAMA'], 
            'comp_ACIDO_TT_MUCONICO' => $data['comp_ACIDO_TT_MUCONICO'], 'comp_GLICEMIA_EM_JEJUM' => $data['comp_GLICEMIA_EM_JEJUM'], 
            'comp_ACIDO_HIPURICO' => $data['comp_ACIDO_HIPURICO'], 'comp_AVALIACAO_PSICOSSOCIAL' => $data['comp_AVALIACAO_PSICOSSOCIAL'],             
            'desc_depto' => $data_setor['desc_depto'], 'flg_periodico' => $data['flg_periodico']);
        Database::disconnect();
        return $dados;
    }

    public function Dados_Wal_Ativos_riscos_2016($id_func_band) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select 
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario in ($id_func_band) and id_risco = 1) > 0,'1', '0') as agente_fisico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario in ($id_func_band) and id_risco = 1 limit 1) as obs_agente_fisico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario in ($id_func_band) and id_risco = 2) > 0,'1', '0') as agente_quimico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario in ($id_func_band) and id_risco = 2 limit 1) as obs_agente_quimico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario in ($id_func_band) and id_risco = 3) > 0,'1', '0') as agente_biologico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario in ($id_func_band) and id_risco = 3 limit 1) as obs_agente_biologico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario in ($id_func_band) and id_risco = 4) > 0,'1', '0') as agente_ergonomico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario in ($id_func_band) and id_risco = 4 limit 1) as obs_agente_ergonomico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario in ($id_func_band) and id_risco = 5) > 0,'1', '0') as ausencia_de_risco,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario in ($id_func_band) and id_risco = 5 limit 1) as obs_ausencia_de_risco,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario in ($id_func_band) and id_risco = 6) > 0,'1', '0') as outros,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario in ($id_func_band) and id_risco = 6 limit 1) as obs_outros,    
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 1 and ativo = 1) > 0,'1', '0') as exame_clinico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 2 and ativo = 1) > 0,'1', '0') as acido_metil_hipurico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 3 and ativo = 1) > 0,'1', '0') as hemograma,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 4 and ativo = 1) > 0,'1', '0') as acido_mandelico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 5 and ativo = 1) > 0,'1', '0') as vdrl,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 6 and ativo = 1) > 0,'1', '0') as reticulocitos,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 7 and ativo = 1) > 0,'1', '0') as parasitologico_fezes,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 8 and ativo = 1) > 0,'1', '0') as cultural_de_orofaringe,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 9 and ativo = 1) > 0,'1', '0') as coprocultura,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 10 and ativo = 1) > 0,'1', '0') as micologico_de_unha,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 11 and ativo = 1) > 0,'1', '0') as audiometria,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 12 and ativo = 1) > 0,'1', '0') as ecg,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 13 and ativo = 1) > 0,'1', '0') as acuidade_visual,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 14 and ativo = 1) > 0,'1', '0') as eeg,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 15 and ativo = 1) > 0,'1', '0') as plaquetas,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 16 and ativo = 1) > 0,'1', '0') as eritrograma,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 17 and ativo = 1) > 0,'1', '0') as acido_tt_muconico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 18 and ativo = 1) > 0,'1', '0') as glicemia_em_jejum,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 19 and ativo = 1) > 0,'1', '0') as acido_hipurico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 20 and ativo = 1) > 0,'1', '0') as avaliacao_psicossocial,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 21 and ativo = 1) > 0,'1', '0') as trab_altura,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 22 and ativo = 1) > 0,'1', '0') as anti_hbs,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 23 and ativo = 1) > 0,'1', '0') as hbs_ag,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario in ($id_func_band) and id_exame = 24 and ativo = 1) > 0,'1', '0') as anti_hbc";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}