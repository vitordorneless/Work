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
            var id_prestador = $("#id_prestador").val();            

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/gerar_contrato_prestador.php",
                data: "id_prestador=" + id_prestador,
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
        <h2><strong>Gerar Contrato</strong> <acronym title="Informe os campos para otimizar o resultado!!!">PRESTADOR</acronym></h2>
        <div class="additional-btn">            
            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>            
        </div>
    </div>
    <div class="widget-content padding">
        <div class="basic-form">
            <form id="form" method="POST">                
                <div class="form-group">
                        <label for="label_prestador">Prestador:</label>
                        <select class="form-control" id="id_prestador" name="id_prestador" required>
                            <option selected value="na">
                                Nenhum...
                            </option>
                            <?php
                            include '../config/database_mysql.php';
                            $pdo = Database::connect();
                            $sql2 = "select id, razao_social from wal_prestadores where status = 1 order by razao_social";
                            foreach ($pdo->query($sql2) as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['razao_social'] . '</option>';
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <div class="form-inline" id="id_prestador_error"></div>
                    </div>                    
                <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Gerar</button>                
            </form>
        </div>
    </div>    
    <div class="widget-content padding" id="conteudo_periodico"></div>
</div>