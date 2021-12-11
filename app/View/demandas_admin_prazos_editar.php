<?php
include '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$evento = new Demandas_Prazos();
$array = $evento->Dados_Demandas(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_cassi_solicitante").load('demandas_admin_prazos_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_cassi_solicitante").load('demandas_admin_prazos_listar.php');
            }
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
            var tipo = $("#tipo").val();            
            var id = $("#id").val();            

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
                url: "../Controller/demandas_admin_prazos_editar.php",
                data: "nome=" + nome + "&id=" + id + "&tipo=" + tipo,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),$("#form")[0].reset(),$("#refresca_cassi_solicitante").load('demandas_admin_prazos_listar.php');
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
    <h4 class="modal-title">Editar Prazos para Tipos de Demandas</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-inline">
            <label for="label_nome">Prazo:</label>            
            <input type="hidden" id="id" name="id" value="<?php echo $array['id']; ?>">
            <input type="number" class="form-control" id="nome" name="nome" placeholder="Informe o Prazo..." value="<?php echo $array['prazo']; ?>" autofocus>
            <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $array['tipo']; ?>">            
            <div class="form-inline" id="nome_error"></div>
        </div>        
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Editar <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>