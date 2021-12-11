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
                <h2><strong>Listar </strong>Associados Walmart para Edição</h2>
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
                                    <th class="text-center"><small>Nome do Associado</small></th>
                                    <th class="text-center"><small>Loja</small></th>
                                    <th class="text-center"><small>Setor</small></th>
                                    <th class="text-center"><small>Cargo</small></th>
                                    <th class="text-center"><small>Risco p/ Altura?</small></th>
                                    <th class="text-center"><small>Constar no ASO APTO Altura?</small></th>
                                    <th class="text-center"><small>Ação</small></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center"><small>Nome do Associado</small></th>
                                    <th class="text-center"><small>Loja</small></th>
                                    <th class="text-center"><small>Setor</small></th>
                                    <th class="text-center"><small>Cargo</small></th>
                                    <th class="text-center"><small>Risco p/ Altura?</small></th>
                                    <th class="text-center"><small>Constar no ASO APTO Altura?</small></th>
                                    <th class="text-center"><small>Ação</small></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $pdo = Database::connect();
                                $sql = 'select id,nome_funcionario, cod_estabelecimento,cod_depto, cod_cargo from wal_funcionarios where nome_funcionario like "%' . $search . '%" order by nome_funcionario asc';
                                foreach ($pdo->query($sql) as $value) {
                                    $sql1 = 'select desc_cargo from wal_cargo where cod_cargo = ' . $value['cod_cargo'];
                                    $q1 = $pdo->prepare($sql1);
                                    $q1->execute();
                                    $data1 = $q1->fetch(PDO::FETCH_ASSOC);

                                    $sql2 = 'select desc_depto from wal_departamento where cod_depto = ' . $value['cod_depto'];
                                    $q2 = $pdo->prepare($sql2);
                                    $q2->execute();
                                    $data2 = $q2->fetch(PDO::FETCH_ASSOC);

                                    $sql3 = 'select desc_estabelecimento from wal_estabelecimento where cod_estabelecimento = ' . $value['cod_estabelecimento'];
                                    $q3 = $pdo->prepare($sql3);
                                    $q3->execute();
                                    $data3 = $q3->fetch(PDO::FETCH_ASSOC);

                                    $sql4 = 'select count(id) as temos from wal_funcionarios_exames where (ativo = 1 or ativo = 0) and id_exame = 21 and id_funcionario = ' . $value['id'];
                                    $q4 = $pdo->prepare($sql4);
                                    $q4->execute();
                                    $data4 = $q4->fetch(PDO::FETCH_ASSOC);
                                    $apto = $data4['temos'] > 0 ? "Sim" : "Não";

                                    $sql5 = 'select count(id) as temos from wal_apto_trab_altura where (status = 1 or status = 0) and id_funcionario = ' . $value['id'];
                                    $q5 = $pdo->prepare($sql5);
                                    $q5->execute();
                                    $data5 = $q5->fetch(PDO::FETCH_ASSOC);
                                    $apto1 = $data5['temos'] > 0 ? "Sim" : "Não";

                                    echo '<tr>';
                                    echo '<td><small>' . utf8_encode($value['nome_funcionario']) . '</small></td>';
                                    echo '<td><small>' . utf8_encode($data3['desc_estabelecimento']) . '</small></td>';
                                    echo '<td><small>' . utf8_encode($data2['desc_depto']) . '</small></td>';
                                    echo '<td><small>' . utf8_encode($data1['desc_cargo']) . '</small></td>';
                                    echo '<td><small><strong>' . $apto . '</strong></small></td>';
                                    echo '<td><small><strong>' . $apto1 . '</strong></small></td>';
                                    if (($apto == "Sim") or ( $apto1 === "Sim")) {
                                        echo '<td><a href="#" id="edit_riscos.php?id=' . $value['id'] . '" class="btn btn-small btn-facebook">Edit Risco Individual <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span></a></td>';                                        
                                    } else {
                                        echo '<td><strong>Vá para a tela <br>Adicionar Risco por Associado!!</strong></td>';
                                    }
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