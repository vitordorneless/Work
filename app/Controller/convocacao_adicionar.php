<?php
require '../Model/Convocar.php';
require '../Model/Convocacao.php';
$convocacao = new Convocacao();
$convocacao->set_nome_convocacao(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$confirm = $convocacao->save_Convocacao($convocacao->get_nome_convocacao());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Convocação Gravada com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}
