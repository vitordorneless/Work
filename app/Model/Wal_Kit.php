<?php

class Wal_Kit extends Convocar {
    public function save_Wal_Kit($id_convocacao, $rastreamento, $data_envio) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO wal_kit(id_evento_convocacao,rastreamento,data_envio,status,data_ultima_alteracao) VALUES(?,?,?,?,?)");
        $smtp->bindParam(1, $id_convocacao, PDO::PARAM_INT);        
        $smtp->bindParam(2, $rastreamento, PDO::PARAM_STR);
        $smtp->bindParam(3, $data_envio, PDO::PARAM_STR);
        $smtp->bindParam(4, $status, PDO::PARAM_INT);
        $smtp->bindParam(5, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $saveConvocacao;
    }

    public function edit_Wal_Kit($id, $id_convocacao, $rastreamento, $data_envio, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();                       
        $smtpup = $pdo->prepare("UPDATE wal_kit SET id_evento_convocacao = :id_evento_convocacao, rastreamento = :rastreamento,
                data_envio = :data_envio, status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,':id_evento_convocacao' => $id_convocacao,':rastreamento' => $rastreamento,':data_envio' => $data_envio,
            ':status' => $status,':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $editConvocacao;
    }
    
    public function Dados_Wal_Kit($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_evento_convocacao,rastreamento,data_envio,status,data_ultima_alteracao from wal_kit where id_evento_convocacao = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}