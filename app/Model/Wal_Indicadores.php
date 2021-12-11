<?php

class Wal_Indicadores extends Walmart {

    public function Quantos_Ativos_wal() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from wal_funcionarios where periodo = 2015";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $temos = $data['temos'];
        Database::disconnect();
        return $temos;
    }
    
    public function Quantos_Ativos_wal2016() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from wal_funcionarios where periodo = '2016a'";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $temos = $data['temos'];
        Database::disconnect();
        return $temos;
    }
    
    public function Quantos_Ativos_wal2016executados() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from wal_funcionarios where periodo = '2016a' and flg_periodico in (1)";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $temos = $data['temos'];
        Database::disconnect();
        return $temos;
    }

    public function Quantos_Ativos_wal_wmb_wms() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select(
                        select count(id) as wmb from wal_funcionarios where periodo = 2015 and regiao = 'WMB'
                        ) as wmb,
                        (
                        select count(id) as wms from wal_funcionarios where periodo = 2015 and regiao = 'WMS'
                        ) as wms";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Quantos_Agendamentos() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from evento_convocacao where year(data_ultima_alteracao) = 2015";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Quantos_Agendamentos2016() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from evento_convocacao where year(data_ultima_alteracao) = 2016";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Quantos_Previsao2016() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from wal_funcionarios where periodo = '2016a' and cod_estabelecimento in (select loja from evento_convocacao where year(data_ultima_alteracao) = 2016)";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Quantos_riscos2016() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from wal_funcionarios where periodo = '2016a' and risco in (1)";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Quantos_Médicos_via_redes() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id_medico) as temos from wal_medico where id_medico not in (1,2,3,4,597) and conselho not in ('informar')";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Quantos_Prestadores_via_redes() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from wal_prestadores where id not in (1,2)";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Media_valor_Medicos() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select round(avg(valor),2) as valor from medicos_valores";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Media_Ponderada_valor_Medicos() {
        include_once '../config/database_mysql.php';
        $somador = 0;
        $funcionarios = 0;
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(lojim.id) as temos, lolo.desc_estabelecimento as nome_loja, evento.loja as id_da_loja, evento.id as id_evento
                from evento_convocacao evento
                inner join wal_funcionarios lojim on lojim.cod_estabelecimento = evento.loja
                inner join wal_estabelecimento lolo on lolo.cod_estabelecimento = evento.loja
                group by evento.loja";

        foreach ($pdo->query($sql) as $value) {
            $temos = $value['temos'];
            $id_evento = $value['id_evento'];
            $sql1 = "select valor from medicos_valores where id_evento_convocacao = " . $id_evento;
            $q = $pdo->prepare($sql1);
            $q->execute();
            $dataa = $q->fetch(PDO::FETCH_ASSOC);

            $somador = bcadd($somador, bcmul($temos, $dataa['valor']), 2);
            $funcionarios = bcadd($funcionarios, $temos);
        }
        $media_ponderada = bcdiv($somador, $funcionarios, 2);
        Database::disconnect();
        return $media_ponderada;
    }
}