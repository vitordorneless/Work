<?php
session_start();
include '../config/database_mysql.php';
require '../Model/Cassi.php';
require '../Model/Cassi_Carta_Remessa.php';
$pdo = Database::connect();
$cassi = new Cassi_Carta_Remessa();
$cassi->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_cassi = $cassi->Dados_Cassi_Carta_Remessas($cassi->get_id());
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script src="../js/maskMoney.js"></script>
<script>
    $(document).ready(function () {

        $("input.dinheiro").maskMoney({showSymbol: false, decimal: ",", thousands: "."});
        $("#fechar_modal").click(function () {
            $("#refresca_cassi_carta_remessa").load('cassi_carta_remessa_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_cassi_carta_remessa").load('cassi_carta_remessa_listar.php');
            }
        });

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
            var data_recebido_cassi = $("#data_recebido_cassi").val();            
            var usuario = $("#usuario").val();
            var id = $("#id").val();
            var status = $("#status").val();
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

            if ($("#valor_total").val() === '' || $("#valor_total").val() === '0')
            {
                $("#valor_total_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Clique no botão CALCULAR...</div>").hide(9000),
                        $("#valor_total").focus();
                return false;
            } else {
                $("#valor_total_error").empty();
            }

            if ($("#data_envio").val() === '')
            {
                $("#data_envio_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Data de Envio junto a CASSI...</div>").hide(9000),
                        $("#data_envio").focus();
                return false;
            } else {
                $("#data_envio_error").empty();
            }

            if ($("#data_recebido_cassi").val() === '')
            {
                $("#data_recebido_cassi_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Data de Recebimento da CASSI...</div>").hide(9000),
                        $("#data_recebido_cassi").focus();
                return false;
            } else {
                $("#data_recebido_cassi_error").empty();
            }

            if ($("#nf").val() === '')
            {
                $("#nf_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Número da Nota Fiscal que a AMA Emitiu para a CASSI...</div>").hide(9000),
                        $("#nf").focus();
                return false;
            } else {
                $("#nf_error").empty();
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
                url: "../Controller/cassi_carta_remessa_editar.php",
                data: "peg=" + peg + "&guias_anexas=" + guias_anexas + "&valor_total=" + valor_total + "&nf=" + nf + "&data_envio=" + data_envio +
                        "&data_recebido_cassi=" + data_recebido_cassi + "&usuario=" + usuario + "&id=" + id + "&status=" + status + "&nome_arquivo=" + nome_arquivo,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                            $("#form")[0].reset(),
                            $("#refresca_cassi_carta_remessa").load('cassi_carta_remessa_listar.php');
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    <h4 class="modal-title">Alterar Carta Remessa CASSI</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_peg">Número da PEG:</label>
            <div class="input-group">
                <input type="text" class="form-control" id="peg" name="peg" value="<?php echo $array_cassi['peg']; ?>" autofocus>
            </div>
            <div class="form-inline" id="peg_error"></div>
        </div>
        <div class="form-group">
            <label for="label_guias_anexas">Quantidade de Guias anexas:</label>
            <div class="input-group">                            
                <input type="number" class="form-control" id="guias_anexas" name="guias_anexas" value="<?php echo $array_cassi['guias_anexas']; ?>">
                <button class="btn btn-small btn-dribbble" id="calcula">Calcular <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span></button>
            </div>
            <div class="form-inline" id="guias_anexas_error"></div>
        </div>
        <div class="form-group">
            <label for="label_guias_anexas">Valor Total:</label>
            <div class="input-group">
                <span class="input-group-addon">R$</span>
                <input type="number" class="form-control dinheiro" id="valor_total" name="valor_total" readonly="readonly" value="<?php echo $array_cassi['valor_total']; ?>">
            </div>
            <div class="form-inline" id="valor_total_error"></div>
        </div>                    
        <div class="form-group">
            <label for="label_data">Data:</label>
            <div class="input-group">
                <?php
                $format_data = trim($array_cassi['data_envio']);
                $date_format = date("Y-m-d", strtotime($format_data));

                if ($array_cassi['data_recebido_cassi'] === '0000-00-00') {
                    $date_formats = "";
                } else {
                    $format_datas = trim($array_cassi['data_recebido_cassi']);
                    $date_formatss = date("Y-m-d", strtotime($format_datas));
                    $date_formats = 'value="'.$date_formatss.'"';
                }
                ?>
                <input type="date" class="form-control" id="data_envio" name="data_envio" value="<?php echo $date_format; ?>">
            </div>
            <div class="form-inline" id="data_envio_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data">Data Recebido pela CASSI:</label>
            <div class="input-group">
                <input type="date" class="form-control" id="data_recebido_cassi" name="data_recebido_cassi" <?php echo $date_formats; ?>>
            </div>
            <div class="form-inline" id="data_recebido_cassi_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data">Número Nota Fiscal AMA:</label>
            <div class="input-group">
                <input type="text" class="form-control" id="nf" name="nf" value="<?php echo $array_cassi['nota_fiscal_ama']; ?>">
                <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['user_id']; ?>">
                <input type="hidden" id="id" name="id" value="<?php echo $array_cassi['id']; ?>">
            </div>
            <div class="form-inline" id="nf_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data">Nome do Arquivo Anexado:</label>
            <div class="input-group">
                <input type="text" class="form-control" id="nome_arquivo" name="nome_arquivo" value="<?php echo $array_cassi['nome_arquivo']; ?>">
            </div>
            <div class="form-inline" id="nome_arquivo_error"></div>
        </div>
        <div class="form-group">
            <label for="label_status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <?php
                $seleciona1 = $array_cassi['status'] == '1' ? "selected" : " ";
                $seleciona2 = $array_cassi['status'] == '0' ? "selected" : " ";
                ?>
                <option value="1" <?php echo $seleciona1; ?>>
                    Ativo
                </option>
                <option value="0" <?php echo $seleciona2; ?>>
                    Inativo
                </option>                
            </select>
            <div class="form-inline" id="status_error"></div>
        </div>
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Editar Agendamento CASSI <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>