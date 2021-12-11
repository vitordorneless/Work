<div id="refresca_herval_solicitante">
    <script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
    <link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
    <style type="text/css" class="init"></style>
    <script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            $('#funcionarios').DataTable();
            $('#funcionarios2').DataTable();
        });
    </script>
    <div class="row">
        <div class="col-md-3">
            <a href="herval_sint_incluir.php" data-toggle="modal" data-target="#myModal1" class="btn btn-default btn-dropbox">Incluir Cabeçalho Síntese <span class="glyphicon glyphicon-save" aria-hidden="true"></span></a><br><br><br>
        </div>        
        <div class="col-md-3">
            <a href="herval_sint_incluir_template.php" data-toggle="modal" data-target="#myModal4" class="btn btn-default btn-dropbox">Incluir Template de Síntese <span class="glyphicon glyphicon-save" aria-hidden="true"></span></a><br><br><br>
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Sínteses Herval</h2>                    
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
                                        <th>Unidade</th>
                                        <th>CNPJ</th>
                                        <th>Status</th>                                        
                                        <th>Ação</th>
                                        <th>Visualizar</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Unidade</th>
                                        <th>CNPJ</th>                                        
                                        <th>Status</th>
                                        <th>Ação</th>
                                        <th>Visualizar</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    $pdo = Database::connect();
                                    $sql = "select id, id_unidade, cnpj, status from herval_sinteses_cab order by id_unidade asc";
                                    foreach ($pdo->query($sql) as $value) {

                                        $sql_cargo = 'select count(id) as temos, id from herval_sintese_conteudo where id_herval_sinteses_cab = '.$value['id'];
                                        $qq = $pdo->prepare($sql_cargo);
                                        $qq->execute();
                                        $data_cargo = $qq->fetch(PDO::FETCH_ASSOC);
                                        
                                        $sql_unidade = 'select unidade from herval_unidades where id = '.$value['id_unidade'];
                                        $qqq = $pdo->prepare($sql_unidade);
                                        $qqq->execute();
                                        $data_unidade = $qqq->fetch(PDO::FETCH_ASSOC);
                                        
                                        echo '<tr>';
                                        echo '<td>' . utf8_encode($data_unidade['unidade']) . '</td>';
                                        echo '<td>' . utf8_encode($value['cnpj']) . '</td>';
                                        $situation = $value['status'] == 1 ? "Ativo" : "Inativo";
                                        echo '<td>' . $situation . '</td>';
                                        if($data_cargo['temos'] < 1){
                                        echo '<td><a href="herval_sint_incluir_sint.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-dropbox">Incluir Síntese <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>'
                                                . '&nbsp;&nbsp;&nbsp;<a href="herval_sint_editar_sint.php?id=' . $data_cargo['id'] . '" data-toggle="modal" data-target="#myModal3" class="btn btn-default btn-danger">Editar Síntese <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
                                        }else{
                                            echo '<td><a href="herval_sint_incluir_sint.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-dropbox">Incluir Síntese <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
                                        }
                                        echo '<td><a href="herval_sint_visualizar.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal2" class="btn btn-default btn-danger">Visualizar <span class="glyphicon glyphicon-save" aria-hidden="true"></span></a></td>';
                                        echo '</tr>';
                                    }                                    
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
                    <div class="modal large" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                    <div class="modal large" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                    <div class="modal large" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                    <div class="modal large" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Templates Sínteses Herval</h2>                    
                    <div class="additional-btn">                        
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>                        
                    </div>                    
                </div>
                <div class="widget-content">                    
                    <br>
                    <div class="table-responsive">
                        <form class='form-horizontal' role='form'>
                            <table id="funcionarios2" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Unidade</th>
                                        <th>CNPJ</th>
                                        <th>Status</th>                                        
                                        <th>Visualizar</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Unidade</th>
                                        <th>CNPJ</th>                                        
                                        <th>Status</th>                                        
                                        <th>Visualizar</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php                                    
                                    $sql1 = "select id, id_unidade, cnpj, status from herval_sinteses_cab order by id_unidade asc";
                                    foreach ($pdo->query($sql1) as $value) {

                                        $sql_cargo = 'select count(id) as temos, id from herval_sintese_conteudo where id_herval_sinteses_cab = '.$value['id'];
                                        $qq = $pdo->prepare($sql_cargo);
                                        $qq->execute();
                                        $data_cargo = $qq->fetch(PDO::FETCH_ASSOC);
                                        
                                        $sql_unidade = 'select unidade from herval_unidades where id = '.$value['id_unidade'];
                                        $qqq = $pdo->prepare($sql_unidade);
                                        $qqq->execute();
                                        $data_unidade = $qqq->fetch(PDO::FETCH_ASSOC);
                                        
                                        echo '<tr>';
                                        echo '<td>' . utf8_encode($data_unidade['unidade']) . '</td>';
                                        echo '<td>' . utf8_encode($value['cnpj']) . '</td>';
                                        $situation = $value['status'] == 1 ? "Ativo" : "Inativo";
                                        echo '<td>' . $situation . '</td>';                                        
                                        echo '<td><a href="herval_sint_template_visualizar.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal2" class="btn btn-default btn-danger">Visualizar <span class="glyphicon glyphicon-save" aria-hidden="true"></span></a></td>';
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