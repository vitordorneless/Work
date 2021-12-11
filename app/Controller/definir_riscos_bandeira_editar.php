<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$flags = new Wal_Ativos();
$querie = new Queries();
$flags->set_bandeira(filter_input(INPUT_POST, 'bandeira', FILTER_SANITIZE_STRING));
$flags->set_cod_setor(filter_input(INPUT_POST, 'setor', FILTER_SANITIZE_STRING));
$flags->set_cod_cargo(filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRING));
$id_parametro = $flags->Dados_Wal_Ativos_bandeira_editar_referencia($flags->get_bandeira(), $flags->get_cod_setor(), $flags->get_cod_cargo());
$array = $flags->Dados_Wal_Ativos_riscos_2016($id_parametro['id_funcionario']);
$agente_fisico = $array['agente_fisico'] == 1 ? 'checked' : '';
$obs_agente_fisico = $array['obs_agente_fisico'] == '' ? '' : $array['obs_agente_fisico'];
$agente_quimico = $array['agente_quimico'] == 1 ? 'checked' : '';
$obs_agente_quimico = $array['obs_agente_quimico'] == '' ? '' : $array['obs_agente_quimico'];
$agente_biologico = $array['agente_biologico'] == 1 ? 'checked' : '';
$obs_agente_biologico = $array['obs_agente_biologico'] == '' ? '' : $array['obs_agente_biologico'];
$agente_ergonomico = $array['agente_ergonomico'] == 1 ? 'checked' : '';
$obs_agente_ergonomico = $array['obs_agente_ergonomico'] == '' ? '' : $array['obs_agente_ergonomico'];
$ausencia_de_risco = $array['ausencia_de_risco'] == 1 ? 'checked' : '';
$obs_ausencia_de_risco = $array['obs_ausencia_de_risco'] == '' ? '' : $array['obs_ausencia_de_risco'];
$outros = $array['outros'] == 1 ? 'checked' : '';
$obs_outros = $array['obs_outros'] == '' ? '' : $array['obs_outros'];

$exame_clinico = $array['exame_clinico'] == 1 ? 'checked' : '';
$acido_metil_hipurico = $array['acido_metil_hipurico'] == 1 ? 'checked' : '';
$hemograma = $array['hemograma'] == 1 ? 'checked' : '';
$acido_mandelico = $array['acido_mandelico'] == 1 ? 'checked' : '';
$vdrl = $array['vdrl'] == 1 ? 'checked' : '';
$reticulocitos = $array['reticulocitos'] == 1 ? 'checked' : '';
$parasitologico_fezes = $array['parasitologico_fezes'] == 1 ? 'checked' : '';
$cultural_de_orofaringe = $array['cultural_de_orofaringe'] == 1 ? 'checked' : '';
$coprocultura = $array['coprocultura'] == 1 ? 'checked' : '';
$micologico_de_unha = $array['micologico_de_unha'] == 1 ? 'checked' : '';
$audiometria = $array['audiometria'] == 1 ? 'checked' : '';
$ecg = $array['ecg'] == 1 ? 'checked' : '';
$acuidade_visual = $array['acuidade_visual'] == 1 ? 'checked' : '';
$eeg = $array['eeg'] == 1 ? 'checked' : '';
$plaquetas = $array['plaquetas'] == 1 ? 'checked' : '';
$eritrograma = $array['eritrograma'] == 1 ? 'checked' : '';
$acido_tt_muconico = $array['acido_tt_muconico'] == 1 ? 'checked' : '';
$glicemia_em_jejum = $array['glicemia_em_jejum'] == 1 ? 'checked' : '';
$acido_hipurico = $array['acido_hipurico'] == 1 ? 'checked' : '';
$avaliacao_psicossocial = $array['avaliacao_psicossocial'] == 1 ? 'checked' : '';
$trab_altura = $array['trab_altura'] == 1 ? 'checked' : '';
$anti_hbs = $array['anti_hbs'] == 1 ? 'checked' : '';
$hbs_ag = $array['hbs_ag'] == 1 ? 'checked' : '';
$anti_hbc = $array['anti_hbc'] == 1 ? 'checked' : '';
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#forms").submit(function () {
            return false;
        });
        $("#envias").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_definir").empty();
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
            var avaliacao_psicossocial = $("#avaliacao_psicossocial").is(":checked") === true ? 1 : 0;
            var acido_hipurico = $("#acido_hipurico").is(":checked") === true ? 1 : 0;
            var obs_agente_fisico = $("#obs_agente_fisico").val();
            var obs_agente_quimico = $("#obs_agente_quimico").val();
            var obs_agente_biologico = $("#obs_agente_biologico").val();
            var obs_agente_ergonomico = $("#obs_agente_ergonomico").val();
            var obs_ausencia_de_risco = $("#obs_ausencia_de_risco").val();
            var obs_outros = $("#obs_outros").val();
            var bandeira = $("#bandeira").val();
            var cargo = $("#cargo").val();
            var setor = $("#setor").val();
            var outros = $("#outros").is(":checked") === true ? 1 : 0;
            var anti_hbs = $("#anti_hbs").is(":checked") === true ? 1 : 0;
            var hbs_ag = $("#hbs_ag").is(":checked") === true ? 1 : 0;
            var anti_hbc = $("#anti_hbc").is(":checked") === true ? 1 : 0;

            $.ajax({
                type: "GET",
                dataType: "HTML",
                url: "../Controller/definir_riscos_bandeira_editar_form.php",
                data: "agente_fisico=" + agente_fisico + "&agente_quimico=" + agente_quimico + "&agente_biologico=" + agente_biologico + "&agente_ergonomico=" + agente_ergonomico + "&ausencia_de_risco=" + ausencia_de_risco +
                        "&exame_clinico=" + exame_clinico + "&acido_metil_hipurico=" + acido_metil_hipurico + "&hemograma=" + hemograma + "&acido_mandelico=" + acido_mandelico + "&vdrl=" + vdrl + "&reticulocitos=" + reticulocitos +
                        "&parasitologico_fezes=" + parasitologico_fezes + "&cultural_de_orofaringe=" + cultural_de_orofaringe + "&coprocultura=" + coprocultura + "&micologico_de_unha=" + micologico_de_unha + "&audiometria=" + audiometria + "&ecg=" + ecg +
                        "&acuidade_visual=" + acuidade_visual + "&eeg=" + eeg + "&plaquetas=" + plaquetas + "&eritrograma=" + eritrograma + "&acido_tt_muconico=" + acido_tt_muconico + "&glicemia_em_jejum=" + glicemia_em_jejum +
                        "&acido_hipurico=" + acido_hipurico + "&obs_agente_fisico=" + obs_agente_fisico + "&obs_agente_quimico=" + obs_agente_quimico + "&obs_agente_biologico=" + obs_agente_biologico +
                        "&obs_agente_ergonomico=" + obs_agente_ergonomico + "&obs_ausencia_de_risco=" + obs_ausencia_de_risco + "&avaliacao_psicossocial=" + avaliacao_psicossocial +
                        "&outros=" + outros + "&obs_outros=" + obs_outros + "&anti_hbs=" + anti_hbs + "&hbs_ag=" + hbs_ag + "&anti_hbc=" + anti_hbc + 
                        "&bandeira=" + bandeira + "&setor=" + setor + "&cargo=" + cargo,
                beforeSend: function () {
                    $("#conteudo_definir").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_definir").html(response);
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
        <form id="forms" method="POST">            
            <div class="form-group">                    
                <table>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" id="bandeira" name="bandeira" value="<?php echo $flags->get_bandeira(); ?>">
                                    <input type="hidden" id="cargo" name="cargo" value="<?php echo $flags->get_cod_cargo(); ?>">
                                    <input type="hidden" id="setor" name="setor" value="<?php echo $flags->get_cod_setor(); ?>">
                                    <input name="agente_fisico" id="agente_fisico" type="checkbox" <?php echo $agente_fisico; ?>> Agentes Físicos
                                </label>                    
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_agente_fisico" name="obs_agente_fisico" placeholder="Observações deste Risco" value="<?php echo $array['obs_agente_fisico']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="agente_quimico" id="agente_quimico" type="checkbox" <?php echo $agente_quimico; ?>> Agentes Químicos 
                                </label>
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_agente_quimico" name="obs_agente_quimico" placeholder="Observações deste Risco" value="<?php echo $array['obs_agente_quimico']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="agente_biologico" id="agente_biologico" type="checkbox" <?php echo $agente_biologico; ?>> Agentes Biológicos 
                                </label>
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_agente_biologico" name="obs_agente_biologico" placeholder="Observações deste Risco" value="<?php echo $array['obs_agente_biologico']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="agente_ergonomico" id="agente_ergonomico" type="checkbox" <?php echo $agente_ergonomico; ?>> Agentes Ergonômicos 
                                </label>
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_agente_ergonomico" name="obs_agente_ergonomico" placeholder="Observações deste Risco" value="<?php echo $array['obs_agente_ergonomico']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="ausencia_de_risco" id="ausencia_de_risco" type="checkbox" <?php echo $ausencia_de_risco; ?>> Ausência de Risco Ocupacional Específico 
                                </label>                        
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_ausencia_de_risco" name="obs_ausencia_de_risco" placeholder="Observações deste Risco" value="<?php echo $array['obs_ausencia_de_risco']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="outros" id="outros" type="checkbox" <?php echo $outros; ?>> Outros
                                </label>                        
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_outros" name="obs_outros" placeholder="Observações deste Risco" value="<?php echo $array['obs_outros']; ?>">
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
                                    <input name="exame_clinico" id="exame_clinico" type="checkbox" <?php echo $exame_clinico; ?>> EXAME CLÍNICO 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acido_metil_hipurico" id="acido_metil_hipurico" type="checkbox" <?php echo $acido_metil_hipurico; ?>> ÁCIDO METIL-HIPÚRICO 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="hemograma" id="hemograma" type="checkbox" <?php echo $hemograma; ?>> HEMOGRAMA 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acido_mandelico" id="acido_mandelico" type="checkbox" <?php echo $acido_mandelico; ?>> ÁCIDO MANDÉLICO 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="vdrl" id="vdrl" type="checkbox" <?php echo $vdrl; ?>> VDRL 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="reticulocitos" id="reticulocitos" type="checkbox" <?php echo $reticulocitos; ?>> RETICULÓCITOS 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="parasitologico_fezes" id="parasitologico_fezes" type="checkbox" <?php echo $parasitologico_fezes; ?>> PARASITOLÓGICO FEZES 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="cultural_de_orofaringe" id="cultural_de_orofaringe" type="checkbox" <?php echo $cultural_de_orofaringe; ?>> CULTURAL DE OROFARINGE 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="coprocultura" id="coprocultura" type="checkbox" <?php echo $coprocultura; ?>> COPROCULTURA 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="micologico_de_unha" id="micologico_de_unha" type="checkbox" <?php echo $micologico_de_unha; ?>> MICOLÓGICO DE UNHA 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="audiometria" id="audiometria" type="checkbox" <?php echo $audiometria; ?>> AUDIOMETRIA 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="ecg" id="ecg" type="checkbox" <?php echo $ecg; ?>> ECG 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acuidade_visual" id="acuidade_visual" type="checkbox" <?php echo $acuidade_visual; ?>> ACUIDADE VISUAL 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="eeg" id="eeg" type="checkbox" <?php echo $eeg; ?>> EEG 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="plaquetas" id="plaquetas" type="checkbox" <?php echo $plaquetas; ?>> PLAQUETAS 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="eritrograma" id="eritrograma" type="checkbox" <?php echo $eritrograma; ?>> ERITROGRAMA 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acido_tt_muconico" id="acido_tt_muconico" type="checkbox" <?php echo $acido_tt_muconico; ?>> ÁCIDO TT MUCÔNICO 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="glicemia_em_jejum" id="glicemia_em_jejum" type="checkbox" <?php echo $glicemia_em_jejum; ?>> GLICEMIA EM JEJUM 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acido_hipurico" id="acido_hipurico" type="checkbox" <?php echo $acido_hipurico; ?>> ÁCIDO HIPÚRICO 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="avaliacao_psicossocial" id="avaliacao_psicossocial" type="checkbox" <?php echo $avaliacao_psicossocial; ?>> AVALIAÇÃO PSICOSSOCIAL 
                                </label>                                
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="anti_hbs" id="anti_hbs" type="checkbox" <?php echo $anti_hbs; ?>> Anti-HBs 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="hbs_ag" id="hbs_ag" type="checkbox" <?php echo $hbs_ag; ?>> HBs Ag 
                                </label>                                
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="anti_hbc" id="anti_hbc" type="checkbox" <?php echo $anti_hbc; ?>> Anti-HBc 
                                </label>                                
                            </div>
                        </td>                                    
                    </tr>
                </table>
            </div>                    
            <div class="form-group">
                <button class="btn btn-primary btn-dropbox" id="envias" type="submit">Editar Síntese <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
            </div>
        </form>
    </div>
    <div class="panel panel-footer" id="conteudo_definir"></div>
</div>