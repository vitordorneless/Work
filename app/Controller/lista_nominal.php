<?php
ob_start();
include '../config/database_mysql.php';
include '../../class/ayuadame.php';
$pdo = Database::connect();
require_once('../../tools/tcpdf/tcpdf.php');
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$empresa = filter_input(INPUT_GET, 'empresa', FILTER_SANITIZE_STRING);
$estabelecimento = filter_input(INPUT_GET, 'estabelecimento', FILTER_SANITIZE_STRING);
$querie = new Queries();
$walmart = new Wal_Ativos();
$cont = 0;
$loja = $walmart->Dados_Wal_Loja_2016($empresa, $estabelecimento);
$pdf = new TCPDF('P', 'mm', 'A4', TRUE, 'UTF-8', FALSE);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Grupo AMA Gestão');
$pdf->SetTitle('Lista Nominal');
$pdf->SetSubject('-');
$pdf->SetKeywords('PCMSO,Supremo,Ferramenta,Periodicos');
$pdf->SetHeaderData('logo-amagestao.jpg', PDF_HEADER_LOGO_WIDTH, 'Lista Nominal - ' . $loja['desc_estabelecimento'], '');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__) . '/lang/por.php')) {
    require_once(dirname(__FILE__) . '/lang/por.php');
    $pdf->setLanguageArray($l);
}
$nome_arquivo = 'Lista_Nominal_' . $loja['desc_estabelecimento'];
$y = $pdf->getY();
$pdf->AddPage();
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('courier', '', 12);
$pdf->Write(0, 'Lista Nominal - Loja ' . $loja['desc_estabelecimento'], '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(3);
$pdf->SetFont('courier', '', 6);
$pdf->writeHTMLCell(40, '', '', $y, 'NOME', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(15, '', '', $y, 'CPF', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(15, '', '', $y, 'IDENTIDADE', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(15, '', '', $y, 'NASCIMENTO', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(30, '', '', $y, 'DEPARTAMENTO', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(30, '', '', $y, 'CARGO', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(35, '', '', $y, 'ASSINATURA', 1, 0, 1, true, 'C', true);
$pdf->Ln(3);
foreach ($pdo->query($querie->lista_nominal($empresa, $estabelecimento)) as $value) {    
    $departamento = $walmart->Dados_Wal_depto($value['cod_depto']);
    $cargo = $walmart->Dados_Wal_cargo_2016($value['cod_cargo']);
    $pdf->SetFont('courier', '', 5);    
    $pdf->SetFillColor(255, 255, 255);
    $pdf->writeHTMLCell(40, 5, '', $y, $value['nome_funcionario'], 1, 0, 1, true, 'L', true);
    $pdf->writeHTMLCell(15, 5, '', $y, $value['cpf'], 1, 0, 1, true, 'C', true);
    $pdf->writeHTMLCell(15, 5, '', $y, $value['identidade'], 1, 0, 1, true, 'L', true);
    $pdf->writeHTMLCell(15, 5, '', $y, transformaEmDataBrasileira($value['nascimento']), 1, 0, 1, true, 'C', true);
    $pdf->writeHTMLCell(30, 5, '', $y, $departamento['desc_depto'], 1, 0, 1, true, 'L', true);
    $pdf->writeHTMLCell(30, 5, '', $y, $cargo['desc_cargo'], 1, 0, 1, true, 'L', true);
    $pdf->writeHTMLCell(35, 5, '', $y, '', 1, 1, 1, true, 'C', true);
    $pdf->Ln(1);
    ++$cont;
}
$pdf->Write(0, 'Total de Ativos: ' . $cont, '', 0, 'C', true, 0, false, false, 0);
$pdf->lastPage();
Database::disconnect();
ob_end_clean();
$pdf->Output($nome_arquivo . '.pdf', 'I');