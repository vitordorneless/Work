<?php
include '../config/database_mysql.php';
include '../Model/Tecnicos_Seguranca_Trabalho.php';
include '../Model/TST_checklist_funcao.php';
$tst = new TST_checklist_funcao();
$tst->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array = $tst->Dados_TST_checklist_funcao($tst->get_id());
$pdo = Database::connect();
?>
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
            var status = $("#status").val();
            var id = $("#id").val();

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
                url: "../Controller/tst_lojas_funcoes_editar_exec_form.php",
                data: "id_unidade=" + id_unidade + "&nome_funcao=" + nome_funcao + "&descricao=" + descricao + "&id=" + id + "&status=" + status,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                            $("#conteudo_superior").empty(),
                            $("#refresca_loja").load('tst_lojas_funcoes_listar.php');
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">
    <h2><strong>Editar</strong> Funções para as Lojas - TST</h2>
    <div class="additional-btn">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    </div>
</div>
<div class="modal-body">
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
                        echo '<option ' . $option . '>' . $value['nome_unidade'] . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_unidade_error"></div>
            </div>
            <div class="form-group">
                <label for="label_data_agendamento">Função:</label>
                <input type="text" class="form-control" id="nome_funcao" name="nome_funcao" placeholder="Nome da Função" value="<?php echo $array['nome_funcao']; ?>">
                <input type="hidden" id="id" name="id" value="<?php echo $array['id']; ?>">
                <div class="form-inline" id="nome_funcao_error"></div>
            </div>            
            <div class="form-group">
                <label for="label_obs">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" placeholder="Informe aqui, dados adicionais!!"><?php echo $array['descricao']; ?></textarea>
                <div class="form-inline" id="obs_error"></div>
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
                <button class="btn btn-primary btn-linkedin pull-right" id="envia" type="submit">Editar Função <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
            </div>
            <?php Database::disconnect(); ?>
        </form>
    </div>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>