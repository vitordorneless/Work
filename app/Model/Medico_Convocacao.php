<?php

class Medico_Convocacao extends Medico {

    public function save_Medico_Convocacao($id_medico, $id_medico_valores, $id_evento_convocacao) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO medicos_convocacao(id_medico,id_medicos_valores,id_evento_convocacao,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?)");
        $smtp->bindParam(1, $id_medico, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_medico_valores, PDO::PARAM_INT);
        $smtp->bindParam(3, $id_evento_convocacao, PDO::PARAM_INT);
        $smtp->bindParam(4, $status, PDO::PARAM_INT);
        $smtp->bindParam(5, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $saveConvocacao;
    }

    public function edit_Medico_Convocacao($id, $id_medico, $id_medico_valores, $id_evento_convocacao, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE medicos_convocacao SET id_medico = :id_medico, id_medicos_valores = :id_medicos_valores, id_evento_convocacao = :id_evento_convocacao,
             status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id and id_medico = :id_medico");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_medico' => $id_medico,
            ':id_medicos_valores' => $id_medico_valores,
            ':id_evento_convocacao' => $id_evento_convocacao,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $editConvocacao;
    }
    
    public function edit_Medico_Convocacao_id($id_medico_valores, $id_evento_convocacao) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE medicos_convocacao SET id_medicos_valores = :id_medicos_valores,
                data_ultima_alteracao = :data_ultima_alteracao WHERE id_evento_convocacao = :id_evento_convocacao");
        $confirm = $smtpup->execute(array(
            ':id_medicos_valores' => $id_medico_valores,
            ':id_evento_convocacao' => $id_evento_convocacao,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $editConvocacao;
    }

    public function delete_Medico_Convocacao($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE medicos_convocacao SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $deleteConvocacao;
    }

    public function Dados_Medico_Convocacao($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_medico, id_medico_valores, id_evento_convocacao from medicos_convocacao where id_medico = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Medico_Convocacao_completos($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT mediquim.nome as nome, dimdim.turnos as turnos, dimdim.valor as valor
                FROM medicos_convocacao concocacacaca
                inner join wal_medico mediquim on mediquim.id_medico = concocacacaca.id_medico 
                inner join medicos_valores dimdim on dimdim.id = concocacacaca.id_medicos_valores
                where concocacacaca.id_evento_convocacao = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}