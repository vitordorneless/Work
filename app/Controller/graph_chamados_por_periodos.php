<?php

include '../config/database_mysql.php';
require '../Model/Chamado.php';
require '../Model/Chamados.php';
require '../Model/Chamados_Analise.php';
require '../Model/Chamados_Encerrar.php';
require '../Model/Chamados_Improcedentes.php';
require '../Model/Datas.php';

$datas = new Datas();
$chamado_analise = new Chamados_Analise();
$chamado_encerrado = new Chamados_Encerrar();
$chamado_improcedente = new Chamados_Improcedentes();

$datas->set_begin(filter_input(INPUT_POST, 'begin', FILTER_SANITIZE_STRING));
$datas->set_end(filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING));

$result_chamados_em_execucao = $chamado_analise->Chamados_em_Execucao_por_Datas($datas->get_begin(), $datas->get_end());
$result_chamados_encerrados = $chamado_encerrado->Chamado_Encerrar_por_datas($datas->get_begin(), $datas->get_end());
$result_chamados_improcedentes = $chamado_improcedente->Chamado_Improcedentes_por_Datas($datas->get_begin(), $datas->get_end());

echo '<div class="row">';
echo '<div class="alert alert-info" role="alert" style="width: 63%">
<p class="text-center"><strong>Período: '.date('d/m/Y', strtotime($datas->get_begin())).' à '.date('d/m/Y', strtotime($datas->get_end())).'</strong></p>
<p class="text-center"><strong>Resumo:</strong></p>
<p class="text-center">Em Execução: ' . $result_chamados_em_execucao . '</p>
<p class="text-center">Improcedentes: ' . $result_chamados_improcedentes . '</p>
<p class="text-center">Concluídos: ' . $result_chamados_encerrados . '</p></div>';
echo '</div>';
echo '<div class="row">';
$pdo = Database::connect();
$sql = 'select id, nome_extenso from usuarios where setor = 2 and status = 1 order by nome_extenso';
foreach ($pdo->query($sql) as $value) {
    $identity = $value['id'];
    $execucao = $chamado_analise->Chamados_em_Execucao_por_Datas_more_user($datas->get_begin(), $datas->get_end(), $identity);
    $improcedente = $chamado_improcedente->Chamado_Improcedentes_por_Datas_more_user($datas->get_begin(), $datas->get_end(), $identity);
    $concluido = $chamado_encerrado->Chamado_Encerrar_por_datas_more_user($datas->get_begin(), $datas->get_end(), $identity);
    echo '<div class="col-sm-6 col-md-4">';
    echo '<div class="thumbnail">';
    echo '<div class="caption">';
    echo '<h4 class="text-center">' . $value['nome_extenso'] . '</h4>';
    echo '<p>Chamados em Execução:     <strong>' . $execucao . '</strong></p>';
    echo '<p>Chamados Improcedentes:     <strong>' . $improcedente . '</strong></p>';
    echo '<p>Chamados Encerrados:     <strong>' . $concluido . '</strong></p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
Database::disconnect();
echo '</div>';
