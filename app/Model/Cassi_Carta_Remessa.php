<?php

class Cassi_Carta_Remessa extends Cassi {
    public function save_Cassi_Carta_Remessa($peg, $guias_anexas, $valor_total, $data_envio, $data_recebido_cassi, $usuario_ama, $nota_fiscal, $nome_arquivo) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO cassi_carta_remessa(peg,guias_anexas,valor_total,data_envio,data_recebido_cassi,usuario_ama,nota_fiscal_ama,nome_arquivo,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $peg, PDO::PARAM_STR);
        $smtp->bindParam(2, $guias_anexas, PDO::PARAM_INT);
        $smtp->bindParam(3, $valor_total, PDO::PARAM_STR);
        $smtp->bindParam(4, $data_envio, PDO::PARAM_STR);
        $smtp->bindParam(5, $data_recebido_cassi, PDO::PARAM_STR);
        $smtp->bindParam(6, $usuario_ama, PDO::PARAM_INT);
        $smtp->bindParam(7, $nota_fiscal, PDO::PARAM_STR);
        $smtp->bindParam(8, $nome_arquivo, PDO::PARAM_STR);
        $smtp->bindParam(9, $status, PDO::PARAM_INT);
        $smtp->bindParam(10, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Cassi_Carta_Remessa($id, $peg, $guias_anexas, $valor_total, $data_envio, $data_recebido_cassi, $usuario_ama, $nota_fiscal_ama, $nome_arquivo,$status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cassi_carta_remessa SET peg = :peg, guias_anexas = :guias_anexas, valor_total = :valor_total, data_envio = :data_envio, data_recebido_cassi = :data_recebido_cassi, usuario_ama = :usuario_ama, 
                nota_fiscal_ama = :nota_fiscal_ama, nome_arquivo = :nome_arquivo, status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':peg' => $peg,
            ':guias_anexas' => $guias_anexas,
            ':valor_total' => $valor_total,
            ':data_envio' => $data_envio,
            ':data_recebido_cassi' => $data_recebido_cassi,
            ':usuario_ama' => $usuario_ama,
            ':nota_fiscal_ama' => $nota_fiscal_ama,
            ':nome_arquivo' => $nome_arquivo,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Cassi_Carta_Remessa($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE cassi_carta_remessa SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_Cassi_Carta_Remessas($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,peg,guias_anexas,valor_total,data_envio,data_recebido_cassi,usuario_ama,nota_fiscal_ama,nome_arquivo,status from cassi_carta_remessa where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
