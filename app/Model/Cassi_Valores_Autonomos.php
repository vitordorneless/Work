<?php

class Cassi_Valores_Autonomos extends Cassi {
    public function save_Cassi_Valores_Autonomos($id_funcionario, $id_medico, $consulta) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO cassi_valores_autonomos(id_funcionario,id_medico,consulta,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?)");
        $smtp->bindParam(1, $id_funcionario, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_medico, PDO::PARAM_INT);
        $smtp->bindParam(3, $consulta, PDO::PARAM_STR);        
        $smtp->bindParam(4, $status, PDO::PARAM_INT);        
        $smtp->bindParam(5, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Cassi_Valores_Autonomos($id, $id_funcionario, $id_medico, $consulta, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cassi_valores_autonomos SET id_funcionario = :id_funcionario, id_medico = :id_medico, consulta = :consulta, status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_funcionario' => $id_funcionario,
            ':id_medico' => $id_medico,
            ':consulta' => $consulta,            
            ':status' => $status,            
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Cassi_Valores_Autonomos($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cassi_valores_autonomos SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteMedico = $confirm == TRUE ? TRUE : FALSE;
        return $deleteMedico;
    }

    public function Dados_Cassi_Valores_Autonomoss($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_funcionario,id_medico,consulta,status,data_ultima_alteracao from cassi_valores_autonomos where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
