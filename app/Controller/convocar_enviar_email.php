<?php

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
include '../../class/ayuadame.php';
include '../config/database_mysql.php';
$mail = new SuperEmail();
$responsavel = new Responsaveis_Walmart();
$convocacao = new Evento_Convocacao();
$empresa = new Empresas_Walmart();
$estabelecimento = new Estabelecimentos_Walmart();
$convocacao->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$mail->set_to2(filter_input(INPUT_POST, 'to2', FILTER_SANITIZE_STRING));
$mail->set_to3(filter_input(INPUT_POST, 'to3', FILTER_SANITIZE_STRING));
$mail->set_to4(filter_input(INPUT_POST, 'to4', FILTER_SANITIZE_STRING));
$mail->set_to5(filter_input(INPUT_POST, 'to5', FILTER_SANITIZE_STRING));
$mail->set_to6(filter_input(INPUT_POST, 'to6', FILTER_SANITIZE_STRING));
$mail->set_to7(filter_input(INPUT_POST, 'to7', FILTER_SANITIZE_STRING));
$mail->set_to8(filter_input(INPUT_POST, 'to8', FILTER_SANITIZE_STRING));
$mail->set_to9(filter_input(INPUT_POST, 'to9', FILTER_SANITIZE_STRING));
$array_convocacao = $convocacao->Dados_Evento_Convocacao_completos($convocacao->get_id());
$array_responsavel = $responsavel->Dados_Responsaveis_Walmart($array_convocacao['responsavel']);
$array_empresa = $empresa->Dados_Empresa_Walmart($array_convocacao['cod_empresa']);
$array_estabelecimento = $estabelecimento->Dados_Estabelecimento_Walmart($array_convocacao['cod_estabelecimento']);

$begin_html = beginHTML();
$end_html = assinatura_HTMLwalmart_email($array_convocacao['email_ama']) . endHTML();
$body = '<div class="containerr">';
$body = $body . '<h3>Para Capital Humano, ' . $array_responsavel['nome_responsavel'] . '</h3>';
$body = $body . '<p>Loja: ' . $array_estabelecimento['desc_estabelecimento'] . '</p>';
$body = $body . '<p>Segue a programação dos exames clínicos periódicos de sua Loja / Unidade, peço a gentileza de avisarem a todos os associados e que organizem para que ninguém esteja de folga nesta(s) data(s):</p>';
$body = $body . '<p>Datas</p><p><table border=0>';
$body = $body . '<thead>';
$body = $body . '<tr>';
$body = $body . '<th><small>Data</small></th>';
$body = $body . '<th><small>Horário</small></th>';
$body = $body . '<th><small>Horário Final</small></th>';
$body = $body . '</tr>';
$body = $body . '</thead>';
$body = $body . '<tfoot>';
$body = $body . '<tr>';
$body = $body . '<th><small>Data</small></th>';
$body = $body . '<th><small>Horário Inicial</small></th>';
$body = $body . '<th><small>Horário Final</small></th>';
$body = $body . '</tr>';
$body = $body . '</tfoot>';
$body = $body . '<tbody>';
$pdo = Database::connect();
$sql1 = "select DATE_FORMAT(data_evento, '%d/%c/%Y') as data_evento, horario, horario_final from datas_eventos_convocacao where id_evento_convocacao = " . $array_convocacao['id_evento'];
foreach ($pdo->query($sql1) as $value) {
    $body = $body . '<tr>';
    $body = $body . '<td><small>' . $value['data_evento'] . '</small></td>';
    $body = $body . '<td><small>' . $value['horario'] . '</small></td>';
    $body = $body . '<td><small>' . $value['horario_final'] . '</small></td>';
    $body = $body . '</tr>';
}
$body = $body . '</tbody></table></p>';
$body = $body . '<p>Médicos</p><p><table border=0>';
$body = $body . '<thead>';
$body = $body . '<tr>';
$body = $body . '<th><small>CRM</small></th>';
$body = $body . '<th><small>Nome Médico</small></th>';
$body = $body . '<th><small>Turnos</small></th>';
$body = $body . '</tr>';
$body = $body . '</thead>';
$body = $body . '<tfoot>';
$body = $body . '<tr>';
$body = $body . '<th><small>CRM</small></th>';
$body = $body . '<th><small>Nome Médico</small></th>';
$body = $body . '<th><small>Turnos</small></th>';
$body = $body . '</tr>';
$body = $body . '</tfoot>';
$body = $body . '<tbody>';
$sql = "SELECT mediquim.nome as nome, dimdim.turnos as turnos, dimdim.valor as valor, mediquim.crm as crm
        FROM medicos_convocacao concocacacaca
        inner join wal_medico mediquim on mediquim.id_medico = concocacacaca.id_medico 
        inner join medicos_valores dimdim on dimdim.id = concocacacaca.id_medicos_valores
        where concocacacaca.id_evento_convocacao = " . $array_convocacao['id_evento'];
foreach ($pdo->query($sql) as $value) {
    $body = $body . '<tr>';
    $body = $body . '<td><small>' . $value['crm'] . '</small></td>';
    $body = $body . '<td><small>' . $value['nome'] . '</small></td>';
    $body = $body . '<td><small>' . $value['turnos'] . '</small></td>';
    $body = $body . '</tr>';
}
Database::disconnect();
$body = $body . '</tbody></table></p>';
$body = $body . '<p>INFORMAÇÕES IMPORTANTES:</p>';
$body = $body . '<li>Os <strong>Resultados dos exames complementares</strong> (para aquelas funções exigidas em PCMSO) devem ser entregues pelo Capital Humano ao médico examinador, assim como o <strong>Kit Exames Clínicos Periódicos</strong> enviado a loja.</li>';
$body = $body . '<li>Os associados que conforme PCMSO necessitam de exame complementar, só poderão realizar o exame clínico mediante a apresentação dos resultados dos exames complementares.</li>';
$body = $body . '<li>É necessário disponibilizar uma sala reservada para privacidade do exame clínico.</li>';
$body = $body . '<li>A sala deverá ter no mínimo duas cadeiras, uma mesa e não poderá ter janelas baixas sem cortina.</li>';
$body = $body . '<li>Solicitamos a presença do Capital Humano ou de outra pessoa designada, para auxiliar na convocação dos associados para os exames clínicos</li>';
$body = $body . '<p>Atenciosamente</p>';
$body = $body . '<img src="../../images/logo/ama.png"/></div>';
$body = $begin_html . $body . $end_html;


$to = $array_convocacao['email_walmart'];
$to1 = $array_convocacao['email_ama'];
$subject = $array_convocacao['convocacao'] . ' - ' . $array_convocacao['loja'];
$confirm = $convocacao->edit_Evento_Convocacao_Status($convocacao->get_id(), 2);

if ($confirm === TRUE) {
    $mail->EnviarSuperEmail($to, $mail->get_to2(), $mail->get_to3(), $mail->get_to4(), $mail->get_to5(), 
            $mail->get_to6(), $mail->get_to7(), $mail->get_to8(), $mail->get_to9(), $to1, 'na', $subject, $body);
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<p>Convocação Enviada com Sucesso!!</p></div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}