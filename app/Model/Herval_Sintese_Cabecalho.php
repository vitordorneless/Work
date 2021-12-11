<?php

class Herval_Sintese_Cabecalho extends Herval {

    public function save_Herval_Agendamento($id_empresa, $id_unidade, $cnpj, $inscricao_estadual, $cnae, $grau_risco, $media_empregados,$endereco, $atividades_realizadas, $local_atividades_realizadas) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO herval_sinteses_cab(id_empresa,id_unidade,cnpj,inscricao_estadual,cnae,media_empregados,grau_risco,endereco,atividades_realizadas,local_atividades_realizadas,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_empresa, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_unidade, PDO::PARAM_INT);
        $smtp->bindParam(3, $cnpj, PDO::PARAM_STR);
        $smtp->bindParam(4, $inscricao_estadual, PDO::PARAM_STR);
        $smtp->bindParam(5, $cnae, PDO::PARAM_STR);
        $smtp->bindParam(6, $media_empregados, PDO::PARAM_INT);
        $smtp->bindParam(7, $grau_risco, PDO::PARAM_STR);
        $smtp->bindParam(8, $endereco, PDO::PARAM_STR);
        $smtp->bindParam(9, $atividades_realizadas, PDO::PARAM_STR);
        $smtp->bindParam(10, $local_atividades_realizadas, PDO::PARAM_STR);
        $smtp->bindParam(11, $status, PDO::PARAM_INT);
        $smtp->bindParam(12, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Herval_Agendamento($id, $id_empresa, $id_unidade, $cnpj, $inscricao_estadual, $cnae, $media_empregados,$grau_risco, $endereco, $atividades_realizadas, $local_atividades_realizadas, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE herval_sinteses_cab SET id_empresa = :id_empresa, id_unidade = :id_unidade,
            cnpj = :cnpj, inscricao_estadual = :inscricao_estadual, cnae = :cnae, media_empregados = :media_empregados,
            grau_risco = :grau_risco, endereco = :endereco,atividades_realizadas = :atividades_realizadas, local_atividades_realizadas = :local_atividades_realizadas,
                status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_empresa' => $id_empresa,
            ':id_unidade' => $id_unidade,
            ':cnpj' => $cnpj,
            ':inscricao_estadual' => $inscricao_estadual,
            ':cnae' => $cnae,
            ':media_empregados' => $media_empregados,
            ':grau_risco' => $grau_risco,
            ':endereco' => $endereco,
            ':atividades_realizadas' => $atividades_realizadas,
            ':local_atividades_realizadas' => $local_atividades_realizadas,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Herval_Agendamento($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE herval_sinteses_cab SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_Herval_Agendamentos($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_empresa,id_unidade,cnpj,inscricao_estadual,cnae,media_empregados,grau_risco,endereco,atividades_realizadas,local_atividades_realizadas,status,data_ultima_alteracao from herval_sinteses_cab where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Herval_Unidades($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select unidade from herval_unidades where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $unidade = $data['unidade'];
        Database::disconnect();
        return $unidade;
    }
}