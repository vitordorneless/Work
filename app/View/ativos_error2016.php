<div id="refresca_error">
    <script src="../js/JQuery/jquery-1.11.1.min.js"></script>
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
                    <h2><strong>Listar </strong>Ativos com Erros</h2>                    
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
                                        <th>Empresa</th>                                        
                                        <th>Loja</th>
                                        <th>Nome Ativo</th>
                                        <th>CPF</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Empresa</th>                                        
                                        <th>Loja</th>
                                        <th>Nome Ativo</th>
                                        <th>CPF</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    include '../../class/ayuadame.php';
                                    $pdo = Database::connect();
                                    $sql = "select id, nome_funcionario, cod_empresa, cod_estabelecimento, cpf from wal_funcionarios where periodo in ('2016a') and erro in (1) order by cod_empresa, cod_estabelecimento, nome_funcionario asc";
                                    foreach ($pdo->query($sql) as $value) {

                                        $sql_unidade = 'select desc_empresa from wal_empresa_2016 where cod_empresa in (' . $value['cod_empresa'] . ')';
                                        $qq = $pdo->prepare($sql_unidade);
                                        $qq->execute();
                                        $data_unidade = $qq->fetch(PDO::FETCH_ASSOC);

                                        $sql_sit = 'select desc_estabelecimento from wal_estabelecimento_2016 where cod_empresa in (' . $value['cod_empresa'] . ') and cod_estabelecimento in (' . $value['cod_estabelecimento'] . ')';
                                        $qqq = $pdo->prepare($sql_sit);
                                        $qqq->execute();
                                        $data_sit = $qqq->fetch(PDO::FETCH_ASSOC);                                        

                                        echo '<tr>';
                                        echo '<td>' . $data_unidade['desc_empresa'] . '</td>';
                                        echo '<td>' . $data_sit['desc_estabelecimento'] . '</td>';
                                        echo '<td>' . $value['nome_funcionario'] . '</td>';
                                        echo '<td>' . $value['cpf'] . '</td>';
                                        echo '<td><a href="ativos_error_trat.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-info">Editar <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
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