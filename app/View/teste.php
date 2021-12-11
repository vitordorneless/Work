<?php

//include '../../class/ayuadame.php';

//set_time_limit(900000000000000000000);
/* include '../config/database_mysql.php';
  $pdo = Database::connect();
  $cont = 0;
  $datas = array();
  $cpfs = array();

  foreach ($cpfs as $value) {
  $sql_funcao = 'select id, count(id) as contar from wal_funcionarios where periodo in ("2016a") and nome_funcionario = "' . $value . '"';
  $qq = $pdo->prepare($sql_funcao);
  $qq->execute();
  $data_funcao = $qq->fetch(PDO::FETCH_ASSOC);
  if ($data_funcao['contar'] > 0) {
  $smtpup = $pdo->prepare("UPDATE wal_funcionarios SET nascimento = :nascimento WHERE id = :id");
  $confirm = $smtpup->execute(array(':id' => $data_funcao['id'], ':nascimento' => $datas[$cont]));
  $edit = $confirm == TRUE ? 'editou' : 'nao editou';
  echo 'cpf ' . $value . ' ' . $edit . '<br>';
  } else
  echo 'cpf no ' . $value . '<br>';
  ++$cont;
  }
  Database::disconnect(); */
/*
  include '../config/database_mysql.php';
  $pdo = Database::connect();
  $cont = 0;
  $id = array();
  $cpf = array();

  foreach ($cpf as $value) {
  $sql_funcao = 'select b.desc_empresa as desc_empresa, a.desc_estabelecimento as desc_estabelecimento
  from wal_estabelecimento_2016 a
  inner join wal_empresa_2016 b on a.cod_empresa = b.cod_empresa
  where a.cod_empresa in (' . $empresa[$cont] . ') and a.cod_estabelecimento in (' . $loja[$cont] . ')';
  $qq = $pdo->prepare($sql_funcao);
  $qq->execute();
  $data_funcao = $qq->fetch(PDO::FETCH_ASSOC);
  echo $id[$cont] . ';' . $nome[$cont] . ';'
  . $value . ';' . $data_funcao['desc_empresa'] . ';'
  . $data_funcao['desc_estabelecimento'] .';' . $admissao[$cont] . '<br>';
  ++$cont;
  }
  Database::disconnect();
 */
/*
  include '../config/database_mysql.php';
  $pdo = Database::connect();
  $cont = 0;
  $id = array();
  $cpf = array();
  $nome = array();

  foreach ($id as $value) {
  $sql_funcao = "select
  if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $value and id_risco = 1 and ativo = 1) > 0,'1', '0') as agente_fisico,
  (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = $value and id_risco = 1 and ativo = 1 limit 1) as obs_agente_fisico,
  if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $value and id_risco = 2 and ativo = 1) > 0,'1', '0') as agente_quimico,
  (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = $value and id_risco = 2 and ativo = 1 limit 1) as obs_agente_quimico,
  if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $value and id_risco = 3 and ativo = 1) > 0,'1', '0') as agente_biologico,
  (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = $value and id_risco = 3 and ativo = 1 limit 1) as obs_agente_biologico,
  if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $value and id_risco = 4 and ativo = 1) > 0,'1', '0') as agente_ergonomico,
  (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = $value and id_risco = 4 and ativo = 1 limit 1) as obs_agente_ergonomico,
  if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $value and id_risco = 5 and ativo = 1) > 0,'1', '0') as ausencia_de_risco,
  (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = $value and id_risco = 5 and ativo = 1 limit 1) as obs_ausencia_de_risco,
  if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $value and id_risco = 6 and ativo = 1) > 0,'1', '0') as outros,
  (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = $value and id_risco = 6 and ativo = 1 limit 1) as obs_outros,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 1 and ativo = 1) > 0,'1', '0') as exame_clinico,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 2 and ativo = 1) > 0,'1', '0') as acido_metil_hipurico,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 3 and ativo = 1) > 0,'1', '0') as hemograma,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 4 and ativo = 1) > 0,'1', '0') as acido_mandelico,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 5 and ativo = 1) > 0,'1', '0') as vdrl,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 6 and ativo = 1) > 0,'1', '0') as reticulocitos,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 7 and ativo = 1) > 0,'1', '0') as parasitologico_fezes,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 8 and ativo = 1) > 0,'1', '0') as cultural_de_orofaringe,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 9 and ativo = 1) > 0,'1', '0') as coprocultura,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 10 and ativo = 1) > 0,'1', '0') as micologico_de_unha,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 11 and ativo = 1) > 0,'1', '0') as audiometria,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 12 and ativo = 1) > 0,'1', '0') as ecg,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 13 and ativo = 1) > 0,'1', '0') as acuidade_visual,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 14 and ativo = 1) > 0,'1', '0') as eeg,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 15 and ativo = 1) > 0,'1', '0') as plaquetas,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 16 and ativo = 1) > 0,'1', '0') as eritrograma,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 17 and ativo = 1) > 0,'1', '0') as acido_tt_muconico,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 18 and ativo = 1) > 0,'1', '0') as glicemia_em_jejum,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 19 and ativo = 1) > 0,'1', '0') as acido_hipurico,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 20 and ativo = 1) > 0,'1', '0') as avaliacao_psicossocial,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 21 and ativo = 1) > 0,'1', '0') as trab_altura,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 22 and ativo = 1) > 0,'1', '0') as anti_hbs,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 23 and ativo = 1) > 0,'1', '0') as hbs_ag,
  if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $value and id_exame = 24 and ativo = 1) > 0,'1', '0') as anti_hbc";
  $qq = $pdo->prepare($sql_funcao);
  $qq->execute();
  $data_funcao = $qq->fetch(PDO::FETCH_ASSOC);
  echo 'INSERT INTO sigamaOFF_marca(id, nome, cpf, marca_aCIDO_METIL_HIPuRICO,'
  . 'marca_HEMOGRAMA,marca_aCIDO_MANDeLICO,marca_VDRL,marca_RETICULoCITOS,marca_PARASITOLoGICO_FEZES,marca_CULTURAL_DE_OROFARINGE,'
  . 'marca_COPROCULTURA,marca_MICOLoGICO_DE_UNHA,marca_AUDIOMETRIA,marca_ECG,marca_ACUIDADE_VISUAL,marca_EEG,'
  . 'marca_PLAQUETAS,marca_ERITROGRAMA,marca_aCIDO_TT_MUCoNICO,marca_GLICEMIA_EM_JEJUM,marca_aCIDO_HIPuRICO,marca_PSICOSSOCIAL,'
  . 'marca_anti_hbs,marca_hbs_ag,marca_anti_hbc) VALUES (' .
  $value . ',"' . $nome[$cont] . '","'
  . $cpf[$cont] . '",' . $data_funcao['acido_metil_hipurico'] . ','
  . $data_funcao['hemograma'] . ',' . $data_funcao['acido_mandelico'] . ','
  . $data_funcao['vdrl'] . ',' . $data_funcao['reticulocitos'] . ','
  . $data_funcao['parasitologico_fezes'] . ',' . $data_funcao['cultural_de_orofaringe'] . ','
  . $data_funcao['coprocultura'] . ',' . $data_funcao['micologico_de_unha'] . ','
  . $data_funcao['audiometria'] . ',' . $data_funcao['ecg'] . ','
  . $data_funcao['acuidade_visual'] . ',' . $data_funcao['eeg'] . ','
  . $data_funcao['plaquetas'] . ',' . $data_funcao['eritrograma'] . ','
  . $data_funcao['acido_tt_muconico'] . ',' . $data_funcao['glicemia_em_jejum'] . ','
  . $data_funcao['acido_hipurico'] . ',' . $data_funcao['avaliacao_psicossocial'] . ','
  . $data_funcao['anti_hbs'] . ',' . $data_funcao['hbs_ag'] . ',' . $data_funcao['anti_hbc'] . ')' . '<br>';
  ++$cont;
  }
  Database::disconnect(); */
/*

include '../config/database_mysql.php';
$pdo = Database::connect();
$cont = 0;
$mat = array(6323541,
1479317,
3800871,
4335289,
9128146,
723611,
8907655,
4863739,
6770225,
3880678,
6793741,
3058098,
3780782,
8944630,
3799282,
4616035,
2218961,
6337039,
2807199,
8511749,
9435066,
2258604,
6002285,
7006264,
2116461,
9290752,
9476676,
2222209,
6770352,
4340778,
7352794,
9174886,
2541378,
3135368,
6750872,
9329697,
2453279,
3568969,
6193418,
4098250,
171384,
8944585,
3825961,
7341008,
8031131,
3827302,
8542219,
5108428,
8620309,
2060543,
6001716,
5703260,
720371,
169732,
3787217,
5173019,
9539906,
2064258,
6770645,
7430719,
744898,
2650599,
9469379,
2740698,
3787538,
8176141,
751025,
2350452,
2900836,
9079119,
6323382,
8523692,
9138351,
2800055,
6065756,
6769549,
1725558,
2222183,
4606777,
9128401,
3548971,
9343177,
743842,
6771181,
9155156,
1921104,
67916333,
83659013,
268465,
35135593);
$obs = array("DR ROVANI - NÃO COMPARECEU",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR ROVANI - NÃO COMPARECEU",
"DR ANDREWS GOMES - DEVOLVIDO PRESTADOR",
"DR ANDREWS GOMES - DEVOLVIDO PRESTADOR",
"DR ROVANI - DEVOLVIDO PRESTADOR",
"DR RICARDO ROSSI - NÃO COMPARECEU",
" - NÃO COMPARECEU",
" - DEMITIDO",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR RICARDO ROSSI - FÉRIAS",
"DR RICARDO ROSSI - NÃO COMPARECEU",
"DR ROVANI - NÃO COMPARECEU",
"DR ROVANI - NÃO COMPARECEU",
"DR ROVANI - FALTA PAGINA EPS",
"DR ROVANI - NÃO COMPARECEU",
"DR ROVANI - NÃO COMPARECEU",
"DR ROVANI - NÃO REALIZADO",
"DR RICARDO ROSSI - REALIZADO",
"DR ROVANI - NÃO COMPARECEU",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR ROVANI - DEVOLVIDO PRESTADOR",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR ANDREWS GOMES - DEVOLVIDO PRESTADOR",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR RICARDO ROSSI - NÃO REALIZADO",
" - NÃO COMPARECEU",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR RICARDO ROSSI - TRANSFERIDO",
"DR ROVANI - DEVOLVIDO PRESTADOR",
"DR ROVANI - DEVOLVIDO PRESTADOR",
"DR ROVANI - DEVOLVIDO PRESTADOR",
"DR ROVANI - DEVOLVIDO PRESTADOR",
"DR ROVANI - DEMITIDO",
"DR ROVANI - NÃO COMPARECEU",
" - NÃO REALIZADO",
" - Excluído",
"DR ROVANI - NÃO REALIZADO",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR RICARDO ROSSI - NÃO COMPARECEU",
"DR RICARDO ROSSI - LICENÇA MATERNIDADE",
"DR RICARDO ROSSI - LICENÇA MATERNIDADE",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR RICARDO ROSSI - NÃO COMPARECEU",
"DR RICARDO ROSSI - AGUARDANDO DOC",
"DR RICARDO ROSSI - NÃO REALIZADO",
"RICARDO ROSSI - NAO REALIZOU",
"RICARDO ROSSI - LICENÇA MATERNIDADE",
"DR ROVANI - NÃO COMPARECEU",
"DR RICARDO ROSSI - NÃO COMPARECEU",
"DR VINÍCIUS RAUBER - LICENÇA  ",
"DR VINÍCIUS RAUBER - NÃO COMPARECEU",
"DR VINÍCIUS RAUBER - NÃO COMPARECEU",
"DR VINÍCIUS RAUBER - FÉRIAS",
"DR ROVANI - TRANSFERIDO",
"DR ROVANI - LICENÇA MATERNIDADE",
" - EPS Concluído",
"ANDREWS GOMES RIZZIERI - DEVOLVIDO PRESTADOR",
"ANDREWS GOMES RIZZIERI - DEVOLVIDO PRESTADOR",
"ANDREWS GOMES RIZZIERI - DEVOLVIDO PRESTADOR",
"DR ROVANI - NÃO COMPARECEU",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR ROVANI - DEVOLVIDO PRESTADOR",
"DR ROVANI - DEVOLVIDO PRESTADOR/ DEVOLVIDO CASSI",
"DR ROVANI - NÃO COMPARECEU",
"DR ROVANI - DEVOLVIDO PRESTADOR",
" - Excluído",
"DR ROVANI - NÃO COMPARECEU",
"DR ROVANI - NÃO COMPARECEU",
"DR ROVANI - NÃO COMPARECEU",
"DR ROVANI - NÃO COMPARECEU",
"DR ROVANI - AFASTADO SAÚDE",
"DR RICARDO ROSSI - NÃO COMPARECEU",
"DR RICARDO ROSSI - LICENÇA MATERNIDADE",
"DR RICARDO ROSSI - LICENÇA MATERNIDADE",
"DR RICARDO ROSSI - LICENÇA SAUDE",
"DR RICARDO ROSSI - FÉRIAS",
"DR RICARDO ROSSI - DEVOLVIDO PRESTADOR",
"DR RICARDO ROSSI - DEVOLVIDO PRESTADOR",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR RICARDO ROSSI - NÃO REALIZADO",
"DR ROVANI - DEVOLVIDO PRESTADOR",
"DR ROVANI - ",
"DR LAURO ERNI BORTH - DEVOLVIDO PRESTADOR",
"DR ROVANI - DEVOLVIDO PRESTADOR",
"DR ROVANI DUARTE - ");

foreach ($mat as $value) {

    $sql_funcao2 = 'select count(id) as temos from cassi_ativos where matricula in (' . $value . ')';
    $qq2 = $pdo->prepare($sql_funcao2);
    $qq2->execute();
    $data_funcao2 = $qq2->fetch(PDO::FETCH_ASSOC);

    if ($data_funcao2['temos'] == 1) {

        $sql_funcao = 'select id from cassi_ativos where matricula in (' . $value . ')';
        $qq = $pdo->prepare($sql_funcao);
        $qq->execute();
        $data_funcao = $qq->fetch(PDO::FETCH_ASSOC);

        $sql_funcao1 = 'UPDATE cassi_ativos SET id_cassi_situacao = 29, obs = "' . $obs[$cont] . '" where id = ' . $data_funcao['id'];
        $qqq = $pdo->prepare($sql_funcao1);
        $qqq->execute();
        
        //echo $value . ' com o id ' . $data_funcao['id'] . ' da obs ' . $obs[$cont] . ' executado!!<br>';
    } else {
        echo $value . ' não tem id<br>';
    }    
    ++$cont;
}
Database::disconnect();
*/