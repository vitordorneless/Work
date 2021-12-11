<?php
include '../../class/alertas.php';
session_start();
session_destroy();
$caminho2 = "../../index.html";
echo "<script type='text/javascript'>window.location.href='$caminho2';</script>";
