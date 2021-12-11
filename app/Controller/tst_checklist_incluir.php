<?php

session_start();
require '../Model/Tecnicos_Seguranca_Trabalho.php';
require '../Model/TST_Checklist.php';
require '../Model/TST_Log.php';
require '../Model/TST_Agendamento.php';
$tst = new TST_Checklist();
$log = new TST_Log();
$agendamento = new TST_Agendamento();

$tst->set_id_agendamento(filter_input(INPUT_POST, 'id_agendamento', FILTER_SANITIZE_NUMBER_INT));
$tst->set_horario_trabalho(filter_input(INPUT_POST, 'horario_trabalho', FILTER_SANITIZE_STRING));
$tst->set_inicio_vistoria(filter_input(INPUT_POST, 'inicio_vistoria', FILTER_SANITIZE_STRING));
$tst->set_termino_vistoria(filter_input(INPUT_POST, 'termino_vistoria', FILTER_SANITIZE_STRING));
$tst->set_data_vistoria(filter_input(INPUT_POST, 'data_vistoria', FILTER_SANITIZE_STRING));
$tst->set_area_total(filter_input(INPUT_POST, 'area_total', FILTER_SANITIZE_STRING));
$tst->set_pe_direito(filter_input(INPUT_POST, 'pe_direito', FILTER_SANITIZE_STRING));
$tst->set_id_paredes(filter_input(INPUT_POST, 'id_paredes', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_piso(filter_input(INPUT_POST, 'id_piso', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_forro(filter_input(INPUT_POST, 'id_forro', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_iluminacao(filter_input(INPUT_POST, 'id_iluminacao', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_lampadas(filter_input(INPUT_POST, 'id_lampadas', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_ventilacao(filter_input(INPUT_POST, 'id_ventilacao', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_controle_limpeza_arcondicionado(filter_input(INPUT_POST, 'id_tst_checklist_controle_limpeza_arcondicionado', FILTER_SANITIZE_NUMBER_INT));
$tst->set_agua_pc(filter_input(INPUT_POST, 'agua_pc', FILTER_SANITIZE_STRING));
$tst->set_agua_validade(filter_input(INPUT_POST, 'agua_validade', FILTER_SANITIZE_STRING));
$tst->set_po_pc(filter_input(INPUT_POST, 'po_pc', FILTER_SANITIZE_STRING));
$tst->set_po_validade(filter_input(INPUT_POST, 'po_validade', FILTER_SANITIZE_STRING));
$tst->set_gas_pc(filter_input(INPUT_POST, 'gas_pc', FILTER_SANITIZE_STRING));
$tst->set_gas_validade(filter_input(INPUT_POST, 'gas_validade', FILTER_SANITIZE_STRING));
$tst->set_luz_emergencia_sim(filter_input(INPUT_POST, 'luz_emergencia_sim', FILTER_SANITIZE_NUMBER_INT));
$tst->set_luz_emergencia_quantas(filter_input(INPUT_POST, 'luz_emergencia_quantas', FILTER_SANITIZE_STRING));
$tst->set_luz_emergencia_nao(filter_input(INPUT_POST, 'luz_emergencia_nao', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_saida_de_emergencia(filter_input(INPUT_POST, 'id_saida_de_emergencia', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_rota_saida_extintores(filter_input(INPUT_POST, 'id_tst_checklist_rota_saida_extintores', FILTER_SANITIZE_NUMBER_INT));
$tst->set_numero_funcionarios_quantos(filter_input(INPUT_POST, 'numero_funcionarios_quantos', FILTER_SANITIZE_STRING));
$tst->set_numero_funcionarios_no_possui_cipa(filter_input(INPUT_POST, 'numero_funcionarios_no_possui_cipa', FILTER_SANITIZE_NUMBER_INT));
$tst->set_numero_funcionarios_possui_cipa(filter_input(INPUT_POST, 'numero_funcionarios_possui_cipa', FILTER_SANITIZE_NUMBER_INT));
$tst->set_numero_funcionarios_colaborador_designado(filter_input(INPUT_POST, 'numero_funcionarios_colaborador_designado', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_epi(filter_input(INPUT_POST, 'id_tst_checklist_epi', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_trei_epi_epc(filter_input(INPUT_POST, 'id_tst_checklist_trei_epi_epc', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_entrega_epi(filter_input(INPUT_POST, 'id_tst_checklist_entrega_epi', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_insta_eletrica(filter_input(INPUT_POST, 'id_tst_checklist_insta_eletrica', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_atividades_ambiente(filter_input(INPUT_POST, 'id_tst_checklist_atividades_ambiente', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_atividades_ambiente_interno(filter_input(INPUT_POST, 'id_tst_checklist_atividades_ambiente_interno', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_refeicoes(filter_input(INPUT_POST, 'id_tst_checklist_refeicoes', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_local_refeicoes(filter_input(INPUT_POST, 'id_tst_checklist_local_refeicoes', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_insta_sanitarias(filter_input(INPUT_POST, 'id_tst_checklist_insta_sanitarias', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_pertence_funcionarios(filter_input(INPUT_POST, 'id_tst_checklist_pertence_funcionarios', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_avaliacao_ambiente_trab(filter_input(INPUT_POST, 'id_tst_checklist_avaliacao_ambiente_trab', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_seg_integracao(filter_input(INPUT_POST, 'id_tst_checklist_seg_integracao', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tst_checklist_trein_seg(filter_input(INPUT_POST, 'id_tst_checklist_trein_seg', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_tecnicos(filter_input(INPUT_POST, 'id_tecnicos', FILTER_SANITIZE_STRING));
$tst->set_sugestao_melhoria(filter_input(INPUT_POST, 'sugestao_melhoria', FILTER_SANITIZE_STRING));

$confirm = $tst->save_TST_Checklist($tst->get_id_agendamento(), $tst->get_horario_trabalho(), $tst->get_inicio_vistoria(), $tst->get_termino_vistoria(), $tst->get_data_vistoria(), $tst->get_area_total(), $tst->get_pe_direito(), $tst->get_id_paredes(), $tst->get_id_piso(), $tst->get_id_forro(), $tst->get_id_iluminacao(), $tst->get_id_lampadas(), $tst->get_id_ventilacao(), $tst->get_id_tst_checklist_controle_limpeza_arcondicionado(), $tst->get_agua_pc(), $tst->get_agua_validade(), $tst->get_po_pc(), $tst->get_po_validade(), $tst->get_gas_pc(), $tst->get_gas_validade(), $tst->get_luz_emergencia_sim(), $tst->get_luz_emergencia_quantas(), $tst->get_luz_emergencia_nao(), $tst->get_id_saida_de_emergencia(), $tst->get_id_tst_checklist_rota_saida_extintores(), $tst->get_numero_funcionarios_quantos(), $tst->get_numero_funcionarios_no_possui_cipa(), $tst->get_numero_funcionarios_possui_cipa(), $tst->get_numero_funcionarios_colaborador_designado(), $tst->get_id_tst_checklist_epi(), $tst->get_id_tst_checklist_trei_epi_epc(), $tst->get_id_tst_checklist_entrega_epi(), $tst->get_id_tst_checklist_insta_eletrica(), $tst->get_id_tst_checklist_atividades_ambiente(), $tst->get_id_tst_checklist_atividades_ambiente_interno(), $tst->get_id_tst_checklist_refeicoes(), $tst->get_id_tst_checklist_local_refeicoes(), $tst->get_id_tst_checklist_insta_sanitarias(), $tst->get_id_tst_checklist_pertence_funcionarios(), $tst->get_id_tst_checklist_avaliacao_ambiente_trab(), $tst->get_id_tst_checklist_seg_integracao(), $tst->get_id_tst_checklist_trein_seg(), $tst->get_id_tecnicos(), $tst->get_sugestao_melhoria());

if ($confirm === TRUE) {
    $agendamento->edit_TST_Agendamento_Checklist($tst->get_id_agendamento());
    $log->save_TST_Log('Inclusão de Checklist do Agendamento  ' . $tst->get_id_agendamento(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 1);
    echo '<div class="alert alert-success" role="alert">Checklist Criada!</div>';
}else{
    $log->save_TST_Log('Inclusão de Checklist do Agendamento com erro ', $_SESSION['user_id'], date('Y-m-d H:i:s'), 0);
    echo '<div class="alert alert-danger" role="alert">Errou!</div>';
}