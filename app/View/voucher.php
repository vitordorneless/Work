<?php
$voucher = filter_input(INPUT_GET, 'voucher', FILTER_SANITIZE_STRING);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Periódicos 2015 - GRUPO AMA Gestão</title>   
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />        
        <meta name="description" content="Herval Voucher">
        <meta name="keywords" content="AMA, TI-AMA, grupo Ama Gestão">
        <meta name="author" content="Grupo TI - AMA">
        <link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="shortcut icon" href="../../corporate/assets/img/favicon.ico">        
        <script src="../../css/bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/JQuery/jquery-1.11.1.min.js"></script>        
        <script>
            $(document).ready(function () {

                $(function () {

                    $('#show').on('click', function () {
                        $('.card-reveal').slideToggle('slow');
                    });

                    $('.card-reveal .close').on('click', function () {
                        $('.card-reveal').slideToggle('slow');
                    });
                });

                $("#form").submit(function () {
                    return false;
                });
                $("#envia").click(function () {
                    envia_form();
                });
                function envia_form() {
                    $("#conteudo_CASSI").empty();
                    var voucher = $("#voucher").val();

                    if ($("#voucher").val() === '')
                    {
                        $("#voucher_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Voucher...</div>").hide(7200),
                                $("#voucher").focus();
                        return false;
                    } else {
                        $("#voucher_error").empty();
                    }

                    $.ajax({
                        type: "POST",
                        dataType: "HTML",
                        url: "../Controller/voucher.php",
                        data: "voucher=" + voucher,
                        beforeSend: function () {
                            $("#tudinho").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                        },
                        success: function (response) {
                            $("#tudinho").empty(),
                                    $("#tudinho").html(response),
                                    $("#tudinho").load('../Controller/voucher.php');
                        },
                        error: function () {
                            alert("Ocorreu um erro durante a requisição");
                        }
                    });
                }
            });
        </script>
    </head>
    <body>        
        <div class="container" id="tudinho">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="card">
                        <div class="card-image">
                            <img class="img-responsive" src="../../images/logo/logo-amagestao.png">                    
                        </div>
                    </div>
                    <br><br><br>
                    <div class="col-md-6 col-md-offset-3">
                        <h2>Informe seu Voucher</h2>
                        <form id="form" method="POST">
                            <div id="custom-search-input">                            
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control input-lg" id="voucher" name="voucher" placeholder="Voucher" value="<?php echo $voucher; ?>" autofocus/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-info btn-lg" type="submit" id="envia">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </span>                                    
                                </div>                            
                            </div>        
                        </form>
                        <div class="form-inline" id="voucher_error"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>