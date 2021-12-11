<?php

class Herval_Marca_Email {
    public function save_Herval_Marca_Email($id_agendamento, $email) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO herval_email_agendamento(id_agendamento,email_enviado) VALUES(?,?)");
        $smtp->bindParam(1, $id_agendamento, PDO::PARAM_INT);
        $smtp->bindParam(2, $email, PDO::PARAM_INT);        
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }
    
    public function Enviou_Email($id_agendamento) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id_agendamento, email_enviado from herval_email_agendamento where id_agendamento = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_agendamento));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();        
        return $data;
    }
}
