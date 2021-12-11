<?php

session_start();
include '../config/database_mysql.php';
$pdo = Database::connect();
$periodico = filter_input(INPUT_GET, 'periodico', FILTER_SANITIZE_STRING);
$dataperiodico = filter_input(INPUT_GET, 'data_periodico', FILTER_SANITIZE_STRING);
$caixa = filter_input(INPUT_GET, 'caixa', FILTER_SANITIZE_NUMBER_INT);
$id_medico = filter_input(INPUT_GET, 'id_medico', FILTER_SANITIZE_NUMBER_INT);
$id_medico_coordenador = filter_input(INPUT_GET, 'id_medico_coordenador', FILTER_SANITIZE_NUMBER_INT);
$erro = filter_input(INPUT_GET, 'erro', FILTER_SANITIZE_STRING);
$erro_identificacao = filter_input(INPUT_GET, 'erro_identificacao', FILTER_SANITIZE_STRING);  
$erro_riscos = filter_input(INPUT_GET, 'erro_riscos', FILTER_SANITIZE_STRING);
$erro_data_ASO = filter_input(INPUT_GET, 'erro_data_ASO', FILTER_SANITIZE_STRING);
$erro_data_exames = filter_input(INPUT_GET, 'erro_data_exames', FILTER_SANITIZE_STRING);
$erro_assinatura_ativo = filter_input(INPUT_GET, 'erro_assinatura_ativo', FILTER_SANITIZE_STRING);
$erro_assinatura_medico = filter_input(INPUT_GET, 'erro_assinatura_medico', FILTER_SANITIZE_STRING);
$erro_carimbo = filter_input(INPUT_GET, 'erro_carimbo', FILTER_SANITIZE_STRING);
$erro_rasuras = filter_input(INPUT_GET, 'erro_rasuras', FILTER_SANITIZE_STRING);
$erro_falta_apto = filter_input(INPUT_GET, 'erro_falta_apto', FILTER_SANITIZE_STRING);  
$erro_falta_habilitado = filter_input(INPUT_GET, 'erro_falta_habilitado', FILTER_SANITIZE_STRING);
$erro_tel = filter_input(INPUT_GET, 'erro_tel', FILTER_SANITIZE_STRING);
$erro_coord = filter_input(INPUT_GET, 'erro_coord', FILTER_SANITIZE_STRING);
$erro_duplicado = filter_input(INPUT_GET, 'erro_duplicado', FILTER_SANITIZE_STRING);
$falta_aso = filter_input(INPUT_GET, 'falta_aso', FILTER_SANITIZE_STRING);
$comp_ACIDO_METIL_HIPURICO = filter_input(INPUT_GET, 'comp_ACIDO_METIL_HIPURICO', FILTER_SANITIZE_STRING);
$comp_HEMOGRAMA = filter_input(INPUT_GET, 'comp_HEMOGRAMA', FILTER_SANITIZE_STRING);
$comp_ACIDO_MANDELICO = filter_input(INPUT_GET, 'comp_ACIDO_MANDELICO', FILTER_SANITIZE_STRING);
$comp_VDRL = filter_input(INPUT_GET, 'comp_VDRL', FILTER_SANITIZE_STRING);
$comp_RETICULOCITOS = filter_input(INPUT_GET, 'comp_RETICULOCITOS', FILTER_SANITIZE_STRING);
$comp_PARASITOLOGICO_FEZES = filter_input(INPUT_GET, 'comp_PARASITOLOGICO_FEZES', FILTER_SANITIZE_STRING);
$comp_CULTURAL_DE_OROFARINGE = filter_input(INPUT_GET, 'comp_CULTURAL_DE_OROFARINGE', FILTER_SANITIZE_STRING);
$comp_COPROCULTURA = filter_input(INPUT_GET, 'comp_COPROCULTURA', FILTER_SANITIZE_STRING);
$comp_MICOLOGICO_DE_UNHA = filter_input(INPUT_GET, 'comp_MICOLOGICO_DE_UNHA', FILTER_SANITIZE_STRING);
$comp_AUDIOMETRIA = filter_input(INPUT_GET, 'comp_AUDIOMETRIA', FILTER_SANITIZE_STRING);
$comp_ECG = filter_input(INPUT_GET, 'comp_ECG', FILTER_SANITIZE_STRING);
$comp_ACUIDADE_VISUAL = filter_input(INPUT_GET, 'comp_ACUIDADE_VISUAL', FILTER_SANITIZE_STRING);
$comp_EEG = filter_input(INPUT_GET, 'comp_EEG', FILTER_SANITIZE_STRING);
$comp_PLAQUETAS = filter_input(INPUT_GET, 'comp_PLAQUETAS', FILTER_SANITIZE_STRING);
$comp_ERITROGRAMA = filter_input(INPUT_GET, 'comp_ERITROGRAMA', FILTER_SANITIZE_STRING);
$comp_ACIDO_TT_MUCONICO = filter_input(INPUT_GET, 'comp_ACIDO_TT_MUCONICO', FILTER_SANITIZE_STRING);
$comp_GLICEMIA_EM_JEJUM = filter_input(INPUT_GET, 'comp_GLICEMIA_EM_JEJUM', FILTER_SANITIZE_STRING);
$comp_ACIDO_HIPURICO = filter_input(INPUT_GET, 'comp_ACIDO_HIPURICO', FILTER_SANITIZE_STRING);
$comp_AVALIACAO_PSICOSSOCIAL = filter_input(INPUT_GET, 'comp_AVALIACAO_PSICOSSOCIAL', FILTER_SANITIZE_STRING);
$id_ACIDO_METIL_HIPURICO = filter_input(INPUT_GET, 'status_ACIDO_METIL_HIPURICO', FILTER_SANITIZE_NUMBER_INT);
$id_HEMOGRAMA = filter_input(INPUT_GET, 'status_HEMOGRAMA', FILTER_SANITIZE_NUMBER_INT);
$id_ACIDO_MANDELICO = filter_input(INPUT_GET, 'status_ACIDO_MANDELICO', FILTER_SANITIZE_NUMBER_INT);
$id_VDRL = filter_input(INPUT_GET, 'status_VDRL', FILTER_SANITIZE_NUMBER_INT);
$id_RETICULOCITOS = filter_input(INPUT_GET, 'status_RETICULOCITOS', FILTER_SANITIZE_NUMBER_INT);
$id_PARASITOLOGICO_FEZES = filter_input(INPUT_GET, 'status_PARASITOLOGICO_FEZES', FILTER_SANITIZE_NUMBER_INT);
$id_CULTURAL_DE_OROFARINGE = filter_input(INPUT_GET, 'status_CULTURAL_DE_OROFARINGE', FILTER_SANITIZE_NUMBER_INT);
$id_COPROCULTURA = filter_input(INPUT_GET, 'status_COPROCULTURA', FILTER_SANITIZE_NUMBER_INT);
$id_MICOLOGICO_DE_UNHA = filter_input(INPUT_GET, 'status_MICOLOGICO_DE_UNHA', FILTER_SANITIZE_NUMBER_INT);
$id_AUDIOMETRIA = filter_input(INPUT_GET, 'status_AUDIOMETRIA', FILTER_SANITIZE_NUMBER_INT);
$id_ECG = filter_input(INPUT_GET, 'status_ECG', FILTER_SANITIZE_NUMBER_INT);
$id_ACUIDADE_VISUAL = filter_input(INPUT_GET, 'status_ACUIDADE_VISUAL', FILTER_SANITIZE_NUMBER_INT);
$id_EEG = filter_input(INPUT_GET, 'status_EEG', FILTER_SANITIZE_NUMBER_INT);
$id_PLAQUETAS = filter_input(INPUT_GET, 'status_PLAQUETAS', FILTER_SANITIZE_NUMBER_INT);
$id_ERITROGRAMA = filter_input(INPUT_GET, 'status_ERITROGRAMA', FILTER_SANITIZE_NUMBER_INT);
$id_ACIDO_TT_MUCONICO = filter_input(INPUT_GET, 'status_ACIDO_TT_MUCONICO', FILTER_SANITIZE_NUMBER_INT);
$id_GLICEMIA_EM_JEJUM = filter_input(INPUT_GET, 'status_GLICEMIA_EM_JEJUM', FILTER_SANITIZE_NUMBER_INT);
$id_ACIDO_HIPURICO = filter_input(INPUT_GET, 'status_ACIDO_HIPURICO', FILTER_SANITIZE_NUMBER_INT);
$id_AVALIACAO_PSICOSSOCIAL = filter_input(INPUT_GET, 'status_AVALIACAO_PSICOSSOCIAL', FILTER_SANITIZE_NUMBER_INT);
$id_anti_hbs = filter_input(INPUT_GET, 'status_anti_Hbs', FILTER_SANITIZE_NUMBER_INT);
$id_HBs_Ag = filter_input(INPUT_GET, 'status_HBs_Ag', FILTER_SANITIZE_NUMBER_INT);
$id_Anti_HBc = filter_input(INPUT_GET, 'status_Anti_HBc', FILTER_SANITIZE_NUMBER_INT);
$comp_anti_Hbs = filter_input(INPUT_GET, 'comp_anti_Hbs', FILTER_SANITIZE_STRING);
$comp_HBs_Ag = filter_input(INPUT_GET, 'comp_HBs_Ag', FILTER_SANITIZE_STRING);
$comp_Anti_HBc = filter_input(INPUT_GET, 'comp_Anti_HBc', FILTER_SANITIZE_STRING);

if ($periodico != '') {
    $sql = "UPDATE wal_funcionarios SET flg_periodico = 1, "
            . "data_periodico = '" . $dataperiodico . "', "
            . "id_medico = " . $id_medico . ","
            . "id_medico_coordenador = " . $id_medico_coordenador . ","
            . "id_box = '" . $caixa . "', "            
            . "comp_ACIDO_METIL_HIPURICO = '" . $comp_ACIDO_METIL_HIPURICO . "', "
            . "id_ACIDO_METIL_HIPURICO = '" . $id_ACIDO_METIL_HIPURICO . "', "
            . "comp_HEMOGRAMA = '" . $comp_HEMOGRAMA . "', "
            . "id_HEMOGRAMA = '" . $id_HEMOGRAMA . "', "
            . "comp_ACIDO_MANDELICO = '" . $comp_ACIDO_MANDELICO . "', "
            . "id_ACIDO_MANDELICO = '" . $id_ACIDO_MANDELICO . "', "
            . "comp_VDRL = '" . $comp_VDRL . "', "
            . "id_VDRL = '" . $id_VDRL . "', "
            . "comp_RETICULOCITOS = '" . $comp_RETICULOCITOS . "', "
            . "id_RETICULOCITOS = '" . $id_RETICULOCITOS . "', "
            . "comp_PARASITOLOGICO_FEZES = '" . $comp_PARASITOLOGICO_FEZES . "', "
            . "id_PARASITOLOGICO_FEZES = '" . $id_PARASITOLOGICO_FEZES . "', "
            . "comp_CULTURAL_DE_OROFARINGE = '" . $comp_CULTURAL_DE_OROFARINGE . "', "
            . "id_CULTURAL_DE_OROFARINGE = '" . $id_CULTURAL_DE_OROFARINGE . "', "
            . "comp_COPROCULTURA = '" . $comp_COPROCULTURA . "', "
            . "id_COPROCULTURA = '" . $id_COPROCULTURA . "', "
            . "comp_MICOLOGICO_DE_UNHA = '" . $comp_MICOLOGICO_DE_UNHA . "', "
            . "id_MICOLOGICO_DE_UNHA = '" . $id_MICOLOGICO_DE_UNHA . "', "
            . "comp_AUDIOMETRIA = '" . $comp_AUDIOMETRIA . "', "
            . "id_AUDIOMETRIA = '" . $id_AUDIOMETRIA . "', "
            . "comp_ECG = '" . $comp_ECG . "', "
            . "id_ECG = '" . $id_ECG . "', "
            . "comp_ACUIDADE_VISUAL = '" . $comp_ACUIDADE_VISUAL . "', "
            . "id_ACUIDADE_VISUAL = '" . $id_ACUIDADE_VISUAL . "', "
            . "comp_EEG = '" . $comp_EEG . "', "
            . "id_EEG = '" . $id_EEG . "', "
            . "comp_PLAQUETAS = '" . $comp_PLAQUETAS . "', "
            . "id_PLAQUETAS = '" . $id_PLAQUETAS . "', "
            . "comp_ERITROGRAMA = '" . $comp_ERITROGRAMA . "', "
            . "id_ERITROGRAMA = '" . $id_ERITROGRAMA . "', "
            . "comp_ACIDO_TT_MUCONICO = '" . $comp_ACIDO_TT_MUCONICO . "', "
            . "id_ACIDO_TT_MUCONICO = '" . $id_ACIDO_TT_MUCONICO . "', "
            . "comp_GLICEMIA_EM_JEJUM = '" . $comp_GLICEMIA_EM_JEJUM . "', "
            . "id_GLICEMIA_EM_JEJUM = '" . $id_GLICEMIA_EM_JEJUM . "', "
            . "comp_ACIDO_HIPURICO = '" . $comp_ACIDO_HIPURICO . "', "
            . "id_ACIDO_HIPURICO = '" . $id_ACIDO_HIPURICO . "', "
            . "comp_AVALIACAO_PSICOSSOCIAL = '" . $comp_AVALIACAO_PSICOSSOCIAL . "', "
            . "id_AVALIACAO_PSICOSSOCIAL = '" . $id_AVALIACAO_PSICOSSOCIAL . "', "            
            . "id_anti_Hbs = '" . $id_anti_hbs . "', "
            . "comp_anti_Hbs = '" . $comp_anti_Hbs . "', "
            . "id_HBs_Ag = '" . $id_HBs_Ag . "', "
            . "comp_HBs_Ag = '" . $comp_HBs_Ag . "', "
            . "id_Anti_HBc = '" . $id_Anti_HBc . "', "
            . "comp_Anti_HBc = '" . $comp_Anti_HBc . "', "
            . "data_ultima_alteracao = now() where id in($periodico)";
    $executa = $pdo->prepare($sql);
    $executa_sql = $executa->execute();

    if ($erro != '') {
        $sql1 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, data_ultima_alteracao = now() where id in($erro)";
        $executa1 = $pdo->prepare($sql1);
        $executa_sql = $executa1->execute();
    }
    
    if ($erro_identificacao != '') {
        $sql2 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_identificacao = 1, data_ultima_alteracao = now() where id in($erro_identificacao)";
        $executa2 = $pdo->prepare($sql2);
        $executa2->execute();
    }
    
    if ($erro_riscos != '') {
        $sql3 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_riscos = 1, data_ultima_alteracao = now() where id in($erro_riscos)";
        $executa3 = $pdo->prepare($sql3);
        $executa3->execute();
    }
    
    if ($erro_data_ASO != '') {
        $sql4 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_data_ASO = 1, data_ultima_alteracao = now() where id in($erro_data_ASO)";
        $executa4 = $pdo->prepare($sql4);
        $executa4->execute();
    }
    
    if ($erro_data_exames != '') {
        $sql5 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_data_exames = 1, data_ultima_alteracao = now() where id in($erro_data_exames)";
        $executa5 = $pdo->prepare($sql5);
        $executa5->execute();
    }
    
    if ($erro_assinatura_ativo != '') {
        $sql6 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_assinatura_ativo = 1, data_ultima_alteracao = now() where id in($erro_assinatura_ativo)";
        $executa6 = $pdo->prepare($sql6);
        $executa6->execute();
    }
    
    if ($erro_assinatura_medico != '') {
        $sql7 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_assinatura_medico = 1, data_ultima_alteracao = now() where id in($erro_assinatura_medico)";
        $executa7 = $pdo->prepare($sql7);
        $executa7->execute();
    }
    
    if ($erro_carimbo != '') {
        $sql8 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_carimbo = 1, data_ultima_alteracao = now() where id in($erro_carimbo)";
        $executa8 = $pdo->prepare($sql8);
        $executa8->execute();
    }
    
    if ($erro_rasuras != '') {
        $sql9 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_rasuras = 1, data_ultima_alteracao = now() where id in($erro_rasuras)";
        $executa9 = $pdo->prepare($sql9);
        $executa9->execute();
    }
    
    if ($erro_falta_apto != '') {
        $sql10 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_falta_apto = 1, data_ultima_alteracao = now() where id in($erro_falta_apto)";
        $executa10 = $pdo->prepare($sql10);
        $executa10->execute();
    }
    
    if ($erro_falta_habilitado != '') {
        $sql11 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_falta_habilitado = 1, data_ultima_alteracao = now() where id in($erro_falta_habilitado)";
        $executa11 = $pdo->prepare($sql11);
        $executa11->execute();
    }
    
    if ($erro_tel != '') {
        $sql12 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_tel = 1, data_ultima_alteracao = now() where id in($erro_tel)";
        $executa12 = $pdo->prepare($sql12);
        $executa12->execute();
    }
    
    if ($erro_coord != '') {
        $sql13 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_coord = 1, data_ultima_alteracao = now() where id in($erro_coord)";
        $executa13 = $pdo->prepare($sql13);
        $executa13->execute();
    }
    
    if ($erro_duplicado != '') {
        $sql14 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_duplicado = 1, data_ultima_alteracao = now() where id in($erro_duplicado)";
        $executa14 = $pdo->prepare($sql14);
        $executa14->execute();
    }
    
    if ($falta_aso != '') {
        $sql15 = "UPDATE wal_funcionarios SET flg_periodico = 1, erro = 1, erro_falta_aso = 1, data_ultima_alteracao = now() where id in($falta_aso)";
        $executa15 = $pdo->prepare($sql15);
        $executa15->execute();
    }

    if ($executa_sql) {
        echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Periódicos 2016 marcados com Sucesso '.$_SESSION['nome_extenso'].' Parabéns!!</div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Erro!! Contate a TI-AMA...<br>' . $pdo->errorInfo() . '</div>';
    }
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Tens que setar os ativos que realizaram o Periódico, apenas marque e clique no botão vermelho novamente!!</div>';
}
Database::disconnect();