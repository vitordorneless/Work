<?php
include '../config/database_mysql.php';
$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
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
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Listar </strong>Ativos com Erro</h2>
                <div class="additional-btn">
                    <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                    <input type="hidden" id="id_medico" name="id_medico" value="<?php echo $search; ?>">
                </div>
            </div>
            <div class="widget-content">
                <br>
                <div class="table-responsive">
                    <form class='form-horizontal' role='form'>
                        <table id="funcionarios" class="table table-responsive tab-boxed table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>            
                                    <th class="text-center"></th>
                                    <th class="text-center"><small>Empresa</small></th>
                                    <th class="text-center"><small>Loja</small></th>
                                    <th class="text-center"><small>Ativo</small></th>
                                    <th class="text-center"><small>Status</small></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center"><small>Empresa</small></th>
                                    <th class="text-center"><small>Loja</small></th>
                                    <th class="text-center"><small>Ativo</small></th>
                                    <th class="text-center"><small>Status</small></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $pdo = Database::connect();
                                $sql = 'select id, cod_empresa, cod_estabelecimento, nome_funcionario, erro from wal_funcionarios where id_medico in (' . $search . ') and erro in (1) order by cod_empresa, cod_estabelecimento, nome_funcionario asc';
                                foreach ($pdo->query($sql) as $value) {
                                    $sql1 = 'select cod_empresa, desc_empresa from wal_empresa where cod_empresa = ' . $value['cod_empresa'];
                                    $q1 = $pdo->prepare($sql1);
                                    $q1->execute();
                                    $data1 = $q1->fetch(PDO::FETCH_ASSOC);

                                    $sql2 = 'select cod_estabelecimento, desc_estabelecimento from wal_estabelecimento where cod_empresa = ' . $value['cod_empresa'] . ' and cod_estabelecimento = ' . $value['cod_estabelecimento'];
                                    $q2 = $pdo->prepare($sql2);
                                    $q2->execute();
                                    $data2 = $q2->fetch(PDO::FETCH_ASSOC);
                                    $erro = $value['erro'] == 0 ? 'Não informado' : 'Com Erro';
                                    echo '<tr>';
                                    echo '<td><small><input type="checkbox" value="' . $value['id'] . '" name="matricula"></small></td>';
                                    echo '<td><small>' . $data1['desc_empresa'] . '</small></td>';
                                    echo '<td><small>' . $data2['desc_estabelecimento'] . '</small></td>';
                                    echo '<td><small>' . $value['nome_funcionario'] . '</small></td>';
                                    echo '<td><small>' . $erro . '</small></td>';
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