<?php
include '../config/database_mysql.php';
$pdo = Database::connect();
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_rh_func").load('rh_funcionarios_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_rh_func").load('rh_funcionarios_listar.php');
            }
        });

        $('#uf').change(function () {
            $('#cidade').load('../Controller/combo_cidade.php?estado=' + $('#uf').val());
        });

        $('#uf2').change(function () {
            $('#cidade2').load('../Controller/combo_cidade.php?estado=' + $('#uf2').val());
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_rh").empty();
            var nome = $("#nome").val();
            var id_sexo = $("#id_sexo").val();
            var matricula = $("#matricula").val();
            var nome_pai = $("#nome_pai").val();
            var nome_mae = $("#nome_mae").val();
            var nascimento = $("#nascimento").val();
            var ctps = $("#ctps").val();
            var data_ctps = $("#data_ctps").val();
            var titulo_eleitor = $("#titulo_eleitor").val();
            var identidade = $("#identidade").val();
            var org_emissor_identidade = $("#org_emissor_identidade").val();
            var emissao_identidade = $("#emissao_identidade").val();
            var cpf = $("#cpf").val();
            var pis = $("#pis").val();
            var data_cad_pis = $("#data_cad_pis").val();
            var admissao = $("#admissao").val();
            var exame_admissional = $("#exame_admissional").val();
            var exame_medico = $("#exame_medico").val();
            var nome_conselho_regional = $("#nome_conselho_regional").val();
            var id_rh_estado_civil = $("#id_rh_estado_civil").val();
            var id_rh_grau_instrucao_escolar = $("#id_rh_grau_instrucao_escolar").val();
            var id_rh_cor_pessoa = $("#id_rh_cor_pessoa").val();
            var id_rh_deficiencia_pessoa = $("#id_rh_deficiencia_pessoa").val();
            var endereco = $("#endereco").val();
            var numero = $("#numero").val();
            var complemento = $("#complemento").val();
            var uf = $("#uf").val();
            var cidade = $("#cidade").val();
            var bairro = $("#bairro").val();
            var cep = $("#cep").val();
            var id_rh_departamento = $("#id_rh_departamento").val();
            var id_rh_funcoes = $("#id_rh_funcoes").val();
            var uf2 = $("#uf2").val();
            var cidade2 = $("#cidade2").val();
            var id_rh_rateio_folha = $("#id_rh_rateio_folha").val();
            var membro_cipa = $("#membro_cipa").is(":checked") === true ? 1 : 0;
            var anotacoes_gerais = $("#anotacoes_gerais").val();
            var data_saida = $("#data_saida").val();
            var exame_demissional = $("#exame_demissional").val();
            var id_rh_vinculo = $("#id_rh_vinculo").val();
            var id_rh_empresas = $("#id_rh_empresas").val();
            var id_rh_unidades = $("#id_rh_unidades").val();

            if ($("#nome").val() === '')
            {
                $("#nome_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                $("#nome").focus();
                return false;
            } else {
                $("#nome_error").empty();
            }
            
            if ($("#id_sexo").val() === 'na') {
                $("#id_sexo_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Escolha...</div>"),
                $("#id_sexo").focus();
                return false;
            } else {
                $("#id_sexo_error").empty();
            }
            
            if ($("#matricula").val() === '')
            {
                $("#matricula_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                $("#matricula").focus();
                return false;
            } else {
                $("#matricula_error").empty();
            }
            
            if ($("#nome_pai").val() === '')
            {
                $("#nome_pai_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                $("#nome_pai").focus();
                return false;
            } else {
                $("#nome_pai_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/rh_funcionarios_incluir.php",
                data: "nome=" + nome + "&id_sexo=" + id_sexo + "&matricula=" + matricula + 
                "&nome_pai=" + nome_pai + "&nome_mae=" + nome_mae + 
                "&nascimento=" + nascimento + "&ctps=" + ctps + 
                "&data_ctps=" + data_ctps + "&titulo_eleitor=" + titulo_eleitor + "&identidade=" + identidade + 
                "&org_emissor_identidade=" + org_emissor_identidade + "&emissao_identidade=" + emissao_identidade +
                "&cpf=" + cpf + "&pis=" + pis + "&data_cad_pis=" + data_cad_pis + "&admissao=" + admissao + 
                "&exame_admissional=" + exame_admissional + "&exame_medico=" + exame_medico + "&nome_conselho_regional=" + nome_conselho_regional + 
                "&id_rh_estado_civil=" + id_rh_estado_civil + "&id_rh_grau_instrucao_escolar=" + id_rh_grau_instrucao_escolar + 
                "&id_rh_cor_pessoa=" + id_rh_cor_pessoa + "&id_rh_deficiencia_pessoa=" + id_rh_deficiencia_pessoa + "&endereco=" + endereco + 
                "&numero=" + numero + "&complemento=" + complemento + "&uf=" + uf + "&cidade=" + cidade + "&bairro=" + bairro + "&cep=" + cep + 
                "&id_rh_departamento=" + id_rh_departamento + "&id_rh_funcoes=" + id_rh_funcoes + "&uf2=" + uf2 + "&cidade2=" + cidade2 + 
                "&id_rh_rateio_folha=" + id_rh_rateio_folha + "&membro_cipa=" + membro_cipa + "&anotacoes_gerais=" + anotacoes_gerais + 
                "&data_saida=" + data_saida + "&exame_demissional=" + exame_demissional + "&id_rh_vinculo=" + id_rh_vinculo + 
                "&id_rh_empresas=" + id_rh_empresas + "&id_rh_unidades=" + id_rh_unidades,
                beforeSend: function () {
                    $("#conteudo_rh").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_rh").html(response)/*,
                            $("#form")[0].reset(),
                            $("#refresca_rh_func").load('rh_funcionarios_listar.php')*/;
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
    <h4 class="modal-title">Incluir Funcionário</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_nome">Nome:</label>            
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe..." autofocus>            
            <div class="form-inline" id="nome_error"></div>
        </div>
        <div class="form-group">
            <label for="agencia_label">Sexo:</label>
            <select class="form-control" id="id_sexo" name="id_sexo">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql3 = "select id, descricao from sexo where status = 1 order by descricao asc";
                foreach ($pdo->query($sql3) as $value) {
                    echo '<option value=' . $value['id'] . '>' . $value['descricao'] . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_sexo_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Matrícula:</label>
            <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Informe..." value="0">
            <div class="form-inline" id="matricula_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Nome do Pai:</label>
            <input type="text" class="form-control" id="nome_pai" name="nome_pai" placeholder="Informe...">
            <div class="form-inline" id="nome_pai_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Nome da Mãe:</label>
            <input type="text" class="form-control" id="nome_mae" name="nome_mae" placeholder="Informe...">
            <div class="form-inline" id="nome_mae_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Data de Nascimento:</label>
            <input type="date" class="form-control" id="nascimento" name="nascimento">
            <div class="form-inline" id="nascimento_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">CTPS:</label>
            <input type="text" class="form-control" id="ctps" name="ctps" placeholder="Informe...">
            <div class="form-inline" id="ctps_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Data CTPS:</label>
            <input type="date" class="form-control" id="data_ctps" name="data_ctps">
            <div class="form-inline" id="data_ctps_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Título de Eleitor:</label>
            <input type="text" class="form-control" id="titulo_eleitor" name="titulo_eleitor" placeholder="Informe...">
            <div class="form-inline" id="titulo_eleitor_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Identidade:</label>
            <input type="text" class="form-control" id="identidade" name="identidade" placeholder="Informe...">
            <div class="form-inline" id="identidade_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Órgão Emissor da Identidade:</label>
            <input type="text" class="form-control" id="org_emissor_identidade" name="org_emissor_identidade" placeholder="Informe...">
            <div class="form-inline" id="org_emissor_identidade_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Emissão Identidade:</label>
            <input type="date" class="form-control" id="emissao_identidade" name="emissao_identidade" placeholder="Informe...">
            <div class="form-inline" id="emissao_identidade_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Informe...">
            <div class="form-inline" id="cpf_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">PIS:</label>
            <input type="text" class="form-control" id="pis" name="pis" placeholder="Informe...">
            <div class="form-inline" id="pis_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Data de Cadastro PIS:</label>
            <input type="date" class="form-control" id="data_cad_pis" name="data_cad_pis" placeholder="Informe...">
            <div class="form-inline" id="data_cad_pis_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Admissão:</label>
            <input type="date" class="form-control" id="admissao" name="admissao" placeholder="Informe...">
            <div class="form-inline" id="admissao_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Data Exame Admissional:</label>
            <input type="date" class="form-control" id="exame_admissional" name="exame_admissional" placeholder="Informe...">
            <div class="form-inline" id="exame_admissional_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Data Exame Médico:</label>
            <input type="date" class="form-control" id="exame_medico" name="exame_medico" placeholder="Informe...">
            <div class="form-inline" id="exame_medico_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Conselho Regional:</label>
            <input type="text" class="form-control" id="nome_conselho_regional" name="nome_conselho_regional" placeholder="Informe..." value="Sem Conselho...">
            <div class="form-inline" id="nome_conselho_regional_error"></div>
        </div>
        <div class="form-group">
            <label for="agencia_label">Estado Civil:</label>
            <select class="form-control" id="id_rh_estado_civil" name="id_rh_estado_civil">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql1 = "select id, estado_civil from rh_estado_civil where status = 1 order by estado_civil asc";
                foreach ($pdo->query($sql1) as $value) {
                    echo '<option value=' . $value['id'] . '>' . $value['estado_civil'] . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_rh_estado_civil_error"></div>
        </div>
        <div class="form-group">
            <label for="agencia_label">Instrução Escolar:</label>
            <select class="form-control" id="id_rh_grau_instrucao_escolar" name="id_rh_grau_instrucao_escolar">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql2 = "select id, grau from rh_grau_instrucao_escolar where status = 1 order by grau asc";
                foreach ($pdo->query($sql2) as $value) {
                    echo '<option value=' . $value['id'] . '>' . $value['grau'] . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_rh_grau_instrucao_escolar_error"></div>
        </div>
        <div class="form-group">
            <label for="agencia_label">Cor da Pessoa:</label>
            <select class="form-control" id="id_rh_cor_pessoa" name="id_rh_cor_pessoa">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql4 = "select id, cor from rh_cor_pessoa where status = 1 order by cor asc";
                foreach ($pdo->query($sql4) as $value) {
                    echo '<option value=' . $value['id'] . '>' . $value['cor'] . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_rh_cor_pessoa_error"></div>
        </div>
        <div class="form-group">
            <label for="agencia_label">Deficiência da Pessoa:</label>
            <select class="form-control" id="id_rh_deficiencia_pessoa" name="id_rh_deficiencia_pessoa">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql5 = "select id, defeito from rh_deficiencia_pessoa where status = 1 order by defeito asc";
                foreach ($pdo->query($sql5) as $value) {
                    echo '<option value=' . $value['id'] . '>' . $value['defeito'] . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_rh_deficiencia_pessoa_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Endereço:</label>
            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Informe...">
            <div class="form-inline" id="endereco_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Número:</label>
            <input type="text" class="form-control" id="numero" name="numero" placeholder="Informe...">
            <div class="form-inline" id="numero_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Complemento:</label>
            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Informe...">
            <div class="form-inline" id="complemento_error"></div>
        </div>
        <div class="form-group">
            <label for="label_uf">Estado (UF):</label>
            <select class="form-control" id="uf" name="uf" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql6 = "select cod_estado, nom_estado from estado order by nom_estado";
                foreach ($pdo->query($sql6) as $value) {
                    echo '<option value="' . $value['cod_estado'] . '">' . utf8_encode($value['nom_estado']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="uf_error"></div>
        </div>
        <div class="form-group">
            <label for="label_cidade">Cidade:</label>
            <select class="form-control" id="cidade" name="cidade" required>
                <option selected value="na">
                    Aguardando...
                </option>
            </select>
            <div class="form-inline" id="cidade_error"></div>
        </div>
        <div class="form-group">
            <label for="label_bairro">Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Informe Bairro">
            <div class="form-inline" id="bairro_error"></div>
        </div>
        <div class="form-group">
            <label for="label_cep">CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" maxlength="8">
            <div class="form-inline" id="cep_error"></div>
        </div>
        <div class="form-group">
            <label for="label_uf">Departamento (Setor):</label>
            <select class="form-control" id="id_rh_departamento" name="id_rh_departamento" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql7 = "select id, departamento from rh_departamentos order by departamento";
                foreach ($pdo->query($sql7) as $value) {
                    echo '<option value="' . $value['id'] . '">' . utf8_encode($value['departamento']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_rh_departamento_error"></div>
        </div>
        <div class="form-group">
            <label for="label_uf">Função:</label>
            <select class="form-control" id="id_rh_funcoes" name="id_rh_funcoes" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql8 = "select id, funcao from rh_funcoes order by funcao";
                foreach ($pdo->query($sql8) as $value) {
                    echo '<option value="' . $value['id'] . '">' . utf8_encode($value['funcao']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_rh_funcoes_error"></div>
        </div>
        <div class="form-group">
            <label for="label_uf">Estado (UF) de Trabalho:</label>
            <select class="form-control" id="uf2" name="uf2" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql9 = "select cod_estado, nom_estado from estado order by nom_estado";
                foreach ($pdo->query($sql9) as $value) {
                    echo '<option value="' . $value['cod_estado'] . '">' . utf8_encode($value['nom_estado']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="uf2_error"></div>
            <label for="label_cidade">Cidade de Trabalho:</label>
            <select class="form-control" id="cidade2" name="cidade2">
                <option selected value="na">
                    Aguardando...
                </option>
            </select>            
        </div>
        <div class="form-group">
            <label for="label_uf">Rateio Folha:</label>
            <select class="form-control" id="id_rh_rateio_folha" name="id_rh_rateio_folha" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql10 = "select id, rateio from rh_rateio_folha order by rateio";
                foreach ($pdo->query($sql10) as $value) {
                    echo '<option value="' . $value['id'] . '">' . utf8_encode($value['rateio']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_rh_rateio_folha_error"></div>
        </div>
        <div class="form-group">            
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="membro_cipa" name="membro_cipa"> Membro CIPA
                </label>
            </div>            
        </div>
        <div class="form-group">
            <label>Anotações Gerais:</label>
            <textarea class="form-control" name="anotacoes_gerais" style="height: 140px; resize: none;" id="anotacoes_gerais"></textarea>
        </div>
        <div class="form-group">
            <label for="label_nome">Data da Saída:</label>
            <input type="date" class="form-control" id="data_saida" name="data_saida" placeholder="Informe...">
            <div class="form-inline" id="data_saida_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Data Exame Demissional:</label>
            <input type="date" class="form-control" id="exame_demissional" name="exame_demissional" placeholder="Informe...">
            <div class="form-inline" id="admissao_error"></div>
        </div>
        <div class="form-group">
            <label for="label_uf">Vínculo:</label>
            <select class="form-control" id="id_rh_vinculo" name="id_rh_vinculo" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql12 = "select id, tipo from rh_vinculo order by tipo";
                foreach ($pdo->query($sql12) as $value) {
                    echo '<option value="' . $value['id'] . '">' . utf8_encode($value['tipo']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_rh_vinculo_error"></div>
        </div>
        <div class="form-group">
            <label for="label_uf">Empresa Grupo AMA:</label>
            <select class="form-control" id="id_rh_empresas" name="id_rh_empresas" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql11 = "select id, nome from rh_empresas order by nome";
                foreach ($pdo->query($sql11) as $value) {
                    echo '<option value="' . $value['id'] . '">' . utf8_encode($value['nome']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_rh_empresas_error"></div>
        </div>
        <div class="form-group">
            <label for="label_uf">Unidade Grupo AMA:</label>
            <select class="form-control" id="id_rh_unidades" name="id_rh_unidades" required>
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                $sql13 = "select id, unidade from rh_unidades order by unidade";
                foreach ($pdo->query($sql13) as $value) {
                    echo '<option value="' . $value['id'] . '">' . utf8_encode($value['unidade']) . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="id_rh_unidades_error"></div>
        </div>
        <button class="btn btn-primary btn-dropbox pull-left" id="envia" type="submit">Adicionar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<?php Database::disconnect(); ?>
<div class="modal-footer">
    <div id="conteudo_rh"></div>
</div>