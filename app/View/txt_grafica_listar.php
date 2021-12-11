<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {

        $('#empresa').change(function () {
            $('#estabelecimento').load('../Controller/combo_estabelecimento.php?empresa=' + $('#empresa').val());
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            $("#conteudo_lateral").empty();
            $("#conteudo_superior").empty();
            envia_form();
        });
        function envia_form() {
            $("#conteudo_periodico").empty();
            var empresa = $("#empresa").val();
            var estabelecimento = $("#estabelecimento").val();            
            var funcao = $("#funcao").val();
                
            if ($("#empresa").val() === 'na')
                {                 $("#empresa_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Empresa...</div>"),
                $("#empresa").focus();
                    return false;
            } else {
                $("#empresa_error").empty();
            }
            
            if ($("#estabelecimento").val() === '0')
            {
                $("#estabelecimento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Loja...</div>"),
                        $("#estabelecimento").focus();
                return false;
            } else {
                $("#estabelecimento_error").empty();
            }

            if ($("#funcao").val() === 'na')
            {
                $("#funcao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Médico...</div>"),
                        $("#funcao").focus();
                return false;
            } else {
                $("#funcao_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/txt_grafica_listar.php",
                data: "empresa=" + empresa + "&estabelecimento=" + estabelecimento + "&funcao=" + funcao,
                beforeSend: function () {
                    $("#conteudo_periodico").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_periodico").html(response);
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<style type="text/css">
    #imgpos {
        position:absolute;
        left:667px;
    }
</style>
<div class="widget">
    <div class="widget-header transparent">
        <h2><strong>Listar Departamentos</strong><acronym title="Informe os campos para otimizar o resultado!!!"> Walmart para Impressão do TXT para Gráfica</acronym></h2>
        <div class="additional-btn">            
            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>            
        </div>
    </div>
    <div class="widget-content padding">
        <div class="basic-form">
            <form id="form" method="POST">
                <div class="form-group">
                    <label for="empresa_label">Empresa:</label>
                    <select class="form-control" id="empresa" name="empresa" required autofocus="autofocus">
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
                    <label for="label_funcao_medico">Médico:</label>
                    <select class="form-control" id="funcao" name="funcao" required>
                        <option selected value="na">
                            Selecione...
                        </option>
                        <?php
                        $sql1 = "select id, nome, cargo, conselho from pcmso_coordenadores where ativo = 1 order by nome";
                        foreach ($pdo->query($sql1) as $value) {
                            echo '<option value="' . $value['id'] . '">' . utf8_encode($value['nome']).' - '. utf8_encode($value['cargo']).' - '.$value['conselho']. '</option>';
                        }
                        Database::disconnect();
                        ?>
                    </select>
                    <div class="form-inline" id="funcao_error"></div>
                </div>
                <button class="btn btn-primary btn-facebook" id="envia" type="submit">Gerar Online</button>
            </form>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_periodico"></div>
        </div>
    </div>
</div>