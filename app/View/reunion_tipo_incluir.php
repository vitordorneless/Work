<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_rh").load('reunion_tipo_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_rh").load('reunion_tipo_listar.php');
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
                url: "../Controller/reunion_tipo_incluir.php",
                data: "nome=" + nome,
                beforeSend: function () {
                    $("#conteudo_rh").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_rh").html(response),
                    $("#form")[0].reset(),
                    $("#refresca_rh").load('reunion_tipo_listar.php');
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
    <h4 class="modal-title">Incluir Tipo de Reunião</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_nome">Tipo:</label>            
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe..." autofocus>            
            <div class="form-inline" id="nome_error"></div>
        </div>
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Adicionar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_rh"></div>
</div>