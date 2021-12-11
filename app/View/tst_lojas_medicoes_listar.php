<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<?php
include '../config/database_mysql.php';
$pdo = Database::connect();
?>
<script>
    $(document).ready(function () {

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var id_unidade = $("#id_unidade").val();

            if ($("#id_unidade").val() === 'na')
            {
                $("#id_unidade_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Loja...</div>"),
                        $("#id_unidade").focus();
                return false;
            } else {
                $("#id_unidade_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/tst_lojas_medicoes_listar.php",
                data: "id_unidade=" + id_unidade,
                beforeSend: function () {$("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");},
                success: function (response) {$("#conteudo_CASSI").html(response);},
                error: function () {alert("Ocorreu um erro durante a requisição");}
            });
        }
    });
</script>
<div class="widget">    
    <div class="widget-content padding">
        <form id="form" method="POST">            
            <div class="form-group">
                <label for="label_uf">Loja / Unidade:</label>
                <select class="form-control" id="id_unidade" name="id_unidade">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql2 = "select id, nome_unidade from tst_unidades where status in (1) order by nome_unidade asc";
                    foreach ($pdo->query($sql2) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['nome_unidade']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_unidade_error"></div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-linkedin pull-right" id="envia" type="submit">Visualizar Funções <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
            </div>
            <?php Database::disconnect(); ?>
        </form>
    </div>
</div>
<div class="widget-content padding">
    <div id="conteudo_CASSI"></div>
</div>