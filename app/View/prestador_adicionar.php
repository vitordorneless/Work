<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script src="../js/maskMoney.js"></script>
<script>
    $(document).ready(function () {

        $("input.dinheiro").maskMoney({showSymbol: false, decimal: ",", thousands: "."});

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
            $("#conteudo_prestador").empty();
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
            var exame_clinico = $("#exame_clinico").val();
            var acido_metil_hipurico = $("#acido_metil_hipurico").val();
            var hemograma = $("#hemograma").val();
            var acido_mandelico = $("#acido_mandelico").val();
            var vdrl = $("#vdrl").val();
            var reticulocitos = $("#reticulocitos").val();
            var parasitologico_fezes = $("#parasitologico_fezes").val();
            var cultural_de_orofaringe = $("#cultural_de_orofaringe").val();
            var coprocultura = $("#coprocultura").val();
            var micologico_de_unha = $("#micologico_de_unha").val();
            var audiometria = $("#audiometria").val();
            var ecg = $("#ecg").val();
            var acuidade_visual = $("#acuidade_visual").val();
            var eeg = $("#eeg").val();
            var plaquetas = $("#plaquetas").val();
            var eritrograma = $("#eritrograma").val();
            var acido_tt_muconico = $("#acido_tt_muconico").val();
            var glicemia_em_jejum = $("#glicemia_em_jejum").val();
            var acido_hipurico = $("#acido_hipurico").val();
            var hemograma_com_plaquetas = $("#hemograma_com_plaquetas").val();
            var antibiograma = $("#antibiograma").val();
            var obs = $("#obs").val();
            var banco = $("#banco").val();
            var agencia = $("#agencia").val();
            var conta = $("#conta").val();

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
                url: "../Controller/prestador_adicionar.php",
                data: "data_cadastro=" + data_cadastro + "&tipo_prestador=" + tipo_prestador + "&razao_social=" + razao_social + "&cnpj=" + cnpj + "&CNES=" + CNES +
                        "&endereco=" + endereco + "&numero=" + numero + "&complemento=" + complemento + "&uf=" + uf + "&cidade=" + cidade + "&bairro=" + bairro +
                        "&cep=" + cep + "&ddd_comercial=" + ddd_comercial + "&telefone_comercial=" + telefone_comercial + "&ddd_celular=" + ddd_celular +
                        "&telefone_celular=" + telefone_celular + "&valor_consulta=" + valor_consulta +
                        "&acido_metil_hipurico=" + acido_metil_hipurico + "&hemograma=" + hemograma + "&acido_mandelico=" + acido_mandelico + "&vdrl=" + vdrl +
                        "&reticulocitos=" + reticulocitos + "&parasitologico_fezes=" + parasitologico_fezes + "&cultural_de_orofaringe=" + cultural_de_orofaringe +
                        "&coprocultura=" + coprocultura + "&micologico_de_unha=" + micologico_de_unha + "&audiometria=" + audiometria + "&ecg=" + ecg +
                        "&acuidade_visual=" + acuidade_visual + "&eeg=" + eeg + "&plaquetas=" + plaquetas + "&eritrograma=" + eritrograma +
                        "&acido_tt_muconico=" + acido_tt_muconico + "&glicemia_em_jejum=" + glicemia_em_jejum + "&acido_hipurico=" + acido_hipurico + "&exame_clinico=" + exame_clinico +
                        "&obs=" + obs + "&hemograma_com_plaquetas=" + hemograma_com_plaquetas + "&antibiograma=" + antibiograma + "&agencia=" + agencia + "&conta=" + conta + "&banco=" + banco + "&email=" + email + 
                        "&valor_consulta_2=" + valor_consulta_2 + "&valor_consulta_3=" + valor_consulta_3 + "&data_acerto_2=" + data_acerto_2 + "&data_acerto_3=" + data_acerto_3,
                beforeSend: function () {
                    $("#conteudo_prestador").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_prestador").html(response),
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
            <h2><strong>Adicionar</strong> Prestador</h2>
            <div class="additional-btn">                
                <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
            </div>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form id="form" method="POST">
                    <div class="form-group">
                        <label for="label_data_cadastro">Data Cadastro:</label>
                        <input type="date" class="form-control" id="data_cadastro" name="data_cadastro" autofocus>
                        <div class="form-inline" id="data_cadastro_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_tipo_prestador">Tipo de Prestador:</label>
                        <select class="form-control" id="tipo_prestador" name="tipo_prestador" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            include '../config/database_mysql.php';
                            $pdo = Database::connect();
                            $sql = "select id, tipo_prestador from tipo_prestador where status = 1 order by tipo_prestador";
                            foreach ($pdo->query($sql) as $value) {
                                echo '<option value="' . $value['id'] . '">' . utf8_encode($value['tipo_prestador']) . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="tipo_prestador_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_razao_social">Razão Social:</label>
                        <input type="text" class="form-control" id="razao_social" name="razao_social" placeholder="Razão Social">
                        <div class="form-inline" id="razao_social_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_cnpj">CNPJ / CPF:</label>
                        <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Númedo do CNPJ, apenas números" maxlength="18">
                        <div class="form-inline" id="cnpj_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_CNES">CNES:</label>
                        <input type="text" class="form-control" id="CNES" name="CNES" placeholder="Informe CNES">
                        <div class="form-inline" id="CNES_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_endereco">Endereço:</label>
                        <input type="text" class="form-control" id="endereco" name="endereco">
                        <div class="form-inline" id="endereco_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_numero">Número:</label>
                        <input type="text" class="input-mini" id="numero" name="numero" placeholder="Número">
                        <label for="label_complemento">Complemento:</label>
                        <input type="text" class="input-large" id="complemento" name="complemento" placeholder="Complemento">
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
                                echo '<option value="' . $value['cod_estado'] . '">' . utf8_encode($value['nom_estado']) . '</option>';
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
                        <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Informe Bairro">
                        <div class="form-inline" id="bairro_error"></div>
                    </div>                    
                    <div class="form-group">
                        <label for="label_cep">CEP:</label>
                        <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" maxlength="8">
                        <div class="form-inline" id="cep_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_tel_medico">Telefone Comercial:</label>
                        <input type="text" class="input-mini" id="ddd_comercial" name="ddd" placeholder="DDD" maxlength="3">
                        <input type="text" class="input-large" id="telefone_comercial" name="telefone" placeholder="999999999" maxlength="10">
                        <div class="form-inline" id="telefone_comercial_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_tel_medico">Telefone Celular:</label>
                        <input type="text" class="input-mini" id="ddd_celular" name="ddd" placeholder="DDD" maxlength="3">
                        <input type="text" class="input-large" id="telefone_celular" name="telefone" placeholder="999999999" maxlength="10">
                        <div class="form-inline" id="telefone_celular_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        <div class="form-inline" id="email_error"></div>
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
                                echo '<option value="' . $value['codigo'] . '">' . utf8_encode($value['nome_banco']) . '</option>';
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <div class="form-inline" id="banco_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_tel_medico">Agência e Conta:</label>
                        <input type="text" class="input-mini" id="agencia" name="agencia" placeholder="Agência">
                        <input type="text" class="input-large" id="conta" name="conta" placeholder="Conta-Corrente" maxlength="30">
                        <div class="form-inline" id="conta_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_obs">Observações:</label>
                        <textarea class="form-control" id="obs" name="obs" placeholder="Informe aqui, dados adicionais!!"></textarea>
                        <div class="form-inline" id="obs_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_valor_consulta">Valor do Exame Clínico (ASO) 1:</label>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="text" class="form-control dinheiro" id="valor_consulta" name="valor_consulta">
                        </div>
                        <div class="form-inline" id="valor_consulta_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_valor_consulta">Valor do Exame Clínico (ASO) (reacerto) 2:</label>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="text" class="form-control dinheiro" id="valor_consulta_2" name="valor_consulta_2">
                        </div>
                        <div class="form-inline" id="valor_consulta_2_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_valor_consulta">Data Acerto:</label>
                        <div class="input-group">                            
                            <input type="date" class="form-control" id="data_acerto_2" name="data_acerto_2">
                        </div>
                        <div class="form-inline" id="data_acerto_2_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_valor_consulta">Valor do Exame Clínico (ASO) (reacerto) 3:</label>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="text" class="form-control dinheiro" id="valor_consulta_3" name="valor_consulta_3">
                        </div>
                        <div class="form-inline" id="valor_consulta_3_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_valor_consulta">Data Acerto:</label>
                        <div class="input-group">                            
                            <input type="date" class="form-control" id="data_acerto_3" name="data_acerto_3">
                        </div>
                        <div class="form-inline" id="data_acerto_2_error"></div>
                    </div>
                    <div class="form-group">
                        <h3 class="text-center">Exames Complementares - Valores</h3>
                        <table>
                            <tr class="table">
                                <!--<td>                                    
                                    <label for="label_exame_clinico">EXAME CLÍNICO:</label>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input name="exame_clinico" id="exame_clinico" type="text" class="input-mini dinheiro">
                                    </div>
                                </td>-->
                                <td>                            
                                    <label for="label_aaa">ÁCIDO METIL-HIPÚRICO:</label>                                    
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input name="acido_metil_hipurico" id="acido_metil_hipurico" class="input-mini dinheiro" type="text">                              
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
                                        <input name="hemograma" id="hemograma" type="text" class="input-mini dinheiro">  
                                    </div>
                                </td>
                                <td>                            
                                    <label for="label_aaa">ÁCIDO MANDÉLICO:</label>                                    
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input name="acido_mandelico" id="acido_mandelico" class="input-mini dinheiro" type="text">  
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
                                        <input name="vdrl" id="vdrl" type="text" class="input-mini dinheiro">
                                    </div>
                                </td>
                                <td>                            
                                    <label for="label_aaa">RETICULÓCITOS:</label>               
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input name="reticulocitos" id="reticulocitos" type="text" class="input-mini dinheiro">  
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
                                        <input name="parasitologico_fezes" id="parasitologico_fezes" type="text" class="input-mini dinheiro">  
                                    </div>
                                </td>
                                <td>                            
                                    <label for="label_aaa">CULTURAL DE OROFARINGE:</label>                                    
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input name="cultural_de_orofaringe" id="cultural_de_orofaringe" type="text" class="input-mini dinheiro">  
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
                                        <input name="coprocultura" id="coprocultura" type="text" class="input-mini dinheiro">  
                                    </div>
                                </td>
                                <td>                            
                                    <label for="label_aaa">MICOLÓGICO DE UNHA:</label>                            
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input name="micologico_de_unha" id="micologico_de_unha" type="text" class="input-mini dinheiro">  
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
                                        <input name="audiometria" id="audiometria" type="text" class="input-mini dinheiro">  
                                    </div>
                                </td>
                                <td>                            
                                    <label for="label_aaa">ECG:</label>                                    
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input name="ecg" id="ecg" type="text" class="input-mini dinheiro">
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
                                        <input name="acuidade_visual" id="acuidade_visual" type="text" class="input-mini dinheiro">  
                                    </div>
                                </td>
                                <td>                            
                                    <label for="label_aaa">EEG:</label>                                    
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input name="eeg" id="eeg" type="text" class="input-mini dinheiro">  
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
                                        <input name="plaquetas" id="plaquetas" type="text" class="input-mini dinheiro">
                                    </div>
                                </td>
                                <td>                            
                                    <label for="label_aaa">ERITROGRAMA:</label>                             
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input name="eritrograma" id="eritrograma" type="text" class="input-mini dinheiro">
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
                                        <input name="acido_tt_muconico" id="acido_tt_muconico" type="text" class="input-mini dinheiro">
                                    </div>
                                </td>
                                <td>                            
                                    <label for="label_aaa">GLICEMIA EM JEJUM:</label>                                    
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input name="glicemia_em_jejum" id="glicemia_em_jejum" type="text" class="input-mini dinheiro">
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
                                        <input name="acido_hipurico" id="acido_hipurico" type="text" class="input-mini dinheiro">
                                    </div>
                                </td>
                                <td>                            
                                    <label for="label_aaa">HEMOGRAMA COM PLAQUETAS:</label>                                    
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input name="hemograma_com_plaquetas" id="hemograma_com_plaquetas" type="text" class="input-mini dinheiro">
                                    </div></td>
                            </tr>
                            <tr>
                                <td>                            
                                    <label for="label_aaa">ANTIBIOGRAMA:</label>                                    
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input name="antibiograma" id="antibiograma" type="text" class="input-mini dinheiro">
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Salvar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_prestador"></div>
        </div>        
    </div>
</div>