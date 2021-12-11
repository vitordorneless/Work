<?php
include '../config/database_mysql.php';
include '../../class/ayuadame.php';
$data_inicio = filter_input(INPUT_POST, 'data_inicio', FILTER_SANITIZE_STRING) . ' 00:00:00';
$data_final = filter_input(INPUT_POST, 'data_final', FILTER_SANITIZE_STRING) . ' 23:59:59';
?>
<link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
<style type="text/css" class="init"></style>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
<script class="init">
    $(document).ready(function () {
        $('#funcionariosssss').DataTable();
    });
</script>
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Listar </strong>LOG de Operações</h2>
                <div class="additional-btn">                    
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>                    
                </div>
            </div>
            <div class="widget-content">
                <br>
                <div class="table-responsive">                    
                    <table id="funcionariosssss" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><small>Tarefa</small></th>
                                <th><small>Usuário</small></th>
                                <th><small>Data da Tarefa</small></th>
                            </tr>                            
                        </thead>
                        <tfoot>
                            <tr>
                                <th><small>Tarefa</small></th>
                                <th><small>Usuário</small></th>
                                <th><small>Data da Tarefa</small></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $pdo = Database::connect();
                            $sql = "select tarefa, user, data_tarefa from tst_log where data_tarefa between '$data_inicio' and '$data_final' order by data_tarefa desc, tarefa";
                            foreach ($pdo->query($sql) as $value) {
                                $nome_user = "select nome_extenso from usuarios where id in (" . $value['user'] . ")";
                                $q = $pdo->prepare($nome_user);
                                $q->execute();
                                $data = $q->fetch(PDO::FETCH_ASSOC);

                                echo '<tr>';
                                echo '<td><small><strong>' . $value['tarefa'] . '</strong></small></td>';
                                echo '<td><small><strong>' . utf8_encode($data['nome_extenso']) . '</strong></small></td>';
                                echo '<td><small><strong>' . transformaEmDataBrasileira($value['data_tarefa']) . '</strong></small></td>';
                                echo '</tr>';
                            }
                            Database::disconnect();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>