<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_cassi_solicitante").load('pcmso_coord_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_cassi_solicitante").load('pcmso_coord_listar.php');
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
            var nome = $("#nome").val();
            var cargo = $("#cargo").val();
            var conselho = $("#conselho").val();
            var crm = $("#crm").val();

            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }
            
            if ($("#cargo").val() === '')
            {
                $("#cargo_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                $("#cargo").focus();
                return false;
            } else {
                $("#cargo_error").empty();
            }
            
        if ($("#conselho").val() === '')
            {
                $("#conselho_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                $("#conselho").focus();
                return false;
            } else {
                $("#conselho_error").empty();
            }
            
            if ($("#conselho").val() === '')
            {
                $("#conselho_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                $("#conselho").focus();
                return false;
            } else {
                $("#conselho_error").empty();
            }
            
            if ($("#crm").val() === '')
            {
                $("#crm_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                $("#crm").focus();
                return false;
            } else {
                $("#crm_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/pcmso_coord_incluir.php",
                data: "nome=" + nome + "&cargo=" + cargo + "&conselho=" + conselho + "&crm=" + crm,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                            $("#form")[0].reset(),
                            $("#refresca_cassi_solicitante").load('pcmso_coord_listar.php');
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
    <h4 class="modal-title">Incluir Médico Coordenador PCMSO</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_nome">Nome:</label>            
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o Nome..." autofocus>            
            <div class="form-inline" id="nome_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Cargo:</label>            
            <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Informe o Cargo...">            
            <div class="form-inline" id="cargo_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Conselho:</label>            
            <input type="text" class="form-control" id="conselho" name="conselho" placeholder="Informe o Conselho...">            
            <div class="form-inline" id="conselho_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">CRM:</label>            
            <input type="text" class="form-control" id="crm" name="crm" placeholder="Informe o CRM (apenas números)...">            
            <div class="form-inline" id="crm_error"></div>
        </div>
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Adicionar Médico Coordenador PCMSO <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>