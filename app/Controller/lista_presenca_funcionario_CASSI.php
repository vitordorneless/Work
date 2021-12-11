<?php
require '../Model/Cassi.php';
require '../Model/Cassi_Ativos.php';
$ativos = new Cassi_Ativos();
$ativos->set_id_medico(filter_input(INPUT_GET, 'id_medico', FILTER_SANITIZE_NUMBER_INT));
$ativos->set_prefixo(filter_input(INPUT_GET, 'agencia', FILTER_SANITIZE_STRING));
$ativos->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$id_medico = $ativos->get_id_medico();
$agencia = $ativos->get_prefixo();
$id = $ativos->get_id();
$array_ativo_cassi = $ativos->Dados_Cassi_Ativoss($id);
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

            $("#conteudo_cassi").empty();
            var finalizado = $("#finalizado").is(":checked") === true ? 1 : 0;
            var pendente = $("#pendente").is(":checked") === true ? 1 : 0;
            var nao_realizou = $("#nao_realizou").is(":checked") === true ? 1 : 0;
            var funcionario_ausente = $("#funcionario_ausente").is(":checked") === true ? 1 : 0;
            var obs_gerais = $("#obs_gerais").val();
            var id_medico = '<?php echo $id_medico; ?>';
            var agencia = '<?php echo $agencia; ?>';
            var id_funcionario = '<?php echo $id; ?>';
            
            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/lista_presenca_funcionario_CASSI_execute_form.php",
                data: "id_medico=" + id_medico + "&agencia=" + agencia + "&id_funcionario=" + id_funcionario + "&finalizado=" + finalizado + 
                        "&pendente=" + pendente + "&nao_realizou=" + nao_realizou +
                        "&funcionario_ausente=" + funcionario_ausente + "&obs_gerais=" + obs_gerais,
                beforeSend: function () {
                    $("#conteudo_cassi").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_cassi").html(response),
                    $("#form")[0].reset();
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">    
    <h4 class="modal-title">Situação do Funcionário <?php echo $array_ativo_cassi['nome_ativo']; ?></h4>
</div>			
<div class="modal-body">
    <form id="form" class="form-group" method="POST">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="finalizado" id="finalizado"> Finalizado
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="pendente" id="pendente"> Pendente
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="nao_realizou" id="nao_realizou"> Não Realizou
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="funcionario_ausente" id="funcionario_ausente"> Funcionário Ausente
                </label>
            </div>
        </div>
        <div class="form-group">
            <label>Observações Gerais:</label>
            <div class="text">
                <textarea class="text-info" rows="5" cols="30" name="obs_gerais" id="obs_gerais"></textarea>
            </div>
        </div>
        <button class="btn btn-primary btn-foursquare" id="envia" type="submit">Salvar Informações deste Funcionário <span class="glyphicon glyphicon-saved" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_cassi"></div>
</div>