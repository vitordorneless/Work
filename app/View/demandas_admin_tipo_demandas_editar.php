<?php
include '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$querie = new Queries();
$pdo = Database::connect();
$evento = new Demandas_Tipos();
$usuarios = new Usuarios();
$array = $evento->Dados_Demandas(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_usuario = $usuarios->Dados_User($array['user_executante']);
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_cassi_solicitante").load('demandas_admin_tipo_demandas_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_cassi_solicitante").load('demandas_admin_tipo_demandas_listar.php');
            }
        });        
        
        var id_demand_setor = '<?php echo $array['id_setor']; ?>';
        $('#setor').load('../Controller/combo_responsavel_tipo_demanda_setor_selected.php?setor=' + id_demand_setor);        
        
        $('#setor').before(function () {
            $('#user_executante').load('../Controller/combo_responsavel_tipo_demanda.php?setor=' + id_demand_setor);
        });
        
        $('#setor').change(function () {
            $('#user_executante').load('../Controller/combo_responsavel_tipo_demanda.php?setor=' + $('#setor').val());
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var nome = $("#nome").val();
            var id = $("#id").val();
            var status = $("#status").val();
            var sla = $("#sla").val();
            var setor = $("#setor").val();
            var user_executante = $("#user_executante").val();

            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }

            if ($("#sla").val() === 'na')
            {
                $("#sla_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#sla").focus();
                return false;
            } else {
                $("#sla_error").empty();
            }

            if ($("#setor").val() === 'na')
            {
                $("#setor_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#setor").focus();
                return false;
            } else {
                $("#setor_error").empty();
            }
            
            if ($("#user_executante").val() === 'na')
            {
                user_executante = '<?php echo $array_usuario['id']; ?>';
            } 

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/demandas_admin_tipo_demandas_editar.php",
                data: "nome=" + nome + "&sla=" + sla + "&setor=" + setor + "&id=" + id + "&status=" + status + "&user_executante=" + user_executante,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                            $("#form")[0].reset(),
                            $("#refresca_cassi_solicitante").load('demandas_admin_tipo_demandas_listar.php');
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
    <h4 class="modal-title">Editar Tipos de Demandas</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_nome">Nome da Demanda:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome da Demanda..." value="<?php echo $array['tipo_demanda']; ?>" autofocus>
            <input type="hidden" id="id" name="id" value="<?php echo $array['id']; ?>">
            <div class="form-inline" id="nome_error"></div>
        </div>
        <div class="form-group">
            <label for="agencia_label">SLA:</label>
            <select class="form-control" id="sla" name="sla">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                foreach ($pdo->query($querie->demanda_admin_listar_prazos_sla()) as $value) {
                    $option = $value['id'] == $array['sla'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . $value['prazo'] . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="sla_error"></div>
        </div>
        <div class="form-group">
            <label for="agencia_label">Setor Pertecente:</label>
            <select class="form-control" id="setor" name="setor">
                <option selected value="na">
                    Selecione...
                </option>
            </select>
            <div class="form-inline" id="setor_error"></div>            
        </div>
        <div class="form-group">
            <label for="agencia_label">Executante Atual:</label>
            <input class="form-control" disabled="disabled" value="<?php echo $array_usuario['nome_extenso']; ?>">
        </div>
        <div class="form-group">
            <label for="agencia_label">Novo Executante:</label>
            <select class="form-control" id="user_executante" name="user_executante">
                <option value="na">
                    Aguardando...
                </option>                
            </select>
            <div class="form-inline" id="setor_error"></div>            
        </div>
        <div class="form-group">
            <label for="label_status_medico">Status:</label>
            <select class="form-control" id="status" name="status">
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
            <?php Database::disconnect();?>
        </div>        
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Salvar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>