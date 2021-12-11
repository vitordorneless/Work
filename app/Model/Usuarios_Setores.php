<?php

class Usuarios_Setores extends Usuario {
    public function save_Usuarios_Setores($setor) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');        
        
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO usuarios_setores(setor,status,data_ultima_alteracao) VALUES(?,?,?)");
        $smtp->bindParam(1, $setor, PDO::PARAM_STR);        
        $smtp->bindParam(2, $status, PDO::PARAM_INT);
        $smtp->bindParam(3, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveUsuarios_Setores = $confirm == TRUE ? TRUE : FALSE;
        return $saveUsuarios_Setores;
    }
    
    public function edit_Usuarios_Setores($id, $setor, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE usuarios_setores SET setor = :setor, status = :status, 
                data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':setor' => $setor,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editUsuarios_Setores = $confirm == TRUE ? TRUE : FALSE;
        return $editUsuarios_Setores;
    }

    public function delete_Usuarios_Setores($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE usuarios_setores SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteUsuarios_Setores = $confirm == TRUE ? TRUE : FALSE;
        return $deleteUsuarios_Setores;
    }
    
    public function Dados_Usuarios_Setores($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, setor, status from usuarios_setores where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}