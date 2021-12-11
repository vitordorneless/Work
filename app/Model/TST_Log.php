<?php

class TST_Log extends Tecnicos_Seguranca_Trabalho {
    public function save_TST_Log($tarefa, $user,$data_tarefa,$tarefa_concluida) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO tst_log(tarefa,user,data_tarefa,tarefa_concluida,data_ultima_alteracao) VALUES(?,?,?,?,?)");
        $smtp->bindParam(1, $tarefa, PDO::PARAM_STR);
        $smtp->bindParam(2, $user, PDO::PARAM_INT);
        $smtp->bindParam(3, $data_tarefa, PDO::PARAM_STR);
        $smtp->bindParam(4, $tarefa_concluida, PDO::PARAM_INT);        
        $smtp->bindParam(5, $data_ultima_alteracao, PDO::PARAM_STR);        
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_TST_Log($id, $tarefa, $user,$data_tarefa,$tarefa_concluida) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_log SET tarefa = :tarefa,user = :user,data_tarefa = :data_tarefa,tarefa_concluida = :tarefa_concluida,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':tarefa' => $tarefa,
            ':user' => $user,
            ':data_tarefa' => $data_tarefa,
            ':tarefa_concluida' => $tarefa_concluida,            
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_TST_Log($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_log SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_TST_Logs($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,tarefa,user,data_tarefa,tarefa_concluida,data_ultima_alteracao from tst_log where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
