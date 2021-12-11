<?php
include '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' no foi encontrado!');
}
$medico = new Medicos();
$conta = new Medicos_Conta_Corrente();
$tutus = new Medicos_Valores_Exames();
$medico->set_id_medico(filter_input(INPUT_GET, 'id_medico', FILTER_SANITIZE_NUMBER_INT));
$array_medico = $medico->Dados_Medicos($medico->get_id_medico());
$array_conta_corrente = $conta->Dados_Medico_conta_Corrente($array_medico['crm']);
$array_valores = $tutus->Dados_Medico_Valores_Exames($array_medico['crm']);
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script src="../js/maskMoney.js"></script>
<script>
    $(document).ready(function () {
        
        $("#fechar_modal").click(function () {
            $("#refresca_medico_listar").load('medico_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_medico_listar").load('medico_listar.php');
            }
        });
        
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
            var id_medico = $("#id_medico").val();
            var id_cc = $("#id_cc").val();
            var crm = $("#crm").val();
            var funcao = $("#funcao").val();
            var id_prestador = $("#id_prestador").val();
            var cod_sig = $("#cod_sig").val();
            var ddd = $("#ddd").val();
            var status = $("#status").val();
            var telefone = $("#telefone").val();
            var cpf = $("#cpf").val();
            var rg = $("#rg").val();
            var nascimento = $("#nascimento").val();
            var conselho = $("#conselho").val();
            var CNES = $("#CNES").val();
            var banco = $("#banco").val();
            var agencia = $("#agencia").val();
            var conta = $("#conta").val();
            var obs = $("#obs").val();
            var email = $("#email").val();
            
            var consulta = $("#consulta").val() === '' ? 0 : $("#consulta").val();
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
            var id_medico_valores = $("#id_medico_valores").val();

            if ($("#nome_medico").val() === '')
            {
                $("#nome_medico_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome do Médico...</div>"),
                        $("#nome_medico").focus();
                return false;
            } else {
                $("#nome_medico_error").empty();
            }

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
            } else {
                $("#id_prestador_error").empty();
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

            if ($("#banco").val() === 'na')
            {
                $("#banco_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Banco do Médico...</div>"),
                        $("#banco").focus();
                return false;
            } else {
                $("#banco_error").empty();
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
                url: "../Controller/medico_editar.php",
                data: "nome_medico=" + nome_medico + "&crm=" + crm + "&funcao=" + funcao + "&cod_sig=" + cod_sig + "&ddd=" + ddd +
                        "&telefone=" + telefone + "&cpf=" + cpf + "&rg=" + rg + "&nascimento=" + nascimento + "&conselho=" + conselho + "&CNES=" + CNES +
                        "&banco=" + banco + "&agencia=" + agencia + "&conta=" + conta + "&id_prestador=" + id_prestador + "&id_medico=" + id_medico + 
                        "&id_cc=" + id_cc + "&status=" + status + "&obs=" + obs + "&email=" + email + 
                        "&exame_clinico=" + exame_clinico + "&acido_metil_hipurico=" + acido_metil_hipurico + "&hemograma=" + hemograma + "&acido_mandelico=" + acido_mandelico + 
                        "&vdrl=" + vdrl + "&reticulocitos=" + reticulocitos + "&parasitologico_fezes=" + parasitologico_fezes + "&cultural_de_orofaringe=" + cultural_de_orofaringe + 
                        "&coprocultura=" + coprocultura + "&micologico_de_unha=" + micologico_de_unha + "&audiometria=" + audiometria + "&ecg=" + ecg + 
                        "&acuidade_visual=" + acuidade_visual + "&eeg=" + eeg + "&plaquetas=" + plaquetas + "&eritrograma=" + eritrograma + 
                        "&acido_tt_muconico=" + acido_tt_muconico + "&glicemia_em_jejum=" + glicemia_em_jejum + "&acido_hipurico=" + acido_hipurico + "&id_medico_valores=" + id_medico_valores + "&consulta=" + consulta,
                beforeSend: function () {
                    $("#conteudo_medico").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_medico").html(response),
                    $("#refresca_medico_listar").load('medico_listar.php');
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
    <h4 class="modal-title">Editar Medico</h4>
</div>
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_nome_medico">Nome:</label>
            <input type="text" class="form-control" id="nome_medico" name="nome_medico" placeholder="Nome do Médico" value="<?php echo $array_medico['nome']; ?>" autofocus>
            <input type="hidden" class="form-control" id="id_medico" name="id_medico" value="<?php echo $array_medico['id_medico']; ?>">
            <div class="form-inline" id="nome_medico_error"></div>
        </div>
        <div class="form-group">
            <label for="label_cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" maxlength="11" value="<?php echo $array_medico['cpf']; ?>">
            <div class="form-inline" id="cpf_error"></div>
        </div>
        <div class="form-group">
            <label for="label_rg">Identidade Nº:</label>
            <input type="text" class="form-control" id="rg" name="rg" placeholder="Númedo da Identidade" maxlength="15" value="<?php echo $array_medico['rg']; ?>">
            <div class="form-inline" id="rg_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nascimento">Data de Nascimento:</label>
            <input type="date" class="form-control" id="nascimento" name="nascimento" value="<?php echo $array_medico['data_nascimento']; ?>">
            <div class="form-inline" id="nascimento_error"></div>
        </div>
        <div class="form-group">
            <label for="label_conselho">Conselho:</label>
            <input type="text" class="form-control" id="conselho" name="conselho" placeholder="Informe Conselho" value="<?php echo $array_medico['conselho']; ?>">
            <div class="form-inline" id="conselho_error"></div>
        </div>
        <div class="form-group">
            <label for="label_CNES">CNES:</label>
            <input type="text" class="form-control" id="CNES" name="CNES" placeholder="Informe CNES" value="<?php echo $array_medico['CNES']; ?>">
            <div class="form-inline" id="CNES_error"></div>
        </div>
        <div class="form-group">
            <label for="label_crm_medico">CRM:</label>
            <input type="text" class="form-control" id="crm" name="crm" placeholder="CRM" value="<?php echo $array_medico['crm']; ?>">
            <div class="form-inline" id="crm_error"></div>
        </div>
        <div class="form-group">
            <label for="label_funcao_medico">Especialidade:</label>
            <select class="form-control" id="funcao" name="funcao" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $pdo = Database::connect();
                $sql = "select id_funcao, funcao from wal_funcao_medico where ativo = 1 order by funcao";
                foreach ($pdo->query($sql) as $value) {
                    $option = $value['id_funcao'] == $array_medico['id_funcao'] ? 'value="' . $value['id_funcao'] . '" selected' : 'value="' . $value['id_funcao'] . '"';
                    echo '<option ' . $option . '>' . $value['funcao'] . '</option>';
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
                    $option = $value['id'] == $array_medico['id_prestador'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . $value['razao_social'] . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_prestador_error"></div>
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
            <label for="label_obs">Observações:</label>                        
            <textarea class="form-control" name="obs" id="obs"><?php echo $array_medico['obs']; ?></textarea>
            <div class="form-inline" id="obs_error"></div>
        </div>
        <div class="form-group">
            <label for="label_cod_sig_medico">Código SIG:</label>
            <input type="text" class="form-control" id="cod_sig" name="cod_sig" placeholder="Código do SIGAMA" value="<?php echo $array_medico['cod_sig']; ?>">
            <div class="form-inline" id="cod_sig_error"></div>
        </div>
        <div class="form-group">
            <label for="label_tel_medico">Telefone:</label>
            <input type="text" class="input-mini" id="ddd" name="ddd" placeholder="DDD" value="<?php echo $array_medico['ddd_telefone']; ?>" maxlength="3">
            <input type="text" class="input-large" id="telefone" name="telefone" placeholder="999999999" maxlength="10" value="<?php echo $array_medico['telefone']; ?>">
            <div class="form-inline" id="telefone_error"></div>
        </div>
        <div class="form-group">
            <label for="label_email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $array_medico['email']; ?>">
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
                    $optionn = $value['codigo'] == $array_conta_corrente['id_banco'] ? 'value="' . $value['codigo'] . '" selected' : 'value="' . $value['codigo'] . '"';
                    echo '<option ' . $optionn . '>' . utf8_encode($value['nome_banco']) . '</option>';
                }
                Database::disconnect();
                ?>
            </select>
            <div class="form-inline" id="banco_error"></div>
        </div>
        <div class="form-group">
            <label for="label_tel_medico">Agência e Conta:</label>
            <input type="text" class="input-mini" id="agencia" name="agencia" placeholder="Agência" value="<?php echo $array_conta_corrente['agencia'] == NULL ? 0 : $array_conta_corrente['agencia']; ?>">
            <input type="hidden" class="input-mini" id="id_cc" name="id_cc" value="<?php echo $array_conta_corrente['id'] == NULL ? 0 : $array_conta_corrente['id']; ?>">
            <input type="text" class="input-large" id="conta" name="conta" placeholder="Conta-Corrente" maxlength="30" value="<?php echo $array_conta_corrente['conta_corrente'] == NULL ? 0 : $array_conta_corrente['conta_corrente']; ?>">
            <div class="form-inline" id="conta_error"></div>
        </div>
        <div class="form-group">
            <h3 class="text-center">Exames Complementares - Editar Valores</h3>
            <table>
                <tr class="table">
                    <td>                                    
                        <label for="label_consulta">CONSULTA:</label>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="consulta" id="consulta" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['consulta']; ?>"  value="<?php echo $array_valores['exame_clinico']; ?>">
                        </div>
                    </td>
                </tr>
                <tr class="table">
                    <td>                                    
                        <label for="label_exame_clinico">EXAME CLÍNICO:</label>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="exame_clinico" id="exame_clinico" type="text" class="input-mini dinheiro" value="<?php echo $array_valores['exame_clinico']; ?>"  value="<?php echo $array_valores['exame_clinico']; ?>">
                        </div>
                    </td>
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
            </table>
        </div>
        <button class="btn btn-primary btn-facebook" id="envia" type="submit">Editar Dados do Médico</button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_medico"></div>
</div>