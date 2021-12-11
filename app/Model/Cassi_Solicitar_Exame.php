<?php

class Cassi_Solicitar_Exame extends Cassi {
    public function save_Cassi_Solicitar_Exame($id_exame,$data_solicitacao,$nome_funcionario,$identidade,$cpf,$nascimento,$funcao,
            $id_cassi_solicitante,$id_prestador,$id_medico,$id_cidade_solicitada,$id_cidade_realizada,$turno,$prazo_limite,$horario,
            $data_exame,$obs,$usuario,$status) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO cassi_solicitar_exames(id_exame,data_solicitacao,nome_funcionario,identidade,
                cpf,nascimento,funcao,id_cassi_solicitante,id_prestador,id_medico,id_cidade_solicitada,id_cidade_realizada,turno,
                prazo_limite,horario,data_exame,obs,usuario,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_exame, PDO::PARAM_INT);
        $smtp->bindParam(2, $data_solicitacao, PDO::PARAM_STR);
        $smtp->bindParam(3, $nome_funcionario, PDO::PARAM_STR);
        $smtp->bindParam(4, $identidade, PDO::PARAM_STR);
        $smtp->bindParam(5, $cpf, PDO::PARAM_STR);
        $smtp->bindParam(6, $nascimento, PDO::PARAM_STR);
        $smtp->bindParam(7, $funcao, PDO::PARAM_STR);
        $smtp->bindParam(8, $id_cassi_solicitante, PDO::PARAM_INT);
        $smtp->bindParam(9, $id_prestador, PDO::PARAM_INT);
        $smtp->bindParam(10, $id_medico, PDO::PARAM_INT);
        $smtp->bindParam(11, $id_cidade_solicitada, PDO::PARAM_INT);
        $smtp->bindParam(12, $id_cidade_realizada, PDO::PARAM_INT);
        $smtp->bindParam(13, $turno, PDO::PARAM_INT);
        $smtp->bindParam(14, $prazo_limite, PDO::PARAM_STR);
        $smtp->bindParam(15, $horario, PDO::PARAM_STR);
        $smtp->bindParam(16, $data_exame, PDO::PARAM_STR);
        $smtp->bindParam(17, $obs, PDO::PARAM_STR);
        $smtp->bindParam(18, $usuario, PDO::PARAM_INT);
        $smtp->bindParam(19, $status, PDO::PARAM_INT);
        $smtp->bindParam(20, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Cassi_Solicitar_Exame($id, $id_exame,$data_solicitacao,$nome_funcionario,$identidade,$cpf,$nascimento,$funcao,
            $id_cassi_solicitante,$id_prestador,$id_medico,$id_cidade_solicitada,$id_cidade_realizada,$turno,$prazo_limite,$horario,
            $data_exame,$obs,$usuario, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cassi_solicitar_exames SET id_exame = :id_exame,data_solicitacao = :data_solicitacao,nome_funcionario = :nome_funcionario,identidade = :identidade,
                cpf = :cpf,nascimento = :nascimento,funcao = :funcao,id_cassi_solicitante = :id_cassi_solicitante,id_prestador = :id_prestador,id_medico = :id_medico,id_cidade_solicitada = :id_cidade_solicitada,id_cidade_realizada = :id_cidade_realizada,turno = :turno,
                prazo_limite = :prazo_limite,horario = :horario,data_exame = :data_exame,obs = :obs,usuario = :usuario, status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_exame' => $id_exame,
            ':data_solicitacao' => $data_solicitacao,
            ':nome_funcionario' => $nome_funcionario,
            ':identidade' => $identidade,
            ':cpf' => $cpf,
            ':nascimento' => $nascimento,
            ':funcao' => $funcao,
            ':id_cassi_solicitante' => $id_cassi_solicitante,
            ':id_prestador' => $id_prestador,
            ':id_medico' => $id_medico,
            ':id_cidade_solicitada' => $id_cidade_solicitada,
            ':id_cidade_realizada' => $id_cidade_realizada,
            ':turno' => $turno,
            ':prazo_limite' => $prazo_limite,
            ':horario' => $horario,
            ':data_exame' => $data_exame,
            ':obs' => $obs,
            ':usuario' => $usuario,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Cassi_Solicitar_Exame($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cassi_solicitar_exames SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteMedico = $confirm == TRUE ? TRUE : FALSE;
        return $deleteMedico;
    }

    public function Dados_Cassi_Solicitar_Exames($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_exame,data_solicitacao,nome_funcionario,identidade,
                cpf,nascimento,funcao,id_cassi_solicitante,id_prestador,id_medico,id_cidade_solicitada,id_cidade_realizada,turno,
                prazo_limite,horario,data_exame,obs,usuario,status,data_ultima_alteracao from cassi_solicitar_exames where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
