<?php
session_start();
if ($_SESSION["user"] == NULL) {
    session_destroy();
    header("Location:../../index.php");
}
?>
<div>
    <style type="text/css">
        #imgpos {
            position:absolute;
            left:667px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
    <style type="text/css" class="init"></style>
    <script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            $('#examess').DataTable();
        });
    </script>
    <div class="container">
        <h4><acronym title="Listar Chamados Cadastrados!!!"><strong>Chamados por Funcionários Grupo AMA</strong></acronym></h4>
        <div class="modal-body well">
            <table id="examess" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Funcionário</th>
                        <th>Em Execução</th>
                        <th>Improcedente</th>
                        <th>Concluído</th>                        
                    </tr>
                </thead>
                <tfoot>
                <th>Funcionário</th>
                <th>Em Execução</th>
                <th>Improcedente</th>
                <th>Concluído</th>
                </tfoot>
                <tbody>
                    <?php
                    include '../config/database_mysql.php';
                    require '../Model/Chamado.php';
                    require '../Model/Chamados_Analise.php';
                    require '../Model/Chamados_Encerrar.php';
                    require '../Model/Chamados_Improcedentes.php';
                    $chamado = new Chamados_Analise();
                    $chamados_encerrados = new Chamados_Encerrar();
                    $improcedentes = new Chamados_Improcedentes();
                    
                    $pdo = Database::connect();
                    $sql = 'select id, nome_extenso from usuarios where setor = 2 and status = 1 order by nome_extenso';
                    foreach ($pdo->query($sql) as $value) {
                        $identity = $value['id'];
                        $em_execucao = $chamado->Chamados_em_Execucao_Usuario($identity);
                        $encerrados = $chamados_encerrados->Chamado_Encerrar_por_Usuario($identity);
                        $improcedentes_chamados = $improcedentes->Chamado_Improcedentes_por_Usuario($identity);
                        echo '<tr>';
                        echo '<td class="text-center"><strong>' . $value['nome_extenso'] . '</strong></td>';
                        echo '<td><small>' . $em_execucao . '</small></td>';
                        echo '<td><small>' . $improcedentes_chamados . '</small></td>';
                        echo '<td><small>' . $encerrados . '</small></td>';                        
                        echo '</tr>';
                    }
                    Database::disconnect();
                    ?>
                </tbody>
            </table>
        </div>    
    </div>
</div>