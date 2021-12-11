<?php
include '../config/database_mysql.php';
$empresa = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_NUMBER_INT);
$estabelecimento = filter_input(INPUT_POST, 'estabelecimento', FILTER_SANITIZE_NUMBER_INT);
?>
<link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
<style type="text/css" class="init"></style>
<!--<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>-->
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {                
        $("#funcionarios a").on('click', function(){
        var id = this.id;
        $("#conteudo_lateral").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#conteudo_lateral").load(id);
        });
    });
</script>
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Listar </strong>Departamentos</h2>
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
                        <table id="funcionarios" class="table table-responsive tab-boxed table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>            
                                    <th>Código Departamento</th>
                                    <th>Departamento</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Código Departamento</th>
                                    <th>Departamento</th>
                                    <th>Ação</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $pdo = Database::connect();
                                $sql = "select distinct funfun.cod_depto as departamento, depdep.desc_depto as nome
                                            from wal_funcionarios funfun
                                            inner join wal_departamento depdep on depdep.cod_depto = funfun.cod_depto
                                            where funfun.cod_empresa = $empresa and funfun.cod_estabelecimento = $estabelecimento 
                                            and funfun.exame = 0 and funfun.risco = 0 
                                            order by depdep.desc_depto";
                                foreach ($pdo->query($sql) as $value) {
                                    echo '<tr>';
                                    echo '<td>' . $value['departamento'] . '</td>';
                                    echo '<td>' . $value['nome'] . '</td>';                                    
                                    echo '<td><a href="#" id="listar_setores.php?loja=' . $estabelecimento . '&depto=' . $value['departamento'] . '" class="btn btn-default btn-facebook">Ver Cargos <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span></a></td>';
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