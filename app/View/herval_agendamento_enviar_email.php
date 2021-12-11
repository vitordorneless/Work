<?php
include '../config/database_mysql.php';
$pdo = Database::connect();
require '../Model/Herval.php';
require '../Model/Herval_Agendamento.php';
$herval = new Herval_Agendamento();
$herval->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_herval = $herval->Dados_Herval_agendamentos($herval->get_id());
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_herval").load('herval_agendamento_enviar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_herval").load('herval_agendamento_enviar.php');
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
            var id = $("#id").val();            
            var mostrar_data = $("#mostrar_data").is(":checked") === true ? 1 : 0;            

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/herval_agendamento_enviar_email.php",
                data: "id=" + id + "&mostrar_data=" + mostrar_data,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                    $("#refresca_herval").load('herval_agendamento_enviar.php');
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">
    <h2><strong>Enviar</strong> Agendamento Herval</h2>
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
                    $sql = "select id, unidade from herval_unidades where status = 1 order by cod_unidade asc";
                    foreach ($pdo->query($sql) as $value) {
                        $option = $value['id'] == $array_herval['id_unidade'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                        echo '<option ' . $option . '>' . $value['unidade'] . '</option>';
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
                        $option = $value['id'] == $array_herval['id_tipo_agendamento'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                        echo '<option ' . $option . '>' . $value['nome_agendamento'] . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tipo_agendamento_error"></div>
            </div>
            <div class="form-group">
                <label for="label_data_agendamento">Data do Agendamento:</label>
                <div class="input-group">
                    <?php
                    $format_data = trim($array_herval['data_agendamento']);
                    $date_solicitacao = date("Y-m-d", strtotime($format_data));
                    ?>
                    <input type="date" class="form-control" id="data_agendamento" name="data_agendamento" value="<?php echo $date_solicitacao; ?>" readonly>
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
                        $option = $value['id'] == $array_herval['id_situacao'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                        echo '<option ' . $option . '>' . utf8_encode($value['situacao']) . '</option>';
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
                        $option = $value['id_medico'] == $array_herval['id_medico'] ? 'value="' . $value['id_medico'] . '" selected' : 'value="' . $value['id_medico'] . '"';
                        echo '<option ' . $option . '>' . $value['nome'] . '</option>';
                    }
                    Database::disconnect();
                    ?>
                </select>
                <div class="form-inline" id="medico_error"></div>
            </div>
            <div class="form-group">
                <label for="label_consulta">Valor da Consulta:</label>                    
                <input type="text" class="form-control" id="consulta" name="consulta" placeholder="Informe Valor Acertado" value="<?php echo $array_herval['valor_consulta']; ?>" readonly>
                    <input type="hidden" id="id" name="id" value="<?php echo $array_herval['id']; ?>">
                <div class="form-inline" id="consulta_error"></div>
            </div>
            <div class="form-group">
                <label for="label_consulta">Voucher:</label>
                <input type="text" class="form-control text-center text-danger" id="voucher" name="voucher" value="<?php echo $array_herval['voucher']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="label_consulta">Mostrar Data no Email:</label>
                <input type="checkbox" class="checkbox" id="mostrar_data" name="mostrar_data">
            </div>
            <div class="form-group">
                <label for="label_status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <?php
                    $seleciona1 = $array_herval['status'] == '1' ? "selected" : " ";
                    $seleciona2 = $array_herval['status'] == '0' ? "selected" : " ";
                    ?>
                    <option value="1" <?php echo $seleciona1; ?>>
                        Ativo
                    </option>
                    <option value="0" <?php echo $seleciona2; ?>>
                        Inativo
                    </option>
                </select>
                <div class="form-inline" id="status_error"></div>
            </div>
            <button class="btn btn-primary btn-vimeo pull-right" id="envia" type="submit">Enviar Agendamento Herval <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></button>
        </form>
    </div>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>