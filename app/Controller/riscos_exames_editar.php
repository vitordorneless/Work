<?php

include '../config/database_mysql.php';
include '../../class/alertas.php';
require '../Model/Riscos.php';
require '../Model/Riscos_Operations.php';
$pdo = Database::connect();
$riscos = new Riscos_Operations();
$data_ultima_alteracao = date('Y-m-d H:i:s');
$riscos->set_loja(filter_input(INPUT_POST, 'loja', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_cod_cargo(filter_input(INPUT_POST, 'cod_cargo', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_depto(filter_input(INPUT_POST, 'depto', FILTER_SANITIZE_NUMBER_INT));

$riscos->set_agente_fisico(filter_input(INPUT_POST, 'agente_fisico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_agente_quimico(filter_input(INPUT_POST, 'agente_quimico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_agente_biologico(filter_input(INPUT_POST, 'agente_biologico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_agente_ergonomico(filter_input(INPUT_POST, 'agente_ergonomico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_ausencia_de_risco(filter_input(INPUT_POST, 'ausencia_de_risco', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_obs_agente_fisico(filter_input(INPUT_POST, 'obs_agente_fisico', FILTER_SANITIZE_STRING));
$riscos->set_obs_agente_quimico(filter_input(INPUT_POST, 'obs_agente_quimico', FILTER_SANITIZE_STRING));
$riscos->set_obs_agente_biologico(filter_input(INPUT_POST, 'obs_agente_biologico', FILTER_SANITIZE_STRING));
$riscos->set_obs_agente_ergonomico(filter_input(INPUT_POST, 'obs_agente_ergonomico', FILTER_SANITIZE_STRING));
$riscos->set_obs_ausencia_de_risco(filter_input(INPUT_POST, 'obs_ausencia_de_risco', FILTER_SANITIZE_STRING));
$riscos->set_exame_clinico(filter_input(INPUT_POST, 'exame_clinico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_acido_metil_hipurico(filter_input(INPUT_POST, 'acido_metil_hipurico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_hemograma(filter_input(INPUT_POST, 'hemograma', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_acido_mandelico(filter_input(INPUT_POST, 'acido_mandelico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_vdrl(filter_input(INPUT_POST, 'vdrl', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_reticulocitos(filter_input(INPUT_POST, 'reticulocitos', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_parasitologico_fezes(filter_input(INPUT_POST, 'parasitologico_fezes', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_cultural_de_orofaringe(filter_input(INPUT_POST, 'cultural_de_orofaringe', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_coprocultura(filter_input(INPUT_POST, 'coprocultura', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_micologico_de_unha(filter_input(INPUT_POST, 'micologico_de_unha', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_audiometria(filter_input(INPUT_POST, 'audiometria', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_ecg(filter_input(INPUT_POST, 'ecg', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_acuidade_visual(filter_input(INPUT_POST, 'acuidade_visual', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_eeg(filter_input(INPUT_POST, 'eeg', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_plaquetas(filter_input(INPUT_POST, 'plaquetas', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_eritrograma(filter_input(INPUT_POST, 'eritrograma', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_acido_tt_muconico(filter_input(INPUT_POST, 'acido_tt_muconico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_glicemia_em_jejum(filter_input(INPUT_POST, 'glicemia_em_jejum', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_acido_hipurico(filter_input(INPUT_POST, 'acido_hipurico', FILTER_SANITIZE_NUMBER_INT));
$riscos->set_avaliacao_psicossocial(filter_input(INPUT_POST, 'avaliacao_psicossocial', FILTER_SANITIZE_NUMBER_INT));

if (($riscos->get_agente_fisico() === '0') and ( $riscos->get_agente_biologico() === '0') and ( $riscos->get_agente_ergonomico() === '0')
        and ( $riscos->get_agente_quimico() === '0') and ( $riscos->get_ausencia_de_risco() === '0')) {
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
            and ( $riscos->get_glicemia_em_jejum() === '0') and ( $riscos->get_acido_hipurico() === '0') and ( $riscos->get_avaliacao_psicossocial() === '0')) {
        echo '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Preencha pelo Menos um Exame...</div>';
    } else {
        $cont = 0;
        $cont_riscos = 0;
        $cont_exames = 0;
        $cont_exames_fim = 0;
        if ($riscos->get_agente_fisico() === '1') {
            $agente_fisico = 'agente_fisico';
            $data_agente_fisico = $riscos->Dados_Riscos($agente_fisico);
            $id_agente_fisico = $data_agente_fisico['id'];
            alerta_2($id_agente_fisico);
            $sql_agente_fisico = 'select b.id as "id_risco" from wal_funcionarios a inner join wal_funcionarios_riscos b on a.id = b.id_funcionario where a.risco = 1 and a.cod_estabelecimento = ' . $riscos->get_loja() . ' and a.cod_depto = ' . $riscos->get_depto() . ' and a.cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_agente_fisico) as $value) {
                $sql_update_agente_fisico = 'UPDATE wal_funcionarios_riscos SET id_risco = ?, obs_risco = ?, ativo = ?, data_ultima_alteracao = ? where id = ?';
                $executa_agente_fisicos = $pdo->prepare($sql_update_agente_fisico);
                $executa_agente_fisico = $executa_agente_fisicos->execute(array($id_agente_fisico, $riscos->get_obs_agente_fisico(), 1, $data_ultima_alteracao, $value['id_risco']));
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
        if ($riscos->get_agente_biologico() === '1') {
            $agente_biologico = 'agente_biologico';
            $data_agente_biologico = $riscos->Dados_Riscos($agente_biologico);
            $id_agente_biologico = $data_agente_biologico['id'];
            $sql_agente_biologico = 'select b.id as "id_risco" from wal_funcionarios a inner join wal_funcionarios_riscos b on a.id = b.id_funcionario where a.risco = 1 and a.cod_estabelecimento = ' . $riscos->get_loja() . ' and a.cod_depto = ' . $riscos->get_depto() . ' and a.cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_agente_biologico) as $value) {
                $sql_update_agente_biologico = 'UPDATE wal_funcionarios_riscos SET id_risco = ?, obs_risco = ?, ativo = ?, data_ultima_alteracao = ? where id = ?';
                $executa_agente_biologicos = $pdo->prepare($sql_update_agente_biologico);
                $executa_agente_biologico = $executa_agente_biologicos->execute(array($id_agente_biologico, $riscos->get_obs_agente_biologico(), 1, $data_ultima_alteracao, $value['id_risco']));
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
            $sql_agente_ergonomico = 'select b.id as "id_risco" from wal_funcionarios a inner join wal_funcionarios_riscos b on a.id = b.id_funcionario where a.risco = 1 and a.cod_estabelecimento = ' . $riscos->get_loja() . ' and a.cod_depto = ' . $riscos->get_depto() . ' and a.cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_agente_ergonomico) as $value) {
                $sql_update_agente_ergonomico = 'UPDATE wal_funcionarios_riscos SET id_risco = ?, obs_risco = ?, ativo = ?, data_ultima_alteracao = ? where id = ?';
                $executa_agente_ergonomicos = $pdo->prepare($sql_update_agente_ergonomico);
                $executa_agente_ergonomico = $executa_agente_ergonomicos->execute(array($id_agente_ergonomico, $riscos->get_obs_agente_ergonomico(), 1, $data_ultima_alteracao, $value['id_risco']));
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
            $sql_agente_quimico = 'select b.id as "id_risco" from wal_funcionarios a inner join wal_funcionarios_riscos b on a.id = b.id_funcionario where a.risco = 1 and a.cod_estabelecimento = ' . $riscos->get_loja() . ' and a.cod_depto = ' . $riscos->get_depto() . ' and a.cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_agente_quimico) as $value) {
                $sql_update_agente_quimico = 'UPDATE wal_funcionarios_riscos SET id_risco = ?, obs_risco = ?, ativo = ?, data_ultima_alteracao = ? where id = ?';
                $executa_agente_quimicos = $pdo->prepare($sql_update_agente_quimico);
                $executa_agente_quimico = $executa_agente_quimicos->execute(array($id_agente_quimico, $riscos->get_obs_agente_quimico(), 1, $data_ultima_alteracao, $value['id_risco']));
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
            $sql_ausencia_de_risco = 'select b.id as "id_risco" from wal_funcionarios a inner join wal_funcionarios_riscos b on a.id = b.id_funcionario where a.risco = 1 and a.cod_estabelecimento = ' . $riscos->get_loja() . ' and a.cod_depto = ' . $riscos->get_depto() . ' and a.cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_ausencia_de_risco) as $value) {
                $sql_update_ausencia_de_risco = 'UPDATE wal_funcionarios_riscos SET id_risco = ?, obs_risco = ?, ativo = ?, data_ultima_alteracao = ? where id = ?';
                $executa_ausencia_de_riscos = $pdo->prepare($sql_update_ausencia_de_risco);
                $executa_ausencia_de_risco = $executa_ausencia_de_riscos->execute(array($id_ausencia_de_risco, $riscos->get_obs_ausencia_de_risco(), 1, $data_ultima_alteracao, $value['id_risco']));
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
            $sql_exame_clinico = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_exame_clinico) as $value) {
                $sql_update_exame_clinico = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_exame_clinicos = $pdo->prepare($sql_update_exame_clinico);
                $executa_exame_clinico = $executa_exame_clinicos->execute(array($id_exame_clinico, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_acido_metil_hipurico = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_acido_metil_hipurico) as $value) {
                $sql_update_acido_metil_hipurico = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_acido_metil_hipuricos = $pdo->prepare($sql_update_acido_metil_hipurico);
                $executa_acido_metil_hipurico = $executa_acido_metil_hipuricos->execute(array($id_acido_metil_hipurico, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_hemograma = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_hemograma) as $value) {
                $sql_update_hemograma = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_hemogramas = $pdo->prepare($sql_update_hemograma);
                $executa_hemograma = $executa_hemogramas->execute(array($id_hemograma, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_acido_mandelico = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_acido_mandelico) as $value) {
                $sql_update_acido_mandelico = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_acido_mandelicos = $pdo->prepare($sql_update_acido_mandelico);
                $executa_acido_mandelico = $executa_acido_mandelicos->execute(array($id_acido_mandelico, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_vdrl = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_vdrl) as $value) {
                $sql_update_vdrl = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_vdrls = $pdo->prepare($sql_update_vdrl);
                $executa_vdrl = $executa_vdrls->execute(array($id_vdrl, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_reticulocitos = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_reticulocitos) as $value) {
                $sql_update_reticulocitos = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_reticulocitoss = $pdo->prepare($sql_update_reticulocitos);
                $executa_reticulocitos = $executa_reticulocitoss->execute(array($id_reticulocitos, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_parasitologico_fezes = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_parasitologico_fezes) as $value) {
                $sql_update_parasitologico_fezes = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_parasitologico_fezess = $pdo->prepare($sql_update_parasitologico_fezes);
                $executa_parasitologico_fezes = $executa_parasitologico_fezess->execute(array($id_parasitologico_fezes, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_cultural_de_orofaringe = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_cultural_de_orofaringe) as $value) {
                $sql_update_cultural_de_orofaringe = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_cultural_de_orofaringes = $pdo->prepare($sql_update_cultural_de_orofaringe);
                $executa_cultural_de_orofaringe = $executa_cultural_de_orofaringes->execute(array($id_cultural_de_orofaringe, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_coprocultura = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_coprocultura) as $value) {
                $sql_update_coprocultura = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_coproculturas = $pdo->prepare($sql_update_coprocultura);
                $executa_coprocultura = $executa_coproculturas->execute(array($id_coprocultura, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_micologico_de_unha = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_micologico_de_unha) as $value) {
                $sql_update_micologico_de_unha = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_micologico_de_unhas = $pdo->prepare($sql_update_micologico_de_unha);
                $executa_micologico_de_unha = $executa_micologico_de_unhas->execute(array($id_micologico_de_unha, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_audiometria = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_audiometria) as $value) {
                $sql_update_audiometria = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_audiometrias = $pdo->prepare($sql_update_audiometria);
                $executa_audiometria = $executa_audiometrias->execute(array($id_audiometria, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_ecg = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_ecg) as $value) {
                $sql_update_ecg = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_ecgs = $pdo->prepare($sql_update_ecg);
                $executa_ecg = $executa_ecgs->execute(array($id_ecg, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_acuidade_visual = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_acuidade_visual) as $value) {
                $sql_update_acuidade_visual = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_acuidade_visuals = $pdo->prepare($sql_update_acuidade_visual);
                $executa_acuidade_visual = $executa_acuidade_visuals->execute(array($id_acuidade_visual, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_eeg = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_eeg) as $value) {
                $sql_update_eeg = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_eegs = $pdo->prepare($sql_update_eeg);
                $executa_eeg = $executa_eegs->execute(array($id_eeg, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_plaquetas = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_plaquetas) as $value) {
                $sql_update_plaquetas = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_plaquetass = $pdo->prepare($sql_update_plaquetas);
                $executa_plaquetas = $executa_plaquetass->execute(array($id_plaquetas, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_eritrograma = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_eritrograma) as $value) {
                $sql_update_eritrograma = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_eritrogramas = $pdo->prepare($sql_update_eritrograma);
                $executa_eritrograma = $executa_eritrogramas->execute(array($id_eritrograma, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_acido_tt_muconico = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_acido_tt_muconico) as $value) {
                $sql_update_acido_tt_muconico = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_acido_tt_muconicos = $pdo->prepare($sql_update_acido_tt_muconico);
                $executa_acido_tt_muconico = $executa_acido_tt_muconicos->execute(array($id_acido_tt_muconico, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_glicemia_em_jejum = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_glicemia_em_jejum) as $value) {
                $sql_update_glicemia_em_jejum = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_glicemia_em_jejums = $pdo->prepare($sql_update_glicemia_em_jejum);
                $executa_glicemia_em_jejum = $executa_glicemia_em_jejums->execute(array($id_glicemia_em_jejum, 1, $data_ultima_alteracao, $value['id']));
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
            $sql_acido_hipurico = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_acido_hipurico) as $value) {
                $sql_update_acido_hipurico = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_acido_hipuricos = $pdo->prepare($sql_update_acido_hipurico);
                $executa_acido_hipurico = $executa_acido_hipuricos->execute(array($id_acido_hipurico, 1, $data_ultima_alteracao, $value['id']));
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
        
        if ($riscos->get_avaliacao_psicossocial() === '1') {
            $avaliacao_psicossocial = 'avaliacao_psicossocial';
            $data_avaliacao_psicossocial = $riscos->Dados_Exames($avaliacao_psicossocial);
            $id_avaliacao_psicossocial = $data_avaliacao_psicossocial['id'];
            $sql_avaliacao_psicossocial = 'select id from wal_funcionarios where exame = 1 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_avaliacao_psicossocial) as $value) {
                $sql_update_avaliacao_psicossocial = 'UPDATE wal_funcionarios_exames SET id_exame = ?, ativo = ?, data_ultima_alteracao = ? where id_funcionario = ?';
                $executa_avaliacao_psicossocials = $pdo->prepare($sql_update_avaliacao_psicossocial);
                $executa_avaliacao_psicossocial = $executa_avaliacao_psicossocials->execute(array($id_avaliacao_psicossocial, 1, $data_ultima_alteracao, $value['id']));
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
        $quantos_ativos = $riscos->Quantos_Ativos_eu_peguei($riscos->get_loja(), $riscos->get_cod_cargo());

        if (($cont_riscos >= 1) and ( $cont_exames_fim >= 1)) {
            $sql_update_wal_funcionarios = 'select id from wal_funcionarios where cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_update_wal_funcionarios) as $value) {
                $executa_update = $pdo->query('update wal_funcionarios set risco = 1, exame = 1 where id = ' . $value['id']);
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