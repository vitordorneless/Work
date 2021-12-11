<?php

function transformaEmReal($valor) {
    $moeda = number_format($valor, 2, ',', '.');
    return $moeda;
}

function beginHTML() {
    $html = '<!DOCTYPE html><html><head><style>
            body {
                font-family: "arial";
                font-size: 15px;
                background-color: #FFFFF0; 
                margin: 0;
                padding: 0;
            }
            div.container {
                width: 620px;
                margin: 0 auto;
                border: 1px solid;
                border-radius: 9px;
                box-shadow: 2px 2px 1px #888888;
            }
            div.containerr {
                width: 610px;
                margin: 0 auto; 
                background-color: #FFFAF0;
            }
            h1 {
                font-family: "Helvetica";
                position: initial;
            }
            table, td, th, tr {
                border: 1px solid black;
            }

            table {
                width: 100%;
            }

            th {
                height: 40px;
            }
                    </style>
            <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head><body><div class="container">';
    return $html;
}

function endHTML() {
    $html = '</div></body></html>';
    return $html;
}

function assinatura_HTML() {
    $html = '<div class="containerr"><blockquote><p>Por Favor, <strong> responda este Email para "sso@amars.com.br"</strong>!!</p>
    <small>TI - AMA, Grupo AMA Gestão.</small><br></blockquote></div>';
    return $html;
}

function assinatura_HTMLwalmart() {
    $html = '<div class="containerr"><blockquote><p>Por Favor, <strong> responda este Email para "ssowalmart@amars.com.br"</strong>!!</p>
    <small>TI - AMA, Grupo AMA Gestão.</small><br></blockquote></div>';
    return $html;
}

function assinatura_HTMLwalmart_email($email) {
    $html = '<div class="containerr"><blockquote><p>Por Favor, <strong> responda este Email para "' . $email . '"</strong>!!</p>
    <small>TI - AMA, Grupo AMA Gestão.</small><br></blockquote></div>';
    return $html;
}

function assinatura_TST_HTML() {
    $html = '<div class="containerr"><blockquote><p>Por Favor, <strong> responda este Email para "segurancadotrabalho@amars.com.br"</strong>!!</p>
    <small>TI - AMA, Grupo AMA Gestão.</small><br></blockquote></div>';
    return $html;
}

function transformaEmDataBrasileira($dia) {
    $devolve_a_data = date('d/m/Y', strtotime($dia));
    return $devolve_a_data;
}

function extenso($valor = 0, $maiusculas = false) {
    if (strpos($valor, ",") > 0) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
    }
    $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
    $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões",
        "quatrilhões");
    $c = array("", "cem", "duzentos", "trezentos", "quatrocentos",
        "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
    $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta",
        "sessenta", "setenta", "oitenta", "noventa");
    $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze",
        "dezesseis", "dezesete", "dezoito", "dezenove");
    $u = array("", "um", "dois", "três", "quatro", "cinco", "seis",
        "sete", "oito", "nove");
    $z = 0;
    $valor = number_format($valor, 2, ".", ".");
    $inteiro = explode(".", $valor);
    $cont = count($inteiro);
    for ($i = 0; $i < $cont; $i++)
        for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++)
            $inteiro[$i] = "0" . $inteiro[$i];
    $fim = $cont - ($inteiro[$cont - 1] > 0 ? 1 : 2);
    $rt = '';
    for ($i = 0; $i < $cont; $i++) {
        $valor = $inteiro[$i];
        $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
        $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
        $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";
        $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                $ru) ? " e " : "") . $ru;
        $t = $cont - 1 - $i;
        $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
        if ($valor == "000")
            $z++;
        elseif ($z > 0)
            $z--;
        if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
            $r .= (($z > 1) ? " de " : "") . $plural[$t];
        if ($r)
            $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                    ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
    }
    if (!$maiusculas) {
        return($rt ? $rt : "zero");
    } elseif ($maiusculas == "2") {
        return (strtoupper($rt) ? strtoupper($rt) : "Zero");
    } else {
        return (ucwords($rt) ? ucwords($rt) : "Zero");
    }
}

function tabela_PRICE($presente_valor, $parcelas, $taxa_juross) {
    $one = 1;
    $casas_apos_virgula = 8;
    $divisor = 100;
    $taxa_juros = bcdiv($taxa_juross, $divisor, $casas_apos_virgula);
    $linha_superior_primeiro_parentese = bcadd($one, $taxa_juros, $casas_apos_virgula);
    $linha_superior_primeiro_parentese_elevado = bcpow($linha_superior_primeiro_parentese, $parcelas, $casas_apos_virgula);
    $multiplicacao_superior = bcmul($linha_superior_primeiro_parentese_elevado, $taxa_juros, $casas_apos_virgula);
    $linha_inferior_primeiro_parentese = bcadd($one, $taxa_juros, $casas_apos_virgula);
    $linha_inferior_primeiro_parentese_elevado = pow($linha_inferior_primeiro_parentese, $parcelas);
    $linha_inferior_primeiro_parentese_elevado_menos_um = bcsub($linha_inferior_primeiro_parentese_elevado, $one, $casas_apos_virgula);
    $divisao_valores = bcdiv($multiplicacao_superior, $linha_inferior_primeiro_parentese_elevado_menos_um, $casas_apos_virgula);
    $prestacao = bcmul($presente_valor, $divisao_valores, $casas_apos_virgula);
    return $prestacao;
}

function valCpf($cpff) {
    $cpf = preg_replace('/[^0-9]/', '', $cpff);
    $digitoA = 0;
    $digitoB = 0;
    for ($i = 0, $x = 10; $i <= 8; $i++, $x--) {
        $digitoA += $cpf[$i] * $x;
    }
    for ($i = 0, $x = 11; $i <= 9; $i++, $x--) {
        if (str_repeat($i, 11) == $cpf) {
            return false;
        }
        $digitoB += $cpf[$i] * $x;
    }
    $somaA = (($digitoA % 11) < 2 ) ? 0 : 11 - ($digitoA % 11);
    $somaB = (($digitoB % 11) < 2 ) ? 0 : 11 - ($digitoB % 11);
    if ($somaA != $cpf[9] || $somaB != $cpf[10]) {
        return false;
    } else {
        return true;
    }
}

function geraGrafico($largura, $altura, $valores, $referencias, $tipo = "p") {
    $valores = implode(',', $valores);
    $referencias = implode('|', $referencias);

    return "http://chart.apis.google.com/chart?chs=" . $largura . "x" . $altura . "&amp;chd=t:" . $valores . "&amp;cht=p&amp;chl=" . $referencias;
}

function begin_pdf_TCPDF() {
    $html = '<!DOCTYPE html><html><head><style>
            body {
                font-family: "arial";
                font-size: 15px;
                background-color: #FFFFF0; 
                margin: 0;
                padding: 0;
            }
            div.container {
                width: 591px;
                height: 840px;
                margin: 0 auto;
                border: 1px solid;
                border-radius: 9px;
                box-shadow: 2px 2px 1px #888888;
            }
            div.containerr {
                width: 610px;
                margin: 0 auto; 
                background-color: #FFFAF0;
            }
            h1 {
                font-family: "Helvetica";
                position: initial;
            }
            table, td, th, tr {
                border: 1px solid black;
            }

            table {
                width: 100%;
            }

            th {
                height: 40px;
            }
                    </style>
            <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head><body><div class="container">';
    return $html;
}

function end_pdf_TCPDF() {
    $html = '</div></body></html>';
    return $html;
}

function voucher_herval() {
    $voucher = date('Ymd') . substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 40) . date('s');
    return $voucher;
}

function diffDate($d1, $d2, $type = "", $sep = "-") {
    if (strstr($d1, ":")) {
        $dh1 = explode(" ", $d1);
        $d1 = explode($sep, $dh1[0]);
        $d1_h = explode(":", $dh1[1]);
    } else {
        $d1 = explode($sep, $d1);
        $d1_h[0] = $d1_h[1] = $d1_h[2] = 0;
    }
    if (strstr($d2, ":")) {
        $dh2 = explode(" ", $d2);
        $d2 = explode($sep, $dh2[0]);
        $d2_h = explode(":", $dh2[1]);
    } else {
        $d2 = explode($sep, $d2);
        $d2_h[0] = $d2_h[1] = $d2_h[2] = 0;
    }
    switch ($type) {
        case "A":
            $X = 31104000;
            break;
        case "M":
            $X = 2592000;
            break;
        case "D":
            $X = 86400;
            break;
        case "H":
            $X = 3600;
            break;
        case "MI":
            $X = 60;
            break;
        default:
            $X = 1;
    }
    return (((mktime($d1_h[0], $d1_h[1], $d1_h[2], $d1[1], $d1[2], $d1[0]) - mktime($d2_h[0], $d2_h[1], $d2_h[2], $d2[1], $d2[2], $d2[0])) / $X));
}

function mask($val, $mask) {
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
        if ($mask[$i] == '#') {
            if (isset($val[$k]))
                $maskared .= $val[$k++];
        }
        else {
            if (isset($mask[$i]))
                $maskared .= $mask[$i];
        }
    }
    return $maskared;
}

function email_valido($email) {
    $validate = $email = !preg_match('/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/', $email) ? 1 : 0;
    return $validate;
}

function getTime() {
    $tempo = microtime(TRUE);
    echo 'Tempo (segundos): ' . (microtime(true) - $tempo) . '';
}

function data_DMED($data) {
    $date_default = new DateTime($data);
    $data_volta = $date_default->format('Ymd');
    return $data_volta;
}

function abre_tabela() {
    $html = '<table cellspacing="0" cellpadding="1" border="0">';
    return $html;
}

function cabecalho_tabela() {
    $html = '<tr>        
                <td><strong><center></center></strong></td>
                <td><strong><center></center></strong></td>
                <td><strong><center></center></strong></td>
                <td><strong><center></center></strong></td>
                <td><strong><center></center></strong></td>
                </tr>';
    return $html;
}

function linha_estilosa() {
    $html = '<tr style="background-color:#CFCFCF;color:#000000">';
    return $html;
}

function fecha_linha_estilosa() {
    $html = '</tr>';
    return $html;
}

function linha() {
    $html = '<tr>';
    return $html;
}

function fecha_linha() {
    $html = '</tr>';
    return $html;
}

function coluna() {
    $html = '<td>';
    return $html;
}

function fecha_coluna() {
    $html = '</td>';
    return $html;
}

function fecha_tabela() {
    $html = '</table>';
    return $html;
}

function encurta_link($link) {
    require_once 'Googl.class.php';
    $google = new Googl('API KEY');
    $resultado = $google->shorten($link);
    return $resultado;
}

function demandas_prazo($dt_ult_altt) {
    $dt_ult_alt = new DateTime($dt_ult_altt);
    switch ($data_prazo['tipo']) {
        case 'horas':
            $dt_ult_alt->add(new DateInterval("PT" . $data_prazo['prazo'] . "H"));
            $comparador = $dt_ult_alt->format('Y-m-d');
            break;
        case 'dias':
            $dt_ult_alt->add(new DateInterval("P" . $data_prazo['prazo'] . "D"));
            $comparador = $dt_ult_alt->format('Y-m-d');
            break;
        case 'semanas':
            $dt_ult_alt->add(new DateInterval("P" . $data_prazo['prazo'] . "W"));
            $comparador = $dt_ult_alt->format('Y-m-d');
            break;
        case 'meses':
            $dt_ult_alt->add(new DateInterval("P" . $data_prazo['prazo'] . "M"));
            $comparador = $dt_ult_alt->format('Y-m-d');
            break;
    }
    $prazo_demanda = new DateTime($comparador);
    $hooje = new DateTime($hoje);
    if ($prazo_demanda < $hooje) {
        $semaforo = '<center><i class="fa fa-frown-o"></i></center>';
        $aviso = 'Vencida: ' . $prazo_demanda->format('d/m/Y');
    } else if ($prazo_demanda > $hooje) {
        $semaforo = '<center><i class="fa fa-smile-o"></i></center>';
        $aviso = 'No Prazo: ' . $prazo_demanda->format('d/m/Y');
    } else if ($prazo_demanda == $hooje) {
        $semaforo = '<center><i class="fa fa-meh-o"></center>';
        $aviso = 'Venc. Hoje: ' . $prazo_demanda->format('d/m/Y');
    }
}

function meise($mes){
    switch ($mes) {
        case 1:            
            $comparador = 'Janeiro';
            break;
        case 2:            
            $comparador = 'Fevereiro';
            break;
        case 3:            
            $comparador = 'Março';
            break;
        case 4;            
            $comparador = 'Abril';
            break;
        case 5:            
            $comparador = 'Maio';
            break;
        case 6:            
            $comparador = 'Junho';
            break;
        case 7:            
            $comparador = 'Julho';
            break;
        case 8:            
            $comparador = 'Agosto';
            break;
        case 9:            
            $comparador = 'Setembro';
            break;
        case 10:            
            $comparador = 'Outubro';
            break;
        case 11:            
            $comparador = 'Novembro';
            break;
        case 12:            
            $comparador = 'Dezembro';
            break;
    }
    return $comparador;
}

function tiraacento($str){
    return preg_replace('{\W}', ' ',preg_replace('{ +}', ' ',strtr(utf8_decode(html_entity_decode($str)),utf8_decode('ÀÁÃÂÉÈÊÍÌÓÒÕÔÚÙÜÇÑàáãâéèêíìóòõôúùüçñ'),'AAAAEEEIIOOOOUUUCNaaaaeeeiioooouuucn')));
}