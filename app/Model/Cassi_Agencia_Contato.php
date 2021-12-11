<?php

class Cassi_Agencia_Contato extends Cassi {

    public function Dados_Cassi_Agencias_Contatos($prefixo) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select prefixo, agencia, cidade, quantidade_ativos, endereco, complemento, bairro, contato, telefone, email,
                email2 from cassi_agencia_contato where prefixo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($prefixo));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}