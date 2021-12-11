<?php

class Demanda_Execute extends Demanda {
    public function saveDemanda($id_demanda,$id_executante,$obs,$id_status_clone_demanda,$status_qualidade) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO demandas_execute(id_demanda,id_executante,obs,id_status_clone_demanda,id_status_qualidade,data_ultima_alteracao) VALUES(?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_demanda, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_executante, PDO::PARAM_INT);
        $smtp->bindParam(3, $obs, PDO::PARAM_STR);
        $smtp->bindParam(4, $id_status_clone_demanda, PDO::PARAM_INT);
        $smtp->bindParam(5, $status_qualidade, PDO::PARAM_INT);        
        $smtp->bindParam(6, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveDemanda = $confirm == TRUE ? TRUE : $pdo->errorInfo();
        return $saveDemanda;
    }

    public function editDemanda($id, $id_demanda,$id_executante,$obs,$id_status_clone_demanda,$status_qualidade,$data_ultima_alteracao) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE demandas_execute SET id_demanda = :id_demanda,id_executante = :id_executante,
                                obs = :obs,id_status_clone_demanda = :id_status_clone_demanda,
                                id_status_qualidade = :id_status_qualidade,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_demanda' => $id_demanda,
            ':id_executante' => $id_executante,
            ':obs' => $obs,
            ':id_status_clone_demanda' => $id_status_clone_demanda,
            ':id_status_qualidade' => $status_qualidade,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editRisco = $confirm == TRUE ? TRUE : FALSE;
        return $editRisco;
    }    
    
    public function Dados_Demandas($id) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_demanda,id_executante,obs,id_status_clone_demanda,id_status_qualidade,data_ultima_alteracao from demandas_execute where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Demandas_id_demanda($id) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_demanda,id_executante,obs,id_status_clone_demanda,id_status_qualidade,data_ultima_alteracao from demandas_execute where id_demanda = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Demandas_qualidade($id) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,status from demandas_status_qualidade where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}