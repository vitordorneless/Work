<?php

class Cassi_Agencia extends Cassi {
    public function save_Cassi_Agencia($prefixo, $dependencia, $municipio, $jurisdicao) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO cassi_agencia(prefixo,dependencia,municipio,jurisdicao,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?)");
        $smtp->bindParam(1, $prefixo, PDO::PARAM_INT);
        $smtp->bindParam(2, $dependencia, PDO::PARAM_STR);
        $smtp->bindParam(3, $municipio, PDO::PARAM_STR);
        $smtp->bindParam(4, $jurisdicao, PDO::PARAM_STR);        
        $smtp->bindParam(5, $status, PDO::PARAM_INT);
        $smtp->bindParam(6, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Cassi_Agencia($id, $prefixo, $dependencia, $municipio, $jurisdicao, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cassi_agencia SET prefixo = :prefixo, dependencia = :dependencia, municipio = :municipio, jurisdicao = :jurisdicao,                 
                status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':prefixo' => $prefixo,
            ':dependencia' => $dependencia,
            ':municipio' => $municipio,
            ':jurisdicao' => $jurisdicao,            
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Cassi_Agencia($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cassi_agencia SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteMedico = $confirm == TRUE ? TRUE : FALSE;
        return $deleteMedico;
    }

    public function Dados_Cassi_Agencias($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, prefixo, dependencia, municipio, jurisdicao, status from cassi_agencia where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Cassi_Agencias_prefixo($prefixo) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, prefixo, dependencia, municipio, jurisdicao, status from cassi_agencia where prefixo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($prefixo));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}