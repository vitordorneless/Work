<?php

class TST_checklist_funcao extends Tecnicos_Seguranca_Trabalho {
    public function save_TST_checklist_funcao($id_loja, $nome_funcao, $descricao) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO tst_checklist_funcao(id_loja,nome_funcao,descricao,status,data_ultima_alteracao) VALUES(?,?,?,?,?)");
        $smtp->bindParam(1, $id_loja, PDO::PARAM_INT);
        $smtp->bindParam(2, $nome_funcao, PDO::PARAM_STR);
        $smtp->bindParam(3, $descricao, PDO::PARAM_STR);
        $smtp->bindParam(4, $status, PDO::PARAM_INT);
        $smtp->bindParam(5, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_TST_checklist_funcao($id, $id_loja, $nome_funcao, $descricao, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_checklist_funcao SET id_loja = :id_loja, nome_funcao = :nome_funcao, descricao = :descricao, status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_loja' => $id_loja,
            ':nome_funcao' => $nome_funcao,
            ':descricao' => $descricao,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_TST_checklist_funcao($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_checklist_funcao SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_TST_checklist_funcao($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_loja,nome_funcao,descricao,status,data_ultima_alteracao from tst_checklist_funcao where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
