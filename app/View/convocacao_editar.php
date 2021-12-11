<?php
require '../Model/Convocar.php';
require '../Model/Convocacao.php';
$convocacao = new Convocacao();
$convocacao->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_convocacao = $convocacao->Dados_Convocacao($convocacao->get_id());
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
            $("#conteudo_convocacao").empty();
            var nome = $("#nome").val();
            var id = $("#id").val();
            var status = $("#status").val();

            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome da Convocação...</div>"),
                $("#nome").focus();
                return false;
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/convocacao_editar.php",
                data: "nome=" + nome + "&id=" + id + "&status=" + status,
                beforeSend: function () {
                    $("#conteudo_convocacao").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_convocacao").html(response),
                    $("#form")[0].reset(),
                    $("#refresca_convocacao").load('convocacao_listar.php');
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
    <h4 class="modal-title">Editar Convocação</h4>
</div>			
<div class="modal-body">
    <form id="form" class="form-inline" method="POST">
        <div class="form-group">
            <label class="sr-only" for="label_funcao">Nome da Convocação:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Convocação" value="<?php echo $array_convocacao['nome_convocacao']; ?>">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $array_convocacao['id']; ?>">
            <div class="form-inline" id="nome_error"></div>
        </div>
        <div class="form-group">
            <label class="sr-only" for="label_status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <?php
                $seleciona1 = $array_convocacao['status'] == 1 ? " selected " : " ";
                $seleciona2 = $array_convocacao['status'] == 0 ? " selected " : " ";
                ?>
                <option <?php echo $seleciona1; ?> value="1">
                    Ativo
                </option>
                <option <?php echo $seleciona2; ?> value="0">
                    Inativo
                </option>
            </select>
        </div>
        <button class="btn btn-primary" id="envia" type="submit">Editar Convocação</button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_convocacao"></div>
</div>