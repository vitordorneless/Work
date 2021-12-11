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
            <a href="wal_caixas_incluir.php" data-toggle="modal" data-target="#myModal1" class="btn btn-default btn-danger">Incluir Caixa <span class="glyphicon glyphicon-save" aria-hidden="true"></span></a><br><br><br>
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Caixas Abertas</h2>                    
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
                                        <th>Etiqueta</th>                                        
                                        <th>Médico</th>
                                        <th>Aberta?</th>                                        
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Etiqueta</th>                                        
                                        <th>Médico</th>
                                        <th>Aberta?</th>                                        
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    include '../../class/ayuadame.php';
                                    $pdo = Database::connect();
                                    $sql = "select id, etiqueta, id_usuario, id_wal_box, status from wal_caixa where id_wal_box in (1) order by etiqueta asc";
                                    foreach ($pdo->query($sql) as $value) {

                                        $sql_unidade = 'select nome_extenso from usuarios where id in (' . $value['id_usuario'] . ')';
                                        $qq = $pdo->prepare($sql_unidade);
                                        $qq->execute();
                                        $data_unidade = $qq->fetch(PDO::FETCH_ASSOC);

                                        $sql_sit = 'select estado from wal_box where id in (' . $value['id_wal_box'] . ')';
                                        $qqq = $pdo->prepare($sql_sit);
                                        $qqq->execute();
                                        $data_sit = $qqq->fetch(PDO::FETCH_ASSOC);
                                        $situation = $value['status'] == 1 ? "Ativo" : "Inativo";

                                        echo '<tr>';
                                        echo '<td>' . $value['etiqueta'] . '</td>';
                                        echo '<td>' . utf8_encode($data_unidade['nome_extenso']) . '</td>';
                                        echo '<td>' . utf8_encode($data_sit['estado']) . '</td>';
                                        echo '<td>' . $situation . '</td>';
                                        echo '<td><a href="wal_caixas_editar.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-info">Editar <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
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