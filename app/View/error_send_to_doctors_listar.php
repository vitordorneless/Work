<?php
include '../config/database_mysql.php';
$pdo = Database::connect();
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $('#button').css("display", "none");
        $('#datadoperiodico').css("display", "none");

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

            if ($("#search").val() === 'na')
            {
                $("#search_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(11000),
                        $("#search").focus();
                return false;
            } else {
                $("#search_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/error_send_to_doctors_listar.php",
                data: "search=" + search,
                beforeSend: function () {
                    $("#conteudo_periodico").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_periodico").html(response),
                            $("#conteudo_superior").empty(),
                            $('#button').css("display", "block").show(1090),
                            $('#datadoperiodico').css("display", "block").show(1090);
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
<script>
    $(document).ready(function () {
        $("#button").click(function () {
            envia_array();
        });
        function envia_array() {
            var favorite = [];
            $.each($("input[name='matricula']:checked"), function () {
                favorite.push($(this).val());
            });

            var data_retorno = $("#data_retorno").val();
            var data_envio_loja = $("#data_envio_loja").val();
            var forma = $("#forma").val();
            var id_medico = $("#id_medico").val();
            
            if ($("#data_retorno").val() === '')
            {
                $("#error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(11000),
                $("#data_retorno").focus();
                return false;
            } else {
                $("#error").empty();
            }
            
            if ($("#data_envio_loja").val() === '')
            {
                $("#error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(11000),
                $("#data_envio_loja").focus();
                return false;
            } else {
                $("#error").empty();
            }
            
            if ($("#forma").val() === 'na')
            {
                $("#error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(11000),
                        $("#forma").focus();
                return false;
            } else {
                $("#error").empty();
            }

            $.ajax({
                type: "GET",
                dataType: "HTML",
                url: "../Controller/error_send_to_doctors_include.php",
                data: "periodico=" + favorite + "&data_retorno=" + data_retorno + "&data_envio_loja=" + data_envio_loja + "&forma=" + forma + "&id_medico=" + id_medico,
                beforeSend: function () {
                    $("#periodico").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#periodico").html(response),
                    $("#data_retorno").val(''),
                    $("#data_envio_loja").val(''),
                    $("#forma").val('');
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="widget">
    <div class="widget-header transparent">
        <h2><strong>Listar Associados</strong><acronym title="Informe os campos para otimizar o resultado!!!"> com Erro</acronym></h2>
        <div class="additional-btn">            
            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>            
        </div>
    </div>
    <div class="widget-content padding">
        <div class="form-group">
            <form id="form" method="POST">
                <div class="form-group">
                    <label>Médico:</label>
                    <select class="form-control" id="search" name="search" required>
                        <option selected value="na">
                            Selecione...
                        </option>
                        <?php
                        $sql = "select id, nome_extenso from usuarios where setor in (28) and status in (1) order by nome asc";
                        foreach ($pdo->query($sql) as $value) {
                            echo '<option value="' . $value['id'] . '">' . $value['nome_extenso'] . '</option>';
                        }
                        ?>
                    </select>                        
                </div>
                <div class="form-inline" id="search_error"></div>
                <div class="form-group">
                    <button class="btn btn-primary btn-facebook" id="envia" type="submit">Procurar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="widget-content padding" id="conteudo_periodico"></div>
    <div class="widget-content padding">
        <div id="datadoperiodico">
            <div class="form-group">
                <label for="estabelecimento_label">Data do Retorno:</label>
                <input type="date" class="form-control" id="data_retorno" name="data_retorno">
            </div>
            <div class="form-group">
                <label for="estabelecimento_label">Data do envio para a Loja:</label>                        
                <input type="date" class="form-control" id="data_envio_loja" name="data_envio_loja">
            </div>
            <div class="form-group">
                <label for="estabelecimento_label">Forma de envio:</label>                        
                <select class="form-control" id="forma" name="forma" required>
                    <option selected value="na">
                        Selecione...
                    </option>
                    <option value="1">
                        Correio Comum
                    </option>
                    <option value="2">
                        Sedex
                    </option>
                    <option value="3">
                        Carta Registrada
                    </option>
                    <option value="4">
                        Motoboy
                    </option>
                    <option value="5">
                        Outros
                    </option>
                </select>
            </div>
            <div class="form-group">
            <div class="form-inline" id="error"></div>
            </div>
        </div>        
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-danger" id="button" type="button">Fechar Envelope <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></button>
    </div>
</div>
<div class="widget-content padding" id="periodico"></div>
</div>