<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script src="../js/maskMoney.js"></script>
<script>
    $(document).ready(function () {

        $("input.dinheiro").maskMoney({showSymbol: false, decimal: ",", thousands: "."});

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var agencia = $("#agencia").val();
            var data_agendamento = $("#data_agendamento").val();
            var horario_chegada = $("#horario_chegada").val();
            var situacao = $("#situacao").val();            
            var medico = $("#medico").val();
            var consulta = $("#consulta").val();            
            
            if ($("#agencia").val() === 'na')
            {
                $("#agencia_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Município...</div>"),
                $("#agencia").focus();
                return false;
            } else {
                $("#agencia_error").empty();
            }

            if ($("#data_agendamento").val() === '')
            {
                $("#data_agendamento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Data do Agendamento...</div>"),
                        $("#data_agendamento").focus();
                return false;
            } else {
                $("#data_agendamento_error").empty();
            }

            if ($("#horario_chegada").val() === '')
            {
                $("#horario_chegada_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Horário de Chegada...</div>"),
                        $("#horario_chegada").focus();
                return false;
            } else {
                $("#horario_chegada_error").empty();
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
                url: "../Controller/cassi_exames_marcar.php",
                data: "agencia=" + agencia + "&data_agendamento=" + data_agendamento + "&horario_chegada=" + horario_chegada + "&situacao=" + situacao + "&medico=" + medico +                        
                        "&consulta=" + consulta,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response)/*,
                    $("#form")[0].reset()*/;
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
            <h2><strong>Marcar</strong> Agendamento CASSI</h2>
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
                        <label for="label_municipio">Agência:</label>
                        <select class="form-control" id="agencia" name="agencia" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            include '../config/database_mysql.php';
                            $pdo = Database::connect();
                            $sql = "select id, prefixo, dependencia from cassi_agencia order by municipio";
                            foreach ($pdo->query($sql) as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['prefixo'] . ' - '.$value['dependencia'].'</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="agencia_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_data_agendamento">Data do Agendamento:</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="data_agendamento" name="data_agendamento">
                        </div>
                        <div class="form-inline" id="data_agendamento_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_horario_chegada">Horário de chegada:</label>
                        <div class="input-group">                            
                            <input type="time" class="form-control" id="horario_chegada" name="horario_chegada">
                        </div>
                        <div class="form-inline" id="horario_chegada_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_situacao">Situação:</label>
                        <select class="form-control" id="situacao" name="situacao" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php                            
                            $sql1 = "select id, desc_situacao from cassi_situacao where status = 1 order by id asc";
                            foreach ($pdo->query($sql1) as $value) {
                                echo '<option value="' . $value['id'] . '">' . utf8_encode($value['desc_situacao']) . '</option>';
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
                            <input type="text" class="form-control dinheiro" id="consulta" name="consulta" placeholder="Informe Valor Acertado" value="77,00">
                        </div>
                        <div class="form-inline" id="consulta_error"></div>
                    </div>
                    <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Salvar Agendamento CASSI <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_CASSI"></div>
        </div>        
    </div>
</div>