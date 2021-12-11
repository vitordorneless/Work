<?php
require '../Model/Convocar.php';
require '../Model/Evento_Convocacao.php';
$convocacao = new Evento_Convocacao();
$convocacao->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_evento = $convocacao->Dados_Evento_Convocacao_completos($convocacao->get_id());
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
            $("#convocar_datas_adicionar").empty();
            var id = $("#id").val();
            var data_evento = $("#data_evento").val();
            var horario = $("#horario").val();
            var horario_final = $("#horario_final").val();

            if ($("#data_evento").val() === '')
            {
                $("#data_evento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Data do Evento...</div>"),
                        $("#data_evento").focus();
                return false;
            } else {
                $("#data_evento_error").empty();
            }

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
                url: "../Controller/convocar_datas_adicionar.php",
                data: "id=" + id + "&data_evento=" + data_evento + "&horario=" + horario + "&horario_final=" + horario_final,
                beforeSend: function () {
                    $("#convocar_datas_adicionar").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#convocar_datas_adicionar").html(response),
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
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Adicionar Datas ao Evento : "<?php echo $array_evento['convocacao']; ?>"</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_nome_medico">Loja:</label>
            <input type="text" class="form-control" id="loja" name="loja" placeholder="Loja" value="<?php echo $array_evento['loja']; ?>" readonly="readonly">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $array_evento['id_evento']; ?>">
            <div class="form-inline" id="loja_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data_evento">Data Evento:</label>
            <input type="date" class="form-control" id="data_evento" name="data_evento">
            <div class="form-inline" id="data_evento_error"></div>
        </div>
        <div class="form-group">
            <label for="label_turnos">Turnos:</label>
            <input type="number" class="form-control" id="turnos" name="turnos" value="<?php echo $array_evento['turnos']; ?>" readonly="readonly">
            <div class="form-inline" id="turnos_error"></div>
        </div>        
        <div class="form-group">
            <label for="label_horario">Horário Inicial:</label>
            <input type="time" class="form-control" id="horario" name="horario" placeholder="Horário">
            <div class="form-inline" id="horario_error"></div>
        </div>
        <div class="form-group">
            <label for="label_horario">Horário Final:</label>
            <input type="time" class="form-control" id="horario_final" name="horario_final" placeholder="Horário">            
        </div>
        <button class="btn btn-primary" id="envia" type="submit">Adicionar Data</button>
    </form>
</div>
<div class="modal-footer">
    <div id="convocar_datas_adicionar"></div>
</div>