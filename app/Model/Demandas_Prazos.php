<?php

class Demandas_Prazos extends Demanda {
    public function saveDemanda($prazo,$tipo) {
        include_once '../config/database_mysql.php';        
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO demandas_prazos(prazo,tipo,status,data_ultima_alteracao) VALUES(?,?,?,?)");
        $smtp->bindParam(1, $prazo, PDO::PARAM_STR);
        $smtp->bindParam(2, $tipo, PDO::PARAM_STR);
        $smtp->bindParam(3, $status, PDO::PARAM_INT);
        $smtp->bindParam(4, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveDemanda = $confirm == TRUE ? TRUE : FALSE;
        return $saveDemanda;
    }

    public function editDemanda($id, $prazo,$tipo,$status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE demandas_prazos SET prazo = :prazo, tipo = :tipo, status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,':prazo' => $prazo,':tipo' => $tipo,':status' => $status,':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editRisco = $confirm == TRUE ? TRUE : FALSE;
        return $editRisco;
    }    
    
    public function Dados_Demandas($id) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, prazo,tipo,status from demandas_prazos where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
