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
            $("#conteudo_CASSI").empty();
            var cpf = $("#cpf").val();
                        
            if ($("#cpf").val() === '')
            {
                $("#cpf_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe CPF apenas com números...</div>"),
                $("#cpf").focus();
                return false;
            } else {
                $("#cpf_error").empty();
            }
            
            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/cassi_Medicos_lista_de_presenca.php",
                data: "cpf=" + cpf,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response).show(500).hide(500),
                    $("#form")[0].reset(),
                    $("#conteudo").empty().hide(500),
                    $("#conteudo").load('cassi_lista_presenca.php?cpf=' + cpf).show(500);
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
            <h2><strong>Médico</strong> Informe seu CPF para acesso seguro!</h2>
            <div class="additional-btn">
                <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
            </div>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form id="form" method="POST">                    
                    <div class="form-group">
                        <label for="label_cpf">CPF:</label>
                        <div class="input-group">                            
                            <input type="text" class="form-control" id="cpf" name="cpf" autofocus>
                        </div>
                        <div class="form-inline" id="cpf_error"></div>
                    </div>
                    <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Verificar CPF <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_CASSI"></div>
        </div>        
    </div>
</div>