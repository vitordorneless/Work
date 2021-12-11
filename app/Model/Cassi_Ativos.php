<?php

class Cassi_Ativos extends Cassi {

    public function save_Cassi_Ativos($matricula, $prefixo_agencia, $nome_ativo, $id_sexo, $id_cassi_situacao, $data_nascimento, $data_posse, $obs) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO cassi_ativos(matricula,prefixo_agencia,nome_ativo,id_sexo,id_cassi_situacao,data_nascimento,data_posse,status,obs,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $matricula, PDO::PARAM_INT);
        $smtp->bindParam(2, $prefixo_agencia, PDO::PARAM_INT);
        $smtp->bindParam(3, $nome_ativo, PDO::PARAM_STR);
        $smtp->bindParam(4, $id_sexo, PDO::PARAM_INT);
        $smtp->bindParam(5, $id_cassi_situacao, PDO::PARAM_INT);
        $smtp->bindParam(6, $data_nascimento, PDO::PARAM_STR);
        $smtp->bindParam(7, $data_posse, PDO::PARAM_STR);
        $smtp->bindParam(8, $status, PDO::PARAM_INT);
        $smtp->bindParam(9, $obs, PDO::PARAM_STR);
        $smtp->bindParam(10, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Cassi_Ativos($id, $matricula, $prefixo_agencia, $nome_ativo, $id_sexo, $id_cassi_situacao, $data_nascimento, $data_posse, $status, $obs) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cassi_ativos SET matricula = :matricula, prefixo_agencia = :prefixo_agencia, nome_ativo = :nome_ativo, id_sexo = :id_sexo, id_cassi_situacao = :id_cassi_situacao, data_nascimento = :data_nascimento, 
                data_posse = :data_posse, status = :status, obs = :obs, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':matricula' => $matricula,
            ':prefixo_agencia' => $prefixo_agencia,
            ':nome_ativo' => $nome_ativo,
            ':id_sexo' => $id_sexo,
            ':id_cassi_situacao' => $id_cassi_situacao,
            ':data_nascimento' => $data_nascimento,
            ':data_posse' => $data_posse,
            ':status' => $status,
            ':obs' => $obs,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }
    
    public function edit_Cassi_Situacao_Ativos($id, $id_cassi_situacao, $obs) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cassi_ativos SET id_cassi_situacao = :id_cassi_situacao, obs = :obs, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_cassi_situacao' => $id_cassi_situacao,
            ':obs' => $obs,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Cassi_Ativos($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cassi_ativos SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteMedico = $confirm == TRUE ? TRUE : FALSE;
        return $deleteMedico;
    }

    public function Dados_Cassi_Ativoss($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,matricula,prefixo_agencia,nome_ativo,id_sexo,id_cassi_situacao,data_nascimento,data_posse,status,obs from cassi_ativos where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}