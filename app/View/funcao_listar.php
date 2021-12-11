<div id="refresca_funcao">
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
    <script src="../../css/bootstrap/lightbox/dist/ekko-lightbox.js"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Funções dos Médicos</h2>
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
                                        <th>Função</th>
                                        <th>Status</th>
                                        <th>Ação</th>                                    
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Função</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    $pdo = Database::connect();
                                    $sql = "SELECT id_funcao, funcao, ativo from wal_funcao_medico order by funcao";
                                    foreach ($pdo->query($sql) as $value) {
                                        echo '<tr>';
                                        echo '<td>' . $value['funcao'] . '</td>';
                                        $situation = $value['ativo'] == 1 ? "Ativo" : "Inativo";
                                        echo '<td>' . $situation . '</td>';
                                        echo '<td><a href="funcao_editar.php?id_funcao=' . $value['id_funcao'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default">Editar <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
                                        echo '</tr>';
                                    }
                                    Database::disconnect();
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            </div> <!-- /.modal-content -->
                        </div> <!-- /.modal-dialog -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>