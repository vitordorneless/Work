<div id="refresca_setores_AMA">
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
                    <h2><strong>Listar </strong>Convocações</h2>
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
                                        <th>Convocação</th>
                                        <th>Loja</th>
                                        <th>Turnos</th>
                                        <th>Kit entregue?</th>                                                                                
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Convocação</th>
                                        <th>Loja</th>
                                        <th>Turnos</th>
                                        <th>Kit entregue?</th>                                                                                
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    function __autoload($file) {
                                        if (file_exists('../Model/' . $file . '.php'))
                                            require_once('../Model/' . $file . '.php');
                                        else
                                            exit('O arquivo ' . $file . ' não foi encontrado!');
                                    }

                                    $querie = new Queries();
                                    $pdo = Database::connect();                                    
                                    foreach ($pdo->query($querie->listar_convocacao()) as $value) {
                                        echo '<tr>';
                                        echo '<td>' . $value['convocacao'] . '</td>';                                        
                                        echo '<td>' . $value['loja'] . '</td>';
                                        echo '<td>' . $value['turnos'] . '</td>';
                                        $kit = $value['kit'] == 1 ? "Entregue" : "Não entregue";
                                        echo '<td>' . $kit . '</td>';                                        
                                        echo '<td><a href="convocar_lojas_editar.php?id=' . $value['id_evento'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-success">Editar Convocação <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></td>';
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