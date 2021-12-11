<?php

class RH_Grau_Instrucao_Escolar extends Recursos_Humanos {
    public function save_RH_Grau_Instrucao_Escolar($rh_grau_instrucao_escolar) {
        include_once '../config/database_mysql.php';                
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO rh_grau_instrucao_escolar(grau,status,data_ultima_alteracao) VALUES(?,?,?)");
        $smtp->bindParam(1, $rh_grau_instrucao_escolar, PDO::PARAM_STR);        
        $smtp->bindParam(2, $status, PDO::PARAM_INT);
        $smtp->bindParam(3, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_RH_Grau_Instrucao_Escolar($id,$grau,$status) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE rh_grau_instrucao_escolar SET grau = :grau, 
                status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':grau' => $grau,            
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_RH_Grau_Instrucao_Escolar($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE rh_grau_instrucao_escolar SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_RH_Grau_Instrucao_Escolars($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,grau,status,data_ultima_alteracao from rh_grau_instrucao_escolar where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
