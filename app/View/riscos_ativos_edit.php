<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            $("#conteudo_lateral").empty();
            $("#conteudo_superior").empty();
            envia_form();
        });
        function envia_form() {
            $("#conteudo_periodico").empty();
            var search = $("#search").val();

            if ($("#search").val() === '')
            {
                $("#search_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome do Ativo...</div>").hide(11000),
                        $("#search").focus();
                return false;
            } else {
                $("#search_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/riscos_ativos_edit.php",
                data: "search=" + search,
                beforeSend: function () {
                    $("#conteudo_periodico").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_periodico").html(response),
                            $("#conteudo_superior").empty();
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<style type="text/css">
    #imgpos {
        position:absolute;
        left:667px;
    }
</style>
<div class="widget">
    <div class="widget-header transparent">
        <h2><strong>Listar Associados</strong><acronym title="Informe os campos para otimizar o resultado!!!"> Walmart</acronym></h2>
        <div class="additional-btn">            
            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>            
        </div>
    </div>
    <div class="widget-content padding">
        <div class="form-group">
            <form id="form" method="POST">
                <div class="form-group">
                    <label for="empresa_label">Nome do Associado Walmart:</label>
                    <input type="text" class="form-control" id="search" name="search" autofocus="autofocus">                        
                </div>
                <div class="form-inline" id="search_error"></div>
                <div class="form-group">
                    <button class="btn btn-primary btn-facebook" id="envia" type="submit">Procurar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="widget-content padding" id="conteudo_periodico"></div>
</div>