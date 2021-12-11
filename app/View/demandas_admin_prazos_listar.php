<div id="refresca_cassi_solicitante">
    <script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax nÃ£o funciona-->
    <link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
    <style type="text/css" class="init"></style>
    <script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            $('#funcionarios').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"}});
        });
    </script>
    <div class="row">
        <div class="col-md-8">
            <a href="demandas_admin_prazos_incluir.php" data-toggle="modal" data-target="#myModal1" class="btn btn-default btn-dropbox">Incluir Prazo <span class="glyphicon glyphicon-save" aria-hidden="true"></span></a><br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Prazos para Tipos de Demandas</h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>                        
                    </div>                    
                </div>
                <div class="widget-content">
                    <br>
                    <div class="table-responsive">
                        <form class='form-horizontal' role='form'>
                            <table id="funcionarios" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nome do Prazo</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nome do Prazo</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    $pdo = Database::connect();
                                    function __autoload($file) {
                                        if (file_exists('../Model/' . $file . '.php'))
                                            require_once('../Model/' . $file . '.php');
                                        else
                                            exit('O arquivo ' . $file . ' nÃ£o foi encontrado!');
                                    }
                                    $querie = new Queries();
                                    foreach ($pdo->query($querie->demanda_admin_listar_prazos()) as $value) {
                                        echo '<tr>';
                                        echo '<td>' . $value['prazo'] . ' '.$value['tipo'].'</td>';
                                        $situation = $value['status'] == 1 ? "Ativo" : "Inativo";
                                        echo '<td>' . $situation . '</td>';
                                        echo '<td><a href="demandas_admin_prazos_editar.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-dropbox">Editar <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
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