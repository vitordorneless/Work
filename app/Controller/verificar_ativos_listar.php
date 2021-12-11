<?php
include '../config/database_mysql.php';
$empresa = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_NUMBER_INT);
$estabelecimento = filter_input(INPUT_POST, 'estabelecimento', FILTER_SANITIZE_NUMBER_INT);
?>
<link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
<style type="text/css" class="init"></style>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
<script class="init">
    $(document).ready(function () {
        $('#funcionariosssss').DataTable();
    });
</script>
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Listar </strong>Setores</h2>
                <div class="additional-btn">                    
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                </div>
            </div>
            <div class="widget-content">
                <br>
                <div class="table-responsive">                    
                    <table id="funcionariosssss" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th rowspan="2"><small>Ativo</small></th>
                                <th rowspan="2"><small>Código Departamento</small></th>
                                <th rowspan="2"><small>Departamento</small></th>
                                <th colspan="5">Riscos</th>
                                <th colspan="19">Exames</th>
                            </tr>
                            <tr>
                                <th><small>Agente Fisíco</small></th>
                                <th><small>Agente Químico</small></th>
                                <th><small>Agente Biológico</small></th>
                                <th><small>Agente Ergonômico</small></th>
                                <th><small>Ausência de Risco</small></th>
                                <th><small>EXAME CLÍNICO</small></th>
                                <th><small>ÁCIDO METIL-HIPÚRICO</small></th>
                                <th><small>HEMOGRAMA</small></th>
                                <th><small>ÁCIDO MANDÉLICO</small></th>
                                <th><small>VDRL</small></th>
                                <th><small>RETICULÓCITOS</small></th>
                                <th><small>PARASITOLÓGICO FEZES</small></th>
                                <th><small>CULTURAL DE OROFARINGE</small></th>
                                <th><small>COPROCULTURA</small></th>
                                <th><small>MICOLÓGICO DE UNHA</small></th>
                                <th><small>AUDIOMETRIA</small></th>
                                <th><small>ECG</small></th>
                                <th><small>ACUIDADE VISUAL</small></th>
                                <th><small>EEG</small></th>
                                <th><small>PLAQUETAS</small></th>
                                <th><small>ERITROGRAMA</small></th>
                                <th><small>ÁCIDO TT MUCÔNICO</small></th>
                                <th><small>GLICEMIA EM JEJUM</small></th>
                                <th><small>ÁCIDO HIPÚRICO</small></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><small>Ativo</small></th>
                                <th><small>Código Departamento</small></th>
                                <th><small>Departamento</small></th>
                                <th><small>Agente Fisíco</small></th>
                                <th><small>Agente Químico</small></th>
                                <th><small>Agente Biológico</small></th>
                                <th><small>Agente Ergonômico</small></th>
                                <th><small>Ausência de Risco</small></th>
                                <th><small>EXAME CLÍNICO</small></th>
                                <th><small>ÁCIDO METIL-HIPÚRICO</small></th>
                                <th><small>HEMOGRAMA</small></th>
                                <th><small>ÁCIDO MANDÉLICO</small></th>
                                <th><small>VDRL</small></th>
                                <th><small>RETICULÓCITOS</small></th>
                                <th><small>PARASITOLÓGICO FEZES</small></th>
                                <th><small>CULTURAL DE OROFARINGE</small></th>
                                <th><small>COPROCULTURA</small></th>
                                <th><small>MICOLÓGICO DE UNHA</small></th>
                                <th><small>AUDIOMETRIA</small></th>
                                <th><small>ECG</small></th>
                                <th><small>ACUIDADE VISUAL</small></th>
                                <th><small>EEG</small></th>
                                <th><small>PLAQUETAS</small></th>
                                <th><small>ERITROGRAMA</small></th>
                                <th><small>ÁCIDO TT MUCÔNICO</small></th>
                                <th><small>GLICEMIA EM JEJUM</small></th>
                                <th><small>ÁCIDO HIPÚRICO</small></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $pdo = Database::connect();
                            $sql = "select funfun.id as id_funcionario, funfun.nome_funcionario as nome, funfun.cod_depto as departamento, depdep.desc_depto as nome_depto
                                            from wal_funcionarios funfun
                                            inner join wal_departamento depdep on depdep.cod_depto = funfun.cod_depto
                                            where funfun.cod_empresa = $empresa and funfun.cod_estabelecimento = $estabelecimento
                                            and funfun.exame = 1 and funfun.risco = 1 
                                            order by depdep.desc_depto";
                            foreach ($pdo->query($sql) as $value) {
                                $id_funcionario = $value['id_funcionario'];
                                $sql_exames_riscos = "select 
                                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 1) > 0,'1', '0') as agente_fisico,
                                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 2) > 0,'1', '0') as agente_quimico,
                                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 3) > 0,'1', '0') as agente_biologico,
                                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 4) > 0,'1', '0') as agente_ergonomico,
                                    if((select count(id_risco) from wal_funcionarios_riscos where id_funcionario = $id_funcionario and id_risco = 5) > 0,'1', '0') as ausencia_de_risco,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 1) > 0,'1', '0') as exame_clinico,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 2) > 0,'1', '0') as acido_metil_hipurico,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 3) > 0,'1', '0') as hemograma,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 4) > 0,'1', '0') as acido_mandelico,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 5) > 0,'1', '0') as vdrl,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 6) > 0,'1', '0') as reticulocitos,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 7) > 0,'1', '0') as parasitologico_fezes,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 8) > 0,'1', '0') as cultural_de_orofaringe,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 9) > 0,'1', '0') as coprocultura,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 10) > 0,'1', '0') as micologico_de_unha,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 11) > 0,'1', '0') as audiometria,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 12) > 0,'1', '0') as ecg,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 13) > 0,'1', '0') as acuidade_visual,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 14) > 0,'1', '0') as eeg,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 15) > 0,'1', '0') as plaquetas,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 16) > 0,'1', '0') as eritrograma,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 17) > 0,'1', '0') as acido_tt_muconico,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 18) > 0,'1', '0') as glicemia_em_jejum,
                                    if((select count(id_exame) from wal_funcionarios_exames where id_funcionario = $id_funcionario and id_exame = 19) > 0,'1', '0') as acido_hipurico";

                                $q = $pdo->prepare($sql_exames_riscos);
                                $q->execute();
                                $data = $q->fetch(PDO::FETCH_ASSOC);
                                $agente_fisico = $data['agente_fisico'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $agente_quimico = $data['agente_quimico'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $agente_biologico = $data['agente_biologico'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $agente_ergonomico = $data['agente_ergonomico'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $ausencia_de_risco = $data['ausencia_de_risco'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $exame_clinico = $data['exame_clinico'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $acido_metil_hipurico = $data['acido_metil_hipurico'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $hemograma = $data['hemograma'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $acido_mandelico = $data['acido_mandelico'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $vdrl = $data['vdrl'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $reticulocitos = $data['reticulocitos'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $parasitologico_fezes = $data['parasitologico_fezes'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $cultural_de_orofaringe = $data['cultural_de_orofaringe'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $coprocultura = $data['coprocultura'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $micologico_de_unha = $data['micologico_de_unha'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $audiometria = $data['audiometria'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $ecg = $data['ecg'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $acuidade_visual = $data['acuidade_visual'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $eeg = $data['eeg'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $plaquetas = $data['plaquetas'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $eritrograma = $data['eritrograma'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $acido_tt_muconico = $data['acido_tt_muconico'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $glicemia_em_jejum = $data['glicemia_em_jejum'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                $acido_hipurico = $data['acido_hipurico'] == 1 ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';

                                echo '<tr>';
                                echo '<td class="text-center"><small><strong>' . $value['nome'] . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $value['departamento'] . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $value['nome_depto'] . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $agente_fisico . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $agente_quimico . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $agente_biologico . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $agente_ergonomico . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $ausencia_de_risco . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $exame_clinico . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $acido_metil_hipurico . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $hemograma . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $acido_mandelico . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $vdrl . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $reticulocitos . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $parasitologico_fezes . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $cultural_de_orofaringe . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $coprocultura . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $micologico_de_unha . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $audiometria . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $ecg . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $acuidade_visual . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $eeg . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $plaquetas . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $eritrograma . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $acido_tt_muconico . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $glicemia_em_jejum . '</strong></small></td>';
                                echo '<td class="text-center"><small><strong>' . $acido_hipurico . '</strong></small></td>';
                                echo '</tr>';
                            }
                            Database::disconnect();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>