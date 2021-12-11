<?php

session_start();
include '../config/database_mysql.php';
require '../Model/Cassi.php';
require '../Model/Cassi_Agendamento.php';
require '../Model/Cassi_Agencia.php';
require '../Model/Cassi_Agencia_Contato.php';
require '../Model/Medico.php';
require '../Model/Medicos.php';
include '../../class/ayuadame.php';
require_once('../../tools/tcpdf/tcpdf.php');
$pdo = Database::connect();
$cassi = new Cassi_Agendamento();
$cassi_agencia = new Cassi_Agencia();
$cassi_agencia_contato = new Cassi_Agencia_Contato();
$medico = new Medicos();
$cassi->set_prefixo(filter_input(INPUT_POST, 'agencia', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_data_agendamento(filter_input(INPUT_POST, 'data_agendamento', FILTER_SANITIZE_STRING));
$cassi->set_horario(filter_input(INPUT_POST, 'horario_chegada', FILTER_SANITIZE_STRING));
$cassi->set_id_cassi_situacao(filter_input(INPUT_POST, 'situacao', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_id_medico(filter_input(INPUT_POST, 'medico', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_valor_consulta(filter_input(INPUT_POST, 'consulta', FILTER_SANITIZE_STRING));
$cassi->set_user_agendamento($_SESSION['user_id']);
$array_medico = $medico->Dados_Medicos($cassi->get_id_medico());
$array_agencia = $cassi_agencia->Dados_Cassi_Agencias($cassi->get_prefixo());
$id_agencia = $cassi->get_prefixo();
$municipio = $array_agencia['municipio'];
$data = transformaEmDataBrasileira($cassi->get_data_agendamento());
$dados_agencia = $cassi_agencia_contato->Dados_Cassi_Agencias_Contatos($cassi->get_municipio());
$email2 = $dados_agencia['email2'] == NULL ? "" : $dados_agencia['email2'];
$confirm_agenda = $cassi->save_Cassi_Agendamento($cassi->get_prefixo(), $cassi->get_data_agendamento(), $cassi->get_horario(), $cassi->get_id_cassi_situacao(), $cassi->get_id_medico(), $cassi->get_valor_consulta(), $cassi->get_user_agendamento());
$cont = 0;
if ($confirm_agenda === TRUE) {
    $sql = "select prefixo, municipio, dependencia from cassi_agencia where id = $id_agencia order by municipio";
    foreach ($pdo->query($sql) as $value) {
        $prefixo = $value['prefixo'];
        $sql_ativos = "select matricula, nome_ativo, id from cassi_ativos where prefixo_agencia = $prefixo order by nome_ativo";
        foreach ($pdo->query($sql_ativos) as $values) {
            $sql_cargo = 'UPDATE cassi_ativos set id_cassi_situacao = 2 where id = ' . $values['id'];
            $qq = $pdo->prepare($sql_cargo);
            $qq->execute();
        }
        ++$cont;
    }
}
$confirm = true;

$pdf = new TCPDF('P', 'mm', 'A4', TRUE, 'UTF-8', FALSE);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Grupo AMA Gestão');
$pdf->SetTitle('Lista Presenca');
$pdf->SetSubject('-');
$pdf->SetKeywords('PCMSO,Supremo,Ferramenta,Periodicos');
$pdf->SetHeaderData('logo-amagestao.jpg', PDF_HEADER_LOGO_WIDTH, 'Lista Presença - ' . $array_agencia['dependencia'], '');
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
$nome_arquivo = 'Lista_Presenca_' . $array_agencia['prefixo'];
$y = $pdf->getY();
$pdf->AddPage();
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('courier', '', 12);
$pdf->Write(0, 'Lista Presença - ' . $array_agencia['dependencia'], '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(3);
$pdf->SetFont('courier', '', 6);
$pdf->writeHTMLCell(40, '', '', $y, '', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(40, '', '', $y, 'Compareceu', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(100, '', '', $y, 'ASO/PENDENCIAS', 1, 1, 1, true, 'C', TRUE);
$pdf->Ln(1);
$pdf->writeHTMLCell(40, '', '', $y, 'Nome do Funcionário', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(20, '', '', $y, 'Sim', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(20, '', '', $y, 'Não', 1, 0, 1, true, 'C', TRUE);
$pdf->writeHTMLCell(80, '', '', $y, 'Sim', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(20, '', '', $y, 'Não', 1, 1, 1, true, 'C', true);
$pdf->Ln(1);
$pdf->writeHTMLCell(80, '', '', $y, '', 1, 0, 1, true, 'C', TRUE);
$pdf->writeHTMLCell(20, '', '', $y, 'Laboratorial', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(20, '', '', $y, 'CP', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(20, '', '', $y, 'Mamo', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(20, '', '', $y, 'URO', 1, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(20, '', '', $y, '', 1, 1, 1, true, 'C', true);

if ($confirm_agenda === TRUE) {
    $sql = "select prefixo, municipio, dependencia from cassi_agencia where id = " . $cassi->get_prefixo() . " order by municipio";
    foreach ($pdo->query($sql) as $value) {
        $sql_ativos = "select matricula, nome_ativo, id from cassi_ativos where prefixo_agencia = " . $value['prefixo'] . " order by nome_ativo";
        foreach ($pdo->query($sql_ativos) as $value) {
            //$body = $body . "<tr><td>" . $value['matricula'] . "</td><td>" . $value['nome_ativo'] . "</td><td> </td></tr>";
            $pdf->SetFont('courier', '', 5);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->writeHTMLCell(40, 5, '', $y, $value['nome_ativo'], 1, 0, 1, true, 'L', true);
            $pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
            $pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
            $pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
            $pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
            $pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
            $pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
            $pdf->writeHTMLCell(20, 5, '', $y, '', 1, 1, 1, true, 'C', true);
            $pdf->Ln(1);
        }
        ++$cont;
    }
}
$pdf->writeHTMLCell(40, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 1, 1, true, 'C', true);
$pdf->Ln(1);
$pdf->writeHTMLCell(40, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 1, 1, true, 'C', true);
$pdf->Ln(1);
$pdf->writeHTMLCell(40, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 1, 1, true, 'C', true);
$pdf->Ln(1);
$pdf->writeHTMLCell(40, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 1, 1, true, 'C', true);
$pdf->Ln(1);
$pdf->writeHTMLCell(40, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(20, 5, '', $y, '', 1, 1, 1, true, 'C', true);
$pdf->Ln(1);

$pdf->lastPage();
Database::disconnect();
$pdf->Output('../../uploads/CASSI/lista_presenca/' . $nome_arquivo . '.pdf', 'F');

if (($confirm === TRUE) and ( $confirm_agenda === TRUE)) {
    echo '<div class="alert alert-success" role="alert">Agenda Criada com Sucesso!</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';
}