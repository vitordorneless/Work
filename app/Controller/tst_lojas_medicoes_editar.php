<?php
include '../config/database_mysql.php';
$pdo = Database::connect();
require '../Model/Tecnicos_Seguranca_Trabalho.php';
require '../Model/TST_checklist_Medicao.php';
$tst = new TST_checklist_Medicao();
$tst->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array = $tst->Dados_TST_checklist_Medicao($tst->get_id());
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        var id_funcao = '<?php echo $array['id_funcao']; ?>';
        $('#funcao').load('../Controller/combo_medicao_selected.php?id_loja=' + $('#id_unidade').val() + "&id_funcao=" + id_funcao);

        $('#id_unidade').change(function () {
            $('#funcao').load('../Controller/combo_medicao.php?id_loja=' + $('#id_unidade').val());
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var id_unidade = $("#id_unidade").val();
            var setor = $("#setor").val();
            var funcao = $("#funcao").val();
            var db = $("#db").val();
            var lux = $("#lux").val();
            var id = $("#id").val();
            var status = $("#status").val();

            if ($("#id_unidade").val() === 'na')
            {
                $("#id_unidade_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_unidade").focus();
                return false;
            } else {
                $("#id_unidade_error").empty();
            }

            if ($("#setor").val() === '')
            {
                $("#setor_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#setor").focus();
                return false;
            } else {
                $("#setor_error").empty();
            }

            if ($("#funcao").val() === '0')
            {
                $("#funcao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#funcao").focus();
                return false;
            } else {
                $("#funcao_error").empty();
            }

            if ($("#db").val() === '')
            {
                $("#db_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#db").focus();
                return false;
            } else {
                $("#db_error").empty();
            }

            if ($("#lux").val() === '')
            {
                $("#lux_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#lux").focus();
                return false;
            } else {
                $("#lux_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/tst_lojas_medicoes_editar_form.php",
                data: "id_unidade=" + id_unidade + "&setor=" + setor + "&funcao=" + funcao + "&db=" + db + "&lux=" + lux + "&id=" + id + "&status=" + status,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                    $("#conteudo_superior").empty();
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
            <h2><strong>Editar</strong> Medição por Loja TST</h2>
            <div class="additional-btn">                
                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
            </div>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form id="form" method="POST">            
                    <div class="form-group">
                        <label for="label_uf">Loja / Unidade:</label>
                        <select class="form-control" id="id_unidade" name="id_unidade">
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php                            
                            $sql2 = "select id, nome_unidade from tst_unidades where status in (1) order by nome_unidade asc";
                            foreach ($pdo->query($sql2) as $value) {
                                $option = $value['id'] == $array['id_loja'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                                echo '<option ' . $option . '>' . utf8_encode($value['nome_unidade']) . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="id_unidade_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_data_agendamento">Setor:</label>
                        <input type="text" class="form-control" id="setor" name="setor" placeholder="Nome do Setor" value="<?php echo $array['setor']; ?>">
                        <input type="hidden" id="id" name="id" value="<?php echo $array['id']; ?>">
                        <div class="form-inline" id="setor_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_cidade">Função:</label>
                        <select class="form-control" id="funcao" name="funcao" required>
                            <option selected value="na">
                                Aguardando...
                            </option>
                        </select>
                        <div class="form-inline" id="funcao_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_data_agendamento">Db:</label>
                        <input type="text" class="form-control" id="db" name="db" placeholder="Db" value="<?php echo $array['db']; ?>">
                        <div class="form-inline" id="db_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_data_agendamento">Lux:</label>
                        <input type="text" class="form-control" id="lux" name="lux" placeholder="Lux" value="<?php echo $array['lux']; ?>">
                        <div class="form-inline" id="lux_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_status_medico">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <?php
                            $seleciona1 = $array['status'] == '1' ? "selected" : " ";
                            $seleciona2 = $array['status'] == '0' ? "selected" : " ";
                            ?>
                            <option value="1" <?php echo $seleciona1; ?>>
                                Ativo
                            </option>
                            <option value="0" <?php echo $seleciona2; ?>>
                                Inativo
                            </option>                
                        </select>
                        <div class="form-inline" id="status_error"></div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-linkedin pull-right" id="envia" type="submit">Editar Medição <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
                    </div>            
                    <?php Database::disconnect(); ?>
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