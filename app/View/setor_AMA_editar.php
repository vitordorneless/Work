<?php
require '../Model/Usuario.php';
require '../Model/Usuarios_Setores.php';
$user = new Usuarios_Setores();
$user->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_user = $user->Dados_Usuarios_Setores($user->get_id());
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
            $("#conteudo_setor_AMA_editar").empty();
            var setor = $("#setor").val();
            var id = $("#id").val();
            var status = $("#status").val();
            
            if ($("#setor").val() === '')
            {
                $("#setor_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome do Setor...</div>"),
                $("#setor").focus();
                return false;
            }            
            
            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/setor_AMA_editar.php",
                data: "setor=" + setor + "&id=" + id + "&status=" + status,
                beforeSend: function () {
                    $("#conteudo_setor_AMA_editar").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_setor_AMA_editar").html(response),
                    $("#form")[0].reset(),
                    $("#refresca_setores_AMA").load('setor_AMA_listar.php');
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
    <h4 class="modal-title">Editar Setor</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_razao_social">Razão Social:</label>
            <input type="text" class="form-control" id="setor" name="setor" placeholder="Setor" value="<?php echo $array_user['setor']; ?>">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $array_user['id']; ?>">
            <div class="form-inline" id="setor_error"></div>
        </div>
        <div class="form-group">
            <label for="label_status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <?php
                $seleciona1 = $array_user['status'] == '1' ? "selected" : " ";
                $seleciona2 = $array_user['status'] == '0' ? "selected" : " ";
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
        <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Editar Dados do Setor</button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_setor_AMA_editar"></div>
</div>