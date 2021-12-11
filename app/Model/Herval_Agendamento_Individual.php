<?php

class Herval_Agendamento_Individual extends Herval {

    public function save_Herval_Agendamento_Individual($id_ativo, $id_convocacao, $id_unidade, $id_medico, $id_situacao, $data, $horario) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO herval_agendamento_individual(id_ativo,id_convocacao,id_unidade,id_medico,id_situacao,
                data,horario,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_ativo, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_convocacao, PDO::PARAM_INT);
        $smtp->bindParam(3, $id_unidade, PDO::PARAM_INT);
        $smtp->bindParam(4, $id_medico, PDO::PARAM_INT);
        $smtp->bindParam(5, $id_situacao, PDO::PARAM_INT);
        $smtp->bindParam(6, $data, PDO::PARAM_STR);
        $smtp->bindParam(7, $horario, PDO::PARAM_STR);
        $smtp->bindParam(8, $status, PDO::PARAM_INT);
        $smtp->bindParam(9, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Herval_Agendamento_Individual($id, $id_ativo, $id_convocacao, $id_unidade, $id_medico, $id_situacao, $data, $horario, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE herval_agendamento_individual SET id_ativo = :id_ativo,id_convocacao = :id_convocacao,id_unidade = :id_unidade,id_medico = :id_medico,id_situacao = :id_situacao,
                data = :data,horario = :horario,status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_ativo' => $id_ativo,
            ':id_convocacao' => $id_convocacao,
            ':id_unidade' => $id_unidade,
            ':id_medico' => $id_medico,
            ':id_situacao' => $id_situacao,
            ':data' => $data,
            ':horario' => $horario,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Herval_Agendamento_Individual($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE herval_agendamento_individual SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_Herval_Agendamento_Individuals($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_ativo,id_convocacao,id_unidade,id_medico,id_situacao,
                data,horario,status,data_ultima_alteracao from herval_agendamento_individual where id_ativo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}