<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {

        $('#empresa').change(function () {
            $('#estabelecimento').load('../Controller/combo_estabelecimento.php?empresa=' + $('#empresa').val());
        });

        $("#formm").submit(function () {
            return false;
        });

        $("#enviar").click(function () {
            envia_form();
        });

        function envia_form() {
            $("#conteudo").empty();
            var empresa = $("#empresa").val();
            var estabelecimento = $("#estabelecimento").val();
            var nome = $("#nome").val();
            var cpf = $("#cpf").val();
            var data_nascimento = $("#data_nascimento").val();
            var setor = $("#setor").val();
            var funcao = $("#funcao").val();

            if ($("#empresa").val() === 'na') {
                $("#empresa_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha uma Empresa...</div>"),
                $("#empresa").focus();
                return false;
            } else {
                $("#empresa_error").empty();
            }

            if (($("#empresa").val() !== 'na') && ($("#estabelecimento").val() === '0')) {
                $("#estabelecimento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha um Estabelecimento...</div>"),
                $("#estabelecimento").focus();
                return false;
            } else {
                $("#estabelecimento_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/incluir_ativos_Walmart.php",
                data: "empresa=" + empresa + "&estabelecimento=" + estabelecimento + "&nome=" + nome + "&cpf=" + cpf +
                        "&data_nascimento=" + data_nascimento + "&setor=" + setor + "&funcao=" + funcao,
                beforeSend: function () {
                    $("#conteudo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo").html(response),
                    $("#form")[0].reset();
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="row">
    <div class="widget">
        <div class="widget-header transparent">
            <h2><strong>Incluir Ativo</strong> Walmart</h2>
            <div class="additional-btn">                
                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
            </div>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form id="formm" method="POST">
                    <div class="form-group">
                        <label for="empresa_label">Empresa:</label>
                        <select class="form-control selectpicker" id="empresa" name="empresa" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            include '../config/database_mysql.php';
                            $pdo = Database::connect();
                            $sql = "SELECT cod_empresa, concat(cod_empresa,' - ',desc_empresa) as desc_empresas FROM wal_empresa ORDER BY desc_empresa ASC";
                            foreach ($pdo->query($sql) as $value) {
                                echo '<option value="' . $value['cod_empresa'] . '">' . $value['desc_empresas'] . '</option>';
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <div class="form-inline" id="empresa_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="estabelecimento_label">Estabelecimento:</label>
                        <select class="form-control selectpicker" id="estabelecimento" name="estabelecimento" required>
                            <option selected value="na">
                                Aguardando...
                            </option>
                        </select>
                        <div class="form-inline" id="estabelecimento_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_Nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Associado">
                        <div class="form-inline" id="nome_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_cpf">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Apenas Números" maxlength="11">
                        <div class="form-inline" id="cpf_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_nascimento">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
                        <div class="form-inline" id="data_nascimento_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_cpf">Setor:</label>
                        <input type="text" class="form-control" id="setor" name="setor" placeholder="Informe Setor">
                        <div class="form-inline" id="setor_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_cpf">Função:</label>
                        <input type="text" class="form-control" id="funcao" name="funcao" placeholder="Informe Função">
                        <div class="form-inline" id="funcao_error"></div>
                    </div>
                    <button class="btn btn-primary btn-dropbox pull-right" id="enviar" type="submit">Salvar Ativo WALMART <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo"></div>
        </div>        
    </div>
</div>