<?php
include '../config/database_mysql.php';
include '../../class/ayuadame.php';
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$pdo = Database::connect();
$mail = new SSO_Email();
$cassi = new Cassi_Agendamento();
$cassi_agencia = new Cassi_Agencia();
$cassi_agencia_contato = new Cassi_Agencia_Contato();
$cassi_marca_email = new Cassi_Marca_Email();
$medico = new Medicos();
$querie = new Queries();
$array_cassi = $cassi->Dados_Cassi_Agendamentos(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$cassi->set_id($array_cassi['id']);
$cassi->set_prefixo($array_cassi['municipio']);
$cassi->set_data_agendamento($array_cassi['data_agendamento']);
$cassi->set_horario($array_cassi['horario']);
$cassi->set_id_cassi_situacao($array_cassi['id_cassi_situacao']);
$cassi->set_id_medico($array_cassi['id_medico']);
$cassi->set_valor_consulta($array_cassi['valor_consulta']);
$cassi->set_user_agendamento($array_cassi['user_agendamento']);
$array_medico = $medico->Dados_Medicos($cassi->get_id_medico());
$array_agencia = $cassi_agencia->Dados_Cassi_Agencias($cassi->get_prefixo());
$municipio = $array_agencia['dependencia'];
$data = transformaEmDataBrasileira($cassi->get_data_agendamento());
$dados_agencia = $cassi_agencia_contato->Dados_Cassi_Agencias_Contatos($array_agencia['prefixo']);
$email2 = $dados_agencia['email2'] == 'na' ? "" : $dados_agencia['email2'];

$to = $dados_agencia['email'];
$to2 = $email2;
$to3 = 'sso@amars.com.br';
$to4 = $array_medico['email'];

$body = beginHTML();
$body = $body . "<p><h2>Prezados senhores,</h2></p>";
$body = $body . "<p>Comunicamos que o agendamento do EPS da sua agência será realizado, conforme segue abaixo:</p>";
$body = $body . "<p>Data: " . $data . "</p>";
$body = $body . "<p>Médico Examinador: " . $array_medico['nome'] . " - Horário: " . $cassi->get_horario() . "</p>";
$body = $body . "<p><strong>Em anexo segue lista de colaboradores de sua agência, necessitamos a confirmação dos ativos para o email 'sso@amars.com.br'!</strong> Em caso de Licença Maternidade, Atestado Médico ou afastamento (INSS), favor comunicar-nos.</p>";
$body = $body . "<p><strong>Aquele funcionário que não estiver com os resultados dos exames complementares em mãos no dia do atendimento, poderá realizar o exame clínico normalmente, sendo que seu ASO ficará retido com o médico até que o resultado dos mesmos estejam prontos.</strong></p>";
$agencia = " ";
$cont = 0;
$confirm_agenda = TRUE;
$plural = $cont > 1 ? "S:" : " ";
$subject = "AGENDAMENTO EPS BANCO DO BRASIL AGÊNCIA" . $plural . $agencia . " CIDADE " . $municipio;
$body = $body . "</table></p>";
$body = $body . "<p>Orientações Padrão.</p>";
$body = $body . "<p>Para as funcionárias que necessitam a realização de mamografia e não conseguirem emitir as guias, favor entrar em contato com a CASSI.</p>";
$body = $body . "<p>Assim como os resultados dos exames complementares, nos casos  que necessitam realizar o exame citopatológico e a avaliação urológica devem entregar uma cópia do laudo para o médico.</p>";
$body = $body . "<p>No dia do exame clínico  o funcionário deverá entregar ao  médico os documentos para o atendimento do EPS,que estão disponibilizados no sistema, são eles:</p>";
$body = $body . "<p>-Ficha clínica que deverá ser  preenchida (dos campos 1 até o 4);</p>";
$body = $body . "<p>-ASO;</p>";
$body = $body . "<p>-Guia de atendimento;</p>";
$body = $body . "<p>Após os complementares ficarem prontos, os laudos podem ser digitalizados e encaminhados para o e-mail clinicassi.portoalegre.rs@cassi.com.br , para que os ASOs sejam liberados.</p>";
$body = $body . "<p>À disposição.</p>";
$body = $body . "<p>Atenciosamente,</p>";
$body = $body . "<p>SSO - Grupo AMA Gestão</p>";
$body = $body . endHTML();
$to10 = 'clinicassi.portoalegre.rs@cassi.com.br';
$to11 = 'flavio.correa@amars.com.br';
$file = 'Lista_Presenca_' . $array_agencia['prefixo'].'.pdf';
$confirm = $mail->EnviarEmailSSO($to, $to2, $to3, $to4, 'na', 'na', 'na', 'na', 'na', $to10, $to11, $subject, $body, $file);

if (($confirm === TRUE) and ( $confirm_agenda === TRUE)) {
    $cassi_marca_email->save_Cassi_Marca_Email($cassi->get_id(), 1);
    echo '<div class="alert alert-success" role="alert">Email Enviado com Sucesso!</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';
}