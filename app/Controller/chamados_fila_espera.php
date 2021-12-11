<?php

function Fila_de_Espera(){
    require '../Model/Chamado.php';
    require '../Model/Chamados.php';
    $chamado = new Chamados();
    $fila_de_espera = $chamado->Chamados_Fila_de_Espera();
    return $fila_de_espera;
}

function Para_Execucao(){
    require '../Model/Chamados_Analise.php';
    $chamado = new Chamados_Analise();
    $execucao = $chamado->Chamados_em_Execucao();
    return $execucao;
}

function Chamados_Encerrados(){
    require '../Model/Chamados_Encerrar.php';
    $chamado = new Chamados_Encerrar();
    $encerra = $chamado->Chamados_Encerrados();
    return $encerra;
}

function Chamado_Improcedente(){
    require '../Model/Chamados_Improcedentes.php';
    $chamado = new Chamados_Improcedentes();
    $improcedente = $chamado->Chamados_Improcedentes_report();
    return $improcedente;
}