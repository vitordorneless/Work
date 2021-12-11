<?php
class Demandas_Registros_Execute extends Demanda {
    public function saveDemandaR($id_demanda,$id_executante,$copy_mail,$empresa,$nome_ativo,$cpf_ativo,$nome_dep,$cpf_dep,
                                $nome_dep1,$cpf_dep1,$nome_dep2,$cpf_dep2,$nome_dep3,$cpf_dep3,$nome_dep4,$cpf_dep4,
                                $nome_dep5,$cpf_dep5,$nome_dep6,$cpf_dep6,$nome_dep7,$cpf_dep7,$nome_dep8,$cpf_dep8,$id_status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $qualidade = 0;
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO demandas_registros_execute(id_demanda,id_executante,copy_mail,empresa,nome_ativo,cpf_ativo,nome_dep,cpf_dep,
                                                    nome_dep1,cpf_dep1,nome_dep2,cpf_dep2,nome_dep3,cpf_dep3,nome_dep4,cpf_dep4,
                                                    nome_dep5,cpf_dep5,nome_dep6,cpf_dep6,nome_dep7,cpf_dep7,nome_dep8,cpf_dep8,id_status,id_status_qualidade,
                                                    data_ultima_alteracao) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_demanda, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_executante, PDO::PARAM_INT);
        $smtp->bindParam(3, $copy_mail, PDO::PARAM_STR);
        $smtp->bindParam(4, $empresa, PDO::PARAM_STR);
        $smtp->bindParam(5, $nome_ativo, PDO::PARAM_STR);
        $smtp->bindParam(6, $cpf_ativo, PDO::PARAM_STR);
        $smtp->bindParam(7, $nome_dep, PDO::PARAM_STR);
        $smtp->bindParam(8, $cpf_dep, PDO::PARAM_STR);
        $smtp->bindParam(9, $nome_dep1, PDO::PARAM_STR);
        $smtp->bindParam(10, $cpf_dep1, PDO::PARAM_STR);
        $smtp->bindParam(11, $nome_dep2, PDO::PARAM_STR);
        $smtp->bindParam(12, $cpf_dep2, PDO::PARAM_STR);
        $smtp->bindParam(13, $nome_dep3, PDO::PARAM_STR);
        $smtp->bindParam(14, $cpf_dep3, PDO::PARAM_STR);
        $smtp->bindParam(15, $nome_dep4, PDO::PARAM_STR);
        $smtp->bindParam(16, $cpf_dep4, PDO::PARAM_STR);
        $smtp->bindParam(17, $nome_dep5, PDO::PARAM_STR);
        $smtp->bindParam(18, $cpf_dep5, PDO::PARAM_STR);
        $smtp->bindParam(19, $nome_dep6, PDO::PARAM_STR);
        $smtp->bindParam(20, $cpf_dep6, PDO::PARAM_STR);
        $smtp->bindParam(21, $nome_dep7, PDO::PARAM_STR);
        $smtp->bindParam(22, $cpf_dep7, PDO::PARAM_STR);
        $smtp->bindParam(23, $nome_dep8, PDO::PARAM_STR);
        $smtp->bindParam(24, $cpf_dep8, PDO::PARAM_STR);
        $smtp->bindParam(25, $id_status, PDO::PARAM_INT);
        $smtp->bindParam(26, $qualidade, PDO::PARAM_INT);
        $smtp->bindParam(27, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        $saveDemanda = $confirm == TRUE ? TRUE : $pdo->errorInfo();
        Database::disconnect();
        
        return $saveDemanda;
    }

    public function editDemandaR($id, $id_demanda,$id_executante,$copy_mail,$empresa,$nome_ativo,$cpf_ativo,$nome_dep,$cpf_dep,
                                $nome_dep1,$cpf_dep1,$nome_dep2,$cpf_dep2,$nome_dep3,$cpf_dep3,$nome_dep4,$cpf_dep4,
                                $nome_dep5,$cpf_dep5,$nome_dep6,$cpf_dep6,$nome_dep7,$cpf_dep7,$nome_dep8,$cpf_dep8,$id_status, $data_ultima_alteracao) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE demandas_registros_execute SET id_demanda = :id_demanda,id_executante = :id_executante,copy_mail = :copy_mail,
                                        empresa = :empresa,nome_ativo = :nome_ativo,cpf_ativo = :cpf_ativo,nome_dep = :nome_dep,
                                        cpf_dep = :cpf_dep,nome_dep1 = :nome_dep1,cpf_dep1 = :cpf_dep1,nome_dep2 = :nome_dep2,cpf_dep2 = :cpf_dep2,
                                        nome_dep3 = :nome_dep3,cpf_dep3 = :cpf_dep3,nome_dep4 = :nome_dep4,cpf_dep4 = :cpf_dep4,nome_dep5 = :nome_dep5,
                                        cpf_dep5 = :cpf_dep5,nome_dep6 = :nome_dep6,cpf_dep6 = :cpf_dep6,nome_dep7 = :nome_dep7,cpf_dep7 = :cpf_dep7,
                                        nome_dep8 = :nome_dep8,cpf_dep8 = :cpf_dep8,id_status = :id_status,id_status_qualidade = :id_status_qualidade,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id_demanda' => $id_demanda,
            ':id_executante' => $id_executante,
            ':copy_mail' => $copy_mail,
            ':empresa' => $empresa,
            ':nome_ativo' => $nome_ativo,
            ':cpf_ativo' => $cpf_ativo,
            ':nome_dep' => $nome_dep,
            ':cpf_dep' => $cpf_dep,
            ':nome_dep1' => $nome_dep1,
            ':cpf_dep1' => $cpf_dep1,
            ':nome_dep2' => $nome_dep2,
            ':cpf_dep2' => $cpf_dep2,
            ':nome_dep3' => $nome_dep3,
            ':cpf_dep3' => $cpf_dep3,
            ':nome_dep4' => $nome_dep4,
            ':cpf_dep4' => $cpf_dep4,
            ':nome_dep5' => $nome_dep5,
            ':cpf_dep5' => $cpf_dep5,
            ':nome_dep6' => $nome_dep6,
            ':cpf_dep6' => $cpf_dep6,
            ':nome_dep7' => $nome_dep7,
            ':cpf_dep7' => $cpf_dep7,
            ':nome_dep8' => $nome_dep8,
            ':cpf_dep8' => $cpf_dep8,
            ':id_status' => $id_status,
            ':id_status_qualidade' => 0,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editRisco = $confirm == TRUE ? TRUE : FALSE;
        return $editRisco;
    }

    public function editDemandaStatusR($id, $id_status, $id_status_qualidade) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE demandas_registros_execute SET id_status = :id_status, id_status_qualidade = :id_status_qualidade WHERE id = :id");
        $confirm = $smtpup->execute(array(':id' => $id, ':id_status' => $id_status, ':id_status_qualidade' => $id_status_qualidade));
        Database::disconnect();
        $editRisco = $confirm == TRUE ? TRUE : FALSE;
        return $editRisco;
    }

    public function Dados_DemandasR($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_demanda,id_executante,copy_mail,empresa,nome_ativo,cpf_ativo,nome_dep,cpf_dep,
                                                    nome_dep1,cpf_dep1,nome_dep2,cpf_dep2,nome_dep3,cpf_dep3,nome_dep4,cpf_dep4,
                                                    nome_dep5,cpf_dep5,nome_dep6,cpf_dep6,nome_dep7,cpf_dep7,nome_dep8,cpf_dep8,id_status,id_status_qualidade,
                                                    data_ultima_alteracao from demandas_registros_execute where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_DemandasRR($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_demanda,id_executante,copy_mail,empresa,nome_ativo,cpf_ativo,nome_dep,cpf_dep,
                                                    nome_dep1,cpf_dep1,nome_dep2,cpf_dep2,nome_dep3,cpf_dep3,nome_dep4,cpf_dep4,
                                                    nome_dep5,cpf_dep5,nome_dep6,cpf_dep6,nome_dep7,cpf_dep7,nome_dep8,cpf_dep8,id_status,id_status_qualidade,
                                                    data_ultima_alteracao from demandas_registros_execute where id_demanda = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Empresa_combo($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select optionn from demandas_empresas_combo where valuess = '".$id."'";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Total_demandas_registros_execute() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from demandas_registros_execute";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);        
        Database::disconnect();
        return $data;
    }    
}