<?php
require '../Model/Convocar.php';
require '../Model/Datas_Eventos_Convocacao.php';
$evento = new Datas_Eventos_Convocacao();
$evento->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_evento = $evento->Dados_Datas_Eventos_Convocacao_id($evento->get_id());
$format_data1 = trim($array_evento['data_evento']);
$date_format1 = date("Y-m-d", strtotime($format_data1));            
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
            $("#convocar_datas_edit").empty();
            var id = $("#id").val();
            var data_evento = $("#data_evento").val();
            var horario = $("#horario").val();
            var horario_final = $("#horario_final").val();            

            if ($("#horario").val() === '')
            {
                $("#horario_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Horário...</div>"),
                        $("#horario").focus();
                return false;
            } else {
                $("#horario_error").empty();
            }

            if ($("#horario_final").val() === '')
            {
                $("#horario_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Horário Final...</div>"),
                        $("#horario_final").focus();
                return false;
            } else {
                $("#horario_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/convocar_datas_edit.php",
                data: "id=" + id + "&horario=" + horario + "&horario_final=" + horario_final + "&data_evento=" + data_evento,
                beforeSend: function () {
                    $("#convocar_datas_edit").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#convocar_datas_edit").html(response),
                    $("#form")[0].reset(),
                    $("#refresca_convocar_datas_listar").load('convocar_datas_listar.php');
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_horario">Data do evento:</label>
            <input type="date" class="form-control" id="data_evento" name="data_evento" value="<?php echo $date_format1; ?>">
            <div class="form-inline" id="data_evento_error"></div>
        </div>
        <div class="form-group">
            <label for="label_horario">Horário Inicial:</label>
            <input type="time" class="form-control" id="horario" name="horario" placeholder="Horário" value="<?php echo $array_evento['horario']; ?>">
            <input type="hidden" id="id" name="id" value="<?php echo $array_evento['id']; ?>">
            <div class="form-inline" id="horario_error"></div>
        </div>
        <div class="form-group">
            <label for="label_horario">Horário Final:</label>
            <input type="time" class="form-control" id="horario_final" name="horario_final" placeholder="Horário" value="<?php echo $array_evento['horario_final']; ?>">
        </div>
        <button class="btn btn-primary" id="envia" type="submit">Editar Data e Horário</button>
    </form>
</div>
<div class="modal-footer">
    <div id="convocar_datas_edit"></div>
</div>