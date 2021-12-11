<?php
require '../Model/Convocar.php';
require '../Model/Evento_Convocacao.php';
$convocacao = new Evento_Convocacao();
$convocacao->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_convocacao = $convocacao->Dados_Evento_Convocacao_completos($convocacao->get_id());
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
            $("#conteudo_inserir_medicos").empty();
            var nome = $("#nome").val();
            var id = $("#id").val();
            var id_convocacao = $("#id_convocacao").val();
            var medico = $("#medico").val();
            var valor = $("#valor").val();
            var turnos = $("#turnos").val();
            var data_fechamento = $("#data_fechamento").val();

            if ($("#medico").val() === 'na')
            {
                $("#medico_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Médico...</div>"),
                        $("#medico").focus();
                return false;
            } else {
                $("#medico_error").empty();
            }

            if ($("#valor").val() === '')
            {
                $("#valor_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Valor da Consulta...</div>"),
                        $("#valor").focus();
                return false;
            } else {
                $("#valor_error").empty();
            }

            if ($("#turnos").val() === '')
            {
                $("#turnos_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Quantos Turnos o Médico irá atender...</div>"),
                        $("#turnos").focus();
                return false;
            } else {
                $("#turnos_error").empty();
            }

            if ($("#data_fechamento").val() === '')
            {
                $("#data_fechamento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Data do Fechamento...</div>"),
                        $("#data_fechamento").focus();
                return false;
            } else {
                $("#data_fechamento_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/inserir_medicos_evento.php",
                data: "nome=" + nome + "&id=" + id + "&medico=" + medico + "&valor=" + valor + "&turnos=" + turnos + "&data_fechamento=" + data_fechamento + "&id_convocacao=" + id_convocacao,
                beforeSend: function () {
                    $("#conteudo_inserir_medicos").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_inserir_medicos").html(response),
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
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title text-center">Incluir Médicos na Convocação</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_funcao">Nome da Convocação:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Convocação" value="<?php echo $array_convocacao['convocacao']; ?>" readonly>
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $array_convocacao['id_evento']; ?>">
            <input type="hidden" class="form-control" id="id_convocacao" name="id_convocacao" value="<?php echo $array_convocacao['id_convocacao']; ?>">
            <div class="form-inline" id="nome_error"></div>
        </div>
        <div class="form-group">            
            <label for="label_medico">Médico:</label>
            <select class="form-control" id="medico" name="medico" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $pdo = Database::connect();
                $sql = "select m.id_medico as id_medico, m.nome as nome, p.razao_social as razao_social 
                        from wal_medico m
                        inner join wal_prestadores p on m.id_prestador = p.id
                        where m.status = 1 
                        order by p.razao_social asc";
                foreach ($pdo->query($sql) as $value) {
                    echo '<option value="' . $value['id_medico'] . '">' . $value['nome'] . ' / '.$value['razao_social'].'</option>';
                }
                Database::disconnect();
                ?>
            </select>
            <div class="form-inline" id="medico_error"></div>        
        </div>
        <div class="form-group">
            <label for="label_Valor">Valor Consulta:</label>
            <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor Consulta">            
            <div class="form-inline" id="valor_error"></div>
        </div>
        <div class="form-group">
            <label for="label_Valor">Turnos:</label>
            <input type="number" class="form-control" id="turnos" name="turnos" min="1" max="200" value="<?php $array_convocacao['turnos'] ?>">
            <div class="form-inline" id="turnos_error"></div>
        </div>
        <div class="form-group">
            <label for="label_Valor">Data Acerto:</label>
            <input type="date" class="form-control" id="data_fechamento" name="data_fechamento">
            <div class="form-inline" id="data_fechamento_error"></div>
        </div>        
        <button class="btn btn-primary" id="envia" type="submit">Inserir Médico</button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_inserir_medicos"></div>
</div>