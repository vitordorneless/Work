<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_cassi_solicitante").load('demandas_admin_tipo_demandas_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_cassi_solicitante").load('demandas_admin_tipo_demandas_listar.php');
            }
        });
        
        $('#setor').change(function () {
            $('#user_executante').load('../Controller/combo_responsavel_tipo_demanda.php?setor=' + $('#setor').val());
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
            var sla = $("#sla").val();
            var setor = $("#setor").val();
            var user_executante = $("#user_executante").val();

            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }

            if ($("#sla").val() === 'na')
            {
                $("#sla_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#sla").focus();
                return false;
            } else {
                $("#sla_error").empty();
            }

            if ($("#setor").val() === 'na')
            {
                $("#setor_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#setor").focus();
                return false;
            } else {
                $("#setor_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/demandas_admin_tipo_demandas_incluir.php",
                data: "nome=" + nome + "&sla=" + sla + "&setor=" + setor + "&user_executante=" + user_executante,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                            $("#form")[0].reset(),
                            $("#refresca_cassi_solicitante").load('demandas_admin_tipo_demandas_listar.php');
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
    <h4 class="modal-title">Incluir Tipos de Demandas</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_nome">Nome da Demanda:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome da Demanda..." autofocus>            
            <div class="form-inline" id="nome_error"></div>
        </div>
        <div class="form-group">
            <label for="agencia_label">SLA:</label>
            <select class="form-control" id="sla" name="sla">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                include '../config/database_mysql.php';

                function __autoload($file) {
                    if (file_exists('../Model/' . $file . '.php'))
                        require_once('../Model/' . $file . '.php');
                    else
                        exit('O arquivo ' . $file . ' não foi encontrado!');
                }

                $querie = new Queries();
                $pdo = Database::connect();
                foreach ($pdo->query($querie->demanda_admin_listar_prazos_sla()) as $value) {
                    echo '<option value=' . $value['id'] . '>' . $value['prazo'] . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="sla_error"></div>
        </div>
        <div class="form-group">
            <label for="agencia_label">Setor Pertecente:</label>
            <select class="form-control" id="setor" name="setor">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                foreach ($pdo->query($querie->usuarios_setor()) as $value) {
                    echo '<option value=' . $value['id'] . '>' . $value['setor'] . '</option>';
                }
                Database::disconnect();
                ?>
            </select>
            <div class="form-inline" id="setor_error"></div>            
        </div>
        <div class="form-group">
            <label for="agencia_label">Executante:</label>
            <select class="form-control" id="user_executante" name="user_executante">
                <option selected value="na">
                    Aguardando...
                </option>                
            </select>
            <div class="form-inline" id="setor_error"></div>            
        </div>
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Salvar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>