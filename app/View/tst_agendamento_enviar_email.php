<?php
include '../config/database_mysql.php';
include '../Model/Tecnicos_Seguranca_Trabalho.php';
include '../Model/TST_Agendamento.php';
$tst = new TST_Agendamento();
$tst->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_agendamento = $tst->Dados_TST_Agendamentos($tst->get_id());
$pdo = Database::connect();
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {
        
        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }

        $("#fechar_modal").click(function () {
            $("#refresca_tst_tipo_agendamento").load('tst_agendamento_enviar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_tst_tipo_agendamento").load('tst_agendamento_enviar.php');
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
                url: "../Controller/tst_agendamento_enviar_email.php",
                data: "id=" + id + "&to2=" + to2 + "&to3=" + to3 + "&to4=" + to4 + "&to5=" + to5 + "&to6=" + to6 + "&to7=" + to7 + "&to8=" + to8 + "&to9=" + to9,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),                    
                    $("#refresca_tst_tipo_agendamento").load('tst_agendamento_enviar.php');
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">
    <h2><strong>Enviar email de Convocação</strong> TST</h2>
    <div class="additional-btn">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    </div>
</div>
<div class="modal-body">
    <div id="basic-form">
        <form id="form" method="POST">
            <div class="form-group">
                <label for="label_uf">Tipo de Agendamento:</label>
                <select class="form-control" id="id_agendamento" name="id_agendamento">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql0 = "select id, nome_agendamento from tst_tipo_agendamento where status in (1) order by nome_agendamento asc";
                    foreach ($pdo->query($sql0) as $value) {
                        $option = $value['id'] == $array_agendamento['id_tipo_agendamento'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                        echo '<option ' . $option . '>' . $value['nome_agendamento'] . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_agendamento_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Loja / Unidade:</label>
                <select class="form-control" id="id_unidade" name="id_unidade">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql2 = "select id, nome_unidade from tst_unidades where status in (1) order by nome_unidade asc";
                    foreach ($pdo->query($sql2) as $value) {
                        $option = $value['id'] == $array_agendamento['id_unidade'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                        echo '<option ' . $option . '>' . utf8_encode($value['nome_unidade']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_unidade_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Turnos:</label>
                <select class="form-control" id="id_turnos" name="id_turnos">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql3 = "select id, turno from tst_turnos";
                    foreach ($pdo->query($sql3) as $value) {
                        $option = $value['id'] == $array_agendamento['id_turnos'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                        echo '<option ' . $option . '>' . utf8_encode($value['turno']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_turnos_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Situação:</label>
                <select class="form-control" id="id_situacao" name="id_situacao">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql4 = "select id, situacao from tst_situacao";
                    foreach ($pdo->query($sql4) as $value) {
                        $option = $value['id'] == $array_agendamento['id_situacao'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                        echo '<option ' . $option . '>' . utf8_encode($value['situacao']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_turnos_error"></div>
            </div>
            <?php
            $date_format = date("Y-m-d", strtotime(trim($array_agendamento['data_agendamento'])));
            ?>
            <div class="form-group">
                <label for="label_data_agendamento">Data do Agendamento:</label>
                <input type="date" class="form-control" id="data_agendamento" name="data_agendamento" value="<?php echo $date_format; ?>" readonly>
                <input type="hidden" id="id" name="id" value="<?php echo $array_agendamento['id']; ?>">
                <div class="form-inline" id="data_agendamento_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Técnicos AMA:</label>
                <select multiple class="form-control" id="id_tecnicos" name="id_tecnicos">
                    <option value="na">
                        Selecione...
                    </option>
                    <?php
                    $array_tecnicos = explode(',', $array_agendamento['tecnicos_ids']);
                    $sql1 = "select nome, id from tst_tecnicos where status in (1) order by nome asc";
                    $cont = 0;
                    foreach ($pdo->query($sql1) as $value) {
                        $option = $value['id'] == $array_tecnicos[$cont] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                        echo '<option ' . $option . '>' . utf8_encode($value['nome']) . '</option>';
                        ++$cont;
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_cargo_error"></div>
            </div>
            <div class="form-group">
                <label for="label_obs">Observações:</label>
                <textarea class="form-control" id="obs" name="obs" placeholder="Informe aqui, dados adicionais!!" readonly><?php echo $array_agendamento['obs']; ?></textarea>
                <div class="form-inline" id="obs_error"></div>
            </div>
            <div class="form-group">
                <label for="label_status_medico">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <?php
                    $seleciona1 = $array_agendamento['status'] == '1' ? "selected" : " ";
                    $seleciona2 = $array_agendamento['status'] == '0' ? "selected" : " ";
                    ?>
                    <option value="1" <?php echo $seleciona1; ?>>
                        Ativo
                    </option>
                    <option value="0" <?php echo $seleciona2; ?>>
                        Inativo
                    </option>                
                </select>
                <div class="form-inline" id="status_error"></div>
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
            <div class="form-group">
                <button class="btn btn-primary btn-linkedin pull-right" id="envia" type="submit">Enviar Agendamento <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
            </div>
            <?php Database::disconnect(); ?>
        </form>
    </div>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>