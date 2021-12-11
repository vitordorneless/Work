<?php

class TST_Tecnicos extends Tecnicos_Seguranca_Trabalho {
    public function save_TST_Tecnicos($nome,$registro,$cpf,$id_cargo) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO tst_tecnicos(nome,registro,cpf,id_cargo,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?)");
        $smtp->bindParam(1, $nome, PDO::PARAM_STR);
        $smtp->bindParam(2, $registro, PDO::PARAM_STR);
        $smtp->bindParam(3, $cpf, PDO::PARAM_STR);
        $smtp->bindParam(4, $id_cargo, PDO::PARAM_INT);
        $smtp->bindParam(5, $status, PDO::PARAM_INT);
        $smtp->bindParam(6, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_TST_Tecnicos($id,$nome,$registro,$cpf,$id_cargo,$status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_tecnicos SET nome = :nome, registro = :registro,cpf = :cpf,id_cargo = :id_cargo,status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':nome' => $nome,
            ':registro' => $registro,
            ':cpf' => $cpf,
            ':id_cargo' => $id_cargo,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_TST_Tecnicos($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_tecnicos SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_TST_Tecnicoss($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,nome,registro,cpf,id_cargo,status,data_ultima_alteracao from tst_tecnicos where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}