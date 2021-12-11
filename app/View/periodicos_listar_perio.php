<div id="refresca_cassi_exames_editar">
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
                    <h2><strong>Listar </strong>Ativos que fizeram Periódico<br>Marcados pelo Médico</h2>
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
                                        <th>#</th>
                                        <th>Matricula</th>
                                        <th>Nome do Funcionário</th>
                                        <th>Admissão</th>
                                        <th>CPF</th>
                                        <th>Identidade</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Matricula</th>
                                        <th>Nome do Funcionário</th>
                                        <th>Admissão</th>
                                        <th>CPF</th>
                                        <th>Identidade</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    include '../../class/ayuadame.php';
                                    $pdo = Database::connect();
                                    $cont = 1;
                                    $sql = "select matricula, nome_funcionario, admissao, cpf, identidade from wal_funcionarios where flg_periodico = 1";
                                    foreach ($pdo->query($sql) as $value) {

                                        echo '<tr>';
                                        echo '<td>' . $cont . '</td>';
                                        echo '<td>' . utf8_encode($value['matricula']) . '</td>';
                                        echo '<td>' . $value['nome_funcionario'] . '</td>';
                                        echo '<td>' . $value['admissao'] . '</td>';
                                        echo '<td>' . $value['cpf'] . '</td>';
                                        echo '<td>R$ ' . $value['identidade'] . '</td>';
                                        echo '</tr>';
                                        ++$cont;
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