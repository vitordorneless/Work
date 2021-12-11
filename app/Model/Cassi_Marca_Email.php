<?php

class Cassi_Marca_Email extends Cassi{
    public function save_Cassi_Marca_Email($id_agendamento, $email) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');        
        $pdo = Database::connect();//municipio recebe o id da agencia - help do vitao
        $smtp = $pdo->prepare("INSERT INTO cassi_email_agendamento(id_agendamento,email_enviado) 
                VALUES(?,?)");
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
        $sql = "select id_agendamento, email_enviado from cassi_email_agendamento where id_agendamento = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_agendamento));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();        
        return $data;
    }
}
