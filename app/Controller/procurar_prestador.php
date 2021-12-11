<?php
include '../config/database_mysql.php';
include '../../class/ayuadame.php';
$pdo = Database::connect();

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$querie = new Queries();
$prestador_dados = new Prestadores_PJ();
$prestador = new Prospeccao_Medicos_e_Prestadores();
$prestador->set_id_prestador(filter_input(INPUT_POST, 'prestador', FILTER_SANITIZE_STRING));
$dados_prestador = $prestador_dados->Dados_Prestadores_PJ($prestador->get_id_prestador());
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script src="../js/JQuery/jquery-ui-1.11.2.custom/jquery-ui.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {
        $('.collapse').collapse();
    });
</script>
<table cellspacing="0" width="100%" class="table table-bordered">
    <thead>
        <tr class="text-center"><td colspan="4"><strong>Prestador</strong></tr>
        <tr>           
            <th class="text-center"><small>Prestador</small></th>            
            <th class="text-center"><small>Valor Exame</small></th>
            <th class="text-center"><small>Segunda Negociação</small></th>
            <th class="text-center"><small>Terceira Negociação</small></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center"><small><?php echo $dados_prestador['razao_social']; ?></small></td>            
            <td class="text-center"><small><?php echo $dados_prestador['valor_consulta']; ?></small></td>
            <td class="text-center"><small><?php echo $dados_prestador['valor_consulta_2']; ?></small></td>
            <td class="text-center"><small><?php echo $dados_prestador['valor_consulta_3']; ?></small></td>
        </tr>
    </tbody>
</table>
<br><br>
<table cellspacing="0" width="100%" class="table table-bordered">
    <thead>
        <tr class="text-center"><td colspan="3"><strong>Corpo Clínico</strong></tr>
        <tr>           
            <th class="text-center"><small>Nome</small></th>            
            <th class="text-center"><small>Especialidade</small></th>
            <th class="text-center"><small>CRM</small></th>            
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($pdo->query($querie->listar_medicos_via_prestador($prestador->get_id_prestador())) as $value) {
            echo '<tr>';
            echo '<td><small>' . $value['nome'] . '</small></td>';
            echo '<td><small>' . $value['funcao'] . '</small></td>';
            echo '<td><small>' . $value['crm'] . '</small></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
<table cellspacing="0" width="100%" class="table table-striped table-bordered">
    <thead>
        <tr class="text-center"><td colspan="6"><strong>Histórico do Prestador informados pelo setor de Redes</strong></tr>
        <tr>           
            <th class="text-center"><small>Prestador</small></th>
            <th class="text-center"><small>Médico</small></th>
            <th class="text-center"><small>Histórico</small></th>
            <th class="text-center"><small>Valor Exame</small></th>
            <th class="text-center"><small>Data da Prospecção</small></th>
            <th class="text-center"><small>Usuário</small></th>
            <th class="text-center"><small>Lojas Negociadas</small></th>            
        </tr>
    </thead>    
    <tbody>
        <?php
        foreach ($pdo->query($querie->prospeccao_listar($prestador->get_id_prestador())) as $value) {
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
            echo '<td><small>' . $value['lojas_negociadas'] . '</small></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
<?php
Database::disconnect();
