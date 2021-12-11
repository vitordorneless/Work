<?php
include '../config/database_mysql.php';
include '../../class/ayuadame.php';
include '../../class/alertas.php';
$pdo = Database::connect();
$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
<style type="text/css" class="init"></style>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
<style type="text/css" class="init"></style>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {
        $('#funcionarios').DataTable();
    });
</script>
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Listar </strong>Herval</h2>
                <div class="additional-btn">                        
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>                        
                </div>                    
            </div>
            <div class="widget-content">                    
                <br>
                <div class="table-responsive">
                    <form class='form-horizontal' role='form'>
                        <table id="funcionarios" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><small>Nome</small></th>
                                    <th><small>Função</small></th>
                                    <th><small>Setor</small></th>
                                    <th><small>Nascimento</small></th>                                    
                                    <th><small>Idade</small></th>
                                    <th><small>Admissão</small></th>
                                    <th><small>Tempo Adm</small></th>
                                    <th><small>Corte AMA</small></th>                                    
                                    <th><small>Dt. P</small></th>
                                    <th><small>Exceção</small></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th><small>Nome</small></th>
                                    <th><small>Setor</small></th>
                                    <th><small>Função</small></th>
                                    <th><small>Nascimento</small></th>                                    
                                    <th><small>Idade</small></th>
                                    <th><small>Admissão</small></th>
                                    <th><small>Tempo Adm</small></th>
                                    <th><small>Corte AMA</small></th>                                    
                                    <th><small>Dt. P</small></th>
                                    <th><small>Exceção</small></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $sql = "select id, nome, data_nascimento, data_admissao, id_setor, id_funcao, id_unidade from herval_ativos where id_unidade in ($search)";
                                foreach ($pdo->query($sql) as $value) {

                                    $corte = new DateTime('2014-07-10');

                                    $sql_cargo = 'select id, funcao from herval_funcao where id in (' . $value['id_funcao'] . ')';
                                    $qq = $pdo->prepare($sql_cargo);
                                    $qq->execute();
                                    $data_cargo = $qq->fetch(PDO::FETCH_ASSOC);

                                    $sql_unidade = 'select id, setor from herval_setores where id in (' . $value['id_setor'] . ')';
                                    $qqq = $pdo->prepare($sql_unidade);
                                    $qqq->execute();
                                    $data_unidade = $qqq->fetch(PDO::FETCH_ASSOC);

                                    $sql_tipo_unidade = 'select id_tipo_unidade from herval_unidades where id in (' . $value['id_unidade'] . ')';
                                    $qqqq = $pdo->prepare($sql_tipo_unidade);
                                    $qqqq->execute();
                                    $data_tipo_unidade = $qqqq->fetch(PDO::FETCH_ASSOC);

                                    $sql_template = 'select id,id_tipo_unidade,id_herval_setor,id_herval_funcao,agente_fisico,obs_agente_fisico,
                                                    agente_quimico,obs_agente_quimico,agente_biologico,obs_agente_biologico,agente_ergonomico,obs_agente_ergonomico,
                                                    ausencia_de_risco,obs_ausencia_de_risco,exame_clinico,acido_metil_hipurico,hemograma,acido_mandelico,vdrl,
                                                    reticulocitos,parasitologico_fezes,cultural_de_orofaringe,coprocultura,micologico_de_unha,audiometria,ecg,
                                                    acuidade_visual,eeg,plaquetas,eritrograma,acido_tt_muconico,glicemia_em_jejum,avaliacao_psicossocial,
                                                    acido_hipurico,obs_1,obs_2,obs_3,obs_4,obs_5,obs_6,obs_7,obs_8,obs_9,obs_10,status,data_ultima_alteracao 
                                                    from herval_sintese_template 
                                                    where status = 1 and id_tipo_unidade = ' . $data_tipo_unidade['id_tipo_unidade'] . ' 
                                                    and id_herval_setor = ' . $value['id_setor'] . '
                                                    and id_herval_funcao = ' . $value['id_funcao'];
                                    $qqqqq = $pdo->prepare($sql_template);
                                    $qqqqq->execute();
                                    $data_template = $qqqqq->fetch(PDO::FETCH_ASSOC);


                                    $data1 = new DateTime($value['data_nascimento']);
                                    $data2 = new DateTime(date("Y-m-d"));
                                    $diferenca = $data1->diff($data2);

                                    $data11 = new DateTime($value['data_admissao']);
                                    $data22 = new DateTime(date("Y-m-d"));
                                    $diferencaa = $data11->diff($data22);
                                    $ano_admissao = $data11->format('Y');

                                    $comparativo_corte = new DateTime('2016' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                    $comparativo_corte_2 = new DateTime('2014' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                    $comparativo_corte_3 = new DateTime('2015' . '-' . $data11->format('m') . '-' . $data11->format('d'));

                                    $periodico = !($data11->format('Y') % 2) ? "par" : "impar";
                                    $idade = $diferenca->format('%y');

                                    if (($idade >= '18') and ( $idade <= '45')) {
                                        if (($data_template['obs_1'] === '1') or ( $data_template['obs_4'] === '1')) {
                                            if ($periodico === 'par') {
                                                if ($ano_admissao === '2014') {
                                                    $data_periodico = new DateTime('2016' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $comparativo_corte < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte->format('Y-m-d');
                                                } else {
                                                    $data_periodico = new DateTime('2014' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $data11 < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte_2->format('Y-m-d');
                                                }
                                            } else {
                                                if ($ano_admissao === '2015') {
                                                    $data_periodico = new DateTime('2017' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $data_periodico->format('Y-m-d');
                                                } else {
                                                    $data_periodico = new DateTime('2015' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $data_periodico->format('Y-m-d');
                                                }
                                            }
                                        }
                                    }

                                    if (($idade < '18') or ( $idade > '45')) {
                                        if (($data_template['obs_1'] === '1') or ( $data_template['obs_4'] === '1')) {
                                            if ($periodico === 'par') {
                                                if ($ano_admissao === '2014') {
                                                    $data_periodico = new DateTime('2015' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $comparativo_corte < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte_3->format('Y-m-d');
                                                } else {
                                                    $data_periodico = new DateTime('2014' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $comparativo_corte < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte_2->format('Y-m-d');
                                                }
                                            } else {
                                                if ($ano_admissao === '2015') {
                                                    $data_periodico = new DateTime('2016' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $data_periodico->format('Y-m-d');
                                                } else {
                                                    $data_periodico = new DateTime('2015' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $data_periodico->format('Y-m-d');
                                                }
                                            }
                                        }
                                    }

                                    if (($idade >= '18') and ( $idade <= '45')) {
                                        if ($data_template['obs_8'] === '1') {
                                            if ($periodico === 'par') {
                                                if ($ano_admissao === '2014') {
                                                    $data_periodico = new DateTime('2016' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $comparativo_corte < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte->format('Y-m-d');
                                                } else {
                                                    $data_periodico = new DateTime('2014' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $data11 < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte_2->format('Y-m-d');
                                                }
                                            } else {
                                                if ($ano_admissao === '2015') {
                                                    $data_periodico = new DateTime('2016' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $data_periodico->format('Y-m-d');
                                                } else {
                                                    $data_periodico = new DateTime('2015' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $data_periodico->format('Y-m-d');
                                                }
                                            }
                                        }
                                    }

                                    if (($idade < '18') or ( $idade > '45')) {
                                        if ($data_template['obs_8'] === '1') {
                                            if ($periodico === 'par') {
                                                if ($ano_admissao === '2014') {
                                                    $data_periodico = new DateTime('2016' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $comparativo_corte < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte_3->format('Y-m-d');
                                                } else {
                                                    $data_periodico = new DateTime('2014' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $comparativo_corte < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte_2->format('Y-m-d');
                                                }
                                            } else {
                                                if ($ano_admissao === '2015') {
                                                    $data_periodico = new DateTime('2017' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $data_periodico->format('Y-m-d');
                                                } else {
                                                    $data_periodico = new DateTime('2015' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                    $data_ofifi = $data_periodico->format('Y-m-d');
                                                }
                                            }
                                        }
                                    }

                                    if (($data_template['obs_1'] === '0') and ( $data_template['obs_4'] === '0') and ( $data_template['obs_8'] === '0')) {
                                        if ($periodico === 'par') {
                                            $data_periodico = new DateTime('2016' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                            $data_ofifi = $comparativo_corte < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte->format('Y-m-d');
                                        } else {
                                            if ($ano_admissao === '2015') {
                                                $data_periodico = new DateTime('2017' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                $data_ofifi = $comparativo_corte < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte->format('Y-m-d');
                                            } else {
                                                $data_periodico = new DateTime('2015' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                $data_ofifi = $comparativo_corte < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte->format('Y-m-d');
                                            }
                                        }
                                    }

                                    if (($data_template['obs_1'] === NULL) and ( $data_template['obs_4'] === NULL) and ( $data_template['obs_8'] === NULL)) {
                                        if ($periodico === 'par') {
                                            $data_periodico = new DateTime('2016' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                            $data_ofifi = $comparativo_corte < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte->format('Y-m-d');
                                        } else {
                                            if ($ano_admissao === '2015') {
                                                $data_periodico = new DateTime('2017' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                $data_ofifi = $comparativo_corte < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte->format('Y-m-d');
                                            } else {
                                                $data_periodico = new DateTime('2016' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                                $data_ofifi = $comparativo_corte < $corte ? $data_periodico->format('Y-m-d') : $comparativo_corte->format('Y-m-d');
                                            }
                                        }
                                    }

                                    if ($ano_admissao === '2015') {
                                        $data_periodico = new DateTime('2017' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                        $com_adm = $data_periodico->format('Y-m-d');
                                        $excecao = '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Normal';
                                    } else {
                                        if ($ano_admissao === '2014') {
                                            $data_periodico = new DateTime('2016' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                        }
                                        $data_periodico = new DateTime('2016' . '-' . $data11->format('m') . '-' . $data11->format('d'));
                                        $com_adm = $comparativo_corte->format('Y-m-d');
                                        $excecao = $comparativo_corte < $corte ? '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Exceção' : '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Normal';
                                    }

                                    echo '<tr>';
                                    echo '<td><small>' . utf8_encode($value['nome']) . '</small></td>';
                                    echo '<td><small>' . utf8_encode($data_unidade['setor']) . '</small></td>';
                                    echo '<td><small>' . utf8_encode($data_cargo['funcao']) . '</small></td>';
                                    echo '<td><small>' . transformaEmDataBrasileira($value['data_nascimento']) . '</small></td>';
                                    echo '<td><small>' . $diferenca->format('%y ano(s)') . '</small></td>';
                                    echo '<td><small>' . transformaEmDataBrasileira($value['data_admissao']) . '</small></td>';
                                    echo '<td><small>' . $diferencaa->format('%y ano(s)') . '</small></td>';
                                    echo '<td><small><strong>' . transformaEmDataBrasileira('2014-07-10') . '</strong></small></td>';                                    
                                    echo '<td><small><strong>' . transformaEmDataBrasileira($data_ofifi) . '</strong></small></td>';
                                    echo '<td><small>' . $excecao . '</small></td>';
                                    echo '</tr>';
                                }
                                Database::disconnect();
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>