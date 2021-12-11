<?php

include '../config/database_mysql.php';

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$querie = new Queries();
$pdo = Database::connect();
$dmed = new DMED_Interacoes();
$dmed->set_nome(filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_STRING));
$nome_txt = $dmed->get_nome() . '_' . date('dmYhs') . '.txt';
fopen("../../uploads/dmed/" . $nome_txt, "a");
$delimitador = '|';
$identificador_registro = str_pad("DMED", 4);
$ano_referencia = str_pad(bcadd(1, (int) $dmed->get_nome(), 0), 4);
$ano_calendario = str_pad($dmed->get_nome(), 4);
$indicador_de_retificadora = str_pad('N', 1);
$numero_recibo = str_pad('', 0);
$indicador_de_estrutura_leiaute = str_pad('S8859L', 6);
$identificador_de_registro = str_pad("RESPO", 5);
//portodonto
/*
  $cpf = str_pad("69923191087", 11);
  $nome = 'JAIR DOS SANTOS FLORES';
  $ddd = str_pad("51", 2);
  $telefone = str_pad("32270934", 8);
  $ramal = str_pad("000000", 6);
  $fax = str_pad("32270934", 8);
  $correio_eletronico = 'jair@portodonto.com.br';
  $identificador_de_registro_3 = str_pad("DECPJ", 5);
  $cnpj = str_pad("04309729000103", 14);
  $nome_empresarial = 'PORTODONTO CLINICA ODONTOLOGICA SOCIEDADE SIMPLES LTDA';
  $tipo_de_declarante = 1;
  $cpf_responsavel_cnpj = str_pad('48847135087', 11);
 */
//atendesaude

$cpf = str_pad("94984522020", 11);
$nome = 'SCHEILA ARTUS';
$ddd = str_pad("51", 2);
$telefone = str_pad("32126291", 8);
$ramal = str_pad("000000", 6);
$fax = str_pad("32126291", 8);
$correio_eletronico = 'scheila@clinicaatendesaude.com.br';
$identificador_de_registro_3 = str_pad("DECPJ", 5);
$cnpj = "00970363000150";
$nome_empresarial = 'UNIDADE DE SAUDE CENTRAL S S LTDA';
$tipo_de_declarante = 1;
$cpf_responsavel_cnpj = str_pad('48847135087', 11);

$indicador_situacao_declaracao = str_pad('N', 1);
$identificador_de_registro_pss = str_pad('PSS', 3);
$fimDMED = 'FIMDmed';
$quebralinha = "\r\n";

$linha_txt = $identificador_registro . $delimitador . $ano_calendario . $delimitador . $ano_referencia . $delimitador . $indicador_de_retificadora .
        $delimitador . $delimitador . $indicador_de_estrutura_leiaute . $delimitador . $quebralinha .
        $identificador_de_registro . $delimitador . $cpf . $delimitador . $nome . $delimitador . $ddd . $delimitador . $telefone . $delimitador .
        $delimitador . $delimitador . $correio_eletronico . $delimitador . $quebralinha .
        $identificador_de_registro_3 . $delimitador . $cnpj . $delimitador . $nome_empresarial . $delimitador . $tipo_de_declarante . $delimitador .
        $delimitador . $delimitador . $cpf_responsavel_cnpj . $delimitador . $indicador_situacao_declaracao . $delimitador . $delimitador . $quebralinha .
        $identificador_de_registro_pss . $delimitador . $quebralinha;
file_put_contents("../../uploads/dmed/" . $nome_txt, $linha_txt, FILE_APPEND);
$file = "../../uploads/dmed/" . $nome_txt;
$linha_txt = NULL;

foreach ($pdo->query($querie->dmed_gerar($dmed->get_nome())) as $value) {
    $RPPSS = strtoupper($value['RPPSS']);
    $cpf_RPPSS = $value['cpf_RPPSS'];
    $dn = $value['dn'];
    $valor = $value['valor'];
    $identificador_de_registro_RPPSS = str_pad('RPPSS', 5);
    $identificador_de_registro_BRPPSS = str_pad('BRPPSS', 6);
    $cpf_responsavel_pagamento = str_pad($cpf_RPPSS, 11);
    $nome_RPPSS = $RPPSS;
    $valor_pago_responsavel = $valor;
    $temos_dependentes = $dmed->Dados_DMED_Interacoess_tem($dmed->get_nome(), $cpf_RPPSS);

    if ($temos_dependentes['tem'] === '0') {
        $linha_txt = $linha_txt . $identificador_de_registro_RPPSS . $delimitador .
                $cpf_responsavel_pagamento . $delimitador . $nome_RPPSS . $delimitador .
                $valor_pago_responsavel . $delimitador . $quebralinha;
    } else {
        foreach ($pdo->query($querie->dmed_dependentes($dmed->get_nome(), $cpf_RPPSS)) as $values) {
            $nome_BRPPS = strtoupper($values['BRPPSS']);
            $nome_BRPPSS = $nome_BRPPS;
            $cpf_BRPPSS = $values['cpf_BRPPSS'];
            $dndep = $values['dn'];
            $valor_pago_beneficiario = $values['valor'];

            $linha_txt = $linha_txt . $identificador_de_registro_BRPPSS . $delimitador . $cpf_BRPPSS .
                    $delimitador . $dndep . $delimitador . $nome_BRPPSS . $delimitador . $valor_pago_beneficiario . $delimitador . $quebralinha;
        }
    }
}

file_put_contents("../../uploads/dmed/" . $nome_txt, $linha_txt, FILE_APPEND);
$file = "../../uploads/dmed/" . $nome_txt;
$linha_txt = NULL;
$linha_txt = $fimDMED . $delimitador;
file_put_contents("../../uploads/dmed/" . $nome_txt, $linha_txt, FILE_APPEND);
$file = "../../uploads/dmed/" . $nome_txt;

header("Content-Type: application/save");
header("Content-Length:" . filesize($file));
header('Content-Disposition: attachment; filename="' . $nome_txt . '"');
header("Content-Transfer-Encoding: binary");
header('Expires: 0');
header('Pragma: no-cache');
$fp = fopen("$file", "r");
fpassthru($fp);
fclose($fp);
