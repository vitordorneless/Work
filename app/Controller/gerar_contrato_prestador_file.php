<?php

session_start();
include_once '../../tools/tbs/demo/tbs_class.php';
include_once '../../tools/tbs/tbs_plugin_opentbs.php';
include '../config/database_mysql.php';
include '../../class/ayuadame.php';

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$querie = new Queries();
$contratos = new Contratos_Emitidos();
ini_set('default_charset', 'UTF-8');

$pdo = Database::connect();
$TBS = new clsTinyButStrong();
$TBS->PlugIn(TBS_INSTALL, OPENTBS_PLUGIN);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($querie->gerar_contrato_prestador());
$q->execute(array(filter_input(INPUT_GET, 'id_prestador', FILTER_SANITIZE_NUMBER_INT)));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();

$nome_arquivo = 'PERIoDICOS_IN_LOCO';
$nome_prestador = $data['razao_social'];
$cnpj = $data['cnpj'];
$rua = $data['ende'];
$bairro = $data['bairro'];
$cidade = $data['cidade'];
$cep = $data['cep'];
$valor_extenso = extenso($data['valor_consulta'], TRUE);
$valor = $data['valor_consulta'];
$hoje = new DateTime();
$datas = new Datetime($data['data_cadastro']);
$datas1 = new Datetime($data['data_cadastro']);
$data_cadastro = $datas->format('d/m/Y');
$noventa = $datas1->add(new DateInterval('P90D'));
$vigencia_start = $data_cadastro;
$vigencia_end = $noventa->format('d/m/Y');
$mes = array("Janeiro" => '01', "Fevereiro" => '02', "Março" => '03', "Abril" => '04', "Maio" => '05'
    , "Junho" => '06', "Julho" => '07', "Agosto" => '08', "Setembro" => '09'
    , "Outubro" => '10', "Novembro" => '11', "Dezembro" => '12');
$data_atual = 'Porto Alegre, ' . $hoje->format('d') . ' de ' . array_search($hoje->format('m'), $mes, true) . ' de ' . $hoje->format('Y');
$nome_contrato = $nome_arquivo . '_' . $nome_prestador;
$contratos->save_Contratos_Emitidos($nome_prestador, $cnpj, $rua, $bairro, $cidade, $cep, 
        $data_cadastro, $valor, $valor_extenso, $vigencia_start, $vigencia_end, $data_atual, $_SESSION['user_id']);
Database::disconnect();
$template = '../../uploads/Contratos/' . $nome_arquivo . '.docx';
$TBS->LoadTemplate($template);
$output_file_name = $nome_contrato . '.docx';
$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
