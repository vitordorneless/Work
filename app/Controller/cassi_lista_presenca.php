<?php
include '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' no foi encontrado!');
}
$medicos = new Medicos();
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
$agencia = filter_input(INPUT_POST, 'agencia', FILTER_SANITIZE_STRING);
$array_id_medico = $medicos->Dados_Medicos_CPF($cpf);
$id_medico = $array_id_medico['id_medico'];
?>
<div id="refresca_cassi_doctor">
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {

            $("#funcionarios a").on('click', function () {
                var id = this.id;
                $("#conteudo_superior").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                $("#conteudo_superior").load(id);
            });
        });
    </script>
    <link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
    <style type="text/css" class="init"></style>
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Funcionários da Agência: <?php echo $agencia; ?></h2>
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
                                        <th>Funcionário</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>            
                                        <th>Funcionário</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $pdo = Database::connect();
                                    $sql = "select id, nome_ativo, id_cassi_situacao from cassi_ativos where prefixo_agencia = $agencia order by nome_ativo asc";
                                    foreach ($pdo->query($sql) as $value) {
                                        echo '<tr>';
                                        echo '<td>' . $value['nome_ativo'] . '</td>';
                                        if (($value['id_cassi_situacao'] == 1) or ($value['id_cassi_situacao'] == 2)) {
                                            $situacao = "Não Atendido";
                                        } else {
                                            $situacao = "Atendido";
                                        }
                                        echo '<td>' . $situacao . '</td>';
                                        echo '<td><a href="#" id="../Controller/lista_presenca_funcionario_CASSI.php?id=' . $value['id'] . '&id_medico=' . $id_medico . '&agencia=' . $agencia . '" class="btn btn-default group-sm btn-dropbox">Definir Status deste Ativo <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
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