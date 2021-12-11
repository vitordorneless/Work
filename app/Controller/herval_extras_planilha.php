<?php

include '../config/database_mysql.php';
include '../../class/ayuadame.php';
$pdo = Database::connect();
$date = date('d-m-Y H:i:s');
$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
$html = '';
$html = $html . '<table border=1>';
$html = $html . '<thead>';
$html = $html . '<tr>';
$html = $html . '<th>Nome</th>';
$html = $html . '<th>Fun&ccedil;&atilde;o</th>';
$html = $html . '<th>Setor</th>';
$html = $html . '<th>Nascimento</th>';
$html = $html . '<th>Idade</th>';
$html = $html . '<th>Admiss&atilde;o</th>';
$html = $html . '<th>Tempo Adm</th>';
$html = $html . '<th>Corte AMA</th>';
$html = $html . '<th>Dt. P</th>';
$html = $html . '<th>Exce&ccedil;&atilde;o</th>';
$html = $html . '</tr>';
$html = $html . '</thead>';
$html = $html . '<tbody>';
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
        $excecao = $comparativo_corte < $corte ? '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Exce&ccedil;&atilde;o' : '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Normal';
    }

    $html = $html . '<tr>';
    $html = $html . '<td>' . utf8_encode($value['nome']) . '</td>';
    $html = $html . '<td>' . utf8_encode($data_unidade['setor']) . '</td>';
    $html = $html . '<td>' . utf8_encode($data_cargo['funcao']) . '</td>';
    $html = $html . '<td>' . transformaEmDataBrasileira($value['data_nascimento']) . '</td>';
    $html = $html . '<td>' . $diferenca->format('%y ano(s)') . '</td>';
    $html = $html . '<td>' . transformaEmDataBrasileira($value['data_admissao']) . '</td>';
    $html = $html . '<td>' . $diferencaa->format('%y ano(s)') . '</td>';
    $html = $html . '<td>' . transformaEmDataBrasileira('2014-07-10') . '</td>';
    $html = $html . '<td>' . transformaEmDataBrasileira($data_ofifi) . '</td>';
    $html = $html . '<td>' . $excecao . '</td>';
    $html = $html . '</tr>';
}
Database::disconnect();
$html = $html . '</tbody></table>';
$nome = 'Relacao_Herval_' . $date . '_' . $search . '.xls';
header("Content-type: application/vnd.ms-excel");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=$nome");
header("Pragma: no-cache");
echo $html;
