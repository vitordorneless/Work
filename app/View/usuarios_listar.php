<div id="refresca_usuarios_AMA">
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
    <script src="../../css/bootstrap/lightbox/dist/ekko-lightbox.js"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Usuários</h2>
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
                                        <th><small>Nome</small></th>                                        
                                        <th><small>CRM</small></th>                                        
                                        <th><small>Setor</small></th>
                                        <th><small>Email</small></th>
                                        <th><small>Status</small></th>
                                        <th><small>Administrador</small></th>
                                        <th><small>Ação</small></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th><small>Nome</small></th>                                        
                                        <th><small>CRM</small></th>                                        
                                        <th><small>Setor</small></th>
                                        <th><small>Email</small></th>
                                        <th><small>Status</small></th>
                                        <th><small>Administrador</small></th>
                                        <th><small>Ação</small></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    $pdo = Database::connect();
                                    $sql = "select users.id as id, users.nome_extenso as nome_extenso, users.email as email, users.crm as crm,
                                            sections_users.setor as setor, users.status as status, users.admin as admin 
                                            from usuarios users
                                            inner join usuarios_setores sections_users on sections_users.id = users.setor
                                            where users.status = 1
                                            order by sections_users.setor asc";
                                    foreach ($pdo->query($sql) as $value) {
                                        echo '<tr>';
                                        echo '<td><small>' . $value['nome_extenso'] . '</small></td>';
                                        echo '<td><small>' . $value['crm'] . '</small></td>';
                                        echo '<td><small>' . $value['setor'] . '</small></td>';
                                        echo '<td><small>' . $value['email'] . '</small></td>';
                                        $situation = $value['status'] == 1 ? "Ativo" : "Inativo";
                                        echo '<td><small>' . $situation . '</small></td>';
                                        $admin = $value['admin'] == 1 ? "Administrador" : "Usuário Comum";
                                        echo '<td><small>' . $admin . '</small></td>';
                                        echo '<td><a href="usuarios_editar.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-success">Editar Usuário <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></td>';
                                        echo '</tr>';
                                    }
                                    Database::disconnect();
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog"><div class="modal-content"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>