<?php
session_start();
include '../config/database_mysql.php';
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $('#empresa').change(function () {
            $('#estabelecimento').load('../Controller/combo_estabelecimento.php?empresa=' + $('#empresa').val());
        });

        $('#estabelecimento').change(function () {
            $('#setor').load('../Controller/combo_setor.php?empresa=' + $('#empresa').val() + '&estabelecimento=' + $('#estabelecimento').val());
        });

        $('#setor').change(function () {
            $('#cargo').load('../Controller/combo_cargo.php?empresa=' + $('#empresa').val() + '&estabelecimento=' + $('#estabelecimento').val() + '&setor=' + $('#setor').val());
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo").empty();

            var empresa = $("#empresa").val();
            var estabelecimento = $("#estabelecimento").val();
            var nome = $("#nome").val();
            var rg = $("#rg").val();
            var cpf = $("#cpf").val();
            var nascimento = $("#nascimento").val();
            var setor = $("#setor").val();
            var cargo = $("#cargo").val();
            var cpf_medico = $("#cpf_medico").val();
            var obs = $("#obs").val();
            var matricula = '1';
            var id_medico = '<?php echo $_SESSION['user_id']; ?>';

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

            if ($("#nome").val() === '') {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Nome do Ativo...</div>"),
                $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }

            if ($("#rg").val() === '') {
                $("#rg_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe RG (Número da Identidade) do Ativo...</div>"),
                $("#rg").focus();
                return false;
            } else {
                $("#rg_error").empty();
            }

            if ($("#cpf").val() === '') {
                $("#cpf_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe CPF do Ativo...</div>"),
                $("#cpf").focus();
                return false;
            } else {
                $("#cpf_error").empty();
            }

            if ($("#nascimento").val() === '') {
                $("#nascimento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Data de Nascimento do Ativo...</div>"),
                $("#nascimento").focus();
                return false;
            } else {
                $("#nascimento_error").empty();
            }

            if ($("#setor").val() === 'na') {
                $("#setor_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha o Setor...</div>"),
                $("#setor").focus();
                return false;
            } else {
                $("#setor_error").empty();
            }

            if ($("#cargo").val() === 'na') {
                $("#cargo_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha o Cargo...</div>"),
                $("#cargo").focus();
                return false;
            } else {
                $("#cargo_error").empty();
            }

            if ($("#cpf_medico").val() === '') {
                $("#cpf_medico_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe seu CPF para constar no registro deste Erro...</div>"),
                $("#cpf_medico").focus();
                return false;
            } else {
                $("#cpf_medico_error").empty();
            }

            if ($("#obs").val() === '') {
                obs = "Não informado";
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/incluir_ativos_nao_constam.php",
                data: "empresa=" + empresa + "&estabelecimento=" + estabelecimento + "&nome=" + nome +
                        "&rg=" + rg + "&cpf=" + cpf + "&nascimento=" + nascimento + "&setor=" + setor +
                        "&cargo=" + cargo + "&cpf_medico=" + cpf_medico + "&obs=" + obs + "&matricula=" + matricula + "&id_medico=" + id_medico,
                beforeSend: function () {
                    $("#conteudo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo").html(response).hide(30090);
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
            <h2 class="text-center"><strong>Adicionar</strong> Ativos (funcionários) que não constam na lista</h2>
            <div class="additional-btn">
                <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
            </div>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form id="form" method="POST">
                    <div class="form-group">
                        <label for="empresa_label">Empresa:</label>
                        <select class="form-control selectpicker" id="empresa" name="empresa" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php                            
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
                        <select class="form-control" id="estabelecimento" name="estabelecimento" required>
                            <option selected value="na">
                                Aguardando...
                            </option>
                        </select>
                        <div class="form-inline" id="estabelecimento_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_turnos">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Ativo (Funcionário)">
                        <div class="form-inline" id="nome_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_Dia">RG / Identidade:</label>
                        <input type="text" class="form-control" id="rg" name="rg">                        
                        <div class="form-inline" id="rg_error"></div>
                    </div>                    
                    <div class="form-group">
                        <label for="label_Dia">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf">                        
                        <div class="form-inline" id="cpf_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_Dia">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="nascimento" name="nascimento">                        
                        <div class="form-inline" id="nascimento_error"></div>
                    </div>                    
                    <div class="form-group">
                        <label for="estabelecimento_label">Setor:</label>
                        <select class="form-control" id="setor" name="setor">
                            <option selected value="na">
                                Aguardando...
                            </option>
                        </select>
                        <div class="form-inline" id="setor_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="estabelecimento_label">Cargo:</label>
                        <select class="form-control" id="cargo" name="cargo">
                            <option selected value="na">
                                Aguardando...
                            </option>
                        </select>
                        <div class="form-inline" id="cargo_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_Dia">CPF do Médico:</label>
                        <input type="text" class="form-control" id="cpf_medico" name="cpf_medico" placeholder="Apenas Números">
                        <div class="form-inline" id="cpf_medico_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_obs">Observações:</label>
                        <textarea class="form-control" id="obs" name="obs" placeholder="Informe aqui, caso não conste o setor ou o cargo."></textarea>
                        <div class="form-inline" id="obs_error"></div>
                    </div>
                    <button class="btn btn-primary btn-facebook pull-left" id="envia" type="submit">Inserir Funcionário (ativo) Walmart que não consta na lista <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span></button>
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