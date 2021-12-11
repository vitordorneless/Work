<?php
session_start();
include '../config/database_mysql.php';
$pdo = Database::connect();
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$ativos = new Wal_Ativos();
$ativos->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array = $ativos->Dados_Wal_Ativos_id($ativos->get_id());
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
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
            var id = $("#id").val();
            var data_periodico = $("#data_periodico").val();

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/ativos_error_trat2016.php",
                data: "id=" + id + "&data_periodico=" + data_periodico,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                    $("#form")[0].reset(),
                    $("#refresca_error").load("ativos_error.php");
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
            <h2 class="text-error"><strong>Ativos</strong> Walmart com erro</h2>
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
                        <label>Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Associado" value="<?php echo $array['nome_funcionario']; ?>">
                        <input type="hidden" id="id" name="id" value="<?php echo $array['id']; ?>">
                        <div class="form-inline" id="nome_error"></div>
                    </div>
                    <div class="form-group">
                        <label>CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Apenas Números" maxlength="11" value="<?php echo $array['cpf']; ?>">
                        <div class="form-inline" id="cpf_error"></div>
                    </div>
                    <div class="form-group">
                        <?php
                        $date_format1 = date("Y-m-d", strtotime(trim($array['data_periodico'])));
                        ?>
                        <label for="estabelecimento_label">Data do Exame Clínico:</label>
                        <input type="date" class="form-inline" id="data_periodico" name="data_periodico" value="<?php echo $date_format1; ?>">                        
                        <div class="form-inline" id="caixa_error"></div>
                    </div>
                    <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Ativo Walmart CORRETO<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
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