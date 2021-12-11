<?php

class Chamados_Improcedentes extends Chamado {

    public function save_Chamado_Improcedente($id_chamado, $protocolo, $motivo_encerramento, $obs, $usuario_encerramento, $data_abertura_chamado) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $status = 3;

        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO chamado_improcedente(id_chamado,protocolo,motivo_encerramento,obs,
            usuario_encerramento,data_abertura_chamado,data_ultima_alteracao,status) 
                VALUES(?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_chamado, PDO::PARAM_INT);
        $smtp->bindParam(2, $protocolo, PDO::PARAM_INT);
        $smtp->bindParam(3, $motivo_encerramento, PDO::PARAM_STR);
        $smtp->bindParam(4, $obs, PDO::PARAM_STR);
        $smtp->bindParam(5, $usuario_encerramento, PDO::PARAM_INT);
        $smtp->bindParam(6, $data_abertura_chamado, PDO::PARAM_STR);
        $smtp->bindParam(7, $data_ultima_alteracao, PDO::PARAM_STR);
        $smtp->bindParam(8, $status, PDO::PARAM_INT);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveChamado = $confirm == TRUE ? TRUE : FALSE;
        return $saveChamado;
    }

    public function edit_Chamado_Improcedente($id, $id_chamado, $protocolo, $motivo_encerramento, $obs, $usuario_encerramento, $data_abertura_chamado, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado_improcedente SET id_chamado = :id_chamado, protocolo = :protocolo, motivo_encerramento = :motivo_encerramento,
                obs = :obs, usuario_encerramento = :usuario_encerramento, data_abertura_chamado = :data_abertura_chamado, 
                data_ultima_alteracao = :data_ultima_alteracao, status = :status WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_chamado' => $id_chamado,
            ':protocolo' => $protocolo,
            ':motivo_encerramento' => $motivo_encerramento,
            ':obs' => $obs,
            ':usuario_encerramento' => $usuario_encerramento,
            ':data_abertura_chamado' => $data_abertura_chamado,
            ':data_ultima_alteracao' => $data_ultima_alteracao,
            ':status' => $status));
        Database::disconnect();
        $editChamado = $confirm == TRUE ? TRUE : FALSE;
        return $editChamado;
    }

    public function delete_Chamado_Improcedente($id) {
        include_once '../config/database_mysql.php';
        $status = 3;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado_improcedente SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteDemanda = $confirm == TRUE ? TRUE : FALSE;
        return $deleteDemanda;
    }

    public function Dados_Chamado_Improcedentes($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_chamado, protocolo, motivo_encerramento, obs, usuario_encerramento, data_abertura_chamado, data_ultima_alteracao, status from chamado_improcedente where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Chamados_Improcedentes_report() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as conta from chamado_improcedente where status = 3";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $conta = $data['conta'];
        return $conta;
    }
    
    public function Chamado_Improcedentes_por_Usuario($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as contar from chamado_improcedente where usuario_encerramento = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $user = $data['contar'];
        return $user;
    }
    
    public function Chamado_Improcedentes_por_Datas($begin,$end) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as contar from chamado_improcedente where DATE(data_abertura_chamado) BETWEEN ? AND ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($begin,$end));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $user = $data['contar'];
        return $user;
    }
    
    public function Chamado_Improcedentes_por_Datas_more_user($begin,$end, $usuario) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as contar from chamado_improcedente where DATE(data_abertura_chamado) BETWEEN ? AND ? and usuario_encerramento = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($begin,$end,$usuario));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $user = $data['contar'];
        return $user;
    }
}