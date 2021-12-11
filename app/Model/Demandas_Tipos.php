<?php

class Demandas_Tipos extends Demanda {
    public function saveDemanda($tipo,$sla,$setor,$user_executante) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $status = 1;
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO demandas_tipos_de_demandas(tipo_demanda,sla,id_setor,user_executante,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?)");
        $smtp->bindParam(1, $tipo, PDO::PARAM_STR);
        $smtp->bindParam(2, $sla, PDO::PARAM_STR);
        $smtp->bindParam(3, $setor, PDO::PARAM_STR);
        $smtp->bindParam(4, $user_executante, PDO::PARAM_STR);
        $smtp->bindParam(5, $status, PDO::PARAM_STR);
        $smtp->bindParam(6, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveDemanda = $confirm == TRUE ? TRUE : FALSE;
        return $saveDemanda;
    }

    public function editDemanda($id, $tipo,$sla,$setor,$user_executante,$status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE demandas_tipos_de_demandas SET tipo_demanda = :tipo_demanda,sla = :sla,id_setor = :id_setor,user_executante = :user_executante,status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(':id' => $id,':tipo_demanda' => $tipo,':sla' => $sla,':id_setor' => $setor,':user_executante' => $user_executante,':status' => $status,':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editRisco = $confirm == TRUE ? TRUE : FALSE;
        return $editRisco;
    }    
    
    public function Dados_Demandas($id) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, tipo_demanda,sla,id_setor,user_executante,status,data_ultima_alteracao from demandas_tipos_de_demandas where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Next_ID() {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select max(id) + 1 as next from demandas_tipos_de_demandas";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $voucher = date('Y').'0'.$data['next'];
        Database::disconnect();
        return $voucher;
    }
}
