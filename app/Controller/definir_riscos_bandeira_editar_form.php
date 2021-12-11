<?php

include '../config/database_mysql.php';

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' nao foi encontrado!');
}

$pdo = Database::connect();
$riscos = new Riscos_Operations();
$riscos->set_bandeira(filter_input(INPUT_GET, 'bandeira', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_cod_cargo(filter_input(INPUT_GET, 'cargo', FILTER_SANITIZE_STRING));
$riscos->set_depto(filter_input(INPUT_GET, 'setor', FILTER_SANITIZE_STRING));
$riscos->set_agente_fisico(filter_input(INPUT_GET, 'agente_fisico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_agente_quimico(filter_input(INPUT_GET, 'agente_quimico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_agente_biologico(filter_input(INPUT_GET, 'agente_biologico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_agente_ergonomico(filter_input(INPUT_GET, 'agente_ergonomico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_ausencia_de_risco(filter_input(INPUT_GET, 'ausencia_de_risco', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_obs_agente_fisico(filter_input(INPUT_GET, 'obs_agente_fisico', FILTER_SANITIZE_STRING));
$riscos->set_obs_agente_quimico(filter_input(INPUT_GET, 'obs_agente_quimico', FILTER_SANITIZE_STRING));
$riscos->set_obs_agente_biologico(filter_input(INPUT_GET, 'obs_agente_biologico', FILTER_SANITIZE_STRING));
$riscos->set_obs_agente_ergonomico(filter_input(INPUT_GET, 'obs_agente_ergonomico', FILTER_SANITIZE_STRING));
$riscos->set_obs_ausencia_de_risco(filter_input(INPUT_GET, 'obs_ausencia_de_risco', FILTER_SANITIZE_STRING));
$riscos->set_exame_clinico(filter_input(INPUT_GET, 'exame_clinico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_acido_metil_hipurico(filter_input(INPUT_GET, 'acido_metil_hipurico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_hemograma(filter_input(INPUT_GET, 'hemograma', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_acido_mandelico(filter_input(INPUT_GET, 'acido_mandelico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_vdrl(filter_input(INPUT_GET, 'vdrl', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_reticulocitos(filter_input(INPUT_GET, 'reticulocitos', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_parasitologico_fezes(filter_input(INPUT_GET, 'parasitologico_fezes', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_anti_hbs(filter_input(INPUT_GET, 'anti_hbs', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_hbs_ag(filter_input(INPUT_GET, 'hbs_ag', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_anti_hbc(filter_input(INPUT_GET, 'anti_hbc', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_cultural_de_orofaringe(filter_input(INPUT_GET, 'cultural_de_orofaringe', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_coprocultura(filter_input(INPUT_GET, 'coprocultura', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_micologico_de_unha(filter_input(INPUT_GET, 'micologico_de_unha', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_audiometria(filter_input(INPUT_GET, 'audiometria', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_ecg(filter_input(INPUT_GET, 'ecg', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_acuidade_visual(filter_input(INPUT_GET, 'acuidade_visual', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_eeg(filter_input(INPUT_GET, 'eeg', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_plaquetas(filter_input(INPUT_GET, 'plaquetas', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_eritrograma(filter_input(INPUT_GET, 'eritrograma', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_acido_tt_muconico(filter_input(INPUT_GET, 'acido_tt_muconico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_glicemia_em_jejum(filter_input(INPUT_GET, 'glicemia_em_jejum', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_avaliacao_psicossocial(filter_input(INPUT_GET, 'avaliacao_psicossocial', FILTER_SANITIZE_NUMBER_INT));
$outros_post = filter_input(INPUT_GET, 'outros', FILTER_SANITIZE_NUMBER_INT);
$obs_outros_post = filter_input(INPUT_GET, 'obs_outros', FILTER_SANITIZE_STRING);
if (($riscos->get_agente_fisico() === '0') and ( $riscos->get_agente_biologico() === '0') and ( $riscos->get_agente_ergonomico() === '0')
        and ( $riscos->get_agente_quimico() === '0') and ( $riscos->get_ausencia_de_risco() === '0') and ( $outros_post === '0')) {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Preencha pelo Menos um Risco...</div>';
} else {
    if (($riscos->get_exame_clinico() === '0') and ( $riscos->get_acido_metil_hipurico() === '0') and ( $riscos->get_hemograma() === '0')
            and ( $riscos->get_acido_mandelico() === '0') and ( $riscos->get_vdrl() === '0') and ( $riscos->get_reticulocitos() === '0')
            and ( $riscos->get_parasitologico_fezes() === '0') and ( $riscos->get_cultural_de_orofaringe() === '0')
            and ( $riscos->get_coprocultura() === '0') and ( $riscos->get_micologico_de_unha() === '0') and ( $riscos->get_audiometria() === '0')
            and ( $riscos->get_ecg() === '0') and ( $riscos->get_acuidade_visual() === '0') and ( $riscos->get_eeg() === '0')
            and ( $riscos->get_plaquetas() === '0') and ( $riscos->get_eritrograma() === '0') and ( $riscos->get_acido_tt_muconico() === '0')
            and ( $riscos->get_anti_hbs() === '0') and ( $riscos->get_hbs_ag() === '0') and ( $riscos->get_anti_hbc() === '0')
            and ( $riscos->get_glicemia_em_jejum() === '0') and ( $riscos->get_acido_hipurico() === '0') and ( $riscos->get_avaliacao_psicossocial() === '0')) {
        echo '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Preencha pelo Menos um Exame...</div>';
    } else {
        $sql_edicao = 'select id from wal_funcionarios where risco = 1 and exame = 1 and periodo in ("2016a") and id_wal_flags = ' . $riscos->get_bandeira() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo in (' . $riscos->get_cod_cargo() . ')';
        $ids = array();        
        $idss = array();
        $idsss = array();         
        $conts = $contss = $contsss = 0;        
        
        foreach ($pdo->query($sql_edicao) as $value) {
            $ids[$conts] = $value['id'];
            ++$conts;
        }
        $ids_para_risco_0 = implode(",", $ids);
        $zera_riscos_e_exames = $pdo->query('update wal_funcionarios set risco = 0, exame = 0, data_ultima_alteracao = now() where id in (' . $ids_para_risco_0 . ')');
        $sql_edicao_exames = 'select id from wal_funcionarios_exames where id_funcionario in (' . $ids_para_risco_0 . ')';
        $sql_edicao_riscos = 'select id from wal_funcionarios_riscos where id_funcionario in (' . $ids_para_risco_0 . ')';

        
        foreach ($pdo->query($sql_edicao_exames) as $value) {
            $idss[$contss] = $value['id'];
            ++$contss;
        }
        $ids_para_delete_exames = implode(",", $idss);
        $delete_exames = $pdo->query('DELETE FROM wal_funcionarios_exames WHERE id in (' . $ids_para_delete_exames . ')');
        
        foreach ($pdo->query($sql_edicao_riscos) as $value) {
            $idsss[$contsss] = $value['id'];
            ++$contsss;
        }
        $ids_para_delete_riscos = implode(",", $idsss);
        $delete_riscos = $pdo->query('DELETE FROM wal_funcionarios_riscos WHERE id in (' . $ids_para_delete_riscos . ')');

        $cont = 0;
        $cont_riscos = 0;
        $cont_exames = 0;
        $cont_exames_fim = 0;
        $sql_geral = 'select id from wal_funcionarios where risco = 0 and periodo in ("2016a") and id_wal_flags = ' . $riscos->get_bandeira() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo in (' . $riscos->get_cod_cargo() . ')';
        $sql_geral_exames = 'select id from wal_funcionarios where exame = 0 and periodo in ("2016a") and id_wal_flags = ' . $riscos->get_bandeira() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo in (' . $riscos->get_cod_cargo() . ')';
        if ($riscos->get_agente_fisico() === '1') {
            $agente_fisico = 'agente_fisico';
            $data_agente_fisico = $riscos->Dados_Riscos($agente_fisico);
            $id_agente_fisico = $data_agente_fisico['id'];
            $obs_agente_fisico = $riscos->get_obs_agente_fisico();
            foreach ($pdo->query($sql_geral) as $value) {
                $executa_agente_fisico = $pdo->query('INSERT INTO wal_funcionarios_riscos(id_funcionario,id_risco,obs_risco,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_agente_fisico . ',"' . $obs_agente_fisico . '",1,now())');
                if ($executa_agente_fisico) {
                    ++$cont;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_riscos = $cont > 0 ? ++$cont_riscos : 0;
            $cont = 0;
        } else {
            $cont = 0;
        }
        if ($outros_post === '1') {
            $outros = 'outros';
            $data_outros = $riscos->Dados_Riscos($outros);
            $id_outros = $data_outros['id'];
            $obs_outros = $obs_outros_post;
            foreach ($pdo->query($sql_geral) as $value) {
                $executa_outros = $pdo->query('INSERT INTO wal_funcionarios_riscos(id_funcionario,id_risco,obs_risco,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_outros . ',"' . $obs_outros . '",1,now())');
                if ($executa_outros) {
                    ++$cont;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_riscos = $cont > 0 ? ++$cont_riscos : 0;
            $cont = 0;
        } else {
            $cont = 0;
        }
        if ($riscos->get_agente_biologico() === '1') {
            $agente_biologico = 'agente_biologico';
            $data_agente_biologico = $riscos->Dados_Riscos($agente_biologico);
            $id_agente_biologico = $data_agente_biologico['id'];
            $obs_agente_biologico = $riscos->get_obs_agente_biologico();
            foreach ($pdo->query($sql_geral) as $value) {
                $executa_agente_biologico = $pdo->query('INSERT INTO wal_funcionarios_riscos(id_funcionario,id_risco,obs_risco,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_agente_biologico . ',"' . $obs_agente_biologico . '",1,now())');
                if ($executa_agente_biologico) {
                    ++$cont;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_riscos = $cont > 0 ? ++$cont_riscos : 0;
            $cont = 0;
        } else {
            $cont = 0;
        }
        if ($riscos->get_agente_ergonomico() === '1') {
            $agente_ergonomico = 'agente_ergonomico';
            $data_agente_ergonomico = $riscos->Dados_Riscos($agente_ergonomico);
            $id_agente_ergonomico = $data_agente_ergonomico['id'];
            $obs_agente_ergonomico = $riscos->get_obs_agente_ergonomico();
            foreach ($pdo->query($sql_geral) as $value) {
                $executa_agente_ergonomico = $pdo->query('INSERT INTO wal_funcionarios_riscos(id_funcionario,id_risco,obs_risco,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_agente_ergonomico . ',"' . $obs_agente_ergonomico . '",1,now())');
                if ($executa_agente_ergonomico) {
                    ++$cont;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_riscos = $cont > 0 ? ++$cont_riscos : 0;
            $cont = 0;
        } else {
            $cont = 0;
        }
        if ($riscos->get_agente_quimico() === '1') {
            $agente_quimico = 'agente_quimico';
            $data_agente_quimico = $riscos->Dados_Riscos($agente_quimico);
            $id_agente_quimico = $data_agente_quimico['id'];
            $obs_agente_quimico = $riscos->get_obs_agente_quimico();
            foreach ($pdo->query($sql_geral) as $value) {
                $executa_agente_quimico = $pdo->query('INSERT INTO wal_funcionarios_riscos(id_funcionario,id_risco,obs_risco,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_agente_quimico . ',"' . $obs_agente_quimico . '",1,now())');
                if ($executa_agente_quimico) {
                    ++$cont;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_riscos = $cont > 0 ? ++$cont_riscos : 0;
            $cont = 0;
        } else {
            $cont = 0;
        }
        if ($riscos->get_ausencia_de_risco() === '1') {
            $ausencia_de_risco = 'ausencia_de_risco';
            $data_ausencia_de_risco = $riscos->Dados_Riscos($ausencia_de_risco);
            $id_ausencia_de_risco = $data_ausencia_de_risco['id'];
            $obs_ausencia_de_risco = $riscos->get_obs_ausencia_de_risco();
            foreach ($pdo->query($sql_geral) as $value) {
                $executa_ausencia_de_risco = $pdo->query('INSERT INTO wal_funcionarios_riscos(id_funcionario,id_risco,obs_risco,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_ausencia_de_risco . ',"' . $obs_ausencia_de_risco . '",1,now())');
                if ($executa_ausencia_de_risco) {
                    ++$cont;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_riscos = $cont > 0 ? ++$cont_riscos : 0;
            $cont = 0;
        } else {
            $cont = 0;
        }
        #exames
        if ($riscos->get_exame_clinico() === '1') {
            $exame_clinico = 'exame_clinico';
            $data_exame_clinico = $riscos->Dados_Exames($exame_clinico);
            $id_exame_clinico = $data_exame_clinico['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_exame_clinico = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_exame_clinico . ',1,now())');
                if ($executa_exame_clinico) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_acido_metil_hipurico() === '1') {
            $acido_metil_hipurico = 'acido_metil_hipurico';
            $data_acido_metil_hipurico = $riscos->Dados_Exames($acido_metil_hipurico);
            $id_acido_metil_hipurico = $data_acido_metil_hipurico['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_acido_metil_hipurico = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_acido_metil_hipurico . ',1,now())');
                if ($executa_acido_metil_hipurico) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_hemograma() === '1') {
            $hemograma = 'hemograma';
            $data_hemograma = $riscos->Dados_Exames($hemograma);
            $id_hemograma = $data_hemograma['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_hemograma = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_hemograma . ',1,now())');
                if ($executa_hemograma) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_acido_mandelico() === '1') {
            $acido_mandelico = 'acido_mandelico';
            $data_acido_mandelico = $riscos->Dados_Exames($acido_mandelico);
            $id_acido_mandelico = $data_acido_mandelico['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_acido_mandelico = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_acido_mandelico . ',1,now())');
                if ($executa_acido_mandelico) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_vdrl() === '1') {
            $vdrl = 'vdrl';
            $data_vdrl = $riscos->Dados_Exames($vdrl);
            $id_vdrl = $data_vdrl['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_vdrl = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_vdrl . ',1,now())');
                if ($executa_vdrl) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_reticulocitos() === '1') {
            $reticulocitos = 'reticulocitos';
            $data_reticulocitos = $riscos->Dados_Exames($reticulocitos);
            $id_reticulocitos = $data_reticulocitos['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_reticulocitos = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_reticulocitos . ',1,now())');
                if ($executa_reticulocitos) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_parasitologico_fezes() === '1') {
            $parasitologico_fezes = 'parasitologico_fezes';
            $data_parasitologico_fezes = $riscos->Dados_Exames($parasitologico_fezes);
            $id_parasitologico_fezes = $data_parasitologico_fezes['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_parasitologico_fezes = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_parasitologico_fezes . ',1,now())');
                if ($executa_parasitologico_fezes) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_cultural_de_orofaringe() === '1') {
            $cultural_de_orofaringe = 'cultural_de_orofaringe';
            $data_cultural_de_orofaringe = $riscos->Dados_Exames($cultural_de_orofaringe);
            $id_cultural_de_orofaringe = $data_cultural_de_orofaringe['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_cultural_de_orofaringe = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_cultural_de_orofaringe . ',1,now())');
                if ($executa_cultural_de_orofaringe) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_coprocultura() === '1') {
            $coprocultura = 'coprocultura';
            $data_coprocultura = $riscos->Dados_Exames($coprocultura);
            $id_coprocultura = $data_coprocultura['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_coprocultura = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_coprocultura . ',1,now())');
                if ($executa_coprocultura) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_micologico_de_unha() === '1') {
            $micologico_de_unha = 'micologico_de_unha';
            $data_micologico_de_unha = $riscos->Dados_Exames($micologico_de_unha);
            $id_micologico_de_unha = $data_micologico_de_unha['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_micologico_de_unha = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_micologico_de_unha . ',1,now())');
                if ($executa_micologico_de_unha) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_audiometria() === '1') {
            $audiometria = 'audiometria';
            $data_audiometria = $riscos->Dados_Exames($audiometria);
            $id_audiometria = $data_audiometria['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_audiometria = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_audiometria . ',1,now())');
                if ($executa_audiometria) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_ecg() === '1') {
            $ecg = 'ecg';
            $data_ecg = $riscos->Dados_Exames($ecg);
            $id_ecg = $data_ecg['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_ecg = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_ecg . ',1,now())');
                if ($executa_ecg) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_acuidade_visual() === '1') {
            $acuidade_visual = 'acuidade_visual';
            $data_acuidade_visual = $riscos->Dados_Exames($acuidade_visual);
            $id_acuidade_visual = $data_acuidade_visual['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_acuidade_visual = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_acuidade_visual . ',1,now())');
                if ($executa_acuidade_visual) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_eeg() === '1') {
            $eeg = 'eeg';
            $data_eeg = $riscos->Dados_Exames($eeg);
            $id_eeg = $data_eeg['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_eeg = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_eeg . ',1,now())');
                if ($executa_eeg) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_plaquetas() === '1') {
            $plaquetas = 'plaquetas';
            $data_plaquetas = $riscos->Dados_Exames($plaquetas);
            $id_plaquetas = $data_plaquetas['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_plaquetas = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_plaquetas . ',1,now())');
                if ($executa_plaquetas) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_eritrograma() === '1') {
            $eritrograma = 'eritrograma';
            $data_eritrograma = $riscos->Dados_Exames($eritrograma);
            $id_eritrograma = $data_eritrograma['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_eritrograma = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_eritrograma . ',1,now())');
                if ($executa_eritrograma) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_acido_tt_muconico() === '1') {
            $acido_tt_muconico = 'acido_tt_muconico';
            $data_acido_tt_muconico = $riscos->Dados_Exames($acido_tt_muconico);
            $id_acido_tt_muconico = $data_acido_tt_muconico['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_acido_tt_muconico = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_acido_tt_muconico . ',1,now())');
                if ($executa_acido_tt_muconico) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_glicemia_em_jejum() === '1') {
            $glicemia_em_jejum = 'glicemia_em_jejum';
            $data_glicemia_em_jejum = $riscos->Dados_Exames($glicemia_em_jejum);
            $id_glicemia_em_jejum = $data_glicemia_em_jejum['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_glicemia_em_jejum = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_glicemia_em_jejum . ',1,now())');
                if ($executa_glicemia_em_jejum) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_acido_hipurico() === '1') {
            $acido_hipurico = 'acido_hipurico';
            $data_acido_hipurico = $riscos->Dados_Exames($acido_hipurico);
            $id_acido_hipurico = $data_acido_hipurico['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_acido_hipurico = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_acido_hipurico . ',1,now())');
                if ($executa_acido_hipurico) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_anti_hbs() === '1') {
            $anti_hbs = 'anti_hbs';
            $data_anti_hbs = $riscos->Dados_Exames($anti_hbs);
            $id_anti_hbs = $data_anti_hbs['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_anti_hbs = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_anti_hbs . ',1,now())');
                if ($executa_anti_hbs) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_hbs_ag() === '1') {
            $hbs_ag = 'hbs_ag';
            $data_hbs_ag = $riscos->Dados_Exames($hbs_ag);
            $id_hbs_ag = $data_hbs_ag['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_hbs_ag = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_hbs_ag . ',1,now())');
                if ($executa_hbs_ag) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_anti_hbc() === '1') {
            $anti_hbc = 'anti_hbc';
            $data_anti_hbc = $riscos->Dados_Exames($anti_hbc);
            $id_anti_hbc = $data_anti_hbc['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_anti_hbc = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_anti_hbc . ',1,now())');
                if ($executa_anti_hbc) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }

        if ($riscos->get_avaliacao_psicossocial() === '1') {
            $avaliacao_psicossocial = 'avaliacao_psicossocial';
            $data_avaliacao_psicossocial = $riscos->Dados_Exames($avaliacao_psicossocial);
            $id_avaliacao_psicossocial = $data_avaliacao_psicossocial['id'];
            foreach ($pdo->query($sql_geral_exames) as $value) {
                $executa_avaliacao_psicossocial = $pdo->query('INSERT INTO wal_funcionarios_exames(id_funcionario,id_exame,ativo,data_ultima_alteracao) VALUES (' . $value['id'] . ',' . $id_avaliacao_psicossocial . ',1,now())');
                if ($executa_avaliacao_psicossocial) {
                    ++$cont_exames;
                } else {
                    print_r($pdo->errorInfo());
                }
            }
            $cont_exames_fim = $cont_exames > 0 ? ++$cont_exames_fim : 0;
            $cont_exames = 0;
        } else {
            $cont_exames = 0;
        }
        $quantos_ativos = 0;

        if (($cont_riscos >= 1) and ( $cont_exames_fim >= 1)) {
            $sql_update_wal_funcionarios = 'select id from wal_funcionarios where id_wal_flags = ' . $riscos->get_bandeira() . '  and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo in (' . $riscos->get_cod_cargo() . ')';
            foreach ($pdo->query($sql_update_wal_funcionarios) as $value) {
                $executa_update = $pdo->query('update wal_funcionarios set risco = 1, exame = 1 where id = ' . $value['id']);
                ++$quantos_ativos;
            }
        }

        echo '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h2>Riscos e Exames Adicionados com Sucesso!!</h2><br>
                <p>Quantidade de Ativos com seus Riscos e Exames Cadastrados: <strong>' . $quantos_ativos . '</strong></p>
                <p>Quantidade de Riscos Cadastrados: <strong>' . $cont_riscos . '</strong></p>
                <p>Quantidade de Exames Cadastrados: <strong>' . $cont_exames_fim . '</strong></p>
              </div>';
    }
}
Database::disconnect();