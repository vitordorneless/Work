<?php

class Demandas extends Demanda {

    public function saveDemanda($id_user_abertura, $id_user_abertura_setor, $destino_setor, $id_responsavel, $executantes, $id_demanda, $copyemail, $id_prazo, $id_status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $fechamento = 0;
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO demandas(id_user_abertura,id_user_abertura_setor,destino_setor,id_responsavel,executantes,id_demanda,copy_email,id_prazo,id_status,data_ultima_alteracao,data_fechamento) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_user_abertura, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_user_abertura_setor, PDO::PARAM_INT);
        $smtp->bindParam(3, $destino_setor, PDO::PARAM_STR);
        $smtp->bindParam(4, $id_responsavel, PDO::PARAM_INT);
        $smtp->bindParam(5, $executantes, PDO::PARAM_STR);
        $smtp->bindParam(6, $id_demanda, PDO::PARAM_INT);
        $smtp->bindParam(7, $copyemail, PDO::PARAM_STR);
        $smtp->bindParam(8, $id_prazo, PDO::PARAM_INT);
        $smtp->bindParam(9, $id_status, PDO::PARAM_INT);
        $smtp->bindParam(10, $data_ultima_alteracao, PDO::PARAM_STR);
        $smtp->bindParam(11, $fechamento, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveDemanda = $confirm == TRUE ? TRUE : FALSE;
        return $saveDemanda;
    }

    public function editDemanda($id, $id_user_abertura, $id_user_abertura_setor, $destino_setor, $id_responsavel, $executantes, $id_demanda, $copyemail, $id_prazo, $id_status, $data_ultima_alteracao) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE demandas SET id_user_abertura = :id_user_abertura,id_user_abertura_setor = :id_user_abertura_setor,
                                destino_setor = :destino_setor,id_responsavel = :id_responsavel,
                                executantes = :executantes,id_demanda = :id_demanda,
                                copy_email = :copy_email,id_prazo = :id_prazo,
                                id_status = :id_status,data_ultima_alteracao = :data_ultima_alteracao,data_fechamento = :data_fechamento WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':id_user_abertura' => $id_user_abertura,
            ':id_user_abertura_setor' => $id_user_abertura_setor,
            ':destino_setor' => $destino_setor,
            ':id_responsavel' => $id_responsavel,
            ':executantes' => $executantes,
            ':id_demanda' => $id_demanda,
            ':copy_email' => $copyemail,
            ':id_prazo' => $id_prazo,
            ':id_status' => $id_status,
            ':data_ultima_alteracao' => $data_ultima_alteracao,
            ':data_fechamento' => 0));
        Database::disconnect();
        $editRisco = $confirm == TRUE ? TRUE : FALSE;
        return $editRisco;
    }

    public function TransfereditDemanda($id, $executantes) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE demandas SET executantes = :executantes WHERE id = :id");
        $confirm = $smtpup->execute(array(':id' => $id, ':executantes' => $executantes));
        Database::disconnect();
        $editRisco = $confirm == TRUE ? TRUE : FALSE;
        return $editRisco;
    }

    public function editDemandaStatus($id, $id_status) {
        include_once '../config/database_mysql.php';
        $data_fechamento = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE demandas SET id_status = :id_status, data_fechamento = :data_fechamento WHERE id = :id");
        $confirm = $smtpup->execute(array(':id' => $id, ':id_status' => $id_status, ':data_fechamento' => $data_fechamento));
        Database::disconnect();
        $editRisco = $confirm == TRUE ? TRUE : FALSE;
        return $editRisco;
    }

    public function Dados_Demandas($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_user_abertura,id_user_abertura_setor,destino_setor,id_responsavel,executantes,id_demanda,copy_email,id_prazo,id_status,data_ultima_alteracao from demandas where id = ?";
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
        $sql = "select max(id) + 1 as next from demandas";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $voucher = date('Y') . '0' . $data['next'];
        Database::disconnect();
        return $voucher;
    }

    public function Total_demandas() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from demandas";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function media_tempo($setor) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select avg(ROUND(((UNIX_TIMESTAMP(data_fechamento) - UNIX_TIMESTAMP(data_ultima_alteracao)) / 60))) as media
                from demandas                
                where date(data_ultima_alteracao) = date(data_fechamento) and id_status in (2) and destino_setor = ".$setor;
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function media_tempo_Geral() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select avg(ROUND(((UNIX_TIMESTAMP(data_fechamento) - UNIX_TIMESTAMP(data_ultima_alteracao)) / 60))) as media
                from demandas                
                where date(data_ultima_alteracao) = date(data_fechamento) and id_status in (2)";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Total_demandas_funcionario($setor) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select b.nome_extenso, count(a.id) as demandas
                from demandas a
                inner join usuarios b on a.executantes = b.id
                where a.destino_setor = ".$setor."
                group by b.nome_extenso
                order by demandas desc
                limit 1;";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Total_demandas_funcionario_Geral() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select b.nome_extenso, count(a.id) as demandas
                from demandas a
                inner join usuarios b on a.executantes = b.id                
                group by b.nome_extenso
                order by demandas desc
                limit 1;";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Total_demandas_open($setor) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select sum(if(a.id_status = 1,1,0)) as aberto, sum(if(a.id_status = 2,1,0)) as fechado
                from demandas a                
                where a.destino_setor = ".$setor;
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $array = array('aberto'=> $data['aberto'],'fechado'=>$data['fechado']);
        Database::disconnect();        
        return $array;
    }
    
    public function Line_chart_estilo() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select a.data_ultima_alteracao as data_ultima_alteracao, a.data_fechamento as data_fechamento, a.id_prazo as id_prazo, b.tipo as tipo
                from demandas a 
                inner join demandas_prazos b on a.id_prazo = b.id
                where day(a.data_ultima_alteracao) = day(a.data_fechamento) and a.id_status in (2) 
                order by a.id desc 
                limit 1";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $array = array('data_ultima_alteracao'=> $data['data_ultima_alteracao'],'data_fechamento'=>$data['data_fechamento'],'id_prazo'=>$data['id_prazo'],'tipo'=>$data['tipo']);
        Database::disconnect();        
        return $array;
    }
    
    public function Total_demandas_open_Geral() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select sum(if(a.id_status = 1,1,0)) as aberto, sum(if(a.id_status = 2,1,0)) as fechado
                from demandas a";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $array = array('aberto'=> $data['aberto'],'fechado'=>$data['fechado']);
        Database::disconnect();        
        return $array;
    }
    
    public function Total_demandas_Qualidade() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select sum(if(id_status_qualidade=1,1,0)) as bom, sum(if(id_status_qualidade=2,1,0)) as ruim, sum(if(id_status_qualidade=3,1,0)) as ruim_demaise, sum(if(id_status_qualidade=0,1,0)) as nada
                from demandas_registros_execute";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $array = array('bom'=> $data['bom'],'ruim'=>$data['ruim'],'ruim_demaise'=>$data['ruim_demaise'],'nada'=>$data['nada']);
        Database::disconnect();        
        return $array;
    }
    
    public function top_five_demandas($setor) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select b.tipo_demanda, count(a.id) as demandas
                from demandas a
                inner join demandas_tipos_de_demandas b on a.id_demanda = b.id
                where a.destino_setor = ".$setor."
                group by b.tipo_demanda
                order by demandas desc
                limit 5";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public function Indicadores_Demandas($id_executante) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $cont_vencida = 0;
        $cont_no_prazo = 0;
        $cont_venc_hoje = 0;
        $cont_realizados = 0;
        $date_default = new DateTime();
        $hoje = $date_default->format('Y-m-d');
        foreach ($pdo->query('select executantes,id_prazo,id_status,data_ultima_alteracao from demandas where executantes = ' . $id_executante) as $value) {
            $sql_prazo = "select concat(prazo,' ',tipo) as prazim, prazo, tipo from demandas_prazos where status in (1) and id = " . $value['id_prazo'];
            $qqqqqqqq = $pdo->prepare($sql_prazo);
            $qqqqqqqq->execute();
            $data_prazo = $qqqqqqqq->fetch(PDO::FETCH_ASSOC);
            $dt_ult_alt = new DateTime($value['data_ultima_alteracao']);
            switch ($data_prazo['tipo']) {
                case 'horas':
                    $dt_ult_alt->add(new DateInterval("PT" . $data_prazo['prazo'] . "H"));
                    $comparador = $dt_ult_alt->format('Y-m-d');
                    break;
                case 'dias':
                    $dt_ult_alt->add(new DateInterval("P" . $data_prazo['prazo'] . "D"));
                    $comparador = $dt_ult_alt->format('Y-m-d');
                    break;
                case 'semanas':
                    $dt_ult_alt->add(new DateInterval("P" . $data_prazo['prazo'] . "W"));
                    $comparador = $dt_ult_alt->format('Y-m-d');
                    break;
                case 'meses':
                    $dt_ult_alt->add(new DateInterval("P" . $data_prazo['prazo'] . "M"));
                    $comparador = $dt_ult_alt->format('Y-m-d');
                    break;
            }
            $prazo_demanda = new DateTime($comparador);
            $hooje = new DateTime($hoje);

            switch ($value['id_status']) {
                case '1':
                    if ($prazo_demanda < $hooje) {
                        ++$cont_vencida;
                    } else if ($prazo_demanda > $hooje) {
                        ++$cont_no_prazo;
                    } else if ($prazo_demanda == $hooje) {
                        ++$cont_venc_hoje;
                    }
                    break;
                case '2':
                    ++$cont_realizados;
                    break;
                case '3':
                    ++$cont_realizados;
                    break;
                case '4':
                    if ($prazo_demanda < $hooje) {
                        ++$cont_vencida;
                    } else if ($prazo_demanda > $hooje) {
                        ++$cont_no_prazo;
                    } else if ($prazo_demanda == $hooje) {
                        ++$cont_venc_hoje;
                    }
                    break;
                case '5':
                    if ($prazo_demanda < $hooje) {
                        ++$cont_vencida;
                    } else if ($prazo_demanda > $hooje) {
                        ++$cont_no_prazo;
                    } else if ($prazo_demanda == $hooje) {
                        ++$cont_venc_hoje;
                    }
                    break;
            }
        }
        $dados = array('vencida' => $cont_vencida, 'no_prazo' => $cont_no_prazo, 'vence_hoje' => $cont_venc_hoje, 'realizados' => $cont_realizados);
        Database::disconnect();
        return $dados;
    }

}
