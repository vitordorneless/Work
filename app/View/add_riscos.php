<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$riscos = new Riscos_Operations();
$wal_ativos = new Wal_Ativos();
$riscos->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_marca_exames = $riscos->Marca_Exames_Unico($riscos->get_id());
$array_marca_riscos = $riscos->Marca_Riscos_Unico($riscos->get_id());
$array_ativo = $wal_ativos->Dados_Wal_Ativos_id($riscos->get_id());
$obs_agente_fisico = $array_marca_riscos['obs_agente_fisico'] == NULL ? " " : $array_marca_riscos['obs_agente_fisico'];
$obs_agente_quimico = $array_marca_riscos['obs_agente_quimico'] == NULL ? " " : $array_marca_riscos['obs_agente_quimico'];
$obs_agente_biologico = $array_marca_riscos['obs_agente_biologico'] == NULL ? " " : $array_marca_riscos['obs_agente_biologico'];
$obs_agente_ergonomico = $array_marca_riscos['obs_agente_ergonomico'] == NULL ? " " : $array_marca_riscos['obs_agente_ergonomico'];
$obs_ausencia_de_risco = $array_marca_riscos['obs_ausencia_de_risco'] == NULL ? " " : $array_marca_riscos['obs_ausencia_de_risco'];
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
            $("#unico_definir_riscos").empty();            
            var trab_altura = $("#trab_altura").is(":checked") === true ? 1 : 0;
            var apto_trab_altura = $("#apto_trab_altura").is(":checked") === true ? 1 : 0;
            var acuidade_visual = $("#acuidade_visual").is(":checked") === true ? 1 : 0;            
            var id = $("#id").val();

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/add_riscos.php",
                data: "id=" + id + "&trab_altura=" + trab_altura + "&apto_trab_altura=" + apto_trab_altura + "&acuidade_visual=" + acuidade_visual,
                beforeSend: function () {
                    $("#unico_definir_riscos").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#unico_definir_riscos").html(response);
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="panel panel-fit panel-warning">
    <div class="panel-heading"><h3 class="text-center">Riscos</h3><p><?php echo $array_ativo['nome_funcionario']; ?></p></div>
    <div class="panel-body">
        <form id="form" method="POST">
            <div class="form-group">
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $riscos->get_id(); ?>">
                <table>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="agente_fisico" id="agente_fisico" type="checkbox" readonly="readonly" <?php $agente_fisico = $array_marca_riscos['agente_fisico'] == 1 ? 'checked' : '';
                                    echo $agente_fisico; ?>> Agentes Físicos 
                                </label>                    
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_agente_fisico" name="obs_agente_fisico" placeholder="Observações deste Risco" readonly="readonly" <?php echo $obs_agente_fisico; ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="agente_quimico" id="agente_quimico" type="checkbox" readonly="readonly" <?php $agente_quimico = $array_marca_riscos['agente_quimico'] == 1 ? 'checked' : '';
                                    echo $agente_quimico; ?>> Agentes Químicos 
                                </label>
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_agente_quimico" name="obs_agente_quimico" placeholder="Observações deste Risco" readonly="readonly" <?php echo $obs_agente_quimico; ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="agente_biologico" id="agente_biologico" type="checkbox" readonly="readonly" <?php $agente_biologico = $array_marca_riscos['agente_biologico'] == 1 ? 'checked' : '';
                                    echo $agente_biologico; ?>> Agentes Biológicos 
                                </label>
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_agente_biologico" name="obs_agente_biologico" placeholder="Observações deste Risco" readonly="readonly" <?php echo $obs_agente_biologico; ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="agente_ergonomico" id="agente_ergonomico" type="checkbox" readonly="readonly" <?php $agente_ergonomico = $array_marca_riscos['agente_ergonomico'] == 1 ? 'checked' : '';
                                    echo $agente_ergonomico; ?>> Agentes Ergonômicos 
                                </label>
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_agente_ergonomico" name="obs_agente_ergonomico" placeholder="Observações deste Risco" readonly="readonly" <?php echo $obs_agente_ergonomico; ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="ausencia_de_risco" id="ausencia_de_risco" type="checkbox" <?php $ausencia_de_risco = $array_marca_riscos['ausencia_de_risco'] == 1 ? 'checked' : '';
                                    echo $ausencia_de_risco; ?>> Ausência de Risco Ocupacional Específico 
                                </label>                        
                            </div>
                        </td>
                        <td style="width: 60%;">
                            <input type="text" class="form-control" id="obs_ausencia_de_risco" name="obs_ausencia_de_risco" placeholder="Observações deste Risco" readonly="readonly" <?php echo $obs_ausencia_de_risco; ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="trab_altura" id="trab_altura" type="checkbox"><strong> Trabalho em Altura</strong> 
                                </label>                        
                            </div>
                        </td>
                        <td style="width: 60%;">                            
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
                                    <input name="exame_clinico" id="exame_clinico" type="checkbox" readonly="readonly" <?php $exame_clinico = $array_marca_exames['exame_clinico'] == 1 ? 'checked' : '';
                                    echo $exame_clinico; ?>> EXAME CLÍNICO 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acido_metil_hipurico" id="acido_metil_hipurico" type="checkbox" readonly="readonly" <?php $acido_metil_hipurico = $array_marca_exames['acido_metil_hipurico'] == 1 ? 'checked' : '';
                                    echo $acido_metil_hipurico; ?>> ÁCIDO METIL-HIPÚRICO 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="hemograma" id="hemograma" type="checkbox" readonly="readonly" <?php $hemograma = $array_marca_exames['hemograma'] == 1 ? 'checked' : '';
                                    echo $hemograma; ?>> HEMOGRAMA 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acido_mandelico" id="acido_mandelico" type="checkbox" readonly="readonly" <?php $acido_mandelico = $array_marca_exames['acido_mandelico'] == 1 ? 'checked' : '';
                                    echo $acido_mandelico; ?>> ÁCIDO MANDÉLICO 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="vdrl" id="vdrl" type="checkbox" readonly="readonly" <?php $vdrl = $array_marca_exames['vdrl'] == 1 ? 'checked' : '';
                                    echo $vdrl; ?>> VDRL 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="reticulocitos" id="reticulocitos" type="checkbox" readonly="readonly" <?php $reticulocitos = $array_marca_exames['reticulocitos'] == 1 ? 'checked' : '';
                                    echo $reticulocitos; ?>> RETICULÓCITOS 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="parasitologico_fezes" id="parasitologico_fezes" type="checkbox" readonly="readonly" <?php $parasitologico_fezes = $array_marca_exames['parasitologico_fezes'] == 1 ? 'checked' : '';
                                    echo $parasitologico_fezes; ?>> PARASITOLÓGICO FEZES 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="cultural_de_orofaringe" id="cultural_de_orofaringe" type="checkbox" readonly="readonly" <?php $cultural_de_orofaringe = $array_marca_exames['cultural_de_orofaringe'] == 1 ? 'checked' : '';
                                    echo $cultural_de_orofaringe; ?>> CULTURAL DE OROFARINGE 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="coprocultura" id="coprocultura" type="checkbox" readonly="readonly" <?php $coprocultura = $array_marca_exames['coprocultura'] == 1 ? 'checked' : '';
                                    echo $coprocultura; ?>> COPROCULTURA 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="micologico_de_unha" id="micologico_de_unha" type="checkbox" readonly="readonly" <?php $micologico_de_unha = $array_marca_exames['micologico_de_unha'] == 1 ? 'checked' : '';
                                    echo $micologico_de_unha; ?>> MICOLÓGICO DE UNHA 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="audiometria" id="audiometria" type="checkbox" readonly="readonly" <?php $audiometria = $array_marca_exames['audiometria'] == 1 ? 'checked' : '';
                                    echo $audiometria; ?>> AUDIOMETRIA 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="ecg" id="ecg" type="checkbox" readonly="readonly" <?php $ecg = $array_marca_exames['ecg'] == 1 ? 'checked' : '';
                                    echo $ecg; ?>> ECG 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acuidade_visual" id="acuidade_visual" type="checkbox" readonly="readonly" <?php $acuidade_visual = $array_marca_exames['acuidade_visual'] == 1 ? 'checked' : '';
                                    echo $acuidade_visual; ?>> <strong>ACUIDADE VISUAL</strong> 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="eeg" id="eeg" type="checkbox" readonly="readonly" <?php $eeg = $array_marca_exames['eeg'] == 1 ? 'checked' : '';
                                    echo $eeg; ?>> EEG 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="plaquetas" id="plaquetas" type="checkbox" readonly="readonly" <?php $plaquetas = $array_marca_exames['plaquetas'] == 1 ? 'checked' : '';
                                    echo $plaquetas; ?>> PLAQUETAS 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="eritrograma" id="eritrograma" type="checkbox" readonly="readonly" <?php $eritrograma = $array_marca_exames['eritrograma'] == 1 ? 'checked' : '';
                                    echo $eritrograma; ?>> ERITROGRAMA 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acido_tt_muconico" id="acido_tt_muconico" type="checkbox" readonly="readonly" <?php $acido_tt_muconico = $array_marca_exames['acido_tt_muconico'] == 1 ? 'checked' : '';
                                    echo $acido_tt_muconico; ?>> ÁCIDO TT MUCÔNICO 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="glicemia_em_jejum" id="glicemia_em_jejum" type="checkbox" readonly="readonly" <?php $glicemia_em_jejum = $array_marca_exames['glicemia_em_jejum'] == 1 ? 'checked' : '';
                                    echo $glicemia_em_jejum; ?>> GLICEMIA EM JEJUM 
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="acido_hipurico" id="acido_hipurico" type="checkbox" readonly="readonly" <?php $acido_hipurico = $array_marca_exames['acido_hipurico'] == 1 ? 'checked' : '';
                                    echo $acido_hipurico; ?>> ÁCIDO HIPÚRICO 
                                </label>                                
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="avaliacao_psicossocial" id="avaliacao_psicossocial" type="checkbox" readonly="readonly" <?php $avaliacao_psicossocial = $array_marca_exames['avaliacao_psicossocial'] == 1 ? 'checked' : '';
                                    echo $avaliacao_psicossocial; ?>> AVALIAÇÃO PSICOSSOCIAL 
                                </label>                                
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="apto_trab_altura" id="apto_trab_altura" type="checkbox"><strong> APTO TRABALHAR EM ALTURA</strong> 
                                </label>                                
                            </div>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Definir Riscos e Exames Complementares para este Indivíduo <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
            </div>
        </form>
    </div>
    <div class="panel panel-footer" id="unico_definir_riscos"></div>
</div>