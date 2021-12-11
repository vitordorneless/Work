<?php
include '../../class/ayuadame.php';
include '../../class/alertas.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$offline = new Offline_Uploads_Interacoes();
$offline->set_nome_arquivo(filter_input(INPUT_POST, 'nome_arquivo', FILTER_SANITIZE_STRING));
$offline->set_nome_medico(filter_input(INPUT_POST, 'nome_medico', FILTER_SANITIZE_STRING));
$offline->set_crm(filter_input(INPUT_POST, 'crm', FILTER_SANITIZE_STRING));
$_UP['pasta'] = '../../uploads/Offline_XLS/';
$_UP['tamanho'] = 1024 * 1024 * 4;
$_UP['extensoes'] = array('xls', 'ods');
$_UP['renomeia'] = false;
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
if ($_FILES['arquivo']['error'] != 0) {
    die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]);
    exit;
}
$img_separador = explode('.', $_FILES['arquivo']['name']);
$extensao = strtolower(end($img_separador));
$offline->save_Offline_Uploads_Interacoes($offline->get_nome_arquivo(), $offline->get_nome_medico(), $offline->get_crm());
if (array_search($extensao, $_UP['extensoes']) === false) {
    alerta_2("Por favor, envie arquivos com as seguintes extensões: xls ou ods");
    exit;
}
if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
    alerta_2("O arquivo enviado é muito grande, envie arquivos de até 4Mb.");
    exit;
}
if ($_UP['renomeia'] == true) {
    $nome_final = md5(time()) . '.xls';
} else {
    $nome_final = $_FILES['arquivo']['name'];
}
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
    alerta("Upload efetuado com sucesso!", '../View/index.php');
} else {
    alerta("Não foi possível enviar o arquivo, tente novamente", '../View/index.php');
}