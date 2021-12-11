<?php
include '../config/database_mysql.php';
$pdo = Database::connect();
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_tst_tipo_agendamento").load('tst_agendamento_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_tst_tipo_agendamento").load('tst_agendamento_listar.php');
            }
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var id_agendamento = $("#id_agendamento").val();
            var id_unidade = $("#id_unidade").val();
            var id_turnos = $("#id_turnos").val();
            var id_situacao = $("#id_situacao").val();
            var data_agendamento = $("#data_agendamento").val();
            var id_tecnicos = $("#id_tecnicos").val();
            var obs = $("#obs").val();

            if ($("#id_agendamento").val() === 'na')
            {
                $("#id_agendamento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o tipo de Agendamento...</div>"),
                        $("#id_agendamento").focus();
                return false;
            } else {
                $("#id_agendamento_error").empty();
            }
            
            if ($("#id_unidade").val() === 'na')
            {
                $("#id_unidade_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Loja...</div>"),
                        $("#id_unidade").focus();
                return false;
            } else {
                $("#id_unidade_error").empty();
            }
            
            if ($("#id_turnos").val() === 'na')
            {
                $("#id_turnos_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe os Turnos...</div>"),
                        $("#id_turnos").focus();
                return false;
            } else {
                $("#id_turnos_error").empty();
            }
            
            if ($("#id_situacao").val() === 'na')
            {
                $("#id_situacao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Situação...</div>"),
                        $("#id_situacao").focus();
                return false;
            } else {
                $("#id_situacao_error").empty();
            }
            
            if ($("#data_agendamento").val() === '')
            {
                $("#data_agendamento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Data do Agendamento...</div>"),
                        $("#data_agendamento").focus();
                return false;
            } else {
                $("#data_agendamento_error").empty();
            }
            
            if ($("#id_tecnicos").val() === 'na')
            {
                $("#id_tecnicos_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o(s) Técnico(s)...</div>"),
                        $("#id_tecnicos").focus();
                return false;
            } else {
                $("#id_tecnicos_error").empty();
            }
            
            if ($("#obs").val() === '')
            {
              obs = 'Não Informado';
            } 

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/tst_agendamento_incluir.php",
                data: "id_agendamento=" + id_agendamento + "&id_unidade=" + id_unidade + "&id_turnos=" + id_turnos + "&id_situacao=" + id_situacao + 
                        "&data_agendamento=" + data_agendamento + "&id_tecnicos=" + id_tecnicos + "&obs=" + obs,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                    $("#form")[0].reset(),
                    $("#refresca_tst_tipo_agendamento").load('tst_agendamento_listar.php');
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">
    <h2><strong>Incluir</strong> TST</h2>
    <div class="additional-btn">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    </div>
</div>
<div class="modal-body">
    <div id="basic-form">
        <form id="form" method="POST">
            <div class="form-group">
                <label for="label_uf">Tipo de Agendamento:</label>
                <select class="form-control" id="id_agendamento" name="id_agendamento">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql0 = "select id, nome_agendamento from tst_tipo_agendamento where status in (1) order by nome_agendamento asc";
                    foreach ($pdo->query($sql0) as $value) {
                        echo '<option value="' . $value['id'] . '">' . $value['nome_agendamento'] . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_agendamento_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Loja / Unidade:</label>
                <select class="form-control" id="id_unidade" name="id_unidade">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql2 = "select id, nome_unidade from tst_unidades where status in (1) order by nome_unidade asc";
                    foreach ($pdo->query($sql2) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['nome_unidade']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_unidade_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Turnos:</label>
                <select class="form-control" id="id_turnos" name="id_turnos">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql3 = "select id, turno from tst_turnos";
                    foreach ($pdo->query($sql3) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['turno']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_turnos_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Situação:</label>
                <select class="form-control" id="id_situacao" name="id_situacao">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql4 = "select id, situacao from tst_situacao";
                    foreach ($pdo->query($sql4) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['situacao']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_turnos_error"></div>
            </div>
            <div class="form-group">
                <label for="label_data_agendamento">Data do Agendamento:</label>
                <input type="date" class="form-control" id="data_agendamento" name="data_agendamento">
                <div class="form-inline" id="data_agendamento_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Técnicos AMA:</label>
                <select multiple class="form-control" id="id_tecnicos" name="id_tecnicos">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql1 = "select nome, id from tst_tecnicos where status in (1) order by nome asc";
                    foreach ($pdo->query($sql1) as $value) {
                        echo '<option value="' . $value['id'] . '">' . $value['nome'] . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_cargo_error"></div>
            </div>
            <div class="form-group">
                <label for="label_obs">Observações:</label>
                <textarea class="form-control" id="obs" name="obs" placeholder="Informe aqui, dados adicionais!!"></textarea>
                <div class="form-inline" id="obs_error"></div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-linkedin pull-right" id="envia" type="submit">Salvar Agendamento <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
            </div>
            <?php Database::disconnect(); ?>
        </form>
    </div>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>