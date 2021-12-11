<?php

class Demanda_Pai extends Demanda {
    public function saveDemanda($id_user_abertura,$id_user_abertura_setor,$id_demanda,$obs,$id_prazo,$id_status,$id_status_qualidade,$data_abertura,$data_fechamento) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO demanda_pai(id_user_abertura,id_user_abertura_setor,id_demanda,obs,id_prazo,id_status,id_status_qualidade,data_abertura,
            data_fechamento,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_user_abertura, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_user_abertura_setor, PDO::PARAM_INT);
        $smtp->bindParam(3, $id_demanda, PDO::PARAM_INT);
        $smtp->bindParam(4, $obs, PDO::PARAM_STR);
        $smtp->bindParam(5, $id_prazo, PDO::PARAM_INT);
        $smtp->bindParam(6, $id_status, PDO::PARAM_INT);
        $smtp->bindParam(7, $id_status_qualidade, PDO::PARAM_INT);
        $smtp->bindParam(8, $data_abertura, PDO::PARAM_STR);
        $smtp->bindParam(9, $data_fechamento, PDO::PARAM_STR);        
        $smtp->bindParam(10, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveDemanda = $confirm == TRUE ? TRUE : FALSE;
        return $saveDemanda;
    }

    public function editDemanda($id, $id_user_abertura,$id_user_abertura_setor,$id_demanda,$obs,$id_prazo,$id_status,$id_status_qualidade,$data_abertura,$data_fechamento) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE demanda_pai SET id_user_abertura =:id_user_abertura,id_user_abertura_setor =:id_user_abertura_setor,
                                id_demanda =:id_demanda,obs  =:obs,id_prazo =:id_prazo,id_status =:id_status,id_status_qualidade =:id_status_qualidade,data_abertura =:data_abertura,
                                data_fechamento  =:data_fechamento,data_ultima_alteracao =:data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,':id_user_abertura' => $id_user_abertura,':id_user_abertura_setor' => $id_user_abertura_setor,':id_demanda' => $id_demanda,':obs' => $obs,
            ':id_prazo' => $id_prazo,':id_status' => $id_status,':id_status_qualidade' => $id_status_qualidade,':data_abertura' => $data_abertura,
            ':data_fechamento' => $data_fechamento,':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editRisco = $confirm == TRUE ? TRUE : FALSE;
        return $editRisco;
    }    
    
    public function Dados_Demandas($id) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_user_abertura,id_user_abertura_setor,id_demanda,obs,id_prazo,id_status,id_status_qualidade,data_abertura,
            data_fechamento,data_ultima_alteracao from demanda_pai where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
