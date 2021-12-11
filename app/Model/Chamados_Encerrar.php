<?php

class Chamados_Encerrar extends Chamado {
    public function save_Chamado_Encerrar($id_chamado, $protocolo, $usuario_encerramento, $obs, $encerramento, $status, $executante, $emergencial) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');

        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO chamado_encerrado(id_chamado,protocolo,usuario_encerramento,obs,encerramento,status,executante,emergencial,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_chamado, PDO::PARAM_INT);
        $smtp->bindParam(2, $protocolo, PDO::PARAM_INT);
        $smtp->bindParam(3, $usuario_encerramento, PDO::PARAM_INT);
        $smtp->bindParam(4, $obs, PDO::PARAM_STR);
        $smtp->bindParam(5, $encerramento, PDO::PARAM_STR);
        $smtp->bindParam(6, $status, PDO::PARAM_INT);
        $smtp->bindParam(7, $executante, PDO::PARAM_INT);
        $smtp->bindParam(8, $emergencial, PDO::PARAM_INT);
        $smtp->bindParam(9, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveChamado = $confirm == TRUE ? TRUE : FALSE;
        return $saveChamado;
    }

    public function edit_Chamado_Encerrar($id, $id_chamado, $protocolo, $usuario_encerramento, $obs, $encerramento, $status, $executante, $emergencial) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado_encerrado SET id_chamado = :id_chamado, protocolo = :protocolo, usuario_encerramento = :usuario_encerramento,
                obs = :obs, encerramento = :encerramento, status = :status, executante = :executante, 
                emergencial = :emergencial, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_chamado' => $id_chamado,
            ':protocolo' => $protocolo,            
            ':usuario_encerramento' => $usuario_encerramento,
            ':obs' => $obs,
            ':encerramento' => $encerramento,            
            ':status' => $status,
            ':executante' => $executante,
            ':emergencial' => $emergencial,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editChamado = $confirm == TRUE ? TRUE : FALSE;
        return $editChamado;
    }

    public function delete_Chamado_Encerrar($id) {
        include_once '../config/database_mysql.php';
        $status = 3;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado_encerrado SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteDemanda = $confirm == TRUE ? TRUE : FALSE;
        return $deleteDemanda;
    }

    public function Dados_Chamado_Encerrar($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_chamado, protocolo, usuario_encerramento, obs, encerramento, status, data_ultima_alteracao from chamado_encerrado where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function edit_status_Chamado_Encerrar($id, $status) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado_encerrado SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id_chamado = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editstatus = $confirm == TRUE ? TRUE : FALSE;
        return $editstatus;
    }
    
    public function Chamados_Encerrados() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as conta from chamado_encerrado where status = 3";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $conta = $data['conta'];
        return $conta;
    }
    
    public function Chamado_Encerrar_por_Usuario($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as contar from chamado_encerrado where executante = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $user = $data['contar'];
        return $user;
    }
    
    public function Chamado_Encerrar_por_datas($begin,$end) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(encerra.id) as contar 
                from chamado_encerrado encerra
                inner join chamado_analise comeca on comeca.id = encerra.id_chamado
                where encerra.status = 3 and DATE(comeca.data_entrada) BETWEEN ? AND ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($begin,$end));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $user = $data['contar'];
        return $user;
    }
    
    public function Chamado_Encerrar_por_datas_more_user($begin,$end, $usuario) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(encerra.id) as contar 
                from chamado_encerrado encerra
                inner join chamado_analise comeca on comeca.id = encerra.id_chamado
                where encerra.status = 3 and DATE(comeca.data_entrada) BETWEEN ? AND ? and encerra.executante = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($begin,$end,$usuario));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $user = $data['contar'];
        return $user;
    }
}