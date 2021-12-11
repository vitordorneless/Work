<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $('#id_prestador').change(function () {
            $('#id_medico').load('../Controller/combo_medico.php?id_prestador=' + $('#id_prestador').val());
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var id_prestador = $("#id_prestador").val();
            var id_medico = $("#id_medico").val();
            var data_prospeccao = $("#data_prospeccao").val();
            var valor_exame = $("#valor_exame").val();
            var lojas_negociadas = $("#lojas_negociadas").val();
            var historico = $("#historico").val();

            if ($("#id_prestador").val() === 'na')
            {
                $("#id_prestador_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#id_prestador").focus();
                return false;
            } else {
                $("#id_prestador_error").empty();
            }

            if ($("#id_medico").val() === 'na')
            {
                $("#id_medico_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#id_medico").focus();
                return false;
            } else {
                $("#id_medico_error").empty();
            }

            if ($("#id_medico").val() === '0')
            {
                id_medico = 0;
            }

            if ($("#data_prospeccao").val() === '')
            {
                $("#data_prospeccao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#data_prospeccao").focus();
                return false;
            } else {
                $("#data_prospeccao_error").empty();
            }

            if ($("#lojas_negociadas").val() === '')
            {
                $("#lojas_negociadas_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#lojas_negociadas").focus();
                return false;
            } else {
                $("#lojas_negociadas_error").empty();
            }

            if ($("#historico").val() === '')
            {
                $("#historico_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#historico").focus();
                return false;
            } else {
                $("#historico_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/hist_prospeccao_incluir.php",
                data: "id_prestador=" + id_prestador + "&id_medico=" + id_medico + "&data_prospeccao=" + data_prospeccao + "&valor_exame=" + valor_exame
                        + "&lojas_negociadas=" + lojas_negociadas + "&historico=" + historico,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
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
            <h2>Incluir Histórico de Prospecção Sudeste/Nordeste</h2>
            <div class="additional-btn">                
                <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
            </div>
        </div>			
        <div class="widget-content padding">
            <div id="basic-form">
                <form id="form" method="POST">
                    <div class="form-group">
                        <label for="label_prestador">Prestador:</label>
                        <select class="form-control" id="id_prestador" name="id_prestador">
                            <option selected value="na">
                                Nenhum...
                            </option>
                            <?php
                            include '../config/database_mysql.php';
                            $pdo = Database::connect();
                            $sql = "select id, razao_social from wal_prestadores where status = 1 order by razao_social";
                            foreach ($pdo->query($sql) as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['razao_social'] . '</option>';
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <div class="form-inline" id="id_prestador_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_cidade">Médico:</label>
                        <select class="form-control" id="id_medico" name="id_medico">
                            <option selected value="na">
                                Aguardando...
                            </option>
                        </select>
                        <div class="form-inline" id="id_medico_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_data_cadastro">Data Prospecção:</label>
                        <input type="date" class="form-control" id="data_prospeccao" name="data_prospeccao">
                        <div class="form-inline" id="data_prospeccao_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_data_cadastro">Valor Exame:</label>
                        <input type="text" class="form-control" id="valor_exame" name="valor_exame">
                        <div class="form-inline" id="data_cadastro_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_data_cadastro">Lojas Negociadas:</label>
                        <input type="text" class="form-control" id="lojas_negociadas" name="lojas_negociadas" placeholder="Caso seja informado no Histórico, favor digitar apenas: VER">
                        <div class="form-inline" id="data_cadastro_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_obs">Histórico:</label>
                        <textarea class="form-control" id="historico" name="historico" placeholder="Informe aqui!!" rows="10" cols="5"></textarea>
                        <div class="form-inline" id="historico_error"></div>
                    </div>
                    <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Adicionar Histórico <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
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