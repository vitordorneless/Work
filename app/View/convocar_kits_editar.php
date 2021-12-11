<?php
include '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$evento = new Evento_Convocacao();
$kit = new Wal_Kit();
$array_medico = $evento->Dados_Evento_Convocacao_completos(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_kit = $kit->Dados_Wal_Kit($array_medico['id_convocacao']);
$date_format = date("Y-m-d", strtotime(trim($array_kit['data_envio'])));
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {
        
        $("#fechar_modal").click(function () {
            $("#refresca_setores_AMA").load('convocar_kits_adm.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_setores_AMA").load('convocar_kits_adm.php');
            }
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_convocar_loja").empty();
            var id_convocacao = $("#id_convocacao").val();
            var id = $("#id").val();
            var rastreamento = $("#rastreamento").val();
            var data_envio = $("#data_envio").val();            

            if ($("#rastreamento").val() === '') {
                $("#rastreamento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                $("#rastreamento").focus();
                return false;
            } else {
                $("#rastreamento_error").empty();
            }
            
            if ($("#data_envio").val() === '') {
                $("#data_envio_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                $("#data_envio").focus();
                return false;
            } else {
                $("#data_envio_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/convocar_kits_editar.php",
                data: "id_convocacao=" + id_convocacao + "&rastreamento=" + rastreamento + "&data_envio=" + data_envio + "&id=" + id,
                beforeSend: function () {
                    $("#conteudo_convocar_loja").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_convocar_loja").html(response),
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
            <h2 class="text-center"><strong>Enviar </strong>Kit</h2>
            <div class="additional-btn">                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
            </div>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form id="form" method="POST">
                    <div class="form-group">
                        <label for="label_turnos">Loja:</label>
                        <input type="text" class="form-control" value="<?php echo $array_medico['loja']; ?>" readonly="readonly">
                        <input type="hidden" id="id_convocacao" name="id_convocacao" value="<?php echo $array_medico['id_convocacao']; ?>">
                        <input type="hidden" id="id" name="id" value="<?php echo $array_kit['id']; ?>">
                    </div>
                    <div class="form-group">                        
                        <label for="label_Dia">Rastreamento:</label>
                        <input type="text" class="form-control" id="rastreamento" name="rastreamento" value="<?php echo $array_kit['rastreamento']; ?>">
                        <div class="form-inline" id="rastreamento_error"></div>
                    </div>
                    <div class="form-group">                        
                        <label for="label_Dia">Data Envio:</label>                        
                        <input type="date" class="form-control" id="data_envio" name="data_envio" value="<?php echo $date_format; ?>">
                        <div class="form-inline" id="data_envio_error"></div>
                    </div>
                    <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Editar Kit <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span></button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_convocar_loja"></div>
        </div>        
    </div>
</div>