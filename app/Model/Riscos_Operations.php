<?php

class Riscos_Operations extends Riscos {

    public function Dados_Riscos($nome_risco) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, risco from riscos where ativo = 1 and risco = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome_risco));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Dados_Exames($nome_exames) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, exame from exames where ativo = 1 and exame = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome_exames));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Quantos_Ativos_eu_peguei($bandeira, $depto, $cargo) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as contar from wal_funcionarios where periodo in ('2016a') and cod_cargo in (".$cargo.") and id_wal_flags = ? and cod_depto = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($bandeira, $depto));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $contar = $data['contar'];
        return $contar;
    }

    public function save_Riscos_por_Ativos_Walmart($id_Ativo, $id_risco, $obs_risco) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO wal_funcionarios_riscos(id_funcionario,id_risco,obs_risco,ativo,data_ultima_alteracao) VALUES(?,?,?,?,?)");
        $smtp->bindParam(1, $id_Ativo, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_risco, PDO::PARAM_INT);
        $smtp->bindParam(3, $obs_risco, PDO::PARAM_STR);
        $smtp->bindParam(4, $status, PDO::PARAM_INT);
        $smtp->bindParam(5, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function save_Exames_por_Ativos_Walmart($id_Ativo, $id_exame) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES(?,?,?,?)");
        $smtp->bindParam(1, $id_Ativo, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_exame, PDO::PARAM_INT);
        $smtp->bindParam(3, $status, PDO::PARAM_INT);
        $smtp->bindParam(4, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Exames_por_Ativos_Walmart($id, $id_Ativo, $id_exame, $trab_altura) {
        include_once '../config/database_mysql.php';
        if ($trab_altura == 1) {
            $ativo = 1;
        } else {
            $ativo = 0;
        }
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_funcionarios_exames SET id_funcionario = :id_funcionario, id_exame = :id_exame,                 
                ativo = :ativo, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_funcionario' => $id_Ativo,
            ':id_exame' => $id_exame,
            ':ativo' => $ativo,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function id_Altura($id_funcionario) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id from wal_funcionarios_exames where ativo = 1 and id_exame = 21 and id_funcionario = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_funcionario));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Marca_Riscos($estabelecimento, $cargo) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id as um_id_para_paramentro, cod_cargo
                from wal_funcionarios
                where cod_cargo = ? and cod_estabelecimento = ?
                limit 1";
        $q = $pdo->prepare($sql);
        $q->execute(array($cargo, $estabelecimento));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $id_para_parametro = $data['um_id_para_paramentro'];
        $sql1 = "select 
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 1) > 0,'1','0') as agente_fisico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 1 limit 1) as obs_agente_fisico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 2) > 0,'1','0') as agente_quimico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 2 limit 1) as obs_agente_quimico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 3) > 0,'1','0') as agente_biologico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 3 limit 1) as obs_agente_biologico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 4) > 0,'1','0') as agente_ergonomico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 4 limit 1) as obs_agente_ergonomico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 5) > 0,'1','0') as ausencia_de_risco,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 5 limit 1) as obs_ausencia_de_risco";
        $q1 = $pdo->prepare($sql1);
        $q1->execute(array($id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro));
        $data1 = $q1->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data1;
    }

    public function Marca_Exames($estabelecimento, $cargo) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id as um_id_para_paramentro, cod_cargo
                from wal_funcionarios
                where cod_cargo = ? and cod_estabelecimento = ?
                limit 1";
        $q = $pdo->prepare($sql);
        $q->execute(array($cargo, $estabelecimento));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $id_para_parametro = $data['um_id_para_paramentro'];
        $sql1 = "select
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 1) > 0,'1', '0') as exame_clinico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 2) > 0,'1', '0') as acido_metil_hipurico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 3) > 0,'1', '0') as hemograma,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 4) > 0,'1', '0') as acido_mandelico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 5) > 0,'1', '0') as vdrl,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 6) > 0,'1', '0') as reticulocitos,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 7) > 0,'1', '0') as parasitologico_fezes,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 8) > 0,'1', '0') as cultural_de_orofaringe,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 9) > 0,'1', '0') as coprocultura,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 10) > 0,'1', '0') as micologico_de_unha,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 11) > 0,'1', '0') as audiometria,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 12) > 0,'1', '0') as ecg,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 13) > 0,'1', '0') as acuidade_visual,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 14) > 0,'1', '0') as eeg,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 15) > 0,'1', '0') as plaquetas,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 16) > 0,'1', '0') as eritrograma,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 17) > 0,'1', '0') as acido_tt_muconico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 18) > 0,'1', '0') as glicemia_em_jejum,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 19) > 0,'1', '0') as acido_hipurico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 20) > 0,'1', '0') as avaliacao_psicossocial";
        $q1 = $pdo->prepare($sql1);
        $q1->execute(array($id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro
            , $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro
            , $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro, $id_para_parametro));
        $data1 = $q1->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data1;
    }

    public function Marca_Riscos_Unico($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql1 = "select 
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 1) > 0,'1', '0') as agente_fisico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 1 limit 1) as obs_agente_fisico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 2) > 0,'1', '0') as agente_quimico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 2 limit 1) as obs_agente_quimico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 3) > 0,'1', '0') as agente_biologico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 3 limit 1) as obs_agente_biologico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 4) > 0,'1', '0') as agente_ergonomico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 4 limit 1) as obs_agente_ergonomico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 5) > 0,'1', '0') as ausencia_de_risco,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = ? and id_risco = 5 limit 1) as obs_ausencia_de_risco";
        $q1 = $pdo->prepare($sql1);
        $q1->execute(array($id, $id, $id, $id, $id, $id, $id, $id, $id, $id));
        $data1 = $q1->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data1;
    }

    public function Marca_Exames_Unico($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql1 = "select
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 1) > 0,'1', '0') as exame_clinico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 2) > 0,'1', '0') as acido_metil_hipurico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 3) > 0,'1', '0') as hemograma,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 4) > 0,'1', '0') as acido_mandelico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 5) > 0,'1', '0') as vdrl,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 6) > 0,'1', '0') as reticulocitos,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 7) > 0,'1', '0') as parasitologico_fezes,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 8) > 0,'1', '0') as cultural_de_orofaringe,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 9) > 0,'1', '0') as coprocultura,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 10) > 0,'1', '0') as micologico_de_unha,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 11) > 0,'1', '0') as audiometria,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 12) > 0,'1', '0') as ecg,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 13) > 0,'1', '0') as acuidade_visual,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 14) > 0,'1', '0') as eeg,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 15) > 0,'1', '0') as plaquetas,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 16) > 0,'1', '0') as eritrograma,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 17) > 0,'1', '0') as acido_tt_muconico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 18) > 0,'1', '0') as glicemia_em_jejum,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 19) > 0,'1', '0') as acido_hipurico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 20) > 0,'1', '0') as avaliacao_psicossocial,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = ? and id_exame = 21) > 0,'1', '0') as trab_altura";
        $q1 = $pdo->prepare($sql1);
        $q1->execute(array($id, $id, $id, $id, $id, $id, $id, $id, $id, $id, $id, $id, $id, $id, $id, $id, $id, $id, $id, $id, $id));
        $data1 = $q1->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data1;
    }
}