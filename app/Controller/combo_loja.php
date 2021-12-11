<?php

$empresa = filter_input(INPUT_GET, 'empresa', FILTER_SANITIZE_NUMBER_INT);

$caminho = "http://10.103.0.250:8080/Index.aspx?query=vw_unidade&conditionParams=cdpessoacli&conditionValues=$empresa";
$xml_da_hora = new SimpleXMLElement($caminho, 0, TRUE);
echo '<option selected value="0">Escolher...</option>';
foreach ($xml_da_hora->registros->registro as $value) {
    echo '<option value="' . $value->NOLOJA . '">' . $value->NOLOJA . ' - ' . $value->NOESTABELECIMENTO . '</option>';
}