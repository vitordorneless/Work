<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<?php
require '../Model/Herval.php';
require '../Model/Herval_Agendamento.php';
require '../Model/Herval_Agendamento_Individual.php';
$herval = new Herval_Agendamento();
$individual = new Herval_Agendamento_Individual();
$herval->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)); //id ativo
$herval->set_id_unidade(filter_input(INPUT_GET, 'id_unidade', FILTER_SANITIZE_NUMBER_INT));
$herval->set_id_convocacao(filter_input(INPUT_GET, 'id_convocacao', FILTER_SANITIZE_NUMBER_INT));
$array_herval = $herval->Dados_Herval_agendamentos($herval->get_id_convocacao());
$array_ind = $individual->Dados_Herval_Agendamento_Individuals($herval->get_id());
?>
<script>
    $(document).ready(function () {

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#contenido").empty();
            var data_agendamento = $("#data_agendamento").val();
            var horario = $("#horario").val();
            var id_ativo = $("#id_ativo").val();
            var id_unidade = $("#id_unidade").val();
            var id_convocacao = $("#id_convocacao").val();
            var id_agendamento_individual = $("#id_agendamento_individual").val();

            if ($("#data_agendamento").val() === '')
            {
                $("#data_agendamento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Data do Agendamento...</div>"),
                        $("#data_agendamento").focus();
                return false;
            } else {
                $("#data_agendamento_error").empty();
            }

            if ($("#horario").val() === '')
            {
                $("#horario_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Horário...</div>"),
                        $("#horario").focus();
                return false;
            } else {
                $("#horario_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/herval_agendamento_ind_editar.php",
                data: "data_agendamento=" + data_agendamento + "&horario=" + horario + "&id_ativo=" + id_ativo + "&id_unidade=" + id_unidade +
                        "&id_convocacao=" + id_convocacao + "&id_agendamento_individual=" + id_agendamento_individual,
                beforeSend: function () {
                    $("#contenido").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#contenido").html(response);
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
            <?php
            $format_data = trim($array_ind['data']);
            $date_format = date("Y-m-d", strtotime($format_data));
            ?>
            <label for="label_data_agendamento">Data do Agendamento:</label>
            <input type="date" class="form-control" id="data_agendamento" name="data_agendamento" value="<?php echo $date_format; ?>">
            <input type="hidden" id="id_ativo" name="id_ativo" value="<?php echo $herval->get_id(); ?>">
            <input type="hidden" id="id_convocacao" name="id_convocacao" value="<?php echo $herval->get_id_convocacao(); ?>">
            <input type="hidden" id="id_unidade" name="id_unidade" value="<?php echo $herval->get_id_unidade(); ?>">
            <input type="hidden" id="id_agendamento_individual" name="id_agendamento_individual" value="<?php echo $array_ind['id']; ?>">
            <div class="form-inline" id="data_agendamento_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data_agendamento">Horário:</label>    
            <input type="time" class="form-control" id="horario" name="horario" value="<?php echo $array_ind['horario']; ?>">
            <div class="form-inline" id="horario_error"></div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Editar Agendamento Herval Indivídual<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
        </div>
    </form>
</div>
<div class="modal-footer">
    <div id="contenido"></div>
</div>