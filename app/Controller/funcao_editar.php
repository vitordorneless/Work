<?php
require '../Model/Medico.php';
require '../Model/Funcao_Medicos.php';
$funcao_Medicos = new Funcao_Medicos();
$funcao_Medicos->set_funcao(filter_input(INPUT_POST, 'funcao', FILTER_SANITIZE_STRING));
$funcao_Medicos->set_id_funcao(filter_input(INPUT_POST, 'id_funcao', FILTER_SANITIZE_NUMBER_INT));
$funcao_Medicos->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));

$confirm = $funcao_Medicos->edit_Funcao_Medicos($funcao_Medicos->get_id_funcao(), $funcao_Medicos->get_funcao(), $funcao_Medicos->get_status());

if($confirm === TRUE)
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Função Editada com Sucesso!!</div>';
else
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Erro!! Contate a TI-AMA...</div>';