<?php

class Medicos extends Medico {

    public function save_Medico($nome, $crm, $id_funcao, $cod_sig, $ddd_telefone, $telefone, $cpf, $rg, $data_nascimento, $conselho, $CNES, $id_prestador, $obs, $email) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO wal_medico(nome,crm,cpf,rg,data_nascimento,conselho,id_funcao,id_prestador,cod_sig,CNES,ddd_telefone,telefone,email,obs,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $nome, PDO::PARAM_STR);
        $smtp->bindParam(2, $crm, PDO::PARAM_STR);
        $smtp->bindParam(3, $cpf, PDO::PARAM_STR);
        $smtp->bindParam(4, $rg, PDO::PARAM_STR);
        $smtp->bindParam(5, $data_nascimento, PDO::PARAM_STR);
        $smtp->bindParam(6, $conselho, PDO::PARAM_STR);
        $smtp->bindParam(7, $id_funcao, PDO::PARAM_INT);
        $smtp->bindParam(8, $id_prestador, PDO::PARAM_INT);
        $smtp->bindParam(9, $cod_sig, PDO::PARAM_INT);
        $smtp->bindParam(10, $CNES, PDO::PARAM_STR);
        $smtp->bindParam(11, $ddd_telefone, PDO::PARAM_INT);
        $smtp->bindParam(12, $telefone, PDO::PARAM_INT);
        $smtp->bindParam(13, $email, PDO::PARAM_STR);
        $smtp->bindParam(14, $obs, PDO::PARAM_STR);
        $smtp->bindParam(15, $status, PDO::PARAM_INT);
        $smtp->bindParam(16, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveMedico = $confirm == TRUE ? TRUE : FALSE;
        return $saveMedico;
    }

    public function edit_Medico($id_medico, $nome, $crm, $id_funcao, $cod_sig, $ddd_telefone, $telefone, $cpf, $rg, 
            $data_nascimento, $conselho, $CNES, $status, $id_prestador, $obs, $email) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_medico SET nome = :nome, crm = :crm, cpf = :cpf, rg = :rg, data_nascimento = :data_nascimento, 
                conselho = :conselho, id_funcao = :id_funcao, id_prestador = :id_prestador, cod_sig = :cod_sig, CNES = :CNES,
                ddd_telefone = :ddd_telefone, telefone = :telefone, email = :email, obs = :obs,                 
                status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id_medico = :id_medico");
        $confirm = $smtpup->execute(array(
            ':id_medico' => $id_medico,
            ':nome' => $nome,
            ':crm' => $crm,
            ':cpf' => $cpf,
            ':rg' => $rg,
            ':data_nascimento' => $data_nascimento,
            ':conselho' => $conselho,
            ':id_funcao' => $id_funcao,
            ':id_prestador' => $id_prestador,
            ':cod_sig' => $cod_sig,
            ':CNES' => $CNES,
            ':ddd_telefone' => $ddd_telefone,
            ':telefone' => $telefone,
            ':email' => $email,
            ':obs' => $obs,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editMedico = $confirm == TRUE ? TRUE : FALSE;
        return $editMedico;
    }

    public function delete_Medico($id_medico) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_medico SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id_medico = :id_medico");
        $confirm = $smtpup->execute(array(
            ':id_medico' => $id_medico,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteMedico = $confirm == TRUE ? TRUE : FALSE;
        return $deleteMedico;
    }

    public function Dados_Medicos($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id_medico, nome, crm, cpf, rg, data_nascimento, email, conselho, id_funcao, id_prestador, cod_sig, CNES, ddd_telefone, telefone, obs, status from wal_medico where id_medico = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Medicos_CPF($cpf) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id_medico, nome from wal_medico where status in (1) and cpf = ? limit 1";
        $q = $pdo->prepare($sql);
        $q->execute(array($cpf));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();        
        return $data;
    }
    
    public function Dados_Medicos_Coordenadores($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, nome from pcmso_coordenadores where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}