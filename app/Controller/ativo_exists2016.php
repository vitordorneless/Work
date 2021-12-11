<?php

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
include '../../class/ayuadame.php';
$wal = new Wal_Ativos();
$wal->set_cpf(filter_input(INPUT_POST, 'malacabado', FILTER_SANITIZE_STRING));
$existe = $wal->count_Dados_Wal_Ativos_existe($wal->get_cpf());
if ($existe === FALSE) {
    ?>
    <script src="../js/JQuery/jquery-1.11.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#conteudo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
            $("#conteudo_lateral").empty();
            $("#conteudo_lateral_inferior").empty();
            $("#conteudo_superior").empty();
            $("#conteudo_exclusivo").empty();
            $("#conteudo").fadeIn('slow').load('ativos_include.php');
        });
    </script>
    <?php
} else {
    $dados = $wal->Dados_Wal_Ativos_existe2016($wal->get_cpf());
    $fez = $dados['flg_periodico'] == 1 ? 'Fez Periódico Amiguinho!!' : 'Não fez Periódico Amiguinho';
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Ativo Que Existe</h2>
                </div>
                <div class="widget-content">
                    <h2 class="text-danger text-nowrap"><strong><?php echo $fez; ?></strong></h2>
                </div>
                <div class="widget-content">
                    <br>
                    <div class="table-responsive">                    
                        <table class="table table-responsive tab-boxed table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><small>Nome</small></th>
                                    <th class="text-center"><small>Empresa</small></th>
                                    <th class="text-center"><small>Loja</small></th>
                                    <th class="text-center"><small>Cargo</small></th>
                                    <th class="text-center"><small>Setor</small></th>                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>                                    
                                    <th class="text-center"><small>Nome</small></th>
                                    <th class="text-center"><small>Empresa</small></th>
                                    <th class="text-center"><small>Loja</small></th>
                                    <th class="text-center"><small>Cargo</small></th>
                                    <th class="text-center"><small>Setor</small></th>                                    
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td><?php echo $dados['nome_funcionario'] ?></td>
                                    <td><?php echo $dados['desc_empresa'] ?></td>
                                    <td><?php echo $dados['desc_estabelecimento'] ?></td>
                                    <td><?php echo $dados['desc_cargo'] ?></td>
                                    <td><?php echo $dados['desc_depto'] ?></td>
                                </tr>
                                <tr>
                                    <td>Exame Clínico</td>
                                    <td>ACIDO METIL HIPURICO</td>
                                    <td>HEMOGRAMA</td>
                                    <td>ACIDO MANDELICO</td>
                                    <td>VDRL</td>
                                <tr>                                
                                    <td><?php echo $dados['data_periodico'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['data_periodico']); ?></td>
                                    <td><?php echo $dados['comp_ACIDO_METIL_HIPURICO'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_ACIDO_METIL_HIPURICO']); ?></td>
                                    <td><?php echo $dados['comp_HEMOGRAMA'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_HEMOGRAMA']); ?></td>
                                    <td><?php echo $dados['comp_ACIDO_MANDELICO'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_ACIDO_MANDELICO']); ?></td>
                                    <td><?php echo $dados['comp_VDRL'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_VDRL']); ?></td>
                                </tr>
                                <tr>
                                    <td>RETICULOCITOS</td>
                                    <td>PARASITOLOGICO FEZES</td>
                                    <td>CULTURAL DE OROFARINGE</td>
                                    <td>COPROCULTURA</td>
                                    <td>MICOLOGICO DE UNHA</td>
                                </tr>
                                <tr>
                                    <td><?php echo $dados['comp_RETICULOCITOS'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_RETICULOCITOS']); ?></td>
                                    <td><?php echo $dados['comp_PARASITOLOGICO_FEZES'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_PARASITOLOGICO_FEZES']); ?></td>
                                    <td><?php echo $dados['comp_CULTURAL_DE_OROFARINGE'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_CULTURAL_DE_OROFARINGE']); ?></td>
                                    <td><?php echo $dados['comp_COPROCULTURA'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_COPROCULTURA']); ?></td>
                                    <td><?php echo $dados['comp_MICOLOGICO_DE_UNHA'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_MICOLOGICO_DE_UNHA']); ?></td>
                                </tr>
                                <tr>
                                    <td>AUDIOMETRIA</td>
                                    <td>ECG</td>
                                    <td>ACUIDADE VISUAL</td>
                                    <td>EEG</td>
                                    <td>PLAQUETAS</td>
                                </tr>
                                <tr>
                                    <td><?php echo $dados['comp_AUDIOMETRIA'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_AUDIOMETRIA']); ?></td>
                                    <td><?php echo $dados['comp_ECG'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_ECG']); ?></td>
                                    <td><?php echo $dados['comp_ACUIDADE_VISUAL'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_ACUIDADE_VISUAL']); ?></td>
                                    <td><?php echo $dados['comp_EEG'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_EEG']); ?></td>
                                    <td><?php echo $dados['comp_PLAQUETAS'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_PLAQUETAS']); ?></td>
                                </tr>
                                <tr>
                                    <td>ERITROGRAMA</td>
                                    <td>ACIDO TT MUCONICO</td>
                                    <td>GLICEMIA EM JEJUM</td>
                                    <td>ACIDO HIPURICO</td>
                                    <td>AVALIACAO PSICOSSOCIAL</td>
                                </tr>
                                <tr>                                
                                    <td><?php echo $dados['comp_ERITROGRAMA'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_ERITROGRAMA']); ?></td>
                                    <td><?php echo $dados['comp_ACIDO_TT_MUCONICO'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_ACIDO_TT_MUCONICO']); ?></td>
                                    <td><?php echo $dados['comp_GLICEMIA_EM_JEJUM'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_GLICEMIA_EM_JEJUM']); ?></td>
                                    <td><?php echo $dados['comp_ACIDO_HIPURICO'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_ACIDO_HIPURICO']); ?></td>
                                    <td><?php echo $dados['comp_AVALIACAO_PSICOSSOCIAL'] == '0000-00-00 00:00:00' ? 'não tem' : transformaEmDataBrasileira($dados['comp_AVALIACAO_PSICOSSOCIAL']); ?></td>
                                </tr>
                            </tbody>
                        </table>                     
                    </div>                
                </div>
            </div>
        </div>
    </div>
    <?php
}