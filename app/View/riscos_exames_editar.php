<?php
require '../Model/Riscos.php';
require '../Model/Riscos_Operations.php';
$riscos = new Riscos_Operations();
$riscos->set_loja(filter_input(INPUT_GET, 'loja', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_cod_cargo(filter_input(INPUT_GET, 'cod_cargo', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_depto(filter_input(INPUT_GET, 'depto', FILTER_SANITIZE_NUMBER_INT));
$array_riscos = $riscos->Marca_Riscos($riscos->get_loja(), $riscos->get_cod_cargo());
$array_exames = $riscos->Marca_Exames($riscos->get_loja(), $riscos->get_cod_cargo());
$obs_agente_fisico = $array_riscos['obs_agente_fisico'] == NULL ? " " : $array_riscos['obs_agente_fisico'];
$obs_agente_quimico = $array_riscos['obs_agente_quimico'] == NULL ? " " : $array_riscos['obs_agente_quimico'];
$obs_agente_biologico = $array_riscos['obs_agente_biologico'] == NULL ? " " : $array_riscos['obs_agente_biologico'];
$obs_agente_ergonomico = $array_riscos['obs_agente_ergonomico'] == NULL ? " " : $array_riscos['obs_agente_ergonomico'];
$obs_ausencia_de_risco = $array_riscos['obs_ausencia_de_risco'] == NULL ? " " : $array_riscos['obs_ausencia_de_risco'];
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_definir_riscos").empty();
            var loja = $("#loja").val();
            var cod_cargo = $("#cod_cargo").val();
            var agente_fisico = $("#agente_fisico").is(":checked") === true ? 1 : 0;
            var agente_quimico = $("#agente_quimico").is(":checked") === true ? 1 : 0;
            var agente_biologico = $("#agente_biologico").is(":checked") === true ? 1 : 0;
            var agente_ergonomico = $("#agente_ergonomico").is(":checked") === true ? 1 : 0;
            var ausencia_de_risco = $("#ausencia_de_risco").is(":checked") === true ? 1 : 0;
            var exame_clinico = $("#exame_clinico").is(":checked") === true ? 1 : 0;
            var acido_metil_hipurico = $("#acido_metil_hipurico").is(":checked") === true ? 1 : 0;
            var hemograma = $("#hemograma").is(":checked") === true ? 1 : 0;
            var acido_mandelico = $("#acido_mandelico").is(":checked") === true ? 1 : 0;
            var vdrl = $("#vdrl").is(":checked") === true ? 1 : 0;
            var reticulocitos = $("#reticulocitos").is(":checked") === true ? 1 : 0;
            var parasitologico_fezes = $("#parasitologico_fezes").is(":checked") === true ? 1 : 0;
            var cultural_de_orofaringe = $("#cultural_de_orofaringe").is(":checked") === true ? 1 : 0;
            var coprocultura = $("#coprocultura").is(":checked") === true ? 1 : 0;
            var micologico_de_unha = $("#micologico_de_unha").is(":checked") === true ? 1 : 0;
            var audiometria = $("#audiometria").is(":checked") === true ? 1 : 0;
            var ecg = $("#ecg").is(":checked") === true ? 1 : 0;
            var acuidade_visual = $("#acuidade_visual").is(":checked") === true ? 1 : 0;
            var eeg = $("#eeg").is(":checked") === true ? 1 : 0;
            var plaquetas = $("#plaquetas").is(":checked") === true ? 1 : 0;
            var eritrograma = $("#eritrograma").is(":checked") === true ? 1 : 0;
            var acido_tt_muconico = $("#acido_tt_muconico").is(":checked") === true ? 1 : 0;
            var glicemia_em_jejum = $("#glicemia_em_jejum").is(":checked") === true ? 1 : 0;
            var acido_hipurico = $("#acido_hipurico").is(":checked") === true ? 1 : 0;
            var avaliacao_psicossocial = $("#avaliacao_psicossocial").is(":checked") === true ? 1 : 0;
            var obs_agente_fisico = $("#obs_agente_fisico").val();
            var obs_agente_quimico = $("#obs_agente_quimico").val();
            var obs_agente_biologico = $("#obs_agente_biologico").val();
            var obs_agente_ergonomico = $("#obs_agente_ergonomico").val();
            var obs_ausencia_de_risco = $("#obs_ausencia_de_risco").val();
            var depto = $("#depto").val();

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/riscos_exames_editar.php",
                data: "loja=" + loja + "&cod_cargo=" + cod_cargo + "&agente_fisico=" + agente_fisico + "&agente_quimico=" + agente_quimico + "&agente_biologico=" + agente_biologico + "&agente_ergonomico=" + agente_ergonomico + "&ausencia_de_risco=" + ausencia_de_risco +
                        "&exame_clinico=" + exame_clinico + "&acido_metil_hipurico=" + acido_metil_hipurico + "&hemograma=" + hemograma + "&acido_mandelico=" + acido_mandelico + "&vdrl=" + vdrl + "&reticulocitos=" + reticulocitos +
                        "&parasitologico_fezes=" + parasitologico_fezes + "&cultural_de_orofaringe=" + cultural_de_orofaringe + "&coprocultura=" + coprocultura + "&micologico_de_unha=" + micologico_de_unha + "&audiometria=" + audiometria + "&ecg=" + ecg +
                        "&acuidade_visual=" + acuidade_visual + "&eeg=" + eeg + "&plaquetas=" + plaquetas + "&eritrograma=" + eritrograma + "&acido_tt_muconico=" + acido_tt_muconico + "&glicemia_em_jejum=" + glicemia_em_jejum +
                        "&acido_hipurico=" + acido_hipurico + "&obs_agente_fisico=" + obs_agente_fisico + "&obs_agente_quimico=" + obs_agente_quimico + "&obs_agente_biologico=" + obs_agente_biologico + 
                        "&obs_agente_ergonomico=" + obs_agente_ergonomico + "&obs_ausencia_de_risco=" + obs_ausencia_de_risco + "&depto=" + depto + "&avaliacao_psicossocial=" + avaliacao_psicossocial,
                beforeSend: function () {
                    $("#conteudo_definir_riscos").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_definir_riscos").html(response);
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="panel panel-fit panel-warning">
    <div class="panel-heading"><h3 class="text-center">Riscos</h3></div>
    <div class="panel-body">
        <form id="form" method="POST">
            <div class="form-group">
                <input type="hidden" class="form-control" id="loja" name="loja" value="<?php echo $riscos->get_loja(); ?>">
                <input type="hidden" class="form-control" id="cod_cargo" name="cod_cargo" value="<?php echo $riscos->get_cod_cargo(); ?>">
                <input type="hidden" class="form-control" id="depto" name="depto" value="<?php echo $riscos->get_depto(); ?>">
                <table>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="agente_fisico" id="agente_fisico" type="checkbox" <?php $agente_fisico = $array_riscos['agente_fisico'] == 1 ? 'checked' : '';
                                    echo $agente_fisico; ?>> Agentes Físicos 
                                </label>
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_agente_fisico" name="obs_agente_fisico" placeholder="Observações deste Risco" value="<?php echo $obs_agente_fisico; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="agente_quimico" id="agente_quimico"  type="checkbox" <?php $agente_quimico = $array_riscos['agente_quimico'] == 1 ? 'checked' : '';
                                    echo $agente_quimico; ?>> Agentes Químicos 
                                </label>
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_agente_quimico" name="obs_agente_quimico" placeholder="Observações deste Risco" value="<?php echo $obs_agente_quimico; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="agente_biologico" id="agente_biologico"  type="checkbox" <?php $agente_biologico = $array_riscos['agente_biologico'] == 1 ? 'checked' : '';
                                    echo $agente_biologico; ?>> Agentes Biológicos 
                                </label>
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_agente_biologico" name="obs_agente_biologico" placeholder="Observações deste Risco" value="<?php echo $obs_agente_biologico; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="agente_ergonomico" id="agente_ergonomico"  type="checkbox" <?php $agente_ergonomico = $array_riscos['agente_ergonomico'] == 1 ? 'checked' : '';
                                    echo $agente_ergonomico; ?>> Agentes Ergonômicos 
                                </label>
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_agente_ergonomico" name="obs_agente_ergonomico" placeholder="Observações deste Risco" value="<?php echo $obs_agente_ergonomico; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="ausencia_de_risco" id="ausencia_de_risco"  type="checkbox" <?php $ausencia_de_risco = $array_riscos['ausencia_de_risco'] == 1 ? 'checked' : '';
                                    echo $ausencia_de_risco; ?>> Ausência de Risco Ocupacional Específico 
                                </label>                        
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_ausencia_de_risco" name="obs_ausencia_de_risco" placeholder="Observações deste Risco" value="<?php echo $obs_ausencia_de_risco; ?>">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="form-group">
                <h3 class="text-center">Exames Complementares</h3>
                <table>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="exame_clinico" id="exame_clinico"  type="checkbox" <?php $exame_clinico = $array_exames['exame_clinico'] == 1 ? 'checked' : '';
                                    echo $exame_clinico; ?>> EXAME CLÍNICO 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acido_metil_hipurico" id="acido_metil_hipurico"  type="checkbox" <?php $acido_metil_hipurico = $array_exames['acido_metil_hipurico'] == 1 ? 'checked' : '';
                                    echo $acido_metil_hipurico; ?>> ÁCIDO METIL-HIPÚRICO 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="hemograma" id="hemograma"  type="checkbox" <?php $hemograma = $array_exames['hemograma'] == 1 ? 'checked' : '';
                                    echo $hemograma; ?>> HEMOGRAMA 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acido_mandelico" id="acido_mandelico"  type="checkbox" <?php $acido_mandelico = $array_exames['acido_mandelico'] == 1 ? 'checked' : '';
                                    echo $acido_mandelico; ?>> ÁCIDO MANDÉLICO 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="vdrl" id="vdrl"  type="checkbox" <?php $vdrl = $array_exames['vdrl'] == 1 ? 'checked' : '';
                                    echo $vdrl; ?>> VDRL 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="reticulocitos" id="reticulocitos"  type="checkbox" <?php $reticulocitos = $array_exames['reticulocitos'] == 1 ? 'checked' : '';
                                    echo $reticulocitos; ?>> RETICULÓCITOS 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="parasitologico_fezes" id="parasitologico_fezes"  type="checkbox" <?php $parasitologico_fezes = $array_exames['parasitologico_fezes'] == 1 ? 'checked' : '';
                                    echo $parasitologico_fezes; ?>> PARASITOLÓGICO FEZES 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="cultural_de_orofaringe" id="cultural_de_orofaringe"  type="checkbox" <?php $cultural_de_orofaringe = $array_exames['cultural_de_orofaringe'] == 1 ? 'checked' : '';
                                    echo $cultural_de_orofaringe; ?>> CULTURAL DE OROFARINGE 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="coprocultura" id="coprocultura"  type="checkbox" <?php $coprocultura = $array_exames['coprocultura'] == 1 ? 'checked' : '';
                                    echo $coprocultura; ?>> COPROCULTURA 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="micologico_de_unha" id="micologico_de_unha"  type="checkbox" <?php $micologico_de_unha = $array_exames['micologico_de_unha'] == 1 ? 'checked' : '';
                                    echo $micologico_de_unha; ?>> MICOLÓGICO DE UNHA 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="audiometria" id="audiometria"  type="checkbox" <?php $audiometria = $array_exames['audiometria'] == 1 ? 'checked' : '';
                                    echo $audiometria; ?>> AUDIOMETRIA 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="ecg" id="ecg"  type="checkbox" <?php $ecg = $array_exames['ecg'] == 1 ? 'checked' : '';
                                    echo $ecg; ?>> ECG 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acuidade_visual" id="acuidade_visual"  type="checkbox" <?php $acuidade_visual = $array_exames['acuidade_visual'] == 1 ? 'checked' : '';
                                    echo $acuidade_visual; ?>> ACUIDADE VISUAL 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="eeg" id="eeg"  type="checkbox" <?php $eeg = $array_exames['eeg'] == 1 ? 'checked' : '';
                                    echo $eeg; ?>> EEG 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="plaquetas" id="plaquetas"  type="checkbox" <?php $plaquetas = $array_exames['plaquetas'] == 1 ? 'checked' : '';
                                    echo $plaquetas; ?>> PLAQUETAS 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="eritrograma" id="eritrograma"  type="checkbox" <?php $eritrograma = $array_exames['eritrograma'] == 1 ? 'checked' : '';
                                    echo $eritrograma; ?>> ERITROGRAMA 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acido_tt_muconico" id="acido_tt_muconico"  type="checkbox" <?php $acido_tt_muconico = $array_exames['acido_tt_muconico'] == 1 ? 'checked' : '';
                                    echo $acido_tt_muconico; ?>> ÁCIDO TT MUCÔNICO 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="glicemia_em_jejum" id="glicemia_em_jejum"  type="checkbox" <?php $glicemia_em_jejum = $array_exames['glicemia_em_jejum'] == 1 ? 'checked' : '';
                                    echo $glicemia_em_jejum; ?>> GLICEMIA EM JEJUM 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acido_hipurico" id="acido_hipurico"  type="checkbox" <?php $acido_hipurico = $array_exames['acido_hipurico'] == 1 ? 'checked' : '';
                                    echo $acido_hipurico; ?>> ÁCIDO HIPÚRICO 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="avaliacao_psicossocial" id="avaliacao_psicossocial"  type="checkbox" <?php $avaliacao_psicossocial = $array_exames['avaliacao_psicossocial'] == 1 ? 'checked' : '';
                                    echo $avaliacao_psicossocial; ?>> AVALIAÇÃO PSICOSSOCIAL 
                                </label>                                
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Editar Riscos</button>
            </div>
        </form>
    </div>
    <div class="panel panel-footer" id="conteudo_definir_riscos"></div>
</div>