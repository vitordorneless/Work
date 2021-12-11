<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {
        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_convocar_loja").empty();
            var id_medico = $("#id_medico").val();            
            var file_up = $("#file_up").val();            
                        
            if ($("#id_medico").val() === 'na') {
                $("#id_medico_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(4000),
                $("#id_medico").focus();
            return false;
            } else {
                $("#id_medico_error").empty();
            }

            if ($("#file_up").val() === 'na') {
                $("#file_up_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(4000),
                $("#file_up").focus();
                return false;
                } else {
                $("#file_up_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/leitura_offline2016.php",
                data: "id_medico=" + id_medico + "&file_up=" + file_up,
                beforeSend: function () {
                    $("#conteudo_convocar_loja").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_convocar_loja").html(response);
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
            <h2 class="text-center"><strong>Executar Arquivo</strong> Offline</h2>
            <div class="additional-btn">
                <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>                
            </div>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form id="form" method="POST">
                    <div class="form-group">
                        <label for="convocacao_label">Selecione o Médico:</label>
                        <select class="form-control" id="id_medico" name="id_medico">
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            include '../config/database_mysql.php';
                            $pdo = Database::connect();
                            $sql1 = "select nome_extenso, id, crm, estado_crm from usuarios where setor in (28) order by nome_extenso asc";
                            foreach ($pdo->query($sql1) as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['nome_extenso'] . ' - '.$value['crm'].'/'.$value['estado_crm'].'</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="id_medico_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="convocacao_label">Selecione o Arquivo:</label>
                        <select class="form-control" id="file_up" name="file_up">
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php                            
                            $sql2 = "select id, nome_arquivo, nome_medico, crm from offline_uploads where status in (1) order by nome_arquivo asc";
                            foreach ($pdo->query($sql2) as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['nome_arquivo'] . ' - '.$value['nome_medico'].'/'.$value['crm'].'</option>';
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <div class="form-inline" id="file_up_error"></div>
                    </div>
                    <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Executar Arquivo <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span></button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_convocar_loja"></div>
        </div>        
    </div>
</div>