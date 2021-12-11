<?php

class Evento_Convocacao extends Convocar {
        public function save_Evento_Convocacao($id_convocacao, $id_datas_evento, $id_responsavel_walmart, $turnos, $empresa, $loja,
                $kit_entregue, $observacao, $vencimento_anterior, $atendimentos, $email_walmart, $email_ama) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $periodo = date('Y');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO evento_convocacao(id_convocacao,id_datas_evento,id_responsavel_walmart,
            turnos,empresa,loja,kit_entregue,observacao,vencimento_anterior,atendimentos,status,email_walmart,email_ama,periodo,data_ultima_alteracao) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_convocacao, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_datas_evento, PDO::PARAM_INT);
        $smtp->bindParam(3, $id_responsavel_walmart, PDO::PARAM_INT);
        $smtp->bindParam(4, $turnos, PDO::PARAM_INT);
        $smtp->bindParam(5, $empresa, PDO::PARAM_INT);
        $smtp->bindParam(6, $loja, PDO::PARAM_INT);
        $smtp->bindParam(7, $kit_entregue, PDO::PARAM_INT);
        $smtp->bindParam(8, $observacao, PDO::PARAM_STR);
        $smtp->bindParam(9, $vencimento_anterior, PDO::PARAM_STR);
        $smtp->bindParam(10, $atendimentos, PDO::PARAM_INT);
        $smtp->bindParam(11, $status, PDO::PARAM_INT);
        $smtp->bindParam(12, $email_walmart, PDO::PARAM_STR);
        $smtp->bindParam(13, $email_ama, PDO::PARAM_STR);
        $smtp->bindParam(14, $periodo, PDO::PARAM_STR);
        $smtp->bindParam(15, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $saveConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $saveConvocacao;
    }

    public function edit_Evento_Convocacao($id, $id_convocacao, $id_datas_evento, $id_responsavel_walmart, $turnos, $empresa, $loja,
                $kit_entregue, $observacao, $vencimento_anterior, $atendimentos, $email_walmart, $email_ama, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();                       
        $smtpup = $pdo->prepare("UPDATE evento_convocacao SET id_convocacao = :id_convocacao, id_datas_evento = :id_datas_evento,
                id_responsavel_walmart = :id_responsavel_walmart, turnos = :turnos, empresa = :empresa, loja = :loja,
                kit_entregue = :kit_entregue, observacao = :observacao, vencimento_anterior = :vencimento_anterior,
                atendimentos = :atendimentos, status = :status, email_walmart = :email_walmart, email_ama = :email_ama, periodo = :periodo,
                data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,':id_convocacao' => $id_convocacao,':id_datas_evento' => $id_datas_evento,':id_responsavel_walmart' => $id_responsavel_walmart,
            ':turnos' => $turnos,':empresa' => $empresa,':loja' => $loja,':kit_entregue' => $kit_entregue,':observacao' => $observacao,
            ':vencimento_anterior' => $vencimento_anterior,':atendimentos' => $atendimentos,':status' => $status,
            ':email_walmart' => $email_walmart,':email_ama' => $email_ama,':periodo' => date('Y'),':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $editConvocacao;
    }
    
    public function edit_Evento_Convocacao_Status($id, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();                       
        $smtpup = $pdo->prepare("UPDATE evento_convocacao SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(':id' => $id,':status' => $status,':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $editConvocacao;
    }
    
    public function edit_Evento_Convocacao_Kit($id, $kit, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();                       
        $smtpup = $pdo->prepare("UPDATE evento_convocacao SET kit_entregue = :kit_entregue, status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(':id' => $id,':kit_entregue' => $kit,':status' => $status,':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $editConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $editConvocacao;
    }

    public function delete_Evento_Convocacao($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE evento_convocacao SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id,
            ':status' => $status,
            ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $deleteConvocacao = $confirm == TRUE ? TRUE : FALSE;
        return $deleteConvocacao;
    }

    public function Dados_Evento_Convocacao($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id, id_convocacao, id_datas_evento, id_responsavel_walmart, turnos, empresa, 
                loja, kit_entregue, observacao, vencimento_anterior, atendimentos,
                status, email_walmart, email_ama from evento_convocacao where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Evento_Convocacao_completos($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select eventche.id as id_convocacao, convoquim.nome_convocacao as convocacao, lojinha.desc_estabelecimento as loja, 
                eventche.turnos as turnos, eventche.kit_entregue as kit, eventche.status as situacao,
                eventche.id as id_evento, count(convocaca.id) as tem_quantos_medicos, eventche.id_responsavel_walmart as responsavel,
                eventche.email_ama as email_ama, eventche.email_walmart as email_walmart, eventche.empresa as cod_empresa, eventche.loja as cod_estabelecimento 
                from evento_convocacao eventche
                inner join convocacao convoquim on convoquim.id = eventche.id_convocacao
                inner join wal_estabelecimento_2016 lojinha on lojinha.cod_estabelecimento = eventche.loja
                inner join medicos_convocacao convocaca on convocaca.id_evento_convocacao = eventche.id
                where eventche.id = ?
                order by convoquim.nome_convocacao";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Evento_Convocacao_ativos($id_loja) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as contar from wal_funcionarios where cod_estabelecimento = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_loja));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $total = $data['contar'];
        Database::disconnect();
        return $total;
    }
    
    public function Dados_Evento_Convocacao_max_id() {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select MAX(id) as max from evento_convocacao";
        $q = $pdo->prepare($sql);
        $q->execute(array());
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $max = $data['max'] == NULL ? 0 : $data['max'];
        Database::disconnect();
        return $max;
    }
}