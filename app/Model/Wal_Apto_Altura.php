<?php

class Wal_Apto_Altura extends Riscos {

    public function save_Apto($id_Ativo, $apto_trab_altura) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO wal_apto_trab_altura(id_funcionario,apto_trab_altura,status,data_ultima_alteracao) VALUES(?,?,?,?)");
        $smtp->bindParam(1, $id_Ativo, PDO::PARAM_INT);
        $smtp->bindParam(2, $apto_trab_altura, PDO::PARAM_INT);
        $smtp->bindParam(3, $status, PDO::PARAM_INT);
        $smtp->bindParam(4, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Apto($id, $id_Ativo, $apto_trab_altura) {
        include_once '../config/database_mysql.php';
        if ($apto_trab_altura === 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_apto_trab_altura SET id_funcionario = :id_funcionario, apto_trab_altura = :apto_trab_altura,                 
                status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_funcionario' => $id_Ativo,
            ':apto_trab_altura' => $apto_trab_altura,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function Sou_Apto_Altura($id_funcionario) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from wal_apto_trab_altura where status = 1 and id_funcionario = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_funcionario));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function id_Apto_Altura($id_funcionario) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id from wal_apto_trab_altura where id_funcionario = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_funcionario));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

}
