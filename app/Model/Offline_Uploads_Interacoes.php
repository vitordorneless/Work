<?php

class Offline_Uploads_Interacoes extends Offline_Uploads {
    public function save_Offline_Uploads_Interacoes($nome_arquivo,$nome_medico,$crm) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO offline_uploads(nome_arquivo,nome_medico,crm,status,data_ultima_alteracao) VALUES(?,?,?,?,?)");
        $smtp->bindParam(1, $nome_arquivo, PDO::PARAM_STR);        
        $smtp->bindParam(2, $nome_medico, PDO::PARAM_STR);        
        $smtp->bindParam(3, $crm, PDO::PARAM_STR);        
        $smtp->bindParam(4, $status, PDO::PARAM_INT);        
        $smtp->bindParam(5, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }
    
    public function Dados_Offline_Uploads_Interacoes($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,nome_arquivo,nome_medico,crm,status,data_ultima_alteracao from offline_uploads where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);        
        Database::disconnect();
        return $data;
    }
}