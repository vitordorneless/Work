<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_tst_tipo_agendamento").load('tst_tecnicos_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_tst_tipo_agendamento").load('tst_tecnicos_listar.php');
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
            var registro = $("#registro").val();
            var cpf = $("#cpf").val();
            var id_cargo = $("#id_cargo").val();

            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o nome...</div>"),
                        $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }

            if ($("#registro").val() === '')
            {
                $("#registro_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Registro...</div>"),
                        $("#registro").focus();
                return false;
            } else {
                $("#registro_error").empty();
            }

            if ($("#cpf").val() === '')
            {
                $("#cpf_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o CPF...</div>"),
                        $("#cpf").focus();
                return false;
            } else {
                $("#cpf_error").empty();
            }

            if ($("#id_cargo").val() === 'na')
            {
                $("#id_cargo_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Cargo deste...</div>"),
                        $("#id_cargo").focus();
                return false;
            } else {
                $("#id_cargo_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/tst_tecnicos_incluir.php",
                data: "nome=" + nome + "&registro=" + registro + "&cpf=" + cpf + "&id_cargo=" + id_cargo,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                            $("#form")[0].reset(),
                            $("#refresca_tst_tipo_agendamento").load('tst_tecnicos_listar.php');
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">
    <h2><strong>Incluir</strong> TST</h2>
    <div class="additional-btn">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    </div>
</div>
<div class="modal-body">
    <div id="basic-form">
        <form id="form" method="POST">
            <div class="form-group">
                <label for="label_data_agendamento">Nome:</label>                
                <input type="text" class="form-control" id="nome" name="nome">                
                <div class="form-inline" id="nome_error"></div>
            </div>
            <div class="form-group">
                <label for="label_data_agendamento">Registro:</label>
                <input type="text" class="form-control" id="registro" name="registro">
                <div class="form-inline" id="registro_error"></div>
            </div>
            <div class="form-group">
                <label for="label_data_agendamento">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf">
                <div class="form-inline" id="cpf_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Cargo:</label>
                <select class="form-control" id="id_cargo" name="id_cargo" required>
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    include '../config/database_mysql.php';
                    $pdo = Database::connect();
                    $sql1 = "select id, nome_cargo from tst_cargo_tecnicos where status = 1 order by nome_cargo asc";
                    foreach ($pdo->query($sql1) as $value) {
                        echo '<option value="' . $value['id'] . '">' . $value['nome_cargo'] . '</option>';
                    }
                    Database::disconnect();
                    ?>
                </select>
                <div class="form-inline" id="id_cargo_error"></div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-linkedin pull-right" id="envia" type="submit">Salvar TST <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
            </div>
        </form>
    </div>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>