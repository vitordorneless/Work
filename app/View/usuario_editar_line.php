<?php
include '../config/database_mysql.php';
require '../Model/Usuario.php';
require '../Model/Usuarios.php';
$user = new Usuarios();
$user->set_id(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_user = $user->Dados_User($user->get_id());
?>
<style type="text/css">
    #imgpos {
        position:absolute;
        left:367px;
    }
</style>
<script>
    $(document).ready(function () {
        
         function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test( $email );
            }

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo").empty();
            var nome = $("#nome").val();
            var nome_extenso = $("#nome_extenso").val();
            var senha = $("#senha").val();
            var email = $("#email").val();
            var admin = $("#admin").val();
            var setor = $("#setor").val();
            var status = $("#status").val();
            var id = $("#id").val();
            
            if( !validateEmail($("#email").val())){
                alert("Preencha o email corretamente do Usuário!!");
                $("#email").focus();
                return false;
            }
            
            if ($("#nome").val() === '')
            {
                alert("Preencha o nome do Usuário!!");
                $("#nome").focus();
                return false;
            }
            
            if ($("#nome_extenso").val() === '')
            {
                alert("Preencha o nome do Usuário!!");
                $("#nome_extenso").focus();
                return false;
            }

            if ($("#email").val() === '')
            {
                alert("Preencha o email!!");
                $("#email").focus();
                return false;
            }
            
            if ($("#setor").val() === 'na')
            {
                alert("Escolha o Setor!!");
                $("#setor").focus();
                return false;
            }
            
            if ($("#senha").val() === '')
            {
                alert("Amigo, sem senha, sem acesso ao sistema!!");
                $("#senha").focus();
                return false;
            }
            
            if ($("#senha").val().length < 5)
            {
                alert("Preencha senha com mais do que 5 caracteres!!");
                $("#senha").focus();
                return false;
            }
            
            if ($("#admin").val() === 'na')
            {
                alert("Informe se ele é administrador");
                $("#admin").focus();
                return false;
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/usuarios_editar.php",
                data: "nome=" + nome + "&senha=" + senha + "&email=" + email + "&admin=" + admin + "&status=" + status + "&id=" + id + "&nome_extenso=" + nome_extenso + "&setor=" + setor,
                beforeSend: function () {
                    $("#conteudo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo").html(response),
                            $("#refresca").load('usuarios_editar.php');
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<h4>Editar <acronym title="Informe os campos corretamente!!!"><strong>Demandas</strong></acronym></h4>
<div class="modal-body well">
    <div class="row">
        <form id="form" method="POST">
            <fieldset>
                <div class="form-group">
                    <label>Nome do Usuário: </label>
                    <input class="form-control" name="nome_extenso" id="nome_extenso" type="text" value="<?php echo $array_user['nome_extenso']; ?>">
                    <label>Setor: </label>
                    <select class="span3" id="setor" name="setor" required>
                        <option selected value="na">
                                Selecione...
                            </option>
                        <?php
                            $pdo = Database::connect();
                            $sql = "select id, setor from setores_ama where status = 1";
                            foreach ($pdo->query($sql) as $value) {
                                $option = $value['id'] == $array_user['setor'] ? 'value="'.$value['id'].'" selected' : 'value="'.$value['id'].'"';
                                echo '<option '.$option.'>' . $value['setor'] . '</option>';
                            }                            
                            ?>
                    </select>
                </div>                
                <div class="form-group">
                    <label>Login: </label>
                    <input class="form-control" name="nome" id="nome" type="text" value="<?php echo $array_user['nome']; ?>">
                    <input class="form-control" name="id" id="id" type="hidden" value="<?php echo $array_user['id']; ?>">                    
                </div>
                <div class="form-group">
                    <label>Senha: </label>
                    <input class="form-control" name="senha" id="senha" type="password" value="<?php echo $array_user['pass']; ?>">
                </div>
                <div class="form-group">
                    <label>Email: </label>
                    <input class="form-control" name="email" id="email" type="text" value="<?php echo $array_user['email']; ?>">
                </div>
                <div class="form-group">
                    <label>Status: </label>
                    <select class="span3" id="status" name="status" required>
                        <option value="1" <?php
                        $carrega = $array_user['status'] == 1 ? 'selected' : ' ';
                        echo $carrega;
                        ?>>
                            Ativo
                        </option>
                        <option value="0" <?php
                        $carrega1 = $array_user['status'] == 0 ? 'selected' : ' ';
                        echo $carrega1;
                        ?>>
                            Inativo
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Administrador: </label>
                    <select class="span3" id="admin" name="admin" required>
                        <option value="1" <?php
                        $carrega2 = $array_user['admin'] == 1 ? 'selected' : ' ';
                        echo $carrega2;
                        ?>>
                            Sim
                        </option>
                        <option value="0" <?php
                        $carrega3 = $array_user['admin'] == 0 ? 'selected' : ' ';
                        echo $carrega3;
                        ?>>
                            Não
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    &nbsp;<button class="btn btn-success" id="envia" type="submit">Editar/Salvar Usuário <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<div class="modal-body well">
    <div id="conteudo"></div>
</div>