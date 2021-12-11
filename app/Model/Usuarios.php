<?php

class Usuarios extends Usuario {

    public function saveUser($nome, $pass, $email, $admin, $nome_extenso, $setor, $foto, $crm, $estado_crm) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');

        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO usuarios(nome_extenso,setor,crm,estado_crm,nome,foto,email,pass,status,admin,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $nome_extenso, PDO::PARAM_STR);
        $smtp->bindParam(2, $setor, PDO::PARAM_INT);
        $smtp->bindParam(3, $crm, PDO::PARAM_INT);
        $smtp->bindParam(4, $estado_crm, PDO::PARAM_STR);
        $smtp->bindParam(5, $nome, PDO::PARAM_STR);
        $smtp->bindParam(6, $foto, PDO::PARAM_STR);
        $smtp->bindParam(7, $email, PDO::PARAM_STR);
        $smtp->bindParam(8, $pass, PDO::PARAM_STR);
        $smtp->bindParam(9, $status, PDO::PARAM_INT);
        $smtp->bindParam(10, $admin, PDO::PARAM_INT);
        $smtp->bindParam(11, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveUser = $confirm == TRUE ? TRUE : FALSE;
        return $saveUser;
    }

    public function edit_User($id, $nome, $pass, $email, $admin, $nome_extenso, $setor, $foto, $status, $crm, $estado_crm) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE usuarios SET nome_extenso = :nome_extenso, setor = :setor, crm = :crm, estado_crm = :estado_crm, nome = :nome, foto = :foto, email = :email, pass = :pass, status = :status, 
                admin = :admin, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id, ':nome_extenso' => $nome_extenso, ':setor' => $setor, ':crm' => $crm,
            ':estado_crm' => $estado_crm, ':nome' => $nome, ':foto' => $foto, ':email' => $email,
            ':pass' => $pass, ':status' => $status, ':admin' => $admin, ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editUser = $confirm == TRUE ? TRUE : FALSE;
        return $editUser;
    }

    public function edit_Pass_User($id, $pass) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE usuarios SET pass = :pass, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(':id' => $id, ':pass' => $pass, ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editPassUser = $confirm == TRUE ? TRUE : FALSE;
        return $editPassUser;
    }

    public function delete_User($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE usuarios SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteUser = $confirm == TRUE ? TRUE : FALSE;
        return $deleteUser;
    }

    public function Dados_User($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, nome_extenso, setor, crm, estado_crm, nome, foto, email, pass, status, admin from usuarios where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}