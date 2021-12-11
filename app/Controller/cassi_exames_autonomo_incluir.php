<?php
include '../config/database_mysql.php';
$pdo = Database::connect();
require '../Model/Cassi.php';
require '../Model/Cassi_Ativos.php';
$ativos = new Cassi_Ativos();
$ativos->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$id = $ativos->get_id();
$array_ativo_cassi = $ativos->Dados_Cassi_Ativoss($id);
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script src="../js/maskMoney.js"></script>
<script>
    $(document).ready(function () {

        $("input.dinheiro").maskMoney({showSymbol: false, decimal: ",", thousands: "."});

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
            var id_medico = $("#id_medico").val();
            var id_funcionario = $("#id_funcionario").val();
            var consulta = $("#consulta").val();

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/cassi_exames_autonomo_incluir_execute_form.php",
                data: "id_medico=" + id_medico + "&id_funcionario=" + id_funcionario + "&finalizado=" + finalizado +
                        "&pendente=" + pendente + "&nao_realizou=" + nao_realizou +
                        "&funcionario_ausente=" + funcionario_ausente + "&obs_gerais=" + obs_gerais + "&consulta=" + consulta,
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
            <label for="label_uf">Médico:</label>
            <select class="form-control" id="id_medico" name="id_medico">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql2 = "select id_medico, nome from wal_medico where status = 1 and id_medico not in (1,2,3,4) order by nome asc";
                foreach ($pdo->query($sql2) as $value) {
                    $option = $value['id_medico'] == 700 ? 'value="' . $value['id_medico'] . '" selected' : 'value="' . $value['id_medico'] . '"';
                    echo '<option ' . $option . '>' . $value['nome'] . '</option>';
                }
                Database::disconnect();
                ?>
            </select>
            <div class="form-inline" id="id_unidade_error"></div>
        </div>
        <div class="form-group">
            <label for="label_consulta">Valor da Consulta:</label>
            <div class="input-group">
                <span class="input-group-addon">R$</span>
                <input type="text" class="form-control dinheiro" id="consulta" name="consulta" placeholder="Informe Valor Acertado">
            </div>
            <div class="form-inline" id="consulta_error"></div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="finalizado" id="finalizado"> Finalizado
                    <input type="hidden" id="id_funcionario" name="id_funcionario" value="<?php echo $array_ativo_cassi['id']; ?>">
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