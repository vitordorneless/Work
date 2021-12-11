<?php

class Prestadores_PJ extends Medico {

    public function save_Prestadores_PJ($data_cadastro, $id_tipo_prestador, $razao_social, $cnpj, $CNES, $endereco, $numero, 
            $complemento, $id_estado_UF, $id_cidade, $bairro, $CEP, $ddd_comercial, $telefone_comercial, $ddd_celular, $telefone_celular, 
            $email, $valor_consulta, $valor_consulta_2, $data_acerto_2, $valor_consulta_3, $data_acerto_3, $obs, $id_banco, $agencia, $conta) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO wal_prestadores(data_cadastro,id_tipo_prestador,razao_social,cnpj,CNES,endereco,numero,
            complemento,id_estado_UF,id_cidade,bairro,CEP,ddd_comercial,telefone_comercial,ddd_celular,telefone_celular,email,valor_consulta,
            valor_consulta_2, data_acerto_2,valor_consulta_3, data_acerto_3,
            status,obs,id_banco,agencia,conta,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $data_cadastro, PDO::PARAM_STR);
        $smtp->bindParam(2, $id_tipo_prestador, PDO::PARAM_INT);
        $smtp->bindParam(3, $razao_social, PDO::PARAM_STR);
        $smtp->bindParam(4, $cnpj, PDO::PARAM_STR);
        $smtp->bindParam(5, $CNES, PDO::PARAM_STR);
        $smtp->bindParam(6, $endereco, PDO::PARAM_STR);
        $smtp->bindParam(7, $numero, PDO::PARAM_STR);
        $smtp->bindParam(8, $complemento, PDO::PARAM_STR);
        $smtp->bindParam(9, $id_estado_UF, PDO::PARAM_INT);
        $smtp->bindParam(10, $id_cidade, PDO::PARAM_INT);
        $smtp->bindParam(11, $bairro, PDO::PARAM_STR);
        $smtp->bindParam(12, $CEP, PDO::PARAM_INT);
        $smtp->bindParam(13, $ddd_comercial, PDO::PARAM_INT);
        $smtp->bindParam(14, $telefone_comercial, PDO::PARAM_INT);
        $smtp->bindParam(15, $ddd_celular, PDO::PARAM_INT);
        $smtp->bindParam(16, $telefone_celular, PDO::PARAM_INT);
        $smtp->bindParam(17, $email, PDO::PARAM_STR);
        $smtp->bindParam(18, $valor_consulta, PDO::PARAM_STR);
        $smtp->bindParam(19, $valor_consulta_2, PDO::PARAM_STR);
        $smtp->bindParam(20, $data_acerto_2, PDO::PARAM_STR);
        $smtp->bindParam(21, $valor_consulta_3, PDO::PARAM_STR);
        $smtp->bindParam(22, $data_acerto_3, PDO::PARAM_STR);
        $smtp->bindParam(23, $status, PDO::PARAM_INT);
        $smtp->bindParam(24, $obs, PDO::PARAM_INT);
        $smtp->bindParam(25, $id_banco, PDO::PARAM_INT);
        $smtp->bindParam(26, $agencia, PDO::PARAM_STR);
        $smtp->bindParam(27, $conta, PDO::PARAM_STR);
        $smtp->bindParam(28, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveMedico = $confirm == TRUE ? TRUE : FALSE;
        return $saveMedico;
    }

    public function edit_Prestadores_PJ($id, $data_cadastro, $id_tipo_prestador, $razao_social, $cnpj, $CNES, $endereco, $numero, $complemento, 
            $id_estado_UF, $id_cidade, $bairro, $CEP, $ddd_comercial, $telefone_comercial, $ddd_celular, $telefone_celular,$email, $status, 
            $valor_consulta, $valor_consulta_2, $data_acerto_2, $valor_consulta_3, $data_acerto_3, $obs, $id_banco, $agencia, $conta) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_prestadores SET data_cadastro = :data_cadastro, id_tipo_prestador = :id_tipo_prestador,
            razao_social = :razao_social, cnpj = :cnpj, CNES = :CNES, endereco = :endereco, numero = :numero, complemento = :complemento,
            id_estado_UF = :id_estado_UF, id_cidade = :id_cidade, bairro = :bairro, CEP = :CEP, ddd_comercial = :ddd_comercial,
            telefone_comercial = :telefone_comercial, ddd_celular = :ddd_celular, telefone_celular = :telefone_celular,email = :email, valor_consulta = :valor_consulta, 
            valor_consulta_2 = :valor_consulta_2, data_acerto_2 = :data_acerto_2, valor_consulta_3 = :valor_consulta_3, data_acerto_3 = :data_acerto_3,
                status = :status, obs = :obs, id_banco = :id_banco, agencia = :agencia, conta = :conta, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':data_cadastro' => $data_cadastro,
            ':id_tipo_prestador' => $id_tipo_prestador,
            ':razao_social' => $razao_social,
            ':cnpj' => $cnpj,
            ':CNES' => $CNES,
            ':endereco' => $endereco,
            ':numero' => $numero,
            ':complemento' => $complemento,
            ':id_estado_UF' => $id_estado_UF,
            ':id_cidade' => $id_cidade,
            ':bairro' => $bairro,
            ':CEP' => $CEP,
            ':ddd_comercial' => $ddd_comercial,
            ':telefone_comercial' => $telefone_comercial,
            ':ddd_celular' => $ddd_celular,
            ':telefone_celular' => $telefone_celular,
            ':email' => $email,
            ':valor_consulta' => $valor_consulta,
            ':valor_consulta_2' => $valor_consulta_2,
            ':data_acerto_2' => $data_acerto_2,
            ':valor_consulta_3' => $valor_consulta_3,
            ':data_acerto_3' => $data_acerto_3,
            ':status' => $status,
            ':obs' => $obs,
            ':id_banco' => $id_banco,
            ':agencia' => $agencia,
            ':conta' => $conta,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editMedico = $confirm == TRUE ? TRUE : FALSE;
        return $editMedico;
    }

    public function delete_Prestadores_PJ($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_prestadores SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteMedico = $confirm == TRUE ? TRUE : FALSE;
        return $deleteMedico;
    }

    public function Dados_Prestadores_PJ($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, data_cadastro, valor_consulta, valor_consulta_2, valor_consulta_3, data_acerto_2, data_acerto_3, id_tipo_prestador, razao_social, cnpj, CNES, endereco, numero, complemento, obs, id_estado_UF, id_cidade, bairro, CEP, ddd_comercial, telefone_comercial, ddd_celular, telefone_celular, email, status, agencia, id_banco, conta from wal_prestadores where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
