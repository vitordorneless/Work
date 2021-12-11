<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script src="../js/maskMoney.js"></script>
<script>
    $(document).ready(function () {

        $("input.dinheiro").maskMoney({showSymbol: false, decimal: ",", thousands: "."});

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_medico").empty();
            var nome_medico = $("#nome_medico").val();
            var crm = $("#crm").val();
            var funcao = $("#funcao").val();
            var id_prestador = $("#id_prestador").val();
            var cod_sig = $("#cod_sig").val() === '' ? 0 : $("#cod_sig").val();
            var ddd = $("#ddd").val();
            var telefone = $("#telefone").val();
            var cpf = $("#cpf").val();
            var rg = $("#rg").val();
            var nascimento = $("#nascimento").val();
            var conselho = $("#conselho").val();
            var CNES = $("#CNES").val();
            var banco = $("#banco").val();
            var agencia = $("#agencia").val();
            var conta = $("#conta").val();
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
            var consulta = $("#consulta").val();            
            var obs = $("#obs").val();
            var email = $("#email").val();

            if ($("#cpf").val() === '')
            {
                $("#cpf_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o CPF...</div>"),
                        $("#cpf").focus();
                return false;
            } else {
                $("#cpf_error").empty();
            }

            if ($("#rg").val() === '')
            {
                $("#rg_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o RG do Médico...</div>"),
                        $("#rg").focus();
                return false;
            } else {
                $("#rg_error").empty();
            }

            if ($("#nascimento").val() === '')
            {
                $("#nascimento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Data de Nascimento do Médico...</div>"),
                        $("#nascimento").focus();
                return false;
            } else {
                $("#nascimento_error").empty();
            }

            if ($("#conselho").val() === '')
            {
                $("#conselho_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Conselho do Médico...</div>"),
                        $("#conselho").focus();
                return false;
            } else {
                $("#conselho_error").empty();
            }

            if ($("#CNES").val() === '')
            {
                CNES = 0;
            } else {
                $("#CNES_error").empty();
            }
            
            if ($("#obs").val() === '')
            {
                obs = 0;
            } else {
                $("#obs_error").empty();
            }

            if ($("#nome_medico").val() === '')
            {
                $("#nome_medico_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome do Médico...</div>"),
                        $("#nome_medico").focus();
                return false;
            } else {
                $("#nome_medico_error").empty();
            }

            if ($("#crm").val() === '')
            {
                $("#crm_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o CRM do Médico...</div>"),
                        $("#crm").focus();
                return false;
            } else {
                $("#crm_error").empty();
            }

            if ($("#funcao").val() === 'na')
            {
                $("#funcao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a Função do Médico...</div>"),
                        $("#funcao").focus();
                return false;
            } else {
                $("#funcao_error").empty();
            }

            if ($("#id_prestador").val() === 'na')
            {
                id_prestador = 0;
                return false;
            } else {
                $("#id_prestador_error").empty();
            }

            if ($("#banco").val() === 'na')
            {
                $("#banco_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Banco do Médico...</div>"),
                        $("#banco").focus();
                return false;
            } else {
                $("#banco_error").empty();
            }

            if ($("#ddd").val() === '')
            {
                $("#telefone_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o DDD do Telefone do Médico...</div>"),
                        $("#ddd").focus();
                return false;
            } else {
                $("#telefone_error").empty();
            }

            if ($("#telefone").val() === '')
            {
                $("#telefone_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Número do Telefone do Médico...</div>"),
                        $("#telefone").focus();
                return false;
            } else {
                $("#telefone_error").empty();
            }
            
            if ($("#email").val() === '')
            {
                $("#email_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#email").focus();
                return false;
            } else {
                $("#email_error").empty();
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

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/medico_adicionar.php",
                data: "nome_medico=" + nome_medico + "&crm=" + crm + "&funcao=" + funcao + "&cod_sig=" + cod_sig + "&ddd=" + ddd +
                        "&telefone=" + telefone + "&cpf=" + cpf + "&rg=" + rg + "&nascimento=" + nascimento + "&conselho=" + conselho + "&CNES=" + CNES +
                        "&banco=" + banco + "&agencia=" + agencia + "&conta=" + conta + "&id_prestador=" + id_prestador + "&exame_clinico=" + exame_clinico +
                        "&acido_metil_hipurico=" + acido_metil_hipurico + "&hemograma=" + hemograma + "&acido_mandelico=" + acido_mandelico + "&vdrl=" + vdrl +
                        "&reticulocitos=" + reticulocitos + "&parasitologico_fezes=" + parasitologico_fezes + "&cultural_de_orofaringe=" + cultural_de_orofaringe +
                        "&coprocultura=" + coprocultura + "&micologico_de_unha=" + micologico_de_unha + "&audiometria=" + audiometria + "&ecg=" + ecg +
                        "&acuidade_visual=" + acuidade_visual + "&eeg=" + eeg + "&plaquetas=" + plaquetas + "&eritrograma=" + eritrograma +
                        "&acido_tt_muconico=" + acido_tt_muconico + "&glicemia_em_jejum=" + glicemia_em_jejum + "&acido_hipurico=" + acido_hipurico + "&consulta=" + consulta + "&obs=" + obs + "&email=" + email,
                beforeSend: function () {
                    $("#conteudo_medico").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_medico").html(response),
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
            <h2><strong>Adicionar</strong> Médico</h2>
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
                        <label for="label_nome_medico">Nome:</label>
                        <input type="text" class="form-control" id="nome_medico" name="nome_medico" placeholder="Nome do Médico" autofocus>
                        <div class="form-inline" id="nome_medico_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_cpf">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" maxlength="11">
                        <div class="form-inline" id="cpf_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_rg">Identidade Nº:</label>
                        <input type="text" class="form-control" id="rg" name="rg" placeholder="Númedo da Identidade" maxlength="15">
                        <div class="form-inline" id="rg_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_nascimento">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="nascimento" name="nascimento">
                        <div class="form-inline" id="nascimento_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_conselho">Conselho:</label>
                        <input type="text" class="form-control" id="conselho" name="conselho" placeholder="Informe Conselho">
                        <div class="form-inline" id="conselho_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_CNES">CNES:</label>
                        <input type="text" class="form-control" id="CNES" name="CNES" placeholder="Informe CNES">
                        <div class="form-inline" id="CNES_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_cod_sig_medico">Código SIG:</label>
                        <input type="text" class="form-control" id="cod_sig" name="cod_sig" placeholder="Código do SIGAMA">
                        <div class="form-inline" id="cod_sig_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_crm_medico">CRM:</label>
                        <input type="text" class="form-control" id="crm" name="crm" placeholder="CRM">
                        <div class="form-inline" id="crm_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_funcao_medico">Especialidade:</label>
                        <select class="form-control" id="funcao" name="funcao" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            include '../config/database_mysql.php';
                            $pdo = Database::connect();
                            $sql = "select id_funcao, funcao from wal_funcao_medico where ativo = 1 order by funcao";
                            foreach ($pdo->query($sql) as $value) {
                                echo '<option value="' . $value['id_funcao'] . '">' . $value['funcao'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="funcao_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_prestador">Prestador:</label>
                        <select class="form-control" id="id_prestador" name="id_prestador" required>
                            <option selected value="na">
                                Nenhum...
                            </option>
                            <?php
                            $sql2 = "select id, razao_social from wal_prestadores where status = 1 order by razao_social";
                            foreach ($pdo->query($sql2) as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['razao_social'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="id_prestador_error"></div>
                    </div>                    
                    <div class="form-group">
                        <label for="label_tel_medico">Telefone:</label>
                        <input type="text" class="input-mini" id="ddd" name="ddd" placeholder="DDD">
                        <input type="text" class="input-large" id="telefone" name="telefone" placeholder="999999999" maxlength="10">
                        <div class="form-inline" id="telefone_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                        <div class="form-inline" id="email_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_funcao_medico">Banco:</label>
                        <select class="form-control" id="banco" name="banco" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            $sql1 = "select codigo, nome_banco from bancos order by nome_banco";
                            foreach ($pdo->query($sql1) as $value) {
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
                        <textarea class="form-control" name="obs" id="obs"></textarea>
                        <div class="form-inline" id="obs_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_consulta">Valor da Consulta:</label>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="text" class="form-control dinheiro" id="consulta" name="consulta" placeholder="Informe Valor Acertado">
                        </div>
                        <div class="form-inline" id="consulta_error"></div>
                    </div>
                    <div class="form-group">
                        <h3 class="text-center">Exames Complementares - Valores</h3>
                        <table>
                            <tr class="table">
                                <td>                                    
                                    <label for="label_exame_clinico">EXAME CLÍNICO:</label>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input name="exame_clinico" id="exame_clinico" type="text" class="input-mini dinheiro">
                                    </div>
                                </td>
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
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <button class="btn btn-primary" id="envia" type="submit">Salvar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_medico"></div>
        </div>        
    </div>
</div>