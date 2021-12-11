<?php

class Medicos_Conta_Corrente extends Medico {
    public function save_Medico_conta_Corrente($id_medico, $id_banco, $agencia, $conta_corrente) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO wal_medico_conta_corrente(crm,id_banco,agencia,conta_corrente,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_medico, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_banco, PDO::PARAM_INT);
        $smtp->bindParam(3, $agencia, PDO::PARAM_INT);
        $smtp->bindParam(4, $conta_corrente, PDO::PARAM_INT);        
        $smtp->bindParam(5, $status, PDO::PARAM_INT);
        $smtp->bindParam(6, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveMedico = $confirm == TRUE ? TRUE : FALSE;
        return $saveMedico;
    }

    public function edit_Medico_conta_Corrente($id, $id_medico, $id_banco, $agencia, $conta_corrente, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_medico_conta_corrente SET crm = :crm, id_banco = :id_banco,                 
                agencia = :agencia, conta_corrente = :conta_corrente,                 
                status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':crm' => $id_medico,
            ':id_banco' => $id_banco,
            ':agencia' => $agencia,
            ':conta_corrente' => $conta_corrente,            
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editMedico = $confirm == TRUE ? TRUE : FALSE;
        return $editMedico;
    }

    public function delete_Medico_conta_Corrente($id_medico) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_medico_conta_corrente SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE crm = :crm");
        $confirm = $smtpup->execute(array(
            ':crm' => $id_medico,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteMedico = $confirm == TRUE ? TRUE : FALSE;
        return $deleteMedico;
    }

    public function Dados_Medico_conta_Corrente($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, crm, id_banco, agencia, conta_corrente, status from wal_medico_conta_corrente where crm = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
