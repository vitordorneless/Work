<?php
include '../config/database_mysql.php';
$search = filter_input(INPUT_POST, 'id_unidade', FILTER_SANITIZE_NUMBER_INT);
?>
<link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
<style type="text/css" class="init"></style>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {
        $("#funcionarios a").on('click', function () {
            var id = this.id;
            $("#conteudo_superior").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
            $("#conteudo_superior").load(id);
        });
    });
</script>
<div class="row" id="refresca_loja">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Listar </strong>Unidades</h2>
                <div class="additional-btn">                    
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>                    
                </div>
            </div>
            <div class="widget-content padding">
                <br>
                <div class="table-responsive">
                    <form class='form-horizontal' role='form'>
                        <table id="funcionarios" class="table table-responsive tab-boxed table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>            
                                    <th class="text-center"><small>Setor</small></th>
                                    <th class="text-center"><small>Função</small></th>
                                    <th class="text-center"><small>DB</small></th>
                                    <th class="text-center"><small>Lux</small></th>
                                    <th class="text-center"><small>Status</small></th>
                                    <th class="text-center"><small>Ação</small></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center"><small>Setor</small></th>
                                    <th class="text-center"><small>Função</small></th>
                                    <th class="text-center"><small>DB</small></th>
                                    <th class="text-center"><small>Lux</small></th>
                                    <th class="text-center"><small>Status</small></th>
                                    <th class="text-center"><small>Ação</small></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $pdo = Database::connect();
                                $sql = 'select id, setor, id_funcao, db, lux, status from tst_checklist_medicoes where id_loja in (' . $search . ') order by setor asc ';
                                foreach ($pdo->query($sql) as $value) {
                                    $id_status = $value['status'] == 1 ? 'Ativo' : 'Inativo';
                                    $sql_cargo = 'select nome_funcao from tst_checklist_funcao where id = ' . $value['id_funcao'];
                                    $qq = $pdo->prepare($sql_cargo);
                                    $qq->execute();
                                    $data = $qq->fetch(PDO::FETCH_ASSOC);
                                    echo '<tr>';
                                    echo '<td class="text-center"><small>' . $value['setor'] . '</small></td>';
                                    echo '<td class="text-center"><small>' . $data['nome_funcao'] . '</small></td>';                                    
                                    echo '<td class="text-center"><small>' . $value['db'] . '</small></td>';
                                    echo '<td class="text-center"><small>' . $value['lux'] . '</small></td>';
                                    echo '<td class="text-center"><small>' . $id_status . '</small></td>';
                                    echo '<td><a href="#" id="../Controller/tst_lojas_medicoes_editar.php?id=' . $value['id'] . '" class="btn btn-default btn-danger">Editar <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
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