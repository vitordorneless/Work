<div id="refresca_tst_tipo_agendamento">
    <script src="../js/JQuery/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
    <style type="text/css" class="init"></style>
    <script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            $('#funcionarios').DataTable();
        });
    </script>
    <div class="row">
        <div class="col-md-3">
            <a href="tst_agendamento_incluir.php" data-toggle="modal" data-target="#myModal1" class="btn btn-default btn-danger">Incluir Agendamento TST <span class="glyphicon glyphicon-save" aria-hidden="true"></span></a><br><br><br>
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Agendamentos TST</h2>                    
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                        <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                    </div>                    
                </div>
                <div class="widget-content">                    
                    <br>
                    <div class="table-responsive">
                        <form class='form-horizontal' role='form'>
                            <table id="funcionarios" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Unidade</th>                                        
                                        <th>Turnos</th>
                                        <th>Situação</th>
                                        <th>Data Agendamento</th>
                                        <th>Checklist</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Unidade</th>                                        
                                        <th>Turnos</th>
                                        <th>Situação</th>
                                        <th>Data Agendamento</th>
                                        <th>Checklist</th>
                                        <th>Status</th>                                        
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    include '../../class/ayuadame.php';
                                    $pdo = Database::connect();
                                    $sql = "select id, id_unidade, id_turnos, id_situacao, data_agendamento, status, check_list from tst_agendamento where status in (1) order by data_agendamento asc";
                                    foreach ($pdo->query($sql) as $value) {
                                        
                                        $sql_unidade = 'select nome_unidade from tst_unidades where id in ('.$value['id_unidade'].')';
                                        $qq = $pdo->prepare($sql_unidade);
                                        $qq->execute();
                                        $data_unidade = $qq->fetch(PDO::FETCH_ASSOC);
                                        
                                        $sql_sit = 'select situacao from tst_situacao where id in ('.$value['id_situacao'].')';
                                        $qqq = $pdo->prepare($sql_sit);
                                        $qqq->execute();
                                        $data_sit = $qqq->fetch(PDO::FETCH_ASSOC);
                                        
                                        $sql_turnos = 'select turno from tst_turnos where id in ('.$value['id_turnos'].')';
                                        $qqqq = $pdo->prepare($sql_turnos);
                                        $qqqq->execute();
                                        $data_turnos = $qqqq->fetch(PDO::FETCH_ASSOC);
                                        
                                        $situation = $value['status'] == 1 ? "Ativo" : "Inativo";
                                        $checklist = $value['check_list'] == 1 ? "Ok" : "Não Informado";
                                        
                                        echo '<tr>';                                        
                                        echo '<td>' . utf8_encode($data_unidade['nome_unidade']) . '</td>';
                                        echo '<td>' . utf8_encode($data_turnos['turno']) . '</td>';
                                        echo '<td>' . utf8_encode($data_sit['situacao']) . '</td>';
                                        echo '<td>' . transformaEmDataBrasileira($value['data_agendamento']) . '</td>';                                        
                                        echo '<td>' . $checklist . '</td>';
                                        echo '<td>' . $situation . '</td>';
                                        echo '<td><a href="tst_agendamento_editar.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal1" class="btn btn-default btn-danger">Editar <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
                                        echo '</tr>';
                                    }
                                    Database::disconnect();
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal large" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                    <div class="modal large" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>