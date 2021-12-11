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
                <h2><strong>Listar </strong>Associados CASSI</h2>
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
                                    <th class="text-center"><small>Matrícula</small></th>
                                    <th class="text-center"><small>Nome do Associado</small></th>
                                    <th class="text-center"><small>Agência</small></th>
                                    <th class="text-center"><small>Municipio</small></th>
                                    <th class="text-center"><small>Nascimento</small></th>
                                    <th class="text-center"><small>Status</small></th>
                                    <th class="text-center"><small>Obs</small></th>                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center"><small>Matrícula</small></th>
                                    <th class="text-center"><small>Nome do Associado</small></th>
                                    <th class="text-center"><small>Agência</small></th>
                                    <th class="text-center"><small>Municipio</small></th>
                                    <th class="text-center"><small>Nascimento</small></th>
                                    <th class="text-center"><small>Status</small></th>
                                    <th class="text-center"><small>Obs</small></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $pdo = Database::connect();
                                $sql = 'select matricula, prefixo_agencia, nome_ativo, data_nascimento, obs, id_cassi_situacao from cassi_ativos where nome_ativo like "%' . $search . '%" order by nome_ativo asc';
                                foreach ($pdo->query($sql) as $value) {
                                    $sql1 = 'select dependencia, municipio from cassi_agencia where prefixo = ' . $value['prefixo_agencia'];
                                    $q1 = $pdo->prepare($sql1);
                                    $q1->execute();
                                    $data1 = $q1->fetch(PDO::FETCH_ASSOC);
                                    
                                    $sql2 = 'select desc_situacao from cassi_situacao where id = ' . $value['id_cassi_situacao'];
                                    $q2 = $pdo->prepare($sql2);
                                    $q2->execute();
                                    $data2 = $q2->fetch(PDO::FETCH_ASSOC);
                                    $id_status = $data2['desc_situacao'] == NULL ? 'Não informado':$data2['desc_situacao'];
                                    echo '<tr>';
                                    echo '<td><small>' . $value['matricula'] . '</small></td>';
                                    echo '<td><small>' . $value['nome_ativo'] . '</small></td>';
                                    echo '<td><small>' . $data1['dependencia'] . '</small></td>';
                                    echo '<td><small>' . $data1['municipio'] . '</small></td>';
                                    echo '<td><small>' . $value['data_nascimento'] . '</small></td>';
                                    echo '<td><small>' . $id_status .'</small></td>';
                                    echo '<td><small>' . $value['obs'] . '</small></td>';
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