<?php
session_start();
include '../config/database_mysql.php';
require '../Model/txt_Grafica.php';
require '../Model/Grafica.php';
$grafica = new Grafica();
$txt = new txt_Grafica();
$txt->set_empresa(filter_input(INPUT_GET, 'empresa', FILTER_SANITIZE_NUMBER_INT));
$txt->set_estabelecimento(filter_input(INPUT_GET, 'estabelecimento', FILTER_SANITIZE_NUMBER_INT));
$txt->set_funcao(filter_input(INPUT_GET, 'funcao', FILTER_SANITIZE_NUMBER_INT));
$nome_txt = $_SESSION['user_id'] . '_' . $txt->get_empresa() . '_' . $txt->get_estabelecimento() . '_' . date('dmYs') . '.txt';
fopen("../../uploads/grafica/" . $nome_txt, "a");
$array_coordenador_PCMSO = $grafica->Dados_Medico_Coordenador($txt->get_funcao());
$codigo_empresa = str_pad(" ", 3);
$razao_social = str_pad(" ", 50);
$unidade = str_pad(" ", 6);
$matricula = str_pad(" ", 8);
$nome = str_pad(utf8_decode($array_coordenador_PCMSO['nome']), 50);
$cargo = str_pad($array_coordenador_PCMSO['cargo'], 21);
$conselho = str_pad($array_coordenador_PCMSO['conselho'], 15);
$inscricao_ministerio_trabalho = str_pad(" ", 30);
$cidade = str_pad(" ", 50);
$telefone = str_pad("(51) 32173434", 15);
$paraExerceraFuncao = str_pad(" ", 1);
$descricaoParaExerceraFuncao = str_pad(" ", 50);
$quebralinha = "\r\n";
$pdo = Database::connect();
$sql = 'select funfun.id as id_funcionario, funfun.nome_funcionario as nome_ativo,funfun.matricula as matricula, funfun.cod_depto as departamento, 
        depdep.desc_depto as nome_setor,
        funfun.identidade as rg, funfun.cpf as cpf, funfun.nascimento as nascimento,funfun.cod_empresa as cod_empresa, 
        funfun.cod_estabelecimento as loja, funfun.cod_cargo as cargo, 
        funfun.cod_centro_custo as setor  
        from wal_funcionarios funfun
        inner join wal_departamento depdep on depdep.cod_depto = funfun.cod_depto
        where funfun.periodo in ("2016a") and funfun.cod_empresa = ' . $txt->get_empresa() . ' and funfun.cod_estabelecimento = ' . $txt->get_estabelecimento() . '
        and funfun.exame = 1 and funfun.risco = 1 and funfun.nascimento not in ("0") and year(funfun.admissao) <> "2016"  
        order by depdep.desc_depto asc';
foreach ($pdo->query($sql) as $value) {
    $id_funcionario = $value['id_funcionario'];
    $empresa = $value['cod_empresa'];
    $setor_parametro = $value['departamento'];
    $loja_parametro = $value['loja'];
    $id_cargo = $value['cargo'];
    $data_nascimentos = $value['nascimento'] == 0 ? '00/00/0000' : $value['nascimento'];
    $data_nascimento = str_replace('/', '', str_pad($data_nascimentos, 8));
    $qrcode = str_pad("http://www.grupoamasaude.com.br/aso/?cpf=" . str_pad($value['cpf'], 11, "0", STR_PAD_LEFT), 450);
    $sql_loja = 'select desc_estabelecimento from wal_estabelecimento_2016 where cod_empresa = ' . $empresa . ' and cod_estabelecimento = ' . $loja_parametro;
    $q = $pdo->prepare($sql_loja);
    $q->execute();
    $data_loja = $q->fetch(PDO::FETCH_ASSOC);
    $sql_cargo = 'select desc_cargo from wal_cargo_2016 where cod_cargo = ' . $id_cargo . ' limit 1';
    $qq = $pdo->prepare($sql_cargo);
    $qq->execute();
    $data_cargo = $qq->fetch(PDO::FETCH_ASSOC);
    $sql_setor = 'select desc_depto as setor from wal_departamento where cod_depto = ' . $setor_parametro . ' limit 1';
    $qqq = $pdo->prepare($sql_setor);
    $qqq->execute();
    $data_setor = $qqq->fetch(PDO::FETCH_ASSOC);
    $sql_exames_riscos = "select 
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 1 and ativo = 1) > 0,'1', '0') as agente_fisico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 1 and ativo = 1 limit 1) as obs_agente_fisico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 2 and ativo = 1) > 0,'1', '0') as agente_quimico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 2 and ativo = 1 limit 1) as obs_agente_quimico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 3 and ativo = 1) > 0,'1', '0') as agente_biologico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 3 and ativo = 1 limit 1) as obs_agente_biologico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 4 and ativo = 1) > 0,'1', '0') as agente_ergonomico,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 4 and ativo = 1 limit 1) as obs_agente_ergonomico,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 5 and ativo = 1) > 0,'1', '0') as ausencia_de_risco,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 5 and ativo = 1 limit 1) as obs_ausencia_de_risco,
                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 6 and ativo = 1) > 0,'1', '0') as outros,
                    (select distinct obs_risco from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 6 and ativo = 1 limit 1) as obs_outros,    
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 1 and ativo = 1) > 0,'1', '0') as exame_clinico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 2 and ativo = 1) > 0,'1', '0') as acido_metil_hipurico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 3 and ativo = 1) > 0,'1', '0') as hemograma,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 4 and ativo = 1) > 0,'1', '0') as acido_mandelico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 5 and ativo = 1) > 0,'1', '0') as vdrl,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 6 and ativo = 1) > 0,'1', '0') as reticulocitos,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 7 and ativo = 1) > 0,'1', '0') as parasitologico_fezes,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 8 and ativo = 1) > 0,'1', '0') as cultural_de_orofaringe,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 9 and ativo = 1) > 0,'1', '0') as coprocultura,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 10 and ativo = 1) > 0,'1', '0') as micologico_de_unha,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 11 and ativo = 1) > 0,'1', '0') as audiometria,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 12 and ativo = 1) > 0,'1', '0') as ecg,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 13 and ativo = 1) > 0,'1', '0') as acuidade_visual,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 14 and ativo = 1) > 0,'1', '0') as eeg,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 15 and ativo = 1) > 0,'1', '0') as plaquetas,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 16 and ativo = 1) > 0,'1', '0') as eritrograma,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 17 and ativo = 1) > 0,'1', '0') as acido_tt_muconico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 18 and ativo = 1) > 0,'1', '0') as glicemia_em_jejum,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 19 and ativo = 1) > 0,'1', '0') as acido_hipurico,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 20 and ativo = 1) > 0,'1', '0') as avaliacao_psicossocial,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 21 and ativo = 1) > 0,'1', '0') as trab_altura,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 22 and ativo = 1) > 0,'1', '0') as anti_hbs,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 23 and ativo = 1) > 0,'1', '0') as hbs_ag,
                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 24 and ativo = 1) > 0,'1', '0') as anti_hbc";
    $qqqq = $pdo->prepare($sql_exames_riscos);
    $qqqq->execute();
    $data_exames_e_riscos = $qqqq->fetch(PDO::FETCH_ASSOC);
    $apto_altura = $data_exames_e_riscos['trab_altura'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $agente_fisico = $data_exames_e_riscos['agente_fisico'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $agente_quimico = $data_exames_e_riscos['agente_quimico'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $agente_biologico = $data_exames_e_riscos['agente_biologico'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $agente_ergonomico = $data_exames_e_riscos['agente_ergonomico'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $ausencia_de_risco = $data_exames_e_riscos['ausencia_de_risco'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $marcaAgenteOUTROS = $data_exames_e_riscos['outros'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $exame_clinico = $data_exames_e_riscos['exame_clinico'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $acido_metil_hipurico = $data_exames_e_riscos['acido_metil_hipurico'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $hemograma = $data_exames_e_riscos['hemograma'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $acido_mandelico = $data_exames_e_riscos['acido_mandelico'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $vdrl = $data_exames_e_riscos['vdrl'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $reticulocitos = $data_exames_e_riscos['reticulocitos'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $parasitologico_fezes = $data_exames_e_riscos['parasitologico_fezes'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $cultural_de_orofaringe = $data_exames_e_riscos['cultural_de_orofaringe'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $coprocultura = $data_exames_e_riscos['coprocultura'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $micologico_de_unha = $data_exames_e_riscos['micologico_de_unha'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $audiometria = $data_exames_e_riscos['audiometria'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $ecg = $data_exames_e_riscos['ecg'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $acuidade_visual = $data_exames_e_riscos['acuidade_visual'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $eeg = $data_exames_e_riscos['eeg'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $plaquetas = $data_exames_e_riscos['plaquetas'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $eritrograma = $data_exames_e_riscos['eritrograma'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $acido_tt_muconico = $data_exames_e_riscos['acido_tt_muconico'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $glicemia_em_jejum = $data_exames_e_riscos['glicemia_em_jejum'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $acido_hipurico = $data_exames_e_riscos['acido_hipurico'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $escreve_anti_hbs = $data_exames_e_riscos['anti_hbs'] == 1 ? str_pad("ANTI-HBS", 30) : str_pad(" ", 30);
    $escreve_hbs_ag = $data_exames_e_riscos['hbs_ag'] == 1 ? str_pad("HBS-AG", 30) : str_pad(" ", 30);
    $escreve_anti_hbc = $data_exames_e_riscos['anti_hbc'] == 1 ? str_pad("ANTI-HBC",30) : str_pad(" ", 30);    
    $anti_hbs = $data_exames_e_riscos['anti_hbs'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $hbs_ag = $data_exames_e_riscos['hbs_ag'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $anti_hbc = $data_exames_e_riscos['anti_hbc'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);

    $marcacao_admissional = str_pad(" ", 1);
    $marcacao_periodico = str_pad("x", 1);
    $marcacao_retorno_ao_trabalho = str_pad(" ", 1);
    $marcacao_mudanca_funcao = str_pad(" ", 1);
    $marcacao_demissional = str_pad(" ", 1);
    $hab_trab_altura_sim = str_pad(" ", 1);
    $hab_trab_altura_nao = str_pad(" ", 1);
    $hab_man_ali_sim = str_pad(" ", 1);
    $hab_man_ali_nao = str_pad(" ", 1);

    $avPsicossocial = $data_exames_e_riscos['avaliacao_psicossocial'] == 1 ? str_pad("x", 1) : str_pad(" ", 1);
    $Psicossocial = str_pad(" ", 20);
    $obs_agente_fisico = $data_exames_e_riscos['obs_agente_fisico'] == NULL ? " " : str_pad(trim($data_exames_e_riscos['obs_agente_fisico']), 100);
    $obs_agente_quimico = $data_exames_e_riscos['obs_agente_quimico'] == NULL ? " " : str_pad(trim($data_exames_e_riscos['obs_agente_quimico']), 100);
    $obs_agente_biologico = $data_exames_e_riscos['obs_agente_biologico'] == NULL ? " " : str_pad(trim($data_exames_e_riscos['obs_agente_biologico']), 100);
    $obs_agente_ergonomico = $data_exames_e_riscos['obs_agente_ergonomico'] == NULL ? " " : str_pad(trim($data_exames_e_riscos['obs_agente_ergonomico']), 100);
    $obs_ausencia_de_risco = $data_exames_e_riscos['obs_ausencia_de_risco'] == NULL ? " " : str_pad(trim($data_exames_e_riscos['obs_ausencia_de_risco']), 100);
    $obs_outros = $data_exames_e_riscos['obs_outros'] == NULL ? " " : str_pad(trim($data_exames_e_riscos['obs_outros']), 100);

    $descUnidade = str_pad($data_loja['desc_estabelecimento'], 50);
    $nome_ativo = str_pad(utf8_decode($value['nome_ativo']), 50);
    $rg = str_pad($value['rg'], 20);
    $descFuncao = str_pad($data_cargo['desc_cargo'], 50);
    $cpf = str_pad(str_pad($value['cpf'], 11, '0', STR_PAD_LEFT), 20);
    $descSetor = str_pad($data_setor['setor'], 50);
    $marcaAgenteFisico = str_pad($agente_fisico, 1);
    $descAgenteFisico = str_pad($obs_agente_fisico, 100, " ", STR_PAD_RIGHT);
    $marcaAgenteQuimico = str_pad($agente_quimico, 1);
    $descAgenteQuimico = str_pad($obs_agente_quimico, 100, " ", STR_PAD_RIGHT);
    $marcaAgenteBiologico = str_pad($agente_biologico, 1);
    $descAgenteBiologico = str_pad($obs_agente_biologico, 100, " ", STR_PAD_RIGHT);
    $marcaAgenteErgonomicos = str_pad($agente_ergonomico, 1);
    $descAgenteErgonomicos = str_pad($obs_agente_ergonomico, 100, " ", STR_PAD_RIGHT);
    $DescAgenteOUTROS = str_pad($obs_outros, 100, " ", STR_PAD_RIGHT);
    $marcaSemRisco = str_pad($ausencia_de_risco, 1);
    $QuadroAptoComplementar = str_pad(" ", 100);
    $marca_exame_clinico = str_pad($exame_clinico, 1);
    $marca_acido_metil_hipurico = str_pad($acido_metil_hipurico, 1);
    $marca_hemograma = str_pad($hemograma, 1);
    $marca_acido_mandelico = str_pad($acido_mandelico, 1);
    $marca_vdrl = str_pad($vdrl, 1);
    $marca_reticulocitos = str_pad($reticulocitos, 1);
    $marca_parasitologico_fezes = str_pad($parasitologico_fezes, 1);
    $marca_cultural_de_orofaringe = str_pad($cultural_de_orofaringe, 1);
    $marca_coprocultura = str_pad($coprocultura, 1);
    $marca_micologico_de_unha = str_pad($micologico_de_unha, 1);
    $marca_audiometria = str_pad($audiometria, 1);
    $marca_ecg = str_pad($ecg, 1);
    $marca_acuidade_visual = str_pad($acuidade_visual, 1);
    $marca_eeg = str_pad($eeg, 1);
    $marca_plaquetas = str_pad($plaquetas, 1);
    $marca_eritrograma = str_pad($eritrograma, 1);
    $marca_acido_tt_muconico = str_pad($acido_tt_muconico, 1);
    $marca_glicemia_em_jejum = str_pad($glicemia_em_jejum, 1);
    $marca_acido_hipurico = str_pad($acido_hipurico, 1);

    $linha_txt = $codigo_empresa . $razao_social . $unidade . $descUnidade . $matricula . $nome_ativo . $rg .
            $descFuncao . $nome . $cargo . $conselho . $inscricao_ministerio_trabalho . $cpf . $data_nascimento .
            $descSetor . $marcaAgenteFisico . $descAgenteFisico . $marcaAgenteQuimico . $descAgenteQuimico . $marcaAgenteBiologico .
            $descAgenteBiologico . $marcaAgenteErgonomicos . $descAgenteErgonomicos . $marcaSemRisco . $QuadroAptoComplementar .
            $marca_exame_clinico . $marca_hemograma . $marca_vdrl . $marca_parasitologico_fezes . $marca_coprocultura . $marca_audiometria .
            $marca_acuidade_visual . $marca_plaquetas . $marca_acido_tt_muconico . $marca_acido_hipurico . $marca_acido_metil_hipurico .
            $marca_acido_mandelico . $marca_reticulocitos . $marca_cultural_de_orofaringe . $marca_micologico_de_unha . $cidade . $telefone .
            $qrcode . $marcaAgenteOUTROS . $DescAgenteOUTROS . $marca_ecg . $marca_eeg . $marca_eritrograma . $marca_glicemia_em_jejum .
            $avPsicossocial . $Psicossocial . $paraExerceraFuncao . $descricaoParaExerceraFuncao . $hab_trab_altura_sim . $hab_trab_altura_nao .
            $hab_man_ali_sim . $hab_man_ali_nao . $escreve_anti_hbs . $escreve_hbs_ag . $escreve_anti_hbc . $anti_hbs . $hbs_ag . $anti_hbc .
            $marcacao_admissional . $marcacao_periodico . $marcacao_retorno_ao_trabalho . $marcacao_mudanca_funcao . $marcacao_demissional . $quebralinha;

    file_put_contents("../../uploads/grafica/" . $nome_txt, $linha_txt, FILE_APPEND);
    unset($linha_txt);
}
$file = "../../uploads/grafica/" . $nome_txt;
header("Content-Type: application/save");
header("Content-Length:" . filesize($file));
header('Content-Disposition: attachment; filename="' . $nome_txt . '"');
header("Content-Transfer-Encoding: binary");
header('Expires: 0');
header('Pragma: no-cache');
$fp = fopen("$file", "r");
fpassthru($fp);
fclose($fp);
