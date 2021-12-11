<link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
<style type="text/css" class="init"></style>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {
        $('#funcionarios').DataTable();
    });
</script>
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Listar todos </strong> Funcionários Walmart</h2>
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
                        <table id="funcionarios" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Matrícula</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Cargo</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Matrícula</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Cargo</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                include '../config/database_mysql.php';
                                $pdo = Database::connect();
                                $sql = "SELECT funcionarios.matricula AS 'matricula', funcionarios.nome_funcionario AS 'nome', 
                                        funcionarios.cpf AS 'cpf', funcionarios.cod_cargo as 'cargo', funcionarios.id as 'id' 
                                        FROM wal_funcionarios funcionarios  
                                        WHERE funcionarios.cod_empresa > 0 
                                        ORDER BY funcionarios.cod_empresa";
                                foreach ($pdo->query($sql) as $value) {

                                    $sql_cargo = "SELECT desc_cargo FROM wal_cargo WHERE cod_cargo = ?";
                                    $qsql_cargo = $pdo->prepare($sql_cargo);
                                    $qsql_cargo->execute(array($value['cargo']));
                                    $cargo_consult = $qsql_cargo->fetch(PDO::FETCH_ASSOC);

                                    echo '<tr>';
                                    echo '<td>' . $value['matricula'] . '</td>';
                                    echo '<td>' . $value['nome'] . '</td>';
                                    echo '<td>' . $value['cpf'] . '</td>';
                                    echo '<td>' . utf8_encode($cargo_consult['desc_cargo']) . '</td>';
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
