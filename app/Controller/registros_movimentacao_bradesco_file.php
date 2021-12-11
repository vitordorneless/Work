<?php
include '../config/database_mysql.php';
$pdo = Database::connect();

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

//include '../../class/alertas.php';
$registros = new Registros_Interacoes();
$registros->set_nome_arquivo(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$registros->set_data_retorno_webtran(filter_input(INPUT_POST, 'data_retorno', FILTER_SANITIZE_STRING));
$registros->set_id_usuario(filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT));
$registros->set_arquivo_sig(filter_input(INPUT_POST, 'arquivo_sig', FILTER_SANITIZE_STRING));
$registros->set_data_arquivo_sig(filter_input(INPUT_POST, 'data_arquivo_sig', FILTER_SANITIZE_STRING));
//$temos = $registros->txt_existe($registros->get_nome_arquivo());
$array = array();
$cont = $cont2 = 0;
?>
<link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
<style type="text/css" class="init"></style>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {
        $('#funcionarios').DataTable({
            "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"},
            scrollCollapse: true,
            scrollY: "600px",
            ordering: false,
            paging: true
        });
    });
</script>
<style type="text/css">
    td.vcenter {
        vertical-align: middle;
        text-align: center;
    }
</style>
<table id="funcionarios" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>            
            <th><small>Tipo de Registro</small></th>
            <th><small>Numero do Registro</small></th>            
            <th><small>Conteúdo</small></th>            
        </tr>
    </thead>
    <tfoot>
    <th><small>Tipo de Registro</small></th>
    <th><small>Numero do Registro</small></th>            
    <th><small>Conteúdo</small></th>            
</tfoot>
<tbody>
    <?php
    $arquivo = fopen('../../uploads/TXT_Bradesco/' . $registros->get_nome_arquivo(), 'r');
    while (!feof($arquivo)) {
        $linha = fgets($arquivo, 1024);
        array_push($array, $linha);
        ++$cont;
    }
    fclose($arquivo);

    foreach ($array as $value) {
        $comparador = $comparador1 = $comparador2 = $comparador3 = $comparador4 = $comparador5 = $comparador6 = $comparador7 = $comparador8 = $comparador9 = $comparador10 = $comparador11 = $comparador12 = $comparador13 = $comparador14 = $comparador15 = $comparador16 = $comparador17 = $comparador18 = $comparador19 = $comparador20 = $comparador21 = $comparador22 = $comparador23 = $comparador24 = $comparador25 = $comparador26 = $comparador27 = $comparador28 = $comparador29 = $comparador30 = $value;
        $rest = substr($comparador, 0, 1);
        switch ($rest) {
            case "*":
                $tipo_registro = substr($comparador1, 0, 1);
                $identificacao = substr($comparador2, 1, 10);
                $apolice = substr($comparador3, 11, 6);
                $data = substr($comparador4, 17, 8);
                $brancos = substr($comparador5, 25, 225);
                $sql = "INSERT INTO retorno_critica_bradesco_webtran(nome_arquivo,data_retorno_webtran,id_usuario,arquivo_sig,
                        data_arquivo_sig,header_geral,header_apolice,apolice,data_transmissao,tipo_registro,numero_registro_R,conteudo_R,                        
                        brancos_R,numero_registro_E,cod_erro_E,descricao_erro_E,sequencia_E,brancos_E,status,data_ultima_alteracao)
                        VALUES
                        ('" . $registros->get_nome_arquivo() . "','"
                        . $registros->get_data_retorno_webtran() . "',"
                        . $registros->get_id_usuario() . ",'"
                        . $registros->get_arquivo_sig() . "','"
                        . $registros->get_data_arquivo_sig() . "','"
                        . $tipo_registro . $identificacao . $apolice . $data . "','"
                        . $apolice . "','"
                        . $apolice . "','"
                        . $data . "','"
                        . $tipo_registro . "','Não Informado','Não Informado','Não Informado','Não Informado','Não Informado','Não Informado','Não Informado',
                        'Não Informado',1,now())";
                $executa = $pdo->prepare($sql);
                $executa->execute();
                break;
            case "H":
                $htipo_registro = substr($comparador6, 0, 1);
                $hcia = substr($comparador7, 1, 3);
                $hapolice = substr($comparador8, 4, 6);
                $hdata = substr($comparador9, 10, 8);
                $horigem = substr($comparador10, 18, 8);
                $hdata_transmissao = substr($comparador11, 26, 8);
                $hbrancos = substr($comparador12, 34, 216);
                $sql1 = "INSERT INTO retorno_critica_bradesco_webtran(nome_arquivo,data_retorno_webtran,id_usuario,arquivo_sig,
                        data_arquivo_sig,header_geral,header_apolice,apolice,data_transmissao,tipo_registro,numero_registro_R,conteudo_R,
                        brancos_R,numero_registro_E,cod_erro_E,descricao_erro_E,sequencia_E,brancos_E,status,data_ultima_alteracao)
                        VALUES
                        ('" . $registros->get_nome_arquivo() . "','"
                        . $registros->get_data_retorno_webtran() . "',"
                        . $registros->get_id_usuario() . ",'"
                        . $registros->get_arquivo_sig() . "','"
                        . $registros->get_data_arquivo_sig() . "','"
                        . $htipo_registro . $hapolice . $hdata . $horigem . $hdata_transmissao . "','"
                        . $hapolice . "','"
                        . $hapolice . "','"
                        . $hdata . "','"
                        . $htipo_registro . "','Não Informado','Não Informado','Não Informado','Não Informado','Não Informado','Não Informado',
                        'Não Informado','Não Informado',1,now())";
                $executa1 = $pdo->prepare($sql1);
                $executa1->execute();
                break;
            case "R":
                $rtipo_registro = substr($comparador13, 0, 1);
                $rnumero_registro = substr($comparador14, 1, 6);
                $rconteudo = substr($comparador15, 7, 200);
                $rbrancos = substr($comparador16, 207, 43);
                $sql2 = "INSERT INTO retorno_critica_bradesco_webtran(nome_arquivo,data_retorno_webtran,id_usuario,arquivo_sig,
                        data_arquivo_sig,header_geral,header_apolice,apolice,data_transmissao,tipo_registro,numero_registro_R,conteudo_R,
                        brancos_R,numero_registro_E,cod_erro_E,descricao_erro_E,sequencia_E,brancos_E,status,data_ultima_alteracao)
                        VALUES
                        ('" . $registros->get_nome_arquivo() . "','" . $registros->get_data_retorno_webtran() . "'," . $registros->get_id_usuario()
                        . ",'" . $registros->get_arquivo_sig() . "','" . $registros->get_data_arquivo_sig()
                        . "','Não Informado','Não Informado','Não Informado','Não Informado','" . $rtipo_registro
                        . "','" . $rnumero_registro . "','" . $rconteudo . "','" . $rbrancos
                        . "','Não Informado','Não Informado','Não Informado','Não Informado','Não Informado',1,now())";
                $executa2 = $pdo->prepare($sql2);
                $executa2->execute();
                echo '<tr>';
                echo '<td><small>' . $rtipo_registro . '</small></td>';
                echo '<td><small>' . $rnumero_registro . '</small></td>';
                echo '<td><small>' . $rconteudo . '</small></td>';
                echo '</tr>';
                break;
            case "E":
                $etipo_registro = substr($comparador17, 0, 1);
                $enumero_registro = substr($comparador18, 1, 6);
                $ecodigo_erro = substr($comparador19, 7, 4);
                $edesc_erro = substr($comparador20, 11, 40);
                $esequencia = substr($comparador21, 51, 8);
                $ebrancos = substr($comparador22, 59, 191);
                $sql3 = "INSERT INTO retorno_critica_bradesco_webtran(nome_arquivo,data_retorno_webtran,id_usuario,arquivo_sig,
                        data_arquivo_sig,header_geral,header_apolice,apolice,data_transmissao,tipo_registro,numero_registro_R,conteudo_R,
                        brancos_R,numero_registro_E,cod_erro_E,descricao_erro_E,sequencia_E,brancos_E,status,data_ultima_alteracao)
                        VALUES
                        ('" . $registros->get_nome_arquivo() . "','"//nome_arquivo
                        . $registros->get_data_retorno_webtran() . "',"//data_retorno
                        . $registros->get_id_usuario() . ",'"//id_usuario
                        . $registros->get_arquivo_sig() . "','"//arquivo sig
                        . $registros->get_data_arquivo_sig() . "','Não Informado','Não Informado','Não Informado','Não Informado','"//data_transmissao
                        . $etipo_registro . "','Não Informado','Não Informado','Não Informado','"
                        . $enumero_registro . "','"
                        . $ecodigo_erro . "','"
                        . $edesc_erro . "','"
                        . $esequencia . "','"
                        . $ebrancos . "',1,now())";
                $executa3 = $pdo->prepare($sql3);
                $executa3->execute();
                echo '<tr>';
                echo '<td><small>' . $etipo_registro . '</small></td>';
                echo '<td><small>' . $enumero_registro . '</small></td>';
                echo '<td><small>' . $ecodigo_erro . ' ' . $edesc_erro . ' ' . $esequencia . '</small></td>';
                echo '</tr>';
                break;
            case "T":
                $ttipo_registro = substr($comparador23, 0, 1);
                $tquantidade_reg = substr($comparador24, 1, 6);
                $tbrancos = substr($comparador25, 7, 243);
                echo '<tr>';
                echo '<td><small>' . $ttipo_registro . '</small></td>';
                echo '<td><small>' . $tquantidade_reg . '</small></td>';
                echo '<td><small>' . $tbrancos . '</small></td>';
                echo '</tr>';
                break;
        }
        ++$cont2;
    }
    Database::disconnect();
    ?>
</tbody>
</table>