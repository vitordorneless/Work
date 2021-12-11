<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$ativo = new Wal_Ativos();
$ativo->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$ativo->set_cod_cargo(filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_NUMBER_INT));
$ativo->set_cod_setor(filter_input(INPUT_POST, 'setor', FILTER_SANITIZE_NUMBER_INT));
$ativo->set_cod_empresa(filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_NUMBER_INT));
$ativo->set_cod_loja(filter_input(INPUT_POST, 'estabelecimento', FILTER_SANITIZE_NUMBER_INT));
$ativo->set_id_medico(filter_input(INPUT_POST, 'id_medico', FILTER_SANITIZE_NUMBER_INT));
$ativo->set_medico_coordenador(filter_input(INPUT_POST, 'id_medico_coordenador', FILTER_SANITIZE_STRING));
$ativo->set_id_wal_box(filter_input(INPUT_POST, 'caixa', FILTER_SANITIZE_NUMBER_INT));
$ativo->set_flg_periodico(filter_input(INPUT_POST, 'flg_periodico', FILTER_SANITIZE_NUMBER_INT));
$ativo->set_nome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));

$confirm = $ativo->edit_funcao_depto($ativo->get_id(), $ativo->get_cod_cargo(), 
        $ativo->get_cod_setor(), $ativo->get_nome(), $ativo->get_cod_empresa(), 
        $ativo->get_cod_loja(), $ativo->get_flg_periodico(), $ativo->get_id_wal_box(), $ativo->get_id_medico(), $ativo->get_medico_coordenador());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <p>Editado amiguinho!!</p></div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Erro!! Contate a TI-AMA...</div>';
}