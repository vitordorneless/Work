<?php
$timestamp = time();
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script src="../../tools/Uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../tools/Uploadify/uploadify.css">
<script>
    $(document).ready(function () {

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }

        $(function () {
            $('#fotos').uploadify({
                'formData': {
                    'timestamp': '<?php echo $timestamp; ?>',
                    'token': '<?php echo md5('unique_salt' . $timestamp); ?>',
                    'method': 'post',
                    'buttonText': 'Anexar Arquivos',
                    'fileSizeLimit': 200
                },
                'swf': '../../tools/Uploadify/uploadify.swf',
                'uploader': '../../tools/Uploadify/uploadify_1.php'
            });
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_usuario").empty();
            var nome_extenso = $("#nome_extenso").val();
            var setor = $("#setor").val();
            var login = $("#login").val();
            var pass = $("#pass").val();
            var foto = $("#foto").val();            
            var crm = $("#crm").val();
            var email = $("#email").val();            
            var admin = $("#admin").val();
            var estado_crm = $("#estado_crm").val();

            if ($("#nome_extenso").val() === '')
            {
                $("#nome_extenso_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome por Extenso<br>Exemplo: Ikki de Fênix...</div>"),
                $("#nome_extenso").focus();
                return false;
            }
            
            if ($("#setor").val() === 'na')
            {
                $("#setor_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Setor...</div>"),
                $("#setor").focus();
                return false;
            }
            
            if ($("#login").val() === '')
            {
                $("#login_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Login<br>Exemplo:ikki.fenix...</div>"),
                $("#login").focus();
                return false;
            }
            
            if ($("#pass").val() === '')
            {
                $("#pass_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe Senha...</div>"),
                $("#pass").focus();
                return false;
            }

            if ($("#pass").val().length < 5)
            {
                $("#pass_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe senha Maior, essa é fraquinha...</div>"),
                $("#pass").focus();
                return false;
            }
            
            if ($("#foto").val() === '')
            {
                $("#foto_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Nome da Foto com a extensão!!!!<br>Exemplo:ikki_fenix.jpg</div>"),
                $("#foto").focus();
                return false;
            }

            if (!validateEmail($("#email").val())) {
                $("#email_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Email corretamente...</div>"),
                $("#email").focus();
                return false;
            }
            
            if ($("#admin").val() === 'na')
            {
                $("#admin_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe se o Usuário será Admin ou não...</div>"),
                $("#admin").focus();
                return false;
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/usuarios_adicionar.php",
                data: "nome_extenso=" + nome_extenso + "&setor=" + setor + "&login=" + login + 
                        "&pass=" + pass + "&foto=" + foto + "&email=" + email + "&admin=" + admin + "&crm=" + crm + "&estado_crm=" + estado_crm,
                beforeSend: function () {
                    $("#conteudo_usuario").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_usuario").html(response),
                            $("#form")[0].reset();
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
            <h2><strong>Adicionar</strong> Usuário</h2>
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
                        <label for="label_nome_extenso">Nome do Usuário:</label>
                        <input type="text" class="form-control" id="nome_extenso" name="nome_extenso" placeholder="Nome por Extenso" autofocus>
                        <div class="form-inline" id="nome_extenso_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="setor_label">Setor:</label>
                        <select class="form-control selectpicker" id="setor" name="setor" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php
                            include '../config/database_mysql.php';
                            $pdo = Database::connect();
                            $sql1 = "select id, setor from usuarios_setores where status = 1 order by setor";
                            foreach ($pdo->query($sql1) as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['setor'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="setor_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_nome_extenso">CRM:</label>
                        <input type="text" class="form-control" id="crm" name="crm" value="0">                        
                    </div>
                    <div class="form-group">
                        <label for="label_nome_extenso">Estado CRM:</label>
                        <input type="text" class="form-control" id="estado_crm" name="estado_crm" value="informe">                        
                    </div>
                    <div class="form-group">
                        <label for="label_login">Login:</label>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Login">
                        <div class="form-inline" id="login_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="pass_login">Senha:</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="********">
                        <div class="form-inline" id="pass_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_foto">Foto:</label>
                        <input class="form-control" id="foto" name="foto" type="text" placeholder="Informe o nome da foto com extensão" /><br>
                        <input class="form-control" id="fotos" name="fotos" type="file" />
                        <div class="form-inline" id="foto_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="label_email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                        <div class="form-inline" id="email_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="admin_label">Admin:</label>
                        <select class="form-control selectpicker" id="admin" name="admin" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <option value="1">
                                Sim
                            </option>
                            <option value="0">
                                Não
                            </option>
                        </select>
                        <div class="form-inline" id="admin_error"></div>
                    </div>
                    <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Gravar Usuário</button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_usuario"></div>
        </div>        
    </div>
</div>