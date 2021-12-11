<?php

class TST_Checklist extends Tecnicos_Seguranca_Trabalho {

    public function save_TST_Checklist($id_agendamento, $horario_trabalho, $inicio_vistoria, $termino_vistoria, $data_vistoria, $area_total, $pe_direito, $id_paredes, $id_piso, $id_forro, $id_iluminacao
    , $id_lampadas, $id_ventilacao, $id_tst_checklist_controle_limpeza_arcondicionado, $agua_pc, $agua_validade, $po_pc, $po_validade, $gas_pc, $gas_validade
    , $luz_emergencia_sim, $luz_emergencia_quantas, $luz_emergencia_nao, $id_saida_de_emergencia, $id_tst_checklist_rota_saida_extintores, $numero_funcionarios_quantos, $numero_funcionarios_no_possui_cipa
    , $numero_funcionarios_possui_cipa, $numero_funcionarios_colaborador_designado, $id_tst_checklist_epi, $id_tst_checklist_trei_epi_epc, $id_tst_checklist_entrega_epi
    , $id_tst_checklist_insta_eletrica, $id_tst_checklist_atividades_ambiente, $id_tst_checklist_atividades_ambiente_interno, $id_tst_checklist_refeicoes, $id_tst_checklist_local_refeicoes
    , $id_tst_checklist_insta_sanitarias, $id_tst_checklist_pertence_funcionarios, $id_tst_checklist_avaliacao_ambiente_trab, $id_tst_checklist_seg_integracao, $id_tst_checklist_trein_seg
    , $id_tecnicos, $sugestao_melhoria) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO tst_checklist(id_agendamento,horario_trabalho,inicio_vistoria,termino_vistoria,data_vistoria,area_total,pe_direito,id_paredes,id_piso,
                id_forro,id_iluminacao,id_lampadas,id_ventilacao,id_tst_checklist_controle_limpeza_arcondicionado,agua_pc,agua_validade,po_pc,po_validade,
                gas_pc,gas_validade,luz_emergencia_sim,luz_emergencia_quantas,luz_emergencia_nao,id_saida_de_emergencia,id_tst_checklist_rota_saida_extintores,
                numero_funcionarios_quantos,numero_funcionarios_no_possui_cipa,numero_funcionarios_possui_cipa,numero_funcionarios_colaborador_designado,
                id_tst_checklist_epi,id_tst_checklist_trei_epi_epc,id_tst_checklist_entrega_epi,id_tst_checklist_insta_eletrica,id_tst_checklist_atividades_ambiente,
                id_tst_checklist_atividades_ambiente_interno,id_tst_checklist_refeicoes,id_tst_checklist_local_refeicoes,id_tst_checklist_insta_sanitarias,
                id_tst_checklist_pertence_funcionarios,id_tst_checklist_avaliacao_ambiente_trab,id_tst_checklist_seg_integracao,id_tst_checklist_trein_seg,
                id_tecnicos,sugestao_melhoria,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_agendamento, PDO::PARAM_INT);
        $smtp->bindParam(2, $horario_trabalho, PDO::PARAM_STR);
        $smtp->bindParam(3, $inicio_vistoria, PDO::PARAM_STR);
        $smtp->bindParam(4, $termino_vistoria, PDO::PARAM_STR);
        $smtp->bindParam(5, $data_vistoria, PDO::PARAM_STR);
        $smtp->bindParam(6, $area_total, PDO::PARAM_STR);
        $smtp->bindParam(7, $pe_direito, PDO::PARAM_STR);
        $smtp->bindParam(8, $id_paredes, PDO::PARAM_INT);
        $smtp->bindParam(9, $id_piso, PDO::PARAM_INT);
        $smtp->bindParam(10, $id_forro, PDO::PARAM_INT);
        $smtp->bindParam(11, $id_iluminacao, PDO::PARAM_INT);
        $smtp->bindParam(12, $id_lampadas, PDO::PARAM_INT);
        $smtp->bindParam(13, $id_ventilacao, PDO::PARAM_INT);
        $smtp->bindParam(14, $id_tst_checklist_controle_limpeza_arcondicionado, PDO::PARAM_INT);
        $smtp->bindParam(15, $agua_pc, PDO::PARAM_STR);
        $smtp->bindParam(16, $agua_validade, PDO::PARAM_STR);
        $smtp->bindParam(17, $po_pc, PDO::PARAM_STR);
        $smtp->bindParam(18, $po_validade, PDO::PARAM_STR);
        $smtp->bindParam(19, $gas_pc, PDO::PARAM_STR);
        $smtp->bindParam(20, $gas_validade, PDO::PARAM_STR);
        $smtp->bindParam(21, $luz_emergencia_sim, PDO::PARAM_INT);
        $smtp->bindParam(22, $luz_emergencia_quantas, PDO::PARAM_STR);
        $smtp->bindParam(23, $luz_emergencia_nao, PDO::PARAM_INT);
        $smtp->bindParam(24, $id_saida_de_emergencia, PDO::PARAM_INT);
        $smtp->bindParam(25, $id_tst_checklist_rota_saida_extintores, PDO::PARAM_INT);
        $smtp->bindParam(26, $numero_funcionarios_quantos, PDO::PARAM_STR);
        $smtp->bindParam(27, $numero_funcionarios_no_possui_cipa, PDO::PARAM_INT);
        $smtp->bindParam(28, $numero_funcionarios_possui_cipa, PDO::PARAM_INT);
        $smtp->bindParam(29, $numero_funcionarios_colaborador_designado, PDO::PARAM_INT);
        $smtp->bindParam(30, $id_tst_checklist_epi, PDO::PARAM_INT);
        $smtp->bindParam(31, $id_tst_checklist_trei_epi_epc, PDO::PARAM_INT);
        $smtp->bindParam(32, $id_tst_checklist_entrega_epi, PDO::PARAM_INT);
        $smtp->bindParam(33, $id_tst_checklist_insta_eletrica, PDO::PARAM_INT);
        $smtp->bindParam(34, $id_tst_checklist_atividades_ambiente, PDO::PARAM_INT);
        $smtp->bindParam(35, $id_tst_checklist_atividades_ambiente_interno, PDO::PARAM_INT);
        $smtp->bindParam(36, $id_tst_checklist_refeicoes, PDO::PARAM_INT);
        $smtp->bindParam(37, $id_tst_checklist_local_refeicoes, PDO::PARAM_INT);
        $smtp->bindParam(38, $id_tst_checklist_insta_sanitarias, PDO::PARAM_INT);
        $smtp->bindParam(39, $id_tst_checklist_pertence_funcionarios, PDO::PARAM_INT);
        $smtp->bindParam(40, $id_tst_checklist_avaliacao_ambiente_trab, PDO::PARAM_INT);
        $smtp->bindParam(41, $id_tst_checklist_seg_integracao, PDO::PARAM_INT);
        $smtp->bindParam(42, $id_tst_checklist_trein_seg, PDO::PARAM_INT);
        $smtp->bindParam(43, $id_tecnicos, PDO::PARAM_STR);
        $smtp->bindParam(44, $sugestao_melhoria, PDO::PARAM_STR);
        $smtp->bindParam(45, $status, PDO::PARAM_INT);
        $smtp->bindParam(46, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_TST_Checklist($id, $id_agendamento, $horario_trabalho, $inicio_vistoria, $termino_vistoria, $data_vistoria, $area_total, $pe_direito, $id_paredes, $id_piso, $id_forro, $id_iluminacao
    , $id_lampadas, $id_ventilacao, $id_tst_checklist_controle_limpeza_arcondicionado, $agua_pc, $agua_validade, $po_pc, $po_validade, $gas_pc, $gas_validade
    , $luz_emergencia_sim, $luz_emergencia_quantas, $luz_emergencia_nao, $id_saida_de_emergencia, $id_tst_checklist_rota_saida_extintores, $numero_funcionarios_quantos, $numero_funcionarios_no_possui_cipa
    , $numero_funcionarios_possui_cipa, $numero_funcionarios_colaborador_designado, $id_tst_checklist_epi, $id_tst_checklist_trei_epi_epc, $id_tst_checklist_entrega_epi
    , $id_tst_checklist_insta_eletrica, $id_tst_checklist_atividades_ambiente, $id_tst_checklist_atividades_ambiente_interno, $id_tst_checklist_refeicoes, $id_tst_checklist_local_refeicoes
    , $id_tst_checklist_insta_sanitarias, $id_tst_checklist_pertence_funcionarios, $id_tst_checklist_avaliacao_ambiente_trab, $id_tst_checklist_seg_integracao, $id_tst_checklist_trein_seg
    , $id_tecnicos, $sugestao_melhoria, $status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_checklist SET id_agendamento = :id_agendamento,horario_trabalho = :horario_trabalho,inicio_vistoria = :inicio_vistoria,termino_vistoria = :termino_vistoria,
                                    data_vistoria = :data_vistoria,area_total = :area_total,pe_direito = :pe_direito,id_paredes = :id_paredes,id_piso = :id_piso,id_forro = :id_forro,
                                    id_iluminacao = :id_iluminacao,id_lampadas = :id_lampadas,id_ventilacao = :id_ventilacao,id_tst_checklist_controle_limpeza_arcondicionado = :id_tst_checklist_controle_limpeza_arcondicionado,
                                    agua_pc = :agua_pc,agua_validade = :agua_validade,po_pc = :po_pc,po_validade = :po_validade,gas_pc = :gas_pc,gas_validade = :gas_validade,
                                    luz_emergencia_sim = :luz_emergencia_sim,luz_emergencia_quantas = :luz_emergencia_quantas,luz_emergencia_nao = :luz_emergencia_nao,id_saida_de_emergencia = :id_saida_de_emergencia,
                                    id_tst_checklist_rota_saida_extintores = :id_tst_checklist_rota_saida_extintores,numero_funcionarios_quantos = :numero_funcionarios_quantos,numero_funcionarios_no_possui_cipa = :numero_funcionarios_no_possui_cipa,
                                    numero_funcionarios_possui_cipa = :numero_funcionarios_possui_cipa,numero_funcionarios_colaborador_designado = :numero_funcionarios_colaborador_designado,
                                    id_tst_checklist_epi = :id_tst_checklist_epi,id_tst_checklist_trei_epi_epc = :id_tst_checklist_trei_epi_epc,id_tst_checklist_entrega_epi = :id_tst_checklist_entrega_epi,
                                    id_tst_checklist_insta_eletrica = :id_tst_checklist_insta_eletrica,id_tst_checklist_atividades_ambiente = :id_tst_checklist_atividades_ambiente,
                                    id_tst_checklist_atividades_ambiente_interno = :id_tst_checklist_atividades_ambiente_interno,id_tst_checklist_refeicoes = :id_tst_checklist_refeicoes,
                                    id_tst_checklist_local_refeicoes = :id_tst_checklist_local_refeicoes,id_tst_checklist_insta_sanitarias = :id_tst_checklist_insta_sanitarias,
                                    id_tst_checklist_pertence_funcionarios = :id_tst_checklist_pertence_funcionarios,id_tst_checklist_avaliacao_ambiente_trab = :id_tst_checklist_avaliacao_ambiente_trab,
                                    id_tst_checklist_seg_integracao = :id_tst_checklist_seg_integracao,id_tst_checklist_trein_seg = :id_tst_checklist_trein_seg,id_tecnicos = :id_tecnicos,
                                    sugestao_melhoria = :sugestao_melhoria,status = :status,data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(
            ':id' => $id, ':id_agendamento' => $id_agendamento, ':horario_trabalho' => $horario_trabalho, ':inicio_vistoria' => $inicio_vistoria,
            ':termino_vistoria' => $termino_vistoria, ':data_vistoria' => $data_vistoria, ':area_total' => $area_total, ':pe_direito' => $pe_direito,
            ':id_paredes' => $id_paredes, ':id_piso' => $id_piso, ':id_forro' => $id_forro, ':id_iluminacao' => $id_iluminacao,
            ':id_lampadas' => $id_lampadas, ':id_ventilacao' => $id_ventilacao, ':id_tst_checklist_controle_limpeza_arcondicionado' => $id_tst_checklist_controle_limpeza_arcondicionado,
            ':agua_pc' => $agua_pc, ':agua_validade' => $agua_validade, ':po_pc' => $po_pc, ':po_validade' => $po_validade, ':gas_pc' => $gas_pc,
            ':gas_validade' => $gas_validade, ':luz_emergencia_sim' => $luz_emergencia_sim, ':luz_emergencia_quantas' => $luz_emergencia_quantas,
            ':luz_emergencia_nao' => $luz_emergencia_nao, ':id_saida_de_emergencia' => $id_saida_de_emergencia, ':id_tst_checklist_rota_saida_extintores' => $id_tst_checklist_rota_saida_extintores,
            ':numero_funcionarios_quantos' => $numero_funcionarios_quantos, ':numero_funcionarios_no_possui_cipa' => $numero_funcionarios_no_possui_cipa,
            ':numero_funcionarios_possui_cipa' => $numero_funcionarios_possui_cipa, ':numero_funcionarios_colaborador_designado' => $numero_funcionarios_colaborador_designado,
            ':id_tst_checklist_epi' => $id_tst_checklist_epi, ':id_tst_checklist_trei_epi_epc' => $id_tst_checklist_trei_epi_epc, ':id_tst_checklist_entrega_epi' => $id_tst_checklist_entrega_epi,
            ':id_tst_checklist_insta_eletrica' => $id_tst_checklist_insta_eletrica, ':id_tst_checklist_atividades_ambiente' => $id_tst_checklist_atividades_ambiente,
            ':id_tst_checklist_atividades_ambiente_interno' => $id_tst_checklist_atividades_ambiente_interno, ':id_tst_checklist_refeicoes' => $id_tst_checklist_refeicoes,
            ':id_tst_checklist_local_refeicoes' => $id_tst_checklist_local_refeicoes, ':id_tst_checklist_insta_sanitarias' => $id_tst_checklist_insta_sanitarias,
            ':id_tst_checklist_pertence_funcionarios' => $id_tst_checklist_pertence_funcionarios, ':id_tst_checklist_avaliacao_ambiente_trab' => $id_tst_checklist_avaliacao_ambiente_trab,
            ':id_tst_checklist_seg_integracao' => $id_tst_checklist_seg_integracao, ':id_tst_checklist_trein_seg' => $id_tst_checklist_trein_seg,
            ':id_tecnicos' => $id_tecnicos, ':sugestao_melhoria' => $sugestao_melhoria, ':status' => $status, ':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function delete_TST_Checklist($id) {
        include_once '../config/database_mysql.php';
        $status = 0;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtpup = $pdo->prepare("UPDATE tst_checklist SET status = :status, data_ultima_alteracao = :data_ultima_alteracao WHERE id = :id");
        $confirm = $smtpup->execute(array(':id' => $id,':status' => $status,':data_ultima_alteracao' => $data_ultima_alteracao));
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;
    }

    public function Dados_TST_Checklists($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_agendamento,horario_trabalho,inicio_vistoria,termino_vistoria,data_vistoria,area_total,pe_direito,id_paredes,id_piso,
                id_forro,id_iluminacao,id_lampadas,id_ventilacao,id_tst_checklist_controle_limpeza_arcondicionado,agua_pc,agua_validade,po_pc,po_validade,
                gas_pc,gas_validade,luz_emergencia_sim,luz_emergencia_quantas,luz_emergencia_nao,id_saida_de_emergencia,id_tst_checklist_rota_saida_extintores,
                numero_funcionarios_quantos,numero_funcionarios_no_possui_cipa,numero_funcionarios_possui_cipa,numero_funcionarios_colaborador_designado,
                id_tst_checklist_epi,id_tst_checklist_trei_epi_epc,id_tst_checklist_entrega_epi,id_tst_checklist_insta_eletrica,id_tst_checklist_atividades_ambiente,
                id_tst_checklist_atividades_ambiente_interno,id_tst_checklist_refeicoes,id_tst_checklist_local_refeicoes,id_tst_checklist_insta_sanitarias,
                id_tst_checklist_pertence_funcionarios,id_tst_checklist_avaliacao_ambiente_trab,id_tst_checklist_seg_integracao,id_tst_checklist_trein_seg,
                id_tecnicos,sugestao_melhoria,status,data_ultima_alteracao from tst_checklist where id_agendamento = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
}