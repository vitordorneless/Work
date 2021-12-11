<?php
$caminho = '../../uploads/TXT_Bradesco/';
$dh  = opendir($caminho);
$string = "";
while (false !== ($filename = readdir($dh))) {$files[] = $filename;}
unset($files[0]);
unset($files[1]);
foreach ($files as $value) {$string = $string.'"'.$value.'",';}
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
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
            $("#conteudo_CASSI").empty();
            var nome = $("#nome").val();
            
            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/registro_relatorio_bradesco_gerar.php",
                data: "nome=" + nome,
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
            <h2><strong>Conversor</strong> de Críticas BRADESCO</h2>
            <div class="additional-btn">
                <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
            </div>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form id="form" method="POST">                    
                    <div class="form-group">                        
                        <div class="input-group">                            
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe com a extensão..." autofocus="autofocus">
                        </div>  
                        <div class="form-inline" id="nome_error"></div>
                    </div>
                    <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Gerar Excel Walmart <span class="glyphicon glyphicon-download" aria-hidden="true"></span></button>
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