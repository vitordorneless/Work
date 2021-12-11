<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>
<div>
    <script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->    
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Datas</h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                        <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                    </div>
                </div>
                <div class="widget-content">
                    <br>
                    <div class="table-responsive table-bordered">
                        <form class='form-horizontal' role='form'>
                            <table class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr class="text-error">
                                        <th>Data</th>
                                        <th>Inicio</th>
                                        <th>Fim</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Data</th>
                                        <th>Inicio</th>
                                        <th>Fim</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    $pdo = Database::connect();
                                    $sql = "select DATE_FORMAT(data_evento, '%d/%c/%Y') as data_evento, horario, horario_final from datas_eventos_convocacao where id_evento_convocacao = $id";
                                    foreach ($pdo->query($sql) as $value) {
                                        echo '<tr>';
                                        echo '<td>' . $value['data_evento'] . '</td>';
                                        echo '<td>' . $value['horario'] . '</td>';
                                        echo '<td>' . $value['horario_final'] . '</td>';
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