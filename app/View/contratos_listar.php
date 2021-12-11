<div id="refresca_tst_tipo_agendamento">
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
                    <h2><strong>Listar </strong>Contratos</h2>                    
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
                                        <th>Nome</th>                                        
                                        <th>CNPJ</th>
                                        <th>Endereço</th>                                        
                                        <th>Cadastro</th>
                                        <th>Vigência</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nome</th>                                        
                                        <th>CNPJ</th>
                                        <th>Endereço</th>                                        
                                        <th>Cadastro</th>
                                        <th>Vigência</th>
                                        <th>Valor</th>
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
                                    foreach ($pdo->query($querie->listar_contrato_prestador()) as $value) {
                                        echo '<tr>';
                                        echo '<td>' . $value['nome'] . '</td>';
                                        echo '<td>' . $value['cnpj'] . '</td>';
                                        echo '<td>' . $value['rua'] . '</td>';
                                        echo '<td>' . $value['data_cadastro'] . '</td>';
                                        echo '<td>' . $value['vigencia_start'] . '</td>';
                                        echo '<td>' . $value['valor'] . '</td>';
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