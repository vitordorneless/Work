<?php

class Coordenador_PCMSO extends Medico {
    public function save_Coordenador_PCMSO($nome, $cargo, $conselho, $crm) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO pcmso_coordenadores(nome,cargo,conselho,crm,ativo,data_ultima_alteracao) VALUES(?,?,?,?,?,?)");
        $smtp->bindParam(1, $nome, PDO::PARAM_STR);
        $smtp->bindParam(2, $cargo, PDO::PARAM_STR);
        $smtp->bindParam(3, $conselho, PDO::PARAM_STR);
        $smtp->bindParam(4, $crm, PDO::PARAM_STR);        
        $smtp->bindParam(5, $status, PDO::PARAM_INT);        
        $smtp->bindParam(6, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Coordenador_PCMSO($id, $nome, $cargo, $conselho, $crm, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();                       
        $smtpup = $pdo->prepare("UPDATE pcmso_coordenadores SET nome = :nome, cargo = :cargo,
                conselho = :conselho, crm = :crm, ativo = :ativo, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,':nome' => $nome,':cargo' => $cargo,':conselho' => $conselho,
            ':crm' => $crm,':ativo' => $status,':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }    
    
    public function delete_Coordenador_PCMSO($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE pcmso_coordenadores SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_Coordenador_PCMSO($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, nome,cargo,conselho,crm,ativo,data_ultima_alteracao from pcmso_coordenadores where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}