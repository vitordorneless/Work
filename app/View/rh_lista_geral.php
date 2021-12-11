<div id="refresca_tst_tipo_agendamento">
    <script src="../js/JQuery/jquery-1.11.1.min.js"></script>
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
                    <h2><strong>Lista </strong>Geral</h2>                    
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
                                        <th>Nome</th>
                                        <th>Matrícula</th>
                                        <th>Nascimento</th>
                                        <th>Idade</th>
                                        <th>Admissão</th>
                                        <th>30</th>
                                        <th>45</th>
                                        <th>70</th>
                                        <th>80</th>
                                        <th>90</th>
                                        <th>Função</th>
                                        <th>Setor</th>
                                        <th>Unidade</th>
                                        <th>Vínculo</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Matrícula</th>
                                        <th>Nascimento</th>
                                        <th>Idade</th>
                                        <th>Admissão</th>
                                        <th>30</th>
                                        <th>45</th>
                                        <th>70</th>
                                        <th>80</th>
                                        <th>90</th>
                                        <th>Função</th>
                                        <th>Setor</th>
                                        <th>Unidade</th>
                                        <th>Vínculo</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    include '../../class/ayuadame.php';
                                    $hoje = new Datetime(date('Y-m-d'));
                                    $pdo = Database::connect();
                                    $sql = "select id, nome,matricula,nome_pai,nome_mae,nascimento,ctps,data_ctps,
                                            titulo_eleitor,admissao,exame_admissional,
                                            exame_medico,identidade,emissao_identidade,org_emissor_identidade,cpf,pis,data_cad_pis,
                                            nome_conselho_regional,id_rh_estado_civil,id_rh_grau_instrucao_escolar,
                                            id_sexo,id_rh_cor_pessoa,id_rh_deficiencia_pessoa,endereco,numero,complemento,bairro,
                                            id_cidade,id_estado,cep,id_rh_departamentos,id_rh_funcoes,salario_atual,
                                            id_local_trabalho_cidade,id_rateio_folha,membro_cipa,anotacoes_gerais,data_saida,
                                            exame_demissional,id_status_vinculo,id_rh_empresas,id_rh_unidades,status,data_ultima_alteracao 
                                            from rh_funcionarios where status in (1) order by nome asc";
                                    foreach ($pdo->query($sql) as $value) {

                                        $sql_funcao = 'select funcao from rh_funcoes where id in (' . $value['id_rh_funcoes'] . ')';
                                        $qq = $pdo->prepare($sql_funcao);
                                        $qq->execute();
                                        $data_funcao = $qq->fetch(PDO::FETCH_ASSOC);

                                        $sql_departamentos = 'select departamento from rh_departamentos where id in (' . $value['id_rh_departamentos'] . ')';
                                        $qqq = $pdo->prepare($sql_departamentos);
                                        $qqq->execute();
                                        $data_dep = $qqq->fetch(PDO::FETCH_ASSOC);
                                        
                                        $sql_unidade = 'select unidade from rh_unidades where id in (' . $value['id_rh_unidades'] . ')';
                                        $qqqq = $pdo->prepare($sql_unidade);
                                        $qqqq->execute();
                                        $data_uni = $qqqq->fetch(PDO::FETCH_ASSOC);
                                        
                                        $sql_vinculo = 'select tipo from rh_vinculo where id in (' . $value['id_status_vinculo'] . ')';
                                        $qqqqq = $pdo->prepare($sql_vinculo);
                                        $qqqqq->execute();
                                        $data_vin = $qqqqq->fetch(PDO::FETCH_ASSOC);
                                        
                                        $nascimento = new DateTime($value['nascimento']);
                                        $admissao1 = new DateTime($value['admissao']);
                                        $admissao2 = new DateTime($value['admissao']);
                                        $admissao3 = new DateTime($value['admissao']);
                                        $admissao4 = new DateTime($value['admissao']);
                                        $admissao5 = new DateTime($value['admissao']);
                                        $idade = $hoje->diff($nascimento);
                                        $trinta = $admissao1->add(new DateInterval('P1M'));
                                        $quarenta_e_cinco = $admissao2->add(new DateInterval('P45D'));
                                        $setenta = $admissao3->add(new DateInterval('P70D'));
                                        $oitenta = $admissao4->add(new DateInterval('P80D'));
                                        $noventa = $admissao5->add(new DateInterval('P90D'));
                                        echo '<tr>';
                                        echo '<td><small>' . utf8_encode($value['nome']) . '</small></td>';
                                        echo '<td><small>' . $value['matricula'] . '</small></td>';
                                        echo '<td><small>' . transformaEmDataBrasileira($value['nascimento']) . '</small></td>';
                                        echo '<td><small>' . $idade->format('%Y') . '</small></td>';
                                        echo '<td><small>' . transformaEmDataBrasileira($value['admissao']) . '</small></td>';
                                        echo '<td><small>' . $trinta->format('d/m/Y') . '</small></td>';
                                        echo '<td><small>' . $quarenta_e_cinco->format('d/m/Y') . '</small></td>';
                                        echo '<td><small>' . $setenta->format('d/m/Y') . '</small></td>';
                                        echo '<td><small>' . $oitenta->format('d/m/Y') . '</small></td>';
                                        echo '<td><small>' . $noventa->format('d/m/Y') . '</small></td>';
                                        echo '<td><small>' . utf8_encode($data_funcao['funcao']) . '</small></td>';
                                        echo '<td><small>' . utf8_encode($data_dep['departamento']) . '</small></td>';
                                        echo '<td><small>' . utf8_encode($data_uni['unidade']) . '</small></td>';
                                        echo '<td><small>' . utf8_encode($data_vin['tipo']) . '</small></td>';
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