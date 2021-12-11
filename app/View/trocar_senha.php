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
            var nova_senha = $("#nova_senha").val();
            var nova_senha1 = $("#nova_senha1").val();

            if ($("#nova_senha").val() === '')
            {
                $("#nova_senha_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#nova_senha").focus();
                return false;
            } else {
                $("#nova_senha_error").empty();
            }

            if ($("#nova_senha").val() !== $("#nova_senha1").val())
            {
                $("#nova_senha_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Senhas Diferentes, elas devem ser iguais...</div>").hide(90000),
                $("#nova_senha").focus();
                return false;
            } else {
                $("#nova_senha_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/trocar_senha.php",
                data: "nova_senha=" + nova_senha + "&nova_senha1=" + nova_senha1,
                beforeSend: function () {
                    $("#conteudo_funcao").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_funcao").html(response),
                            $("#form")[0].reset();
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
            <h2><strong>Trocar</strong> Senha</h2>
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
                        <label for="label_nome_funcao">Informe Nova Senha:</label>
                        <input type="password" class="form-control" id="nova_senha" name="nova_senha" autofocus>
                        <div class="form-inline" id="nova_senha_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_nome_funcao">Repita a Nova Senha:</label>
                        <input type="password" class="form-control" id="nova_senha1" name="nova_senha1">                        
                    </div>                    
                    <button class="btn btn-primary" id="envia" type="submit">Gravar Nova Senha</button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_funcao"></div>
        </div>        
    </div>
</div>