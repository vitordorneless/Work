<?php

class TST_Tipo_Agendamento extends Tecnicos_Seguranca_Trabalho {
    public function save_TST_Tipo_Agendamento($nome_agendamento) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO tst_tipo_agendamento(nome_agendamento,status,data_ultima_alteracao) 
                VALUES(?,?,?)");
        $smtp->bindParam(1, $nome_agendamento, PDO::PARAM_STR);
        $smtp->bindParam(2, $status, PDO::PARAM_INT);
        $smtp->bindParam(3, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_TST_Tipo_Agendamento($id, $nome_agendamento, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_tipo_agendamento SET nome_agendamento = :nome_agendamento, status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':nome_agendamento' => $nome_agendamento,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_TST_Tipo_Agendamento($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_tipo_agendamento SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_TST_Tipo_Agendamentos($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,nome_agendamento,status,data_ultima_alteracao from tst_tipo_agendamento where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
