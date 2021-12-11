<?php

class DMED_Interacoes extends DMED {

    public function save_DMED_Interacoes($data, $data_dmed, $RPPSS, $cpf_RPPSS, $BRPPSS, $cpf_BRPPSS, $dn, $valor, $recibo, $unidade) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO dmed(data,data_dmed,RPPSS,cpf_RPPSS,BRPPSS,cpf_BRPPSS,dn,valor,recibo,unidade) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $data, PDO::PARAM_STR);
        $smtp->bindParam(2, $data_dmed, PDO::PARAM_STR);
        $smtp->bindParam(3, $RPPSS, PDO::PARAM_STR);
        $smtp->bindParam(4, $cpf_RPPSS, PDO::PARAM_STR);
        $smtp->bindParam(5, $BRPPSS, PDO::PARAM_STR);
        $smtp->bindParam(6, $cpf_BRPPSS, PDO::PARAM_STR);
        $smtp->bindParam(7, $dn, PDO::PARAM_STR);
        $smtp->bindParam(8, $valor, PDO::PARAM_STR);
        $smtp->bindParam(9, $recibo, PDO::PARAM_STR);
        $smtp->bindParam(10, $unidade, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_DMED_Interacoes($id, $data, $data_dmed, $RPPSS, $cpf_RPPSS, $BRPPSS, $cpf_BRPPSS, $dn, $valor, $recibo, $unidade) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE dmed SET data = :data,data_dmed = :data_dmed,
            RPPSS = :RPPSS,cpf_RPPSS = :cpf_RPPSS,BRPPSS = :BRPPSS,
            cpf_BRPPSS = :cpf_BRPPSS,dn = :dn,valor = :valor, recibo = :recibo, unidade = :unidade WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id, ':data' => $data, ':data_dmed' => $data_dmed, ':RPPSS' => $RPPSS,
            ':cpf_RPPSS' => $cpf_RPPSS, ':BRPPSS' => $BRPPSS, ':cpf_BRPPSS' => $cpf_BRPPSS,
            ':dn' => $dn, ':valor' => $valor, ':recibo' => $recibo, ':unidade' => $unidade));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function Dados_DMED_Interacoess($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,data,data_dmed,RPPSS,cpf_RPPSS,BRPPSS,cpf_BRPPSS,dn,valor,recibo,unidade from dmed where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Dados_DMED_Interacoess_tem($calendario, $cpf) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as tem
                from dmed_centro 
                where SUBSTRING(data_dmed, 1, 4) = '" . $calendario . "'  
                and BRPPSS != 'MESMO' and cpf_RPPSS in ('" . $cpf . "')        
                order by cpf_RPPSS asc, STR_TO_DATE(dn,'%Y%m%d') asc";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}