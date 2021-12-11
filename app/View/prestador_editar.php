<?php
include '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$medico = new Prestadores_PJ();
$prest = new Prestador_Valores_Exames();
$medico->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_medico = $medico->Dados_Prestadores_PJ($medico->get_id());
$array_valores = $prest->Dados_Prestador_Valores_Exames($array_medico['cnpj']);
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script src="../js/maskMoney.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_Prestadores_listar").load('prestador_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_Prestadores_listar").load('prestador_listar.php');
            }
        });

        $("input.dinheiro").maskMoney({showSymbol: false, decimal: ",", thousands: "."});

        var id_cidade = '<?php echo $array_medico['id_cidade']; ?>';
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
            $("#conteudo_prestador_editar").empty();
            var id = $("#id").val();
            var data_cadastro = $("#data_cadastro").val();
            var tipo_prestador = $("#tipo_prestador").val();
            var razao_social = $("#razao_social").val();
            var cnpj = $("#cnpj").val();
            var CNES = $("#CNES").val();
            var endereco = $("#endereco").val();
            var numero = $("#numero").val();
            var complemento = $("#complemento").val();
            var uf = $("#uf").val();
            var cidade = $("#cidade").val();
            var bairro = $("#bairro").val();
            var cep = $("#cep").val();
            var ddd_comercial = $("#ddd_comercial").val();
            var telefone_comercial = $("#telefone_comercial").val();
            var ddd_celular = $("#ddd_celular").val();
            var telefone_celular = $("#telefone_celular").val();
            var email = $("#email").val();
            var valor_consulta = $("#valor_consulta").val();
            var valor_consulta_2 = $("#valor_consulta_2").val() === '' ? '0' : $("#valor_consulta_2").val();
            var valor_consulta_3 = $("#valor_consulta_3").val() === '' ? '0' : $("#valor_consulta_3").val();
            var data_acerto_2 = $("#data_acerto_2").val() === '' ? '0000-00-00 00:00:00' : $("#data_acerto_2").val();
            var data_acerto_3 = $("#data_acerto_3").val() === '' ? '0000-00-00 00:00:00' : $("#data_acerto_3").val();
            var status = $("#status").val();
            var obs = $("#obs").val();
            var banco = $("#banco").val();
            var agencia = $("#agencia").val();
            var conta = $("#conta").val();
            var exame_clinico = $("#exame_clinico").val() === '' ? 0 : $("#exame_clinico").val();
            var acido_metil_hipurico = $("#acido_metil_hipurico").val() === '' ? 0 : $("#acido_metil_hipurico").val();
            var hemograma = $("#hemograma").val() === '' ? 0 : $("#hemograma").val();
            var acido_mandelico = $("#acido_mandelico").val() === '' ? 0 : $("#acido_mandelico").val();
            var vdrl = $("#vdrl").val() === '' ? 0 : $("#vdrl").val();
            var reticulocitos = $("#reticulocitos").val() === '' ? 0 : $("#reticulocitos").val();
            var parasitologico_fezes = $("#parasitologico_fezes").val() === '' ? 0 : $("#parasitologico_fezes").val();
            var cultural_de_orofaringe = $("#cultural_de_orofaringe").val() === '' ? 0 : $("#cultural_de_orofaringe").val();
            var coprocultura = $("#coprocultura").val() === '' ? 0 : $("#coprocultura").val();
            var micologico_de_unha = $("#micologico_de_unha").val() === '' ? 0 : $("#micologico_de_unha").val();
            var audiometria = $("#audiometria").val() === '' ? 0 : $("#audiometria").val();
            var ecg = $("#ecg").val() === '' ? 0 : $("#ecg").val();
            var acuidade_visual = $("#acuidade_visual").val() === '' ? 0 : $("#acuidade_visual").val();
            var eeg = $("#eeg").val() === '' ? 0 : $("#eeg").val();
            var plaquetas = $("#plaquetas").val() === '' ? 0 : $("#plaquetas").val();
            var eritrograma = $("#eritrograma").val() === '' ? 0 : $("#eritrograma").val();
            var acido_tt_muconico = $("#acido_tt_muconico").val() === '' ? 0 : $("#acido_tt_muconico").val();
            var glicemia_em_jejum = $("#glicemia_em_jejum").val() === '' ? 0 : $("#glicemia_em_jejum").val();
            var acido_hipurico = $("#acido_hipurico").val() === '' ? 0 : $("#acido_hipurico").val();
            var hemograma_com_plaquetas = $("#hemograma_com_plaquetas").val() === '' ? 0 : $("#hemograma_com_plaquetas").val();
            var antibiograma = $("#antibiograma").val() === '' ? 0 : $("#antibiograma").val();
            var id_medico_valores = $("#id_medico_valores").val();

            if ($("#data_cadastro").val() === '')
            {
                $("#data_cadastro_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Data do Cadastro...</div>"),
                        $("#data_cadastro").focus();
                return false;
            } else {
                $("#data_cadastro_error").empty();
            }

            if ($("#tipo_prestador").val() === 'na')
            {
                $("#tipo_prestador_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Tipo de Prestador...</div>"),
                        $("#tipo_prestador").focus();
                return false;
            } else {
                $("#tipo_prestador_error").empty();
            }

            if ($("#razao_social").val() === '')
            {
                $("#razao_social_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Razão Social...</div>"),
                        $("#razao_social").focus();
                return false;
            } else {
                $("#razao_social_error").empty();
            }

            if ($("#cnpj").val() === '')
            {
                $("#cnpj_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o CNPJ (CGC)...</div>"),
                        $("#cnpj").focus();
                return false;
            } else {
                $("#cnpj_error").empty();
            }

            if ($("#CNES").val() === '')
            {
                $("#CNES_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o CNES do Médico...</div>"),
                        $("#CNES").focus();
                return false;
            } else {
                $("#CNES_error").empty();
            }

            if ($("#endereco").val() === '')
            {
                $("#endereco_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Endereço corretamente...</div>"),
                        $("#endereco").focus();
                return false;
            } else {
                $("#endereco_error").empty();
            }

            if ($("#numero").val() === '')
            {
                $("#complemento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Número...</div>"),
                        $("#numero").focus();
                return false;
            } else {
                $("#complemento_error").empty();
            }

            if ($("#complemento").val() === '')
            {
                complemento = "não informado";
            }

            if ($("#uf").val() === 'na')
            {
                $("#uf_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Estado...</div>"),
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
                $("#bairro_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Bairro...</div>"),
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

            if ($("#ddd_comercial").val() === '')
            {
                $("#telefone_comercial_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o DDD do Telefone...</div>"),
                        $("#ddd_comercial").focus();
                return false;
            } else {
                $("#telefone_error").empty();
            }

            if ($("#telefone_comercial").val() === '')
            {
                $("#telefone_comercial_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Número do Telefone do Médico...</div>"),
                        $("#telefone_comercial").focus();
                return false;
            } else {
                $("#telefone_comercial_error").empty();
            }

            if ($("#ddd_celular").val() === '')
            {
                $("#telefone_celular_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o DDD do Telefone Celular...</div>"),
                        $("#ddd_celular").focus();
                return false;
            } else {
                $("#telefone_celular_error").empty();
            }

            if ($("#telefone_celular").val() === '')
            {
                $("#telefone_celular_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Número do Telefone Celular...</div>"),
                        $("#telefone_celular").focus();
                return false;
            } else {
                $("#telefone_celular_error").empty();
            }
            
            if ($("#email").val() === '')
            {
                $("#email_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#email").focus();
                return false;
            } else {
                $("#email_error").empty();
            }

            if ($("#valor_consulta").val() === '')
            {
                $("#valor_consulta_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Valor...</div>"),
                        $("#valor_consulta").focus();
                return false;
            } else {
                $("#valor_consulta_error").empty();
            }

            if ($("#agencia").val() === '')
            {
                $("#conta_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Agência...</div>"),
                        $("#agencia").focus();
                return false;
            } else {
                $("#conta_error").empty();
            }

            if ($("#conta").val() === '')
            {
                $("#conta_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Conta Corrente...</div>"),
                        $("#conta").focus();
                return false;
            } else {
                $("#conta_error").empty();
            }

            if ($("#obs").val() === '') {
                obs = "Não informado";
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/prestador_editar.php",
                data: "data_cadastro=" + data_cadastro + "&tipo_prestador=" + tipo_prestador + "&razao_social=" + razao_social + "&cnpj=" + cnpj + "&CNES=" + CNES +
                        "&endereco=" + endereco + "&numero=" + numero + "&complemento=" + complemento + "&uf=" + uf + "&cidade=" + cidade + "&bairro=" + bairro +
                        "&cep=" + cep + "&ddd_comercial=" + ddd_comercial + "&telefone_comercial=" + telefone_comercial + "&ddd_celular=" + ddd_celular +
                        "&telefone_celular=" + telefone_celular + "&id=" + id + "&status=" + status + "&valor_consulta=" + valor_consulta + "&obs=" + obs + "&agencia=" + agencia + "&conta=" + conta + "&banco=" + banco +
                        "&exame_clinico=" + exame_clinico + "&acido_metil_hipurico=" + acido_metil_hipurico + "&hemograma=" + hemograma + "&acido_mandelico=" + acido_mandelico +
                        "&vdrl=" + vdrl + "&reticulocitos=" + reticulocitos + "&parasitologico_fezes=" + parasitologico_fezes + "&cultural_de_orofaringe=" + cultural_de_orofaringe +
                        "&coprocultura=" + coprocultura + "&micologico_de_unha=" + micologico_de_unha + "&audiometria=" + audiometria + "&ecg=" + ecg +
                        "&acuidade_visual=" + acuidade_visual + "&eeg=" + eeg + "&plaquetas=" + plaquetas + "&eritrograma=" + eritrograma +
                        "&acido_tt_muconico=" + acido_tt_muconico + "&glicemia_em_jejum=" + glicemia_em_jejum + "&acido_hipurico=" + acido_hipurico + "&id_medico_valores=" + id_medico_valores +
                        "&antibiograma=" + antibiograma + "&hemograma_com_plaquetas=" + hemograma_com_plaquetas + "&email=" + email +
                        "&valor_consulta_2=" + valor_consulta_2 + "&valor_consulta_3=" + valor_consulta_3 + "&data_acerto_2=" + data_acerto_2 + "&data_acerto_3=" + data_acerto_3,
                beforeSend: function () {
                    $("#conteudo_prestador_editar").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_prestador_editar").html(response),
                            $("#form")[0].reset(),
                            $("#refresca_Prestadores_listar").load('prestador_listar.php');
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
    <h4 class="modal-title">Editar Prestador</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_data_cadastro">Data Cadastro:</label>
            <?php
            $format_data = trim($array_medico['data_cadastro']);
            $date_format = date("Y-m-d", strtotime($format_data));
            ?>
            <input type="date" class="form-control" id="data_cadastro" name="data_cadastro" value="<?php echo $date_format; ?>">
            <div class="form-inline" id="data_cadastro_error"></div>
        </div>
        <div class="form-group">
            <label for="label_tipo_prestador">Tipo de Prestador:</label>
            <select class="form-control" id="tipo_prestador" name="tipo_prestador" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $pdo = Database::connect();
                $sql = "select id, tipo_prestador from tipo_prestador where status = 1 order by tipo_prestador";
                foreach ($pdo->query($sql) as $value) {
                    $option = $value['id'] == $array_medico['id_tipo_prestador'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . utf8_encode($value['tipo_prestador']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="tipo_prestador_error"></div>
        </div>                    
        <div class="form-group">
            <label for="label_razao_social">Razão Social:</label>
            <input type="text" class="form-control" id="razao_social" name="razao_social" placeholder="Razão Social" value="<?php echo $array_medico['razao_social']; ?>">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $array_medico['id']; ?>">
            <div class="form-inline" id="razao_social_error"></div>
        </div>
        <div class="form-group">
            <label for="label_cnpj">CNPJ:</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Númedo do CNPJ, apenas números" maxlength="18" value="<?php echo $array_medico['cnpj']; ?>">
            <div class="form-inline" id="cnpj_error"></div>
        </div>
        <div class="form-group">
            <label for="label_CNES">CNES:</label>
            <input type="text" class="form-control" id="CNES" name="CNES" placeholder="Informe CNES" value="<?php echo $array_medico['CNES']; ?>">
            <div class="form-inline" id="CNES_error"></div>
        </div>
        <div class="form-group">
            <label for="label_endereco">Endereço:</label>
            <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $array_medico['endereco']; ?>">
            <div class="form-inline" id="endereco_error"></div>
        </div>
        <div class="form-group">
            <label for="label_numero">Número:</label>
            <input type="text" class="input-mini" id="numero" name="numero" placeholder="Número" value="<?php echo $array_medico['numero']; ?>">
            <label for="label_complemento">Complemento:</label>
            <input type="text" class="input-large" id="complemento" name="complemento" placeholder="Complemento" value="<?php echo $array_medico['complemento']; ?>">
            <div class="form-inline" id="complemento_error"></div>
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
                    $option = $value['cod_estado'] == $array_medico['id_estado_UF'] ? 'value="' . $value['cod_estado'] . '" selected' : 'value="' . $value['cod_estado'] . '"';
                    echo '<option ' . $option . '>' . $value['nom_estado'] . '</option>';
                }
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
            <label for="label_bairro">Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Informe Bairro" value="<?php echo $array_medico['bairro']; ?>">
            <div class="form-inline" id="bairro_error"></div>
        </div>                    
        <div class="form-group">
            <label for="label_cep">CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" maxlength="8" value="<?php echo $array_medico['CEP']; ?>">
            <div class="form-inline" id="cep_error"></div>
        </div>
        <div class="form-group">
            <label for="label_tel_medico">Telefone Comercial:</label>
            <input type="text" class="input-mini" id="ddd_comercial" name="ddd" placeholder="DDD" maxlength="3" value="<?php echo $array_medico['ddd_comercial']; ?>">
            <input type="text" class="input-large" id="telefone_comercial" name="telefone" placeholder="999999999" maxlength="10" value="<?php echo $array_medico['telefone_comercial']; ?>">
            <div class="form-inline" id="telefone_comercial_error"></div>
        </div>
        <div class="form-group">
            <label for="label_tel_medico">Telefone Celular:</label>
            <input type="text" class="input-mini" id="ddd_celular" name="ddd" placeholder="DDD" maxlength="3" value="<?php echo $array_medico['ddd_celular']; ?>">
            <input type="text" class="input-large" id="telefone_celular" name="telefone" placeholder="999999999" maxlength="10" value="<?php echo $array_medico['telefone_celular']; ?>">
            <div class="form-inline" id="telefone_celular_error"></div>
        </div>
        <div class="form-group">
            <label for="label_email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $array_medico['email']; ?>">
            <div class="form-inline" id="email_error"></div>
        </div>
        <div class="form-group">
            <label for="label_valor_consulta">Valor do Exame Clínico (ASO) 1:</label>
            <div class="input-group">
                <span class="input-group-addon">R$</span>
                <input type="text" class="form-control dinheiro" id="valor_consulta" name="valor_consulta" value="<?php echo $array_medico['valor_consulta']; ?>">
            </div>
            <div class="form-inline" id="valor_consulta_error"></div>
        </div>
        <div class="form-group">
            <label for="label_valor_consulta">Valor do Exame Clínico (ASO) (reacerto) 2:</label>
            <div class="input-group">
                <span class="input-group-addon">R$</span>
                <input type="text" class="form-control dinheiro" id="valor_consulta_2" name="valor_consulta_2" value="<?php echo $array_medico['valor_consulta_2']; ?>">
            </div>
            <div class="form-inline" id="valor_consulta_2_error"></div>
        </div>
        <?php
        $date_format1 = date("Y-m-d", strtotime(trim($array_medico['data_acerto_2'])));
        $date_format2 = date("Y-m-d", strtotime(trim($array_medico['data_acerto_3'])));
        ?>
        <div class="form-group">
            <label for="label_valor_consulta">Data Acerto:</label>
            <div class="input-group">                            
                <input type="date" class="form-control" id="data_acerto_2" name="data_acerto_2" value="<?php echo $date_format1; ?>">
            </div>
            <div class="form-inline" id="data_acerto_2_error"></div>
        </div>
        <div class="form-group">
            <label for="label_valor_consulta">Valor do Exame Clínico (ASO) (reacerto) 3:</label>
            <div class="input-group">
                <span class="input-group-addon">R$</span>
                <input type="text" class="form-control dinheiro" id="valor_consulta_3" name="valor_consulta_3" value="<?php echo $array_medico['valor_consulta_3']; ?>">
            </div>
            <div class="form-inline" id="valor_consulta_3_error"></div>
        </div>
        <div class="form-group">
            <label for="label_valor_consulta">Data Acerto:</label>
            <div class="input-group">                            
                <input type="date" class="form-control" id="data_acerto_3" name="data_acerto_3" value="<?php echo $date_format2; ?>">
            </div>
            <div class="form-inline" id="data_acerto_2_error"></div>
        </div>
        <div class="form-group">
            <label for="label_funcao_medico">Banco:</label>
            <select class="form-control" id="banco" name="banco" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql2 = "select codigo, nome_banco from bancos order by nome_banco";
                foreach ($pdo->query($sql2) as $value) {
                    $option = $value['codigo'] == $array_medico['id_banco'] ? 'value="' . $value['codigo'] . '" selected' : 'value="' . $value['codigo'] . '"';
                    echo '<option ' . $option . '>' . utf8_encode($value['nome_banco']) . '</option>';
                }
                Database::disconnect();
                ?>
            </select>
            <div class="form-inline" id="banco_error"></div>
        </div>
        <div class="form-group">
            <label for="label_tel_medico">Agência e Conta:</label>
            <input type="text" class="input-mini" id="agencia" name="agencia" placeholder="Agência" value="<?php echo $array_medico['agencia']; ?>">
            <input type="text" class="input-large" id="conta" name="conta" placeholder="Conta-Corrente" maxlength="30" value="<?php echo $array_medico['conta']; ?>">
            <div class="form-inline" id="conta_error"></div>
        </div>
        <div class="form-group">
            <label for="label_obs">Observações:</label>
            <textarea class="form-control" id="obs" name="obs" placeholder="Informe aqui, dados adicionais!!"><?php echo $array_medico['obs']; ?></textarea>
            <div class="form-inline" id="obs_error"></div>
        </div>
        <div class="form-group">
            <label for="label_status_medico">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <?php
                $seleciona1 = $array_medico['status'] == '1' ? "selected" : " ";
                $seleciona2 = $array_medico['status'] == '0' ? "selected" : " ";
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
            <h3 class="text-center">Exames Complementares - Editar Valores</h3>
            <table>                
                <tr class="table">
                    <!--<td>                                    
                        <label for="label_exame_clinico">EXAME CLÍNICO:</label>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="exame_clinico" id="exame_clinico" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['exame_clinico']; ?>"  value="<?php echo $array_valores['exame_clinico']; ?>">
                        </div>
                    </td>-->
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">ÁCIDO METIL-HIPÚRICO:</label>                                    
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="acido_metil_hipurico" id="acido_metil_hipurico" class="input-mini dinheiro" value="<?php echo $array_valores['acido_metil_hipurico']; ?>"  type="text">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">HEMOGRAMA:</label>                                    
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="hemograma" id="hemograma" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['hemograma']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">ÁCIDO MANDÉLICO:</label>                                    
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="acido_mandelico" id="acido_mandelico" class="input-mini dinheiro" value="<?php echo $array_valores['acido_mandelico']; ?>" type="text">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">VDRL:</label>                                    
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="vdrl" id="vdrl" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['vdrl']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">RETICULÓCITOS:</label>               
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="reticulocitos" id="reticulocitos" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['reticulocitos']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">PARASITOLÓGICO FEZES:</label>                            
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="parasitologico_fezes" id="parasitologico_fezes" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['parasitologico_fezes']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">CULTURAL DE OROFARINGE:</label>                                    
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="cultural_de_orofaringe" id="cultural_de_orofaringe" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['cultural_de_orofaringe']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">COPROCULTURA:</label>                                    
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="coprocultura" id="coprocultura" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['coprocultura']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">MICOLÓGICO DE UNHA:</label>                            
                    </td>                
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="micologico_de_unha" id="micologico_de_unha" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['micologico_de_unha']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">AUDIOMETRIA:</label>                                    
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="audiometria" id="audiometria" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['audiometria']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">ECG:</label>                                    
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="ecg" id="ecg" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['ecg']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">ACUIDADE VISUAL:</label>             
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="acuidade_visual" id="acuidade_visual" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['acuidade_visual']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">EEG:</label>                                    
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="eeg" id="eeg" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['eeg']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">PLAQUETAS:</label>                   
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="plaquetas" id="plaquetas" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['plaquetas']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">ERITROGRAMA:</label>                             
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="eritrograma" id="eritrograma" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['eritrograma']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">ÁCIDO TT MUCÔNICO:</label>                           
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="acido_tt_muconico" id="acido_tt_muconico" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['acido_tt_muconico']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">GLICEMIA EM JEJUM:</label>                                    
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="glicemia_em_jejum" id="glicemia_em_jejum" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['glicemia_em_jejum']; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">ÁCIDO HIPÚRICO:</label>                                    
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="acido_hipurico" id="acido_hipurico" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['acido_hipurico']; ?>">
                            <input name="id_medico_valores" id="id_medico_valores" type="hidden" value="<?php echo $array_valores['id']; ?>">
                        </div>
                    </td>                    
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">HEMOGRAMA COM PLAQUETAS:</label>                                    
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="hemograma_com_plaquetas" id="hemograma_com_plaquetas" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['hemograma_com_plaquetas']; ?>">                            
                        </div>
                    </td>                    
                </tr>
                <tr>
                    <td>                            
                        <label for="label_aaa">ANTIBIOGRAMA:</label>                                    
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="antibiograma" id="antibiograma" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['antibiograma']; ?>">                            
                        </div>
                    </td>                    
                </tr>
            </table>
        </div>
        <button class="btn btn-primary btn-facebook" id="envia" type="submit">Editar Dados do Prestador</button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_prestador_editar"></div>
</div>