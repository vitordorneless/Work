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
            $("#conteudo_periodico").empty();            
            var nome = $("#nome").val();
            var c = nome.length;
            
            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome do Ativo...</div>").hide(6000),
                        $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }
            
            if (c <= 6)
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome com mais caracteres para otimizar a busca...</div>").hide(6000),
                        $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/troca_setor_wal.php",
                data: "nome=" + nome,
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
        <h2><strong>Correção cargos</strong> <acronym title="Informe os campos para otimizar o resultado!!!">Walmart</acronym></h2>
        <div class="additional-btn">            
            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>            
        </div>
    </div>
    <div class="widget-content padding">
        <div class="basic-form">
            <form id="form" method="POST">
                <div class="form-group">
                    <label for="estabelecimento_label">Nome do Ativo:</label>
                    <input class="form-control" id="nome" name="nome" required autofocus="autofocus">
                    <div class="form-inline" id="nome_error"></div>
                </div>                
                <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Localizar</button>
            </form>
        </div>
    </div>    
    <div class="widget-content padding" id="conteudo_periodico"></div>
</div>