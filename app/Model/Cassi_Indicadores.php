<?php

class Cassi_Indicadores extends Cassi {

    public function Quantas_Agencias_Cassi() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from cassi_agencia";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $temos = $data['temos'];
        Database::disconnect();
        return $temos;
    }

    public function Quantas_Ativos_Cassi() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from cassi_ativos where status = 1";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $temos = $data['temos'];
        Database::disconnect();
        return $temos;
    }

    public function Quantas_Agendamentos_Cassi() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from cassi_agendamento";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $temos = $data['temos'];
        Database::disconnect();
        return $temos;
    }

    public function Quantas_Agendamentos_Concluidos_Cassi() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from cassi_agendamento where id_cassi_situacao in (3,28)";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $temos = $data['temos'];
        Database::disconnect();
        return $temos;
    }

    public function Quantas_Agendamentos_No_Concluidos_Cassi() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) AS temos from cassi_agendamento where id_cassi_situacao not in (3,28)";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $temos = $data['temos'];
        Database::disconnect();
        return $temos;
    }

    public function Quantas_Carta_Remessa() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from cassi_carta_remessa";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $temos = $data['temos'];
        Database::disconnect();
        return $temos;
    }
    
    public function Quantos_Formularios() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select sum(guias_anexas) as temos from cassi_carta_remessa";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $temos = $data['temos'];
        Database::disconnect();
        return $temos;
    }

    public function Quantas_Girl_and_Man_Cassi() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select(select count(id) from cassi_ativos where id_sexo = 1 and status = 1) as hominho, (select count(id) from cassi_ativos where id_sexo = 2 and status = 1) as muie";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Situacao_Ativos_CASSI() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select
                    (select count(id) from cassi_ativos where id_cassi_situacao in (0,1) and status = 1) as no_agends,
                    (select count(id) from cassi_ativos where id_cassi_situacao = 2 and status = 1) as agends,
                    (select count(id) from cassi_ativos where id_cassi_situacao = 3 and status = 1) as realizadis";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Valores_CASSI() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select sum(guias_anexas) * 72 as guias from cassi_carta_remessa";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Valores_CASSI_Lucro() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $guarda_valores = 0;
        $sql30 = "select id_medico, valor_consulta, municipio as id_agencia from cassi_agendamento where id_medico = 598";
        foreach ($pdo->query($sql30) as $value) {
            $id_medico = $value['id_medico'];
            $valor = $value['valor_consulta'];
            $id_agencia = $value['id_agencia'];
            $sql31 = "select prefixo from cassi_agencia where id = $id_agencia";
            $q31 = $pdo->prepare($sql31);
            $q31->execute();
            $data31 = $q31->fetch(PDO::FETCH_ASSOC);
            $agencia = $data31['prefixo'];
            $sql32 = "select count(id) as temos from cassi_ativos where prefixo_agencia = $agencia and id_cassi_situacao = 3";
            $q32 = $pdo->prepare($sql32);
            $q32->execute();
            $data32 = $q32->fetch(PDO::FETCH_ASSOC);
            $result = bcmul($data32['temos'], (float) $valor, 2);
            $guarda_valores = bcadd($guarda_valores, $result, 2);
        }
        $sql33 = "select id_medico, valor_consulta, municipio as id_agencia from cassi_agendamento where id_medico = 599";
        foreach ($pdo->query($sql33) as $value) {
            $id_medico = $value['id_medico'];
            $valor = $value['valor_consulta'];
            $id_agencia = $value['id_agencia'];
            $sql34 = "select prefixo from cassi_agencia where id = $id_agencia";
            $q34 = $pdo->prepare($sql34);
            $q34->execute();
            $data34 = $q34->fetch(PDO::FETCH_ASSOC);
            $agencia = $data34['prefixo'];
            $sql35 = "select count(id) as temos from cassi_ativos where prefixo_agencia = $agencia and id_cassi_situacao = 3";
            $q35 = $pdo->prepare($sql35);
            $q35->execute();
            $data35 = $q35->fetch(PDO::FETCH_ASSOC);
            $result = bcmul($data35['temos'], (float) $valor, 2);
            $guarda_valores = bcadd($guarda_valores, $result, 2);
        }
        Database::disconnect();
        return $guarda_valores;
    }
}
