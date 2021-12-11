<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_herval_solicitante").load('herval_sint_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_herval_solicitante").load('herval_sint_listar.php');
            }
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var id_empresa = $("#id_empresa").val();
            var id_unidade = $("#id_unidade").val();
            var cnpj = $("#cnpj").val();
            var ins_est = $("#ins_est").val();
            var cnae = $("#cnae").val();
            var grau_de_risco = $("#grau_de_risco").val();
            var ende = $("#ende").val();
            var media_emp = $("#media_emp").val();
            var ativ_reali = $("#ativ_reali").val();
            var local_ativ_reali = $("#local_ativ_reali").val();


            if ($("#id_empresa").val() === 'na')
            {
                $("#id_empresa_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>Ã—</button>Informe a Empresa...</div>").hide(9000),
                        $("#id_empresa").focus();
                return false;
            } else {
                $("#id_empresa_error").empty();
            }

            if ($("#id_unidade").val() === 'na')
            {
                $("#id_unidade_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>Ã—</button>Informe a Loja...</div>").hide(9000),
                        $("#id_unidade").focus();
                return false;
            } else {
                $("#id_unidade_error").empty();
            }

            if ($("#cnpj").val() === '')
            {
                $("#cnpj_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>Ã—</button>Informe o CNPJ...</div>").hide(9000),
                        $("#cnpj").focus();
                return false;
            } else {
                $("#cnpj_error").empty();
            }

            if ($("#ins_est").val() === '')
            {
                ins_est = 'não informado';
            }

            if ($("#cnae").val() === '')
            {
                cnae = 'não informado';
            }

            if ($("#grau_de_risco").val() === '')
            {
                grau_de_risco = 'não informado';
            }

            if ($("#ende").val() === '')
            {
                $("#ende_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>Ã—</button>Informe o Endereço...</div>").hide(9000),
                        $("#ende").focus();
                return false;
            } else {
                $("#ende_error").empty();
            }

            if ($("#media_emp").val() === '')
            {
                media_emp = 0;
            }

            if ($("#ativ_reali").val() === '')
            {
                ativ_reali = 'não informado';
            }

            if ($("#local_ativ_reali").val() === '')
            {
                local_ativ_reali = 'não informado';
            }


            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/herval_sint_incluir_cab.php",
                data: "id_unidade=" + id_unidade + "&cnpj=" + cnpj + "&ins_est=" + ins_est + "&cnae=" + cnae + "&grau_de_risco=" + grau_de_risco +
                        "&ende=" + ende + "&media_emp=" + media_emp + "&ativ_reali=" + ativ_reali + "&local_ativ_reali=" + local_ativ_reali + 
                        "&id_empresa=" + id_empresa,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                    $("#form")[0].reset(),
                    $("#refresca_herval_solicitante").load('herval_sint_listar.php');
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
    <h4 class="modal-title">Inserir Cabeçalho de Síntese</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="agencia_label">Empresa:</label>
            <select class="form-control" id="id_empresa" name="id_empresa">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                include '../config/database_mysql.php';
                $pdo = Database::connect();
                $sql1 = "select id, empresa from herval_empresas where status = 1 order by empresa asc";
                foreach ($pdo->query($sql1) as $value) {
                    echo '<option value=' . $value['id'] . '>' . $value['empresa'] . '</option>';
                }                
                ?>
            </select>
            <div class="form-inline" id="id_empresa_error"></div>
        </div>
        <div class="form-group">
            <label for="agencia_label">Loja / Bandeira:</label>
            <select class="form-control" id="id_unidade" name="id_unidade" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php                
                $sql = "select id, unidade from herval_unidades where status = 1 order by unidade asc";
                foreach ($pdo->query($sql) as $value) {
                    echo '<option value=' . $value['id'] . '>' . $value['unidade'] . '</option>';
                }
                Database::disconnect();
                ?>
            </select>
            <div class="form-inline" id="id_unidade_error"></div>
        </div>
        <div class="form-group">
            <label for="label_peg">CNPJ:</label>            
            <input type="text" class="form-control" id="cnpj" name="cnpj">            
            <div class="form-inline" id="cnpj_error"></div>
        </div>
        <div class="form-group">
            <label for="label_peg">Inscrição Estadual:</label>            
            <input type="text" class="form-control" id="ins_est" name="ins_est">            
            <div class="form-inline" id="ins_est_error"></div>
        </div>
        <div class="form-group">
            <label for="label_guias_anexas">CNAE:</label>            
            <input type="text" class="form-control" id="cnae" name="cnae">            
            <div class="form-inline" id="cnae_error"></div>
        </div>        
        <div class="form-group">
            <label for="label_data">Grau de Risco:</label>            
            <input type="text" class="form-control" id="grau_de_risco" name="grau_de_risco">            
            <div class="form-inline" id="grau_de_risco_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data">Endereço:</label>            
            <input type="text" class="form-control" id="ende" name="ende">            
            <div class="form-inline" id="ende_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data">Média de Empregados:</label>            
            <input type="text" class="form-control" id="media_emp" name="media_emp">            
            <div class="form-inline" id="media_emp_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data">Atividades Realizadas:</label>            
            <input type="text" class="form-control" id="ativ_reali" name="ativ_reali">            
            <div class="form-inline" id="ativ_reali_error"></div>
        </div>
        <div class="form-group">
            <label for="label_data">Local das Atividades Realizadas:</label>            
            <input type="text" class="form-control" id="local_ativ_reali" name="local_ativ_reali">            
            <div class="form-inline" id="local_ativ_reali_error"></div>
        </div>
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Gravar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>