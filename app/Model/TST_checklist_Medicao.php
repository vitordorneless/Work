<?php

class TST_checklist_Medicao extends Tecnicos_Seguranca_Trabalho {
    public function save_TST_checklist_Medicao($id_loja, $setor, $id_funcao, $db, $lux) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO tst_checklist_medicoes(id_loja,setor,id_funcao,db,lux,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_loja, PDO::PARAM_INT);
        $smtp->bindParam(2, $setor, PDO::PARAM_STR);
        $smtp->bindParam(3, $id_funcao, PDO::PARAM_INT);
        $smtp->bindParam(4, $db, PDO::PARAM_STR);
        $smtp->bindParam(5, $lux, PDO::PARAM_STR);
        $smtp->bindParam(6, $status, PDO::PARAM_INT);
        $smtp->bindParam(7, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_TST_checklist_Medicao($id, $id_loja, $setor, $id_funcao, $db, $lux, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_checklist_medicoes SET id_loja = :id_loja, setor = :setor, id_funcao = :id_funcao, db = :db, lux = :lux, status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_loja' => $id_loja,
            ':setor' => $setor,
            ':id_funcao' => $id_funcao,
            ':db' => $db,
            ':lux' => $lux,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_TST_checklist_Medicao($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_checklist_medicoes SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_TST_checklist_Medicao($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_loja,setor,id_funcao,db,lux,status,data_ultima_alteracao from tst_checklist_medicoes where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
