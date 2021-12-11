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
$prestador = new Prospeccao_Medicos_e_Prestadores();
$prestador->set_id_prestador(filter_input(INPUT_POST, 'id_prestador', FILTER_SANITIZE_STRING));
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script src="../js/JQuery/jquery-ui-1.11.2.custom/jquery-ui.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {
        $('.collapse').collapse();
    });
</script>
<table cellspacing="0" width="100%" class="table table-striped table-bordered">
    <thead>
        <tr>           
            <th class="text-center"><small>Prestador</small></th>
            <th class="text-center"><small>Médico</small></th>
            <th class="text-center"><small>Histórico</small></th>
            <th class="text-center"><small>Valor Exame</small></th>
            <th class="text-center"><small>Data da Prospecção</small></th>
            <th class="text-center"><small>Usuário</small></th>
        </tr>
    </thead>
    <tfoot>    
    <th class="text-center"><small>Prestador</small></th>
    <th class="text-center"><small>Médico</small></th>
    <th class="text-center"><small>Histórico</small></th>
    <th class="text-center"><small>Valor Exame</small></th>
    <th class="text-center"><small>Data da Prospecção</small></th>
    <th class="text-center"><small>Usuário</small></th>
</tfoot>
<tbody>
    <?php
    $pdo = Database::connect();
    $sql = $querie->prospeccao_listar($prestador->get_id_prestador());
    foreach ($pdo->query($sql) as $value) {

        $sql_prestador = $querie->prospeccao_listar_prestador($value['id_prestador']);
        $qq = $pdo->prepare($sql_prestador);
        $qq->execute();
        $data_prestador = $qq->fetch(PDO::FETCH_ASSOC);
        
        $sql_usuario = $querie->prospeccao_listar_user($value['user']);
        $q = $pdo->prepare($sql_usuario);
        $q->execute();
        $data_usuario = $q->fetch(PDO::FETCH_ASSOC);

        if ($value['id_medico'] === '0') {
            $medico = "Informado apenas o Prestador";
        } else {
            $sql_medico = $querie->prospeccao_listar_medico($value['id_medico']);
            $qqq = $pdo->prepare($sql_medico);
            $qqq->execute();
            $data_medico = $qqq->fetch(PDO::FETCH_ASSOC);
            $medico = $data_medico['nome'];
        }

        echo '<tr>';
        echo '<td><small>' . $data_prestador['razao_social'] . '</small></td>';
        echo '<td class="text-uppercase"><small>' . $medico . '</small></td>';
        echo '<td class="text-justify"><small>' . $value['historico_prospeccao'] . '</small></td>';
        echo '<td><small>' . $value['valor_exame'] . '</small></td>';
        echo '<td><small>' . transformaEmDataBrasileira($value['data_prospeccao']) . '</small></td>';        
        echo '<td><small>' . $data_usuario['nome_extenso'] . '</small></td>';
        echo '</tr>';
    }
    Database::disconnect();
    ?>
</tbody>
</table>