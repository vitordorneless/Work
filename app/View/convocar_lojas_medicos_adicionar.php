<div id="refresca_medico_listar">
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
                    <h2><strong>Listar </strong>Médicos</h2>
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
                                        <th>Situação</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Convocação</th>
                                        <th>Loja</th>
                                        <th>Turnos</th>                                        
                                        <th>Kit entregue?</th>                                        
                                        <th>Situação</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    $pdo = Database::connect();
                                    $sql = "select convoquim.nome_convocacao as convocacao,  lojinha.desc_estabelecimento as loja,
                                            eventche.turnos as turnos, eventche.kit_entregue as kit, eventche.status as situacao,
                                            eventche.id as id_evento
                                            from evento_convocacao eventche
                                            inner join convocacao convoquim on convoquim.id = eventche.id_convocacao
                                            inner join wal_estabelecimento_2016 lojinha on lojinha.cod_estabelecimento = eventche.loja
                                            where eventche.status = 1 and  eventche.periodo in ('2016')
                                            order by convoquim.nome_convocacao";
                                    foreach ($pdo->query($sql) as $value) {
                                        echo '<tr>';
                                        echo '<td>' . $value['convocacao'] . '</td>';                                        
                                        echo '<td>' . $value['loja'] . '</td>';
                                        echo '<td>' . $value['turnos'] . '</td>';
                                        $kit = $value['kit'] == 1 ? "Entregue" : "Não entregue";
                                        echo '<td>' . $kit . '</td>';                                        
                                        $situation = $value['situacao'] == 1 ? "Ativo" : "Inativo";
                                        echo '<td>' . $situation . '</td>';
                                        echo '<td><a href="inserir_medicos_evento.php?id=' . $value['id_evento'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-danger">Incluir Médico <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></td>';
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