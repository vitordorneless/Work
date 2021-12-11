<?php

class Wal_Envelope extends Walmart {
    public function save_Wal_Envelope($id_medico,$protocolo,$data_envio_loja,$id_forma_envio,$data_retorno,$ids_envelope) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO wal_envelope(id_medico,protocolo,data_envio_loja,id_forma_envio,data_retorno,ids_envelope,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_medico, PDO::PARAM_INT);
        $smtp->bindParam(2, $protocolo, PDO::PARAM_STR);
        $smtp->bindParam(3, $data_envio_loja, PDO::PARAM_STR);
        $smtp->bindParam(4, $id_forma_envio, PDO::PARAM_INT);
        $smtp->bindParam(5, $data_retorno, PDO::PARAM_STR);
        $smtp->bindParam(6, $ids_envelope, PDO::PARAM_STR);
        $smtp->bindParam(7, $status, PDO::PARAM_INT);
        $smtp->bindParam(8, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Wal_Envelope($id,$id_medico,$protocolo,$data_envio_loja,$id_forma_envio,$data_retorno,$ids_envelope,$status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_envelope SET id_medico = :id_medico, protocolo = :protocolo,data_envio_loja = :data_envio_loja,id_forma_envio = :id_forma_envio,data_retorno = :data_retorno,ids_envelope = :ids_envelope,status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_medico' => $id_medico,
            ':protocolo' => $protocolo,
            ':data_envio_loja' => $data_envio_loja,
            ':id_forma_envio' => $id_forma_envio,
            ':data_retorno' => $data_retorno,
            ':ids_envelope' => $ids_envelope,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Wal_Envelope($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_envelope SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_Wal_Envelopes($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_medico,protocolo,data_envio_loja,id_forma_envio,data_retorno,ids_envelope,status,data_ultima_alteracao from wal_envelope where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}