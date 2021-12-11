<div id="refresca_cassi_solicitar">
    <script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
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
        <div class="col-md-8">
            <a href="cassi_solicitar_exame_incluir.php" data-toggle="modal" data-target="#myModal1" class="btn btn-default btn-dropbox">Solicitar Exame <span class="glyphicon glyphicon-save" aria-hidden="true"></span></a><br><br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Solicitantes de Consultas Médicas CASSI</h2>                    
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
                                        <th><small>Nome do Ativo</small></th>
                                        <th><small>Prestador</small></th>
                                        <th><small>Cidade</small></th>
                                        <th><small>Exame</small></th>
                                        <th><small>Data Exame</small></th>
                                        <th><small>Data Limite</small></th>
                                        <th><small>Turno</small></th>
                                        <th><small>Status</small></th>                                        
                                        <th><small>Ação</small></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th><small>Nome do Ativo</small></th>
                                        <th><small>Prestador</small></th>
                                        <th><small>Cidade</small></th>
                                        <th><small>Exame</small></th>
                                        <th><small>Data Exame</small></th>
                                        <th><small>Data Limite</small></th>
                                        <th><small>Turno</small></th>
                                        <th><small>Status</small></th>                                        
                                        <th><small>Ação</small></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    include '../../class/ayuadame.php';
                                    $pdo = Database::connect();
                                    $sql = "select id, id_exame, nome_funcionario, prazo_limite, id_prestador, id_cidade_solicitada, turno, data_exame, status from cassi_solicitar_exames order by prazo_limite desc";
                                    foreach ($pdo->query($sql) as $value) {

                                        $sql1 = "select nome_exame from cassi_exames where id = " . $value['id_exame'];
                                        $q1 = $pdo->prepare($sql1);
                                        $q1->execute();
                                        $data1 = $q1->fetch(PDO::FETCH_ASSOC);

                                        $sql2 = "select razao_social from wal_prestadores where status = 1 and id = " . $value['id_prestador'];
                                        $q2 = $pdo->prepare($sql2);
                                        $q2->execute();
                                        $data2 = $q2->fetch(PDO::FETCH_ASSOC);

                                        $sql3 = "select nom_cidade from cidade where id = " . $value['id_cidade_solicitada'];
                                        $q3 = $pdo->prepare($sql3);
                                        $q3->execute();
                                        $data3 = $q3->fetch(PDO::FETCH_ASSOC);

                                        $sql4 = "select nome_turno from cassi_turnos where id = " . $value['turno'];
                                        $q4 = $pdo->prepare($sql4);
                                        $q4->execute();
                                        $data4 = $q4->fetch(PDO::FETCH_ASSOC);

                                        $sql5 = "select nome_status from cassi_status_exames where id = " . $value['status'];
                                        $q5 = $pdo->prepare($sql5);
                                        $q5->execute();
                                        $data5 = $q5->fetch(PDO::FETCH_ASSOC);

                                        echo '<tr>';
                                        echo '<td><small>' . utf8_encode($value['nome_funcionario']) . '</small></td>';
                                        echo '<td><small>' . utf8_encode($data2['razao_social']) . '</small></td>';
                                        echo '<td><small>' . utf8_encode($data3['nom_cidade']) . '</small></td>';
                                        echo '<td><small>' . utf8_encode($data1['nome_exame']) . '</small></td>';
                                        echo '<td><small><strong>' . transformaEmDataBrasileira($value['data_exame']) . '</strong></small></td>';
                                        echo '<td><small><strong>' . transformaEmDataBrasileira($value['prazo_limite']) . '</strong></small></td>';
                                        echo '<td><small>' . utf8_encode($data4['nome_turno']) . '</small></td>';
                                        echo '<td><small>' . utf8_encode($data5['nome_status']) . '</small></td>';
                                        echo '<td><a href="cassi_solicitar_exame_editar.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-dropbox">Alterar Solicitante <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
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