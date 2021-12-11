<?php
include '../config/database_mysql.php';
include '../../class/ayuadame.php';
$pdo = Database::connect();
$sql = "select id, razao_social, if(CNES = 0,'Não Informado',CNES) as CNES, data_cadastro from wal_prestadores where id not in (1,2) order by razao_social asc";
?>
<table class="table table-bordered table-striped table-responsive table-hover table-condensed">
    <thead>
        <tr>
            <th colspan="4" class="text-center">Nome Prestador</th>
            <th class="text-center">CNES</th>
            <th class="text-center">Cadastro</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $cont = 0;
        foreach ($pdo->query($sql) as $value) {
            echo '<tr>';
            echo '<td colspan="4"><strong>' . $value['razao_social'] . '</strong></td>';
            echo '<td><strong>' . $value['CNES'] . '</strong></td>';
            echo '<td><strong>' . transformaEmDataBrasileira($value['data_cadastro']) . '</strong></td>';
            echo '</tr>';
            $sql_medicos = "select count(*) as tem from wal_medico where id_prestador = " . $value['id'];
            $q = $pdo->prepare($sql_medicos);
            $q->execute();
            $data = $q->fetch(PDO::FETCH_ASSOC);
            if ($data['tem'] > 0) {
                echo '<tr><td colspan="2" class="text-center text-danger"><small><strong>Nome Médico</strong></small></td>';
                echo '<td class="text-center text-danger"><small><strong>CRM</strong></small></td>';
                echo '<td class="text-center text-danger"><small><strong>Conselho</strong></small></td>';
                echo '<td class="text-center text-danger"><small><strong>CNES</strong></small></td>';
                echo '<td class="text-center text-danger"><small><strong>Valor Consulta</strong></small></td></tr>';
                $sql_medico = "select id_medico, nome, crm, conselho, if(CNES = 0,'Não Informado',CNES) as CNES from wal_medico where id_prestador = " . $value['id'];
                foreach ($pdo->query($sql_medico) as $values) {
                    $id = $values['id_medico'] . $cont;
                    echo '<tr data-toggle="collapse" data-target="#' . $id . '" class="accordion-toggle">';
                    echo '<td>+</td>';
                    echo '<td class="text-center text-danger"><small><strong>' . $values['nome'] . '</strong></small></td>';
                    echo '<td class="text-center text-danger"><small>' . $values['crm'] . '</small></td>';
                    echo '<td class="text-center text-danger"><small>' . $values['conselho'] . '</small></td>';
                    echo '<td class="text-center text-danger"><small>' . $values['CNES'] . '</small></td>';
                    $sql_medicos_tutu = "select consulta, exame_clinico, acido_metil_hipurico, hemograma, acido_mandelico, 
                        vdrl, reticulocitos, parasitologico_fezes, cultural_de_orofaringe, coprocultura, micologico_de_unha,
                        audiometria, ecg, acuidade_visual, eeg, plaquetas, eritrograma, acido_tt_muconico, 
                        glicemia_em_jejum, acido_hipurico from medicos_valores_exames where crm = " . $values['crm'];
                    $qq = $pdo->prepare($sql_medicos_tutu);
                    $qq->execute();
                    $dataq = $qq->fetch(PDO::FETCH_ASSOC);
                    echo '<td class="text-center text-danger"><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['consulta'] == NULL ? 0 : $dataq['consulta'])) . '</small></td>';
                    echo '</tr>';
                    echo '<tr><td colspan="6" class="hiddenRow"><div class="accordian-body collapse" id="' . $id . '">';
                    echo '<table class="table table-condensed table-striped">';
                    echo '<tr>';
                    echo '<td colspan="3" class="text-center"><small>Valores Exames</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><small>Exame Clínico</small></td>';
                    echo '<td><small>Ácido Metil Hipúrico</small></td>';
                    echo '<td><small>Hemograma</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['exame_clinico'] == NULL ? 0 : $dataq['exame_clinico'])) . '</small></td>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['acido_metil_hipurico'] == NULL ? 0 : $dataq['acido_metil_hipurico'])) . '</small></td>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['hemograma'] == NULL ? 0 : $dataq['hemograma'])) . '</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><small>Ácido Mandélico</small></td>';
                    echo '<td><small>VDRL</small></td>';
                    echo '<td><small>Reticulócitos</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['acido_mandelico'] == NULL ? 0 : $dataq['acido_mandelico'])) . '</small></td>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['vdrl'] == NULL ? 0 : $dataq['vdrl'])) . '</small></td>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['reticulocitos'] == NULL ? 0 : $dataq['reticulocitos'])) . '</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><small>Parasitológico Fezes</small></td>';
                    echo '<td><small>Cultural de Orofaringe</small></td>';
                    echo '<td><small>Coprocultura</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['parasitologico_fezes'] == NULL ? 0 : $dataq['parasitologico_fezes'])) . '</small></td>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['cultural_de_orofaringe'] == NULL ? 0 : $dataq['cultural_de_orofaringe'])) . '</small></td>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['coprocultura'] == NULL ? 0 : $dataq['coprocultura'])) . '</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><small>Micológico de Unha</small></td>';
                    echo '<td><small>Audiometria</small></td>';
                    echo '<td><small>ECG</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['micologico_de_unha'] == NULL ? 0 : $dataq['micologico_de_unha'])) . '</small></td>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['audiometria'] == NULL ? 0 : $dataq['audiometria'])) . '</small></td>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['ecg'] == NULL ? 0 : $dataq['ecg'])) . '</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><small>Acuidade Visual</small></td>';
                    echo '<td><small>EEG</small></td>';
                    echo '<td><small>Plaquetas</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['acuidade_visual'] == NULL ? 0 : $dataq['acuidade_visual'])) . '</small></td>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['eeg'] == NULL ? 0 : $dataq['eeg'])) . '</small></td>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['plaquetas'] == NULL ? 0 : $dataq['plaquetas'])) . '</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><small>Eritograma</small></td>';
                    echo '<td><small>Ácido TT Mucônico</small></td>';
                    echo '<td><small>Glicemia em Jejum</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['eritrograma'] == NULL ? 0 : $dataq['eritrograma'])) . '</small></td>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['acido_tt_muconico'] == NULL ? 0 : $dataq['acido_tt_muconico'])) . '</small></td>';
                    echo '<td><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['glicemia_em_jejum'] == NULL ? 0 : $dataq['glicemia_em_jejum'])) . '</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td colspan="3"><small>Ácido Hipúrico</small></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td colspan="3"><small>R$ ' . transformaEmReal(str_replace(",", ".", $dataq['acido_hipurico'] == NULL ? 0 : $dataq['acido_hipurico'])) . '</small></td>';
                    echo '</tr>';
                    echo '</table>';
                    echo '</div></td>';
                    ++$cont;
                }
            }
        }
        Database::disconnect();
        ?>    
    </tbody>
</table>