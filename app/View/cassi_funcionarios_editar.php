<?php
session_start();
include '../config/database_mysql.php';
require '../Model/Cassi.php';
require '../Model/Cassi_Ativos.php';
$pdo = Database::connect();
$cassi = new Cassi_Ativos();
$cassi->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_cassi = $cassi->Dados_Cassi_Ativoss($cassi->get_id());
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_cassi_funcionarios").load('cassi_funcionarios_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_cassi_funcionarios").load('cassi_funcionarios_listar.php');
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
            var matricula = $("#matricula").val();
            var agencia = $("#agencia").val();
            var nome_funcionario = $("#nome_funcionario").val();
            var sexo = $("#sexo").val();
            var nascimento = $("#nascimento").val();
            var usuario = $("#usuario").val();
            var id = $("#id").val();
            var status = $("#status").val();
            var data_posse = $("#data_posse").val();
            var obs = $("#obs").val();

            if ($("#matricula").val() === '')
            {
                $("#matricula_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Matrícula do Ativo, caso não tenha, informe 0...</div>").hide(9000),
                        $("#matricula").focus();
                return false;
            } else {
                $("#matricula_error").empty();
            }

            if ($("#agencia").val() === 'na')
            {
                $("#agencia_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Agência...</div>").hide(9000),
                        $("#agencia").focus();
                return false;
            } else {
                $("#agencia_error").empty();
            }

            if ($("#nome_funcionario").val() === '')
            {
                $("#nome_funcionario_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Nome do Indivíduo...</div>").hide(9000),
                        $("#nome_funcionario_envio").focus();
                return false;
            } else {
                $("#nome_funcionario_error").empty();
            }

            if ($("#nascimento").val() === '')
            {
                $("#nascimento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Data de Nascimento...</div>").hide(9000),
                        $("#nascimento").focus();
                return false;
            } else {
                $("#nascimento_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/cassi_funcionarios_editar.php",
                data: "matricula=" + matricula + "&agencia=" + agencia + "&nome_funcionario=" + nome_funcionario + "&sexo=" + sexo + "&nascimento=" + nascimento +
                        "&usuario=" + usuario + "&id=" + id + "&status=" + status + "&data_posse=" + data_posse + "&obs=" + obs,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                            $("#form")[0].reset(),
                            $("#refresca_cassi_funcionarios").load('cassi_funcionarios_listar.php');
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
    <h4 class="modal-title">Editar Funcionário CASSI</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_matricula">Matrícula:</label>            
            <input type="text" class="form-control" id="matricula" name="matricula" value="<?php echo $array_cassi['matricula']; ?>" autofocus>            
            <div class="form-inline" id="matricula_error"></div>
        </div>
        <div class="form-group">
            <label for="agencia_label">Agência:</label>
            <select class="form-control" id="agencia" name="agencia" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql = "select prefixo, dependencia, municipio from cassi_agencia order by prefixo asc";
                foreach ($pdo->query($sql) as $value) {
                    $option = $value['prefixo'] == $array_cassi['prefixo_agencia'] ? 'value="' . $value['prefixo'] . '" selected' : 'value="' . $value['prefixo'] . '"';
                    echo '<option ' . $option . '>' . $value['prefixo'] . ' - ' . $value['dependencia'] . ' - ' . $value['municipio'] . '</option>';
                }
                Database::disconnect();
                ?>
            </select>
            <div class="form-inline" id="agencia_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Nome do Funcionário:</label>            
            <input type="text" class="form-control" id="nome_funcionario" name="nome_funcionario" value="<?php echo $array_cassi['nome_ativo']; ?>">            
            <div class="form-inline" id="nome_funcionario_error"></div>
        </div>
        <div class="form-group">
            <label for="label_sexo">Sexo</label>
            <select class="form-control" id="sexo" name="sexo" required>
                <?php
                $seleciona1 = $array_cassi['id_sexo'] == 1 ? " selected " : " ";
                $seleciona2 = $array_cassi['id_sexo'] == 2 ? " selected " : " ";
                ?>
                <option <?php echo $seleciona1; ?> value="1">
                    Masculino
                </option>
                <option <?php echo $seleciona2; ?> value="2">
                    Feminino
                </option>
            </select>
        </div>        
        <div class="form-group">
            <label for="label_data">Data Nascimento:</label>            
            <input type="text" class="form-control" id="nascimento" name="nascimento" value="<?php echo $array_cassi['data_nascimento']; ?>">
            <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" id="id" name="id" value="<?php echo $array_cassi['id']; ?>">
            <input type="hidden" id="obs" name="obs" value="<?php echo $array_cassi['obs']; ?>">
            <input type="hidden" id="data_posse" name="data_posse" value="01/01/1111">            
            <div class="form-inline" id="nascimento_error"></div>
        </div>
        <div class="form-group">
            <label for="label_status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <?php
                $seleciona3 = $array_cassi['status'] == 1 ? " selected " : " ";
                $seleciona4 = $array_cassi['status'] == 0 ? " selected " : " ";
                ?>
                <option <?php echo $seleciona3; ?> value="1">
                    Ativo
                </option>
                <option <?php echo $seleciona4; ?> value="0">
                    Inativo
                </option>
            </select>
        </div>        
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Editar Funcionário CASSI <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>