<?php
require '../Model/Tecnicos_Seguranca_Trabalho.php';
require '../Model/TST_Lojas.php';
include '../config/database_mysql.php';
$pdo = Database::connect();
$tst = new TST_Lojas();
$tst->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_tst = $tst->Dados_TST_Lojass($tst->get_id());
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_loja").load('tst_lojas_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_loja").load('tst_lojas_listar.php');
            }
        });

        var id_cidade = '<?php echo $array_tst['id_cidade']; ?>';
        $('#cidade').load('../Controller/combo_cidade_selected.php?uf=' + $('#uf').val() + "&id_cidade=" + id_cidade);

        $('#uf').change(function () {
            $('#cidade').load('../Controller/combo_cidade.php?estado=' + $('#uf').val());
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#contenido").empty();
            var id = $("#id").val();
            var cnpj = $("#cnpj").val();
            var nome_unidade = $("#nome_unidade").val();
            var palavra_chave = $("#palavra_chave").val();
            var endereco = $("#endereco").val();            
            var bairro = $("#bairro").val();
            var uf = $("#uf").val();
            var cidade = $("#cidade").val();
            var cep = $("#cep").val();
            var status = $("#status").val();

            if ($("#cnpj").val() === '')
            {
                $("#cnpj_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o CNPJ...</div>"),
                        $("#cnpj").focus();
                return false;
            } else {
                $("#cnpj_error").empty();
            }

            if ($("#nome_unidade").val() === '')
            {
                $("#nome_unidade_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o nome da Loja/Estabelecimento...</div>"),
                        $("#nome_unidade").focus();
                return false;
            } else {
                $("#nome_unidade_error").empty();
            }

            if ($("#palavra_chave").val() === '')
            {
                $("#palavra_chave_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Palavra Chave, para localizar mais rápido essa loja/Estabelecimento...</div>"),
                        $("#palavra_chave").focus();
                return false;
            } else {
                $("#palavra_chave_error").empty();
            }

            if ($("#endereco").val() === '')
            {
                $("#endereco_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Endereço...</div>"),
                        $("#endereco").focus();
                return false;
            } else {
                $("#endereco_error").empty();
            }            

            if ($("#uf").val() === 'na')
            {
                $("#uf_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Estado...</div>"),
                        $("#uf").focus();
                return false;
            } else {
                $("#uf_error").empty();
            }

            if ($("#cidade").val() === '0')
            {
                $("#cidade_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Cidade...</div>"),
                        $("#cidade").focus();
                return false;
            } else {
                $("#cidade_error").empty();
            }

            if ($("#bairro").val() === '')
            {
                $("#bairro_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o bairro...</div>"),
                        $("#bairro").focus();
                return false;
            } else {
                $("#bairro_error").empty();
            }

            if ($("#cep").val() === '')
            {
                $("#cep_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o CEP...</div>"),
                        $("#cep").focus();
                return false;
            } else {
                $("#cep_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/tst_lojas_editar.php",
                data: "cnpj=" + cnpj + "&nome_unidade=" + nome_unidade + "&palavra_chave=" + palavra_chave + "&endereco=" + endereco +
                        "&uf=" + uf + "&cidade=" + cidade + "&bairro=" + bairro + "&cep=" + cep + "&id=" + id + "&status=" + status,
                beforeSend: function () {
                    $("#contenido").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#contenido").html(response);
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
    <h4 class="modal-title">Editar Loja</h4>
</div>
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_data_agendamento">CNPJ:</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj" autofocus="autofocus" value="<?php echo $array_tst['cnpj']; ?>">
            <input type="hidden" id="id" name="id" value="<?php echo $tst->get_id(); ?>">
            <div class="form-inline" id="cnpj_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data_agendamento">Nome da Loja:</label>    
            <input type="text" class="form-control" id="nome_unidade" name="nome_unidade" value="<?php echo $array_tst['nome_unidade']; ?>">
            <div class="form-inline" id="nome_unidade_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data_agendamento">Palavra Chave:</label>    
            <input type="text" class="form-control" id="palavra_chave" name="palavra_chave" value="<?php echo $array_tst['palavra_chave']; ?>">
            <div class="form-inline" id="palavra_chave_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data_agendamento">Endereco:</label>    
            <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $array_tst['endereco']; ?>">
            <div class="form-inline" id="endereco_error"></div>
        </div>        
        <div class="form-group">
            <label for="label_uf">Estado (UF):</label>
            <select class="form-control" id="uf" name="uf" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php                
                $sql1 = "select cod_estado, nom_estado from estado order by nom_estado";
                foreach ($pdo->query($sql1) as $value) {
                    $option = $value['cod_estado'] == $array_tst['id_estado'] ? 'value="' . $value['cod_estado'] . '" selected' : 'value="' . $value['cod_estado'] . '"';
                    echo '<option ' . $option . '>' . $value['nom_estado'] . '</option>';
                }
                Database::disconnect();
                ?>
            </select>
            <div class="form-inline" id="tipo_prestador_error"></div>
        </div>
        <div class="form-group">
            <label for="label_cidade">Cidade:</label>
            <select class="form-control" id="cidade" name="cidade" required>
                <option selected value="na">
                    Aguardando...
                </option>
            </select>
            <div class="form-inline" id="cidade_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data_agendamento">Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $array_tst['bairro']; ?>">
            <div class="form-inline" id="bairro_error"></div>
        </div>
        <div class="form-group">
            <label for="label_cep">CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" maxlength="8" value="<?php echo $array_tst['cep']; ?>">
            <div class="form-inline" id="cep_error"></div>
        </div>
        <div class="form-group">
            <label for="label_status_medico">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <?php
                $seleciona1 = $array_tst['status'] == '1' ? "selected" : " ";
                $seleciona2 = $array_tst['status'] == '0' ? "selected" : " ";
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
            <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Editar Loja<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
        </div>
    </form>
</div>
<div class="modal-footer">
    <div id="contenido"></div>
</div>