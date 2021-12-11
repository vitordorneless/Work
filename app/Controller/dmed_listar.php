<?php
include '../config/database_mysql.php';
$pdo = Database::connect();

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$querie = new Queries();
$ref = filter_input(INPUT_POST, 'ref', FILTER_SANITIZE_STRING);
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
<style type="text/css" class="init"></style>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {
        $('#funcionarios').DataTable();
        $("#funcionarios a").on('click', function(){
        var id = this.id;
        $("#conteudo_superior").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#conteudo_superior").load(id);
        });
    });
</script>
<div class="row">        
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2 class="text-center"><strong>DMED </strong></h2>
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
                                    <th><small>Data DMED</small></th>
                                    <th><small>RPPSS</small></th>
                                    <th><small>RPPSS - CPF</small></th>
                                    <th><small>BRPPSS</small></th>
                                    <th><small>BRPPSS - CPF</small></th>
                                    <th><small>Nascimento</small></th>
                                    <th><small>Valor</small></th>
                                    <th><small>Recibo</small></th>
                                    <th><small>Unidade</small></th>
                                    <th><small>Ação</small></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th><small>Data DMED</small></th>                                        
                                    <th><small>RPPSS</small></th>
                                    <th><small>RPPSS - CPF</small></th>
                                    <th><small>BRPPSS</small></th>
                                    <th><small>BRPPSS - CPF</small></th>
                                    <th><small>Nascimento</small></th>
                                    <th><small>Valor</small></th>
                                    <th><small>Recibo</small></th>
                                    <th><small>Unidade</small></th>
                                    <th><small>Ação</small></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php                                
                                foreach ($pdo->query($querie->dmed_listar($ref)) as $value) {
                                    echo '<tr>';
                                    echo '<td><small>' . $value['data_dmed'] . '</small></td>';
                                    echo '<td><small>' . $value['RPPSS'] . '</small></td>';
                                    echo '<td><small>' . $value['cpf_RPPSS'] . '</small></td>';
                                    echo '<td><small>' . $value['BRPPSS'] . '</small></td>';
                                    echo '<td><small>' . $value['cpf_BRPPSS'] . '</small></td>';
                                    echo '<td><small>' . $value['dn'] . '</small></td>';
                                    echo '<td><small>' . $value['valor'] . '</small></td>';
                                    echo '<td><small>' . $value['recibo'] . '</small></td>';
                                    $unidade = $value['unidade'] == NULL ? "Não Informado" : $value['unidade'];
                                    echo '<td>' . $unidade . '</td>';                                    
                                    echo '<td><a href="#" id="dmed_editar.php?id=' . $value['id'] . '" class="btn btn-default btn-facebook">Editar  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
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