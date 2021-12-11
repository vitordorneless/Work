<?php

class Datas_Eventos_Convocacao extends Convocar {

    public function save_Datas_Eventos_Convocacao($id_evento, $data_evento, $horario, $horario_final) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO datas_eventos_convocacao(id_evento_convocacao,data_evento,horario,horario_final,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_evento, PDO::PARAM_INT);
        $smtp->bindParam(2, $data_evento, PDO::PARAM_STR);
        $smtp->bindParam(3, $horario, PDO::PARAM_STR);
        $smtp->bindParam(4, $horario_final, PDO::PARAM_STR);
        $smtp->bindParam(5, $status, PDO::PARAM_INT);
        $smtp->bindParam(6, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $saveConvocacao;
    }

    public function edit_Datas_Eventos_Convocacao($id, $id_evento, $data_evento, $horario, $status, $horario_final) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE datas_eventos_convocacao SET data_evento = :data_evento, horario = :horario, horario_final = :horario_final, status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id and id_evento = :id_evento");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_evento' => $id_evento,
            ':data_evento' => $data_evento,
            ':horario' => $horario,
            ':horario_final' => $horario_final,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $editConvocacao;
    }
    
    public function edit_Horarios_Datas_Eventos_Convocacao($id, $data_evento, $horario, $horario_final) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE datas_eventos_convocacao SET data_evento = :data_evento, horario = :horario, horario_final = :horario_final, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':data_evento' => $data_evento,
            ':horario' => $horario,
            ':horario_final' => $horario_final,            
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $editConvocacao;
    }

    public function delete_Datas_Eventos_Convocacao($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE datas_eventos_convocacao SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $deleteConvocacao;
    }

    public function Dados_Datas_Eventos_Convocacao($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_evento_convocacao, data_evento, horario, horario_final from datas_eventos_convocacao where id_evento_convocacao = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Datas_Eventos_Convocacao_id($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_evento_convocacao, data_evento, horario, horario_final from datas_eventos_convocacao where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Datas_Eventos_Convocacao_max_id() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select MAX(id) as max from datas_eventos_convocacao";
        $q = $pdo->prepare($sql);
        $q->execute(array());
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $max = $data['max'] == NULL ? 0 : $data['max'];
        Database::disconnect();
        return $max;
    }
}