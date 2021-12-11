<div id="refresca_herval">
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
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Agendamentos Herval</h2>                    
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
                                        <th>Agendamento</th>
                                        <th>Data Agendamento</th>
                                        <th>Situação</th>                                        
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Unidade</th>
                                        <th>Agendamento</th>
                                        <th>Data Agendamento</th>
                                        <th>Situação</th>                                        
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    include '../../class/ayuadame.php';
                                    $pdo = Database::connect();
                                    $sql = "select id, id_tipo_agendamento,id_unidade, data_agendamento, id_situacao from herval_agendamento where status = 1 order by id_unidade asc";
                                    foreach ($pdo->query($sql) as $value) {

                                        $sql_cargo = 'select situacao from herval_situacao_agendamento where id = '.$value['id_situacao'];
                                        $qq = $pdo->prepare($sql_cargo);
                                        $qq->execute();
                                        $data_cargo = $qq->fetch(PDO::FETCH_ASSOC);
                                        
                                        $sql_unidade = 'select unidade from herval_unidades where id = '.$value['id_unidade'];
                                        $qqq = $pdo->prepare($sql_unidade);
                                        $qqq->execute();
                                        $data_unidade = $qqq->fetch(PDO::FETCH_ASSOC);
                                        
                                        $sql_unidades = 'select nome_agendamento from herval_tipos_agendamentos where id = '.$value['id_tipo_agendamento'].' order by nome_agendamento asc';
                                        $qqqs = $pdo->prepare($sql_unidades);
                                        $qqqs->execute();
                                        $data_unidades = $qqqs->fetch(PDO::FETCH_ASSOC);
                                        
                                        echo '<tr>';
                                        echo '<td>' . utf8_encode($data_unidade['unidade']) . '</td>';
                                        echo '<td>' . $data_unidades['nome_agendamento'] . '</td>';
                                        echo '<td>' . transformaEmDataBrasileira($value['data_agendamento']) . '</td>';
                                        echo '<td>' . utf8_encode($data_cargo['situacao']) . '</td>';                                        
                                        echo '<td><a href="herval_agendamento_individual_incluir.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-danger">Incluir Agendamento Individual <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
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
                </div>
            </div>
        </div>
    </div>
</div>