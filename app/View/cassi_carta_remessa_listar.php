<div id="refresca_cassi_carta_remessa">
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
                    <h2 class="text-center"><strong>Listar </strong>Cartas Remessa CASSI</h2>
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
                                        <th>PEG</th>
                                        <th>Guias Anexas</th>
                                        <th>Data Envio</th>
                                        <th>Valor Total</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>PEG</th>
                                        <th>Guias Anexas</th>
                                        <th>Data Envio</th>
                                        <th>Valor Total</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    include '../../class/ayuadame.php';
                                    $soma = 0;
                                    $pdo = Database::connect();
                                    $sql = "select id,peg,guias_anexas,data_envio, valor_total,status from cassi_carta_remessa order by data_envio asc";
                                    foreach ($pdo->query($sql) as $value) {
                                        echo '<tr>';
                                        echo '<td>' . $value['peg'] . '</td>';
                                        echo '<td>' . $value['guias_anexas'] . '</td>';
                                        echo '<td>' . transformaEmDataBrasileira($value['data_envio']) . '</td>';
                                        echo '<td>R$ ' . transformaEmReal($value['valor_total']) . '</td>';
                                        $situation = $value['status'] == 1 ? "Ativo" : "Inativo";
                                        echo '<td>' . $situation . '</td>';
                                        $soma = bcadd($soma, $value['valor_total']);
                                        echo '<td><a href="cassi_carta_remessa_editar.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default">Editar <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
                                        echo '</tr>';
                                    }
                                    Database::disconnect();
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="widget-footer">
                        <div class="widget-content">
                            <div class="input-group">
                                <label>Valor Total: </label>
                                <span class="input-group-addon">R$</span>
                                <input type="text" readonly="readonly" value="<?php echo transformaEmReal($soma) ?>">
                            </div>
                        </div>
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