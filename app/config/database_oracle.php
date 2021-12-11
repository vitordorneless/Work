<?php

function Conectar_Oracle(){
$conn = oci_connect('sigama', 'ama@w3b', '10.103.0.253/amars');
return $conn;
}

function Desconectar_Oracle($conn){
    return oci_close($conn);
}