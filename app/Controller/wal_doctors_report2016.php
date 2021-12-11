<?php

include '../config/database_mysql.php';
include '../../class/ayuadame.php';

$pdo = Database::connect();
$sql = "SELECT cod_empresa, cod_pessoa_fisica, cod_estabelecimento, cod_depto, cod_cargo, cpf, matricula, nome_funcionario, data_periodico, id_medico_coordenador, id_medico,
comp_ACIDO_METIL_HIPURICO,id_ACIDO_METIL_HIPURICO,comp_HEMOGRAMA,id_HEMOGRAMA,comp_ACIDO_MANDELICO,id_ACIDO_MANDELICO,comp_VDRL,id_VDRL,comp_RETICULOCITOS,id_RETICULOCITOS,
comp_PARASITOLOGICO_FEZES,id_PARASITOLOGICO_FEZES,comp_CULTURAL_DE_OROFARINGE,id_CULTURAL_DE_OROFARINGE,comp_COPROCULTURA,id_COPROCULTURA,comp_MICOLOGICO_DE_UNHA,id_MICOLOGICO_DE_UNHA,
comp_AUDIOMETRIA,id_AUDIOMETRIA,comp_ECG,id_ECG,comp_ACUIDADE_VISUAL,id_ACUIDADE_VISUAL,comp_EEG,id_EEG,comp_PLAQUETAS,id_PLAQUETAS,comp_ERITROGRAMA,id_ERITROGRAMA,comp_ACIDO_TT_MUCONICO,
id_ACIDO_TT_MUCONICO,comp_GLICEMIA_EM_JEJUM,id_GLICEMIA_EM_JEJUM,comp_ACIDO_HIPURICO,id_ACIDO_HIPURICO,comp_AVALIACAO_PSICOSSOCIAL,id_AVALIACAO_PSICOSSOCIAL,id_anti_Hbs,comp_anti_Hbs,id_HBs_Ag,comp_HBs_Ag,id_Anti_HBc,comp_Anti_HBc
FROM wal_funcionarios where flg_periodico in (1) and cod_pessoa_fisica not in (0) and periodo in ('2016a') 
/*and erro in (1) and data_periodico not in ('0000-00-00 00:00:00') and id_medico not in (0) and id_medico_coordenador not in (0) and year(data_periodico) not in ('2014')*/
order by cod_empresa, cod_estabelecimento, nome_funcionario asc";
$html = '';
$html = $html . '<table border="1">';
$html = $html . '<thead><tr>';
$html = $html . '<th class="text-center">UNIDADE</th><th class="text-center">CNPJ</th><th class="text-center">SETOR</th>';
$html = $html . '<th class="text-center">FUNÇÃO</th><th class="text-center">CPF</th><th class="text-center">NIT</th>';
$html = $html . '<th class="text-center">ID (SISTEMA)</th><th class="text-center">NOME ASSOCIADO</th><th class="text-center">DATA ASO</th>';
$html = $html . '<th class="text-center">TIPO ASO</th><th class="text-center">RESULTADO ASO</th><th class="text-center">DATA EXAME</th>';
$html = $html . '<th class="text-center">DESCRIÇÃO EXAME</th><th class="text-center">CÓDIGO EXAME</th><th class="text-center">AGENTE QUÍMICO</th>';
$html = $html . '<th class="text-center">MATERIAL BIOLÓGICO</th><th class="text-center">ANÁLISE</th><th class="text-center">CÓDIGO</th>';
$html = $html . '<th class="text-center">EXPOSIÇÃO EXCESSIVA</th><th class="text-center">ORDEM DO EXAME</th><th class="text-center">INDICAÇÃO DOS RESULTADOS</th>';
$html = $html . '<th class="text-center">NIT COORDENADOR PCMSO</th><th class="text-center">CRM COORDENADOR PCMSO</th><th class="text-center">UF - CRM</th>';
$html = $html . '<th class="text-center">NOME MÉDICO EXAMINADOR</th><th class="text-center">TELEFONE MÉDICO EXAMINADOR</th><th class="text-center">CRM MÉDICO EXAMINADOR</th>';
$html = $html . '<th class="text-center">UF - CRM</th>';
$html = $html . '</tr>';
$html = $html . '</thead><tbody>';

foreach ($pdo->query($sql) as $value) {

    $sql_unidade = "select desc_estabelecimento, cod_estabelecimento, cnpj from wal_estabelecimento_2016 where cod_empresa in (" . $value['cod_empresa'] . ") and cod_estabelecimento in (" . $value['cod_estabelecimento'] . ")";
    $q = $pdo->prepare($sql_unidade);
    $q->execute();
    $data_unidade = $q->fetch(PDO::FETCH_ASSOC);    

    $sql_setor = "select desc_depto from wal_departamento where data_ultima_alteracao in ('2016-04-20 15:12:09') and cod_depto in (" . $value['cod_depto'] . ")";
    $qqq = $pdo->prepare($sql_setor);
    $qqq->execute();
    $data_setor = $qqq->fetch(PDO::FETCH_ASSOC);

    $sql_cargo = "select desc_cargo from wal_cargo_2016 where cod_cargo in ('" . $value['cod_cargo'] . "')";
    $qqqq = $pdo->prepare($sql_cargo);
    $qqqq->execute();
    $data_cargo = $qqqq->fetch(PDO::FETCH_ASSOC);

    $sql_cod_exame = "select id, desc_exame, cod_exame from wal_cod_exames where id in (11) order by desc_exame asc";
    $qqqqq = $pdo->prepare($sql_cod_exame);
    $qqqqq->execute();
    $data_cod_exame = $qqqqq->fetch(PDO::FETCH_ASSOC);

    $sql_medico = "select id, nome_extenso, crm, estado_crm from usuarios where setor in (28) and status in (1) and id in (" . $value['id_medico'] . ") order by nome asc";
    $qqqqqq = $pdo->prepare($sql_medico);
    $qqqqqq->execute();
    $data_sql_medico = $qqqqqq->fetch(PDO::FETCH_ASSOC);  

    $html = $html . '<tr>';
    $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
    $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
    $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
    $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
    $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
    $html = $html . '<td> </td>'; //nit
    $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
    $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
    $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
    $html = $html . '<td>1</td>';
    $html = $html . '<td>1</td>';
    $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
    $html = $html . '<td>' . utf8_encode($data_cod_exame['desc_exame']) . '</td>';
    $html = $html . '<td>' . $data_cod_exame['cod_exame'] . '</td>';
    $html = $html . '<td> </td>'; //agente quimico
    $html = $html . '<td> </td>'; //material biologico
    $html = $html . '<td> </td>'; //analise
    $html = $html . '<td> </td>'; //código
    $html = $html . '<td> </td>'; //exposição excessiva
    $html = $html . '<td>2</td>'; //ordem do exame
    $html = $html . '<td> </td>'; //indicação dos resultados
    $html = $html . '<td> </td>'; //nit coordenador pcmso
    /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
      $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
    $html = $html . '<td></td>'; //crm coordenador pcmso
    $html = $html . '<td></td>'; //uf crm
    $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
    $html = $html . '<td>51 32173434</td>'; //
    $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
    $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
    $html = $html . '</tr>';

    if ($value['id_ACIDO_METIL_HIPURICO'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_ACIDO_METIL_HIPURICO']) . '</td>';
        $html = $html . '<td>ACIDO METILHIPURICO</td>';
        $html = $html . '<td>40313069</td>';
        $html = $html . '<td>26</td>'; //agente quimico
        $html = $html . '<td>1</td>'; //material biologico
        $html = $html . '<td>26.1</td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_HEMOGRAMA'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_HEMOGRAMA']) . '</td>';
        $html = $html . '<td>HEMOGRAMA COM PLAQUETAS</td>';
        $html = $html . '<td>40304361</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td>2</td>'; //material biologico
        $html = $html . '<td></td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_ACIDO_MANDELICO'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_ACIDO_MANDELICO']) . '</td>';
        $html = $html . '<td>ÁCIDO MANDÉLICO</td>';
        $html = $html . '<td>40313050</td>';
        $html = $html . '<td>12</td>'; //agente quimico
        $html = $html . '<td>1</td>'; //material biologico
        $html = $html . '<td>12.1</td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_VDRL'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_VDRL']) . '</td>';
        $html = $html . '<td>VDRL</td>';
        $html = $html . '<td>40403602</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td>2</td>'; //material biologico
        $html = $html . '<td></td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_RETICULOCITOS'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_RETICULOCITOS']) . '</td>';
        $html = $html . '<td>RETICULOCITOS</td>';
        $html = $html . '<td>40304558</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td>2</td>'; //material biologico
        $html = $html . '<td></td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_PARASITOLOGICO_FEZES'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_PARASITOLOGICO_FEZES']) . '</td>';
        $html = $html . '<td>PARASITOLÓGICO DE FEZES</td>';
        $html = $html . '<td>40303110</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td> </td>'; //material biologico
        $html = $html . '<td> </td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_CULTURAL_DE_OROFARINGE'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_CULTURAL_DE_OROFARINGE']) . '</td>';
        $html = $html . '<td>CULTURA DE OROFARINGE</td>';
        $html = $html . '<td>40310124</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td> </td>'; //material biologico
        $html = $html . '<td> </td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_COPROCULTURA'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_COPROCULTURA']) . '</td>';
        $html = $html . '<td>COPROCULTURA</td>';
        $html = $html . '<td>40310183</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td> </td>'; //material biologico
        $html = $html . '<td> </td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_MICOLOGICO_DE_UNHA'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_MICOLOGICO_DE_UNHA']) . '</td>';
        $html = $html . '<td>MICOLÓGICO SUBUNGEAL</td>';
        $html = $html . '<td>41301218</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td> </td>'; //material biologico
        $html = $html . '<td> </td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td> </td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_AUDIOMETRIA'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_AUDIOMETRIA']) . '</td>';
        $html = $html . '<td>AUDIOMETRIA TONAL</td>';
        $html = $html . '<td>40103072</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td> </td>'; //material biologico
        $html = $html . '<td></td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_ECG'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_ECG']) . '</td>';
        $html = $html . '<td>ELETROCARDIOGRAMA</td>';
        $html = $html . '<td>40101010</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td> </td>'; //material biologico
        $html = $html . '<td> </td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    /*if ($value['id_ACUIDADE_VISUAL'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_ACUIDADE_VISUAL']) . '</td>';
        $html = $html . '<td>ACUIDADE VISUAL</td>';
        $html = $html . '<td>Não Informado</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td> </td>'; //material biologico
        $html = $html . '<td> </td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }*/

    if ($value['id_EEG'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_EEG']) . '</td>';
        $html = $html . '<td>ELETROENCEFALOGRAMA</td>';
        $html = $html . '<td>40103170</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td> </td>'; //material biologico
        $html = $html . '<td> </td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_PLAQUETAS'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_PLAQUETAS']) . '</td>';
        $html = $html . '<td>HEMOGRAMA COM PLAQUETAS</td>';
        $html = $html . '<td>40304361</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td>2</td>'; //material biologico
        $html = $html . '<td> </td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_ERITROGRAMA'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_ERITROGRAMA']) . '</td>';
        $html = $html . '<td>ERITROGRAMA</td>';
        $html = $html . '<td>40304361</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td>2</td>'; //material biologico
        $html = $html . '<td> </td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_ACIDO_TT_MUCONICO'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_ACIDO_TT_MUCONICO']) . '</td>';
        $html = $html . '<td>ACIDO T T MUCONICO</td>';
        $html = $html . '<td>40316793</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td>1</td>'; //material biologico
        $html = $html . '<td> </td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_GLICEMIA_EM_JEJUM'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_GLICEMIA_EM_JEJUM']) . '</td>';
        $html = $html . '<td>GLICOSE</td>';
        $html = $html . '<td>40302040</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td>2</td>'; //material biologico
        $html = $html . '<td> </td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    if ($value['id_ACIDO_HIPURICO'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_ACIDO_HIPURICO']) . '</td>';
        $html = $html . '<td>ACIDO HIPURICO</td>';
        $html = $html . '<td>40316785</td>';
        $html = $html . '<td>23</td>'; //agente quimico
        $html = $html . '<td>1</td>'; //material biologico
        $html = $html . '<td>23.1</td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }

    /*if ($value['id_AVALIACAO_PSICOSSOCIAL'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_AVALIACAO_PSICOSSOCIAL']) . '</td>';
        $html = $html . '<td>AVALIAÇÃO PSICOSOCIAL</td>';
        $html = $html . '<td>Não Informado</td>';
        $html = $html . '<td> </td>'; //agente quimico
        $html = $html . '<td> </td>'; //material biologico
        $html = $html . '<td> </td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td>2</td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
        $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }*/
    
    if ($value['id_HBs_Ag'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_HBs_Ag']) . '</td>';
        $html = $html . '<td>HBs Ag</td>';
        $html = $html . '<td></td>';
        $html = $html . '<td></td>'; //agente quimico
        $html = $html . '<td></td>'; //material biologico
        $html = $html . '<td></td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td></td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }
    
    if ($value['id_Anti_HBc'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_Anti_HBc']) . '</td>';
        $html = $html . '<td>Anti-HBc</td>';
        $html = $html . '<td></td>';
        $html = $html . '<td></td>'; //agente quimico
        $html = $html . '<td></td>'; //material biologico
        $html = $html . '<td></td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td></td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }
    
    if ($value['id_anti_Hbs'] > 0) {
        $html = $html . '<tr>';
        $html = $html . '<td>' . $data_unidade['desc_estabelecimento'] . '</td>';
        $html = $html . '<td>"' . $data_unidade['cnpj'] . '"</td>';
        $html = $html . '<td>' . $data_setor['desc_depto'] . '</td>';
        $html = $html . '<td>' . $data_cargo['desc_cargo'] . '</td>';
        $html = $html . '<td>"' . str_pad($value['cpf'], 11, '0', STR_PAD_LEFT) . '"</td>';
        $html = $html . '<td> </td>'; //nit
        $html = $html . '<td>' . $value['cod_pessoa_fisica'] . '</td>';
        $html = $html . '<td>' . utf8_encode($value['nome_funcionario']) . '</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['data_periodico']) . '</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>1</td>';
        $html = $html . '<td>' . transformaEmDataBrasileira($value['comp_anti_Hbs']) . '</td>';
        $html = $html . '<td>Anti-HBs</td>';
        $html = $html . '<td></td>';
        $html = $html . '<td></td>'; //agente quimico
        $html = $html . '<td></td>'; //material biologico
        $html = $html . '<td></td>'; //analise
        $html = $html . '<td> </td>'; //código
        $html = $html . '<td> </td>'; //exposição excessiva
        $html = $html . '<td></td>'; //ordem do exame
        $html = $html . '<td> </td>'; //indicação dos resultados
        $html = $html . '<td> </td>'; //nit coordenador pcmso
        /* $html = $html . '<td>' . $data_sql_pcmso_medico['crm'] . '</td>'; //crm coordenador pcmso
          $html = $html . '<td>' . $data_sql_pcmso_medico['conselho'] . '</td>'; //uf crm */
        $html = $html . '<td></td>'; //crm coordenador pcmso
        $html = $html . '<td></td>'; //uf crm
        $html = $html . '<td>' . $data_sql_medico['nome_extenso'] . '</td>'; //nome médico examinador
        $html = $html . '<td>51 32173434</td>'; //
        $html = $html . '<td>' . $data_sql_medico['crm'] . '</td>'; //crm médico examinador
        $html = $html . '<td>' . $data_sql_medico['estado_crm'] . '</td>'; //uf crm
        $html = $html . '</tr>';
    }
}

Database::disconnect();
$html = $html . '</tbody>';
$html = $html . '</table>';
header("Content-type: application/vnd.ms-excel");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=walmart_report.xls");
header("Pragma: no-cache");
echo $html;