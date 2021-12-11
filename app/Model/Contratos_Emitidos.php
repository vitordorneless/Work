<?php

class Contratos_Emitidos {
    public function save_Contratos_Emitidos($nome,$cnpj,$rua,$bairro,$cidade,
            $cep,$data_cadastro,$valor,$valor_extenso,$vigencia_start,$vigencia_end,$data_geracao,$usuario_geracao) {
        include_once '../config/database_mysql.php';        
        $pdo = Database::connect();
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $smtp = $pdo->prepare("INSERT INTO wal_contratos_emitidos(nome,cnpj,rua,bairro,cidade,
            cep,data_cadastro,valor,valor_extenso,vigencia_start,vigencia_end,data_geracao,usuario_geracao,status,data_ultima_alteracao) 
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $nome, PDO::PARAM_STR);
        $smtp->bindParam(2, $cnpj, PDO::PARAM_STR);
        $smtp->bindParam(3, $rua, PDO::PARAM_STR);
        $smtp->bindParam(4, $bairro, PDO::PARAM_STR);
        $smtp->bindParam(5, $cidade, PDO::PARAM_STR);
        $smtp->bindParam(6, $cep, PDO::PARAM_STR);
        $smtp->bindParam(7, $data_cadastro, PDO::PARAM_STR);
        $smtp->bindParam(8, $valor, PDO::PARAM_STR);
        $smtp->bindParam(9, $valor_extenso, PDO::PARAM_STR);        
        $smtp->bindParam(10, $vigencia_start, PDO::PARAM_STR);
        $smtp->bindParam(11, $vigencia_end, PDO::PARAM_STR);
        $smtp->bindParam(12, $data_geracao, PDO::PARAM_STR);
        $smtp->bindParam(13, $usuario_geracao, PDO::PARAM_INT);
        $smtp->bindParam(14, $status, PDO::PARAM_INT);
        $smtp->bindParam(15, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }
}
