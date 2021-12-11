<?php
require '../Model/Medico.php';
require '../Model/Funcao_Medicos.php';
$funcao_Medicos = new Funcao_Medicos();
$funcao_Medicos->set_id_funcao(filter_input(INPUT_GET, 'id_funcao', FILTER_SANITIZE_NUMBER_INT));
$array_funcao = $funcao_Medicos->Dados_Funcao_Medicos($funcao_Medicos->get_id_funcao());
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
            $("#conteudo_funcao").empty();
            var funcao = $("#funcao").val();
            var id_funcao = $("#id_funcao").val();
            var status = $("#status").val();

            if ($("#funcao").val() === '')
            {
                alert("Informe a Função!!");
                $("#funcao").focus();
                return false;
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/funcao_editar.php",
                data: "funcao=" + funcao + "&id_funcao=" + id_funcao + "&status=" + status,
                beforeSend: function () {
                    $("#conteudo_funcao").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_funcao").html(response),
                    $("#form")[0].reset(),
                    $("#refresca_funcao").load('funcao_listar.php');
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
    <h4 class="modal-title">Editar Função</h4>
</div>			
<div class="modal-body">
    <form id="form" class="form-inline" method="POST">
        <div class="form-group">
            <label class="sr-only" for="label_funcao">Função:</label>
            <input type="text" class="form-control" id="funcao" name="funcao" placeholder="Nome da Função" value="<?php echo $array_funcao['funcao']; ?>">
            <input type="hidden" class="form-control" id="id_funcao" name="id_funcao" value="<?php echo $array_funcao['id_funcao']; ?>">
        </div>
        <div class="form-group">
            <label class="sr-only" for="label_status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <?php
                $seleciona1 = $array_funcao['ativo'] == 1 ? " selected " : " ";
                $seleciona2 = $array_funcao['ativo'] == 0 ? " selected " : " ";
                ?>
                <option <?php echo $seleciona1; ?> value="1">
                    Ativo
                </option>
                <option <?php echo $seleciona2; ?> value="0">
                    Inativo
                </option>
            </select>
        </div>
        <button class="btn btn-primary" id="envia" type="submit">Editar Função</button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_funcao"></div>
</div>