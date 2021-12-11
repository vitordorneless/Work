<?php
session_start();
include '../config/database_mysql.php';
$pdo = Database::connect();
?>
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
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var empresa = $("#empresa").val();
            var estabelecimento = $("#estabelecimento").val();
            var nome = $("#nome").val();
            var cpf = $("#cpf").val();
            var codepf = $("#codepf").val();
            var data_nascimento = $("#data_nascimento").val();
            var setor = $("#setor").val();
            var cargo = $("#cargo").val();
            var id_medico = $("#id_medico").val();
            var id_medico_coordenador = $("#id_medico_coordenador").val();
            var data_periodico = $("#data_periodico").val();
            var caixa = $("#caixa").val();
            var comp_ACIDO_METIL_HIPURICO = $("#comp_ACIDO_METIL_HIPURICO").val() === '' ? '0000-00-00 00:00:00' : $("#comp_ACIDO_METIL_HIPURICO").val();
            var comp_HEMOGRAMA = $("#comp_HEMOGRAMA").val() === '' ? '0000-00-00 00:00:00' : $("#comp_HEMOGRAMA").val();
            var comp_ACIDO_MANDELICO = $("#comp_ACIDO_MANDELICO").val() === '' ? '0000-00-00 00:00:00' : $("#comp_ACIDO_MANDELICO").val();
            var comp_VDRL = $("#comp_VDRL").val() === '' ? '0000-00-00 00:00:00' : $("#comp_VDRL").val();
            var comp_RETICULOCITOS = $("#comp_RETICULOCITOS").val() === '' ? '0000-00-00 00:00:00' : $("#comp_RETICULOCITOS").val();
            var comp_PARASITOLOGICO_FEZES = $("#comp_PARASITOLOGICO_FEZES").val() === '' ? '0000-00-00 00:00:00' : $("#comp_PARASITOLOGICO_FEZES").val();
            var comp_CULTURAL_DE_OROFARINGE = $("#comp_CULTURAL_DE_OROFARINGE").val() === '' ? '0000-00-00 00:00:00' : $("#comp_CULTURAL_DE_OROFARINGE").val();
            var comp_COPROCULTURA = $("#comp_COPROCULTURA").val() === '' ? '0000-00-00 00:00:00' : $("#comp_COPROCULTURA").val();
            var comp_MICOLOGICO_DE_UNHA = $("#comp_MICOLOGICO_DE_UNHA").val() === '' ? '0000-00-00 00:00:00' : $("#comp_MICOLOGICO_DE_UNHA").val();
            var comp_AUDIOMETRIA = $("#comp_AUDIOMETRIA").val() === '' ? '0000-00-00 00:00:00' : $("#comp_AUDIOMETRIA").val();
            var comp_ECG = $("#comp_ECG").val() === '' ? '0000-00-00 00:00:00' : $("#comp_ECG").val();
            var comp_ACUIDADE_VISUAL = $("#comp_ACUIDADE_VISUAL").val() === '' ? '0000-00-00 00:00:00' : $("#comp_ACUIDADE_VISUAL").val();
            var comp_EEG = $("#comp_EEG").val() === '' ? '0000-00-00 00:00:00' : $("#comp_EEG").val();
            var comp_PLAQUETAS = $("#comp_PLAQUETAS").val() === '' ? '0000-00-00 00:00:00' : $("#comp_PLAQUETAS").val();
            var comp_ERITROGRAMA = $("#comp_ERITROGRAMA").val() === '' ? '0000-00-00 00:00:00' : $("#comp_ERITROGRAMA").val();
            var comp_ACIDO_TT_MUCONICO = $("#comp_ACIDO_TT_MUCONICO").val() === '' ? '0000-00-00 00:00:00' : $("#comp_ACIDO_TT_MUCONICO").val();
            var comp_GLICEMIA_EM_JEJUM = $("#comp_GLICEMIA_EM_JEJUM").val() === '' ? '0000-00-00 00:00:00' : $("#comp_GLICEMIA_EM_JEJUM").val();
            var comp_ACIDO_HIPURICO = $("#comp_ACIDO_HIPURICO").val() === '' ? '0000-00-00 00:00:00' : $("#comp_ACIDO_HIPURICO").val();
            var comp_AVALIACAO_PSICOSSOCIAL = $("#comp_AVALIACAO_PSICOSSOCIAL").val() === '' ? '0000-00-00 00:00:00' : $("#comp_AVALIACAO_PSICOSSOCIAL").val();
            var status_ACIDO_METIL_HIPURICO = $("#status_ACIDO_METIL_HIPURICO").val() === 'na' ? 0 : $("#status_ACIDO_METIL_HIPURICO").val();
            var status_HEMOGRAMA = $("#status_HEMOGRAMA").val() === 'na' ? 0 : $("#status_HEMOGRAMA").val();
            var status_ACIDO_MANDELICO = $("#status_ACIDO_MANDELICO").val() === 'na' ? 0 : $("#status_ACIDO_MANDELICO").val();
            var status_VDRL = $("#status_VDRL").val() === 'na' ? 0 : $("#status_VDRL").val();
            var status_RETICULOCITOS = $("#status_RETICULOCITOS").val() === 'na' ? 0 : $("#status_RETICULOCITOS").val();
            var status_PARASITOLOGICO_FEZES = $("#status_PARASITOLOGICO_FEZES").val() === 'na' ? 0 : $("#status_PARASITOLOGICO_FEZES").val();
            var status_CULTURAL_DE_OROFARINGE = $("#status_CULTURAL_DE_OROFARINGE").val() === 'na' ? 0 : $("#status_CULTURAL_DE_OROFARINGE").val();
            var status_COPROCULTURA = $("#status_COPROCULTURA").val() === 'na' ? 0 : $("#status_COPROCULTURA").val();
            var status_MICOLOGICO_DE_UNHA = $("#status_MICOLOGICO_DE_UNHA").val() === 'na' ? 0 : $("#status_MICOLOGICO_DE_UNHA").val();
            var status_AUDIOMETRIA = $("#status_AUDIOMETRIA").val() === 'na' ? 0 : $("#status_AUDIOMETRIA").val();
            var status_ECG = $("#status_ECG").val() === 'na' ? 0 : $("#status_ECG").val();
            var status_ACUIDADE_VISUAL = $("#status_ACUIDADE_VISUAL").val() === 'na' ? 0 : $("#status_ACUIDADE_VISUAL").val();
            var status_EEG = $("#status_EEG").val() === 'na' ? 0 : $("#status_EEG").val();
            var status_PLAQUETAS = $("#status_PLAQUETAS").val() === 'na' ? 0 : $("#status_PLAQUETAS").val();
            var status_ERITROGRAMA = $("#status_ERITROGRAMA").val() === 'na' ? 0 : $("#status_ERITROGRAMA").val();
            var status_ACIDO_TT_MUCONICO = $("#status_ACIDO_TT_MUCONICO").val() === 'na' ? 0 : $("#status_ACIDO_TT_MUCONICO").val();
            var status_GLICEMIA_EM_JEJUM = $("#status_GLICEMIA_EM_JEJUM").val() === 'na' ? 0 : $("#status_GLICEMIA_EM_JEJUM").val();
            var status_ACIDO_HIPURICO = $("#status_ACIDO_HIPURICO").val() === 'na' ? 0 : $("#status_ACIDO_HIPURICO").val();
            var status_AVALIACAO_PSICOSSOCIAL = $("#status_AVALIACAO_PSICOSSOCIAL").val() === 'na' ? 0 : $("#status_AVALIACAO_PSICOSSOCIAL").val();
            var erro_coord = $("#erro_coord").is(":checked") === true ? 1 : 0;
            var erro_tel = $("#erro_tel").is(":checked") === true ? 1 : 0;
            var erro_falta_habilitado = $("#erro_falta_habilitado").is(":checked") === true ? 1 : 0;
            var erro_falta_apto = $("#erro_falta_apto").is(":checked") === true ? 1 : 0;
            var erro_rasuras = $("#erro_rasuras").is(":checked") === true ? 1 : 0;
            var erro_assinatura_medico = $("#erro_assinatura_medico").is(":checked") === true ? 1 : 0;
            var erro_assinatura_ativo = $("#erro_assinatura_ativo").is(":checked") === true ? 1 : 0;
            var erro_data_exames = $("#erro_data_exames").is(":checked") === true ? 1 : 0;
            var erro_data_ASO = $("#erro_data_ASO").is(":checked") === true ? 1 : 0;
            var erro_riscos = $("#erro_riscos").is(":checked") === true ? 1 : 0;
            var erro_identificacao = $("#erro_identificacao").is(":checked") === true ? 1 : 0;
            var erro_carimbo = $("#erro_carimbo").is(":checked") === true ? 1 : 0;

            if ($("#empresa").val() === 'na') {
                $("#empresa_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha uma Empresa...</div>"),
                        $("#empresa").focus();
                return false;
            } else {
                $("#empresa_error").empty();
            }

            if (($("#empresa").val() !== 'na') && ($("#estabelecimento").val() === '0')) {
                $("#estabelecimento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha um Estabelecimento...</div>"),
                        $("#estabelecimento").focus();
                return false;
            } else {
                $("#estabelecimento_error").empty();
            }

            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome do Ativo...</div>"),
                        $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }

            if ($("#cpf").val() === '')
            {
                $("#cpf_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o CPF do Ativo...</div>"),
                        $("#cpf").focus();
                return false;
            } else {
                $("#cpf_error").empty();
            }

            if ($("#data_nascimento").val() === '')
            {
                $("#data_nascimento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a data de Nascimento do Ativo...</div>"),
                        $("#data_nascimento").focus();
                return false;
            } else {
                $("#data_nascimento_error").empty();
            }

            if ($("#data_periodico").val() === '')
            {
                $("#data_periodico_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(15000),
                        $("#data_periodico").focus();
                return false;
            } else {
                $("#data_periodico_error").empty();
            }

            if (($("#setor").val() === '0') || ($("#setor").val() === 'na'))
            {
                setor = 0;
            }

            if (($("#cargo").val() === '0') || ($("#cargo").val() === 'na'))
            {
                cargo = 0;
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/ativos_include.php",
                data: "empresa=" + empresa + "&estabelecimento=" + estabelecimento + "&nome=" + nome + "&cpf=" + cpf + "&data_nascimento=" + data_nascimento +
                        "&setor=" + setor + "&cargo=" + cargo + "&id_medico=" + id_medico + "&data_periodico=" + data_periodico +
                        "&comp_ACIDO_METIL_HIPURICO=" + comp_ACIDO_METIL_HIPURICO + "&comp_HEMOGRAMA=" + comp_HEMOGRAMA
                        + "&comp_ACIDO_MANDELICO=" + comp_ACIDO_MANDELICO + "&comp_VDRL=" + comp_VDRL + "&comp_RETICULOCITOS="
                        + comp_RETICULOCITOS + "&comp_PARASITOLOGICO_FEZES=" + comp_PARASITOLOGICO_FEZES + "&comp_CULTURAL_DE_OROFARINGE="
                        + comp_CULTURAL_DE_OROFARINGE + "&comp_COPROCULTURA=" + comp_COPROCULTURA
                        + "&comp_MICOLOGICO_DE_UNHA=" + comp_MICOLOGICO_DE_UNHA + "&comp_AUDIOMETRIA=" + comp_AUDIOMETRIA +
                        "&comp_ECG=" + comp_ECG + "&comp_ACUIDADE_VISUAL=" + comp_ACUIDADE_VISUAL + "&comp_EEG=" + comp_EEG +
                        "&comp_PLAQUETAS=" + comp_PLAQUETAS + "&comp_ERITROGRAMA=" + comp_ERITROGRAMA +
                        "&comp_ACIDO_TT_MUCONICO=" + comp_ACIDO_TT_MUCONICO + "&comp_GLICEMIA_EM_JEJUM=" + comp_GLICEMIA_EM_JEJUM +
                        "&comp_ACIDO_HIPURICO=" + comp_ACIDO_HIPURICO + "&comp_AVALIACAO_PSICOSSOCIAL=" + comp_AVALIACAO_PSICOSSOCIAL + "&caixa=" + caixa +
                        "&status_ACIDO_METIL_HIPURICO=" + status_ACIDO_METIL_HIPURICO + "&status_HEMOGRAMA=" + status_HEMOGRAMA + "&status_ACIDO_MANDELICO=" + status_ACIDO_MANDELICO + "&status_VDRL=" + status_VDRL + "&status_RETICULOCITOS=" + status_RETICULOCITOS + "&status_PARASITOLOGICO_FEZES=" + status_PARASITOLOGICO_FEZES +
                        "&status_CULTURAL_DE_OROFARINGE=" + status_CULTURAL_DE_OROFARINGE + "&status_COPROCULTURA=" + status_COPROCULTURA + "&status_MICOLOGICO_DE_UNHA=" + status_MICOLOGICO_DE_UNHA +
                        "&status_AUDIOMETRIA=" + status_AUDIOMETRIA + "&status_ECG=" + status_ECG + "&status_ACUIDADE_VISUAL=" + status_ACUIDADE_VISUAL +
                        "&status_EEG=" + status_EEG + "&status_PLAQUETAS=" + status_PLAQUETAS + "&status_ERITROGRAMA=" + status_ERITROGRAMA +
                        "&status_ACIDO_TT_MUCONICO=" + status_ACIDO_TT_MUCONICO + "&status_GLICEMIA_EM_JEJUM=" + status_GLICEMIA_EM_JEJUM +
                        "&status_ACIDO_HIPURICO=" + status_ACIDO_HIPURICO + "&status_AVALIACAO_PSICOSSOCIAL=" + status_AVALIACAO_PSICOSSOCIAL +
                        "&id_medico_coordenador=" + id_medico_coordenador + "&codepf=" + codepf +
                        "&erro_coord=" + erro_coord + "&erro_tel=" + erro_tel +
                        "&erro_falta_habilitado=" + erro_falta_habilitado + "&erro_falta_apto=" + erro_falta_apto +
                        "&erro_rasuras=" + erro_rasuras + "&erro_assinatura_ativo=" + erro_assinatura_ativo +
                        "&erro_assinatura_medico=" + erro_assinatura_medico + "&erro_data_exames=" + erro_data_exames +
                        "&erro_data_ASO=" + erro_data_ASO + "&erro_riscos=" + erro_riscos + "&erro_identificacao=" + erro_identificacao +
                        "&erro_carimbo=" + erro_carimbo,
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
<style type="text/css">
    td.vcenter {
        vertical-align: middle;
        text-align: center;
    }
</style>
<div class="row">
    <div class="widget">
        <div class="widget-header transparent">
            <h2><strong>Incluir Ativos</strong> Walmart</h2>
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
                        <label>Empresa:</label>
                        <select class="form-control" id="empresa" name="empresa" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            $sql = "SELECT cod_empresa, concat(cod_empresa,' - ',desc_empresa) as desc_empresas FROM wal_empresa ORDER BY desc_empresa ASC";
                            foreach ($pdo->query($sql) as $value) {
                                echo '<option value="' . $value['cod_empresa'] . '">' . $value['desc_empresas'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="empresa_error"></div>
                    </div>
                    <div class="form-group">
                        <label>Estabelecimento:</label>
                        <select class="form-control" id="estabelecimento" name="estabelecimento" required>
                            <option selected value="na">
                                Aguardando...
                            </option>
                        </select>
                        <div class="form-inline" id="estabelecimento_error"></div>
                    </div>
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Associado">                        
                        <div class="form-inline" id="nome_error"></div>
                    </div>
                    <div class="form-group">
                        <label>Código PF:</label>
                        <input type="text" class="form-control" id="codepf" name="codepf" placeholder="Nome do Associado" value="0">                        
                        <div class="form-inline" id="nome_error"></div>
                    </div>
                    <div class="form-group">
                        <label>CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Apenas Números" maxlength="11">
                        <div class="form-inline" id="cpf_error"></div>
                    </div>
                    <div class="form-group">
                        <label>Data de Nascimento:</label>
                        <input type="text" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Formato dd/mm/aaaa">
                        <div class="form-inline" id="data_nascimento_error"></div>
                    </div>
                    <div class="form-group">
                        <label>Setor:</label>
                        <select class="form-control" id="setor" name="setor">
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            $sql99 = "select distinct desc_depto as desc_depto, cod_depto from wal_departamento order by desc_depto asc";
                            foreach ($pdo->query($sql99) as $value) {
                                echo '<option value="' . $value['cod_depto'] . '">' . $value['desc_depto'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="setor_error"></div>
                    </div>
                    <div class="form-group">
                        <label>Cargo:</label>
                        <select class="form-control" id="cargo" name="cargo">
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            $sql199 = "select cod_cargo, desc_cargo from wal_cargo order by desc_cargo asc";
                            foreach ($pdo->query($sql199) as $value) {
                                echo '<option value="' . $value['cod_cargo'] . '">' . $value['desc_cargo'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="cargo_error"></div>
                    </div>                    
                    <div class="form-group">
                        <label>Médico:</label>
                        <select class="form-control text-uppercase" id="id_medico" name="id_medico" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            $sqlmedico = "select id, nome_extenso from usuarios where setor in (28) and status in (1) order by nome asc";
                            foreach ($pdo->query($sqlmedico) as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['nome_extenso'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="cpf_medico_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="estabelecimento_label">Médico Coordenador:</label>                        
                        <select class="form-inline text-uppercase" id="id_medico_coordenador" name="id_medico_coordenador" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            $sqlmedico_coord = "select id, nome from pcmso_coordenadores where ativo in (1) order by nome asc";
                            foreach ($pdo->query($sqlmedico_coord) as $value) {
                                echo '<option value="' . $value['id'] . '">' . utf8_encode($value['nome']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="estabelecimento_label">Data do Exame Clínico:</label>
                        <input type="date" class="form-inline" id="data_periodico" name="data_periodico">
                        <label for="estabelecimento_label">Caixa:</label>                        
                        <select class="form-inline" id="caixa" name="caixa" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            $sql1 = "select id, etiqueta from wal_caixa where id_wal_box in (1) and status in (1) order by etiqueta asc";
                            foreach ($pdo->query($sql1) as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['etiqueta'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="caixa_error"></div>                
                    </div>            
                    <div class="form-group">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td colspan="3" class="text-center text-uppercase"><strong>complementares</strong></td>
                            </tr>
                            <tr>
                                <td class="text-center">ÁCIDO METIL-HIPÚRICO</td>
                                <td class="text-center">HEMOGRAMA</td>
                                <td class="text-center">ÁCIDO MANDÉLICO</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input type="date" id="comp_ACIDO_METIL_HIPURICO" name="comp_ACIDO_METIL_HIPURICO"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_ACIDO_METIL_HIPURICO" name="status_ACIDO_METIL_HIPURICO" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql2 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql2) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <input type="date" id="comp_HEMOGRAMA" name="comp_HEMOGRAMA"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_HEMOGRAMA" name="status_HEMOGRAMA" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql3 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql3) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <input type="date" id="comp_ACIDO_MANDELICO" name="comp_ACIDO_MANDELICO"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_ACIDO_MANDELICO" name="status_ACIDO_MANDELICO" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql4 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql4) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">VDRL</td>
                                <td class="text-center">RETICULÓCITOS</td>
                                <td class="text-center">PARASITOLÓGICO FEZES</td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="date" id="comp_VDRL" name="comp_VDRL"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_VDRL" name="status_VDRL" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql5 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql5) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center"><input type="date" id="comp_RETICULOCITOS" name="comp_RETICULOCITOS"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_RETICULOCITOS" name="status_RETICULOCITOS" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql6 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql6) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center"><input type="date" id="comp_PARASITOLOGICO_FEZES" name="comp_PARASITOLOGICO_FEZES"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_PARASITOLOGICO_FEZES" name="status_PARASITOLOGICO_FEZES" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql7 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql7) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">CULTURAL DE OROFARINGE</td>
                                <td class="text-center">COPROCULTURA</td>
                                <td class="text-center">MICOLÓGICO DE UNHA</td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="date" id="comp_CULTURAL_DE_OROFARINGE" name="comp_CULTURAL_DE_OROFARINGE"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_CULTURAL_DE_OROFARINGE" name="status_CULTURAL_DE_OROFARINGE" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql8 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql8) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center"><input type="date" id="comp_COPROCULTURA" name="comp_COPROCULTURA"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_COPROCULTURA" name="status_COPROCULTURA" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql9 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql9) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center"><input type="date" id="comp_MICOLOGICO_DE_UNHA" name="comp_MICOLOGICO_DE_UNHA"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_MICOLOGICO_DE_UNHA" name="status_MICOLOGICO_DE_UNHA" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql10 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql10) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">AUDIOMETRIA</td>
                                <td class="text-center">ECG</td>
                                <td class="text-center">ACUIDADE VISUAL</td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="date" id="comp_AUDIOMETRIA" name="comp_AUDIOMETRIA"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_AUDIOMETRIA" name="status_AUDIOMETRIA" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql11 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql11) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center"><input type="date" id="comp_ECG" name="comp_ECG"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_ECG" name="status_ECG" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql12 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql12) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center"><input type="date" id="comp_ACUIDADE_VISUAL" name="comp_ACUIDADE_VISUAL"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_ACUIDADE_VISUAL" name="status_ACUIDADE_VISUAL" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql13 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql13) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">EEG</td>
                                <td class="text-center">PLAQUETAS</td>
                                <td class="text-center">ERITROGRAMA</td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="date" id="comp_EEG" name="comp_EEG"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_EEG" name="status_EEG" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql14 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql14) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center"><input type="date" id="comp_PLAQUETAS" name="comp_PLAQUETAS"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_PLAQUETAS" name="status_PLAQUETAS" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql15 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql15) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center"><input type="date" id="comp_ERITROGRAMA" name="comp_ERITROGRAMA"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_ERITROGRAMA" name="status_ERITROGRAMA" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql16 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql16) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">ÁCIDO TT MUCÔNICO</td>
                                <td class="text-center">GLICEMIA EM JEJUM</td>
                                <td class="text-center">ÁCIDO HIPÚRICO</td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="date" id="comp_ACIDO_TT_MUCONICO" name="comp_ACIDO_TT_MUCONICO"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_ACIDO_TT_MUCONICO" name="status_ACIDO_TT_MUCONICO" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql17 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql17) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-center"><input type="date" id="comp_GLICEMIA_EM_JEJUM" name="comp_GLICEMIA_EM_JEJUM"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_GLICEMIA_EM_JEJUM" name="status_GLICEMIA_EM_JEJUM" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql18 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql18) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?></td>
                                <td class="text-center"><input type="date" id="comp_ACIDO_HIPURICO" name="comp_ACIDO_HIPURICO"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_ACIDO_HIPURICO" name="status_ACIDO_HIPURICO" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql19 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql19) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">AVALIAÇÃO PSICOSSOCIAL</td>                    
                            </tr>
                            <tr>
                                <td class="text-center"><input type="date" id="comp_AVALIACAO_PSICOSSOCIAL" name="comp_AVALIACAO_PSICOSSOCIAL"><br><br>
                                    <label>Exame: </label>
                                    <select class="form-inline" id="status_AVALIACAO_PSICOSSOCIAL" name="status_AVALIACAO_PSICOSSOCIAL" required>
                                        <option selected value="na">
                                            Selecione...
                                        </option>
                                        <?php
                                        $sql20 = "select id, complementar from wal_complementares_normal_alterado where status in (1) order by complementar asc";
                                        foreach ($pdo->query($sql20) as $value) {
                                            echo '<option value="' . $value['id'] . '">' . $value['complementar'] . '</option>';
                                        }
                                        Database::disconnect();
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">Erro Identificação</td>
                                <td class="text-center">Erro Riscos</td>
                                <td class="text-center">Erro Data do ASO</td>
                            </tr>
                            <tr>
                                <td class="vcenter"><input type="checkbox" id="erro_identificacao" name="erro_identificacao"></td>
                                <td class="vcenter"><input type="checkbox" id="erro_riscos" name="erro_riscos"></td>
                                <td class="vcenter"><input type="checkbox" id="erro_data_ASO" name="erro_data_ASO"></td>
                            </tr>
                            <tr>
                                <td class="text-center">Erro Data Exames</td>
                                <td class="text-center">Erro Assinatura Ativo</td>
                                <td class="text-center">Erro Assinatura Médico</td>
                            </tr>
                            <tr>
                                <td class="vcenter"><input type="checkbox" id="erro_data_exames" name="erro_data_exames"></td>
                                <td class="vcenter"><input type="checkbox" id="erro_assinatura_ativo" name="erro_assinatura_ativo"></td>
                                <td class="vcenter"><input type="checkbox" id="erro_assinatura_medico" name="erro_assinatura_medico"></td>
                            </tr>
                            <tr>
                                <td class="text-center">Erro Carimbo</td>                                
                            </tr>
                            <tr>
                                <td class="vcenter"><input type="checkbox" id="erro_data_exames" name="erro_data_exames"></td>                                
                            </tr>
                            <tr>
                                <td class="text-center">Erro Rasuras</td>
                                <td class="text-center">Erro Falta de APTO</td>
                                <td class="text-center">Erro Falta Habilitado</td>
                            </tr>
                            <tr>
                                <td class="vcenter"><input type="checkbox" id="erro_rasuras" name="erro_rasuras"></td>
                                <td class="vcenter"><input type="checkbox" id="erro_falta_apto" name="erro_falta_apto"></td>
                                <td class="vcenter"><input type="checkbox" id="erro_falta_habilitado" name="erro_falta_habilitado"></td>
                            </tr>
                            <tr>
                                <td class="text-center">Erro Telefone</td>
                                <td class="text-center">Erro Médico Coordenador</td>                                
                                <td class="text-center">Erro Carimbo</td>                                
                            </tr>
                            <tr>
                                <td class="vcenter"><input type="checkbox" id="erro_tel" name="erro_tel"></td>
                                <td class="vcenter"><input type="checkbox" id="erro_coord" name="erro_coord"></td>                                
                                <td class="vcenter"><input type="checkbox" id="erro_carimbo" name="erro_carimbo"></td>                                
                            </tr>
                        </table>
                        <div class="form-inline" id="complementar_error"></div>
                    </div>
                    <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Salvar Ativo Walmart <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
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