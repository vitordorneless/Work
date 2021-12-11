<?php
include '../config/database_mysql.php';
require '../Model/Riscos.php';
require '../Model/Riscos_Operations.php';

$pdo = Database::connect();
$riscos = new Riscos_Operations();

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
$riscos->set_avaliacao_psicossocial(filter_input(INPUT_POST, 'avaliacao_psicossocial', FILTER_SANITIZE_NUMBER_INT));
$outros_post = filter_input(INPUT_POST, 'outros', FILTER_SANITIZE_NUMBER_INT);
$obs_outros_post = filter_input(INPUT_POST, 'obs_outros', FILTER_SANITIZE_STRING);

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
            $obs_agente_fisico = $riscos->get_obs_agente_fisico();
            $sql_agente_fisico = 'select id from wal_funcionarios where risco = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_agente_fisico) as $value) {
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
            $sql_outros = 'select id from wal_funcionarios where risco = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_outros) as $value) {
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
            $sql_agente_biologico = 'select id from wal_funcionarios where risco = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_agente_biologico) as $value) {
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
            $sql_agente_ergonomico = 'select id from wal_funcionarios where risco = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_agente_ergonomico) as $value) {
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
            $sql_agente_quimico = 'select id from wal_funcionarios where risco = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_agente_quimico) as $value) {
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
            $sql_ausencia_de_risco = 'select id from wal_funcionarios where risco = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_ausencia_de_risco) as $value) {
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
            $sql_exame_clinico = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_exame_clinico) as $value) {
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
            $sql_acido_metil_hipurico = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_acido_metil_hipurico) as $value) {
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
            $sql_hemograma = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_hemograma) as $value) {
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
            $sql_acido_mandelico = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_acido_mandelico) as $value) {
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
            $sql_vdrl = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_vdrl) as $value) {
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
            $sql_reticulocitos = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_reticulocitos) as $value) {
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
            $sql_parasitologico_fezes = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_parasitologico_fezes) as $value) {
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
            $sql_cultural_de_orofaringe = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_cultural_de_orofaringe) as $value) {
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
            $sql_coprocultura = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_coprocultura) as $value) {
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
            $sql_micologico_de_unha = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_micologico_de_unha) as $value) {
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
            $sql_audiometria = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_audiometria) as $value) {
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
            $sql_ecg = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_ecg) as $value) {
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
            $sql_acuidade_visual = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_acuidade_visual) as $value) {
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
            $sql_eeg = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_eeg) as $value) {
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
            $sql_plaquetas = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_plaquetas) as $value) {
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
            $sql_eritrograma = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_eritrograma) as $value) {
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
            $sql_acido_tt_muconico = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_acido_tt_muconico) as $value) {
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
            $sql_glicemia_em_jejum = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_glicemia_em_jejum) as $value) {
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
            $sql_acido_hipurico = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_acido_hipurico) as $value) {
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
        
        if ($riscos->get_avaliacao_psicossocial() === '1') {
            $avaliacao_psicossocial = 'avaliacao_psicossocial';
            $data_avaliacao_psicossocial = $riscos->Dados_Exames($avaliacao_psicossocial);
            $id_avaliacao_psicossocial = $data_avaliacao_psicossocial['id'];
            $sql_avaliacao_psicossocial = 'select id from wal_funcionarios where exame = 0 and cod_estabelecimento = ' . $riscos->get_loja() . ' and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
            foreach ($pdo->query($sql_avaliacao_psicossocial) as $value) {
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
        $quantos_ativos = $riscos->Quantos_Ativos_eu_peguei($riscos->get_loja(), $riscos->get_cod_cargo());

        if (($cont_riscos >= 1) and ( $cont_exames_fim >= 1)) {
            $sql_update_wal_funcionarios = 'select id from wal_funcionarios where cod_estabelecimento = ' . $riscos->get_loja() . '  and cod_depto = ' . $riscos->get_depto() . ' and cod_cargo = ' . $riscos->get_cod_cargo();
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