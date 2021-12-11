<?php

require '../Model/Cassi.php';
require '../Model/Cassi_Ativos.php';
require '../Model/Cassi_Valores_Autonomos.php';
require '../Model/Medico.php';
require '../Model/Medicos.php';
$medico = new Medicos();
$ativos = new Cassi_Ativos();
$autonomo = new Cassi_Valores_Autonomos();
$ativos->set_id_medico(filter_input(INPUT_POST, 'id_medico', FILTER_SANITIZE_NUMBER_INT));
$ativos->set_id(filter_input(INPUT_POST, 'id_funcionario', FILTER_SANITIZE_NUMBER_INT));
$ativos->set_finalizado(filter_input(INPUT_POST, 'finalizado', FILTER_SANITIZE_NUMBER_INT));
$ativos->set_pendente(filter_input(INPUT_POST, 'pendente', FILTER_SANITIZE_NUMBER_INT));
$ativos->set_nao_realizou(filter_input(INPUT_POST, 'nao_realizou', FILTER_SANITIZE_NUMBER_INT));
$ativos->set_valor_consulta(filter_input(INPUT_POST, 'consulta', FILTER_SANITIZE_STRING));
$ativos->set_funcionario_ausente(filter_input(INPUT_POST, 'funcionario_ausente', FILTER_SANITIZE_NUMBER_INT));
$ativos->set_obs_gerais(filter_input(INPUT_POST, 'obs_gerais', FILTER_SANITIZE_STRING));
$dados_medicos = $medico->Dados_Medicos($ativos->get_id_medico());
$obs = $dados_medicos['nome'] . ' - ' . $ativos->get_obs_gerais();

if (($ativos->get_finalizado() === '0') and ($ativos->get_pendente() === '0') and ($ativos->get_nao_realizou() === '0') and ($ativos->get_funcionario_ausente() === '0')) {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Preencha pelo Menos um Flag (Motivo)...</div>';
} else {
    if (($ativos->get_nao_realizou() === '1') or ($ativos->get_funcionario_ausente() === '1')) {
        $id_cassi_situacao = 2;
        $confirm_pendencias = $ativos->edit_Cassi_Situacao_Ativos($ativos->get_id(), $id_cassi_situacao, $obs);
        $autonomo->save_Cassi_Valores_Autonomos($ativos->get_id(), $ativos->get_id_medico(), $ativos->get_valor_consulta());
        if ($confirm_pendencias === TRUE) {
            echo '<div class="alert alert-success alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            Observações do Funcionário Inseridas com Sucesso!!</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  Erro!! Contate a TI-AMA...</div>';
        }
    } else {
        if (($ativos->get_finalizado() === '1') or ($ativos->get_pendente() === '1')) {
            $id_cassi_situacao = 3;
            $confirm_pendencia = $ativos->edit_Cassi_Situacao_Ativos($ativos->get_id(), $id_cassi_situacao, $obs);
            $autonomo->save_Cassi_Valores_Autonomos($ativos->get_id(), $ativos->get_id_medico(), $ativos->get_valor_consulta());
            if ($confirm_pendencia === TRUE) {
                echo '<div class="alert alert-success alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            Observações do Funcionário Inseridas com Sucesso!!</div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  Erro!! Contate a TI-AMA...</div>';
            }
        }
    }
}