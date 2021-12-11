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
            
            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome da Convocação...</div>"),
                $("#nome").focus();
                return false;
            }            
            
            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/convocacao_adicionar.php",
                data: "nome=" + nome,
                beforeSend: function () {
                    $("#conteudo_convocacao").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_convocacao").html(response),
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
            <h2><strong>Adicionar</strong> Convocação</h2>
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
                        <label for="label_nome_funcao">Nome da Convocação:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Convocação" autofocus>
                        <div class="form-inline" id="nome_error"></div>
                    </div>
                    <button class="btn btn-primary" id="envia" type="submit">Gravar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_convocacao"></div>
        </div>        
    </div>
</div>