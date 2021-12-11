<?php
include '../config/database_mysql.php';
$loja = filter_input(INPUT_GET, 'loja', FILTER_SANITIZE_NUMBER_INT);
$depto = filter_input(INPUT_GET, 'depto', FILTER_SANITIZE_NUMBER_INT);
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<style type="text/css" class="init"></style>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {
        $('#setores').DataTable();

        $("#setores a").on('click', function () {
            var id = this.id;
            $("#conteudo_superior").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
            $("#conteudo_superior").load(id);
        });
    });
</script>
<div>    
    <h4 class="text-center">Cargos e Funções</h4>
</div>			
<div>        
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Setores</h2>
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
                            <table id="setores" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>            
                                        <th><small>Código Cargo</small></th>
                                        <th><small>Nome Cargo</small></th>
                                        <th><small>Ação</small></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th><small>Código Cargo</small></th>
                                        <th><small>Nome Cargo</small></th>
                                        <th><small>Ação</small></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $pdo = Database::connect();
                                    $sql = "select distinct funfun.cod_cargo as cod_cargo, carcar.desc_cargo as nome_cargo
                                            from wal_funcionarios funfun
                                            inner join wal_cargo carcar on carcar.cod_cargo = funfun.cod_cargo
                                            where funfun.cod_estabelecimento = $loja and funfun.cod_depto = $depto
                                            order by carcar.desc_cargo";
                                    foreach ($pdo->query($sql) as $value) {
                                        echo '<tr>';
                                        echo '<td><small>' . $value['cod_cargo'] . '</small></td>';
                                        echo '<td><small>' . $value['nome_cargo'] . '</small></td>';
                                        echo '<td><a href="#" id="definir_riscos_adicionar.php?loja=' . $loja . '&cod_cargo=' . $value['cod_cargo'] . '&depto=' . $depto . '" class="btn btn-default">Definir Riscos <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span></a></td>';
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
<div class="footer">
    <div id="conteudo_setores"></div>
</div>