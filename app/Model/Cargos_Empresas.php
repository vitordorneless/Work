<?php

class Cargos_Empresas extends Empresas {
    public function save($cargo) {
        include_once '../config/database_mysql.php';
        session_start();
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO cargos_empresas(cargo,status,data_ultima_alteracao,user_id) VALUES(?,?,?,?)");
        $smtp->bindParam(1, $cargo, PDO::PARAM_STR);
        $smtp->bindParam(2, $status, PDO::PARAM_INT);        
        $smtp->bindParam(3, $data_ultima_alteracao, PDO::PARAM_STR);
        $smtp->bindParam(4, $_SESSION['user_id'], PDO::PARAM_INT);        
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit($id, $cargo, $status, $user_id) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cargos_empresas SET cargo = :cargo, status = :status, 
                data_ultima_alteracao = :data_ultima_alteracao, user_id = :user_id WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id, ':cargo' => $cargo, ':status' => $status, ':data_ultima_alteracao' => $data_ultima_alteracao, ':user_id' => $user_id));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cargos_empresas SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,':status' => $status,':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, cargo,status,data_ultima_alteracao,user_id from cargos_empresas where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}