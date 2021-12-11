<?php

class RH_Funcionarios extends Recursos_Humanos {

    public function save_RH_Funcionarios($nome, $matricula, $nome_pai, $nome_mae, $nascimento, $ctps, $data_ctps, $titulo_eleitor, $admissao, $exame_admissional, $exame_medico, $identidade, $emissao_identidade, $org_emissor_identidade, $cpf, $pis, $data_cad_pis, $nome_conselho_regional, $id_rh_estado_civil, $id_rh_grau_instrucao_escolar, $id_sexo, $id_rh_cor_pessoa, $id_rh_deficiencia_pessoa, $endereco, $numero, $complemento, $bairro, $id_cidade, $id_estado, $cep, $id_rh_departamentos, $id_rh_funcoes, $salario_atual, $id_local_trabalho_cidade, $id_rateio_folha, $membro_cipa, $anotacoes_gerais, $data_saida, $exame_demissional, $id_status_vinculo, $id_rh_empresas, $id_rh_unidades) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO rh_funcionarios(nome,matricula,nome_pai,nome_mae,nascimento,ctps,data_ctps,titulo_eleitor,
                admissao,exame_admissional,exame_medico,identidade,emissao_identidade,org_emissor_identidade,cpf,
                pis,data_cad_pis,nome_conselho_regional,id_rh_estado_civil,id_rh_grau_instrucao_escolar,id_sexo,id_rh_cor_pessoa,
                id_rh_deficiencia_pessoa,endereco,numero,complemento,bairro,id_cidade,id_estado,cep,id_rh_departamentos,id_rh_funcoes,
                salario_atual,id_local_trabalho_cidade,id_rateio_folha,membro_cipa,anotacoes_gerais,data_saida,exame_demissional,
                id_status_vinculo,id_rh_empresas,id_rh_unidades,status,data_ultima_alteracao) 
                VALUES(?,?,?,?,
                ?,?,?,?,
                ?,?,?,?,
                ?,?,?,?,
                ?,?,?,?,
                ?,?,?,?,
                ?,?,?,?,
                ?,?,?,?,
                ?,?,?,?,
                ?,?,?,?,
                ?,?,?,?)");
        $smtp->bindParam(1, $nome, PDO::PARAM_STR);
        $smtp->bindParam(2, $matricula, PDO::PARAM_STR);
        $smtp->bindParam(3, $nome_pai, PDO::PARAM_STR);
        $smtp->bindParam(4, $nome_mae, PDO::PARAM_STR);
        $smtp->bindParam(5, $nascimento, PDO::PARAM_STR);
        $smtp->bindParam(6, $ctps, PDO::PARAM_STR);
        $smtp->bindParam(7, $data_ctps, PDO::PARAM_STR);
        $smtp->bindParam(8, $titulo_eleitor, PDO::PARAM_STR);
        $smtp->bindParam(9, $admissao, PDO::PARAM_STR);
        $smtp->bindParam(10, $exame_admissional, PDO::PARAM_STR);
        $smtp->bindParam(11, $exame_medico, PDO::PARAM_STR);
        $smtp->bindParam(12, $identidade, PDO::PARAM_STR);
        $smtp->bindParam(13, $emissao_identidade, PDO::PARAM_STR);
        $smtp->bindParam(14, $org_emissor_identidade, PDO::PARAM_STR);
        $smtp->bindParam(15, $cpf, PDO::PARAM_STR);
        $smtp->bindParam(16, $pis, PDO::PARAM_STR);
        $smtp->bindParam(17, $data_cad_pis, PDO::PARAM_STR);
        $smtp->bindParam(18, $nome_conselho_regional, PDO::PARAM_STR);
        $smtp->bindParam(19, $id_rh_estado_civil, PDO::PARAM_INT);
        $smtp->bindParam(20, $id_rh_grau_instrucao_escolar, PDO::PARAM_INT);
        $smtp->bindParam(21, $id_sexo, PDO::PARAM_INT);
        $smtp->bindParam(22, $id_rh_cor_pessoa, PDO::PARAM_INT);
        $smtp->bindParam(23, $id_rh_deficiencia_pessoa, PDO::PARAM_INT);
        $smtp->bindParam(24, $endereco, PDO::PARAM_STR);
        $smtp->bindParam(25, $numero, PDO::PARAM_STR);
        $smtp->bindParam(26, $complemento, PDO::PARAM_STR);
        $smtp->bindParam(27, $bairro, PDO::PARAM_STR);
        $smtp->bindParam(28, $id_cidade, PDO::PARAM_INT);
        $smtp->bindParam(29, $id_estado, PDO::PARAM_INT);
        $smtp->bindParam(30, $cep, PDO::PARAM_STR);
        $smtp->bindParam(31, $id_rh_departamentos, PDO::PARAM_INT);
        $smtp->bindParam(32, $id_rh_funcoes, PDO::PARAM_INT);
        $smtp->bindParam(33, $salario_atual, PDO::PARAM_STR);
        $smtp->bindParam(34, $id_local_trabalho_cidade, PDO::PARAM_INT);
        $smtp->bindParam(35, $id_rateio_folha, PDO::PARAM_INT);
        $smtp->bindParam(36, $membro_cipa, PDO::PARAM_INT);
        $smtp->bindParam(37, $anotacoes_gerais, PDO::PARAM_STR);
        $smtp->bindParam(38, $data_saida, PDO::PARAM_STR);
        $smtp->bindParam(39, $exame_demissional, PDO::PARAM_STR);
        $smtp->bindParam(40, $id_status_vinculo, PDO::PARAM_INT);
        $smtp->bindParam(41, $id_rh_empresas, PDO::PARAM_INT);
        $smtp->bindParam(42, $id_rh_unidades, PDO::PARAM_INT);
        $smtp->bindParam(43, $status, PDO::PARAM_INT);
        $smtp->bindParam(44, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        print_r($pdo->errorInfo());
        return $save;
    }

    public function edit_RH_Funcionarios($id, $nome, $matricula, $nome_pai, $nome_mae, $nascimento, $ctps, $data_ctps, $titulo_eleitor, $admissao, $exame_admissional, $exame_medico, $identidade, $emissao_identidade, $org_emissor_identidade, $cpf, $pis, $data_cad_pis, $nome_conselho_regional, $id_rh_estado_civil, $id_rh_grau_instrucao_escolar, $id_sexo, $id_rh_cor_pessoa, $id_rh_deficiencia_pessoa, $endereco, $numero, $complemento, $bairro, $id_cidade, $id_estado, $cep, $id_rh_departamentos, $id_rh_funcoes, $salario_atual, $id_local_trabalho_cidade, $id_rateio_folha, $membro_cipa, $anotacoes_gerais, $data_saida, $exame_demissional, $id_status_vinculo, $id_rh_empresas, $id_rh_unidades, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE rh_funcionarios SET nome = :nome,
            matricula = :matricula,nome_pai = :nome_pai,nome_mae = :nome_mae,nascimento = :nascimento,ctps = :ctps,data_ctps = :data_ctps,
            titulo_eleitor = :titulo_eleitor,admissao = :admissao,exame_admissional = :exame_admissional,exame_medico = :exame_medico,
            identidade = :identidade,emissao_identidade = :emissao_identidade,org_emissor_identidade = :org_emissor_identidade,cpf = :cpf,
            pis = :pis,data_cad_pis = :data_cad_pis,nome_conselho_regional = :nome_conselho_regional,id_rh_estado_civil = :id_rh_estado_civil,
            id_rh_grau_instrucao_escolar = :id_rh_grau_instrucao_escolar,id_sexo = :id_sexo,id_rh_cor_pessoa = :id_rh_cor_pessoa,
            id_rh_deficiencia_pessoa = :id_rh_deficiencia_pessoa,endereco = :endereco,numero = :numero,complemento = :complemento,bairro = :bairro,
            id_cidade = :id_cidade,id_estado = :id_estado,cep = :cep,id_rh_departamentos = :id_rh_departamentos,id_rh_funcoes = :id_rh_funcoes,
            salario_atual = :salario_atual,id_local_trabalho_cidade = :id_local_trabalho_cidade,id_rateio_folha = :id_rateio_folha,membro_cipa = :membro_cipa,
            anotacoes_gerais = :anotacoes_gerais,data_saida = :data_saida,exame_demissional = :exame_demissional,id_status_vinculo = :id_status_vinculo,
            id_rh_empresas = :id_rh_empresas,id_rh_unidades = :id_rh_unidades,status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':nome' => $nome,
            ':matricula' => $matricula,
            ':nome_pai' => $nome_pai,
            ':nome_mae' => $nome_mae,
            ':nascimento' => $nascimento,
            ':ctps' => $ctps,
            ':data_ctps' => $data_ctps,
            ':titulo_eleitor' => $titulo_eleitor,
            ':admissao' => $admissao,
            ':exame_admissional' => $exame_admissional,
            ':exame_medico' => $exame_medico,
            ':identidade' => $identidade,
            ':emissao_identidade' => $emissao_identidade,
            ':org_emissor_identidade' => $org_emissor_identidade,
            ':cpf' => $cpf,
            ':pis' => $pis,
            ':data_cad_pis' => $data_cad_pis,
            ':nome_conselho_regional' => $nome_conselho_regional,
            ':id_rh_estado_civil' => $id_rh_estado_civil,
            ':id_rh_grau_instrucao_escolar' => $id_rh_grau_instrucao_escolar,
            ':id_sexo' => $id_sexo,
            ':id_rh_cor_pessoa' => $id_rh_cor_pessoa,
            ':id_rh_deficiencia_pessoa' => $id_rh_deficiencia_pessoa,
            ':endereco' => $endereco,
            ':numero' => $numero,
            ':complemento' => $complemento,
            ':bairro' => $bairro,
            ':id_cidade' => $id_cidade,
            ':id_estado' => $id_estado,
            ':cep' => $cep,
            ':id_rh_departamentos' => $id_rh_departamentos,
            ':id_rh_funcoes' => $id_rh_funcoes,
            ':salario_atual' => $salario_atual,
            ':id_local_trabalho_cidade' => $id_local_trabalho_cidade,
            ':id_rateio_folha' => $id_rateio_folha,
            ':membro_cipa' => $membro_cipa,
            ':anotacoes_gerais' => $anotacoes_gerais,
            ':data_saida' => $data_saida,
            ':exame_demissional' => $exame_demissional,
            ':id_status_vinculo' => $id_status_vinculo,
            ':id_rh_empresas' => $id_rh_empresas,
            ':id_rh_unidades' => $id_rh_unidades,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_RH_Funcionarios($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE rh_funcionarios SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_RH_Funcionarioss($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,nome,matricula,nome_pai,nome_mae,nascimento,ctps,data_ctps,titulo_eleitoradmissao,exame_admissional,exame_medico,identidade,
                emissao_identidade,org_emissor_identidade,cpf,pis,data_cad_pis,nome_conselho_regional,id_rh_estado_civil,id_rh_grau_instrucao_escolar,id_sexo,
                id_rh_cor_pessoa,id_rh_deficiencia_pessoa,endereco,numero,complemento,bairro,id_cidade,id_estado,cep,id_rh_departamentos,id_rh_funcoes,
                salario_atual,id_local_trabalho_cidade,id_rateio_folha,membro_cipa,anotacoes_gerais,data_saida,exame_demissional,id_status_vinculo,id_rh_empresas,
                id_rh_unidades,status,data_ultima_alteracao from rh_funcionarios where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

}
