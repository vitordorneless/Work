<?php

class Grafica {
    
    public function Vai_gerar_TXT($empresa,$loja) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select if(count(funfun.id) > 0, '1','0') as posso_gerar_amiguinho
                from wal_funcionarios funfun                
                where funfun.cod_empresa = $empresa and funfun.cod_estabelecimento = $loja 
                and funfun.exame = 1 and funfun.risco = 1 
                order by funfun.cod_depto";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $vaigerar = $data['posso_gerar_amiguinho'] == 1 ? TRUE : FALSE;
        Database::disconnect();
        return $vaigerar;
    }
    
    public function Dados_Medico_Coordenador($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, nome, cargo, conselho from pcmso_coordenadores where id = ? and ativo = 1 order by nome";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}
