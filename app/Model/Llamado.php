<?php

class Llamado extends Llamados {
    public function save_Llamado($id_chamado_tipo,$id_chamado_status,$id_usuario,$mensagem) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO chamado(id_chamado_tipo,id_chamado_status,id_usuario,mensagem,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?)");
        $smtp->bindParam(1, $this->id_chamado_tipo = $id_chamado_tipo, PDO::PARAM_INT);
        $smtp->bindParam(2, $this->id_chamado_status = $id_chamado_status, PDO::PARAM_INT);
        $smtp->bindParam(3, $this->id_usuario = $id_usuario, PDO::PARAM_INT);
        $smtp->bindParam(4, $this->mensagem = $mensagem, PDO::PARAM_STR);
        $smtp->bindParam(5, $this->status = 1, PDO::PARAM_INT);
        $smtp->bindParam(6, $this->data_ultima_alteracao = date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Llamado($id, $id_chamado_tipo,$id_chamado_status,$id_usuario,$mensagem, $status) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado SET id_chamado_tipo = :id_chamado_tipo, id_chamado_status = :id_chamado_status, id_usuario = :id_usuario, mensagem = :mensagem, status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $this->id = $id,
            ':id_chamado_tipo' => $this->id_chamado_tipo = $id_chamado_tipo,
            ':id_chamado_status' => $this->id_chamado_status = $id_chamado_status,
            ':id_usuario' => $this->id_usuario = $id_usuario,
            ':mensagem' => $this->mensagem = $mensagem,
            ':status' => $this->status = $status,
            ':data_ultima_alteracao' => $this->data_ultima_alteracao = date('Y-m-d H:i:s')));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Llamado($id) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $this->id = $id,
            ':status' => $this->status = 0,
            ':data_ultima_alteracao' => $this->data_ultima_alteracao = date('Y-m-d H:i:s')));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_Llamados($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_chamado_tipo,id_chamado_status,id_usuario,mensagem,status,data_ultima_alteracao from chamado where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($this->id = $id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}