<?php
include '../config/database_mysql.php';
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
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
                <h2><strong>Listar </strong>Associados Walmart</h2>
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
                                    <th class="text-center"><small>Empresa</small></th>
                                    <th class="text-center"><small>Unidade</small></th>
                                    <th class="text-center"><small>Nome</small></th>
                                    <th class="text-center"><small>CPF</small></th>
                                    <th class="text-center"><small>Departamento</small></th>
                                    <th class="text-center"><small>Cargo</small></th>                                    
                                    <th class="text-center"><small>Ação</small></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center"><small>Empresa</small></th>
                                    <th class="text-center"><small>Unidade</small></th>
                                    <th class="text-center"><small>Nome</small></th>
                                    <th class="text-center"><small>CPF</small></th>
                                    <th class="text-center"><small>Departamento</small></th>
                                    <th class="text-center"><small>Cargo</small></th>                                    
                                    <th class="text-center"><small>Ação</small></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $pdo = Database::connect();
                                $sql = 'select cod_empresa, id, cod_estabelecimento, nome_funcionario, cpf, cod_depto, cod_cargo from wal_funcionarios  where flg_periodico in (0,1) and nome_funcionario like "%' . $nome . '%" order by cod_empresa, cod_estabelecimento, nome_funcionario asc';
                                foreach ($pdo->query($sql) as $value) {
                                    $sql1 = 'select desc_estabelecimento from wal_estabelecimento where cod_estabelecimento = ' . $value['cod_estabelecimento'];
                                    $q1 = $pdo->prepare($sql1);
                                    $q1->execute();
                                    $data1 = $q1->fetch(PDO::FETCH_ASSOC);
                                    
                                    $sql2 = 'select desc_empresa from wal_empresa where cod_empresa = ' . $value['cod_empresa'];
                                    $q2 = $pdo->prepare($sql2);
                                    $q2->execute();
                                    $data2 = $q2->fetch(PDO::FETCH_ASSOC);
                                    
                                    $sql3 = 'select desc_depto from wal_departamento where cod_depto = ' . $value['cod_depto'];
                                    $q3 = $pdo->prepare($sql3);
                                    $q3->execute();
                                    $data3 = $q3->fetch(PDO::FETCH_ASSOC);
                                    
                                    $sql4 = 'select desc_cargo from wal_cargo where cod_cargo = ' . $value['cod_cargo'];
                                    $q4 = $pdo->prepare($sql4);
                                    $q4->execute();
                                    $data4 = $q4->fetch(PDO::FETCH_ASSOC);
                                    
                                    echo '<tr>';
                                    echo '<td><small>' . $data2['desc_empresa'] . '</small></td>';
                                    echo '<td><small>' . $data1['desc_estabelecimento'] . '</small></td>';
                                    echo '<td><small>' . $value['nome_funcionario'] . '</small></td>';
                                    echo '<td><small>' . $value['cpf'] . '</small></td>';
                                    echo '<td><small>' . $data3['desc_depto'] . '</small></td>';
                                    echo '<td><small>' . $data4['desc_cargo'] . '</small></td>';                                    
                                    echo '<td><a href="#" id="../Controller/troca_setor_wal_editar.php?id=' . $value['id'] . '" class="btn btn-default btn-danger">Editar <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
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