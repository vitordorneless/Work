<?php

class Solucao_Demandas extends Demanda {
    public function save_Solucao_Demanda($id_demanda,$solucao_demanda, $prazo) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');

        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO solucao_demanda(id_demanda,desc_solucao,prazo,status,data_ultima_alteracao) VALUES(?,?,?,?,?)");
        $smtp->bindParam(1, $id_demanda, PDO::PARAM_INT);
        $smtp->bindParam(2, $solucao_demanda, PDO::PARAM_STR);
        $smtp->bindParam(3, $prazo, PDO::PARAM_INT);
        $smtp->bindParam(4, $status, PDO::PARAM_INT);
        $smtp->bindParam(5, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveDemanda = $confirm == TRUE ? TRUE : FALSE;
        return $saveDemanda;
    }

    public function edit_Solucao_Demanda($id, $id_demanda,$solucao_demanda, $prazo, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE solucao_demanda SET id_demanda = :id_demanda, desc_solucao = :desc_solucao, prazo = :prazo, status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_demanda' => $id_demanda,
            ':desc_solucao' => $solucao_demanda,
            ':prazo' => $prazo,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editRisco = $confirm == TRUE ? TRUE : FALSE;
        return $editRisco;
    }

    public function delete_Solucao_Demanda($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE solucao_demanda SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteDemanda = $confirm == TRUE ? TRUE : FALSE;
        return $deleteDemanda;
    }
    
    public function Dados_Solucao_Demandas($id) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_demanda, desc_solucao, prazo, status from solucao_demanda where status = 1 and id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
