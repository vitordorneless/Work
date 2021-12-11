<div id="refresca_herval_tipo_agendamento">
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
                    <h2><strong>Relação </strong>Lojas Walmart - Realizado/Não Realizado</h2>                    
                    <div class="additional-btn">                        
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>                        
                    </div>                    
                </div>
                <div class="widget-content">
                    <br>
                    <div class="table-responsive">
                        <form class='form-horizontal' role='form'>
                            <table id="funcionarios" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Loja</th>
                                        <th>CNPJ</th>
                                        <th>ASO Correto</th>
                                        <th>ASO Incorreto</th>
                                        <th>Total ASO</th>
                                        <th>Não Realizado</th>
                                        <th>Total de Ativos</th>
                                        <th>Hora</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Loja</th>
                                        <th>CNPJ</th>
                                        <th>ASO Correto</th>
                                        <th>ASO Incorreto</th>
                                        <th>Total ASO</th>
                                        <th>Não Realizado</th>
                                        <th>Total de Ativos</th>
                                        <th>Dia da Geração</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    include '../../class/ayuadame.php';
                                    $pdo = Database::connect();
                                    $lojas = '';
                                    $sql_estabelecimento = 'select distinct cod_estabelecimento from wal_funcionarios where flg_periodico in (1)';
                                    foreach ($pdo->query($sql_estabelecimento) as $value) {
                                        $lojas = $lojas . $value['cod_estabelecimento'] . ',';
                                    }

                                    $sql = "select a.cod_estabelecimento,e.desc_estabelecimento as loja, e.cnpj as cnpj,
                                            sum(case when (flg_periodico in (1) and erro in (0)) then 1 else 0 end) fizeram,
                                            sum(case when erro in (1) then 1 else 0 end) com_erros,
                                            sum(case when (flg_periodico in (0) and erro in (0)) then 1 else 0 end) falta_fazer,
                                            (
                                            sum(case when (flg_periodico in (1) and erro in (0)) then 1 else 0 end) + 
                                            sum(case when erro in (1) then 1 else 0 end) + 
                                            sum(case when (flg_periodico in (0) and erro in (0)) then 1 else 0 end)
                                            ) as total_desta_loja,
                                            NOW() as hora
                                            from wal_funcionarios a 
                                            inner join wal_estabelecimento e on e.cod_estabelecimento = a.cod_estabelecimento
                                            where a.cod_estabelecimento in (" . substr($lojas, 0, -1) . ")
                                            group by a.cod_estabelecimento
                                            order by e.desc_estabelecimento asc";

                                    $fizeram_periodicos = $falta_fazer = $totalzim = 0;

                                    foreach ($pdo->query($sql) as $value) {
                                        echo '<tr>';
                                        echo '<td>' . $value['loja'] . '</td>';
                                        echo '<td>' . $value['cnpj'] . '</td>';
                                        echo '<td>' . $value['fizeram'] . '</td>';
                                        echo '<td>' . $value['com_erros'] . '</td>';
                                        echo '<td>' . bcadd($value['fizeram'], $value['com_erros']) . '</td>';
                                        echo '<td>' . $value['falta_fazer'] . '</td>';
                                        echo '<td>' . $value['total_desta_loja'] . '</td>';
                                        echo '<td>' . transformaEmDataBrasileira($value['hora']) . '</td>';
                                        echo '</tr>';
                                        $fizeram_periodicos = bcadd($fizeram_periodicos, bcadd($value['fizeram'], $value['com_erros']));
                                        $falta_fazer = bcadd($falta_fazer, $value['falta_fazer']);
                                        $totalzim = bcadd($fizeram_periodicos, $falta_fazer);
                                    }
                                    Database::disconnect();
                                    ?>
                                </tbody>
                            </table>
                        </form>                        
                    </div>
                </div>
                <div class="widget-content">
                    <table data-sortable class="table">
                        <thead>
                            <tr>
                                <th>Já Digitados</th>                                
                                <th>Para Digitar</th>
                                <th>Meta</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $fizeram_periodicos; ?></td>
                                <td><?php echo $falta_fazer; ?></td>
                                <td>35001</td>                                
                            </tr>											
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>