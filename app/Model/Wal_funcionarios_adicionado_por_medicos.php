<?php

class Wal_funcionarios_adicionado_por_medicos extends Walmart {
    public function save_Wal_funcionarios_adicionado_por_Medicos($nome, $cpf, $nascimento, $cod_cargo, $cod_setor, $cod_empresa,$cod_loja, $id_medico, $cpf_medico) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');        
        
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO wal_funcionarios(nome,cpf,nascimento,cod_cargo,cod_setor,cod_empresa,cod_loja,status,id_medico,cpf_medico,data_ultima_alteracao)
                VALUES(?,?,?,?,?,?,?,?,?,?,?)");        
        $smtp->bindParam(1, $nome, PDO::PARAM_STR);        
        $smtp->bindParam(2, $cpf, PDO::PARAM_STR);
        $smtp->bindParam(3, $nascimento, PDO::PARAM_STR);
        $smtp->bindParam(4, $cod_cargo, PDO::PARAM_STR);
        $smtp->bindParam(5, $cod_setor, PDO::PARAM_STR);
        $smtp->bindParam(6, $cod_empresa, PDO::PARAM_INT);
        $smtp->bindParam(7, $cod_loja, PDO::PARAM_INT);
        $smtp->bindParam(8, $status, PDO::PARAM_INT);
        $smtp->bindParam(9, $id_medico, PDO::PARAM_INT);
        $smtp->bindParam(10, $cpf_medico, PDO::PARAM_STR);
        $smtp->bindParam(11, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }
    
    public function save_Wal_funcionarios_por_Medicos($nome, $matricula, $admissao, $cpf, $identidade, $nascimento,$cod_empresa, 
            $cod_estabelecimento, $cod_centro_custo,$cod_cargo,$cod_depto,$regiao,$data_convocacao,$id_medico,$flg_periodico,
            $data_periodico,$flg_recebimento,$data_recebimento,$flg_qrcode,$data_qrcode,$flg_edit,$risco,$exame,$erro,$status_box,
            $comp_ACIDO_METIL_HIPURICO,$comp_HEMOGRAMA,$comp_ACIDO_MANDELICO,$comp_VDRL,$comp_RETICULOCITOS,$comp_PARASITOLOGICO_FEZES,
            $comp_CULTURAL_DE_OROFARINGE,$comp_COPROCULTURA,
            $comp_MICOLOGICO_DE_UNHA,$comp_AUDIOMETRIA,$comp_ECG,$comp_ACUIDADE_VISUAL,$comp_EEG,$comp_PLAQUETAS,$comp_ERITROGRAMA,
            $comp_ACIDO_TT_MUCONICO,$comp_GLICEMIA_EM_JEJUM,$comp_ACIDO_HIPURICO,$comp_AVALIACAO_PSICOSSOCIAL,$status_ACIDO_METIL_HIPURICO,
            $status_HEMOGRAMA,$status_ACIDO_MANDELICO,$status_VDRL,$status_RETICULOCITOS,$status_PARASITOLOGICO_FEZES,
            $status_CULTURAL_DE_OROFARINGE,$status_COPROCULTURA,
            $status_MICOLOGICO_DE_UNHA,$status_AUDIOMETRIA,$status_ECG,$status_ACUIDADE_VISUAL,$status_EEG,$status_PLAQUETAS,$status_ERITROGRAMA,
            $status_ACIDO_TT_MUCONICO,$status_GLICEMIA_EM_JEJUM,$status_ACIDO_HIPURICO,$status_AVALIACAO_PSICOSSOCIAL, $id_medico_coordenador, $codepf, 
            $erro_coord,$erro_tel,$erro_falta_habilitado,$erro_falta_apto,$erro_rasuras,
            $erro_assinatura_medico,$erro_assinatura_ativo,$erro_data_exames,$erro_data_ASO,$erro_riscos,$erro_identificacao,$erro_carimbo) {
        include_once '../config/database_mysql.php';        
        $data_ultima_alteracao = date('Y-m-d H:i:s');        
        
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO wal_funcionarios(
            nome_funcionario,
            matricula,
            admissao,
            cpf,
            identidade,
            nascimento,
            cod_pessoa_fisica,
            cod_empresa,
            cod_estabelecimento,
            cod_centro_custo,
            cod_cargo,
            cod_depto,
            regiao,
            data_convocacao,
            id_medico,
            id_medico_coordenador,
            flg_periodico,
            data_periodico,
            flg_recebimento,
            data_recebimento,
            flg_qrcode,
            data_qrcode,
            flg_edit,
            risco,
            exame,
            erro,            
            erro_identificacao,
            erro_riscos,
            erro_data_ASO,
            erro_data_exames,
            erro_assinatura_ativo,
            erro_assinatura_medico,
            erro_carimbo,
            erro_rasuras,
            erro_falta_apto,
            erro_falta_habilitado,
            erro_tel,
            erro_coord,
            id_box,
            comp_ACIDO_METIL_HIPURICO,
            id_ACIDO_METIL_HIPURICO,
            comp_HEMOGRAMA,
            id_HEMOGRAMA,
            comp_ACIDO_MANDELICO,
            id_ACIDO_MANDELICO,
            comp_VDRL,
            id_VDRL,
            comp_RETICULOCITOS,
            id_RETICULOCITOS,
            comp_PARASITOLOGICO_FEZES,
            id_PARASITOLOGICO_FEZES,
            comp_CULTURAL_DE_OROFARINGE,
            id_CULTURAL_DE_OROFARINGE,
            comp_COPROCULTURA,
            id_COPROCULTURA,
            comp_MICOLOGICO_DE_UNHA,
            id_MICOLOGICO_DE_UNHA,
            comp_AUDIOMETRIA,
            id_AUDIOMETRIA,
            comp_ECG,
            id_ECG,
            comp_ACUIDADE_VISUAL,
            id_ACUIDADE_VISUAL,
            comp_EEG,
            id_EEG,
            comp_PLAQUETAS,
            id_PLAQUETAS,
            comp_ERITROGRAMA,
            id_ERITROGRAMA,
            comp_ACIDO_TT_MUCONICO,
            id_ACIDO_TT_MUCONICO,
            comp_GLICEMIA_EM_JEJUM,
            id_GLICEMIA_EM_JEJUM,
            comp_ACIDO_HIPURICO,
            id_ACIDO_HIPURICO,
            comp_AVALIACAO_PSICOSSOCIAL,
            id_AVALIACAO_PSICOSSOCIAL,
            data_ultima_alteracao)
 VALUES(?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,?,
        ?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $nome, PDO::PARAM_STR);        
        $smtp->bindParam(2, $matricula, PDO::PARAM_INT);
        $smtp->bindParam(3, $admissao, PDO::PARAM_STR);
        $smtp->bindParam(4, $cpf, PDO::PARAM_STR);
        $smtp->bindParam(5, $identidade, PDO::PARAM_STR);
        $smtp->bindParam(6, $nascimento, PDO::PARAM_STR);
        $smtp->bindParam(7, $codepf, PDO::PARAM_STR);
        $smtp->bindParam(8, $cod_empresa, PDO::PARAM_INT);
        $smtp->bindParam(9, $cod_estabelecimento, PDO::PARAM_INT);
        $smtp->bindParam(10, $cod_centro_custo, PDO::PARAM_INT);
        $smtp->bindParam(11, $cod_cargo, PDO::PARAM_INT);
        $smtp->bindParam(12, $cod_depto, PDO::PARAM_INT);
        $smtp->bindParam(13, $regiao, PDO::PARAM_STR);
        $smtp->bindParam(14, $data_convocacao, PDO::PARAM_STR);
        $smtp->bindParam(15, $id_medico, PDO::PARAM_INT);
        $smtp->bindParam(16, $id_medico_coordenador, PDO::PARAM_INT);
        $smtp->bindParam(17, $flg_periodico, PDO::PARAM_INT);
        $smtp->bindParam(18, $data_periodico, PDO::PARAM_STR);
        $smtp->bindParam(19, $flg_recebimento, PDO::PARAM_INT);
        $smtp->bindParam(20, $data_recebimento, PDO::PARAM_STR);
        $smtp->bindParam(21, $flg_qrcode, PDO::PARAM_INT);
        $smtp->bindParam(22, $data_qrcode, PDO::PARAM_STR);
        $smtp->bindParam(23, $flg_edit, PDO::PARAM_INT);
        $smtp->bindParam(24, $risco, PDO::PARAM_INT);
        $smtp->bindParam(25, $exame, PDO::PARAM_INT);
        $smtp->bindParam(26, $erro, PDO::PARAM_INT);        
        $smtp->bindParam(27, $erro_identificacao, PDO::PARAM_INT);
        $smtp->bindParam(28, $erro_riscos, PDO::PARAM_INT);
        $smtp->bindParam(29, $erro_data_ASO, PDO::PARAM_INT);
        $smtp->bindParam(30, $erro_data_exames, PDO::PARAM_INT);
        $smtp->bindParam(31, $erro_assinatura_ativo, PDO::PARAM_INT);
        $smtp->bindParam(32, $erro_assinatura_medico, PDO::PARAM_INT);
        $smtp->bindParam(33, $erro_carimbo, PDO::PARAM_INT);
        $smtp->bindParam(34, $erro_rasuras, PDO::PARAM_INT);
        $smtp->bindParam(35, $erro_falta_apto, PDO::PARAM_INT);
        $smtp->bindParam(36, $erro_falta_habilitado, PDO::PARAM_INT);
        $smtp->bindParam(37, $erro_tel, PDO::PARAM_INT);
        $smtp->bindParam(38, $erro_coord, PDO::PARAM_INT);        
        $smtp->bindParam(39, $status_box, PDO::PARAM_INT);
        $smtp->bindParam(40, $comp_ACIDO_METIL_HIPURICO, PDO::PARAM_STR);
        $smtp->bindParam(41, $status_ACIDO_METIL_HIPURICO, PDO::PARAM_INT);
        $smtp->bindParam(42, $comp_HEMOGRAMA, PDO::PARAM_STR);
        $smtp->bindParam(43, $status_HEMOGRAMA, PDO::PARAM_INT);
        $smtp->bindParam(44, $comp_ACIDO_MANDELICO, PDO::PARAM_STR);
        $smtp->bindParam(45, $status_ACIDO_MANDELICO, PDO::PARAM_INT);
        $smtp->bindParam(46, $comp_VDRL, PDO::PARAM_STR);
        $smtp->bindParam(47, $status_VDRL, PDO::PARAM_INT);
        $smtp->bindParam(48, $comp_RETICULOCITOS, PDO::PARAM_STR);
        $smtp->bindParam(49, $status_RETICULOCITOS, PDO::PARAM_INT);
        $smtp->bindParam(50, $comp_PARASITOLOGICO_FEZES, PDO::PARAM_STR);
        $smtp->bindParam(51, $status_PARASITOLOGICO_FEZES, PDO::PARAM_INT);
        $smtp->bindParam(52, $comp_CULTURAL_DE_OROFARINGE, PDO::PARAM_STR);
        $smtp->bindParam(53, $status_CULTURAL_DE_OROFARINGE, PDO::PARAM_INT);
        $smtp->bindParam(54, $comp_COPROCULTURA, PDO::PARAM_STR);
        $smtp->bindParam(55, $status_COPROCULTURA, PDO::PARAM_INT);
        $smtp->bindParam(56, $comp_MICOLOGICO_DE_UNHA, PDO::PARAM_STR);
        $smtp->bindParam(57, $status_MICOLOGICO_DE_UNHA, PDO::PARAM_INT);
        $smtp->bindParam(58, $comp_AUDIOMETRIA, PDO::PARAM_STR);
        $smtp->bindParam(59, $status_AUDIOMETRIA, PDO::PARAM_INT);
        $smtp->bindParam(60, $comp_ECG, PDO::PARAM_STR);
        $smtp->bindParam(61, $status_ECG, PDO::PARAM_INT);
        $smtp->bindParam(62, $comp_ACUIDADE_VISUAL, PDO::PARAM_STR);
        $smtp->bindParam(63, $status_ACUIDADE_VISUAL, PDO::PARAM_INT);
        $smtp->bindParam(64, $comp_EEG, PDO::PARAM_STR);
        $smtp->bindParam(65, $status_EEG, PDO::PARAM_INT);
        $smtp->bindParam(66, $comp_PLAQUETAS, PDO::PARAM_STR);
        $smtp->bindParam(67, $status_PLAQUETAS, PDO::PARAM_INT);
        $smtp->bindParam(68, $comp_ERITROGRAMA, PDO::PARAM_STR);
        $smtp->bindParam(69, $status_ERITROGRAMA, PDO::PARAM_INT);
        $smtp->bindParam(70, $comp_ACIDO_TT_MUCONICO, PDO::PARAM_STR);
        $smtp->bindParam(71, $status_ACIDO_TT_MUCONICO, PDO::PARAM_INT);
        $smtp->bindParam(72, $comp_GLICEMIA_EM_JEJUM, PDO::PARAM_STR);
        $smtp->bindParam(73, $status_GLICEMIA_EM_JEJUM, PDO::PARAM_INT);
        $smtp->bindParam(74, $comp_ACIDO_HIPURICO, PDO::PARAM_STR);
        $smtp->bindParam(75, $status_ACIDO_HIPURICO, PDO::PARAM_INT);
        $smtp->bindParam(76, $comp_AVALIACAO_PSICOSSOCIAL, PDO::PARAM_STR);
        $smtp->bindParam(77, $status_AVALIACAO_PSICOSSOCIAL, PDO::PARAM_INT);
        $smtp->bindParam(78, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();        
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }
    
    public function edit_Wal_funcionarios_adicionado_por_Medicos($id, $nome, $cpf, $nascimento, $cod_cargo, $cod_setor, $cod_empresa,$cod_loja, $id_medico, $cpf_medico, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_funcionarios_adicionado_por_medicos SET nome = :nome, cpf = :cpf, nascimento = :nascimento, cod_cargo = :cod_cargo, cod_setor = :cod_setor, 
                cod_empresa = :cod_empresa, cod_loja = :cod_loja,status = :status,id_medico = :id_medico,cpf_medico = :cpf_medico, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,            
            ':nome' => $nome,            
            ':cpf' => $cpf,
            ':nascimento' => $nascimento,
            ':cod_cargo' => $cod_cargo,
            ':cod_setor' => $cod_setor,
            ':cod_empresa' => $cod_empresa,
            ':cod_loja' => $cod_loja,
            ':status' => $status,
            ':id_medico' => $id_medico,
            ':cpf_medico' => $cpf_medico,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_Wal_funcionarios_adicionado_por_Medicos($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE wal_funcionarios_adicionado_por_medicos SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteWal_funcionarios_adicionado_por_Medicos = $confirm == TRUE ? TRUE : FALSE;
        return $deleteWal_funcionarios_adicionado_por_Medicos;
    }
    
    public function Dados_Wal_funcionarios_adicionado_por_Medicos($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, nome, cpf, nascimento, cod_cargo, cod_setor, cod_empresa, cod_loja, status, cpf_medico from wal_funcionarios_adicionado_por_medicos where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}