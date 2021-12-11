<?php
error_reporting(E_ALL);
include '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$pdo = Database::connect();
$evento = new Demanda_Execute();
$querie = new Queries();
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$array = $evento->Dados_Demandas_id_demanda($id);
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {
        $("#fechar_modal").click(function () {
            $("#refresca_cassi_solicitante").load('demanda_admin_status.php');
        });
        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_cassi_solicitante").load('demanda_admin_status.php');
            }
        });
    });
</script>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    <h4 class="modal-title">Visualizar Demanda</h4>
</div>			
<div class="modal-body">
    <div class="table-responsive">
        <form class='form-horizontal' role='form'>
            <table id="funcionarios" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Executante</th>
                        <th>Obs:</th>                                        
                        <th>Status</th>
                        <th>Qualidade</th>
                        <th>Data Execução</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Executante</th>
                        <th>Obs:</th>                                        
                        <th>Status</th>
                        <th>Qualidade</th>
                        <th>Data Execução</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($pdo->query($querie->demandas_execute($array['id_demanda'])) as $value) {
                        $qqqq = $pdo->prepare($querie->listar_executante($value['id_executante']));
                        $qqqq->execute();
                        $data_executante = $qqqq->fetch(PDO::FETCH_ASSOC);
                        $qqqqqqq = $pdo->prepare($querie->status_list($value['id_status_clone_demanda']));
                        $qqqqqqq->execute();
                        $data_status = $qqqqqqq->fetch(PDO::FETCH_ASSOC);
                        $dt_ult_alt = new DateTime($value['data_ultima_alteracao']);                        
                        echo '<tr>';
                        echo '<td>' . $data_executante['nome_extenso'] . '</td>';
                        echo '<td><small>' . $value['obs'] . '</small></td>';
                        echo '<td>' . $data_status['status'] . '</td>';
                        $quality = $value['id_status_qualidade'] == 0 ? 'Não qualificado' : $value['id_status_qualidade'];
                        echo '<td>' . $quality . '</td>';
                        echo '<td>' . $dt_ult_alt->format('d/m/Y') . '</td>';
                        echo '</tr>';
                    }
                    Database::disconnect();
                    ?>
                </tbody>
            </table>
        </form>
    </div>                    
</div>
<div class="modal-footer"></div>