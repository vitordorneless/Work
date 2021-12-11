<?php

class Chamados_Analise extends Chamado {

    public function save_Chamado_Analise($id_chamado, $protocolo, $id_usuario, $data_entrada, $prazo, $validade, $procedente, $status, $executante, $emergencial) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');

        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO chamado_analise(id_chamado,protocolo,id_usuario,data_entrada,prazo,validade,procedente,status,executante,emergencial,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_chamado, PDO::PARAM_INT);
        $smtp->bindParam(2, $protocolo, PDO::PARAM_INT);
        $smtp->bindParam(3, $id_usuario, PDO::PARAM_INT);
        $smtp->bindParam(4, $data_entrada, PDO::PARAM_STR);
        $smtp->bindParam(5, $prazo, PDO::PARAM_INT);
        $smtp->bindParam(6, $validade, PDO::PARAM_INT);
        $smtp->bindParam(7, $procedente, PDO::PARAM_STR);
        $smtp->bindParam(8, $status, PDO::PARAM_INT);
        $smtp->bindParam(9, $executante, PDO::PARAM_INT);
        $smtp->bindParam(10, $emergencial, PDO::PARAM_INT);
        $smtp->bindParam(11, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveChamado = $confirm == TRUE ? TRUE : FALSE;
        return $saveChamado;
    }

    public function edit_Chamado_Analise($id, $id_chamado, $protocolo, $id_usuario, $data_entrada, $prazo, $validade, $procedente, $status, $executante, $emergencial) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado_analise SET id_chamado = :id_chamado, protocolo = :protocolo, id_usuario = :id_usuario, data_entrada = :data_entrada, 
                prazo = :prazo, validade = :validade, 
                procedente = :procedente, status = :status, executante = :executante, 
                emergencial = :emergencial, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_chamado' => $id_chamado,
            ':protocolo' => $protocolo,
            ':id_usuario' => $id_usuario,
            ':data_entrada' => $data_entrada,
            ':prazo' => $prazo,
            ':validade' => $validade,
            ':procedente' => $procedente,
            ':status' => $status,
            ':executante' => $executante,
            ':emergencial' => $emergencial,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editRisco = $confirm == TRUE ? TRUE : FALSE;
        return $editRisco;
    }

    public function delete_Chamado_Analise($id) {
        include_once '../config/database_mysql.php';
        $status = 3;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado_analise SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteDemanda = $confirm == TRUE ? TRUE : FALSE;
        return $deleteDemanda;
    }

    public function Dados_Chamado_Analises($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_chamado, protocolo, id_usuario, data_entrada, prazo, validade, procedente, 
                status, executante, emergencial, data_ultima_alteracao from chamado_analise where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function edit_status_Chamado_Analise($id, $status, $executante) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado_analise SET status = :status, executante = :executante, data_ultima_alteracao = :data_ultima_alteracao WHERE id_chamado = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':executante' => $executante,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editstatus = $confirm == TRUE ? TRUE : FALSE;
        return $editstatus;
    }
    
    public function Chamados_em_Execucao() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as conta from chamado_analise where status = 2";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $conta = $data['conta'];
        return $conta;
    }
    
    public function Chamados_em_Execucao_Usuario($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as conta from chamado_analise where status = 2 and executante = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $conta = $data['conta'];
        return $conta;
    }
    
    public function Chamados_em_Execucao_por_Datas($begin, $end) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as conta from chamado_analise where status = 2 and DATE(data_entrada) BETWEEN ? AND ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($begin,$end));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $conta = $data['conta'];
        return $conta;
    }
    
    public function Chamados_em_Execucao_por_Datas_more_user($begin, $end, $usuario) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as conta from chamado_analise where status = 2 and DATE(data_entrada) BETWEEN ? AND ? and executante = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($begin,$end,$usuario));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $conta = $data['conta'];
        return $conta;
    }
}