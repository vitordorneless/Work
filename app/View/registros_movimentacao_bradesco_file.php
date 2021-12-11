<?php
session_start();
$id = $_SESSION['user_id'];
$caminho = '../../uploads/TXT_Bradesco/';
$dh  = opendir($caminho);
$string = "";
while (false !== ($filename = readdir($dh))) {$files[] = $filename;}
unset($files[0]);
unset($files[1]);
foreach ($files as $value) {$string = $string.'"'.$value.'",';}
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script src="../js/JQuery/jquery-ui-1.11.2.custom/jquery-ui.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {
        
        var arquivos = [ <?php echo substr($string,0,-1); ?> ];
        $("#nome").autocomplete({
		source: arquivos
	});

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_rh").empty();
            var nome = $("#nome").val();
            var data_retorno = $("#data_retorno").val();
            var id_usuario = $("#id_usuario").val();
            var arquivo_sig = $("#arquivo_sig").val();
            var data_arquivo_sig = $("#data_arquivo_sig").val();

            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome do Solicitante...</div>").hide(9000),
                        $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/registros_movimentacao_bradesco_file.php",
                data: "nome=" + nome + "&data_retorno=" + data_retorno + "&id_usuario=" + id_usuario + "&arquivo_sig=" + arquivo_sig + "&data_arquivo_sig=" + data_arquivo_sig,
                beforeSend: function () {
                    $("#conteudo_rh").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_rh").html(response);
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
        <div class="modal-body" id="forminho">
            <div class="widget-header transparent">
                <h2><strong>Gerar</strong> TXT Bradesco WEBTRAN</h2>
                <div class="additional-btn">                
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>                
                </div>
            </div>
            <div class="widget-content padding">
                <form id="form" method="POST">
                    <div class="form-group">
                        <label for="label_nome">Nome do Arquivo:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe com a extensão..." autofocus="autofocus">
                        <div class="form-inline" id="nome_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_nome">Data Retorno:</label>
                        <input type="date" class="form-control" id="data_retorno" name="data_retorno">
                        <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $id; ?>">
                        <div class="form-inline" id="data_retorno_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_obs">Arquivo(s) SIG:</label>                        
                        <textarea class="form-control" name="arquivo_sig" id="arquivo_sig">Informar</textarea>
                        <div class="form-inline" id="obs_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_nome">Data Arquivo SIG:</label>
                        <input type="date" class="form-control" id="data_arquivo_sig" name="data_arquivo_sig">
                        <div class="form-inline" id="nome_error"></div>
                    </div>
                    <button class="btn btn-primary btn-google-plus pull-right" id="envia" type="submit">Adicionar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
                </form>
            </div>
        </div>
        <div class="widget-content padding">
            <div id="conteudo_rh"></div>
        </div>        
    </div>        
</div>