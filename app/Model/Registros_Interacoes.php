<?php

class Registros_Interacoes extends Registros {
    public function txt_existe($nome) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'select count(id) as "temos" from retorno_critica_bradesco_webtran where nome_arquivo = ?';
        $q = $pdo->prepare($sql);
        $q->execute(array($nome));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $confirm = $data['temos'] > 0 ? TRUE : FALSE;
    }
    
    public function pegar_apolice($apolice) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'select apolice as "temos" from retorno_critica_bradesco_webtran where tipo_registro = "*" and nome_arquivo = ?';
        $q = $pdo->prepare($sql);
        $q->execute(array($apolice));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data['temos'];
    }
}
