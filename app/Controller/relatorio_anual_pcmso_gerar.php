<?php
ob_start();
set_time_limit(90000);
include '../config/database_mysql.php';
$pdo = Database::connect();
require_once('../../tools/tcpdf/tcpdf.php');
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$periodo = filter_input(INPUT_GET, 'periodo', FILTER_SANITIZE_STRING);
$lojas = array();
$cont = 0;
$querie = new Queries();
if($periodo === '2015'){
foreach ($pdo->query($querie->rel_anual_listar_unidades()) as $value) {
    $lojas[$cont] = $value['cod_estabelecimento'];
    ++$cont;
}
}else{
 foreach ($pdo->query($querie->rel_anual_listar_unidades2016()) as $value) {
    $lojas[$cont] = $value['cod_estabelecimento'];
    ++$cont;
}
}
$lojas_agrupadas = implode(",", $lojas);
$periodos = $periodo == '2016a' ? '2016' : $periodo;
$nome_arquivo = 'Relatorio_Anual_PCMSO_' . $periodo;

$pdf = new TCPDF('P', 'mm', 'A4', TRUE, 'UTF-8', FALSE);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Grupo AMA Gestão');
$pdf->SetTitle('Relatório Anual PCMSO');
$pdf->SetSubject('01/01/2015 a 31/12/2015');
$pdf->SetKeywords('PCMSO,Supremo,Ferramenta,Periodicos');
$pdf->SetHeaderData('logo-amagestao.jpg', PDF_HEADER_LOGO_WIDTH, 'Relatório Anual PCMSO '.$periodos, '');
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
$y = $pdf->getY();
foreach ($pdo->query($querie->rel_anual_listar_lojas($lojas_agrupadas,$periodo)) as $value) {
    $pdf->AddPage();
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('courier', '', 6);
    $pdf->Write(0, $value['desc_estabelecimento'], '', 0, 'C', true, 0, false, false, 0);
    $pdf->Write(0, 'RELATÓRIO ANUAL DO PCMSO - 01/01/' . $periodos . ' a 31/12/' . $periodos, '', 0, 'C', true, 0, false, false, 0);
    $pdf->Ln(10);            
    $pdf->writeHTMLCell(40, '', '', $y, 'NATUREZA DO EXAME', 0, 0, 1, true, 'C', true);
    $pdf->writeHTMLCell(35, '', '', $y, 'N. ANUAL EXAMES REALIZADOS', 0, 0, 1, true, 'C', true);
    $pdf->writeHTMLCell(35, '', '', $y, 'N. RESULTADOS ANORMAIS', 0, 0, 1, true, 'C', true);
    $pdf->writeHTMLCell(30, '', '', $y, 'N. RESULTADOS ANORMAIS X 100 ----------------- N. ANUAL DE EXAMES', 0, 0, 1, true, 'C', true);
    $pdf->writeHTMLCell(35, '', '', $y, 'EXAMES ANO SEGUINTE', 0, 1, 1, true, 'C', true);
    $pdf->Ln(12);
    
    foreach ($pdo->query($querie->rel_anual_listar_setores($value['cod_estabelecimento'],$periodo)) as $values) {

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($querie->rel_anual_listar_exames($value['cod_estabelecimento'], $values['cod_depto'],$periodo));
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $pdf->SetFont('courier', '', 6);                
        $pdf->SetFillColor(211, 211, 211);
        $pdf->writeHTMLCell(175, '', '', $y, 'SETOR: ' . $values['setor'], 0, 1, 1, true, 'J', true);
        $pdf->SetFillColor(255, 255, 255);
        $exame_clinico = 0;
        $pdf->writeHTMLCell(40, '', '', $y, 'EXAME CLÍNICO OCUPACIONAL', 0, 0, 1, true, 'J', true);
        $pdf->writeHTMLCell(35, '', '', $y, $data['Exame_clinico'], 0, 0, 1, true, 'C', true);
        $pdf->writeHTMLCell(35, '', '', $y, 0, 0, 0, 1, true, 'C', true);
        $pdf->writeHTMLCell(30, '', '', $y, $exame_clinico . '%', 0, 0, 1, true, 'C', true);
        $pdf->writeHTMLCell(35, '', '', $y, $data['Exame_clinico'], 0, 1, 1, true, 'C', true); 
        if ($data['ACIDO_HIPURICO'] > 0) {            
            if ($data['ACIDO_HIPURICO_alterado'] > 0) {
                $ACIDO_HIPURICO = bcdiv(bcmul($data['ACIDO_HIPURICO_alterado'], 100), $data['ACIDO_HIPURICO'], 2);
            } else {
                $ACIDO_HIPURICO = $data['ACIDO_HIPURICO_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'ÁCIDO HIPÚRICO', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ACIDO_HIPURICO'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ACIDO_HIPURICO_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $ACIDO_HIPURICO . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ACIDO_HIPURICO'], 0, 1, 1, true, 'C', true);
        }
        if ($data['ACIDO_MANDELICO'] > 0) {            
            if ($data['ACIDO_MANDELICO_alterado'] > 0) {
                $ACIDO_MANDELICO = bcdiv(bcmul($data['ACIDO_MANDELICO_alterado'], 100), $data['ACIDO_MANDELICO'], 2);
            } else {
                $ACIDO_MANDELICO = $data['ACIDO_MANDELICO_alterado'];
            }            
            $pdf->writeHTMLCell(40, '', '', $y, 'ÁCIDO MANDÉLICO', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ACIDO_MANDELICO'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ACIDO_MANDELICO_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $ACIDO_MANDELICO . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ACIDO_MANDELICO'], 0, 1, 1, true, 'C', true);
        }
        if ($data['acido_metil_hipurico'] > 0) {            
            if ($data['acido_metil_hipurico_alterado'] > 0) {
                $acido_metil_hipurico = bcdiv(bcmul($data['acido_metil_hipurico_alterado'], $data['acido_metil_hipurico'], 100), 2);
            } else {
                $acido_metil_hipurico = $data['acido_metil_hipurico_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'ÁCIDO METIL HIPÚRICO', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['acido_metil_hipurico'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['acido_metil_hipurico_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $acido_metil_hipurico . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['acido_metil_hipurico'], 0, 1, 1, true, 'C', true);
        }
        if ($data['ACIDO_TT_MUCONICO'] > 0) {            
            if ($data['ACIDO_TT_MUCONICO_alterado'] > 0) {
                $ACIDO_TT_MUCONICO = bcdiv(bcmul($data['ACIDO_TT_MUCONICO_alterado'], 100), $data['ACIDO_TT_MUCONICO'], 2);
            } else {
                $ACIDO_TT_MUCONICO = $data['ACIDO_TT_MUCONICO_alterado'];
            }            
            $pdf->writeHTMLCell(40, '', '', $y, 'ÁCIDO TT MUCÔNICO', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ACIDO_TT_MUCONICO'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ACIDO_TT_MUCONICO_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $ACIDO_TT_MUCONICO . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ACIDO_TT_MUCONICO'], 0, 1, 1, true, 'C', true);
        }
        if ($data['ACUIDADE_VISUAL'] > 0) {            
            if ($data['ACUIDADE_VISUAL_alterado'] > 0) {
                $ACUIDADE_VISUAL = bcdiv(bcmul($data['ACUIDADE_VISUAL_alterado'], 100), $data['ACUIDADE_VISUAL'], 2);
            } else {
                $ACUIDADE_VISUAL = $data['ACUIDADE_VISUAL_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'ACUIDADE VISUAL', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ACUIDADE_VISUAL'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ACUIDADE_VISUAL_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $ACUIDADE_VISUAL. '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ACUIDADE_VISUAL'], 0, 1, 1, true, 'C', true);
        }
        if ($data['AUDIOMETRIA'] > 0) {            
            if ($data['AUDIOMETRIA_alterado'] > 0) {
                $AUDIOMETRIA = bcdiv(bcmul($data['AUDIOMETRIA_alterado'], 100), $data['AUDIOMETRIA'], 2);
            } else {
                $AUDIOMETRIA = $data['AUDIOMETRIA_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'AUDIOMETRIA', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['AUDIOMETRIA'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['AUDIOMETRIA_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $AUDIOMETRIA . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['AUDIOMETRIA'], 0, 1, 1, true, 'C', true);
        }
        if ($data['AVALIACAO_PSICOSSOCIAL'] > 0) {            
            if ($data['AVALIACAO_PSICOSSOCIAL_alterado'] > 0) {
                $AVALIACAO_PSICOSSOCIAL = bcdiv(bcmul($data['AVALIACAO_PSICOSSOCIAL_alterado'], 100), $data['AVALIACAO_PSICOSSOCIAL'], 2);
            } else {
                $AVALIACAO_PSICOSSOCIAL = $data['AVALIACAO_PSICOSSOCIAL_alterado'];
            }            
            $pdf->writeHTMLCell(40, '', '', $y, 'AVALIAÇÃO PSICOSSOCIAL', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['AVALIACAO_PSICOSSOCIAL'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['AVALIACAO_PSICOSSOCIAL_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $AVALIACAO_PSICOSSOCIAL . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['AVALIACAO_PSICOSSOCIAL'], 0, 1, 1, true, 'C', true);
        }
        if ($data['COPROCULTURA'] > 0) {            
            if ($data['COPROCULTURA_alterado'] > 0) {
                $COPROCULTURA = bcdiv(bcmul($data['COPROCULTURA_alterado'], 100), $data['COPROCULTURA'], 2);
            } else {
                $COPROCULTURA = $data['COPROCULTURA_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'COPROCULTURA', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['COPROCULTURA'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['COPROCULTURA_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $COPROCULTURA . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['COPROCULTURA'], 0, 1, 1, true, 'C', true);
        }
        if ($data['CULTURAL_DE_OROFARINGE'] > 0) {            
            if ($data['CULTURAL_DE_OROFARINGE_alterado'] > 0) {
                $CULTURAL_DE_OROFARINGE = bcdiv(bcmul($data['CULTURAL_DE_OROFARINGE_alterado'], 100), $data['CULTURAL_DE_OROFARINGE'], 2);
            } else {
                $CULTURAL_DE_OROFARINGE = $data['CULTURAL_DE_OROFARINGE_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'CULTURAL DE OROFARINGE', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['CULTURAL_DE_OROFARINGE'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['CULTURAL_DE_OROFARINGE_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $CULTURAL_DE_OROFARINGE . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['CULTURAL_DE_OROFARINGE'], 0, 1, 1, true, 'C', true);
        }
        if ($data['ECG'] > 0) {            
            if ($data['ECG_alterado'] > 0) {
                $ECG = bcdiv(bcmul($data['ECG_alterado'], 100), $data['ECG'], 2);
            } else {
                $ECG = $data['ECG_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'ECG', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ECG'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ECG_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $ECG . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ECG'], 0, 1, 1, true, 'C', true);
        }
        if ($data['EEG'] > 0) {            
            if ($data['EEG_alterado'] > 0) {
                $EEG = bcdiv(bcmul($data['EEG_alterado'], 100), $data['EEG'], 2);
            } else {
                $EEG = $data['EEG_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'EEG', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['EEG'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['EEG_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $EEG . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['EEG'], 0, 1, 1, true, 'C', true);
        }
        if ($data['ERITROGRAMA'] > 0) {            
            if ($data['ERITROGRAMA_alterado'] > 0) {
                $ERITROGRAMA = bcdiv(bcmul($data['ERITROGRAMA_alterado'], 100), $data['ERITROGRAMA'], 2);
            } else {
                $ERITROGRAMA = $data['ERITROGRAMA_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'ERITROGRAMA', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ERITROGRAMA'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ERITROGRAMA_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $ERITROGRAMA . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['ERITROGRAMA'], 0, 1, 1, true, 'C', true);
        }
        if ($data['GLICEMIA_EM_JEJUM'] > 0) {            
            if ($data['GLICEMIA_EM_JEJUM_alterado'] > 0) {
                $GLICEMIA_EM_JEJUM = bcdiv(bcmul($data['GLICEMIA_EM_JEJUM_alterado'], 100), $data['GLICEMIA_EM_JEJUM'], 2);
            } else {
                $GLICEMIA_EM_JEJUM = $data['GLICEMIA_EM_JEJUM_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'GLICEMIA EM JEJUM', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['GLICEMIA_EM_JEJUM'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['GLICEMIA_EM_JEJUM_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $GLICEMIA_EM_JEJUM . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['GLICEMIA_EM_JEJUM'], 0, 1, 1, true, 'C', true);
        }
        if ($data['HEMOGRAMA'] > 0) {            
            if ($data['HEMOGRAMA_alterado'] > 0) {
                $HEMOGRAMA = bcdiv(bcmul($data['HEMOGRAMA_alterado'], 100), $data['HEMOGRAMA'], 2);
            } else {
                $HEMOGRAMA = $data['HEMOGRAMA_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'HEMOGRAMA', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['HEMOGRAMA'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['HEMOGRAMA_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $HEMOGRAMA . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['HEMOGRAMA'], 0, 1, 1, true, 'C', true);
        }
        if ($data['MICOLOGICO_DE_UNHA'] > 0) {            
            if ($data['MICOLOGICO_DE_UNHA_alterado'] > 0) {
                $MICOLOGICO_DE_UNHA = bcdiv(bcmul($data['MICOLOGICO_DE_UNHA_alterado'], 100), $data['MICOLOGICO_DE_UNHA'], 2);
            } else {
                $MICOLOGICO_DE_UNHA = $data['MICOLOGICO_DE_UNHA_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'MICOLÓGICO DE UNHA', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['MICOLOGICO_DE_UNHA'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['MICOLOGICO_DE_UNHA_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $MICOLOGICO_DE_UNHA . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['MICOLOGICO_DE_UNHA'], 0, 1, 1, true, 'C', true);
        }
        if ($data['PARASITOLOGICO_FEZES'] > 0) {            
            if ($data['PARASITOLOGICO_FEZES_alterado'] > 0) {
                $PARASITOLOGICO_FEZES = bcdiv(bcmul($data['PARASITOLOGICO_FEZES_alterado'], 100), $data['PARASITOLOGICO_FEZES'], 2);
            } else {
                $PARASITOLOGICO_FEZES = $data['PARASITOLOGICO_FEZES_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'PARASITOLÓGICO DE FEZES', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['PARASITOLOGICO_FEZES'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['PARASITOLOGICO_FEZES_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $PARASITOLOGICO_FEZES . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['PARASITOLOGICO_FEZES'], 0, 1, 1, true, 'C', true);
        }
        if ($data['PLAQUETAS'] > 0) {            
            if ($data['PLAQUETAS_alterado'] > 0) {
                $PLAQUETAS = bcdiv(bcmul($data['PLAQUETAS_alterado'], 100), $data['PLAQUETAS'], 2);
            } else {
                $PLAQUETAS = $data['PLAQUETAS_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'PLAQUETAS', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['PLAQUETAS'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['PLAQUETAS_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $PLAQUETAS . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['PLAQUETAS'], 0, 1, 1, true, 'C', true);
        }
        if ($data['RETICULOCITOS'] > 0) {            
            if ($data['RETICULOCITOS_alterado'] > 0) {
                $RETICULOCITOS = bcdiv(bcmul($data['RETICULOCITOS_alterado'], 100), $data['RETICULOCITOS'], 2);
            } else {
                $RETICULOCITOS = $data['RETICULOCITOS_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'RETICULÓCITOS', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['RETICULOCITOS'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['RETICULOCITOS_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $RETICULOCITOS . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['RETICULOCITOS'], 0, 1, 1, true, 'C', true);
        }
        if ($data['VDRL'] > 0) {
            if ($data['VDRL_alterado'] > 0) {
                $VDRL = bcdiv(bcmul($data['VDRL_alterado'], 100), $data['VDRL'], 2);
            } else {
                $VDRL = $data['VDRL_alterado'];
            }
            $pdf->writeHTMLCell(40, '', '', $y, 'VDRL', 0, 0, 1, true, 'J', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['VDRL'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['VDRL_alterado'], 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(30, '', '', $y, $VDRL . '%', 0, 0, 1, true, 'C', true);
            $pdf->writeHTMLCell(35, '', '', $y, $data['VDRL'], 0, 1, 1, true, 'C', true);
        }
    }
}
$pdf->lastPage();
Database::disconnect();
ob_end_clean();
$pdf->Output($nome_arquivo . '.pdf', 'I');