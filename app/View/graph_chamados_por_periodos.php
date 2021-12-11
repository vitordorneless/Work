<style type="text/css">
    #imgpos {
        position:absolute;
        left:367px;
    }
</style>
<script>
    $(document).ready(function () {

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo").empty();
            var begin = $("#begin").val();
            var end = $("#end").val();
            var compara_1 = $("#begin").val().replace('-', '/');
            var compara_2 = $("#end").val().replace('-', '/');

            if ($("#begin").val() === '')
            {
                alert("Preencha a data inicial!!");
                $("#begin").focus();
                return false;
            }

            if ($("#end").val() === '')
            {
                alert("Preencha a data final!!");
                $("#end").focus();
                return false;
            }

            if (compara_1 > compara_2)
            {
                alert("Data final deve ser maior que a final!!");
                $("#end").focus();
                return false;
            }

            if (compara_1 === compara_2)
            {
                alert("Datas não podem ser iguais!!");
                $("#begin").focus();
                return false;
            }


            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/graph_chamados_por_periodos.php",
                data: "begin=" + begin + "&end=" + end,
                beforeSend: function () {
                    $("#conteudo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo").html(response);
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="panel panel-danger">
    <div class="panel-heading">
        <div class="panel-title text-center">Chamados por Períodos</div>
    </div>
    <div class="panel-body">
        <div class="container well">
            <div class="col-sm-9 contact-form">
                <form id="form" method="post" class="form-inline">                    
                    <div class="form-group">
                        <label>Data Inicial: </label>
                        <input class="form-control" id="begin" name="begin" type="date" required autofocus />
                    </div>
                    <div class="form-group">
                        <label>Data Final: </label>
                        <input class="form-control" id="end" name="end" type="date" required />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-danger" id="envia" type="submit">Gerar  <span class="glyphicon glyphicon-briefcase" aria-hidden='true'></span></button>
                    </div>                    
                </form>
            </div>          
        </div>
        <div class="container well" id="conteudo"></div>
    </div>
    <div class="panel-footer">Grupo AMA</div>
</div>