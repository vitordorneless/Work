<?php
session_start();
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {

        $('#empresa').change(function () {
            $('#estabelecimento').load('../Controller/combo_2016_estabelecimento.php?empresa=' + $('#empresa').val());
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
            var empresa = $("#empresa").val();
            var estabelecimento = $("#estabelecimento").val();
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

            if (($("#empresa").val() !== 'na') && ($("#estabelecimento").val() === '0')) {
                $("#estabelecimento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha um Estabelecimento...</div>"),
                $("#estabelecimento").focus();
                return false;
            } else {
                $("#estabelecimento_error").empty();
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
                url: "../Controller/convocar_lojas_adicionar.php",
                data: "tipo_convocacao=" + tipo_convocacao + "&kit_entregue=" + kit_entregue + "&obs=" + obs +
                            "&empresa=" + empresa + "&estabelecimento=" + estabelecimento + "&turnos=" + turnos + "&vencimento_anterior=" + vencimento_anterior +
                    "&resp_walmart=" + resp_walmart + "&ativos_loja=" + ativos_loja + "&atendimentos=" + atendimentos,
                beforeSend: function () {
                    $("#conteudo_convocar_loja").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_convocar_loja").html(response).hide(30090),
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
            <h2 class="text-center"><strong>Convocar</strong> Loja</h2>
            <div class="additional-btn">
                <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
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
                            include '../config/database_mysql.php';
                            $pdo = Database::connect();
                            $sql1 = "select id, nome_convocacao from convocacao where status = 1 order by nome_convocacao";
                            foreach ($pdo->query($sql1) as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['nome_convocacao'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="tipo_convocacao_error"></div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="kit_entregue" name="kit_entregue"> Kit Entregue
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="label_obs">Observação:</label>
                            <textarea class="form-control" id="obs" name="obs"></textarea>
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
                                echo '<option value="' . $value['cod_empresa'] . '">' . $value['desc_empresas'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="empresa_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="estabelecimento_label">Estabelecimento:</label>
                        <select class="form-control selectpicker" id="estabelecimento" name="estabelecimento" required>
                            <option selected value="na">
                                Aguardando...
                            </option>
                        </select>
                        <div class="form-inline" id="estabelecimento_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_turnos">Turnos:</label>
                        <input type="number" class="form-control" id="turnos" name="turnos" placeholder="Turnos" min="1" max="200">
                        <div class="form-inline" id="turnos_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_Dia">Vencimento Anterior:</label>
                        <input type="date" class="form-control" id="vencimento_anterior" name="vencimento_anterior">
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
                                echo '<option value="' . $value['id'] . '">' . $value['nome_responsavel'] . '</option>';
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