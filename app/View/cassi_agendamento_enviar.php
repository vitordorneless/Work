<div id="refresca_cassi_enviar">
    <script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
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
                    <h2><strong>Listar </strong>Agendamentos CASSI</h2>
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
                                        <th>Agência</th>
                                        <th>Data</th>
                                        <th>Horário</th>
                                        <th>Médico</th>
                                        <th>Valor da Consulta</th>
                                        <th>Email Enviado?</th>
                                        <th>Situação</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Agência</th>
                                        <th>Data</th>
                                        <th>Horário</th>
                                        <th>Médico</th>
                                        <th>Valor da Consulta</th>
                                        <th>Email Enviado?</th>
                                        <th>Situação</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    include '../../class/ayuadame.php';
                                    require '../Model/Cassi.php';
                                    require '../Model/Cassi_Marca_Email.php';
                                    $cassi = new Cassi_Marca_Email();
                                    $pdo = Database::connect();
                                    $sql = "select agegen.id as id, agegen.municipio as municipio, agegen.data_agendamento as dia, agegen.horario as hora, 
                                            cu.nome as medico, agegen.valor_consulta as quanto, agegen.status as status, agencia.dependencia as dependencia 
                                            from cassi_agendamento agegen
                                            inner join wal_medico cu on cu.id_medico = agegen.id_medico
                                            inner join cassi_agencia agencia on agencia.id = agegen.municipio 
                                            where agegen.status = 1 
                                            order by agegen.data_agendamento";
                                    foreach ($pdo->query($sql) as $value) {
                                        $sql1 = "select id_agendamento, email_enviado from cassi_email_agendamento where id_agendamento = ".$value['id'];
                                        $q1 = $pdo->prepare($sql1);
                                        $q1->execute();
                                        $data = $q1->fetch(PDO::FETCH_ASSOC);                                        
                                        echo '<tr>';
                                        echo '<td>' . utf8_encode($value['dependencia']) . '</td>';
                                        echo '<td>' . transformaEmDataBrasileira($value['dia']) . '</td>';
                                        echo '<td>' . $value['hora'] . '</td>';
                                        echo '<td>' . $value['medico'] . '</td>';
                                        echo '<td>R$ ' . $value['quanto'] . '</td>';
                                        $situation = $value['status'] == 1 ? "Ativo" : "Inativo";
                                        $email = $data['email_enviado'] == 1 ? "Sim, foi!!" : "Ainda Não!!";
                                        echo '<td class="text-danger"><strong>' . $email . '</strong></td>';
                                        echo '<td>' . $situation . '</td>';
                                        echo '<td><a href="cassi_enviar_email_agendamento.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-dropbox">Enviar Email <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
                                        echo '</tr>';
                                    }
                                    Database::disconnect();
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal large" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>