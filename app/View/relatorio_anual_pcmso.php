<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script src="../js/JQuery/jquery-ui-1.11.2.custom/jquery-ui.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
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
            var periodo = $("#periodo").val();

            if ($("#periodo").val() === 'na')
            {
                $("#periodo_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(7000),
                        $("#periodo").focus();
                return false;
            } else {
                $("#periodo_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/relatorio_anual_pcmso.php",
                data: "periodo=" + periodo,
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
        <h2><strong>Relatório</strong> - <acronym title="Informe os campos para otimizar o resultado!!!">Anual PCMSO</acronym></h2>
        <div class="additional-btn">            
            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>            
        </div>
    </div>    
    <div class="widget-content padding">
        <div class="basic-form">
            <form id="form" method="POST">                
                <div class="form-group">
                    <label for="label_prestador">Informe Período:</label>
                    <select class="form-control" id="periodo" name="periodo" required>
                        <option selected value="na">
                            Nenhum...
                        </option>
                        <option value="2015">
                            2015
                        </option>
                        <option value="2016a">
                            2016
                        </option>
                        <option value="2017">
                            2017 - Não usar esse
                        </option>
                        <option value="2018">
                            2018 - Não usar esse
                        </option>
                    </select>
                    <div class="form-inline" id="periodo_error"></div>
                </div>
                <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Gerar</button>
            </form>
        </div>
    </div>        
    <div class="widget-content padding" id="conteudo_periodico"></div>
</div>