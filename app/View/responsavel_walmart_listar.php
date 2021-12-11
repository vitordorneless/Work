<div id="refresca_responsavel_walmart_listar">
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
                    <h2 class="text-center"><strong>Listar </strong>Responsáveis por Loja da Walmart</h2>
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
                                        <th>Loja</th>
                                        <th>Responsável</th>
                                        <th>Telefone</th>
                                        <th>Email</th>                                        
                                        <th>Situação</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Loja</th>
                                        <th>Responsável</th>
                                        <th>Telefone</th>
                                        <th>Email</th>                                        
                                        <th>Situação</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    $pdo = Database::connect();
                                    $sql = "select estab.desc_estabelecimento as loja, resp.nome_responsavel as responsavel,
                                            resp.ddd as ddd, resp.telefone as tel, resp.email as mail, resp.status as status, resp.id as id 
                                            from responsaveis_walmart resp
                                            inner join wal_estabelecimento estab on estab.cod_estabelecimento = resp.id_loja
                                            where resp.status = 1
                                            order by estab.desc_estabelecimento asc";
                                    foreach ($pdo->query($sql) as $value) {
                                        echo '<tr>';
                                        echo '<td>' . $value['loja'] . '</td>';
                                        echo '<td>' . $value['responsavel'] . '</td>';
                                        echo '<td>' . $value['ddd'].' - '. $value['tel'] . '</td>';
                                        echo '<td>' . $value['mail'] . '</td>';                                        
                                        $situation = $value['status'] == 1 ? "Ativo" : "Inativo";
                                        echo '<td>' . $situation . '</td>';
                                        echo '<td><a href="responsavel_walmart_editar.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default">Editar <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
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