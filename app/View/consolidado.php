<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {
        
        $("#conde").hide();

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#contenido").empty();

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/consolidado.php",
                beforeSend: function () {
                    $("#contenido").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conde").show(10),
                    $("#contenido").html(response);
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="container well">
    <div class="titlepage text-center"><h2>Relatório Clínicas x Médicos Consolidado</h2></div>
    <br/><br/><br/>
    <section id="plans">
        <div class="container">
            <div class="row">
                <!--<div class="col-md-4 text-center">
                    <div class="panel panel-danger panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-paste"></i>
                            <h3>EXCEL</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p><strong>Para salvar em sua máquina</strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-check"></i> Formato .xls</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> Pode ser enviado via email</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> Está com dúvidas, contate a TI-AMA!!</li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-danger" href="../Controller/consolidado_excel.php">Gerar em Excel!</a>
                        </div>
                    </div>
                </div>                -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-success panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-briefcase"></i>
                            <h3>ONLINE</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p><strong>Para Visualizar em Tempo Real</strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-check"></i> Formato Online</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> Para atualizar, clique em Gerar</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> Está com dúvidas, contate a TI-AMA!!</li>
                        </ul>
                        <form id="form" method="POST">
                            <div class="panel-footer">
                                <button class="btn btn-lg btn-block btn-success" id="envia" type="submit">Gerar Online!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="container well" id="conde">
    <div id="contenido"></div>
</div>