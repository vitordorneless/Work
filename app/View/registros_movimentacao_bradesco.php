<?php

//include '../../class/ayuadame.php';
$dat = date('Y-m-d H:i:s');
echo 'oi<br>';
$array = array();
$arquivo = fopen('../../uploads/TXT_Bradesco/A071185_DT251115_SEQ01.txt', 'r');
$cont = $cont2 = 0;
//sleep(6);
while (!feof($arquivo)) {
    $linha = fgets($arquivo, 1024);
    //echo $linha . '<br />';
    array_push($array, $linha);
    ++$cont;
}

echo 'contei ' . $cont . ' linhas<br><br>';
//sleep(2);
fclose($arquivo);

echo 'aqui o foreach<br>';
foreach ($array as $value) {
    $comparador = $comparador1 = $comparador2 = $comparador3 = $comparador4 = $comparador5 = $comparador6 = 
            $comparador7 = $comparador8 = $comparador9 = $comparador10 = $comparador11 = $comparador12 = $comparador13 = 
            $comparador14 = $comparador15 = $comparador16 = $comparador17 = $comparador18 = $comparador19 = $comparador20 = 
            $comparador21 = $comparador22 = $comparador23 = $comparador24 = $comparador25 = $comparador26 = $comparador27 = 
            $comparador28 = $comparador29 = $comparador30 = $value;

    $rest = substr($comparador, 0, 1);    
    switch ($rest) {
        case '*':            
            $tipo_registro = substr($comparador1, 0, 1);
            $identificacao = substr($comparador2, 1, 10);
            $apolice = substr($comparador3, 11, 6);
            $data = substr($comparador4, 17, 8);
            $brancos = substr($comparador5, 25, 225);
            echo 'posição -> '.$cont2.$tipo_registro . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $identificacao . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $apolice . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $data . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $brancos . '<br>';
            break;
        case 'H':            
            $htipo_registro = substr($comparador6, 0, 1);
            $hcia = substr($comparador7, 1, 3);
            $hapolice = substr($comparador8, 4, 6);
            $hdata = substr($comparador9, 10, 8);
            $horigem = substr($comparador10, 18, 8);
            $hdata_transmissao = substr($comparador11, 26, 8);
            $hbrancos = substr($comparador12, 34, 216);
            echo 'posição -> '.$cont2.$htipo_registro . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $hcia . '&nbsp&nbsp&nbsp&nbsp&nbsp' .
            $hapolice . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $hdata . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $horigem . '&nbsp&nbsp&nbsp&nbsp&nbsp' .
            $hdata_transmissao . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $hbrancos . '<br>';
            break;
        case 'R':            
            $rtipo_registro = substr($comparador13, 0, 1);
            $rnumero_registro = substr($comparador14, 1, 6);
            $rconteudo = substr($comparador15, 7, 200);
            $r1 = $r2 = $r3 = $r4 = $r5 = $r6 = $r7 = $r8 = $r9 = $r10 = $r11 = $r12 = $r13 = $r14 = $r15 = $rconteudo;
            $rbrancos = substr($comparador16, 207, 43);
            $d_or_i = substr($r9, 0, 1);
            $quantos_caracteres = strlen($r15);
            $brancos_quantos = strlen($rbrancos);
            $r1_1 = substr($r1, 0,6);
            $r1_2 = substr($r2, 6,6);//apolice
            $r1_3 = substr($r3, 12,3);//subfa
            $r1_4 = substr($r4, 15,7);//certificadp
            $r1_5 = substr($r5, 22,6);//matricula
            $r1_6 = substr($r6, 34,8);//nascimento            
            echo $rtipo_registro . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $rnumero_registro . '&nbsp&nbsp&nbsp&nbsp&nbsp' .
            $rconteudo . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $rbrancos . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $quantos_caracteres.' caracteres '.$brancos_quantos.' brancos<br>';
            //echo 'aqui desmembrado não sabemos o que é esse '.$r1_1.'<br>'.' apolice '.$r1_2.' subfat '.$r1_3.'<br> certificado '.$r1_4.'<br> matricula '.
            //        $r1_5/*.'<br>nascimento '.$r1_6*/.'<br>';
            break;
        case 'E':            
            $etipo_registro = substr($comparador17, 0, 1);
            $enumero_registro = substr($comparador18, 1, 6);
            $ecodigo_erro = substr($comparador19, 7, 4);
            $edesc_erro = substr($comparador20, 11, 40);
            $esequencia = substr($comparador21, 51, 8);
            $ebrancos = substr($comparador22, 59, 191);
            echo $etipo_registro . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $enumero_registro . '&nbsp&nbsp&nbsp&nbsp&nbsp' .
            $ecodigo_erro . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $edesc_erro . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $esequencia .
            '&nbsp&nbsp&nbsp&nbsp&nbsp' . $ebrancos . '<br>';
            break;
        case 'T':            
            $ttipo_registro = substr($comparador23, 0, 1);
            $tquantidade_reg = substr($comparador24, 1, 6);
            $tbrancos = substr($comparador25, 7, 243);
            echo 'posição -> '.$cont2.$ttipo_registro . '&nbsp&nbsp&nbsp&nbsp&nbsp' . $tquantidade_reg . '&nbsp&nbsp&nbsp&nbsp&nbsp' .
            '&nbsp&nbsp&nbsp&nbsp&nbsp' . $ebrancos . '<br>';
            break;
    }
    ++$cont2;
}

$dataFuturo = date('Y-m-d H:i:s');
$date_time = new DateTime($dat);
$diff = $date_time->diff(new DateTime($dataFuturo));
echo $diff->format(' %H hora(s), %i minuto(s) e %s segundo(s)');
