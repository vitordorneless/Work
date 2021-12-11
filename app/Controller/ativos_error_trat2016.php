<?php
include '../config/database_mysql.php';
$pdo = Database::connect();
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$data_periodico = filter_input(INPUT_POST, 'data_periodico', FILTER_SANITIZE_STRING);
$sql = "UPDATE wal_funcionarios SET flg_periodico = 1, data_periodico = " . $data_periodico . ",
        erro = 0, erro_identificacao = 0, erro_riscos = 0, erro_data_ASO = 0, erro_data_exames = 0, erro_assinatura_ativo = 0,
        erro_assinatura_medico = 0, erro_carimbo = 0, erro_rasuras = 0, erro_falta_apto = 0, 
        erro_falta_habilitado = 0, erro_tel = 0, erro_coord = 0, erro_duplicado = 0, erro_falta_aso = 0,
        data_ultima_alteracao = now() where id in(" . $id . ")";
$executa = $pdo->prepare($sql);
$executa_sql = $executa->execute();
Database::disconnect();
if ($executa_sql) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Corrigido com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Erro!! Contate a TI-AMA...<br>' . $pdo->errorInfo() . '</div>';
}