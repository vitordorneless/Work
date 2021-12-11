<?php

session_start();
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$evento_convocacao = new Evento_Convocacao();
$usuario = new Usuarios();
$responsavel_walmart = new Responsaveis_Walmart();
$evento_convocacao->set_id_convocacao(filter_input(INPUT_POST, 'tipo_convocacao', FILTER_SANITIZE_NUMBER_INT));
$evento_convocacao->set_kit_entregue(filter_input(INPUT_POST, 'kit_entregue', FILTER_SANITIZE_NUMBER_INT));
$evento_convocacao->set_observacao(filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING));
$evento_convocacao->set_empresa(filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_NUMBER_INT));
$evento_convocacao->set_loja(filter_input(INPUT_POST, 'estabelecimento', FILTER_SANITIZE_NUMBER_INT));
$evento_convocacao->set_turnos(filter_input(INPUT_POST, 'turnos', FILTER_SANITIZE_NUMBER_INT));
$evento_convocacao->set_vencimento_anterior(filter_input(INPUT_POST, 'vencimento_anterior', FILTER_SANITIZE_STRING));
$evento_convocacao->set_id_responsavel_walmart(filter_input(INPUT_POST, 'resp_walmart', FILTER_SANITIZE_NUMBER_INT));
$evento_convocacao->set_ativos_lojas(filter_input(INPUT_POST, 'ativos_loja', FILTER_SANITIZE_NUMBER_INT));
$evento_convocacao->set_atendimentos(filter_input(INPUT_POST, 'atendimentos', FILTER_SANITIZE_NUMBER_INT));
$ativos = $evento_convocacao->Dados_Evento_Convocacao_ativos($evento_convocacao->get_loja());
$atendimento = bcdiv($ativos, $evento_convocacao->get_turnos());
$atendimentos = round($atendimento, 0);
$email_walmarts = $responsavel_walmart->Dados_Responsaveis_Walmart($evento_convocacao->get_id_responsavel_walmart());
$email_walmart = $email_walmarts['email'];
$email_amas = $usuario->Dados_User($_SESSION['user_id']);
$email_ama = $email_amas['email'];

$confirm = $evento_convocacao->save_Evento_Convocacao($evento_convocacao->get_id_convocacao(), 0, $evento_convocacao->get_id_responsavel_walmart(), $evento_convocacao->get_turnos(), $evento_convocacao->get_empresa(), $evento_convocacao->get_loja(), $evento_convocacao->get_kit_entregue(), $evento_convocacao->get_observacao(), $evento_convocacao->get_vencimento_anterior(), $atendimentos, $email_walmart, $email_ama);

if ($confirm === TRUE) {    
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<p>Convocação de Loja Gravada com Sucesso!!</p><p>Agora tens que Cadastrar os Médicos que irão atender esta Convocação!!</p></div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}