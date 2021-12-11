<?php
error_reporting(E_ALL);
include_once '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' no foi encontrado!');
}
$pdo = Database::connect();
$Off = new Offline_Uploads_Interacoes();
$Off->set_nome_medico(filter_input(INPUT_POST, 'id_medico', FILTER_SANITIZE_NUMBER_INT));
$Off->set_id(filter_input(INPUT_POST, 'file_up', FILTER_SANITIZE_NUMBER_INT));
$dados = $Off->Dados_Offline_Uploads_Interacoes($Off->get_id()); 
$n_linha = 0; 
echo "<table border='1'>";
$handle = fopen('../../uploads/Offline_XLS/'.$dados['nome_arquivo'].'.csv', "r");
while (($data = fgetcsv($handle, 1024*1024, ";")) !== FALSE) {
    echo "<tr>";
    if($n_linha == 0){
	// escreve dados do cabeçalho se for a primeira linha do ficheiro
	echo "<th>".$data[0]."</th>";
	echo "<th>".$data[1]."</th>";
	echo "<th>".$data[2]."</th>";
        echo "<th>".$data[3]."</th>";
        echo "<th>".$data[4]."</th>";
        echo "<th>".$data[5]."</th>";
        echo "<th>".$data[6]."</th>";
        echo "<th>".$data[7]."</th>";
        echo "<th>".$data[8]."</th>";
        echo "<th>".$data[9]."</th>";
        echo "<th>".$data[45]."</th>";        
    }else{
	// escreve os valores de cada linha
	echo "<td>".$data[0]."</td>";
	echo "<td>".$data[1]."</td>";
	echo "<td>".$data[2]."</td>";
        echo "<td>".$data[3]."</td>";
        echo "<td>".$data[4]."</td>";
        echo "<td>".$data[5]."</td>";
        echo "<td>".$data[6]."</td>";
        echo "<td>".$data[7]."</td>";
        echo "<td>".$data[8]."</td>";
        echo "<td>".$data[9]."</td>";
        echo "<td>".$data[45]."</td>";        
    }
    echo "</tr>";
    
    $n_linha ++;
}
echo "</table>";
 
fclose($handle);