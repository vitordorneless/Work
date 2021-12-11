<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax nÃ£o funciona-->
<script>
    $(document).ready(function () {

        $('#lojas').change(function () {
            $('#prestador').load('../Controller/combo_prestador_lojas.php?lojas=' + $('#lojas').val());
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            $("#conteudo_lateral").empty();
            $("#conteudo_superior").empty();            
            envia_form();
        });
        function envia_form() {
            $("#conteudo_periodico").empty();
            var prestador = $("#prestador").val();

            if ($("#prestador").val() === '')
            {
                $("#error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(4000),
                        $("#prestador").focus();
                return false;
            } else {
                $("#prestador_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/procurar_prestador.php",
                data: "prestador=" + prestador,
                beforeSend: function () {
                    $("#conteudo_periodico").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_periodico").html(response);
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
        <h2><strong>Listar Prestadores</strong><acronym title="Informe os campos para otimizar o resultado!!!"> Walmart</acronym></h2>
        <div class="additional-btn">            
            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>            
        </div>
    </div>
    <div class="widget-content padding">
        <div class="form-inline">
            <form id="form" method="POST">
                <div class="form-group">
                    <label for="label_uf">Lojas:</label>
                    <select class="form-control" id="lojas" name="lojas" required>
                        <option selected value="na">
                            Selecione...
                        </option>
                        <?php
                        include '../config/database_mysql.php';
                        $lojas = array();
                        $pdo = Database::connect();
                        $sql1 = "select id_prestador, lojas_negociadas from prospeccao_medicos order by id_prestador asc";
                        //echo '<option value="' . $value['id_prestador'] . '">' . utf8_encode() . '</option>';
                        foreach ($pdo->query($sql1) as $value) { 
                            if($value['lojas_negociadas'] !== 'VER'){
                            $pega_lojas = explode(',', $value['lojas_negociadas']);
                            array_push($lojas, $pega_lojas);
                            unset($pega_lojas);
                            }  else {
                                array_push($lojas, $value['lojas_negociadas']);
                            }                            
                        }
                        Database::disconnect();
                        ?>
                    </select>
                    <div class="form-inline" id="tipo_prestador_error"></div>
                </div>
                <div class="form-group">
                    <label>Prestador:</label>
                    <select class="form-control" id="prestador" name="prestador" required autofocus="autofocus">
                        <option selected value="na">
                            Aguardando...
                        </option>                        
                    </select>
                    <div class="form-inline" id="prestador_error"></div>
                </div>                
                <div class="form-group">
                    <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Gerar<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
                </div>            
            </form>
        </div>
    </div>        
</div>
<div class="panel panel-footer" id="conteudo_periodico"></div>