<?php

include '../config/database_mysql.php';
include '../../class/ayuadame.php';

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$querie = new Queries();
$registros = new Registros_Interacoes();
$conn = oci_connect('sigama', 'ama@w3b', '10.103.0.253:1521/amars');
$registros->set_nome_arquivo(filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_STRING));
$apolice = $registros->pegar_apolice($registros->get_nome_arquivo());
$pdo = Database::connect();
$data = date('d-m-Y');
$segundos = date('i:s');
$nome_arquivo = 'bradesco_criticas_' . $data . '_' . substr($registros->get_nome_arquivo(), 0, -4) . '_' . $segundos;
$html = '';
$html = $html . '<table border="1">';
$html = $html . '<thead><tr>';
$html = $html . '<th class="text-center">SUBFATURA</th><th class="text-center">UNIDADE</th><th class="text-center">NOME</th>';
$html = $html . '<th class="text-center">CERTIFICADO</th><th class="text-center">MATRICULA</th><th class="text-center">NOME TITULAR</th>';
$html = $html . '<th class="text-center">CPF TITULAR</th><th class="text-center">CRITICA CÓDIGO</th><th class="text-center">NOME CRÍTICA</th>';
$html = $html . '</tr>';
$html = $html . '</thead><tbody>';
$sub_fatura = $certificado = $matricula = $condition = $unidade = NULL;

foreach ($pdo->query($querie->registro_rel_bradesco($registros->get_nome_arquivo())) as $value) {
    $registro_r = $value['numero_registro_R'];
    $condition = substr($value['conteudo_R'], 0, 1);

    if ($condition === "D") {
        $sub_fatura = substr($value['conteudo_R'], 12, 3);
        $certificado = substr($value['conteudo_R'], 15, 7);
        $matricula = substr($value['conteudo_R'], 22, 6);
        $sequencia = substr($value['conteudo_R'], 83, 1);

        $stid2 = oci_parse($conn, "SELECT NOPESSOABENEF, NRCPF, CDPESSOAUNID FROM VW_BENEFICIARIO WHERE NRMATRICULA in ('" . $mat = $matricula == NULL ? 0 : $matricula . "') and NRSEQDEP in ('" . $sequencia . "')");
        oci_execute($stid2);
        $row2 = oci_fetch_array($stid2, OCI_ASSOC + OCI_RETURN_NULLS);
        $nome_dependente = $row2['NOPESSOABENEF'];

        $stid = oci_parse($conn, "SELECT NOTITULAR, NRCPF, CDPESSOAUNID FROM VW_BENEFICIARIO WHERE NRMATRICULA in ('" . $matricula . "') and NRSEQDEP in (0)");
        oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        $cpf_titular = $row['NRCPF'];
        $nome_titular = $row['NOTITULAR'];

        $stid3 = oci_parse($conn, "select NOPESSOAUNID from VW_UNIDADE where CDPESSOAUNID =  '" . $row2['CDPESSOAUNID'] . "'");
        oci_execute($stid3);
        $row3 = oci_fetch_array($stid3, OCI_ASSOC + OCI_RETURN_NULLS);
        $unidades = $row3['NOPESSOAUNID'];
    } elseif ($condition === "I") {
        $sub_fatura = substr($value['conteudo_R'], 12, 3);
        $certificado = 0;
        $cpf_titular = substr($value['conteudo_R'], 96, 11);
        $matricula = substr($value['conteudo_R'], 22, 6);

        $stid = oci_parse($conn, "SELECT NOTITULAR, NRCPF, CDPESSOAUNID FROM VW_BENEFICIARIO WHERE NRMATRICULA in ('" . $matricula . "') and NRSEQDEP in (0)");
        oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        $nome_titular = $nome_dependente = $row['NOTITULAR'];

        $stid4 = oci_parse($conn, "select NOPESSOAUNID from VW_UNIDADE where CDPESSOAUNID =  '" . $row['CDPESSOAUNID'] . "'");
        oci_execute($stid4);
        $row4 = oci_fetch_array($stid4, OCI_ASSOC + OCI_RETURN_NULLS);
        $unidades = $row4['NOPESSOAUNID'];
    } elseif ($condition === "A") {

        $certificado = substr($value['conteudo_R'], 15, 7);
        $matriculas = substr($value['conteudo_R'], 22, 6);
        $stid11 = oci_parse($conn, $querie->registro_rel_bradesco_sql_11($matriculas));
        oci_execute($stid11);
        $row11 = oci_fetch_array($stid11, OCI_ASSOC + OCI_RETURN_NULLS);
        $cpf_titular = $row11['NOCPF'];
        $nome_titular = $row11['NOTITULAR'];
        $nome_dependente = 'Não encontrado';
        $matricula = $row11['NRMATRICULA'];
        $unidades = 'Não encontrado';
        $sub_fatura = '000';
    }

    switch ($apolice) {
        case '71185':
            if ($sub_fatura === '408') {
                $unidade = 'WMS SUPERMERCADOS DO BRASIL LTDA';
            } elseif ($sub_fatura === '002') {
                $unidade = 'WALMART BRASIL LTDA';
            }
            break;
        case '73776':
            switch ($sub_fatura) {
                case '001':
                    $unidade = 'WALMART BRASIL LTDA';
                    break;
                case '002':
                    $unidade = 'WMS SUPERMERCADOS DO BRASIL LTDA';
                    break;
                case '003':
                    $unidade = 'BOMPRECO BAHIA SUPERMERCADOS LTDA';
                    break;
                case '004':
                    $unidade = 'BOMPRECO SUPERMERCADOS DO NORDESTE LTDA';
                    break;
                case '005':
                    $unidade = 'WMB COMERCIO ELETRONICO';
                    break;
                case '006':
                    $unidade = 'TRANSPORTADORA BOMPRECO LTDA';
                    break;
                case '007':
                    $unidade = 'WM GLOBAL SOURCING BRASIL LTDA';
                    break;
                case '000':
                    $unidade = 'Não Localizado';
                    break;
            }
            break;
    }

    foreach ($pdo->query($querie->registro_rel_bradesco_e($registros->get_nome_arquivo(), $registro_r)) as $values) {
        if (($values['cod_erro_E'] !== '0017') or ( $values['cod_erro_E'] !== '0245')) {
            $html = $html . '<tr>';
            $html = $html . '<td>' . $sub_fatura . '</td>';
            $html = $html . '<td>' . $unidade . '/' . $unidades . '</td>';
            $html = $html . '<td>' . $nome_dependente . '</td>';
            $html = $html . '<td>' . $certificado . '</td>';
            $html = $html . '<td>' . $matricula . '</td>';
            $html = $html . '<td>' . $nome_titular . '</td>';
            $html = $html . '<td>' . $cpf_titular . '</td>';
            $html = $html . '<td>' . $values['cod_erro_E'] . '</td>';
            $html = $html . '<td>' . $values['descricao_erro_E'] . '</td>';
            $html = $html . '</tr>';
        }
    }
}

$html = $html . '</tbody>';
$html = $html . '</table>';
header("Content-type: application/vnd.ms-excel");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=" . $nome_arquivo . ".xls");
header("Pragma: no-cache");
Database::disconnect();
echo $html;