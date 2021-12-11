<?php
session_start();
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {

        $("#calcula").click(function () {
            var guias_anexass = $("#guias_anexas").val();
            var valor_totall = 72;
            var total = (guias_anexass * valor_totall);
            $("#valor_total").val(parseFloat(total));
            $("#nf").focus();
        });
        
        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var peg = $("#peg").val();
            var guias_anexas = $("#guias_anexas").val();
            var valor_total = $("#valor_total").val();
            var nf = $("#nf").val();
            var data_envio = $("#data_envio").val();
            var data_recebido_cassi = 0;
            var usuario = $("#usuario").val();
            var nome_arquivo = $("#nome_arquivo").val();

            if ($("#peg").val() === '')
            {
                $("#peg_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Número de Controle desta Carta Remessa...</div>").hide(9000),
                        $("#peg").focus();
                return false;
            } else {
                $("#peg_error").empty();
            }

            if ($("#guias_anexas").val() === '')
            {
                $("#guias_anexas_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe quantas Guias foram geradas...</div>").hide(9000),
                        $("#guias_anexas").focus();
                return false;
            } else {
                $("#guias_anexas_error").empty();
            }

            if ($("#data_envio").val() === '')
            {
                $("#data_envio_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Data de Envio junto a CASSI...</div>").hide(9000),
                        $("#data_envio").focus();
                return false;
            } else {
                $("#data_envio_error").empty();
            }

            if ($("#nome_arquivo").val() === '')
            {
                $("#nome_arquivo_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o nome do Arquivo com a Extensão!!<br>Exemplo: cassi_remessa.pdf</div>").hide(9000),
                        $("#nome_arquivo").focus();
                return false;
            } else {
                $("#nome_arquivo_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/cassi_carta_remessa_adicionar.php",
                data: "peg=" + peg + "&guias_anexas=" + guias_anexas + "&valor_total=" + valor_total + "&nf=" + nf + "&data_envio=" + data_envio +
                        "&data_recebido_cassi=" + data_recebido_cassi + "&usuario=" + usuario + "&nome_arquivo=" + nome_arquivo,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                            $("#form")[0].reset();
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="row">
    <div class="widget">
        <div class="widget-header transparent">
            <h2><strong>Marcar</strong> Agendamento CASSI</h2>
            <div class="additional-btn">                
                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
            </div>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form id="form" method="POST">
                    <div class="form-group">
                        <label for="label_peg">Número da PEG:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="peg" name="peg" autofocus>
                        </div>
                        <div class="form-inline" id="peg_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_guias_anexas">Quantidade de Guias anexas:</label>
                        <div class="input-group">                            
                            <input type="number" class="form-control" id="guias_anexas" name="guias_anexas">                            
                            <button class="btn btn-small btn-dribbble" id="calcula">Calcular <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span></button>
                        </div>
                        <div class="form-inline" id="guias_anexas_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_guias_anexas">Valor Total:</label>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="number" class="form-control dinheiro" id="valor_total" name="valor_total" value="" readonly="readonly">
                            <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['user_id']; ?>">
                            <input type="hidden" class="form-control" id="nf" name="nf" value="0">
                        </div>
                        <div class="form-inline" id="guias_anexas_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_nome_arquivo">Nome do Arquivo:</label>
                        <div class="input-group">                            
                            <input type="text" class="form-control" id="nome_arquivo" name="nome_arquivo">
                        </div>
                        <div class="form-inline" id="nome_arquivo_error"></div>
                    </div>                    
                    <div class="form-group">
                        <label for="label_data">Data:</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="data_envio" name="data_envio">
                        </div>
                        <div class="form-inline" id="data_envio_error"></div>
                    </div>
                    <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Salvar Carta Remessa CASSI <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_CASSI"></div>
        </div>        
    </div>
</div>