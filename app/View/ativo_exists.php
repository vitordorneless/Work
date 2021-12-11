<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI_edit").empty();
            var malacabado = $("#malacabado").val();

            if ($("#malacabado").val() === '')
            {
                $("#malacabado_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#malacabado").focus();
                return false;
            } else {
                $("#malacabado_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/ativo_exists.php",
                data: "malacabado=" + malacabado,
                beforeSend: function () {
                    $("#conteudo_CASSI_edit").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI_edit").html(response);
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="row">
    <div class="widget">
        <div class="widget-header transparent">    
            <h4 class="modal-title">Ativo Existe ou Não!!</h4>
        </div>
        <div class="widget-content padding">
            <form id="form" method="POST">
                <div class="form-group">
                    <label for="label_consulta">CPF:</label>            
                    <input type="text" class="form-control" id="malacabado" name="malacabado" placeholder="Informe CPF">
                    <div class="form-inline" id="malacabado_error"></div>
                </div>
                <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Descobrir <span class="glyphicon glyphicon-baby-formula" aria-hidden="true"></span></button>
            </form>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_CASSI_edit"></div>
        </div>
    </div>
</div>