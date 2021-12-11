<?php
include '../config/database_mysql.php';
include '../../class/ayuadame.php';
$pdo = Database::connect();
require '../Model/Herval.php';
require '../Model/Herval_Agendamento.php';
$herval = new Herval_Agendamento();
$herval->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_herval = $herval->Dados_Herval_agendamentos($herval->get_id());
?>
<link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
<style type="text/css" class="init"></style>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {
        $("#funcionarios a").on('click', function () {
            var id = this.id;
            $("#conteudom").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
            $("#conteudom").load(id);
        });

        $("#fechar_modal").click(function () {
            $("#refresca_herval").load('herval_agendamento_individual_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_herval").load('herval_agendamento_individual_listar.php');
            }
        });
    });
</script>
<div class="modal-header">
    <h2><strong>Marcar</strong> Agendamento Individual Herval</h2>
    <div class="additional-btn">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    </div>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <form class='form-horizontal' role='form'>
            <table id="funcionarios" class="table table-responsive tab-boxed table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nome</th>                                        
                        <th>Data Agendamento</th>                                        
                        <th>Ação</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nome</th>                                        
                        <th>Data Agendamento</th>                                        
                        <th>Ação</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $sql = "select id, nome, data_nascimento from herval_ativos where id_unidade = " . $array_herval['id_unidade'] . " order by nome asc";
                    foreach ($pdo->query($sql) as $value) {

                        $sql = 'select count(id) as temos, data from herval_agendamento_individual where id_ativo in (' . $value['id'] . ')';
                        $q = $pdo->prepare($sql);
                        $q->execute();
                        $data = $q->fetch(PDO::FETCH_ASSOC);
                        $temos = $data['temos'];

                        echo '<tr>';
                        echo '<td>' . $value['nome'] . '</td>';
                        echo '<td>' . transformaEmDataBrasileira($data['data'] == NULL ? $array_herval['data_agendamento'] : $data['data']) . '</td>';
                        if ($temos < 1) {
                            echo '<td><a href="#" id="herval_agendamento_ind_incluir.php?id=' . $value['id'] . '&id_unidade=' . $array_herval['id_unidade'] . '&id_convocacao=' . $array_herval['id'] . '" class="btn btn-default btn-danger">Incluir Data <span class="glyphicon glyphicon-save" aria-hidden="true"></span></a></td>';
                        } else {
                            echo '<td><a href="#" id="herval_agendamento_ind_editar.php?id=' . $value['id'] . '&id_unidade=' . $array_herval['id_unidade'] . '&id_convocacao=' . $array_herval['id'] . '" class="btn btn-default btn-info">Editar Data <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
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
<div class="modal-footer">
    <div id="conteudom"></div>
</div>