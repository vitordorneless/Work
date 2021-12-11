<?php

class Herval_Agendamento extends Herval {

    public function save_Herval_agendamento($id_unidade, $id_tipo_agendamento, $data_agendamento, $id_situacao, $id_medico, $valor_consulta, $voucher, $user_cad) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO herval_agendamento(id_unidade,id_tipo_agendamento,data_agendamento,id_situacao,
                id_medico,valor_consulta,voucher,user_cad,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_unidade, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_tipo_agendamento, PDO::PARAM_INT);
        $smtp->bindParam(3, $data_agendamento, PDO::PARAM_STR);
        $smtp->bindParam(4, $id_situacao, PDO::PARAM_INT);
        $smtp->bindParam(5, $id_medico, PDO::PARAM_INT);
        $smtp->bindParam(6, $valor_consulta, PDO::PARAM_STR);
        $smtp->bindParam(7, $voucher, PDO::PARAM_STR);
        $smtp->bindParam(8, $user_cad, PDO::PARAM_INT);
        $smtp->bindParam(9, $status, PDO::PARAM_INT);
        $smtp->bindParam(10, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Herval_agendamento($id, $id_unidade, $id_tipo_agendamento, $data_agendamento, $id_situacao, $id_medico, $valor_consulta, $voucher, $user_cad, $status) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE herval_agendamento SET id_unidade = :id_unidade,id_tipo_agendamento = :id_tipo_agendamento, data_agendamento = :data_agendamento,id_situacao = :id_situacao,
                id_medico = :id_medico,valor_consulta = :valor_consulta,voucher = :voucher,user_cad = :user_cad,status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_unidade' => $id_unidade,
            ':id_tipo_agendamento' => $id_tipo_agendamento,
            ':data_agendamento' => $data_agendamento,
            ':id_situacao' => $id_situacao,
            ':id_medico' => $id_medico,
            ':valor_consulta' => $valor_consulta,
            ':voucher' => $voucher,
            ':user_cad' => $user_cad,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Herval_agendamento($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE herval_agendamento SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_Herval_agendamentos($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_unidade,id_tipo_agendamento,data_agendamento,id_situacao,
                id_medico,valor_consulta,voucher,user_cad,status,data_ultima_alteracao from herval_agendamento where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Herval_agendamentos_via_voucher($voucher) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_unidade,id_tipo_agendamento,data_agendamento,id_situacao,
                id_medico,valor_consulta,voucher,user_cad,status,data_ultima_alteracao from herval_agendamento where voucher = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($voucher));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}