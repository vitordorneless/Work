<?php

class Prospeccao_Medicos_e_Prestadores extends Medico {
    public function save_Prospeccao_Medicos_e_Prestadores($id_prestador, $id_medico,$data_prospeccao,$historico_prospeccao,$valor_exame, $lojas_negociadas, $usuario) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO prospeccao_medicos(id_prestador,id_medico,data_prospeccao,historico_prospeccao,valor_exame,lojas_negociadas,user,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_prestador, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_medico, PDO::PARAM_INT);
        $smtp->bindParam(3, $data_prospeccao, PDO::PARAM_STR);
        $smtp->bindParam(4, $historico_prospeccao, PDO::PARAM_STR);
        $smtp->bindParam(5, $valor_exame, PDO::PARAM_STR);
        $smtp->bindParam(6, $lojas_negociadas, PDO::PARAM_STR);
        $smtp->bindParam(7, $usuario, PDO::PARAM_INT);
        $smtp->bindParam(8, $status, PDO::PARAM_INT);
        $smtp->bindParam(9, $data_ultima_alteracao, PDO::PARAM_STR);        
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Prospeccao_Medicos_e_Prestadores($id, $id_prestador, $id_medico,$data_prospeccao,$historico_prospeccao,$valor_exame, $lojas_negociadas, $status) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE prospeccao_medicos SET id_prestador = :id_prestador,id_medico = :id_medico,
            data_prospeccao = :data_prospeccao,historico_prospeccao = :historico_prospeccao,valor_exame = :valor_exame,
            lojas_negociadas = :lojas_negociadas,status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,':id_prestador' => $id_prestador,':id_medico' => $id_medico,':data_prospeccao' => $data_prospeccao,
            ':historico_prospeccao' => $historico_prospeccao,':valor_exame' => $valor_exame,':lojas_negociadas' => $lojas_negociadas,            
            ':status' => $status,':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Prospeccao_Medicos_e_Prestadores($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE prospeccao_medicos SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_Prospeccao_Medicos_e_Prestadoress($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_prestador,id_medico,data_prospeccao,historico_prospeccao,valor_exame,lojas_negociadas,status,data_ultima_alteracao from prospeccao_medicos where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Prospeccao_Medicos_e_Prestadoresss($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as tem_medico from prospeccao_medicos where id_medico <> 0 and id_prestador = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
