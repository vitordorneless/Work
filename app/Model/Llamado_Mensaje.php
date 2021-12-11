<?php
class Llamado_Mensaje extends Llamados {
    public function save_Llamado_Mensaje($mensagem) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO chamado_mensagem(mensagem,status,data_ultima_alteracao) VALUES(?,?,?)");        
        $smtp->bindParam(1, $this->mensagem = $mensagem, PDO::PARAM_STR);        
        $smtp->bindParam(2, $this->status = 1, PDO::PARAM_INT);
        $smtp->bindParam(3, $this->data_ultima_alteracao = date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Llamado_Mensaje($id, $mensagem,$status) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado_mensagem SET mensagem = :mensagem, status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(':id' => $this->id = $id,':mensagem' => $this->mensagem = $mensagem,':status' => $this->status = $status,':data_ultima_alteracao' => $this->data_ultima_alteracao = date('Y-m-d H:i:s')));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Llamado_Mensaje($id) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado_mensagem SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $this->id = $id,
            ':status' => $this->status = 0,
            ':data_ultima_alteracao' => $this->data_ultima_alteracao = date('Y-m-d H:i:s')));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_Llamado_Mensaje($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,mensagem,status,data_ultima_alteracao from chamado_mensagem where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($this->id = $id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
