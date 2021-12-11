<div id="refresca_Prestadores_listar">
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
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Prestadores</h2>
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
                                        <th><small>Data Cadastro</small></th>
                                        <th><small>Razão Social</small></th>
                                        <th><small>CNES</small></th>                                        
                                        <th><small>Situação</small></th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th><small>Data Cadastro</small></th>
                                        <th><small>Razão Social</small></th>
                                        <th><small>CNES</small></th>                                        
                                        <th><small>Situação</small></th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    $pdo = Database::connect();
                                    $sql = "select prest.id as id, DATE_FORMAT(prest.data_cadastro, '%d/%c/%Y') as data_cadastro, tipo.tipo_prestador, prest.razao_social as razao_social, prest.CNES as CNES, prest.status as status  
                                            from wal_prestadores prest
                                            inner join tipo_prestador tipo on tipo.id = prest.id_tipo_prestador
                                            where prest.status = 1
                                            order by data_cadastro asc";
                                    foreach ($pdo->query($sql) as $value) {
                                        echo '<tr>';
                                        echo '<td>' . $value['data_cadastro'] . '</td>';
                                        echo '<td>' . $value['razao_social'] . '</td>';
                                        echo '<td>' . $value['CNES'] . '</td>';                                        
                                        $situation = $value['status'] == 1 ? "Ativo" : "Inativo";
                                        echo '<td>' . $situation . '</td>';
                                        echo '<td><a href="prestador_editar.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default">Editar <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
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