<?php

class Demanda_Filho extends Demanda {
    public function saveDemanda($id_demanda_pai,$id_user_abertura,$id_user_abertura_setor,$id_demanda,$obs,$id_prazo,$id_executante,$obs_execute,$id_status,$id_status_qualidade,$data_abertura,$data_fechamento) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO id,id_demanda_pai,id_user_abertura,id_user_abertura_setor,id_demanda,obs,id_prazo,id_executante,obs_execute,id_status,id_status_qualidade,data_abertura,data_fechamento,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_demanda_pai, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_user_abertura, PDO::PARAM_INT);
        $smtp->bindParam(3, $id_user_abertura_setor, PDO::PARAM_INT);
        $smtp->bindParam(4, $id_demanda, PDO::PARAM_INT);
        $smtp->bindParam(5, $obs, PDO::PARAM_STR);
        $smtp->bindParam(6, $id_prazo, PDO::PARAM_INT);
        $smtp->bindParam(7, $id_executante, PDO::PARAM_INT);
        $smtp->bindParam(8, $obs_execute, PDO::PARAM_STR);
        $smtp->bindParam(9, $id_status, PDO::PARAM_INT);
        $smtp->bindParam(10, $id_status_qualidade, PDO::PARAM_INT);
        $smtp->bindParam(11, $data_abertura, PDO::PARAM_STR);
        $smtp->bindParam(12, $data_fechamento, PDO::PARAM_STR);        
        $smtp->bindParam(13, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveDemanda = $confirm == TRUE ? TRUE : FALSE;
        return $saveDemanda;
    }

    public function editDemanda($id, $id_demanda_pai,$id_user_abertura,$id_user_abertura_setor,$id_demanda,$obs,$id_prazo,$id_executante,$obs_execute,$id_status,$id_status_qualidade,$data_abertura,$data_fechamento) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE demanda_filho SET id =:id,id_demanda_pai =:id_demanda_pai,id_user_abertura =:id_user_abertura,id_user_abertura_setor =:id_user_abertura_setor,
                                id_demanda =:id_demanda,obs =:obs,id_prazo =:id_prazo,id_executante =:id_executante,obs_execute =:obs_execute,id_status =:id_status,
                                id_status_qualidade =:id_status_qualidade,data_abertura =:data_abertura,data_fechamento =:data_fechamento,data_ultima_alteracao =:data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,':id_demanda_pai' => $id_demanda_pai,':id_user_abertura' => $id_user_abertura,':id_user_abertura_setor' => $id_user_abertura_setor,
            ':id_demanda' => $id_demanda,':obs' => $obs,':id_prazo' => $id_prazo,':id_executante' => $id_executante,':obs_execute' => $obs_execute,
            ':id_status' => $id_status,':id_status_qualidade' => $id_status_qualidade,':data_abertura' => $data_abertura,':data_fechamento' => $data_fechamento,':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editRisco = $confirm == TRUE ? TRUE : FALSE;
        return $editRisco;
    }    
    
    public function Dados_Demandas($id) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_user_abertura,id_user_abertura_setor,id_demanda,obs,id_prazo,id_status,id_status_qualidade,data_abertura,
            data_fechamento,data_ultima_alteracao from demanda_filho where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
