<?php
include '../config/database_mysql.php';
require '../Model/Convocar.php';
require '../Model/Convocacao.php';
require '../Model/Evento_Convocacao.php';
require '../Model/Medico.php';
require '../Model/Responsavel_Walmart.php';
require '../Model/Responsaveis_Walmart.php';
require '../Model/Empresas_Walmart.php';
require '../Model/Estabelecimentos_Walmart.php';
$responsavel = new Responsaveis_Walmart();
$convocacao = new Evento_Convocacao();
$empresa = new Empresas_Walmart();
$estabelecimento = new Estabelecimentos_Walmart();
$convocacao->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_convocacao = $convocacao->Dados_Evento_Convocacao_completos($convocacao->get_id());
$array_responsavel = $responsavel->Dados_Responsaveis_Walmart($array_convocacao['responsavel']);
$array_empresa = $empresa->Dados_Empresa_Walmart($array_convocacao['cod_empresa']);
$array_estabelecimento = $estabelecimento->Dados_Estabelecimento_Walmart($array_convocacao['cod_estabelecimento']);
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }
        
        $("#fechar_modal").click(function () {
            $("#refresca_enviar_convocacao").load('convocar_enviar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_enviar_convocacao").load('convocar_enviar.php');
            }
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {

            $("#conteudo_enviar_convocacao").empty();
            var id = $("#id").val();
            var to2 = $("#to2").val();
            var to3 = $("#to3").val();
            var to4 = $("#to4").val();
            var to5 = $("#to5").val();
            var to6 = $("#to6").val();
            var to7 = $("#to7").val();
            var to8 = $("#to8").val();
            var to9 = $("#to9").val();

            if ($("#to2").val() !== '') {
                if (!validateEmail($("#to2").val())) {
                    $("#extra_mail_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Email corretamente...</div>"),
                            $("#to2").focus();
                    return false;
                }
            } else {
                to2 = 'na';
            }
            
            if ($("#to3").val() !== '') {
                if (!validateEmail($("#to3").val())) {
                    $("#extra_mail_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Email corretamente...</div>"),
                            $("#to3").focus();
                    return false;
                }
            } else {
                to3 = 'na';
            }
            
            if ($("#to4").val() !== '') {
                if (!validateEmail($("#to4").val())) {
                    $("#extra_mail_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Email corretamente...</div>"),
                            $("#to4").focus();
                    return false;
                }
            } else {
                to4 = 'na';
            }
            
            if ($("#to5").val() !== '') {
                if (!validateEmail($("#to5").val())) {
                    $("#extra_mail_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Email corretamente...</div>"),
                            $("#to5").focus();
                    return false;
                }
            } else {
                to5 = 'na';
            }
            
            if ($("#to6").val() !== '') {
                if (!validateEmail($("#to6").val())) {
                    $("#extra_mail_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Email corretamente...</div>"),
                            $("#to6").focus();
                    return false;
                }
            } else {
                to6 = 'na';
            }
            
            if ($("#to7").val() !== '') {
                if (!validateEmail($("#to7").val())) {
                    $("#extra_mail_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Email corretamente...</div>"),
                            $("#to7").focus();
                    return false;
                }
            } else {
                to7 = 'na';
            }
            
            if ($("#to8").val() !== '') {
                if (!validateEmail($("#to8").val())) {
                    $("#extra_mail_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Email corretamente...</div>"),
                            $("#to8").focus();
                    return false;
                }
            } else {
                to8 = 'na';
            }
            
            if ($("#to9").val() !== '') {
                if (!validateEmail($("#to9").val())) {
                    $("#extra_mail_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Email corretamente...</div>"),
                            $("#to9").focus();
                    return false;
                }
            } else {
                to9 = 'na';
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/convocar_enviar_email.php",
                data: "id=" + id + "&to2=" + to2 + "&to3=" + to3 + "&to4=" + to4 + "&to5=" + to5 + "&to6=" + to6 + "&to7=" + to7 + "&to8=" + to8 + "&to9=" + to9,
                beforeSend: function () {
                    $("#conteudo_enviar_convocacao").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_enviar_convocacao").html(response),
                            $("#refresca_enviar_convocacao").load('convocar_enviar.php');
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
    <h4 class="modal-title">Efetivar Convocação</h4>
</div>			
<div class="modal-body">
    <form id="form" class="form-group" method="POST">
        <div class="form-group">
            <label for="label_nome_convocacao">Nome Convocação:</label>
            <input type="text" class="form-control" id="nome_convocacao" name="nome_convocacao" placeholder="Nome da Convocação" value="<?php echo $array_convocacao['convocacao']; ?>" readonly="readonly">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $array_convocacao['id_evento']; ?>">            
        </div>
        <div class="form-group">
            <label for="label_kit">Kit Entregue:</label>
            <input type="text" class="form-control" id="kit_entregue" name="kit_entregue" placeholder="Kit" value="<?php echo $kit = $array_convocacao['kit'] == 1 ? "Sim, Entregue" : "Não entregue"; ?>" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="label_turnos">Quantidade de Turnos:</label>
            <input type="text" class="form-control" id="turnos" name="turnos" placeholder="Turnos" value="<?php echo $array_convocacao['turnos']; ?>" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="label_nome_responsavel">Nome do Responsável Walmart:</label>
            <input type="text" class="form-control" id="nome_responsavel_walmart" name="nome_responsavel_walmart" placeholder="Nome do Responsável" value="<?php echo $array_responsavel['nome_responsavel']; ?>" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="label_empresa">Empresa:</label>
            <input type="text" class="form-control" id="empresa" name="empresa" value="<?php echo $array_empresa['desc_empresa']; ?>" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="label_estabelecimento">Estabelecimento (Loja):</label>
            <input type="text" class="form-control" id="estabelecimento" name="estabelecimento" value="<?php echo $array_estabelecimento['desc_estabelecimento']; ?>" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="label_email_ama">Email AMA:</label>
            <input type="text" class="form-control" id="email_ama" name="email_ama" placeholder="Email AMA" value="<?php echo $array_convocacao['email_ama']; ?>" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="label_email_walmart">Email Walmart:</label>
            <input type="text" class="form-control" id="email_walmart" name="email_walmart" placeholder="Email Walmart" value="<?php echo $array_convocacao['email_walmart']; ?>" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="label_email_walmart">Datas:</label>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="info">
                        <th class="text-center"><small>Data</small></th>
                        <th class="text-center"><small>Inicio</small></th>
                        <th class="text-center"><small>Fim</small></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="info">
                        <th class="text-center"><small>Data</small></th>
                        <th class="text-center"><small>Inicio</small></th>
                        <th class="text-center"><small>Fim</small></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $pdo = Database::connect();
                    $sql1 = "select DATE_FORMAT(data_evento, '%d/%c/%Y') as data_evento, horario, horario_final from datas_eventos_convocacao where id_evento_convocacao = " . $array_convocacao['id_evento'];
                    foreach ($pdo->query($sql1) as $value) {
                        echo '<tr>';
                        echo '<td class="text-center"><small>' . $value['data_evento'] . '</small></td>';
                        echo '<td class="text-center"><small>' . $value['horario'] . '</small></td>';
                        echo '<td class="text-center"><small>' . $value['horario_final'] . '</small></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <label for="label_email_walmart">Médicos:</label>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="info">
                        <th class="text-center"><small>CRM</small></th>
                        <th class="text-center"><small>Nome Médico</small></th>
                        <th class="text-center"><small>Turnos</small></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="info">
                        <th class="text-center"><small>CRM</small></th>
                        <th class="text-center"><small>Nome Médico</small></th>
                        <th class="text-center"><small>Turnos</small></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $sql = "SELECT mediquim.nome as nome, dimdim.turnos as turnos, dimdim.valor as valor, mediquim.crm as crm
                            FROM medicos_convocacao concocacacaca
                            inner join wal_medico mediquim on mediquim.id_medico = concocacacaca.id_medico 
                            inner join medicos_valores dimdim on dimdim.id = concocacacaca.id_medicos_valores
                            where concocacacaca.id_evento_convocacao = " . $array_convocacao['id_evento'];
                    foreach ($pdo->query($sql) as $value) {
                        echo '<tr>';
                        echo '<td class="text-center"><small>' . $value['crm'] . '</small></td>';
                        echo '<td class="text-center"><small>' . $value['nome'] . '</small></td>';
                        echo '<td class="text-center"><small>' . $value['turnos'] . '</small></td>';
                        echo '</tr>';
                    }
                    Database::disconnect();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <div class="form-inline" id="extra_mail_error"></div>
        </div>
        <div class="form-group">            
            <label>Email Extra (1):</label>
            <input type="text" class="form-control" id="to2" name="to2" placeholder="Email Extra">
        </div>
        <div class="form-group">
            <label>Email Extra (2):</label>
            <input type="text" class="form-control" id="to3" name="to3" placeholder="Email Extra">
        </div>
        <div class="form-group">
            <label>Email Extra (3):</label>
            <input type="text" class="form-control" id="to4" name="to4" placeholder="Email Extra">
        </div>
        <div class="form-group">
            <label>Email Extra (4):</label>
            <input type="text" class="form-control" id="to5" name="to5" placeholder="Email Extra">
        </div>
        <div class="form-group">
            <label>Email Extra (5):</label>
            <input type="text" class="form-control" id="to6" name="to6" placeholder="Email Extra">
        </div>
        <div class="form-group">
            <label>Email Extra (6):</label>
            <input type="text" class="form-control" id="to7" name="to7" placeholder="Email Extra">
        </div>
        <div class="form-group">
            <label>Email Extra (7):</label>
            <input type="text" class="form-control" id="to8" name="to8" placeholder="Email Extra">
        </div>
        <div class="form-group">
            <label>Email Extra (8):</label>
            <input type="text" class="form-control" id="to9" name="to9" placeholder="Email Extra">
        </div>
        <button class="btn btn-primary btn-success" id="envia" type="submit">Enviar Convocação para Loja</button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_enviar_convocacao"></div>
</div>