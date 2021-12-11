<?php
include '../config/database_mysql.php';
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {
        
        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }

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
            $("#conteudo_responsavel").empty();
            var nome = $("#nome").val();
            var empresa = $("#empresa").val();
            var estabelecimento = $("#estabelecimento").val();
            var ddd = $("#ddd").val();
            var telefone = $("#telefone").val();
            var email_responsavel = $("#email_responsavel").val();

            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome da Convocação...</div>"),
                $("#nome").focus();
                return false;
            }else{
                $("#nome_error").empty();
            }
            
            if ($("#empresa").val() === 'na')
            {
                $("#empresa_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Empresa...</div>"),
                $("#empresa").focus();
                return false;
            }else{
                $("#empresa_error").empty();
            }
            
            if ($("#estabelecimento").val() === '0')
            {
                $("#estabelecimento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Estabelecimento...</div>"),
                $("#estabelecimento").focus();
                return false;
            }else{
                $("#estabelecimento_error").empty();
            }
            
            if (($("#ddd").val() === '' && $("#telefone").val() !== '') || ($("#ddd").val() !== '' && $("#telefone").val() === ''))
            {
                $("#telefone_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Telefone...</div>"),
                $("#telefone").focus();
                return false;
            }else{
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
            }else{
                $("#email_responsavel_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/responsavel_walmart_adicionar.php",
                data: "nome=" + nome + "&empresa=" + empresa + "&estabelecimento=" + estabelecimento + "&ddd=" + ddd + "&telefone=" + telefone + "&email_responsavel=" + email_responsavel,
                beforeSend: function () {
                    $("#conteudo_responsavel").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_responsavel").html(response),
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
            <h2><strong>Adicionar</strong> Responsável Walmart</h2>
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
                        <label for="label_nome_responsavel">Nome do Responsável:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Responsável" autofocus>
                        <div class="form-inline" id="nome_error"></div>
                    </div>
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
                        <label for="label_tel_responsavel">Telefone:</label>
                        <input type="text" class="input-mini" id="ddd" name="ddd" placeholder="DDD">
                        <input type="text" class="input-large" id="telefone" name="telefone" placeholder="999999999" maxlength="10">
                        <div class="form-inline" id="telefone_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_email">Email do Responsável:</label>
                        <input type="text" class="form-control" id="email_responsavel" name="email_responsavel" placeholder="Email do Responsável">
                        <div class="form-inline" id="email_responsavel_error"></div>
                    </div>
                    <button class="btn btn-primary" id="envia" type="submit">Gravar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_responsavel"></div>
        </div>        
    </div>
</div>