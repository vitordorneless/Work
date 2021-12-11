<?php

class Responsaveis_Walmart extends Responsavel_Walmart {

    public function save_Responsaveis_Walmart($id_empresa, $id_loja, $nome_responsavel, $ddd, $telefone, $email) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO responsaveis_walmart(id_empresa,id_loja,nome_responsavel,ddd,telefone,email,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_empresa, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_loja, PDO::PARAM_INT);
        $smtp->bindParam(3, $nome_responsavel, PDO::PARAM_STR);
        $smtp->bindParam(4, $ddd, PDO::PARAM_INT);
        $smtp->bindParam(5, $telefone, PDO::PARAM_INT);
        $smtp->bindParam(6, $email, PDO::PARAM_STR);
        $smtp->bindParam(7, $status, PDO::PARAM_INT);
        $smtp->bindParam(8, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $saveConvocacao;
    }

    public function edit_Responsaveis_Walmart($id, $id_empresa, $id_loja, $nome_responsavel, $ddd, $telefone, $email, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE responsaveis_walmart SET id_empresa = :id_empresa, id_loja = :id_loja, nome_responsavel = :nome_responsavel,
            ddd = :ddd, telefone = :telefone, email = :email, status = :status, 
                data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_empresa' => $id_empresa,            
            ':id_loja' => $id_loja,
            ':nome_responsavel' => $nome_responsavel,
            ':ddd' => $ddd,
            ':telefone' => $telefone,
            ':email' => $email,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $editConvocacao;
    }

    public function delete_Responsaveis_Walmart($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE responsaveis_walmart SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $deleteConvocacao;
    }

    public function Dados_Responsaveis_Walmart($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_empresa, id_loja, nome_responsavel, ddd, telefone, email, status from responsaveis_walmart where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}