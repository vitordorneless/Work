<?php
require '../Model/Responsavel_Walmart.php';
require '../Model/Responsaveis_Walmart.php';
$responsavel = new Responsaveis_Walmart();
$responsavel->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_responsavel = $responsavel->Dados_Responsaveis_Walmart($responsavel->get_id());
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }

        var id_loja = '<?php echo $array_responsavel['id_loja']; ?>';
        $('#estabelecimento').load('../Controller/combo_estabelecimento_selected.php?empresa=' + $('#empresa').val() + "&id_loja=" + id_loja);

        $('#empresa').change(function () {
            $('#estabelecimento').load('../Controller/combo_estabelecimento.php?empresa=' + $('#empresa').val());
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {

            $("#conteudo_responsavel_walmart_editar").empty();
            var id = $("#id").val();
            var nome = $("#nome").val();
            var empresa = $("#empresa").val();
            var estabelecimento = $("#estabelecimento").val();
            var ddd = $("#ddd").val();
            var telefone = $("#telefone").val();
            var email_responsavel = $("#email_responsavel").val();
            var status = $("#status").val();

            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome da Convocação...</div>"),
                        $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }

            if ($("#empresa").val() === 'na')
            {
                $("#empresa_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Empresa...</div>"),
                        $("#empresa").focus();
                return false;
            } else {
                $("#empresa_error").empty();
            }

            if ($("#estabelecimento").val() === '0')
            {
                $("#estabelecimento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Estabelecimento...</div>"),
                        $("#estabelecimento").focus();
                return false;
            } else {
                $("#estabelecimento_error").empty();
            }

            if (($("#ddd").val() === '' && $("#telefone").val() !== '') || ($("#ddd").val() !== '' && $("#telefone").val() === ''))
            {
                $("#telefone_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Telefone...</div>"),
                        $("#telefone").focus();
                return false;
            } else {
                $("#telefone_error").empty();
            }

            if ($("#ddd").val() === '' && $("#telefone").val() === '')
            {
                ddd = 0;
                telefone = 0;
            }

            if (!validateEmail($("#email_responsavel").val())) {
                $("#email_responsavel_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Email está Incorreto...</div>"),
                        $("#email_responsavel").focus();
                return false;
            } else {
                $("#email_responsavel_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/responsavel_walmart_editar.php",
                data: "nome=" + nome + "&id=" + id + "&status=" + status + "&empresa=" + empresa + "&estabelecimento=" + estabelecimento + "&ddd=" + ddd +
                        "&telefone=" + telefone + "&email_responsavel=" + email_responsavel,
                beforeSend: function () {
                    $("#conteudo_responsavel_walmart_editar").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_responsavel_walmart_editar").html(response),
                            $("#form")[0].reset(),
                            $("#refresca_responsavel_walmart_listar").load('responsavel_walmart_listar.php');
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
    <h4 class="modal-title">Editar Responsável Walmart</h4>
</div>			
<div class="modal-body">
    <form id="form" class="form-group" method="POST">
        <div class="form-group">
            <label for="label_nome_responsavel">Nome do Responsável:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Responsável" value="<?php echo $array_responsavel['nome_responsavel']; ?>" autofocus>
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $array_responsavel['id']; ?>">
            <div class="form-inline" id="nome_error"></div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label for="empresa_label">Empresa:</label>
                <select class="form-control" id="empresa" name="empresa" required>
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $pdo = Database::connect();
                    $sql = "SELECT cod_empresa, concat(cod_empresa,' - ',desc_empresa) as desc_empresas FROM wal_empresa ORDER BY desc_empresa ASC";
                    foreach ($pdo->query($sql) as $value) {
                        $option = $value['cod_empresa'] == $array_responsavel['id_empresa'] ? 'value="' . $value['cod_empresa'] . '" selected' : 'value="' . $value['cod_empresa'] . '"';
                        echo '<option ' . $option . '>' . $value['desc_empresas'] . '</option>';
                    }
                    Database::disconnect();
                    ?>
                </select>
                <div class="form-inline" id="empresa_error"></div>
            </div>
            <div class="form-group">
                <label for="estabelecimento_label">Estabelecimento:</label>
                <select class="form-control" id="estabelecimento" name="estabelecimento" required>
                    <option selected value="na">
                        Aguardando...
                    </option>
                </select>
                <div class="form-inline" id="estabelecimento_error"></div>
            </div>
            <div class="form-group">
                <label for="label_tel_responsavel">Telefone:</label>
                <input type="text" class="input-mini" id="ddd" name="ddd" placeholder="DDD" value="<?php echo $array_responsavel['ddd']; ?>">
                <input type="text" class="input-large" id="telefone" name="telefone" placeholder="999999999" maxlength="10" value="<?php echo $array_responsavel['telefone']; ?>">
                <div class="form-inline" id="telefone_error"></div>
            </div>
            <div class="form-group">
                <label for="label_email">Email do Responsável:</label>
                <input type="text" class="form-control" id="email_responsavel" name="email_responsavel" placeholder="Email do Responsável" value="<?php echo $array_responsavel['email']; ?>">
                <div class="form-inline" id="email_responsavel_error"></div>
            </div>
            <div class="form-group">
                <label for="label_status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <?php
                    $seleciona1 = $array_responsavel['status'] == 1 ? " selected " : " ";
                    $seleciona2 = $array_responsavel['status'] == 0 ? " selected " : " ";
                    ?>
                    <option <?php echo $seleciona1; ?> value="1">
                        Ativo
                    </option>
                    <option <?php echo $seleciona2; ?> value="0">
                        Inativo
                    </option>
                </select>
            </div>
        </div>
        <button class="btn btn-primary" id="envia" type="submit">Editar Responsável Walmart</button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_responsavel_walmart_editar"></div>
</div>