<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
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
            var data_inicio = $("#data_inicio").val();
            var data_final = $("#data_final").val();
            
            if ($("#data_inicio").val() === '')
            {
                $("#data_inicio_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(5000),
                $("#data_inicio").focus();
                return false;
            } else {
                $("#data_inicio_error").empty();
            }
            
            if ($("#data_final").val() === '')
            {
                $("#data_final_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o horário de trabalho...</div>").hide(5000),
                $("#data_final").focus();
                return false;
            } else {
                $("#data_final_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/tst_log_operacoes.php",
                data: "data_inicio=" + data_inicio + "&data_final=" + data_final,
                beforeSend: function () {
                    $("#conteudo_periodico").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_periodico").html(response);
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
        <h2><strong>LOG</strong><acronym title="Informe os campos para otimizar o resultado!!!"> de Operações</acronym></h2>
        <div class="additional-btn">            
            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>            
        </div>
    </div>
    <div class="widget-content padding">
        <div class="form-inline">
            <form id="form" method="POST">
                <div class="form-group">
                <label for="label_data_agendamento">Data Inicial:</label>
                <input type="date" class="form-control" id="data_inicio" name="data_inicio">
                <div class="form-inline" id="data_inicio_error"></div>
            </div>
            <div class="form-group">
                <label for="label_data_agendamento">Data Final:</label>
                <input type="date" class="form-control" id="data_final" name="data_final">
                <div class="form-inline" id="data_final_error"></div>
            </div>
                <button class="btn btn-primary btn-facebook" id="envia" type="submit">Gerar Online</button>
            </form>
        </div>
    </div>
    <div class="widget-content padding" id="conteudo_periodico"></div>
</div>