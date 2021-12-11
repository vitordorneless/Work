<?php
include '../config/database_mysql.php';
$pdo = Database::connect();
session_start();
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
            var demandas = $("#demandas").is(":checked") === true ? 1 : 0;
            var tst_indicadores = $("#tst_indicadores").is(":checked") === true ? 1 : 0;
            
            if ($("#usuario").val() === 'na') {
                $("#usuario_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha o Usuário...</div>"),
                $("#usuario").focus();
            return false;
            } else {
                $("#usuario_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/usuario_adicionar_permissao.php",
                data: "usuario=" + usuario + "&usuario_cadastro=" + usuario_cadastro + "&super_admin=" + super_admin + "&admin=" + admin +
                        "&lojas=" + lojas + "&convocacao=" + convocacao + "&cassi=" + cassi + "&medicos_externo=" + medicos_externo + "&medicos_walmart=" + medicos_walmart +
                        "&walmart_gerencial=" + walmart_gerencial + "&cassi_gerencial=" + cassi_gerencial + "&indicadores_cassi=" + indicadores_cassi + "&indicadores_walmart=" + indicadores_walmart + "&relatorios=" + relatorios + "&herval=" + herval + 
                        "&herval_gerencial=" + herval_gerencial + "&herval_indicadores=" + herval_indicadores + "&tst=" + tst + 
                        "&tst_gerencial=" + tst_gerencial + "&tst_indicadores=" + tst_indicadores + "&demandas=" + demandas,
                beforeSend: function () {
                    $("#conteudo_definir_riscos").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_definir_riscos").html(response),
                    $("#form")[0].reset();
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="panel panel-fit panel-warning">
    <div class="panel-heading"><h3 class="text-center"><strong>Adicionar</strong> Permissões ao Usuário Periódicos</h3></div>
    <div class="panel-body">
        <form id="form" method="POST">
            <div class="form-group">
                <label for="usuario_label">Usuário:</label>
                <select class="form-control" id="usuario" name="usuario">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql = "SELECT id, nome_extenso FROM usuarios ORDER BY nome_extenso ASC";
                    foreach ($pdo->query($sql) as $value) {
                        echo '<option value="' . $value['id'] . '">' . $value['nome_extenso'] . '</option>';
                    }
                    Database::disconnect();
                    ?>
                </select>                
                <div class="form-inline" id="usuario_error"></div>
            </div>
            <div class="form-group">
                <input type="hidden" id="usuario_cadastro" name="usuario_cadastro" value="<?php echo $_SESSION['user_id']; ?>">                
                <table class="table table-striped">
                    <tr class="hidden">                        
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="admin" id="admin" type="checkbox"> Administrador
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr class="hidden">                                
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="lojas" id="lojas" type="checkbox"> Lojas
                                </label>
                            </div>
                        </td>                                
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="convocacao" id="convocacao" type="checkbox"> Convocação
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr class="hidden">                                
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="cassi" id="cassi" type="checkbox"> CASSI
                                </label>
                            </div>
                        </td>                                
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="medicos_externo" id="medicos_externo" type="checkbox"> Médicos Externo
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr class="hidden">                                
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="medicos_walmart" id="medicos_walmart" type="checkbox"> Médicos Walmart
                                </label>
                            </div>
                        </td>                                
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="walmart_gerencial" id="walmart_gerencial" type="checkbox"> Walmart Gerencial
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr class="hidden">                                
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="cassi_gerencial" id="cassi_gerencial" type="checkbox"> CASSI Gerencial
                                </label>
                            </div>
                        </td>                                
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="indicadores_cassi" id="indicadores_cassi" type="checkbox"> Indicadores CASSI
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr class="hidden">                                
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="indicadores_walmart" id="indicadores_walmart" type="checkbox"> Indicadores Walmart
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="relatorios" id="relatorios" type="checkbox"> Relatórios
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr class="hidden">                                
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="herval" id="herval" type="checkbox"> Herval
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="herval_gerencial" id="herval_gerencial" type="checkbox"> Herval Gerencial
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr class="hidden">                                
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="herval_indicadores" id="herval_indicadores" type="checkbox"> Indicadores Herval
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="tst" id="tst" type="checkbox"> TST
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr class="hidden">                                
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="tst_indicadores" id="tst_indicadores" type="checkbox"> Indicadores TST
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox hidden">
                                <label>
                                    <input name="tst_gerencial" id="tst_gerencial" type="checkbox"> Gerencial TST
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="super_admin" id="super_admin" type="checkbox"> Super Administrador
                                </label>
                            </div>
                        </td>                                
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="demandas" id="demandas" type="checkbox"> Demandas
                                </label>
                            </div>
                        </td>                        
                    </tr>
                </table>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Salvar Permissões <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
            </div>
        </form>
    </div>
    <div class="panel panel-footer" id="conteudo_definir_riscos"></div>
</div>