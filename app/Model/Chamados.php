<?php

class Chamados extends Chamado {

    public function save_Chamado($id_usuario, $id_ativo, $cpf_ativo, $nome_ativo, 
            $demanda, $complemento_demanda, $id_dependente, $cpf_dependente,
            $nome_dependente, $loja, $emergencial) {
        include_once '../config/database_mysql.php';
        $protocol = new Chamados();
        $protocolo = $protocol->Protocolo_Chamados();
        $status = 1;
        $executante = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');

        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO chamado(protocolo,id_usuario,id_ativo,cpf_ativo,nome_ativo,id_dependente,
            cpf_dependente,nome_dependente,loja,demanda,complemento_demanda,status,executante,emergencial,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $protocolo, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_usuario, PDO::PARAM_INT);
        $smtp->bindParam(3, $id_ativo, PDO::PARAM_INT);
        $smtp->bindParam(4, $cpf_ativo, PDO::PARAM_INT);
        $smtp->bindParam(5, $nome_ativo, PDO::PARAM_STR);
        $smtp->bindParam(6, $id_dependente, PDO::PARAM_INT);
        $smtp->bindParam(7, $cpf_dependente, PDO::PARAM_INT);
        $smtp->bindParam(8, $nome_dependente, PDO::PARAM_STR);
        $smtp->bindParam(9, $loja, PDO::PARAM_STR);
        $smtp->bindParam(10, $demanda, PDO::PARAM_STR);
        $smtp->bindParam(11, $complemento_demanda, PDO::PARAM_STR);
        $smtp->bindParam(12, $status, PDO::PARAM_INT);
        $smtp->bindParam(13, $executante, PDO::PARAM_INT);
        $smtp->bindParam(14, $emergencial, PDO::PARAM_INT);
        $smtp->bindParam(15, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveChamado = $confirm == TRUE ? TRUE : FALSE;
        return $saveChamado;
    }

    public function edit_Chamado($id, $protocolo, $id_usuario, $id_ativo, $cpf_ativo, $nome_ativo, $demanda, 
            $complemento_demanda, $id_dependente, $cpf_dependente,$nome_dependente, $loja, $status, $emergencial) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $executante = 0;
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado SET protocolo = :protocolo, id_usuario = :id_usuario, id_ativo = :id_ativo, cpf_ativo = :cpf_ativo, 
                nome_ativo = :nome_ativo, id_dependente = :id_dependente, 
                cpf_dependente = :cpf_dependente, nome_dependente = :nome_dependente, loja = :loja, demanda = :demanda, complemento_demanda = :complemento_demanda, 
                status = :status, executante = :executante, emergencial = :emergencial, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':protocolo' => $protocolo,
            ':id_usuario' => $id_usuario,
            ':id_ativo' => $id_ativo,
            ':cpf_ativo' => $cpf_ativo,
            ':nome_ativo' => $nome_ativo,
            ':id_dependente' => $id_dependente,
            ':cpf_dependente' => $cpf_dependente,
            ':nome_dependente' => $nome_dependente,
            ':loja' => $loja,
            ':demanda' => $demanda,
            ':complemento_demanda' => $complemento_demanda,            
            ':status' => $status,
            ':executante' => $executante,
            ':emergencial' => $emergencial,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editRisco = $confirm == TRUE ? TRUE : FALSE;
        return $editRisco;
    }

    public function delete_Chamado($id) {
        include_once '../config/database_mysql.php';
        $status = 3;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteDemanda = $confirm == TRUE ? TRUE : FALSE;
        return $deleteDemanda;
    }
    
    public function edit_status_Chamado($id, $status, $executante) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado SET status = :status, executante = :executante, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':executante' => $executante,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editstatus = $confirm == TRUE ? TRUE : FALSE;
        return $editstatus;
    }

    public function Dados_Chamados($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, protocolo, id_usuario, id_ativo, cpf_ativo, nome_ativo, demanda, id_dependente, 
                cpf_dependente, nome_dependente, loja, complemento_demanda, status, executante, emergencial, 
                data_ultima_alteracao from chamado where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Protocolo_Chamados() {
        include_once '../config/database_mysql.php';
        $begin_protocol = date('Y');
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select max(id) as max from chamado";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $max = $data['max'] == NULL ? bcadd(0, 1) : bcadd($data['max'], 1);
        $protocol = $begin_protocol . $maxx = $max < 10 ? "0" . $max : $max;
        return $protocol;
    }
    
    public function novo_executante_Chamado($protocolo, $executante) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado SET executante = :executante, data_ultima_alteracao = :data_ultima_alteracao WHERE protocolo = :protocolo");
        $confirm = $smtpup->execute(array(
            ':protocolo' => $protocolo,
            ':executante' => $executante,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editstatus = $confirm == TRUE ? TRUE : FALSE;        
        return $editstatus;
    }
    
    public function novo_executante_Chamado_Analise($protocolo, $executante) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE chamado_analise SET executante = :executante, data_ultima_alteracao = :data_ultima_alteracao WHERE protocolo = :protocolo");
        $confirm = $smtpup->execute(array(
            ':protocolo' => $protocolo,            
            ':executante' => $executante,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editstatus = $confirm == TRUE ? TRUE : FALSE;        
        return $editstatus;
    }
    
    public function Chamados_Fila_de_Espera() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as conta from chamado where status = 1";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $conta = $data['conta'];
        return $conta;
    }
}