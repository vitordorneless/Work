<?php

require '../Model/Medico.php';
require '../Model/Funcao_Medicos.php';
$funcao_Medicos = new Funcao_Medicos();
$funcao_Medicos->set_funcao(filter_input(INPUT_POST, 'funcao', FILTER_SANITIZE_STRING));
$confirm = $funcao_Medicos->save_Funcao_Medicos($funcao_Medicos->get_funcao());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Função Gravado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}