<?php

require '../Model/Herval.php';
require '../Model/Herval_Sintese_Template.php';
$herval = new Herval_Sintese_Template();
$herval->set_id_tipo_unidade(filter_input(INPUT_POST, 'id_tipo_unidade', FILTER_SANITIZE_NUMBER_INT));
$herval->set_id_herval_setor(filter_input(INPUT_POST, 'id_herval_setor', FILTER_SANITIZE_NUMBER_INT));
$herval->set_id_herval_funcao(filter_input(INPUT_POST, 'id_herval_funcao', FILTER_SANITIZE_NUMBER_INT));
$herval->set_agente_fisico(filter_input(INPUT_POST, 'agente_fisico', FILTER_SANITIZE_NUMBER_INT));
$herval->set_agente_quimico(filter_input(INPUT_POST, 'agente_quimico', FILTER_SANITIZE_NUMBER_INT));
$herval->set_agente_biologico(filter_input(INPUT_POST, 'agente_biologico', FILTER_SANITIZE_NUMBER_INT));
$herval->set_agente_ergonomico(filter_input(INPUT_POST, 'agente_ergonomico', FILTER_SANITIZE_NUMBER_INT));
$herval->set_ausencia_de_risco(filter_input(INPUT_POST, 'ausencia_de_risco', FILTER_SANITIZE_NUMBER_INT));
$herval->set_obs_agente_fisico(filter_input(INPUT_POST, 'obs_agente_fisico', FILTER_SANITIZE_STRING));
$herval->set_obs_agente_quimico(filter_input(INPUT_POST, 'obs_agente_quimico', FILTER_SANITIZE_STRING));
$herval->set_obs_agente_biologico(filter_input(INPUT_POST, 'obs_agente_biologico', FILTER_SANITIZE_STRING));
$herval->set_obs_agente_ergonomico(filter_input(INPUT_POST, 'obs_agente_ergonomico', FILTER_SANITIZE_STRING));
$herval->set_obs_ausencia_de_risco(filter_input(INPUT_POST, 'obs_ausencia_de_risco', FILTER_SANITIZE_STRING));
$herval->set_exame_clinico(filter_input(INPUT_POST, 'exame_clinico', FILTER_SANITIZE_NUMBER_INT));
$herval->set_acido_metil_hipurico(filter_input(INPUT_POST, 'acido_metil_hipurico', FILTER_SANITIZE_NUMBER_INT));
$herval->set_hemograma(filter_input(INPUT_POST, 'hemograma', FILTER_SANITIZE_NUMBER_INT));
$herval->set_acido_mandelico(filter_input(INPUT_POST, 'acido_mandelico', FILTER_SANITIZE_NUMBER_INT));
$herval->set_vdrl(filter_input(INPUT_POST, 'vdrl', FILTER_SANITIZE_NUMBER_INT));
$herval->set_reticulocitos(filter_input(INPUT_POST, 'reticulocitos', FILTER_SANITIZE_NUMBER_INT));
$herval->set_parasitologico_fezes(filter_input(INPUT_POST, 'parasitologico_fezes', FILTER_SANITIZE_NUMBER_INT));
$herval->set_cultural_de_orofaringe(filter_input(INPUT_POST, 'cultural_de_orofaringe', FILTER_SANITIZE_NUMBER_INT));
$herval->set_coprocultura(filter_input(INPUT_POST, 'coprocultura', FILTER_SANITIZE_NUMBER_INT));
$herval->set_micologico_de_unha(filter_input(INPUT_POST, 'micologico_de_unha', FILTER_SANITIZE_NUMBER_INT));
$herval->set_audiometria(filter_input(INPUT_POST, 'audiometria', FILTER_SANITIZE_NUMBER_INT));
$herval->set_ecg(filter_input(INPUT_POST, 'ecg', FILTER_SANITIZE_NUMBER_INT));
$herval->set_acuidade_visual(filter_input(INPUT_POST, 'acuidade_visual', FILTER_SANITIZE_NUMBER_INT));
$herval->set_eeg(filter_input(INPUT_POST, 'eeg', FILTER_SANITIZE_NUMBER_INT));
$herval->set_plaquetas(filter_input(INPUT_POST, 'plaquetas', FILTER_SANITIZE_NUMBER_INT));
$herval->set_eritrograma(filter_input(INPUT_POST, 'eritrograma', FILTER_SANITIZE_NUMBER_INT));
$herval->set_acido_tt_muconico(filter_input(INPUT_POST, 'acido_tt_muconico', FILTER_SANITIZE_NUMBER_INT));
$herval->set_glicemia_em_jejum(filter_input(INPUT_POST, 'glicemia_em_jejum', FILTER_SANITIZE_NUMBER_INT));
$herval->set_avaliacao_psicossocial(filter_input(INPUT_POST, 'avaliacao_psicossocial', FILTER_SANITIZE_NUMBER_INT));
$herval->set_acido_hipurico(filter_input(INPUT_POST, 'acido_hipurico', FILTER_SANITIZE_NUMBER_INT));
$herval->set_obs_1(filter_input(INPUT_POST, 'obs_1', FILTER_SANITIZE_NUMBER_INT));
$herval->set_obs_2(filter_input(INPUT_POST, 'obs_2', FILTER_SANITIZE_NUMBER_INT));
$herval->set_obs_3(filter_input(INPUT_POST, 'obs_3', FILTER_SANITIZE_NUMBER_INT));
$herval->set_obs_4(filter_input(INPUT_POST, 'obs_4', FILTER_SANITIZE_NUMBER_INT));
$herval->set_obs_5(filter_input(INPUT_POST, 'obs_5', FILTER_SANITIZE_NUMBER_INT));
$herval->set_obs_6(filter_input(INPUT_POST, 'obs_6', FILTER_SANITIZE_NUMBER_INT));
$herval->set_obs_7(filter_input(INPUT_POST, 'obs_7', FILTER_SANITIZE_NUMBER_INT));
$herval->set_obs_8(filter_input(INPUT_POST, 'obs_8', FILTER_SANITIZE_NUMBER_INT));
$herval->set_obs_9(filter_input(INPUT_POST, 'obs_9', FILTER_SANITIZE_NUMBER_INT));
$herval->set_obs_10(filter_input(INPUT_POST, 'obs_10', FILTER_SANITIZE_NUMBER_INT));

if (($herval->get_agente_fisico() !== '1') and ($herval->get_agente_biologico() !== '1') and ($herval->get_agente_ergonomico() !== '1')
    and ($herval->get_agente_quimico() !== '1') and ($herval->get_ausencia_de_risco() !== '1') and ($herval->get_exame_clinico() !== '1')
    and ($herval->get_acido_metil_hipurico() !== '1') and ($herval->get_hemograma() !== '1')
    and ($herval->get_acido_mandelico() !== '1') and ($herval->get_vdrl() !== '1') and ($herval->get_reticulocitos() !== '1')
    and ($herval->get_parasitologico_fezes() !== '1') and ($herval->get_cultural_de_orofaringe() !== '1')
    and ($herval->get_coprocultura() !== '1') and ($herval->get_micologico_de_unha() !== '1') and ($herval->get_audiometria() !== '1')
    and ($herval->get_ecg() !== '1') and ($herval->get_acuidade_visual() !== '1') and ($herval->get_eeg() !== '1')
    and ($herval->get_plaquetas() !== '1') and ($herval->get_eritrograma() !== '1') and ($herval->get_acido_tt_muconico() !== '1')
    and ($herval->get_glicemia_em_jejum() !== '1') and ($herval->get_acido_hipurico() !== '1') and ($herval->get_avaliacao_psicossocial() !== '1')
    and ($herval->get_obs_1() !== '1')and ($herval->get_obs_2() !== '1')and ($herval->get_obs_3() !== '1')
    and ($herval->get_obs_4() !== '1')and ($herval->get_obs_5() !== '1')and ($herval->get_obs_6() !== '1')
    and ($herval->get_obs_7() !== '1')and ($herval->get_obs_8() !== '1')and ($herval->get_obs_9() !== '1')and ($herval->get_obs_10() !== '1')) {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Preencha pelo Menos um...</div>';
} else {    
    $confirm = $herval->save_Herval_sint_template($herval->get_id_tipo_unidade(), $herval->get_id_herval_setor(), $herval->get_id_herval_funcao(), 
            $herval->get_agente_fisico(), $herval->get_obs_agente_fisico(), $herval->get_agente_quimico(), $herval->get_obs_agente_quimico(), 
            $herval->get_agente_biologico(), $herval->get_obs_agente_biologico(), $herval->get_agente_ergonomico(), $herval->get_obs_agente_ergonomico(), 
            $herval->get_ausencia_de_risco(), $herval->get_obs_ausencia_de_risco(), $herval->get_exame_clinico(), $herval->get_acido_metil_hipurico(), 
            $herval->get_hemograma(), $herval->get_acido_mandelico(), $herval->get_vdrl(), $herval->get_reticulocitos(), $herval->get_parasitologico_fezes(), 
            $herval->get_cultural_de_orofaringe(), $herval->get_coprocultura(), $herval->get_micologico_de_unha(), $herval->get_audiometria(), 
            $herval->get_ecg(), $herval->get_acuidade_visual(), $herval->get_eeg(), $herval->get_plaquetas(), $herval->get_eritrograma(), 
            $herval->get_acido_tt_muconico(), $herval->get_glicemia_em_jejum(), $herval->get_avaliacao_psicossocial(), $herval->get_acido_hipurico(), 
            $herval->get_obs_1(), $herval->get_obs_2(), $herval->get_obs_3(), $herval->get_obs_4(), $herval->get_obs_5(), $herval->get_obs_6(), $herval->get_obs_7(), 
            $herval->get_obs_8(),$herval->get_obs_9(),$herval->get_obs_10());
    echo $confirm == TRUE ? '<div class="alert alert-success" role="alert">Síntese Criada!</div>' : '<div class="alert alert-danger" role="alert">Errou!</div>';
}