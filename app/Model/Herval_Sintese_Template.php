<?php

class Herval_Sintese_Template extends Herval {

    public function save_Herval_sint_template($id_tipo_unidade, $id_herval_setor, $id_herval_funcao, $agente_fisico, $obs_agente_fisico, $agente_quimico, $obs_agente_quimico, $agente_biologico, $obs_agente_biologico, $agente_ergonomico
    , $obs_agente_ergonomico, $ausencia_de_risco, $obs_ausencia_de_risco, $exame_clinico, $acido_metil_hipurico, $hemograma, $acido_mandelico, $vdrl
    , $reticulocitos, $parasitologico_fezes, $cultural_de_orofaringe, $coprocultura, $micologico_de_unha, $audiometria, $ecg, $acuidade_visual, $eeg
    , $plaquetas, $eritograma, $acido_tt_muconico, $glicemia_em_jejum, $avaliacao_psicossocial, $acido_hipurico, $obs_1, $obs_2, $obs_3, $obs_4, $obs_5, $obs_6, $obs_7, $obs_8, $obs_9, $obs_10) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO herval_sintese_template(id_tipo_unidade,id_herval_setor,id_herval_funcao,agente_fisico,obs_agente_fisico,
                agente_quimico,obs_agente_quimico,agente_biologico,obs_agente_biologico,agente_ergonomico,obs_agente_ergonomico,
                ausencia_de_risco,obs_ausencia_de_risco,exame_clinico,acido_metil_hipurico,hemograma,acido_mandelico,vdrl,
                reticulocitos,parasitologico_fezes,cultural_de_orofaringe,coprocultura,micologico_de_unha,audiometria,ecg,
                acuidade_visual,eeg,plaquetas,eritrograma,acido_tt_muconico,glicemia_em_jejum,avaliacao_psicossocial,
                acido_hipurico,obs_1,obs_2,obs_3,obs_4,obs_5,obs_6,obs_7,obs_8,obs_9,obs_10,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_tipo_unidade, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_herval_setor, PDO::PARAM_INT);
        $smtp->bindParam(3, $id_herval_funcao, PDO::PARAM_INT);
        $smtp->bindParam(4, $agente_fisico, PDO::PARAM_INT);
        $smtp->bindParam(5, $obs_agente_fisico, PDO::PARAM_STR);
        $smtp->bindParam(6, $agente_quimico, PDO::PARAM_INT);
        $smtp->bindParam(7, $obs_agente_quimico, PDO::PARAM_STR);
        $smtp->bindParam(8, $agente_biologico, PDO::PARAM_INT);
        $smtp->bindParam(9, $obs_agente_biologico, PDO::PARAM_STR);
        $smtp->bindParam(10, $agente_ergonomico, PDO::PARAM_INT);
        $smtp->bindParam(11, $obs_agente_ergonomico, PDO::PARAM_STR);
        $smtp->bindParam(12, $ausencia_de_risco, PDO::PARAM_INT);
        $smtp->bindParam(13, $obs_ausencia_de_risco, PDO::PARAM_STR);
        $smtp->bindParam(14, $exame_clinico, PDO::PARAM_INT);
        $smtp->bindParam(15, $acido_metil_hipurico, PDO::PARAM_INT);
        $smtp->bindParam(16, $hemograma, PDO::PARAM_INT);
        $smtp->bindParam(17, $acido_mandelico, PDO::PARAM_INT);
        $smtp->bindParam(18, $vdrl, PDO::PARAM_INT);
        $smtp->bindParam(19, $reticulocitos, PDO::PARAM_INT);
        $smtp->bindParam(20, $parasitologico_fezes, PDO::PARAM_INT);
        $smtp->bindParam(21, $cultural_de_orofaringe, PDO::PARAM_INT);
        $smtp->bindParam(22, $coprocultura, PDO::PARAM_INT);
        $smtp->bindParam(23, $micologico_de_unha, PDO::PARAM_INT);
        $smtp->bindParam(24, $audiometria, PDO::PARAM_INT);
        $smtp->bindParam(25, $ecg, PDO::PARAM_INT);
        $smtp->bindParam(26, $acuidade_visual, PDO::PARAM_INT);
        $smtp->bindParam(27, $eeg, PDO::PARAM_INT);
        $smtp->bindParam(28, $plaquetas, PDO::PARAM_INT);
        $smtp->bindParam(29, $eritograma, PDO::PARAM_INT);
        $smtp->bindParam(30, $acido_tt_muconico, PDO::PARAM_INT);
        $smtp->bindParam(31, $glicemia_em_jejum, PDO::PARAM_INT);
        $smtp->bindParam(32, $avaliacao_psicossocial, PDO::PARAM_INT);
        $smtp->bindParam(33, $acido_hipurico, PDO::PARAM_INT);
        $smtp->bindParam(34, $obs_1, PDO::PARAM_INT);
        $smtp->bindParam(35, $obs_2, PDO::PARAM_INT);
        $smtp->bindParam(36, $obs_3, PDO::PARAM_INT);
        $smtp->bindParam(37, $obs_4, PDO::PARAM_INT);
        $smtp->bindParam(38, $obs_5, PDO::PARAM_INT);
        $smtp->bindParam(39, $obs_6, PDO::PARAM_INT);
        $smtp->bindParam(40, $obs_7, PDO::PARAM_INT);
        $smtp->bindParam(41, $obs_8, PDO::PARAM_INT);
        $smtp->bindParam(42, $obs_9, PDO::PARAM_INT);
        $smtp->bindParam(43, $obs_10, PDO::PARAM_INT);
        $smtp->bindParam(44, $status, PDO::PARAM_INT);
        $smtp->bindParam(45, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Herval_sint_template($id, $id_tipo_unidade, $id_herval_setor, $id_herval_funcao, $agente_fisico, $obs_agente_fisico, $agente_quimico, $obs_agente_quimico, $agente_biologico, $obs_agente_biologico, $agente_ergonomico
    , $obs_agente_ergonomico, $ausencia_de_risco, $obs_ausencia_de_risco, $exame_clinico, $acido_metil_hipurico, $hemograma, $acido_mandelico, $vdrl
    , $reticulocitos, $parasitologico_fezes, $cultural_de_orofaringe, $coprocultura, $micologico_de_unha, $audiometria, $ecg, $acuidade_visual, $eeg
    , $plaquetas, $eritograma, $acido_tt_muconico, $glicemia_em_jejum, $avaliacao_psicossocial, $acido_hipurico, $obs_1, $obs_2, $obs_3, $obs_4, $obs_5, $obs_6, $obs_7, $obs_8, $obs_9, $obs_10) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE herval_sintese_template SET id_tipo_unidade = :id_tipo_unidade,id_herval_setor = :id_herval_setor,id_herval_funcao = :id_herval_funcao,agente_fisico = :agente_fisico,obs_agente_fisico = :obs_agente_fisico,
                agente_quimico = :agente_quimico,obs_agente_quimico = :obs_agente_quimico,agente_biologico = :agente_biologico,obs_agente_biologico = :obs_agente_biologico,agente_ergonomico = :agente_ergonomico,obs_agente_ergonomico = :obs_agente_ergonomico,
                ausencia_de_risco = :ausencia_de_risco,obs_ausencia_de_risco = :obs_ausencia_de_risco,exame_clinico = :exame_clinico,acido_metil_hipurico = :acido_metil_hipurico,hemograma = :hemograma,acido_mandelico = :acido_mandelico,vdrl = :vdrl,
                reticulocitos = :reticulocitos,parasitologico_fezes = :parasitologico_fezes,cultural_de_orofaringe = :cultural_de_orofaringe,coprocultura = :coprocultura,micologico_de_unha = :micologico_de_unha,audiometria = :audiometria,ecg = :ecg,
                acuidade_visual = :acuidade_visual,eeg = :eeg,plaquetas = :plaquetas,eritrograma = :eritrograma,acido_tt_muconico = :acido_tt_muconico,glicemia_em_jejum = :glicemia_em_jejum,avaliacao_psicossocial = :avaliacao_psicossocial,
                acido_hipurico = :acido_hipurico,obs_1 = :obs_1,obs_2 = :obs_2,obs_3 = :obs_3,obs_4 = :obs_4,obs_5 = :obs_5,obs_6 = :obs_6,obs_7 = :obs_7,obs_8 = :obs_8,obs_9 = :obs_9,obs_10 = :obs_10,status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_tipo_unidade' => $id_tipo_unidade,
            ':id_herval_setor' => $id_herval_setor,
            ':id_herval_funcao' => $id_herval_funcao,
            ':agente_fisico' => $agente_fisico,
            ':obs_agente_fisico' => $obs_agente_fisico,
            ':agente_quimico' => $agente_quimico,
            ':obs_agente_quimico' => $obs_agente_quimico,
            ':agente_biologico' => $agente_biologico,
            ':obs_agente_biologico' => $obs_agente_biologico,
            ':agente_ergonomico' => $agente_ergonomico,
            ':obs_agente_ergonomico' => $obs_agente_ergonomico,
            ':ausencia_de_risco' => $ausencia_de_risco,
            ':obs_ausencia_de_risco' => $obs_ausencia_de_risco,
            ':exame_clinico' => $exame_clinico,
            ':acido_metil_hipurico' => $acido_metil_hipurico,
            ':hemograma' => $hemograma,
            ':acido_mandelico' => $acido_mandelico,
            ':vdrl' => $vdrl,
            ':reticulocitos' => $reticulocitos,
            ':parasitologico_fezes' => $parasitologico_fezes,
            ':cultural_de_orofaringe' => $cultural_de_orofaringe,
            ':coprocultura' => $coprocultura,
            ':micologico_de_unha' => $micologico_de_unha,
            ':audiometria' => $audiometria,
            ':ecg' => $ecg,
            ':acuidade_visual' => $acuidade_visual,
            ':eeg' => $eeg,
            ':plaquetas' => $plaquetas,
            ':eritrograma' => $eritograma,
            ':acido_tt_muconico' => $acido_tt_muconico,
            ':glicemia_em_jejum' => $glicemia_em_jejum,
            ':avaliacao_psicossocial' => $avaliacao_psicossocial,
            ':acido_hipurico' => $acido_hipurico,
            ':obs_1' => $obs_1,
            ':obs_2' => $obs_2,
            ':obs_3' => $obs_3,
            ':obs_4' => $obs_4,
            ':obs_5' => $obs_5,
            ':obs_6' => $obs_6,
            ':obs_7' => $obs_7,
            ':obs_8' => $obs_8,
            ':obs_9' => $obs_9,
            ':obs_10' => $obs_10,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Herval_sint_template($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE herval_sintese_template SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_Herval_sint_templates($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_tipo_unidade,id_herval_setor,id_herval_funcao,agente_fisico,obs_agente_fisico,
                agente_quimico,obs_agente_quimico,agente_biologico,obs_agente_biologico,agente_ergonomico,obs_agente_ergonomico,
                ausencia_de_risco,obs_ausencia_de_risco,exame_clinico,acido_metil_hipurico,hemograma,acido_mandelico,vdrl,
                reticulocitos,parasitologico_fezes,cultural_de_orofaringe,coprocultura,micologico_de_unha,audiometria,ecg,
                acuidade_visual,eeg,plaquetas,eritrograma,acido_tt_muconico,glicemia_em_jejum,avaliacao_psicossocial,
                acido_hipurico,obs_1,obs_2,obs_3,obs_4,obs_5,obs_6,obs_7,obs_8,obs_9,obs_10,status,data_ultima_alteracao from herval_sintese_template where id_tipo_unidade = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}