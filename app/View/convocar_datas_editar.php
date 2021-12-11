<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>
<div id="refresca_convocar_datas">
    <div>
        <script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->    
        <script type="text/javascript" language="javascript" class="init">
            $(document).ready(function () {
                $("#abreabre a").on('click', function () {
                    var id = this.id;
                    $("#form_do_lance").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                    $("#form_do_lance").load(id);
                });
            });
        </script>
        <div class="row">
            <div class="col-md-12">
                <div class="widget">
                    <div class="widget-header">
                        <h2><strong>Listar </strong>Datas para Edição</h2>
                        <div class="additional-btn">                        
                            <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                        </div>
                    </div>
                    <div class="widget-content" id="form_do_lance"></div>
                    <div class="widget-content">
                        <br>
                        <div class="table-responsive table-bordered">
                            <form class='form-horizontal' role='form'>
                                <table class="display" id="abreabre" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="text-error">
                                            <th>Data</th>
                                            <th>Inicio</th>
                                            <th>Fim</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Data</th>
                                            <th>Inicio</th>
                                            <th>Fim</th>
                                            <th>Ação</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        include '../config/database_mysql.php';
                                        $pdo = Database::connect();
                                        $sql = "select id, id_evento_convocacao, DATE_FORMAT(data_evento, '%d/%c/%Y') as data_evento, horario, horario_final from datas_eventos_convocacao where id_evento_convocacao = $id";
                                        foreach ($pdo->query($sql) as $value) {
                                            echo '<tr>';
                                            echo '<td>' . $value['data_evento'] . '</td>';
                                            echo '<td>' . $value['horario'] . '</td>';
                                            echo '<td>' . $value['horario_final'] . '</td>';
                                            echo '<td><a href="#" id="convocar_datas_editar_line.php?id=' . $value['id'] . '" class="btn btn-small btn-danger">Editar Datas <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></td>';
                                            echo '</tr>';
                                        }
                                        Database::disconnect();
                                        ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>