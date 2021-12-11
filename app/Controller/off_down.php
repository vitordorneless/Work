<?php
define('DIR_DOWNLOAD', '../../uploads/OffLine/');
$arquivos = filter_input(INPUT_GET, 'off', FILTER_SANITIZE_STRING);
$arquivo = basename($arquivos);
$caminho_download = DIR_DOWNLOAD . $arquivo;
if (!file_exists($caminho_download))
   die('Arquivo não existe!');
header('Content-type: octet/stream');
header('Content-disposition: attachment; filename="'.$arquivo.'";'); 
header('Content-Length: '.filesize($caminho_download));
readfile($caminho_download);
exit;