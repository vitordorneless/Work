<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script src="../js/maskMoney.js"></script>
<script>
    $(document).ready(function () {
        
        $("#fechar_modal").click(function () {
            $("#refresca_herval").load('herval_agendamento_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_herval").load('herval_agendamento_listar.php');
            }
        });

        $("input.dinheiro").maskMoney({showSymbol: false, decimal: ",", thousands: "."});

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var unidade = $("#unidade").val();
            var id_tipo_agendamento = $("#id_tipo_agendamento").val();
            var data_agendamento = $("#data_agendamento").val();            
            var situacao = $("#situacao").val();
            var medico = $("#medico").val();
            var consulta = $("#consulta").val();

            if ($("#unidade").val() === 'na')
            {
                $("#unidade_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Município...</div>"),
                        $("#unidade").focus();
                return false;
            } else {
                $("#unidade_error").empty();
            }
            
            if ($("#id_tipo_agendamento").val() === 'na')
            {
                $("#id_tipo_agendamento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Tipo de agendamento...</div>"),
                        $("#id_tipo_agendamento").focus();
                return false;
            } else {
                $("#id_tipo_agendamento_error").empty();
            }

            if ($("#data_agendamento").val() === '')
            {
                $("#data_agendamento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Data do Agendamento...</div>"),
                        $("#data_agendamento").focus();
                return false;
            } else {
                $("#data_agendamento_error").empty();
            }            

            if ($("#situacao").val() === 'na')
            {
                $("#situacao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Situação...</div>"),
                        $("#situacao").focus();
                return false;
            } else {
                $("#situacao_error").empty();
            }

            if ($("#medico").val() === 'na')
            {
                $("#medico_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Médico...</div>"),
                        $("#medico").focus();
                return false;
            } else {
                $("#medico_error").empty();
            }

            if ($("#consulta").val() === '')
            {
                $("#consulta_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Valor da Consulta...</div>"),
                        $("#consulta").focus();
                return false;
            } else {
                $("#consulta_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/herval_agendamento_incluir.php",
                data: "unidade=" + unidade + "&data_agendamento=" + data_agendamento + "&situacao=" + situacao + "&medico=" + medico +
                        "&consulta=" + consulta + "&id_tipo_agendamento=" + id_tipo_agendamento,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                            $("#form")[0].reset();
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">
    <h2><strong>Marcar</strong> Agendamento Herval</h2>
    <div class="additional-btn">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    </div>
</div>
<div class="modal-body">
    <div id="basic-form">
        <form id="form" method="POST">
            <div class="form-group">
                <label for="label_municipio">Unidade:</label>
                <select class="form-control" id="unidade" name="unidade" required>
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    include '../config/database_mysql.php';
                    $pdo = Database::connect();
                    $sql = "select id, unidade from herval_unidades where status = 1 order by cod_unidade asc";
                    foreach ($pdo->query($sql) as $value) {
                        echo '<option value="' . $value['id'] . '">' . $value['unidade'] . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="unidade_error"></div>
            </div>
            <div class="form-group">
                <label for="label_municipio">Tipo de Agendamento:</label>
                <select class="form-control" id="id_tipo_agendamento" name="id_tipo_agendamento">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php                    
                    $sql5 = "select id, nome_agendamento from herval_tipos_agendamentos where status = 1 order by nome_agendamento asc";
                    foreach ($pdo->query($sql5) as $value) {
                        echo '<option value="' . $value['id'] . '">' . $value['nome_agendamento'] . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tipo_agendamento_error"></div>
            </div>
            <div class="form-group">
                <label for="label_data_agendamento">Data do Agendamento:</label>
                <div class="input-group">
                    <input type="date" class="form-control" id="data_agendamento" name="data_agendamento">
                </div>
                <div class="form-inline" id="data_agendamento_error"></div>
            </div>
            <div class="form-group">
                <label for="label_situacao">Situação:</label>
                <select class="form-control" id="situacao" name="situacao">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql1 = "select id, situacao from herval_situacao_agendamento where status = 1 order by situacao asc";
                    foreach ($pdo->query($sql1) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['situacao']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="situacao_error"></div>
            </div>
            <div class="form-group">
                <label for="label_medico">Médico:</label>
                <select class="form-control" id="medico" name="medico" required>
                    <option selected value="na">
                        Selecione...
                    </option>
                    <option value="0">
                        Buscando...
                    </option>
                    <?php
                    $sql2 = "select id_medico, nome from wal_medico order by id_medico asc";
                    foreach ($pdo->query($sql2) as $value) {
                        echo '<option value="' . $value['id_medico'] . '">' . utf8_encode($value['nome']) . '</option>';
                    }
                    Database::disconnect();
                    ?>
                </select>
                <div class="form-inline" id="medico_error"></div>
            </div>
            <div class="form-group">
                <label for="label_consulta">Valor da Consulta:</label>
                <div class="input-group">
                    <span class="input-group-addon">R$</span>
                    <input type="text" class="form-control dinheiro" id="consulta" name="consulta" placeholder="Informe Valor Acertado" value="45,00">
                </div>
                <div class="form-inline" id="consulta_error"></div>
            </div>
            <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Salvar Agendamento Herval <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
        </form>
    </div>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>