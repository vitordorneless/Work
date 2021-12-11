<?php

class TST_Lojas extends Tecnicos_Seguranca_Trabalho {
    public function save_TST_Lojas($cnpj, $nome_unidade,$palavra_chave,$endereco, $bairro, $id_cidade, $id_estado, $cep) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO tst_unidades(cnpj,nome_unidade,palavra_chave,endereco,bairro,
                id_cidade,id_estado,cep,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $cnpj, PDO::PARAM_STR);
        $smtp->bindParam(2, $nome_unidade, PDO::PARAM_STR);
        $smtp->bindParam(3, $palavra_chave, PDO::PARAM_STR);
        $smtp->bindParam(4, $endereco, PDO::PARAM_STR);
        $smtp->bindParam(5, $bairro, PDO::PARAM_STR);
        $smtp->bindParam(6, $id_cidade, PDO::PARAM_INT);
        $smtp->bindParam(7, $id_estado, PDO::PARAM_INT);
        $smtp->bindParam(8, $cep, PDO::PARAM_STR);        
        $smtp->bindParam(9, $status, PDO::PARAM_INT);
        $smtp->bindParam(10, $data_ultima_alteracao, PDO::PARAM_STR);        
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_TST_Lojas($id, $cnpj, $nome_unidade,$palavra_chave,$endereco, $bairro, $id_cidade, $id_estado, $cep, $status) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_unidades SET cnpj = :cnpj,nome_unidade = :nome_unidade,palavra_chave = :palavra_chave,endereco = :endereco,bairro = :bairro,
                id_cidade = :id_cidade,id_estado = :id_estado,cep = :cep,status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':cnpj' => $cnpj,
            ':nome_unidade' => $nome_unidade,
            ':palavra_chave' => $palavra_chave,
            ':endereco' => $endereco,
            ':bairro' => $bairro,
            ':id_cidade' => $id_cidade,
            ':id_estado' => $id_estado,
            ':cep' => $cep,            
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_TST_Lojas($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_unidades SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_TST_Lojass($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,cnpj,nome_unidade,palavra_chave,endereco,bairro,id_cidade,id_estado,cep,status,data_ultima_alteracao from tst_unidades where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}