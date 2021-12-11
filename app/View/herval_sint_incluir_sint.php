<?php
include '../Model/Herval.php';
include '../Model/Herval_Sintese_Cabecalho.php';
$herval = new Herval_Sintese_Cabecalho();
$herval->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_herval_solicitante").load('herval_sint_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_herval_solicitante").load('herval_sint_listar.php');
            }
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_definir_riscos").empty();
            var id_sinte_cab = $("#id_sinte_cab").val();
            var id_herval_setor = $("#id_herval_setor").val();
            var id_herval_funcao = $("#id_herval_funcao").val();
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
            var obs_1 = $("#obs_1").is(":checked") === true ? 1 : 0;
            var obs_2 = $("#obs_2").is(":checked") === true ? 1 : 0;
            var obs_3 = $("#obs_3").is(":checked") === true ? 1 : 0;
            var obs_4 = $("#obs_4").is(":checked") === true ? 1 : 0;
            var obs_5 = $("#obs_5").is(":checked") === true ? 1 : 0;
            var obs_6 = $("#obs_6").is(":checked") === true ? 1 : 0;
            var obs_7 = $("#obs_7").is(":checked") === true ? 1 : 0;
            var obs_8 = $("#obs_8").is(":checked") === true ? 1 : 0;
            var obs_agente_fisico = $("#obs_agente_fisico").val() === '' ? 'Não informado' : $("#obs_agente_fisico").val();
            var obs_agente_quimico = $("#obs_agente_quimico").val() === '' ? 'Não informado' : $("#obs_agente_quimico").val();
            var obs_agente_biologico = $("#obs_agente_biologico").val() === '' ? 'Não informado' : $("#obs_agente_biologico").val();
            var obs_agente_ergonomico = $("#obs_agente_ergonomico").val() === '' ? 'Não informado' : $("#obs_agente_ergonomico").val();
            var obs_ausencia_de_risco = $("#obs_ausencia_de_risco").val() === '' ? 'Não informado' : $("#obs_ausencia_de_risco").val();
            
            if ($("#id_herval_funcao").val() === 'na')
            {
                $("#id_herval_funcao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Função...</div>"),
                        $("#id_herval_funcao").focus();
                return false;
            } else {
                $("#id_herval_funcao_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/herval_sint_incluir_sint.php",
                data: "id_sinte_cab=" + id_sinte_cab + "&agente_fisico=" + agente_fisico + "&agente_quimico=" + agente_quimico + "&agente_biologico=" + agente_biologico + "&agente_ergonomico=" + agente_ergonomico + "&ausencia_de_risco=" + ausencia_de_risco +
                      "&exame_clinico=" + exame_clinico + "&acido_metil_hipurico=" + acido_metil_hipurico + "&hemograma=" + hemograma + "&acido_mandelico=" + acido_mandelico + "&vdrl=" + vdrl + "&reticulocitos=" + reticulocitos +
                      "&parasitologico_fezes=" + parasitologico_fezes + "&cultural_de_orofaringe=" + cultural_de_orofaringe + "&coprocultura=" + coprocultura + "&micologico_de_unha=" + micologico_de_unha + "&audiometria=" + audiometria + "&ecg=" + ecg +
                      "&acuidade_visual=" + acuidade_visual + "&eeg=" + eeg + "&plaquetas=" + plaquetas + "&eritrograma=" + eritrograma + "&acido_tt_muconico=" + acido_tt_muconico + "&glicemia_em_jejum=" + glicemia_em_jejum +
                      "&acido_hipurico=" + acido_hipurico + "&obs_agente_fisico=" + obs_agente_fisico + "&obs_agente_quimico=" + obs_agente_quimico + "&obs_agente_biologico=" + obs_agente_biologico +
                      "&obs_agente_ergonomico=" + obs_agente_ergonomico + "&obs_ausencia_de_risco=" + obs_ausencia_de_risco + "&avaliacao_psicossocial=" + avaliacao_psicossocial +
                      "&obs_1=" + obs_1 + "&obs_2=" + obs_2 + "&obs_3=" + obs_3 + "&obs_4=" + obs_4 + "&obs_5=" + obs_4 + "&obs_5=" + obs_5 +
                      "&obs_6=" + obs_6 + "&obs_7=" + obs_7 + "&obs_8=" + obs_8 + "&id_herval_funcao=" + id_herval_funcao + "&id_herval_setor=" + id_herval_setor,
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
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    <h4 class="modal-title">Inserir Síntese</h4>
</div>
<div class="modal-body">
    <div class="panel panel-fit panel-warning">
        <div class="panel-heading"><h3 class="text-center">Riscos</h3></div>
        <div class="panel-body">
            <form id="form" method="POST">
                <div class="form-group">
                <label for="label_municipio">Setor:</label>
                <select class="form-control" id="id_herval_setor" name="id_herval_setor">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    include '../config/database_mysql.php';
                    $pdo = Database::connect();
                    $sql1 = "select id, setor from herval_setores where status = 1 order by setor asc";
                    foreach ($pdo->query($sql1) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['setor']) . '</option>';
                    }                    
                    ?>
                </select>
                <div class="form-inline" id="id_herval_setor_error"></div>
            </div>
                <div class="form-group">
                <label for="label_municipio">Função:</label>
                <select class="form-control" id="id_herval_funcao" name="id_herval_funcao" required>
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php                    
                    $sql = "select id, funcao from herval_funcao where status = 1 order by funcao asc";
                    foreach ($pdo->query($sql) as $value) {
                        echo '<option value="' . $value['id'] . '">' . $value['funcao'] . '</option>';
                    }
                    Database::disconnect();
                    ?>
                </select>
                <div class="form-inline" id="id_herval_funcao_error"></div>
            </div>
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
                                <input name="id_sinte_cab" id="id_sinte_cab" type="hidden" value="<?php echo $herval->get_id(); ?>"> 
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
                    </table>
                </div>
                <div class="form-group">
                    <h3 class="text-center">Exames Complementares</h3>
                    <table>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input name="exame_clinico" id="exame_clinico" type="checkbox"> EXAME CLÍNICO 
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
                    </table>
                </div>
                <div class="form-group">
                    <table>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label class="text-justify">
                                        <input name="obs_1" id="obs_1" type="checkbox"> O Exame Clínico Ocupacional será realizado anualmente para os colaboradores menores de 18 anos e maiores de 45 anos e as funções que exigirem exames complementares. 
                                    </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label class="text-justify">
                                        <input name="obs_2" id="obs_2" type="checkbox"> Bienal para os demais colaboradores entre 18 e 45 anos.
                                    </label>                                
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label class="text-justify">
                                        <input name="obs_3" id="obs_3" type="checkbox"> Exame com periodicidade anual para funcionários com idade inferior a 18 anos e superior a 45, demais com periodicidade bienal para funções sem risco ocupacional. Demais funções com periodicidade anual. 
                                    </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label class="text-justify">
                                        <input name="obs_4" id="obs_4" type="checkbox"> Exames com periodicidade anual para as funções com risco ocupacional Físico, Químico ou Biológico;
                                    </label>                                
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label class="text-justify">
                                        <input name="obs_5" id="obs_5" type="checkbox"> Demais:  Exame Clínico Ocupacional será realizado anualmente para os colaboradores menores de 18 anos e maiores de 45 anos e as funções que exigirem exames complementares.
                                    </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label class="text-justify">
                                        <input name="obs_6" id="obs_6" type="checkbox"> Realizar, na Mudança de Função, os exames Complementares conforme nova função;
                                    </label>                                
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label class="text-justify">
                                        <input name="obs_7" id="obs_7" type="checkbox"> Realizar, no Retorno ao Trabalho, o exame clínico ocupacional, e agendar exame periódico conforme o prazo de validade dos exames Complementares;
                                    </label>                                
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label class="text-justify">
                                        <input name="obs_8" id="obs_8" type="checkbox"> Exame com periodicidade anual para funcionários com idade inferior a 18 anos e superior a 45, demais com periodicidade bienal para funções sem risco ocupacional.
                                    </label>                                
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Definir Riscos e Exames desta Síntese <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
                </div>
            </form>
        </div>
        <div class="panel panel-footer" id="conteudo_definir_riscos"></div>
    </div>
</div>