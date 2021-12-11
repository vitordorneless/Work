<?php
class Login extends Usuario {
    public function Logar($user, $pass) {
        include_once '../config/database_mysql.php';        
        require 'Log_Acessos.php';
        $logue = new Usuario();
        $log = new Log_Acessos();
        $logue->set_nome($user);
        $logue->set_pass($pass);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT COUNT(*) AS contar, id, setor,email, nome_extenso, foto FROM usuarios where status in (1) and nome = ? AND pass = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($logue->get_nome(), $logue->get_pass()));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $logando = $data['contar'] == 1 ? TRUE : FALSE;        
        $foto = $data['foto'] == NULL ? "sem_foto.jpg" : $data['foto'];        
        session_start();
        $_SESSION['user'] = $logue->get_nome();
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['setor'] = $data['setor'];
        $_SESSION['foto'] = $foto;
        $_SESSION['nome_extenso'] = $data['nome_extenso'];
        if($logando === TRUE){
        $log->save_Log_Acessos($_SESSION['user'], $_SESSION['user_id'], $_SESSION['email'], $_SESSION['nome_extenso']);
        }
        Database::disconnect();
        return $logando;
    }          
}