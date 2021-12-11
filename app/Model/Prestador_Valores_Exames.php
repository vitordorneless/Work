<?php

class Prestador_Valores_Exames extends Medico {

    public function save_Prestador_Valores_Exames($cnpj, $exame_clinico, $acido_metil_hipurico, $hemograma, $acido_mandelico, $vdrl, $reticulocitos, $parasitologico_fezes, $cultural_de_orofaringe, $coprocultura, $micologico_de_unha, $audiometria, $ecg, $acuidade_visual, $eeg, $plaquetas, $eritrograma, $acido_tt_muconico, $glicemia_em_jejum, $acido_hipurico, $hemograma_com_plaquetas, $antibiograma) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO prestador_valores_exames(cnpj,exame_clinico,acido_metil_hipurico,hemograma,
            acido_mandelico,vdrl,reticulocitos,parasitologico_fezes,cultural_de_orofaringe,coprocultura,micologico_de_unha,audiometria,
            ecg,acuidade_visual,eeg,plaquetas,eritrograma,acido_tt_muconico,glicemia_em_jejum,acido_hipurico,hemograma_com_plaquetas,antibiograma,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $cnpj, PDO::PARAM_STR);
        $smtp->bindParam(2, $exame_clinico, PDO::PARAM_STR);
        $smtp->bindParam(3, $acido_metil_hipurico, PDO::PARAM_STR);
        $smtp->bindParam(4, $hemograma, PDO::PARAM_STR);
        $smtp->bindParam(5, $acido_mandelico, PDO::PARAM_STR);
        $smtp->bindParam(6, $vdrl, PDO::PARAM_STR);
        $smtp->bindParam(7, $reticulocitos, PDO::PARAM_STR);
        $smtp->bindParam(8, $parasitologico_fezes, PDO::PARAM_STR);
        $smtp->bindParam(9, $cultural_de_orofaringe, PDO::PARAM_STR);
        $smtp->bindParam(10, $coprocultura, PDO::PARAM_STR);
        $smtp->bindParam(11, $micologico_de_unha, PDO::PARAM_STR);
        $smtp->bindParam(12, $audiometria, PDO::PARAM_STR);
        $smtp->bindParam(13, $ecg, PDO::PARAM_STR);
        $smtp->bindParam(14, $acuidade_visual, PDO::PARAM_STR);
        $smtp->bindParam(15, $eeg, PDO::PARAM_STR);
        $smtp->bindParam(16, $plaquetas, PDO::PARAM_STR);
        $smtp->bindParam(17, $eritrograma, PDO::PARAM_STR);
        $smtp->bindParam(18, $acido_tt_muconico, PDO::PARAM_STR);
        $smtp->bindParam(19, $glicemia_em_jejum, PDO::PARAM_STR);
        $smtp->bindParam(20, $acido_hipurico, PDO::PARAM_STR);
        $smtp->bindParam(21, $hemograma_com_plaquetas, PDO::PARAM_STR);
        $smtp->bindParam(22, $antibiograma, PDO::PARAM_STR);
        $smtp->bindParam(23, $status, PDO::PARAM_INT);
        $smtp->bindParam(24, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Prestador_Valores_Exames($id, $cnpj, $exame_clinico, $acido_metil_hipurico, $hemograma, $acido_mandelico, $vdrl, $reticulocitos, $parasitologico_fezes, $cultural_de_orofaringe, $coprocultura, $micologico_de_unha, $audiometria, $ecg, $acuidade_visual, $eeg, $plaquetas, $eritrograma, $acido_tt_muconico, $glicemia_em_jejum, $acido_hipurico, $hemograma_com_plaquetas, $antibiograma, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE prestador_valores_exames SET cnpj = :cnpj, exame_clinico = :exame_clinico,acido_metil_hipurico = :acido_metil_hipurico,hemograma = :hemograma,
                acido_mandelico = :acido_mandelico,vdrl = :vdrl,reticulocitos = :reticulocitos,parasitologico_fezes = :parasitologico_fezes,cultural_de_orofaringe = :cultural_de_orofaringe,
                coprocultura = :coprocultura,micologico_de_unha = :micologico_de_unha,audiometria = :audiometria,ecg = :ecg,acuidade_visual = :acuidade_visual,eeg = :eeg,plaquetas = :plaquetas,
                eritrograma = :eritrograma,acido_tt_muconico = :acido_tt_muconico,glicemia_em_jejum = :glicemia_em_jejum,acido_hipurico = :acido_hipurico,
                hemograma_com_plaquetas = :hemograma_com_plaquetas, antibiograma = :antibiograma, status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(            
            ':id' => $id,
            ':cnpj' => $cnpj,
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
            ':eritrograma' => $eritrograma,
            ':acido_tt_muconico' => $acido_tt_muconico,
            ':glicemia_em_jejum' => $glicemia_em_jejum,
            ':acido_hipurico' => $acido_hipurico,
            ':hemograma_com_plaquetas' => $hemograma_com_plaquetas,
            ':antibiograma' => $antibiograma,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $editConvocacao;
    }

    public function delete_Prestador_Valores_Exames($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE prestador_valores_exames SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $deleteConvocacao;
    }

    public function Dados_Prestador_Valores_Exames($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, cnpj, status, exame_clinico,acido_metil_hipurico,hemograma,
                acido_mandelico,vdrl,reticulocitos,parasitologico_fezes,cultural_de_orofaringe,
                coprocultura,micologico_de_unha,audiometria,ecg,acuidade_visual,eeg,plaquetas,
                eritrograma,acido_tt_muconico,glicemia_em_jejum,acido_hipurico,hemograma_com_plaquetas,antibiograma 
                from prestador_valores_exames 
                where cnpj = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Possui_Dados_Prestador_Valores_Exames($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos 
                from prestador_valores_exames 
                where cnpj = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();        
        return $data;
    }
}