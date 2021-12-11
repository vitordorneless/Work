<?php
include '../config/database_mysql.php';
$pdo = Database::connect();
require '../Model/Usuario.php';
require '../Model/Permissoes.php';
session_start();
$user = new Permissoes();
$user->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$array = $user->Dados_Permissoess($user->get_id());
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {

        $("#form").submit(function () {
            return false;
        });
        $("#envias").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_definir_riscos").empty();
            var usuario = $("#usuario").val();            
            var usuario_cadastro = $("#usuario_cadastro").val();
            var super_admin = $("#super_admin").is(":checked") === true ? 1 : 0;
            var admin = $("#admin").is(":checked") === true ? 1 : 0;
            var lojas = $("#lojas").is(":checked") === true ? 1 : 0;
            var convocacao = $("#convocacao").is(":checked") === true ? 1 : 0;
            var cassi = $("#cassi").is(":checked") === true ? 1 : 0;
            var medicos_externo = $("#medicos_externo").is(":checked") === true ? 1 : 0;
            var medicos_walmart = $("#medicos_walmart").is(":checked") === true ? 1 : 0;
            var walmart_gerencial = $("#walmart_gerencial").is(":checked") === true ? 1 : 0;
            var cassi_gerencial = $("#cassi_gerencial").is(":checked") === true ? 1 : 0;
            var indicadores_cassi = $("#indicadores_cassi").is(":checked") === true ? 1 : 0;
            var indicadores_walmart = $("#indicadores_walmart").is(":checked") === true ? 1 : 0;
            var relatorios = $("#relatorios").is(":checked") === true ? 1 : 0;
            var herval = $("#herval").is(":checked") === true ? 1 : 0;
            var herval_gerencial = $("#herval_gerencial").is(":checked") === true ? 1 : 0;
            var herval_indicadores = $("#herval_indicadores").is(":checked") === true ? 1 : 0;
            var tst = $("#tst").is(":checked") === true ? 1 : 0;
            var tst_gerencial = $("#tst_gerencial").is(":checked") === true ? 1 : 0;
            var tst_indicadores = $("#tst_indicadores").is(":checked") === true ? 1 : 0;            
            var demandas = $("#demandas").is(":checked") === true ? 1 : 0;            

            $.ajax({
                type: "GET",
                dataType: "HTML",
                url: "../Controller/usuario_editar_permissao.php",
                data: "usuario=" + usuario + "&usuario_cadastro=" + usuario_cadastro + "&super_admin=" + super_admin + "&admin=" + admin +
                        "&lojas=" + lojas + "&convocacao=" + convocacao + "&cassi=" + cassi + "&medicos_externo=" + medicos_externo + "&medicos_walmart=" + medicos_walmart +
                        "&walmart_gerencial=" + walmart_gerencial + "&cassi_gerencial=" + cassi_gerencial + "&indicadores_cassi=" + indicadores_cassi + "&indicadores_walmart=" + indicadores_walmart + "&relatorios=" + relatorios + "&herval=" + herval +
                        "&herval_gerencial=" + herval_gerencial + "&herval_indicadores=" + herval_indicadores + "&tst=" + tst +
                        "&tst_gerencial=" + tst_gerencial + "&tst_indicadores=" + tst_indicadores + "&demandas=" + demandas,
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
    <div class="panel-heading"><h3 class="text-center"><strong>Editar</strong> Permissões ao Usuário Periódicos</h3></div>
    <div class="panel-body">
        <form id="form" method="POST">            
            <div class="form-group">
                <input type="hidden" id="usuario_cadastro" name="usuario_cadastro" value="<?php echo $_SESSION['user_id']; ?>">
                <input type="hidden" id="usuario" name="usuario" value="<?php echo $array['id_usuario']; ?>">                
                <table class="table table-striped">
                    <tr>                               
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="super_admin" id="super_admin" type="checkbox" <?php echo $array['super_admin'] == 1 ? 'checked' : ''; ?>> Super Administrador
                                </label>
                            </div>
                        </td>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="admin" id="admin" type="checkbox" <?php echo $array['admin'] == 1 ? 'checked' : ''; ?>> Administrador
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="lojas" id="lojas" type="checkbox" <?php echo $array['lojas'] == 1 ? 'checked' : ''; ?>> Lojas
                                </label>
                            </div>
                        </td>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="convocacao" id="convocacao" type="checkbox" <?php echo $array['convocacao'] == 1 ? 'checked' : ''; ?>> Convocação
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="cassi" id="cassi" type="checkbox" <?php echo $array['cassi'] == 1 ? 'checked' : ''; ?>> CASSI
                                </label>
                            </div>
                        </td>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="medicos_externo" id="medicos_externo" type="checkbox" <?php echo $array['medicos_externo'] == 1 ? 'checked' : ''; ?>> Médicos Externo
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="medicos_walmart" id="medicos_walmart" type="checkbox" <?php echo $array['medicos_walmart'] == 1 ? 'checked' : ''; ?>> Médicos Walmart
                                </label>
                            </div>
                        </td>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="walmart_gerencial" id="walmart_gerencial" type="checkbox" <?php echo $array['walmart_gerencial'] == 1 ? 'checked' : ''; ?>> Walmart Gerencial
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="cassi_gerencial" id="cassi_gerencial" type="checkbox" <?php echo $array['cassi_gerencial'] == 1 ? 'checked' : ''; ?>> CASSI Gerencial
                                </label>
                            </div>
                        </td>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="indicadores_cassi" id="indicadores_cassi" type="checkbox" <?php echo $array['indicadores_cassi'] == 1 ? 'checked' : ''; ?>> Indicadores CASSI
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="indicadores_walmart" id="indicadores_walmart" type="checkbox" <?php echo $array['indicadores_walmart'] == 1 ? 'checked' : ''; ?>> Indicadores Walmart
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="relatorios" id="relatorios" type="checkbox" <?php echo $array['relatorios'] == 1 ? 'checked' : ''; ?>> Relatórios
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="herval" id="herval" type="checkbox" <?php echo $array['herval'] == 1 ? 'checked' : ''; ?>> Herval
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="herval_gerencial" id="herval_gerencial" type="checkbox" <?php echo $array['herval_gerencial'] == 1 ? 'checked' : ''; ?>> Herval Gerencial
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="herval_indicadores" id="herval_indicadores" type="checkbox" <?php echo $array['herval_indicadores'] == 1 ? 'checked' : ''; ?>> Indicadores Herval
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="tst" id="tst" type="checkbox" <?php echo $array['tst'] == 1 ? 'checked' : ''; ?>> TST
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="tst_indicadores" id="tst_indicadores" type="checkbox" <?php echo $array['tst_indicadores'] == 1 ? 'checked' : ''; ?>> Indicadores TST
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="tst_gerencial" id="tst_gerencial" type="checkbox" <?php echo $array['tst_gerencial'] == 1 ? 'checked' : ''; ?>> Gerencial TST
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="demandas" id="demandas" type="checkbox" <?php echo $array['demandas'] == 1 ? 'checked' : ''; ?>> Demandas
                                </label>
                            </div>
                        </td>                        
                    </tr>
                </table>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-dropbox" id="envias" type="submit">Editar Permissões <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
            </div>
        </form>
    </div>
    <div class="panel panel-footer" id="conteudo_definir_riscos"></div>
</div>