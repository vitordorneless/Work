<?php
include '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$evento = new Evento_Convocacao();
$array_medico = $evento->Dados_Evento_Convocacao(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {
        
        $("#fechar_modal").click(function () {
            $("#refresca_setores_AMA").load('convocar_lojas_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_setores_AMA").load('convocar_lojas_listar.php');
            }
        });        
        
        var id_loja = '<?php echo $array_medico['loja']; ?>';        
        $('#id_loja').load('../Controller/combo_2016_estabelecimento_selected.php?empresa=' + $('#empresa').val() + "&id_loja=" + id_loja);
        
        $('#empresa').change(function () {
            $('#id_loja').load('../Controller/combo_2016_estabelecimento.php?empresa=' + $('#empresa').val());
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_convocar_loja").empty();
            var tipo_convocacao = $("#tipo_convocacao").val();
            var kit_entregue = $("#kit_entregue").is(":checked") === true ? 1 : 0;
            var obs = $("#obs").val();
            var id = $("#id").val();
            var empresa = $("#empresa").val();
            var id_loja = $("#id_loja").val();
            var turnos = $("#turnos").val();
            var vencimento_anterior = $("#vencimento_anterior").val();
            var resp_walmart = $("#resp_walmart").val();
            var ativos_loja = $("#ativos_loja").val();
            var atendimentos = $("#atendimentos").val();            

            if ($("#kit_entregue").is(":checked") === true)
            {
                if ($("#obs").val() === '') {
                    $("#obs_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Observação...</div>"),
                    $("#obs").focus();
                    return false;
                } else {
                    $("#obs_error").empty();
                }
            }
            
            if ($("#obs").val() === '') {
                obs = "Não informado";
            }

            if ($("#turnos").val() === '') {
                $("#turnos_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha a quantidade de Turnos...</div>"),
                        $("#turnos").focus();
                return false;
            } else {
                $("#turnos_error").empty();
            }
            
            if ($("#vencimento_anterior").val() === '') {
                $("#vencimento_anterior_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha Vencimento Anterior...</div>"),
                $("#vencimento_anterior").focus();
                return false;
            } else {
                $("#vencimento_anterior").empty();
            }
            
            if ($("#tipo_convocacao").val() === 'na') {
                $("#tipo_convocacao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha o tipo de Convocação...</div>"),
                $("#tipo_convocacao").focus();
            return false;
            } else {
                $("#tipo_convocacao_error").empty();
            }

            if ($("#empresa").val() === 'na') {
                $("#empresa_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha uma Empresa...</div>"),
                $("#empresa").focus();
                return false;
                } else {
                $("#empresa_error").empty();
            }

            if (($("#empresa").val() !== 'na') && ($("#id_loja").val() === '0')) {
                $("#id_loja_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha um Estabelecimento...</div>"),
                $("#id_loja").focus();
                return false;
            } else {
                $("#id_loja_error").empty();
            }

            if ($("#resp_walmart").val() === 'na') {
                $("#resp_walmart_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha um Responsável...</div>"),
                $("#resp_walmart").focus();
                return false;
            } else {
                $("#resp_walmart_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/convocar_lojas_editar.php",
                data: "tipo_convocacao=" + tipo_convocacao + "&kit_entregue=" + kit_entregue + "&obs=" + obs +
                            "&empresa=" + empresa + "&id_loja=" + id_loja + "&turnos=" + turnos + "&vencimento_anterior=" + vencimento_anterior +
                    "&resp_walmart=" + resp_walmart + "&ativos_loja=" + ativos_loja + "&atendimentos=" + atendimentos + "&id=" + id,
                beforeSend: function () {
                    $("#conteudo_convocar_loja").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_convocar_loja").html(response),
                    $("#form")[0].reset();
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="row">
    <div class="widget">
        <div class="widget-header transparent">
            <h2 class="text-center"><strong>Editar Convocação</strong> Loja</h2>
            <div class="additional-btn">                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
            </div>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form id="form" method="POST">
                    <div class="form-group">
                        <label for="convocacao_label">Tipo de Convocação:</label>
                        <select class="form-control selectpicker" id="tipo_convocacao" name="tipo_convocacao" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php                            
                            $pdo = Database::connect();
                            $sql1 = "select id, nome_convocacao from convocacao where status = 1 order by nome_convocacao";
                            foreach ($pdo->query($sql1) as $value) {
                                $option = $value['id'] == $array_medico['id_convocacao'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                                echo '<option ' . $option . '>' . $value['nome_convocacao'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="tipo_convocacao_error"></div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="kit_entregue" name="kit_entregue" <?php echo $array_medico['kit_entregue'] == 1 ? 'checked' : ''; ?>> Kit Entregue
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="label_obs">Observação:</label>
                            <textarea class="form-control" id="obs" name="obs"><?php echo $array_medico['observacao']; ?></textarea>
                            <div class="form-inline" id="obs_error"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="empresa_label">Empresa:</label>
                        <select class="form-control selectpicker" id="empresa" name="empresa" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            $sql = "SELECT cod_empresa, concat(cod_empresa,' - ',desc_empresa) as desc_empresas FROM wal_empresa_2016 ORDER BY desc_empresa ASC";
                            foreach ($pdo->query($sql) as $value) {
                                $option = $value['cod_empresa'] == $array_medico['empresa'] ? 'value="' . $value['cod_empresa'] . '" selected' : 'value="' . $value['cod_empresa'] . '"';
                                echo '<option ' . $option . '>' . $value['desc_empresas'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="empresa_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="id_loja_label">Estabelecimento:</label>
                        <select class="form-control selectpicker" id="id_loja" name="id_loja" required>
                            <option selected value="na">
                                Aguardando...
                            </option>
                        </select>
                        <div class="form-inline" id="id_loja_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_turnos">Turnos:</label>
                        <input type="number" class="form-control" id="turnos" name="turnos" placeholder="Turnos" min="1" max="200" value="<?php echo $array_medico['turnos']; ?>">
                        <input type="hidden" id="id" name="id" value="<?php echo $array_medico['id']; ?>">
                        <div class="form-inline" id="turnos_error"></div>
                    </div>
                    <div class="form-group">
                        <?php
                        $format_data = trim($array_medico['vencimento_anterior']);
                        $date_format = date("Y-m-d", strtotime($format_data));
            ?>
                        <label for="label_Dia">Vencimento Anterior:</label>
                        <input type="date" class="form-control" id="vencimento_anterior" name="vencimento_anterior" value="<?php echo $date_format; ?>">
                        <input type="hidden" class="form-control" id="ativos_loja" name="ativos_loja" value="0" readonly>
                        <input type="hidden" class="form-control" id="atendimentos" name="atendimentos" value="0" readonly>
                        <div class="form-inline" id="vencimento_anterior_error"></div>
                    </div>                    
                    <div class="form-group">
                        <label for="responsavel_walmart_label">Responsável Walmart:</label>
                        <select class="form-control selectpicker" id="resp_walmart" name="resp_walmart" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            $sql2 = "SELECT id, nome_responsavel FROM responsaveis_walmart ORDER BY nome_responsavel ASC";
                            foreach ($pdo->query($sql2) as $value) {
                                $option = $value['id'] == $array_medico['id_responsavel_walmart'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                                echo '<option ' . $option . '>' . $value['nome_responsavel'] . '</option>';                                
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <div class="form-inline" id="resp_walmart_error"></div>
                    </div>
                    <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Convocar Loja <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span></button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_convocar_loja"></div>
        </div>        
    </div>
</div>