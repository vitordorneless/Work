<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {

        $("#nooo").click(function () {
            $("#conteudo_lateral").empty();
            $("#conteudo_superior").empty();
            $("#conteudo").empty();
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {

            $("#contenido").empty();
            var sair = $("#sair").val();
            var novaURL = "../../index.html";

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/sair.php",
                data: "sair=" + sair,
                beforeSend: function () {
                    $("#contenido").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function () {                    
                    $(window.document.location).attr('href',novaURL);
                    
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="md-content">
    <h3><strong>Logout</strong> Periódicos 2015</h3>
    <div>
        <form id="form" method="POST">
            <p class="text-center">Tem certeza que quer sair do sistema?</p>
            <p class="text-center">
                <input type="hidden" class="form-control" id="sair" name="sair" value="1">
                <button class="btn btn-danger md-close" id="nooo">Não!</button>
                <button class="btn btn-primary btn-success" id="envia" type="submit">Claro!!</button>
            </p>
        </form>
    </div>
    <div id="contenido"></div>
</div>