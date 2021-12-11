<?php
include '../config/database_mysql.php';
require '../Model/Cassi.php';
require '../Model/Cassi_Agendamento.php';
$pdo = Database::connect();
$cassi = new Cassi_Agendamento();
$cassi->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_cassi = $cassi->Dados_Cassi_Agendamentos($cassi->get_id());
$quantos = $cassi->Quantos_ativos_este_agendamento_pegou($array_cassi['municipio']);
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script src="../js/maskMoney.js"></script>
<script>
    $(document).ready(function () {

        $("input.dinheiro").maskMoney({showSymbol: false, decimal: ",", thousands: "."});

        $("#fechar_modal").click(function () {
            $("#refresca_cassi_enviar").load('cassi_agendamento_enviar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_cassi_enviar").load('cassi_agendamento_enviar.php');
            }
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI_edit").empty();
            var id = $("#id").val();

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/cassi_enviar_email_agendamento.php",
                data: "id=" + id,
                beforeSend: function () {
                    $("#conteudo_CASSI_edit").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI_edit").html(response)/*,
                    $("#form")[0].reset(),
                    $("#refresca_cassi_enviar").load('cassi_agendamento_enviar.php')*/;
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
    <h4 class="modal-title">Enviar Email Agendamento CASSI</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">                    
        <div class="form-group">
            <label for="label_municipio">Agência:</label>
            <select class="form-control" id="municipio" name="municipio">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql = "select id, prefixo, dependencia from cassi_agencia order by municipio";
                foreach ($pdo->query($sql) as $value) {
                    $option = $value['id'] == $array_cassi['municipio'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . $value['prefixo'] . ' - ' . $value['dependencia'] . '</option>';
                }
                ?>
            </select>
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $array_cassi['id']; ?>">            
        </div>
        <div class="form-group">
            <label for="label_data_agendamento">Data do Agendamento:</label>
            <div class="input-group">
                <?php
                $format_data = trim($array_cassi['data_agendamento']);
                $date_format = date("Y-m-d", strtotime($format_data));
                ?>
                <input type="date" class="form-control" id="data_agendamento" name="data_agendamento" value="<?php echo $date_format; ?>" readonly="readonly">
            </div>            
        </div>
        <div class="form-group">
            <label for="label_horario_chegada">Horário de chegada:</label>
            <div class="input-group">                            
                <input type="time" class="form-control" id="horario_chegada" name="horario_chegada" value="<?php echo $array_cassi['horario']; ?>" readonly="readonly">
            </div>            
        </div>
        <div class="form-group">
            <label for="label_situacao">Situação:</label>
            <select class="form-control" id="situacao" name="situacao" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql1 = "select id, desc_situacao from cassi_situacao order by id asc";
                foreach ($pdo->query($sql1) as $value) {
                    $option1 = $value['id'] == $array_cassi['id_cassi_situacao'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option1 . '>' . utf8_encode($value['desc_situacao']) . '</option>';
                }
                ?>
            </select>            
        </div>
        <div class="form-group">
            <label for="label_medico">Médico:</label>
            <select class="form-control" id="medico" name="medico" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql2 = "select id_medico, nome from wal_medico order by id_medico asc";
                foreach ($pdo->query($sql2) as $value) {
                    $option2 = $value['id_medico'] == $array_cassi['id_medico'] ? 'value="' . $value['id_medico'] . '" selected' : 'value="' . $value['id_medico'] . '"';
                    echo '<option ' . $option2 . '>' . utf8_encode($value['nome']) . '</option>';
                }
                Database::disconnect();
                ?>
            </select>            
        </div>
        <div class="form-group">
            <label for="label_consulta">Valor da Consulta:</label>
            <div class="input-group">
                <span class="input-group-addon">R$</span>
                <input type="text" class="form-control dinheiro" id="consulta" name="consulta" placeholder="Informe Valor Acertado" value="<?php echo $array_cassi['valor_consulta']; ?>" readonly="readonly">
            </div>            
        </div>
        <div class="form-group">
            <label for="label_consulta">Quantidade de Ativos Agendados:</label>
            <div class="input-group">                
                <input type="text" class="form-control" value="<?php echo $quantos; ?>" readonly="readonly">
            </div>            
        </div>
        <div class="form-group">
            <label for="label_consulta">Previsão de Faturamento deste Médico:</label>
            <div class="input-group">
                <?php
                $consulta = (double) $array_cassi['valor_consulta'];
                $faturamento = bcmul($consulta, $quantos, 2);
                ?>
                <span class="input-group-addon">R$</span>
                <input type="text" class="form-control" value="<?php echo number_format($faturamento, 2, ',', '.'); ?>" readonly="readonly">
            </div>            
        </div>
        <div class="form-group">
            <label for="label_status_medico">Status:</label>
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
        </div>
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Enviar Email Agendamento CASSI <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI_edit"></div>
</div>