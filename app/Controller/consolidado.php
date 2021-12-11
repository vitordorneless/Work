<?php
include '../config/database_mysql.php';
include '../../class/ayuadame.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$querie = new Queries();
$pdo = Database::connect();
?>
<table class="table table-bordered table-striped table-responsive table-hover table-condensed">
    <thead>
        <tr>
            <th class="text-center">Nome Prestador</th>
            <th class="text-center">CNES</th>
            <th class="text-center">Cadastro</th>
            <th class="text-center">Valor</th>
            <th class="text-center">Reacerto</th>
            <th class="text-center">Reacerto 2</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $cont = 0;
        foreach ($pdo->query($querie->consolidado()) as $value) {
            echo '<tr>';
            echo '<td colspan="1"><strong>' . $value['razao_social'] . '</strong></td>';
            echo '<td><strong>' . $value['CNES'] . '</strong></td>';            
            echo '<td><strong>' . transformaEmDataBrasileira($value['data_cadastro']) . '</strong></td>';
            echo '<td><strong>' . transformaEmReal(str_replace(",", ".", $value['valor_consulta'] == NULL ? 0 : $value['valor_consulta'])) . '</strong></td>';
            echo '<td><strong>' . transformaEmReal(str_replace(",", ".", $value['valor_consulta_2'] == NULL ? 0 : $value['valor_consulta_2'])) . '</strong></td>';
            echo '<td><strong>' . transformaEmReal(str_replace(",", ".", $value['valor_consulta_3'] == NULL ? 0 : $value['valor_consulta_3'])) . '</strong></td>';
            echo '</tr>';            
            $q = $pdo->prepare($querie->consolidado_sql_medico_tem($value['id']));
            $q->execute();
            $data = $q->fetch(PDO::FETCH_ASSOC);
            if ($data['tem'] > 0) {
                echo '<tr><td class="text-center text-danger"><small><strong>Nome Médico</strong></small></td>';
                echo '<td class="text-center text-danger"><small><strong>CRM</strong></small></td>';
                echo '<td class="text-center text-danger"><small><strong>Conselho</strong></small></td>';
                echo '<td class="text-center text-danger"><small><strong>CNES</strong></small></td>';
                echo '<td class="text-center text-danger"><small><strong>Valor Consulta</strong></small></td></tr>';
                
                foreach ($pdo->query($querie->consolidado_sql_medico($value['id'])) as $values) {                    
                    echo '<tr class="accordion-toggle">';                    
                    echo '<td class="text-center text-danger"><small><strong>' . $values['nome'] . '</strong></small></td>';
                    echo '<td class="text-center text-danger"><small>' . $values['crm'] . '</small></td>';
                    echo '<td class="text-center text-danger"><small>' . $values['conselho'] . '</small></td>';
                    echo '<td class="text-center text-danger"><small>' . $values['CNES'] . '</small></td>';                    
                    $qq = $pdo->prepare($querie->consolidado_sql_medico_valor($values['crm']));                    
                    $qq->execute();
                    $dataq = $qq->fetch(PDO::FETCH_ASSOC);
                    echo '<td class="text-center text-danger"><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['consulta'] == NULL ? 0 : $dataq['consulta'])) . '</small></td>';
                    echo '</tr>';                    
                    echo '</div></td>';                    
                }
            }
        }
        Database::disconnect();
        ?>    
    </tbody>
</table>