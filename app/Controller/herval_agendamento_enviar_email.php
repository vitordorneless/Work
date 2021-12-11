<?php

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
include '../config/database_mysql.php';
include '../../class/ayuadame.php';
$pdo = Database::connect();
$herval = new Herval_Agendamento();
$mail = new SuperEmail();
$medico = new Medicos();
$prestador = new Prestadores_PJ();
$herval_mail = new Herval_Marca_Email();
$city = new Cidades_e_Estados();

$herval->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$herval->set_mostrar_data(filter_input(INPUT_POST, 'mostrar_data', FILTER_SANITIZE_NUMBER_INT));
$array_herval = $herval->Dados_Herval_agendamentos($herval->get_id());
$array_medico = $medico->Dados_Medicos($array_herval['id_medico']);
$array_prestador = $prestador->Dados_Prestadores_PJ($array_medico['id_prestador']);
$array_city = $city->Dados_Cidades($array_prestador['id_cidade']);
$array_state = $city->Dados_Estados($array_prestador['id_estado_UF']);

$sql_cargo = 'select nome_gerente, email from herval_contatos_unidade where id_herval_unidade in (' . $array_herval['id_unidade'] . ')';
$qq = $pdo->prepare($sql_cargo);
$qq->execute();
$data = $qq->fetch(PDO::FETCH_ASSOC);

$sql_unidade = 'select unidade from herval_unidades where id in (' . $array_herval['id_unidade'] . ')';
$qqq = $pdo->prepare($sql_unidade);
$qqq->execute();
$dataa = $qqq->fetch(PDO::FETCH_ASSOC);


$to3 = 'na'; //'sso@amars.com.br';
$to4 = 'na'; //'rodaica.grigorius@herval.com.br';
$to5 = 'na'; //'sonia.rocha@herval.com.br';
$to6 = 'na'; //$data['email'];
$to11 = 'na'; //'vivian.baroni@amars.com.br';
$subject = 'Convocação ' . $dataa['unidade'];

$body = beginHTML();
$body = $body . "<p><h2>Prezados Senhores e Gerente " . $data['nome_gerente'] . ",</h2></p>";
$body = $body . "<p>Estamos efetuando a CONVOCAÇÃO dos colaboradores da loja " . $dataa['unidade'] . ", para a realização do Exame Periódico, conforme prevê o  PCMSO da sua empresa.</p>";
$body = $body . '<p>Por Favor, <strong> responda este Email para "sso@amars.com.br"</strong>!!</p>';
$body = $body . "<p><strong>Para agilizar o processo de atualização das informações, solicitamos que após o atendimento o ASO seja digitalizado e encaminhado ao serviço de saúde ocupacional do grupo AMA, através do e-mail acima citado.</strong></p>";
$body = $body . "<p>Salientamos que a não execução do exame, poderá implicar em desalinhamento com a legislação vigente, acarretando em eventuais multas e sanções à sua empresa.</p>";
if ($herval->get_mostrar_data() === 1) {
    $body = $body . "<p>Data: " . transformaEmDataBrasileira($array_herval['data_agendamento']) . "</p>";
}
$endereco = $array_prestador['endereco'] == '' ? 'Não Informado' : $array_prestador['endereco'] . "," . $array_prestador['numero'] == '' ? 'Não informado' : $array_prestador['numero'] . "," . $array_prestador['complemento'] == '' ? 'Não informado' : $array_prestador['complemento'] . ", bairro " . $array_prestador['bairro'] == '' ? 'Não informado' : $array_prestador['bairro'] . ", " . $array_city['nom_cidade'] == '' ? 'Não Informado' : $array_city['nom_cidade'] . "/" . $array_state['sgl_estado'] == '' ? 'Não informado' : $array_state['sgl_estado'];
$body = $body . "<p>Médico Prestador: " . $array_medico['nome'] . "</p>";
$body = $body . "<p>Endereço: " . $endereco . "</p>";
$body = $body . '<p>Voucher: <a href="http://localhost/AMA_Lojas/app/View/voucher.php?voucher=' . $array_herval['voucher'] . '">' . $array_herval['voucher'] . '</a></p>';
$body = $body . "<p>Segue lista dos convocados:</p>";
$body = $body . "<p><table><tr><th>Matrícula</th><th>Nome</th><th>Data</th><th>Horario</th><th>Situação</th></tr>";

$sql = "select id, matricula, nome, data_nascimento, data_admissao, id_unidade from herval_ativos where id_unidade in (" . $array_herval['id_unidade'] . ") order by nome asc";
$corte = new DateTime('2014-07-10');
foreach ($pdo->query($sql) as $value) {

    $sql_cargo = 'select data, horario from herval_agendamento_individual where id_ativo in (' . $value['id'] . ')';
    $qq = $pdo->prepare($sql_cargo);
    $qq->execute();
    $data_cargo = $qq->fetch(PDO::FETCH_ASSOC);
    
    $matricula = $value['matricula'];
    $nome_ativo = $value['nome'];
    $data = $data_cargo['data'] == '' ? "Não informado" : transformaEmDataBrasileira($data_cargo['data']);
    $horario = $data_cargo['horario'] == '' ? "Não informado" : $data_cargo['horario'];
    $body = $body . "<tr><td>$matricula</td><td>$nome_ativo</td><td>$data</td><td>$horario</td><td>aqui a variavel</td></tr>";
}
$body = $body . "</table></p>";
$body = $body . "<p>Prestador:</p>";
$body = $body . "<p>Para esta consulta o candidato deverá estar munido de guia de atendimento e documento original com foto.</p>";
$body = $body . "<p>Havendo a necessidade de exames complementares, o colaborador deverá apresentar o(s) resultado(s) no momento do exame clínico.</p>";
$body = $body . "<p>Caso o colaborador não tenha realizado exames complementares ou haja algum impedimento/desistência referente à data agendada, favor comunicar ao Grupo AMA através do telefone (0XX51) 3217-3434 discando a opção 3 para falar com o Serviço de Saúde Ocupacional, e/ou e-mail sso@amars.com.br, no prazo mínimo de 24 horas de antecedência. O não cancelamento em tempo hábil poderá acarretar em cobranças de despesas operacionais.</p>";
$body = $body . endHTML();
$confirm = $mail->EnviarSuperEmail('na', 'na', $to3, $to4, $to5, $to6, 'na', 'na', 'na', 'na', $to11, $subject, $body);

if ($confirm === TRUE) {
    $herval_mail->save_Herval_Marca_Email($herval->get_id(), 1);
    echo '<div class="alert alert-success" role="alert">Email Enviado com Sucesso!</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';
}