<div id="refresca_riscoeexame_editar">
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

                $.ajax({
                    type: "POST",
                    dataType: "HTML",
                    url: "../Controller/riscos_e_exames_listar_editar.php",
                    data: "empresa=" + empresa + "&estabelecimento=" + estabelecimento,
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
            <h2><strong>Listar Departamentos e Setores</strong><acronym title="Informe os campos para otimizar o resultado!!!"> Walmart</acronym></h2>
            <div class="additional-btn">            
                <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>            
            </div>
        </div>
        <div class="widget-content padding">
            <div class="form-inline">
                <form id="form" method="POST">
                    <div class="form-group">
                        <label class="sr-only" for="empresa_label">Empresa:</label>
                        <select class="form-control" id="empresa" name="empresa" required>
                            <option selected value="0">
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
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="estabelecimento_label">Estabelecimento:</label>
                        <select class="form-control" id="estabelecimento" name="estabelecimento" required>
                            <option selected value="na">
                                Aguardando...
                            </option>
                        </select>
                    </div>
                    <button class="btn btn-primary btn-facebook" id="envia" type="submit">Gerar Online</button>
                </form>
            </div>
        </div>
        <div class="widget-content padding" id="conteudo_periodico"></div>
    </div>
</div>