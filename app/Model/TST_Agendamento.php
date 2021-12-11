<?php

class TST_Agendamento extends Tecnicos_Seguranca_Trabalho {
    public function save_TST_Agendamento($id_tipo_agendamento,$id_unidade,$id_turnos,$id_situacao,$data_agendamento,$tecnicos_ids,$obs) {
        include_once '../config/database_mysql.php';        
        $check_list = 0;
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO tst_agendamento(id_tipo_agendamento,id_unidade,id_turnos,id_situacao,data_agendamento,tecnicos_ids,obs,user_criacao,check_list,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_tipo_agendamento, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_unidade, PDO::PARAM_INT);
        $smtp->bindParam(3, $id_turnos, PDO::PARAM_INT);
        $smtp->bindParam(4, $id_situacao, PDO::PARAM_INT);
        $smtp->bindParam(5, $data_agendamento, PDO::PARAM_STR);
        $smtp->bindParam(6, $tecnicos_ids, PDO::PARAM_STR);
        $smtp->bindParam(7, $obs, PDO::PARAM_STR);
        $smtp->bindParam(8, $_SESSION['user_id'], PDO::PARAM_INT);
        $smtp->bindParam(9, $check_list, PDO::PARAM_INT);
        $smtp->bindParam(10, $status, PDO::PARAM_INT);
        $smtp->bindParam(11, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_TST_Agendamento($id,$id_tipo_agendamento,$id_unidade,$id_turnos,$id_situacao,$data_agendamento,$tecnicos_ids,$obs,$status) {
        include_once '../config/database_mysql.php';        
        $check_list = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_agendamento SET id_tipo_agendamento = :id_tipo_agendamento, "
                . "id_unidade = :id_unidade,id_turnos = :id_turnos,id_situacao = :id_situacao,"
                . "data_agendamento = :data_agendamento,tecnicos_ids = :tecnicos_ids,"
                . "obs = :obs, user_criacao = :user_criacao,check_list = :check_list, status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_tipo_agendamento' => $id_tipo_agendamento,
            ':id_unidade' => $id_unidade,
            ':id_turnos' => $id_turnos,
            ':id_situacao' => $id_situacao,
            ':data_agendamento' => $data_agendamento,
            ':tecnicos_ids' => $tecnicos_ids,
            ':obs' => $obs,
            ':user_criacao' => $_SESSION['user_id'],
            ':check_list' => $check_list,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }
    
    public function edit_TST_Agendamento_Status($id) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_agendamento SET id_situacao = :id_situacao WHERE id = :id");
        $confirm = $smtpup->execute(array(':id' => $id,':id_situacao' => 2));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }
    
    public function edit_TST_Agendamento_Checklist($id) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_agendamento SET check_list = :check_list WHERE id = :id");
        $confirm = $smtpup->execute(array(':id' => $id,':check_list' => 1));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_TST_Agendamento($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_agendamento SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_TST_Agendamentos($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_tipo_agendamento,check_list,id_unidade,id_turnos,id_situacao,data_agendamento,tecnicos_ids,obs,user_criacao,status,data_ultima_alteracao from tst_agendamento where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}