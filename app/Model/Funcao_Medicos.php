<?php

class Funcao_Medicos extends Medico {

    public function save_Funcao_Medicos($funcao) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO wal_funcao_medico(funcao,ativo,data_ultima_alteracao) 
                VALUES(?,?,?)");
        $smtp->bindParam(1, $funcao, PDO::PARAM_STR);
        $smtp->bindParam(2, $status, PDO::PARAM_INT);
        $smtp->bindParam(3, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveFuncao_Medicos = $confirm == TRUE ? TRUE : FALSE;
        return $saveFuncao_Medicos;
    }

    public function edit_Funcao_Medicos($id_funcao, $funcao, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');

        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_funcao_medico SET funcao = :funcao, ativo = :ativo, data_ultima_alteracao = :data_ultima_alteracao
                WHERE id_funcao = :id_funcao");
        $confirm = $smtpup->execute(array(
            ':id_funcao' => $id_funcao,
            ':funcao' => $funcao,
            ':ativo' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editFuncao_Medicos = $confirm == TRUE ? TRUE : FALSE;
        return $editFuncao_Medicos;
    }

    public function delete_Funcao_Medicos($id_funcao) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_funcao_medico SET ativo = :ativo, data_ultima_alteracao = :data_ultima_alteracao WHERE id_funcao = :id_funcao");
        $confirm = $smtpup->execute(array(
            ':id_funcao' => $id_funcao,
            ':ativo' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteFuncao_Medicos = $confirm == TRUE ? TRUE : FALSE;
        return $deleteFuncao_Medicos;
    }

    public function Dados_Funcao_Medicos($id_funcao) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id_funcao, funcao, ativo from wal_funcao_medico where id_funcao = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_funcao));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}