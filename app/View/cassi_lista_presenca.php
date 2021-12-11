<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#carrega").click(function () {                      
            $('#agencia').load('../Controller/combo_agencia_cassi_via_id_medico.php?cpf=' + $('#cpf').val());
        });
        
        $("#imprimir_lista_de_presenca").click(function () {                      
            envia_lista();
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var agencia = $("#agencia").val();
            var cpf = $("#cpf").val();

            if ($("#cpf").val() === '')
            {
                $("#cpf_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe CPF apenas com números, depois clique em Carregar Agências...</div>"),
                        $("#cpf").focus();
                return false;
            } else {
                $("#cpf_error").empty();
            }
            
            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/cassi_lista_presenca.php",
                data: "agencia=" + agencia + "&cpf=" + cpf,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response);
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
        
        function envia_lista() {
            $("#conteudo_CASSI").empty();
            var agencias = $("#agencia").val();
            var cpfs = $("#cpf").val();

            if ($("#cpf").val() === '')
            {
                $("#cpf_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe CPF apenas com números, depois clique em Carregar Agências...</div>"),
                        $("#cpf").focus();
                return false;
            } else {
                $("#cpf_error").empty();
            }
            
            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/cassi_lista_presenca_imprimir.php",
                data: "agencia=" + agencias + "&cpf=" + cpfs,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response);
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<style type="text/css">
    #imgpos {
        position:absolute;
        left:667px;
    }
</style>
<div class="widget">
    <div class="widget-header transparent">
        <h2><strong>Lista de</strong><acronym title="Informe os campos para otimizar o resultado!!!"> Presença</acronym></h2>
        <div class="additional-btn">            
            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>            
        </div>
    </div>
    <div class="widget-content padding">
        <div class="form-group">
            <form id="form" method="POST">
                <div class="form-group">
                    <div class="form-group">
                        <label for="label_cpf">CPF:</label>
                        <div class="input-group">                            
                            <input type="text" class="form-control" id="cpf" name="cpf" autofocus>                            
                        </div>
                        <div class="form-inline" id="cpf_error"></div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-small btn-danger" id="carrega">Carregar Agências <span class="glyphicon glyphicon-export" aria-hidden="true"></span></button>
                    </div>
                    <label for="empresa_label">Selecione Agência que realizou Exames:</label>
                    <select class="form-control" id="agencia" name="agencia" required>
                        <option selected value="na">
                            Aguardando...
                        </option>
                    </select>                    
                </div>                    
                <button class="btn btn-primary btn-facebook" id="envia" type="submit">Visualizar Lista de Presença <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>&nbsp;&nbsp;
                <button class="btn btn-primary btn-dropbox" id="imprimir_lista_de_presenca">Imprimir Lista de Presença <span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
            </form>
        </div>
    </div>
    <div class="widget-content padding" id="conteudo_CASSI"></div>
</div>    