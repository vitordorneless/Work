<?php
include '../config/database_mysql.php';
$pdo = Database::connect();
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$ativos = new Wal_Ativos();
$caixa = new Wal_Caixa();
$examinador = new Usuarios();
$coordenador = new Medicos();
$ativos->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_ativo = $ativos->Dados_Wal_Ativos_id($ativos->get_id());
$departamento = $ativos->Dados_Wal_depto($array_ativo['cod_depto']);
$cargo = $ativos->Dados_Wal_cargo($array_ativo['cod_cargo']);
$empresa = $ativos->Dados_Wal_Empresa($array_ativo['cod_empresa']);
$loja = $ativos->Dados_Wal_Loja($array_ativo['cod_estabelecimento']);
$caixinha = $caixa->Dados_Caixa($array_ativo['id_box']);
$medico = $examinador->Dados_User($array_ativo['id_medico']);
$pcmso_coordenador = $coordenador->Dados_Medicos_Coordenadores($array_ativo['id_medico_coordenador']);
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {
        
        var id_loja = '<?php echo $array_ativo['cod_estabelecimento']; ?>';        
        $('#estabelecimento').load('../Controller/combo_estabelecimento_selected.php?empresa=' + $('#empresa').val() + "&id_loja=" + id_loja);

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

            $("#conteudo_cassi").empty();
            var setor = $("#setor").val();
            var cargo = $("#cargo").val();
            var id = $("#id").val();
            var id_medico = $("#id_medico").val();
            var id_medico_coordenador = $("#id_medico_coordenador").val();
            var caixa = $("#caixa").val();
            var empresa = $("#empresa").val();
            var estabelecimento = $("#estabelecimento").val();
            var nome = $("#nome").val();
            var flg_periodico = $("#flg_periodico").val();
            
            if ($("#empresa").val() === 'na')
            {
                $("#empresa_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Empresa...</div>"),
                        $("#empresa").focus();
                return false;
            } else {
                $("#empresa_error").empty();
            }

            if ($("#estabelecimento").val() === '0')
            {
                $("#estabelecimento_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Estabelecimento...</div>"),
                        $("#estabelecimento").focus();
                return false;
            } else {
                $("#estabelecimento_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/troca_setor_wal_editar_execute_form.php",
                data: "id=" + id + "&setor=" + setor + "&cargo=" + cargo + "&empresa=" + empresa + "&estabelecimento=" + estabelecimento + 
                        "&nome=" + nome + "&flg_periodico=" + flg_periodico + "&id_medico=" + id_medico + "&id_medico_coordenador=" + id_medico_coordenador + 
                        "&caixa=" + caixa,
                beforeSend: function () {
                    $("#conteudo_cassi").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_cassi").html(response),
                            $("#form")[0].reset();
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">    
    <h4 class="modal-title">Situação do Funcionário <?php echo $array_ativo['nome_funcionario']; ?></h4>
</div>			
<div class="modal-body">
    <form id="form" class="form-group" method="POST">
        <div class="form-group">
            <div class="form-group block">
                <label for="empresa_label">Nome:</label>
                <input type="text" class="form-control" value="<?php echo $array_ativo['nome_funcionario']; ?>" id="nome" name="nome">
            </div>
            <div class="form-group block">
                <label for="empresa_label">De Empresa:</label>
                <input type="text" class="form-control" value="<?php echo $empresa['desc_empresa'] ?>" readonly>
            </div>
            <div class="form-group block">
                <label for="estabelecimento_label">De Estabelecimento:</label>
                <input type="text" class="form-control" value="<?php echo $loja['desc_estabelecimento'] ?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label for="empresa_label">Para Empresa:</label>
                <select class="form-control" id="empresa" name="empresa">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php                    
                    $sqlpesimm = "SELECT cod_empresa, concat(cod_empresa,' - ',desc_empresa) as desc_empresas FROM wal_empresa ORDER BY desc_empresa ASC";
                    foreach ($pdo->query($sqlpesimm) as $value) {
                        $option = $value['cod_empresa'] == $array_ativo['cod_empresa'] ? 'value="' . $value['cod_empresa'] . '" selected' : 'value="' . $value['cod_empresa'] . '"';
                        echo '<option ' . $option . '>' . $value['desc_empresas'] . '</option>';
                    }                    
                    ?>
                </select>
                <div class="form-inline" id="empresa_error"></div>
            </div>
            <div class="form-group">
                <label for="estabelecimento_label">Para Estabelecimento:</label>
                <select class="form-control" id="estabelecimento" name="estabelecimento" required>
                    <option selected value="na">
                        Aguardando...
                    </option>
                </select>
                <div class="form-inline" id="estabelecimento_error"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>de Setor Atual:</label>
                <input type="text" class="form-control" value="<?php echo $departamento['desc_depto'] ?>" readonly>
                <input type="hidden" id="id" name="id" value="<?php echo $array_ativo['id'] ?>">
                <label>Para:</label>
                <select class="form-control" id="setor" name="setor">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql99 = "select desc_depto as desc_depto, cod_depto from wal_departamento order by desc_depto asc";
                    foreach ($pdo->query($sql99) as $value) {
                        $option = $value['cod_depto'] == $array_ativo['cod_depto'] ? 'value="'.$value['cod_depto'].'" selected' : 'value="'.$value['cod_depto'].'"';
                        echo '<option '.$option.'>' . $value['desc_depto'] . '</option>';                        
                    }
                    ?>
                </select>
                <div class="form-inline" id="setor_error"></div>
            </div>
        </div>
        <div class="form-group">
            <label>de Cargo Atual:</label>
                <input type="text" class="form-control" value="<?php echo $cargo['desc_cargo'] ?>" readonly>
                <label>Para:</label>
            <select class="form-control" id="cargo" name="cargo">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql199 = "select cod_cargo, desc_cargo from wal_cargo order by desc_cargo asc";
                foreach ($pdo->query($sql199) as $value) {
                    $option = $value['cod_cargo'] == $array_ativo['cod_cargo'] ? 'value="'.$value['cod_cargo'].'" selected' : 'value="'.$value['cod_cargo'].'"';
                        echo '<option '.$option.'>' . $value['desc_cargo'] . '</option>';                    
                }
                ?>
            </select>
            <div class="form-inline" id="cargo_error"></div>
        </div>
        <div class="form-group">
            <label>de Caixa:</label>
                <input type="text" class="form-control" value="<?php echo $caixinha['etiqueta'] ?>" readonly>
                <label>Para:</label>
            <select class="form-control" id="caixa" name="caixa">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql1999 = "select id, etiqueta from wal_caixa order by etiqueta asc";
                foreach ($pdo->query($sql1999) as $value) {
                    $option = $value['id'] == $array_ativo['id_box'] ? 'value="'.$value['id'].'" selected' : 'value="'.$value['id'].'"';
                        echo '<option '.$option.'>' . $value['etiqueta'] . '</option>';                    
                }
                ?>
            </select>
            <div class="form-inline" id="cargo_error"></div>
        </div>
        <div class="form-group">
            <label>de Médico Examinador:</label>
                <input type="text" class="form-control" value="<?php echo $medico['nome_extenso'] ?>" readonly>
                <label>Para:</label>
            <select class="form-control" id="id_medico" name="id_medico">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql199999 = "select id, nome_extenso from usuarios where setor in (28) order by nome_extenso asc";
                foreach ($pdo->query($sql199999) as $value) {
                    $option = $value['id'] == $array_ativo['id_medico'] ? 'value="'.$value['id'].'" selected' : 'value="'.$value['id'].'"';
                        echo '<option '.$option.'>' . $value['nome_extenso'] . '</option>';                    
                }
                ?>
            </select>
            <div class="form-inline" id="cargo_error"></div>
        </div>
        <div class="form-group">
            <label>de Médico Coordenador:</label>
                <input type="text" class="form-control" value="<?php echo $pcmso_coordenador['nome'] ?>" readonly>
                <label>Para:</label>
            <select class="form-control" id="id_medico_coordenador" name="id_medico_coordenador">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql19999 = "select id, nome from pcmso_coordenadores order by nome asc";
                foreach ($pdo->query($sql19999) as $value) {
                    $option = $value['id'] == $array_ativo['id_medico_coordenador'] ? 'value="'.$value['id'].'" selected' : 'value="'.$value['id'].'"';
                        echo '<option '.$option.'>' . utf8_encode($value['nome']) . '</option>';                    
                }
                ?>
            </select>
            <div class="form-inline" id="cargo_error"></div>
        </div>
        <div class="form-group">
            <label for="label_status">Periódico:</label>
            <select class="form-control" id="flg_periodico" name="flg_periodico" required>
                <?php
                $seleciona1 = $array_ativo['flg_periodico'] == '1' ? "selected" : " ";
                $seleciona2 = $array_ativo['flg_periodico'] == '0' ? "selected" : " ";
                ?>
                <option value="1" <?php echo $seleciona1; ?>>
                    Ativo
                </option>
                <option value="0" <?php echo $seleciona2; ?>>
                    Inativo
                </option>                
            </select>
            <div class="form-inline" id="flg_periodico_error"></div>
        </div>
        <?php Database::disconnect(); ?>
        <button class="btn btn-primary btn-foursquare" id="envia" type="submit">Salvar Informações deste Funcionário <span class="glyphicon glyphicon-saved" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_cassi"></div>
</div>