<?php

class Permissoes extends Usuario{
    
    public function save_Permissoes($id_usuario,$super_admin,$admin,$lojas,$convocacao,$cassi,$medicos_externo,$medicos_walmart,$walmart_gerencial,
            $cassi_gerencial,$indicadores_cassi,$indicadores_walmart,$relatorios, $herval, $herval_gerencial, $herval_indicadores, 
            $tst, $tst_indicadores, $tst_gerencial, $id_usuario_cadastro,$demandas) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO usuarios_permissoes(id_usuario,super_admin,admin,lojas,convocacao,cassi,medicos_externo,
            medicos_walmart,walmart_gerencial,cassi_gerencial,indicadores_cassi,indicadores_walmart,relatorios,herval, herval_gerencial, 
            herval_indicadores, tst, tst_indicadores, tst_gerencial, demandas, id_usuario_cadastro, status, data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_usuario, PDO::PARAM_INT);
        $smtp->bindParam(2, $super_admin, PDO::PARAM_INT);
        $smtp->bindParam(3, $admin, PDO::PARAM_INT);
        $smtp->bindParam(4, $lojas, PDO::PARAM_INT);
        $smtp->bindParam(5, $convocacao, PDO::PARAM_INT);
        $smtp->bindParam(6, $cassi, PDO::PARAM_INT);
        $smtp->bindParam(7, $medicos_externo, PDO::PARAM_INT);
        $smtp->bindParam(8, $medicos_walmart, PDO::PARAM_INT);
        $smtp->bindParam(9, $walmart_gerencial, PDO::PARAM_INT);
        $smtp->bindParam(10, $cassi_gerencial, PDO::PARAM_INT);
        $smtp->bindParam(11, $indicadores_cassi, PDO::PARAM_INT);
        $smtp->bindParam(12, $indicadores_walmart, PDO::PARAM_INT);
        $smtp->bindParam(13, $relatorios, PDO::PARAM_INT);
        $smtp->bindParam(14, $herval, PDO::PARAM_INT);
        $smtp->bindParam(15, $herval_gerencial, PDO::PARAM_INT);
        $smtp->bindParam(16, $herval_indicadores, PDO::PARAM_INT);
        $smtp->bindParam(17, $tst, PDO::PARAM_INT);
        $smtp->bindParam(18, $tst_indicadores, PDO::PARAM_INT);
        $smtp->bindParam(19, $tst_gerencial, PDO::PARAM_INT);
        $smtp->bindParam(20, $demandas, PDO::PARAM_INT);
        $smtp->bindParam(21, $id_usuario_cadastro, PDO::PARAM_INT);
        $smtp->bindParam(22, $status, PDO::PARAM_INT);
        $smtp->bindParam(23, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();        
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Permissoes($id, $id_usuario,$super_admin,$admin,$lojas,$convocacao,$cassi,$medicos_externo,
            $medicos_walmart,$walmart_gerencial,$cassi_gerencial,$indicadores_cassi,$indicadores_walmart,$relatorios, 
            $herval, $herval_gerencial, $herval_indicadores,$tst, $tst_indicadores, $tst_gerencial,$id_usuario_cadastro,$status,$demandas) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE usuarios_permissoes SET id_usuario = :id_usuario, super_admin = :super_admin, admin = :admin, lojas = :lojas, 
                convocacao = :convocacao, cassi = :cassi, 
                medicos_externo = :medicos_externo, medicos_walmart = :medicos_walmart, walmart_gerencial = :walmart_gerencial, 
                cassi_gerencial = :cassi_gerencial,
                indicadores_cassi = :indicadores_cassi, indicadores_walmart = :indicadores_walmart, relatorios = :relatorios, herval = :herval,
                herval_gerencial = :herval_gerencial, herval_indicadores = :herval_indicadores, tst = :tst, tst_indicadores = :tst_indicadores, 
                tst_gerencial = :tst_gerencial,demandas = :demandas, id_usuario_cadastro = :id_usuario_cadastro, 
                status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,':id_usuario' => $id_usuario,':super_admin' => $super_admin,':admin' => $admin,':lojas' => $lojas,
            ':convocacao' => $convocacao,':cassi' => $cassi,':medicos_externo' => $medicos_externo,':medicos_walmart' => $medicos_walmart,
            ':walmart_gerencial' => $walmart_gerencial,':cassi_gerencial' => $cassi_gerencial,':indicadores_cassi' => $indicadores_cassi,
            ':indicadores_walmart' => $indicadores_walmart,':relatorios' => $relatorios,':herval' => $herval,':herval_gerencial' => $herval_gerencial,
            ':herval_indicadores' => $herval_indicadores,':tst' => $tst,':tst_indicadores' => $tst_indicadores,':tst_gerencial' => $tst_gerencial,':demandas' => $demandas,
            ':id_usuario_cadastro' => $id_usuario_cadastro,':status' => $status,':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
       
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Permissoes($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE usuarios_permissoes SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(':id' => $id,':status' => $status,':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_Permissoess($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_usuario,super_admin,admin,lojas,convocacao,cassi,medicos_externo,medicos_walmart,walmart_gerencial,cassi_gerencial,indicadores_cassi,indicadores_walmart,demandas,relatorios,herval,herval_gerencial,herval_indicadores,id_usuario_cadastro,status,tst,tst_indicadores,tst_gerencial from usuarios_permissoes where id_usuario = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Ja_tem_Permissoes($id_usuario) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from usuarios_permissoes where id_usuario = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_usuario));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}