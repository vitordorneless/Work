<?php

class Llamado_Cerrado extends Llamados {
    public function save_Llamado_Cerrado($id_chamado,$id_status,$id_mensagem,$mensagem,$id_tecnico) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO chamado_encerrado(id_chamado,id_status,id_mensagem,mensagem,id_tecnico,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $this->id_chamado = $id_chamado, PDO::PARAM_INT);
        $smtp->bindParam(2, $this->id_status = $id_status, PDO::PARAM_INT);
        $smtp->bindParam(3, $this->id_mensagem = $id_mensagem, PDO::PARAM_INT);
        $smtp->bindParam(4, $this->mensagem = $mensagem, PDO::PARAM_STR);
        $smtp->bindParam(5, $this->id_tecnico = $id_tecnico, PDO::PARAM_INT);
        $smtp->bindParam(6, $this->status = 1, PDO::PARAM_INT);
        $smtp->bindParam(7, $this->data_ultima_alteracao = date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Llamado_Cerrado($id, $id_chamado,$id_status,$id_mensagem,$mensagem,$id_tecnico, $status) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado_encerrado SET id_chamado = :id_chamado, id_status = :id_status, id_mensagem = :id_mensagem, mensagem = :mensagem, id_tecnico = :id_tecnico, status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $this->id = $id,':id_chamado' => $this->id_chamado = $id_chamado,':id_status' => $this->id_status = $id_status,
            ':id_mensagem' => $this->id_mensagem = $id_mensagem,':mensagem' => $this->mensagem = $mensagem,':id_tecnico' => $this->id_tecnico = $id_tecnico,
            ':status' => $this->status = $status,':data_ultima_alteracao' => $this->data_ultima_alteracao = date('Y-m-d H:i:s')));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Llamado_Cerrado($id) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado_encerrado SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $this->id = $id,
            ':status' => $this->status = 0,
            ':data_ultima_alteracao' => $this->data_ultima_alteracao = date('Y-m-d H:i:s')));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_Llamado_Cerrado($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_chamado,id_status,id_mensagem,mensagem,id_tecnico,status,data_ultima_alteracao from chamado_encerrado where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($this->id = $id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
