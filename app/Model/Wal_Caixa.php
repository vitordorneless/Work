<?php

class Wal_Caixa extends Walmart {

    public function save_Caixa($etiqueta, $id_usuario, $id_wal_box) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $etiquetas = strtoupper($etiqueta);
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO wal_caixa(etiqueta,id_usuario,id_wal_box,status,data_ultima_alteracao) VALUES(?,?,?,?,?)");
        $smtp->bindParam(1, $etiquetas, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_usuario, PDO::PARAM_INT);
        $smtp->bindParam(3, $id_wal_box, PDO::PARAM_INT);
        $smtp->bindParam(4, $status, PDO::PARAM_INT);
        $smtp->bindParam(5, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Caixa($id, $etiqueta, $id_usuario, $id_wal_box, $status) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $etiquetas = strtoupper($etiqueta);
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $smtpup = $pdo->prepare("UPDATE wal_caixa SET etiqueta = :etiqueta, 
                id_usuario = :id_usuario, id_wal_box = :id_wal_box, 
                status = :status, data_ultima_alteracao = :data_ultima_alteracao 
                WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id, 
            ':etiqueta' => $etiquetas, 
            ':id_usuario' => $id_usuario, 
            ':id_wal_box' => $id_wal_box, 
            ':status' => $status, 
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function Dados_Caixa($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,etiqueta,id_usuario,id_wal_box,status,data_ultima_alteracao from wal_caixa where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Existe_Caixa($etiqueta) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as etiqueta from wal_caixa where etiqueta = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($etiqueta));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $tem = $data['etiqueta'] > 0 ? TRUE : FALSE;
        return $tem;
    }

}
