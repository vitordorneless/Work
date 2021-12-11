<?php
include '../Model/Tecnicos_Seguranca_Trabalho.php';
include '../Model/TST_Cargo_Tecnicos.php';
$tst = new TST_Cargo_Tecnicos();
$tst->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_tst = $tst->Dados_TST_Cargos_Tecnicoss($tst->get_id());
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_tst_tipo_agendamento").load('tst_nome_cargos_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_tst_tipo_agendamento").load('tst_nome_cargos_listar.php');
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
            var nome_cargo = $("#nome_cargo").val();
            var id = $("#id").val();

            if ($("#nome_cargo").val() === '')
            {
                $("#nome_cargo_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o nome do tipo de Agendamento...</div>"),
                        $("#nome_cargo").focus();
                return false;
            } else {
                $("#nome_cargo_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/tst_nome_cargos_editar.php",
                data: "nome_cargo=" + nome_cargo + "&id=" + id,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                    $("#form")[0].reset(),
                    $("#refresca_tst_tipo_agendamento").load('tst_nome_cargos_listar.php');                    
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">
    <h2><strong>Editar</strong> Tipo de Agendamento TST</h2>
    <div class="additional-btn">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    </div>
</div>
<div class="modal-body">
    <div id="basic-form">
        <form id="form" method="POST">
            <div class="form-group">
                <label for="label_data_agendamento">Nome do Cargo:</label>                
                <input type="text" class="form-control" id="nome_cargo" name="nome_cargo" value="<?php echo $array_tst['nome_cargo']; ?>">
                <input type="hidden" id="id" name="id" value="<?php echo $array_tst['id']; ?>">
                <div class="form-inline" id="nome_cargo_error"></div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-linkedin pull-right" id="envia" type="submit">Salvar Tipo de Agendamento TST <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
            </div>
        </form>
    </div>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>