<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax nÃ£o funciona-->
<script>
    $(document).ready(function () {

        $('#bandeira').change(function () {
            $('#setor').load('../Controller/combo_bandeira_setor.php?bandeira=' + $('#bandeira').val());
        });

        $('#setor').change(function () {
            $('#cargo').load('../Controller/combo_bandeira_cargo.php?setor=' + $('#setor').val() + '&bandeira=' + $('#bandeira').val());
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            $("#conteudo_lateral").empty();
            $("#conteudo_superior").empty();
            envia_form();
        });
        function envia_form() {
            $("#conteudo_periodico").empty();
            var bandeira = $("#bandeira").val();
            var setor = $("#setor").val();
            var cargo = $("#cargo").val();
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
            var anti_hbs = $("#anti_hbs").is(":checked") === true ? 1 : 0;
            var hbs_ag = $("#hbs_ag").is(":checked") === true ? 1 : 0;
            var anti_hbc = $("#anti_hbc").is(":checked") === true ? 1 : 0;        
            var obs_agente_fisico = $("#obs_agente_fisico").val();
            var obs_agente_quimico = $("#obs_agente_quimico").val();
            var obs_agente_biologico = $("#obs_agente_biologico").val();
            var obs_agente_ergonomico = $("#obs_agente_ergonomico").val();
            var obs_ausencia_de_risco = $("#obs_ausencia_de_risco").val();
            var obs_outros = $("#obs_outros").val();
            var outros = $("#outros").is(":checked") === true ? 1 : 0;
            
            if ($("#bandeira").val() === '0')
            {
                $("#error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(4000),
                        $("#bandeira").focus();
                return false;
            } else {
                $("#error").empty();
            }
            
            if ($("#setor").val() === 'na')
            {
                $("#error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(4000),
                        $("#setor").focus();
                return false;
            } else {
                $("#error").empty();
            }
            
            if ($("#cargo").val() === 'na')
            {
                $("#error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(4000),
                        $("#cargo").focus();
                return false;
            } else {
                $("#error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/definir_riscos_bandeira_adicionar.php",
                data: "bandeira=" + bandeira + "&setor=" + setor + "&cargo=" + cargo + 
                        "&agente_fisico=" + agente_fisico + "&agente_quimico=" + agente_quimico + "&agente_biologico=" + agente_biologico + "&agente_ergonomico=" + agente_ergonomico + "&ausencia_de_risco=" + ausencia_de_risco +
                        "&exame_clinico=" + exame_clinico + "&acido_metil_hipurico=" + acido_metil_hipurico + "&hemograma=" + hemograma + "&acido_mandelico=" + acido_mandelico + "&vdrl=" + vdrl + "&reticulocitos=" + reticulocitos +
                        "&parasitologico_fezes=" + parasitologico_fezes + "&cultural_de_orofaringe=" + cultural_de_orofaringe + "&coprocultura=" + coprocultura + "&micologico_de_unha=" + micologico_de_unha + "&audiometria=" + audiometria + "&ecg=" + ecg +
                        "&acuidade_visual=" + acuidade_visual + "&eeg=" + eeg + "&plaquetas=" + plaquetas + "&eritrograma=" + eritrograma + "&acido_tt_muconico=" + acido_tt_muconico + "&glicemia_em_jejum=" + glicemia_em_jejum +
                        "&acido_hipurico=" + acido_hipurico + "&obs_agente_fisico=" + obs_agente_fisico + "&obs_agente_quimico=" + obs_agente_quimico + "&obs_agente_biologico=" + obs_agente_biologico + 
                        "&obs_agente_ergonomico=" + obs_agente_ergonomico + "&obs_ausencia_de_risco=" + obs_ausencia_de_risco + "&avaliacao_psicossocial=" + avaliacao_psicossocial + 
                        "&outros=" + outros + "&obs_outros=" + obs_outros + "&anti_hbs=" + anti_hbs + "&hbs_ag=" + hbs_ag + "&anti_hbc=" + anti_hbc,
                beforeSend: function () {
                    $("#conteudo_periodico").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_periodico").html(response),
                            $("#form")[0].reset(),
                            $('#exame_clinico').prop("checked", true);
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<style type="text/css">
    #imgpos {
        position:absolute;
        left:667px;
    }
</style>
<div class="widget">
    <div class="widget-header transparent">
        <h2><strong>Listar Setores</strong><acronym title="Informe os campos para otimizar o resultado!!!"> Walmart</acronym></h2>
        <div class="additional-btn">            
            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>            
        </div>
    </div>
    <div class="widget-content padding">
        <div class="form-inline">
            <form id="form" method="POST">
                <div class="form-group">
                    <label>Bandeira:</label>
                    <select class="form-control" id="bandeira" name="bandeira" required autofocus="autofocus">
                        <option selected value="0">
                            Selecione...
                        </option>
                        <?php

                        function __autoload($file) {
                            if (file_exists('../Model/' . $file . '.php'))
                                require_once('../Model/' . $file . '.php');
                            else
                                exit('O arquivo ' . $file . ' não foi encontrado!');
                        }

                        $querie = new Queries();
                        include '../config/database_mysql.php';
                        $pdo = Database::connect();
                        foreach ($pdo->query($querie->listar_bandeiras()) as $value) {
                            echo '<option value="' . $value['id'] . '">' .$value['bandeira'] . '</option>';
                        }
                        Database::disconnect();
                        ?>
                    </select>
                    <div class="form-inline" id="error"></div>
                </div>
                <div class="form-group">
                    <label>Setor(es):</label>
                    <select class="form-control" id="setor" name="setor" required>
                        <option selected value="na">
                            Aguardando...
                        </option>
                    </select>
                </div><br><br>
                <div class="form-group">
                    <label>Cargo(s):</label>
                    <select multiple="multiple" class="form-control" id="cargo" name="cargo" style="min-width: 740px; min-height: 120px">
                        <option selected value="na">
                            Aguardando...
                        </option>
                    </select>
                </div>                    
                <div class="panel panel-fit panel-warning">
                    <div class="panel-heading"><h3 class="text-center">Riscos</h3></div>
                    <div class="panel-body">            
                        <div class="form-group">                    
                            <table>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="agente_fisico" id="agente_fisico" type="checkbox"> Agentes Físicos                         
                                            </label>                    
                                        </div>
                                    </td>
                                    <td style="width: 60%;">
                                        <input type="text" class="form-control" id="obs_agente_fisico" name="obs_agente_fisico" placeholder="Observações deste Risco">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="agente_quimico" id="agente_quimico" type="checkbox"> Agentes Químicos 
                                            </label>
                                        </div>
                                    </td>
                                    <td style="width: 60%;">
                                        <input type="text" class="form-control" id="obs_agente_quimico" name="obs_agente_quimico" placeholder="Observações deste Risco">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="agente_biologico" id="agente_biologico" type="checkbox"> Agentes Biológicos 
                                            </label>
                                        </div>
                                    </td>
                                    <td style="width: 60%;">
                                        <input type="text" class="form-control" id="obs_agente_biologico" name="obs_agente_biologico" placeholder="Observações deste Risco">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="agente_ergonomico" id="agente_ergonomico" type="checkbox"> Agentes Ergonômicos 
                                            </label>
                                        </div>
                                    </td>
                                    <td style="width: 60%;">
                                        <input type="text" class="form-control" id="obs_agente_ergonomico" name="obs_agente_ergonomico" placeholder="Observações deste Risco">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="ausencia_de_risco" id="ausencia_de_risco" type="checkbox"> Ausência de Risco Ocupacional Específico 
                                            </label>                        
                                        </div>
                                    </td>
                                    <td style="width: 60%;">
                                        <input type="text" class="form-control" id="obs_ausencia_de_risco" name="obs_ausencia_de_risco" placeholder="Observações deste Risco">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="outros" id="outros" type="checkbox"> Outros
                                            </label>                        
                                        </div>
                                    </td>
                                    <td style="width: 60%;">
                                        <input type="text" class="form-control" id="obs_outros" name="obs_outros" placeholder="Observações deste Risco">
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
                                                <input name="exame_clinico" id="exame_clinico" type="checkbox" checked="checked"> EXAME CLÍNICO 
                                            </label>                                
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="acido_metil_hipurico" id="acido_metil_hipurico" type="checkbox"> ÁCIDO METIL-HIPÚRICO 
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="hemograma" id="hemograma" type="checkbox"> HEMOGRAMA 
                                            </label>                                
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="acido_mandelico" id="acido_mandelico" type="checkbox"> ÁCIDO MANDÉLICO 
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="vdrl" id="vdrl" type="checkbox"> VDRL 
                                            </label>                                
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="reticulocitos" id="reticulocitos" type="checkbox"> RETICULÓCITOS 
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="parasitologico_fezes" id="parasitologico_fezes" type="checkbox"> PARASITOLÓGICO FEZES 
                                            </label>                                
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="cultural_de_orofaringe" id="cultural_de_orofaringe" type="checkbox"> CULTURAL DE OROFARINGE 
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="coprocultura" id="coprocultura" type="checkbox"> COPROCULTURA 
                                            </label>                                
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="micologico_de_unha" id="micologico_de_unha" type="checkbox"> MICOLÓGICO DE UNHA 
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="audiometria" id="audiometria" type="checkbox"> AUDIOMETRIA 
                                            </label>                                
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="ecg" id="ecg" type="checkbox"> ECG 
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="acuidade_visual" id="acuidade_visual" type="checkbox"> ACUIDADE VISUAL 
                                            </label>                                
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="eeg" id="eeg" type="checkbox"> EEG 
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="plaquetas" id="plaquetas" type="checkbox"> PLAQUETAS 
                                            </label>                                
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="eritrograma" id="eritrograma" type="checkbox"> ERITROGRAMA 
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="acido_tt_muconico" id="acido_tt_muconico" type="checkbox"> ÁCIDO TT MUCÔNICO 
                                            </label>                                
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="glicemia_em_jejum" id="glicemia_em_jejum" type="checkbox"> GLICEMIA EM JEJUM 
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="acido_hipurico" id="acido_hipurico" type="checkbox"> ÁCIDO HIPÚRICO 
                                            </label>                                
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="avaliacao_psicossocial" id="avaliacao_psicossocial" type="checkbox"> AVALIAÇÃO PSICOSSOCIAL 
                                            </label>                                
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="anti_hbs" id="anti_hbs" type="checkbox"> Anti-HBs 
                                            </label>                                
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="hbs_ag" id="hbs_ag" type="checkbox"> HBs Ag 
                                            </label>                                
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input name="anti_hbc" id="anti_hbc" type="checkbox"> Anti-HBc 
                                            </label>                                
                                        </div>
                                    </td>                                    
                                </tr>
                            </table>
                        </div>                    
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Definir Riscos e Exames Complementares <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
                </div>            
            </form>
        </div>
    </div>        
</div>
<div class="panel panel-footer" id="conteudo_periodico"></div>