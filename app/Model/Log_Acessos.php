<?php

class Log_Acessos {
    public function save_Log_Acessos($user, $id_user, $email, $nome_extenso) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $hora_acesso = date('H:i:s');
        $data_acesso = date('Y-m-d');
        $mes_ano_acesso = date('Ym');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO log_acessos(user,id_user,email,nome_extenso,hora_acesso,data_acesso,mes_ano_acesso,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $user, PDO::PARAM_STR);
        $smtp->bindParam(2, $id_user, PDO::PARAM_INT);
        $smtp->bindParam(3, $email, PDO::PARAM_STR);
        $smtp->bindParam(4, $nome_extenso, PDO::PARAM_STR);
        $smtp->bindParam(5, $hora_acesso, PDO::PARAM_STR);
        $smtp->bindParam(6, $data_acesso, PDO::PARAM_STR);
        $smtp->bindParam(7, $mes_ano_acesso, PDO::PARAM_STR);
        $smtp->bindParam(8, $data_ultima_alteracao, PDO::PARAM_STR);        
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }
}
