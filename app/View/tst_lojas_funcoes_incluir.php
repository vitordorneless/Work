<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var id_unidade = $("#id_unidade").val();
            var nome_funcao = $("#nome_funcao").val();
            var descricao = $("#descricao").val();

            if ($("#id_unidade").val() === 'na')
            {
                $("#id_unidade_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Loja...</div>"),
                        $("#id_unidade").focus();
                return false;
            } else {
                $("#id_unidade_error").empty();
            }

            if ($("#nome_funcao").val() === '')
            {
                $("#nome_funcao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#nome_funcao").focus();
                return false;
            } else {
                $("#nome_funcao_error").empty();
            }

            if ($("#descricao").val() === '')
            {
                descricao = 'Não Informado';
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/tst_lojas_funcoes_incluir.php",
                data: "id_unidade=" + id_unidade + "&nome_funcao=" + nome_funcao + "&descricao=" + descricao,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response);
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
            <h2><strong>Incluir</strong> Função por Loja TST</h2>
            <div class="additional-btn">                
                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
            </div>
        </div>
        <div class="widget-content">
            <div id="basic-form">
                <form id="form" method="POST">            
                    <div class="form-group">
                        <label for="label_uf">Loja / Unidade:</label>
                        <select class="form-control" id="id_unidade" name="id_unidade">
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            include '../config/database_mysql.php';
                            $pdo = Database::connect();
                            $sql2 = "select id, nome_unidade from tst_unidades where status in (1) order by nome_unidade asc";
                            foreach ($pdo->query($sql2) as $value) {
                                echo '<option value="' . $value['id'] . '">' . utf8_encode($value['nome_unidade']) . '</option>';
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <div class="form-inline" id="id_unidade_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_data_agendamento">Função:</label>
                        <input type="text" class="form-control" id="nome_funcao" name="nome_funcao" placeholder="Nome da Função">
                        <div class="form-inline" id="nome_funcao_error"></div>
                    </div>            
                    <div class="form-group">
                        <label for="label_obs">Descrição:</label>
                        <textarea class="form-control" id="descricao" name="descricao" placeholder="Informe aqui, dados adicionais!!"></textarea>
                        <div class="form-inline" id="obs_error"></div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-linkedin pull-right" id="envia" type="submit">Salvar Função <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
                    </div>            
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_CASSI"></div>
        </div>        
    </div>
</div>