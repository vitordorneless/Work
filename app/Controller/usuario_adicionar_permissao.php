<?php
require '../Model/Usuario.php';
require '../Model/Permissoes.php';
$user = new Permissoes();
$user->set_id_usuario(filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_NUMBER_INT));
$user->set_id_usuario_cadastro(filter_input(INPUT_POST, 'usuario_cadastro', FILTER_SANITIZE_NUMBER_INT));
$user->set_super_admin(filter_input(INPUT_POST, 'super_admin', FILTER_SANITIZE_NUMBER_INT));
$user->set_admin(filter_input(INPUT_POST, 'admin', FILTER_SANITIZE_NUMBER_INT));
$user->set_lojas(filter_input(INPUT_POST, 'lojas', FILTER_SANITIZE_NUMBER_INT));
$user->set_convocacao(filter_input(INPUT_POST, 'convocacao', FILTER_SANITIZE_NUMBER_INT));
$user->set_cassi(filter_input(INPUT_POST, 'cassi', FILTER_SANITIZE_NUMBER_INT));
$user->set_medicos_externo(filter_input(INPUT_POST, 'medicos_externo', FILTER_SANITIZE_NUMBER_INT));
$user->set_medicos_walmart(filter_input(INPUT_POST, 'medicos_walmart', FILTER_SANITIZE_NUMBER_INT));
$user->set_walmart_gerencial(filter_input(INPUT_POST, 'walmart_gerencial', FILTER_SANITIZE_NUMBER_INT));
$user->set_cassi_gerencial(filter_input(INPUT_POST, 'cassi_gerencial', FILTER_SANITIZE_NUMBER_INT));
$user->set_indicadores_cassi(filter_input(INPUT_POST, 'indicadores_cassi', FILTER_SANITIZE_NUMBER_INT));
$user->set_indicadores_walmart(filter_input(INPUT_POST, 'indicadores_walmart', FILTER_SANITIZE_NUMBER_INT));
$user->set_relatorios(filter_input(INPUT_POST, 'relatorios', FILTER_SANITIZE_NUMBER_INT));
$user->set_herval(filter_input(INPUT_POST, 'herval', FILTER_SANITIZE_NUMBER_INT));
$user->set_herval_gerencial(filter_input(INPUT_POST, 'herval_gerencial', FILTER_SANITIZE_NUMBER_INT));
$user->set_herval_indicadores(filter_input(INPUT_POST, 'herval_indicadores', FILTER_SANITIZE_NUMBER_INT));
$user->set_tst(filter_input(INPUT_POST, 'tst', FILTER_SANITIZE_NUMBER_INT));
$user->set_tst_gerencial(filter_input(INPUT_POST, 'tst_gerencial', FILTER_SANITIZE_NUMBER_INT));
$user->set_tst_indicadores(filter_input(INPUT_POST, 'tst_indicadores', FILTER_SANITIZE_NUMBER_INT));
$user->set_demandas(filter_input(INPUT_POST, 'demandas', FILTER_SANITIZE_NUMBER_INT));
$jatempermissao = $user->Ja_tem_Permissoes($user->get_id_usuario());

if (($user->get_super_admin() === '0') and ( $user->get_admin() === '0') and ( $user->get_lojas() === '0')
        and ( $user->get_convocacao() === '0') and ( $user->get_cassi() === '0') and ( $user->get_medicos_externo() === '0') and ( $user->get_medicos_walmart() === '0')
        and ( $user->get_walmart_gerencial() === '0') and ( $user->get_cassi_gerencial() === '0') and ( $user->get_indicadores_cassi() === '0')
        and ( $user->get_indicadores_walmart() === '0') and ( $user->get_relatorios() === '0') and ( $user->get_herval() === '0') and ( $user->get_herval_gerencial() === '0') and ( $user->get_herval_indicadores() === '0')
        and ( $user->get_tst() === '0') and ( $user->get_tst_gerencial() === '0') and ( $user->get_tst_indicadores() === '0') and ($user->get_demandas() === '0')) {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Preencha pelo Menos uma Permissão...</div>';
} else {
    if ($jatempermissao['temos'] > 0) {
        echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Já possui permissões, deve editar, nesse caso, chame o Vítor da TI!!</div>';
    } else {
        $confirm = $user->save_Permissoes($user->get_id_usuario(), $user->get_super_admin(), $user->get_admin(), $user->get_lojas(), $user->get_convocacao(), $user->get_cassi(), 
                $user->get_medicos_externo(), $user->get_medicos_walmart(), $user->get_walmart_gerencial(), $user->get_cassi_gerencial(), $user->get_indicadores_cassi(), 
                $user->get_indicadores_walmart(), $user->get_relatorios(), $user->get_herval(), $user->get_herval_gerencial(), $user->get_herval_indicadores(), 
                $user->get_tst(), $user->get_tst_indicadores(), $user->get_tst_gerencial(), $user->get_id_usuario_cadastro(),$user->get_demandas());

        if ($confirm === TRUE) {
            echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <p>Permissão Concedida!!</p></div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Erro!! Contate a TI-AMA...</div>';
        }
    }
}