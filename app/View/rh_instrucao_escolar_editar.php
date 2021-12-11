<?php
include '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$pdo = Database::connect();
$rh = new RH_Grau_Instrucao_Escolar();
$rh->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_rh = $rh->Dados_RH_Grau_Instrucao_Escolars($rh->get_id());
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_rh").load('rh_instrucao_escolar_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_rh").load('rh_instrucao_escolar_listar.php');
            }
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_rh").empty();
            var nome = $("#nome").val();
            var id = $("#id").val();
            var status = $("#status").val();

            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome do Solicitante...</div>").hide(9000),
                        $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/rh_instrucao_escolar_editar.php",
                data: "nome=" + nome + "&id=" + id + "&status=" + status,
                beforeSend: function () {
                    $("#conteudo_rh").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_rh").html(response),
                    $("#form")[0].reset(),
                    $("#refresca_rh").load('rh_instrucao_escolar_listar.php');
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    <h4 class="modal-title">Editar Grau de Instrução Escolar</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_nome">Tipo:</label>            
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe..." value="<?php echo $array_rh['grau']; ?>" autofocus>
            <input type="hidden" id="id" name="id" value="<?php echo $array_rh['id']; ?>">
            <div class="form-inline" id="nome_error"></div>
        </div>
        <div class="form-group">
            <label for="label_status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <?php
                $seleciona1 = $array_rh['status'] == '1' ? "selected" : " ";
                $seleciona2 = $array_rh['status'] == '0' ? "selected" : " ";
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
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Editar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_rh"></div>
</div>