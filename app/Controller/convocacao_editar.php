<?php
require '../Model/Convocar.php';
require '../Model/Convocacao.php';
$Convocacao = new Convocacao();
$Convocacao->set_nome_convocacao(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$Convocacao->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$Convocacao->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$confirm = $Convocacao->edit_Convocacao($Convocacao->get_id(), $Convocacao->get_nome_convocacao(), $Convocacao->get_status());
if($confirm === TRUE)
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Convocação Editada com Sucesso!!</div>';
else
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Erro!! Contate a TI-AMA...</div>';