<?php
error_reporting(E_ALL);
include '../config/database_mysql.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' no foi encontrado!');
}
$pdo = Database::connect();
$evento = new Demandas();
$tipo_demanda = new Demandas_Tipos();
$demandarr = new Demandas_Registros_Execute();
$user = new Usuarios();
$querie = new Queries();
$array = $evento->Dados_Demandas(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_user = $user->Dados_User($array['id_user_abertura']);
$array_executante = $user->Dados_User($array['executantes']);
$array_demanda = $tipo_demanda->Dados_Demandas($array['id_demanda']);
$arrar_demanda_registro = $demandarr->Dados_DemandasRR($array['id']);
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_cassi_solicitante").load('demandas_geral');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_cassi_solicitante").load('demandas_geral');
            }
        });
    });
</script>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    <h4 class="modal-title">Demanda</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_nome_medico">Proprietário:</label>
            <input type="text" class="form-control" value="<?php echo $array_user['nome_extenso']; ?>" disabled="disabled">            
            <input type="hidden" id="id" name="id" value="<?php echo $array['id']; ?>">
            <input type="hidden" id="id_demandar" name="id_demandar" value="<?php echo $arrar_demanda_registro['id']; ?>">
        </div>        
        <div class="form-group">
            <label for="label_nome_medico">Executante:</label>
            <input type="text" class="form-control" value="<?php echo $array_executante['nome_extenso']; ?>" disabled="disabled">
            <input type="hidden" id="id_executante" name="id_executante" value="<?php echo $array_executante['id']; ?>">            
        </div>
        <div class="form-group">
            <label for="label_nome_medico">Demanda:</label>
            <input type="text" class="form-control" value="<?php echo $array_demanda['tipo_demanda']; ?>" disabled="disabled">            
        </div>
        <div class="form-group">
            <label>CPF Associado (ativo): </label>
            <input class="form-control" id="cpf_ativo" name="cpf_ativo" maxlength="11" type="text" value="<?php echo $arrar_demanda_registro['cpf_ativo']; ?>" disabled="disabled">
        </div>
        <div class="form-group">
            <label>Nome Associado (ativo): </label>
            <input class="form-control" id="nome_ativo" name="nome_ativo" type="text" value="<?php echo $arrar_demanda_registro['nome_ativo']; ?>" disabled="disabled">
        </div>
        <div class="form-group">
            <label>Empresa: </label>
            <input class="form-control" value="<?php echo $arrar_demanda_registro['empresa']; ?>" type="text" disabled="disabled">
        </div>
        <div class="form-group">
            <label>CPF Dependente: </label>
            <input class="form-control" id="cpf_dependente" name="cpf_dependente" value="<?php echo $arrar_demanda_registro['cpf_dep']; ?>" maxlength="11" type="text" disabled="disabled">
        </div>                    
        <div class="form-group">
            <label>Nome Dependente: </label>
            <input class="form-control" id="nome_dependente" name="nome_dependente" value="<?php echo $arrar_demanda_registro['nome_dep']; ?>" type="text" disabled="disabled">            
        </div>        
        <div class="form-group">
            <label>CPF Dependente: </label>
            <input class="form-control" id="cpf_dependente1" name="cpf_dependente1" value="<?php echo $arrar_demanda_registro['cpf_dep1']; ?>" maxlength="11" type="text" disabled="disabled">
        </div>                    
        <div class="form-group">
            <label>Nome Dependente: </label>
            <input class="form-control" id="nome_dependente1" name="nome_dependente1" value="<?php echo $arrar_demanda_registro['nome_dep1']; ?>" type="text" disabled="disabled">                        
        </div>
        <div class="form-group">
            <label>CPF Dependente: </label>
            <input class="form-control" id="cpf_dependente2" name="cpf_dependente2" value="<?php echo $arrar_demanda_registro['cpf_dep2']; ?>" maxlength="11" type="text" disabled="disabled">
        </div>                    
        <div class="form-group">
            <label>Nome Dependente: </label>
            <input class="form-control" id="nome_dependente2" name="nome_dependente2" value="<?php echo $arrar_demanda_registro['nome_dep2']; ?>" type="text" disabled="disabled">                        
        </div>
        <div class="form-group">
            <label>CPF Dependente: </label>
            <input class="form-control" id="cpf_dependente3" name="cpf_dependente3" value="<?php echo $arrar_demanda_registro['cpf_dep3']; ?>" maxlength="11" type="text" disabled="disabled">
        </div>                    
        <div class="form-group">
            <label>Nome Dependente: </label>
            <input class="form-control" id="nome_dependente3" name="nome_dependente3" value="<?php echo $arrar_demanda_registro['nome_dep3']; ?>" type="text" disabled="disabled">                        
        </div>                        
        <div class="form-group">
            <label>CPF Dependente: </label>
            <input class="form-control" id="cpf_dependente4" name="cpf_dependente4" value="<?php echo $arrar_demanda_registro['cpf_dep4']; ?>" maxlength="11" type="text" disabled="disabled">
        </div>
        <div class="form-group">
            <label>Nome Dependente: </label>
            <input class="form-control" id="nome_dependente4" name="nome_dependente4" value="<?php echo $arrar_demanda_registro['nome_dep4']; ?>" type="text" disabled="disabled">                        
        </div>                

        <div class="form-group">
            <label>CPF Dependente: </label>
            <input class="form-control" id="cpf_dependente5" name="cpf_dependente5" value="<?php echo $arrar_demanda_registro['cpf_dep5']; ?>" maxlength="11" type="text" disabled="disabled">
        </div>                    
        <div class="form-group">
            <label>Nome Dependente: </label>
            <input class="form-control" id="nome_dependente5" name="nome_dependente5" value="<?php echo $arrar_demanda_registro['nome_dep5']; ?>" type="text" disabled="disabled">                        
        </div>            
        <div class="form-group">
            <label>CPF Dependente: </label>
            <input class="form-control" id="cpf_dependente6" name="cpf_dependente6" value="<?php echo $arrar_demanda_registro['cpf_dep6']; ?>" maxlength="11" type="text" disabled="disabled">
        </div>                    
        <div class="form-group">
            <label>Nome Dependente: </label>
            <input class="form-control" id="nome_dependente6" name="nome_dependente6" value="<?php echo $arrar_demanda_registro['nome_dep6']; ?>" type="text" disabled="disabled">                        
        </div>            
        <div class="form-group">
            <label>CPF Dependente: </label>
            <input class="form-control" id="cpf_dependente7" name="cpf_dependente7" value="<?php echo $arrar_demanda_registro['cpf_dep7']; ?>" maxlength="11" type="text" disabled="disabled">
        </div>                    
        <div class="form-group">
            <label>Nome Dependente: </label>
            <input class="form-control" id="nome_dependente7" name="nome_dependente7" value="<?php echo $arrar_demanda_registro['nome_dep7']; ?>" type="text" disabled="disabled">                        
        </div>
        <div class="form-group">
            <label>CPF Dependente: </label>
            <input class="form-control" id="cpf_dependente8" name="cpf_dependente8" value="<?php echo $arrar_demanda_registro['cpf_dep8']; ?>" maxlength="11" type="text" disabled="disabled">
        </div>
        <div class="form-group">
            <label>Nome Dependente: </label>
            <input class="form-control" id="nome_dependente8" name="nome_dependente8" value="<?php echo $arrar_demanda_registro['nome_dep8']; ?>" type="text" disabled="disabled">                        
        </div>                
        <div class="form-group">
            <label for="label_obs">Observações:</label>
            <textarea class="form-control" name="copyemail" id="copyemail" rows="10" disabled="disabled"><?php echo $array['copy_email']; ?></textarea>            
        </div>        
        <div class="form-group">
            <label for="label_funcao_medico">Status:</label>
            <select class="form-control" id="status" name="status">
                <option value="na">
                    Selecione...
                </option>
                <?php
                foreach ($pdo->query($querie->status_list_all()) as $value) {
                    $option = $value['id'] == $array['id_status'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . $value['status'] . '</option>';
                }
                ?>
            </select>
            <div class="form-inline" id="status_error"></div>
        </div><?php Database::disconnect(); ?>        
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>