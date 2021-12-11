<?php

class Permissao_Walmart {

    public function PermitUser_Walmart($user) {
        include '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as id from usuarios where admin = 1 and status = 1 and setor = 3 and id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $confirm = $data['id'] == 0 ? FALSE : TRUE;
        Database::disconnect();
        return $confirm;
    }

}
