<?php
include '../config/database_mysql.php';
$pdo = Database::connect();
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_tst_tipo_agendamento").load('wal_caixas_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_tst_tipo_agendamento").load('wal_caixas_listar.php');
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
            var etiqueta = $("#etiqueta").val();
            var id_wal_box = $("#id_wal_box").val();

            if ($("#etiqueta").val() === '')
            {
                $("#etiqueta_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#etiqueta").focus();
                return false;
            } else {
                $("#etiqueta_error").empty();
            }

            if ($("#id_wal_box").val() === 'na')
            {
                $("#id_wal_box_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_wal_box").focus();
                return false;
            } else {
                $("#id_wal_box_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/wal_caixas_incluir.php",
                data: "etiqueta=" + etiqueta + "&id_wal_box=" + id_wal_box,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                    $("#form")[0].reset(),
                    $("#refresca_tst_tipo_agendamento").load('wal_caixas_listar.php');
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">
    <h2><strong>Incluir</strong> Caixa</h2>
    <div class="additional-btn">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    </div>
</div>
<div class="modal-body">
    <div id="basic-form">
        <form id="form" method="POST">
            <div class="form-group">
                <label for="label_data_agendamento">Etiqueta:</label>
                <input type="text" class="form-control" id="etiqueta" name="etiqueta">
                <div class="form-inline" id="etiqueta_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Estado:</label>
                <select class="form-control" id="id_wal_box" name="id_wal_box">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql0 = "select id, estado from wal_box where status in (1) order by estado asc";
                    foreach ($pdo->query($sql0) as $value) {
                        echo '<option value="' . $value['id'] . '">' . $value['estado'] . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_wal_box_error"></div>
            </div>            
            <div class="form-group">
                <button class="btn btn-primary btn-linkedin pull-right" id="envia" type="submit">Abrir Caixa <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
            </div>
            <?php Database::disconnect(); ?>
        </form>
    </div>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>