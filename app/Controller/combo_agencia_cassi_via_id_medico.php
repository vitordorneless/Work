<?php
include '../config/database_mysql.php';
include '../../class/ayuadame.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' no foi encontrado!');
}
$medico = new Medicos();
$medico->set_cpf(filter_input(INPUT_GET, 'cpf', FILTER_SANITIZE_STRING));
$cpff = $medico->Dados_Medicos_CPF($medico->get_cpf());
$id_medico = $cpff['id_medico'];
$cpf = true;//valCpf($medico->get_cpf());
$pdo = Database::connect();

if ($cpf === TRUE) {
    $sql = "select agenda.municipio as prefixo, agencia.municipio as municipio, agencia.prefixo as agencia  
        from cassi_agendamento agenda
        inner join cassi_agencia agencia on agencia.id = agenda.municipio
        where agenda.id_medico = $id_medico 
        order by agenda.data_agendamento asc";

    foreach ($pdo->query($sql) as $value) {
        echo '<option value="' . $value['agencia'] . '">' . $value['agencia'] . ' - ' . $value['municipio'] . '</option>';
    }
} else {
    echo '<option value="0">CPF Inválido - Insira Novamente...</option>';
}
Database::disconnect();
