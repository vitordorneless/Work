<?php

class Medicos_Valores extends Medico {
    public function save_Medicos_Valores($id_medico, $id_convocacao, $id_evento_convocacao, $turnos, $valor, $data_fechamento_valores) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO medicos_valores(id_medico,id_convocacao,id_evento_convocacao,turnos,valor,data_fechamento_valores,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_medico, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_convocacao, PDO::PARAM_INT);
        $smtp->bindParam(3, $id_evento_convocacao, PDO::PARAM_INT);
        $smtp->bindParam(4, $turnos, PDO::PARAM_INT);
        $smtp->bindParam(5, $valor, PDO::PARAM_STR);
        $smtp->bindParam(6, $data_fechamento_valores, PDO::PARAM_STR);
        $smtp->bindParam(7, $status, PDO::PARAM_INT);
        $smtp->bindParam(8, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $saveConvocacao;
    }

    public function edit_Medicos_Valores($id, $id_medico, $id_convocacao, $id_evento_convocacao, $turnos, $valor, $data_fechamento_valores, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE medicos_valores SET id_medico = :id_medico, id_convocacao = :id_convocacao, id_evento_convocacao = :id_evento_convocacao,
             turnos = :turnos, valor = :valor, data_fechamento_valores = :data_fechamento_valores, status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id and id_medico = :id_medico");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_medico' => $id_medico,
            ':id_convocacao' => $id_convocacao,
            ':id_evento_convocacao' => $id_evento_convocacao,
            ':turnos' => $turnos,
            ':valor' => $valor,
            ':data_fechamento_valores' => $data_fechamento_valores,            
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $editConvocacao;
    }

    public function delete_Medicos_Valores($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE medicos_valores SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $deleteConvocacao;
    }

    public function Dados_Medicos_Valores($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_medico, id_medico_valores, id_evento_convocacao, turnos from medicos_valores where id_medico = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Medicos_Valores_max_id() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select MAX(id) as max from medicos_valores";
        $q = $pdo->prepare($sql);
        $q->execute(array());
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $max = $data['max'] == NULL ? 0 : $data['max'];
        Database::disconnect();
        return $max;
    }
}
