<?php
session_start();
include '../config/database_mysql.php';
require '../Model/Cassi.php';
require '../Model/Cassi_Solicitar_Exame.php';
$pdo = Database::connect();
$cassi = new Cassi_Solicitar_Exame();
$cassi->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_cassi = $cassi->Dados_Cassi_Solicitar_Exames($cassi->get_id());
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_cassi_solicitar").load('cassi_solicitar_exame.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_cassi_solicitar").load('cassi_solicitar_exame.php');
            }
        });
        var id_prestador = '<?php echo $array_cassi['id_prestador']; ?>';
        $('#id_medico').load('../Controller/combo_medico_selected.php?id_prestador=' + id_prestador);

        $('#id_prestador').change(function () {
            $('#id_medico').load('../Controller/combo_medico.php?id_prestador=' + $('#id_prestador').val());
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var id_exame = $("#id_exame").val();
            var data_solicitacao = $("#data_solicitacao").val();
            var nome = $("#nome").val();
            var rg = $("#rg").val();
            var cpf = $("#cpf").val();
            var data_nascimento = $("#data_nascimento").val();
            var funcao = $("#funcao").val();
            var id_cassi_solicitante = $("#id_cassi_solicitante").val();
            var id_prestador = $("#id_prestador").val();
            var id_medico = $("#id_medico").val();
            var id_cidade_solicitada = $("#id_cidade_solicitada").val();
            var id_cidade_realizada = $("#id_cidade_realizada").val();
            var turno = $("#turno").val();
            var prazo_limite = $("#prazo_limite").val();
            var horario = $("#horario").val();
            var data_exame = $("#data_exame").val();
            var obs = $("#obs").val();
            var status = $("#status").val();
            var user = $("#user").val();
            var id = $("#id").val();

            if ($("#id_exame").val() === 'na')
            {
                $("#id_exame_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Tipo de Exame...</div>").hide(9000),
                        $("#id_exame").focus();
                return false;
            } else {
                $("#id_exame_error").empty();
            }

            if ($("#data_solicitacao").val() === '')
            {
                $("#data_solicitacao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Data da Solicitação...</div>").hide(9000),
                        $("#data_solicitacao").focus();
                return false;
            } else {
                $("#data_solicitacao_error").empty();
            }

            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha um nome da Lista, ou Digite o nome do Ativo...</div>").hide(9000),
                        $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }

            if ($("#rg").val() === '')
            {
                $("#rg_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Identidade...</div>").hide(9000),
                        $("#rg").focus();
                return false;
            } else {
                $("#rg_error").empty();
            }

            if ($("#cpf").val() === '')
            {
                $("#cpf_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o CPF...</div>").hide(9000),
                        $("#cpf").focus();
                return false;
            } else {
                $("#cpf_error").empty();
            }

            if ($("#data_nascimento").val() === '')
            {
                $("#data_nascimento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Data de Nascimento...</div>").hide(9000),
                        $("#data_nascimento").focus();
                return false;
            } else {
                $("#data_nascimento_error").empty();
            }

            if ($("#funcao").val() === '')
            {
                $("#funcao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Função...</div>").hide(9000),
                        $("#funcao").focus();
                return false;
            } else {
                $("#funcao_error").empty();
            }

            if ($("#id_cassi_solicitante").val() === 'na')
            {
                $("#id_cassi_solicitante_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Solicitante da CASSI...</div>").hide(9000),
                        $("#id_cassi_solicitante").focus();
                return false;
            } else {
                $("#id_cassi_solicitante_error").empty();
            }

            if ($("#id_prestador").val() === 'na')
            {
                $("#id_prestador_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Prestador...</div>").hide(9000),
                        $("#id_prestador").focus();
                return false;
            } else {
                $("#id_prestador_error").empty();
            }

            if ($("#id_medico").val() === 'na')
            {
                id_medico = 0;
            }

            if ($("#id_cidade_solicitada").val() === 'na')
            {
                $("#id_cidade_solicitada_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Cidade Solicitada...</div>").hide(9000),
                        $("#id_cidade_solicitada").focus();
                return false;
            } else {
                $("#id_cidade_solicitada_error").empty();
            }

            if ($("#id_cidade_realizada").val() === 'na')
            {
                id_cidade_realizada = 0;
            }

            if ($("#turno").val() === 'na')
            {
                $("#turno_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe qual o Turno...</div>").hide(9000),
                        $("#turno").focus();
                return false;
            } else {
                $("#turno_error").empty();
            }

            if ($("#prazo_limite").val() === '')
            {
                $("#prazo_limite_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Prazo Limite...</div>").hide(9000),
                        $("#prazo_limite").focus();
                return false;
            } else {
                $("#prazo_limite_error").empty();
            }

            if ($("#horario").val() === '')
            {
                $("#horario_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Horário...</div>").hide(9000),
                        $("#horario").focus();
                return false;
            } else {
                $("#horario_error").empty();
            }

            if ($("#data_exame").val() === '')
            {
                $("#data_exame_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Data do Exame...</div>").hide(9000),
                        $("#data_exame").focus();
                return false;
            } else {
                $("#data_exame_error").empty();
            }

            if ($("#obs").val() === '')
            {
                obs = 'Não Informado';
            }

            if ($("#status").val() === 'na')
            {
                $("#status_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Status...</div>").hide(9000),
                        $("#status").focus();
                return false;
            } else {
                $("#status_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/cassi_solicitar_exame_editar.php",
                data: "id_exame=" + id_exame + "&data_solicitacao=" + data_solicitacao + "&nome=" + nome + "&rg=" + rg +
                        "&cpf=" + cpf + "&data_nascimento=" + data_nascimento + "&funcao=" + funcao + "&id_cassi_solicitante=" + id_cassi_solicitante + "&id_prestador=" + id_prestador +
                        "&id_medico=" + id_medico + "&id_cidade_solicitada=" + id_cidade_solicitada + "&id_cidade_realizada=" + id_cidade_realizada + "&turno=" + turno + "&prazo_limite=" + prazo_limite +
                        "&horario=" + horario + "&data_exame=" + data_exame + "&obs=" + obs + "&status=" + status + "&user=" + user + "&id=" + id,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                            $("#form")[0].reset(),
                            $("#refresca_cassi_solicitar").load('cassi_solicitar_exame.php');
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
    <h4 class="modal-title">Editar Solicitante CASSI</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_exame">Exame:</label>
            <select class="form-control" id="id_exame" name="id_exame">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql = "select id, nome_exame from cassi_exames where status = 1 order by nome_exame asc";
                foreach ($pdo->query($sql) as $value) {
                    $option = $value['id'] == $array_cassi['id_exame'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . utf8_encode($value['nome_exame']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_exame_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data_solicitacao">Data da Solicitação:</label>
            <?php
            $format_data = trim($array_cassi['data_solicitacao']);
            $date_solicitacao = date("Y-m-d", strtotime($format_data));
            ?>
            <input type="date" class="form-control" id="data_solicitacao" name="data_solicitacao" value="<?php echo $date_solicitacao; ?>">
            <div class="form-inline" id="data_solicitacao_error"></div>
        </div>        
        <div class="form-group">
            <label for="label_nome">Nome:</label>            
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o Nome do Solicitante..." value="<?php echo $array_cassi['nome_funcionario']; ?>">
            <div class="form-inline" id="nome_error"></div>
        </div>
        <div class="form-group">
            <label for="label_rg">Identidade:</label>            
            <input type="text" class="form-control" id="rg" name="rg" placeholder="Informe a Identidade..." maxlength="20" value="<?php echo $array_cassi['identidade']; ?>">
            <div class="form-inline" id="rg_error"></div>
        </div>
        <div class="form-group">
            <label for="label_cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Informe o CPF..." maxlength="11" value="<?php echo $array_cassi['cpf']; ?>">
            <div class="form-inline" id="cpf_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data_nascimento">Data de Nascimento:</label>
            <?php
            $format_dataa = trim($array_cassi['nascimento']);
            $nascimento = date("Y-m-d", strtotime($format_dataa));
            ?>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $nascimento; ?>">
            <div class="form-inline" id="data_nascimento_error"></div>
        </div>
        <div class="form-group">
            <label for="label_funcao">Função:</label>
            <input type="text" class="form-control" id="funcao" name="funcao" placeholder="Informe a Função..." value="<?php echo $array_cassi['funcao']; ?>">
            <div class="form-inline" id="funcao_error"></div>
        </div>
        <div class="form-group">
            <label for="label_solicitante">Solicitante:</label>
            <select class="form-control" id="id_cassi_solicitante" name="id_cassi_solicitante" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql2 = "select id, nome from cassi_solicitante where status = 1 order by nome asc";
                foreach ($pdo->query($sql2) as $value) {
                    $option = $value['id'] == $array_cassi['id_cassi_solicitante'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . utf8_encode($value['nome']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_cassi_solicitante_error"></div>
        </div>
        <div class="form-group">
            <label for="label_prestador">Prestador:</label>
            <select class="form-control" id="id_prestador" name="id_prestador" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql3 = "select id, razao_social from wal_prestadores where status = 1 order by razao_social asc";
                foreach ($pdo->query($sql3) as $value) {
                    $option = $value['id'] == $array_cassi['id_prestador'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . utf8_encode($value['razao_social']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_prestador_error"></div>
        </div>
        <div class="form-group">
            <label for="medico_label">Médico:</label>
            <select class="form-control" id="id_medico" name="id_medico">
                <option selected value="na">
                    Aguardando...
                </option>
            </select>
            <div class="form-inline" id="id_medico_error"></div>
        </div>
        <div class="form-group">
            <label for="label_cidade_solicitada">Cidade Solicitada:</label>
            <select class="form-control" id="id_cidade_solicitada" name="id_cidade_solicitada" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql4 = "select id, nom_cidade from cidade where cod_estado = 21 order by nom_cidade asc";
                foreach ($pdo->query($sql4) as $value) {
                    $option = $value['id'] == $array_cassi['id_cidade_solicitada'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . utf8_encode($value['nom_cidade']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_cidade_solicitada_error"></div>
        </div>
        <div class="form-group">
            <label for="label_cidade_realizada">Cidade Realizada:</label>
            <select class="form-control" id="id_cidade_realizada" name="id_cidade_realizada" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql5 = "select id, nom_cidade from cidade where cod_estado = 21 order by nom_cidade asc";
                foreach ($pdo->query($sql5) as $value) {
                    $option = $value['id'] == $array_cassi['id_cidade_realizada'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . utf8_encode($value['nom_cidade']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_cidade_realizada_error"></div>
        </div>
        <div class="form-group">
            <label for="label_turnos">Turno:</label>
            <select class="form-control" id="turno" name="turno">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql6 = "select id, nome_turno from cassi_turnos order by nome_turno asc";
                foreach ($pdo->query($sql6) as $value) {
                    $option = $value['id'] == $array_cassi['turno'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . utf8_encode($value['nome_turno']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="turno_error"></div>
        </div>
        <div class="form-group">
            <label for="label_prazo_limite">Prazo Limite:</label>
            <?php
            $format_dataaa = trim($array_cassi['prazo_limite']);
            $prazo_limite = date("Y-m-d", strtotime($format_dataaa));
            ?>
            <input type="date" class="form-control" id="prazo_limite" name="prazo_limite" value="<?php echo $prazo_limite; ?>">
            <div class="form-inline" id="prazo_limite_error"></div>
        </div>
        <div class="form-group">
            <label for="label_horario">Horário:</label>            
            <input type="time" class="form-control" id="horario" name="horario" value="<?php echo $array_cassi['horario']; ?>">
            <div class="form-inline" id="horario_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data_exame">Data Exame:</label>
            <?php
            $format_dataaaa = trim($array_cassi['data_exame']);
            $data_exame = date("Y-m-d", strtotime($format_dataaaa));
            ?>
            <input type="date" class="form-control" id="data_exame" name="data_exame" value="<?php echo $data_exame; ?>">
            <input type="hidden" id="user" name="user" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" id="id" name="id" value="<?php echo $array_cassi['id']; ?>">
            <div class="form-inline" id="data_exame_error"></div>
        </div>
        <div class="form-group">
            <label for="label_obs">Observações:</label>                        
            <textarea class="form-control" name="obs" id="obs"><?php echo $array_cassi['obs']; ?></textarea>
            <div class="form-inline" id="obs_error"></div>
        </div>
        <div class="form-group">
            <label for="label_status">Status:</label>
            <select class="form-control" id="status" name="status">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql7 = "select id, nome_status from cassi_status_exames order by nome_status asc";
                foreach ($pdo->query($sql7) as $value) {
                    $option = $value['id'] == $array_cassi['status'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . utf8_encode($value['nome_status']) . '</option>';
                }
                Database::disconnect();
                ?>
            </select>
            <div class="form-inline" id="status_error"></div>
        </div>
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Solicitar Exame CASSI <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>