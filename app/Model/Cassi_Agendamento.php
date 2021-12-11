<?php

class Cassi_Agendamento extends Cassi {

    public function save_Cassi_Agendamento($municipio, $data_agendamento, $horario, $id_cassi_situacao, $id_medico, $valor_consulta, $usuario) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');        
        $pdo = Database::connect();//municipio recebe o id da agencia - help do vitao
        $smtp = $pdo->prepare("INSERT INTO cassi_agendamento(municipio,data_agendamento,horario,id_cassi_situacao,id_medico,valor_consulta,user_agendamento,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $municipio, PDO::PARAM_STR);
        $smtp->bindParam(2, $data_agendamento, PDO::PARAM_STR);
        $smtp->bindParam(3, $horario, PDO::PARAM_STR);
        $smtp->bindParam(4, $id_cassi_situacao, PDO::PARAM_INT);
        $smtp->bindParam(5, $id_medico, PDO::PARAM_INT);
        $smtp->bindParam(6, $valor_consulta, PDO::PARAM_STR);
        $smtp->bindParam(7, $usuario, PDO::PARAM_INT);
        $smtp->bindParam(8, $status, PDO::PARAM_INT);
        $smtp->bindParam(9, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Cassi_Agendamento($id, $municipio, $data_agendamento, $horario, $id_cassi_situacao, $id_medico, $valor_consulta, $usuario, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cassi_agendamento SET municipio = :municipio, data_agendamento = :data_agendamento,                 
            horario = :horario, id_cassi_situacao = :id_cassi_situacao, id_medico = :id_medico,
            valor_consulta = :valor_consulta, user_agendamento = :user_agendamento,
                status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':municipio' => $municipio,
            ':data_agendamento' => $data_agendamento,
            ':horario' => $horario,
            ':id_cassi_situacao' => $id_cassi_situacao,
            ':id_medico' => $id_medico,
            ':valor_consulta' => $valor_consulta,
            ':user_agendamento' => $usuario,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Cassi_Agendamento($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cassi_agendamento SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_Cassi_Agendamentos($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,municipio,data_agendamento,horario,id_cassi_situacao,id_medico,valor_consulta,user_agendamento,status,data_ultima_alteracao from cassi_agendamento where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Cassi_Agendamentos_lista($agencia) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select DATE_FORMAT(data_agendamento,'%d/%c/%Y') as data_agendamento,horario,municipio from cassi_agendamento where municipio = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($agencia));
        $data = $q->fetch(PDO::FETCH_ASSOC);        
        Database::disconnect();
        return $data;
    }
    
    public function Quantos_ativos_este_agendamento_pegou($prefixo) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(atiti.id) as quantos
                from cassi_ativos atiti
                inner join cassi_agencia agegen on agegen.prefixo = atiti.prefixo_agencia
                where agegen.id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($prefixo));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $quantos = $data['quantos'];
        return $quantos;
    }
}