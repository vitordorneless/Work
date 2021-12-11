<?php

class Queries {

    public function prospeccao_listar($id_prestador) {
        $sql = "select id_prestador, id_medico, data_prospeccao, historico_prospeccao, valor_exame, user, lojas_negociadas 
                from prospeccao_medicos                
                where id_prestador in (" . $id_prestador . ")
                order by id_prestador, data_prospeccao desc, id_medico";
        return $sql;
    }

    public function prospeccao_listar_prestador($id_prestador) {
        $sql = "select razao_social from wal_prestadores where id in (" . $id_prestador . ") order by id";
        return $sql;
    }

    public function prospeccao_listar_medico($id_medico) {
        $sql = "select nome from wal_medico where id_medico in (" . $id_medico . ") limit 1";
        return $sql;
    }

    public function prospeccao_listar_user($id) {
        $sql = "select nome_extenso from usuarios where id in (" . $id . ")";
        return $sql;
    }

    public function dmed_listar($ref) {
        $sql = "select id,data,data_dmed,RPPSS,cpf_RPPSS,BRPPSS,cpf_BRPPSS,dn,valor,recibo,unidade 
                from dmed
                where SUBSTRING(data_dmed, 1, 4) = '" . $ref . "' order by RPPSS ASC";
        return $sql;
    }

    public function gerar_contrato_prestador() {
        $sql = "select a.razao_social as razao_social, a.cnpj as cnpj, concat(a.endereco,',',a.numero,', complemento ',a.complemento) as ende, a.bairro as bairro,
                concat(b.nom_cidade,'/',c.sgl_estado) as cidade, a.CEP as cep, a.data_cadastro as data_cadastro, a.valor_consulta as valor_consulta 
                from wal_prestadores a 
                inner join cidade b on b.id = a.id_cidade
                inner join estado c on c.cod_estado = a.id_estado_UF
                where a.id = ?";
        return $sql;
    }

    public function listar_contrato_prestador() {
        $sql = "select nome,cnpj,rua,bairro,cidade,data_cadastro,valor,vigencia_start,vigencia_end from wal_contratos_emitidos order by nome asc";
        return $sql;
    }

    public function listar_kit_convocacao() {
        $sql = "select convoquim.nome_convocacao as convocacao,  lojinha.desc_estabelecimento as loja,
                eventche.turnos as turnos, eventche.kit_entregue as kit, eventche.status as situacao,
                eventche.id as id_evento 
                from evento_convocacao eventche
                inner join convocacao convoquim on convoquim.id = eventche.id_convocacao
                inner join wal_estabelecimento lojinha on lojinha.cod_estabelecimento = eventche.loja
                where eventche.kit_entregue in (0,1) and eventche.periodo not in ('2015') 
                order by convoquim.nome_convocacao, eventche.kit_entregue";
        return $sql;
    }

    public function listar_convocacao() {
        $sql = "select convoquim.nome_convocacao as convocacao,  lojinha.desc_estabelecimento as loja,
                eventche.turnos as turnos, eventche.kit_entregue as kit, eventche.status as situacao,
                eventche.id as id_evento
                from evento_convocacao eventche                 
                inner join convocacao convoquim on convoquim.id = eventche.id_convocacao
                inner join wal_estabelecimento_2016 lojinha on lojinha.cod_estabelecimento = eventche.loja 
                where eventche.periodo not in ('2014','2015') and eventche.status in (1)
                order by convoquim.nome_convocacao, eventche.kit_entregue";
        return $sql;
    }

    public function listar_arquivo_offline_upados() {
        $sql = "select nome_arquivo,nome_medico,crm from offline_uploads order by nome_arquivo asc";
        return $sql;
    }

    public function listar_pcmso_coord() {
        $sql = "select id, nome, cargo, conselho, crm from pcmso_coordenadores order by nome asc";
        return $sql;
    }

    public function registro_rel_bradesco($nome_arquivo) {
        $sql = "select id, nome_arquivo, data_retorno_webtran, arquivo_sig, data_arquivo_sig,
                header_geral, header_apolice, apolice, data_transmissao, tipo_registro, numero_registro_R,
                conteudo_R, brancos_R, numero_registro_E, cod_erro_E, descricao_erro_E, sequencia_E, brancos_E
                from retorno_critica_bradesco_webtran
                where tipo_registro in ('R','*') and nome_arquivo = '" . $nome_arquivo . "'
                order by id asc";
        return $sql;
    }

    public function registro_rel_bradesco_e($nome_arquivo, $registro_r) {
        $sql = "select id, nome_arquivo, data_retorno_webtran, arquivo_sig, data_arquivo_sig,
                            header_geral, header_apolice, apolice, data_transmissao, tipo_registro, numero_registro_R,
                            conteudo_R, brancos_R, numero_registro_E, cod_erro_E, descricao_erro_E, sequencia_E, brancos_E
                            from retorno_critica_bradesco_webtran 
                            where tipo_registro in ('E') and nome_arquivo = '" . $nome_arquivo . "' AND numero_registro_E = '" . $registro_r . "' 
                            order by id asc";
        return $sql;
    }

    public function registro_rel_bradesco_sql_9($cert) {
        $sql = "SELECT DISTINCT CDPESSOAFUNC, NRSEQDEP FROM AMA_CODBENEFTERC where CODIGO LIKE '%" . $cert . "%'";
        return $sql;
    }

    public function registro_rel_bradesco_sql_10($cdpe, $seq) {
        $sql = "SELECT NOPESSOABENEF,NOTITULAR,NRMATRICULA,NRCPFTITULAR,CDPESSOAUNID 
                FROM VW_BENEFICIARIO WHERE CDPESSOAFUNC in ('" . $cdpe . "')  and NRSEQDEP in (" . $seq . ")";
        return $sql;
    }

    public function registro_rel_bradesco_sql_11($matriculas) {
        $sql = "SELECT NOTITULAR, NRCPF, CDPESSOAUNID,NRMATRICULA FROM VW_BENEFICIARIO WHERE NRMATRICULA in ('" . $matriculas . "') and NRSEQDEP in (0)";
        return $sql;
    }

    public function registro_rel_bradesco_sql_13($cdpessoaunid) {
        $sql = "select NOPESSOAUNID from VW_UNIDADE where CDPESSOAUNID =  '" . $cdpessoaunid . "'";
        return $sql;
    }

    public function consolidado() {
        $sql = "select id, razao_social, if(CNES = 0,'NÃƒÂ£o Informado',CNES) as CNES, data_cadastro, "
                . "valor_consulta, valor_consulta_2, valor_consulta_3 from wal_prestadores where id not in (1,2) order by razao_social asc";
        return $sql;
    }

    public function consolidado_sql_medico($id) {
        $sql = "select id_medico, nome, crm, conselho, if(CNES = 0,'NÃƒÂ£o Informado',CNES) as CNES from wal_medico where id_prestador = " . $id;
        return $sql;
    }

    public function consolidado_sql_medico_tem($id) {
        $sql = "select count(*) as tem from wal_medico where id_prestador = " . $id;
        return $sql;
    }

    public function consolidado_sql_medico_valor($crm) {
        $sql = "select consulta from medicos_valores_exames where crm = " . $crm;
        return $sql;
    }

    public function cassi_solicitante_listar() {
        $sql = "select nome, id, status from cassi_solicitante order by nome asc";
        return $sql;
    }

    public function cargos_empresas_listar() {
        $sql = "select id, cargo from cargos_empresas where status in (1)";
        return $sql;
    }

    public function rel_anual_listar_unidades() {
        $sql = "select distinct cod_estabelecimento from wal_funcionarios where flg_periodico in (1) and periodo in ('2015') order by cod_estabelecimento asc";
        return $sql;
    }

    public function rel_anual_listar_unidades2016() {
        $sql = "select distinct cod_estabelecimento from wal_funcionarios where flg_periodico in (1) and periodo in ('2016a') order by cod_estabelecimento asc";
        return $sql;
    }

    public function dmed_gerar($nome) {
        $sql = "select id, data, data_dmed, RPPSS,cpf_BRPPSS, cpf_RPPSS, BRPPSS, dn, sum(valor) as valor,recibo
                from dmed_centro 
                where SUBSTRING(data_dmed, 1, 4) = " . $nome . "  
                and cpf_BRPPSS not in ('0') and cpf_RPPSS not in ('0','') and BRPPSS in ('MESMO')
                group by cpf_RPPSS
                order by cpf_RPPSS asc, STR_TO_DATE(dn,'%Y%m%d') asc";
        return $sql;
    }

    public function dmed_dependentes($nome, $cpf) {
        $sql = "select id, data, data_dmed, RPPSS,cpf_BRPPSS, cpf_RPPSS, BRPPSS, dn, sum(valor) as valor,recibo
                from dmed_centro 
                where SUBSTRING(data_dmed, 1, 4) = '" . $nome . "'  
                and BRPPSS != 'MESMO' and cpf_RPPSS in ('" . $cpf . "')
                group by BRPPSS
                order by cpf_RPPSS asc, STR_TO_DATE(dn,'%Y%m%d') asc";
        return $sql;
    }

    public function rel_anual_listar_lojas($lojas, $periodo) {
        if ($periodo === '2015') {
            $sql = "select cod_estabelecimento, desc_estabelecimento from wal_estabelecimento where cod_estabelecimento in (" . $lojas . ") order by desc_estabelecimento asc";
        } else {
            $sql = "select cod_estabelecimento, desc_estabelecimento from wal_estabelecimento_2016 where cod_estabelecimento in (" . $lojas . ") order by desc_estabelecimento asc";
        }
        return $sql;
    }

    public function rel_anual_listar_setores($loja, $periodo) {
        if ($periodo === '2015') {
            $sql = "select distinct b.desc_depto as setor, a.cod_depto as cod_depto 
                from wal_funcionarios a 
                inner join wal_departamento b on b.cod_depto = a.cod_depto
                where a.cod_estabelecimento in (" . $loja . ") 
                order by b.desc_depto";
        } else {
            $sql = "select distinct b.desc_depto as setor, a.cod_depto as cod_depto 
                from wal_funcionarios a 
                inner join wal_departamento_2016 b on b.cod_depto = a.cod_depto
                where a.cod_estabelecimento in (" . $loja . ") 
                order by b.desc_depto";
        }
        return $sql;
    }

    public function rel_anual_listar_exames($loja, $cod_depto, $periodo) {
        if ($periodo === '2015') {
            $sql = "select 
                    count(case when data_periodico <> '0000-00-00 00:00:00' then 1 end) as Exame_clinico,
                    count(case when comp_ACIDO_METIL_HIPURICO <> '0000-00-00 00:00:00' then 1 end) acido_metil_hipurico,
                    count(case when id_ACIDO_METIL_HIPURICO = 2 then 1 end) acido_metil_hipurico_alterado,
                    count(case when comp_HEMOGRAMA <> '0000-00-00 00:00:00' then 1 end) HEMOGRAMA,
                    count(case when id_HEMOGRAMA = 2 then 1 end) HEMOGRAMA_alterado,
                    count(case when comp_ACIDO_MANDELICO <> '0000-00-00 00:00:00' then 1 end) ACIDO_MANDELICO,
                    count(case when id_ACIDO_MANDELICO = 2 then 1 end) ACIDO_MANDELICO_alterado,
                    count(case when comp_VDRL <> '0000-00-00 00:00:00' then 1 end) VDRL,
                    count(case when id_VDRL = 2 then 1 end) VDRL_alterado,
                    count(case when comp_RETICULOCITOS <> '0000-00-00 00:00:00' then 1 end) RETICULOCITOS,
                    count(case when id_RETICULOCITOS = 2 then 1 end) RETICULOCITOS_alterado,
                    count(case when comp_PARASITOLOGICO_FEZES <> '0000-00-00 00:00:00' then 1 end) PARASITOLOGICO_FEZES,
                    count(case when id_PARASITOLOGICO_FEZES = 2 then 1 end) PARASITOLOGICO_FEZES_alterado,
                    count(case when comp_CULTURAL_DE_OROFARINGE <> '0000-00-00 00:00:00' then 1 end) CULTURAL_DE_OROFARINGE,
                    count(case when id_CULTURAL_DE_OROFARINGE = 2 then 1 end) CULTURAL_DE_OROFARINGE_alterado,
                    count(case when comp_COPROCULTURA <> '0000-00-00 00:00:00' then 1 end) COPROCULTURA,
                    count(case when id_COPROCULTURA = 2 then 1 end) COPROCULTURA_alterado,
                    count(case when comp_MICOLOGICO_DE_UNHA <> '0000-00-00 00:00:00' then 1 end) MICOLOGICO_DE_UNHA,
                    count(case when id_MICOLOGICO_DE_UNHA = 2 then 1 end) MICOLOGICO_DE_UNHA_alterado,
                    count(case when comp_AUDIOMETRIA <> '0000-00-00 00:00:00' then 1 end) AUDIOMETRIA,
                    count(case when id_AUDIOMETRIA = 2 then 1 end) AUDIOMETRIA_alterado,
                    count(case when comp_ECG <> '0000-00-00 00:00:00' then 1 end) ECG,
                    count(case when id_ECG = 2 then 1 end) ECG_alterado,
                    count(case when comp_ACUIDADE_VISUAL <> '0000-00-00 00:00:00' then 1 end) ACUIDADE_VISUAL,
                    count(case when id_ACUIDADE_VISUAL = 2 then 1 end) ACUIDADE_VISUAL_alterado,
                    count(case when comp_EEG <> '0000-00-00 00:00:00' then 1 end) EEG,
                    count(case when id_EEG = 2 then 1 end) EEG_alterado,
                    count(case when comp_PLAQUETAS <> '0000-00-00 00:00:00' then 1 end) PLAQUETAS,
                    count(case when id_PLAQUETAS = 2 then 1 end) PLAQUETAS_alterado,
                    count(case when comp_ERITROGRAMA <> '0000-00-00 00:00:00' then 1 end) ERITROGRAMA,
                    count(case when id_ERITROGRAMA = 2 then 1 end) ERITROGRAMA_alterado,
                    count(case when comp_ACIDO_TT_MUCONICO <> '0000-00-00 00:00:00' then 1 end) ACIDO_TT_MUCONICO,
                    count(case when id_ACIDO_TT_MUCONICO = 2 then 1 end) ACIDO_TT_MUCONICO_alterado,
                    count(case when comp_GLICEMIA_EM_JEJUM <> '0000-00-00 00:00:00' then 1 end) GLICEMIA_EM_JEJUM,
                    count(case when id_GLICEMIA_EM_JEJUM = 2 then 1 end) GLICEMIA_EM_JEJUM_alterado,
                    count(case when comp_ACIDO_HIPURICO <> '0000-00-00 00:00:00' then 1 end) ACIDO_HIPURICO,
                    count(case when id_ACIDO_HIPURICO = 2 then 1 end) ACIDO_HIPURICO_alterado,
                    count(case when comp_AVALIACAO_PSICOSSOCIAL <> '0000-00-00 00:00:00' then 1 end) AVALIACAO_PSICOSSOCIAL,
                    count(case when id_AVALIACAO_PSICOSSOCIAL = 2 then 1 end) AVALIACAO_PSICOSSOCIAL_alterado
                from wal_funcionarios
                where flg_periodico in (1) and periodo in ('2015') and cod_estabelecimento in (" . $loja . ") and cod_depto in (" . $cod_depto . ")";
        } else {
            $sql = "select 
                    count(case when data_periodico <> '0000-00-00 00:00:00' then 1 end) as Exame_clinico,
                    count(case when comp_ACIDO_METIL_HIPURICO <> '0000-00-00 00:00:00' then 1 end) acido_metil_hipurico,
                    count(case when id_ACIDO_METIL_HIPURICO = 2 then 1 end) acido_metil_hipurico_alterado,
                    count(case when comp_HEMOGRAMA <> '0000-00-00 00:00:00' then 1 end) HEMOGRAMA,
                    count(case when id_HEMOGRAMA = 2 then 1 end) HEMOGRAMA_alterado,
                    count(case when comp_ACIDO_MANDELICO <> '0000-00-00 00:00:00' then 1 end) ACIDO_MANDELICO,
                    count(case when id_ACIDO_MANDELICO = 2 then 1 end) ACIDO_MANDELICO_alterado,
                    count(case when comp_VDRL <> '0000-00-00 00:00:00' then 1 end) VDRL,
                    count(case when id_VDRL = 2 then 1 end) VDRL_alterado,
                    count(case when comp_RETICULOCITOS <> '0000-00-00 00:00:00' then 1 end) RETICULOCITOS,
                    count(case when id_RETICULOCITOS = 2 then 1 end) RETICULOCITOS_alterado,
                    count(case when comp_PARASITOLOGICO_FEZES <> '0000-00-00 00:00:00' then 1 end) PARASITOLOGICO_FEZES,
                    count(case when id_PARASITOLOGICO_FEZES = 2 then 1 end) PARASITOLOGICO_FEZES_alterado,
                    count(case when comp_CULTURAL_DE_OROFARINGE <> '0000-00-00 00:00:00' then 1 end) CULTURAL_DE_OROFARINGE,
                    count(case when id_CULTURAL_DE_OROFARINGE = 2 then 1 end) CULTURAL_DE_OROFARINGE_alterado,
                    count(case when comp_COPROCULTURA <> '0000-00-00 00:00:00' then 1 end) COPROCULTURA,
                    count(case when id_COPROCULTURA = 2 then 1 end) COPROCULTURA_alterado,
                    count(case when comp_MICOLOGICO_DE_UNHA <> '0000-00-00 00:00:00' then 1 end) MICOLOGICO_DE_UNHA,
                    count(case when id_MICOLOGICO_DE_UNHA = 2 then 1 end) MICOLOGICO_DE_UNHA_alterado,
                    count(case when comp_AUDIOMETRIA <> '0000-00-00 00:00:00' then 1 end) AUDIOMETRIA,
                    count(case when id_AUDIOMETRIA = 2 then 1 end) AUDIOMETRIA_alterado,
                    count(case when comp_ECG <> '0000-00-00 00:00:00' then 1 end) ECG,
                    count(case when id_ECG = 2 then 1 end) ECG_alterado,
                    count(case when comp_ACUIDADE_VISUAL <> '0000-00-00 00:00:00' then 1 end) ACUIDADE_VISUAL,
                    count(case when id_ACUIDADE_VISUAL = 2 then 1 end) ACUIDADE_VISUAL_alterado,
                    count(case when comp_EEG <> '0000-00-00 00:00:00' then 1 end) EEG,
                    count(case when id_EEG = 2 then 1 end) EEG_alterado,
                    count(case when comp_PLAQUETAS <> '0000-00-00 00:00:00' then 1 end) PLAQUETAS,
                    count(case when id_PLAQUETAS = 2 then 1 end) PLAQUETAS_alterado,
                    count(case when comp_ERITROGRAMA <> '0000-00-00 00:00:00' then 1 end) ERITROGRAMA,
                    count(case when id_ERITROGRAMA = 2 then 1 end) ERITROGRAMA_alterado,
                    count(case when comp_ACIDO_TT_MUCONICO <> '0000-00-00 00:00:00' then 1 end) ACIDO_TT_MUCONICO,
                    count(case when id_ACIDO_TT_MUCONICO = 2 then 1 end) ACIDO_TT_MUCONICO_alterado,
                    count(case when comp_GLICEMIA_EM_JEJUM <> '0000-00-00 00:00:00' then 1 end) GLICEMIA_EM_JEJUM,
                    count(case when id_GLICEMIA_EM_JEJUM = 2 then 1 end) GLICEMIA_EM_JEJUM_alterado,
                    count(case when comp_ACIDO_HIPURICO <> '0000-00-00 00:00:00' then 1 end) ACIDO_HIPURICO,
                    count(case when id_ACIDO_HIPURICO = 2 then 1 end) ACIDO_HIPURICO_alterado,
                    count(case when comp_AVALIACAO_PSICOSSOCIAL <> '0000-00-00 00:00:00' then 1 end) AVALIACAO_PSICOSSOCIAL,
                    count(case when id_AVALIACAO_PSICOSSOCIAL = 2 then 1 end) AVALIACAO_PSICOSSOCIAL_alterado
                from wal_funcionarios
                where flg_periodico in (1) and periodo in ('2016a') and cod_estabelecimento in (" . $loja . ") and cod_depto in (" . $cod_depto . ")";
        }
        return $sql;
    }

    public function listar_bandeiras() {
        $sql = "select id, bandeira from wal_flags where status in (1) order by bandeira asc";
        return $sql;
    }

    public function listar_setores_por_bandeira($bandeira) {
        $sql = "select distinct a.cod_depto as setor
                from wal_funcionarios a                
                where a.periodo in ('2016a') and a.id_wal_flags in (" . $bandeira . ")
                order by a.cod_depto";
        return $sql;
    }

    public function listar_setores_por_bandeira_nomes($cod_depto) {
        $sql = 'select desc_depto from wal_departamento where data_ultima_alteracao in ("2016-04-20 15:12:09") and cod_depto = "' . $cod_depto . '"';
        return $sql;
    }

    public function listar_cargos_por_bandeira($setor, $bandeira) {
        $sql = "select distinct a.cod_cargo as cargo
                from wal_funcionarios a                
                where a.periodo in ('2016a') and a.cod_depto in ('" . $setor . "') and a.id_wal_flags in (" . $bandeira . ")
                order by a.cod_cargo";
        return $sql;
    }

    public function listar_cargos_por_bandeira_nomes($cod_cargo) {
        $sql = 'select cod_cargo, desc_cargo from wal_cargo_2016 where cod_cargo = "' . $cod_cargo . '"';
        return $sql;
    }

    public function listar_prestadores($estado) {
        $sql = 'select a.id as id, a.razao_social as razao_social, b.nom_estado as estado 
                from wal_prestadores a
                inner join estado b on a.id_estado_UF = b.cod_estado
                where a.id_estado_UF = ' . $estado . '
                order by a.razao_social asc';
        return $sql;
    }

    public function listar_prestadores_lojas($lojas) {
        $sql = 'select a.id as id, a.razao_social as razao_social, b.nom_estado as estado 
                from wal_prestadores a
                inner join estado b on a.id_estado_UF = b.cod_estado
                where a.id = ' . $lojas . '
                order by a.razao_social asc';
        return $sql;
    }

    public function listar_medicos_via_prestador($id_prestador) {
        $sql = 'select a.nome as nome, a.crm as crm, b.funcao as funcao 
                from wal_medico a
                inner join wal_funcao_medico b on a.id_funcao = b.id_funcao
                where a.id_prestador = ' . $id_prestador . '
                order by a.nome asc';
        return $sql;
    }

    public function listar_processor_bandeiras($bandeira, $cod_depto, $cod_cargo) {
        $sql = 'select id from wal_funcionarios where periodo in ("2016a") and risco = 0 and id_wal_flags = ' . $bandeira . ' and cod_depto = ' . $cod_depto . ' and cod_cargo in (' . $cod_cargo . ')';
        return $sql;
    }

    public function listar_processor_bandeiras_exames($bandeira, $cod_depto, $cod_cargo) {
        $sql = 'select id from wal_funcionarios where periodo in ("2016a") and exame = 0 and id_wal_flags = ' . $bandeira . ' and cod_depto = ' . $cod_depto . ' and cod_cargo in (' . $cod_cargo . ')';
        return $sql;
    }

    public function lista_nominal($empresa, $estabelecimento) {
        $sql = "select cod_estabelecimento,nome_funcionario,cpf,identidade,cod_cargo,cod_depto,nascimento 
                from wal_funcionarios
                where periodo in ('2016a') and year(admissao) <> 2016 and cod_empresa in (" . $empresa . ")
                and cod_estabelecimento in (" . $estabelecimento . ")
                order by cod_estabelecimento asc, nome_funcionario, cod_depto, cod_cargo";
        return $sql;
    }

    public function listar_cargos_por_bandeira_editar($setor, $bandeira) {
        $sql = "select distinct a.cod_cargo as cargo
                from wal_funcionarios a                
                where a.periodo in ('2016a') and a.risco in (1) and a.exame in (1) 
                and a.cod_depto in (" . $setor . ") and a.id_wal_flags in (" . $bandeira . ")
                order by a.cod_cargo";
        return $sql;
    }

    public function listar_id_referencia($bandeira, $setor, $cargo) {//arrumar aqui, tem qeu executar essa querie
        $sql = "select funfun.id as id_funcionario
                from wal_funcionarios funfun
                where funfun.periodo in ('2016a') and funfun.id_wal_flags = '$bandeira'
                and funfun.cod_depto = '$setor' and funfun.cod_cargo = '$cargo'
                and funfun.exame = 1 and funfun.risco = 1
                limit 1";
        return $sql;
    }

    public function listar_setores_cargos($bandeira) {
        $sql = "select distinct cod_cargo, cod_depto  
                from wal_funcionarios 
                where periodo in ('2016a') and id_wal_flags in (" . $bandeira . ")
                order by cod_depto, cod_cargo";
        return $sql;
    }

    public function listar_setores($cod_depto) {
        $sql = "select desc_depto from wal_departamento where data_ultima_alteracao in ('2016-04-20 15:12:09') and cod_depto in (" . $cod_depto . ")";
        return $sql;
    }

    public function listar_tem_risco($id_funcionario) {
        $sql = "select count(id) as tem from wal_funcionarios_riscos where id_funcionario in (" . $id_funcionario . ") order by id desc";
        return $sql;
    }

    public function listar_tem_exame($id_funcionario) {
        $sql = "select count(id) as tem from wal_funcionarios_exames where id_funcionario in (" . $id_funcionario . ") order by id desc";
        return $sql;
    }

    public function listar_pegar_um_id($bandeira, $cod_depto, $cod_cargo) {
        $sql = "select id 
                from wal_funcionarios 
                where periodo in ('2016a') and id_wal_flags in (" . $bandeira . ") and cod_depto in (" . $cod_depto . ") and cod_cargo in (" . $cod_cargo . ")                
                limit 1";
        return $sql;
    }

    public function listar_um_id_risco($id_funcionario) {
        $sql = "select b.risco_extenso as risco_extenso, a.obs_risco as obs_risco
                from wal_funcionarios_riscos a 
                inner join riscos b on a.id_risco = b.id
                where a.id_funcionario in (" . $id_funcionario . ") 
                order by a.id desc";
        return $sql;
    }

    public function listar_um_id_exame($id_funcionario) {
        $sql = "select b.exame_extenso as exame_extenso 
                from wal_funcionarios_exames a
                inner join exames b on a.id_exame = b.id
                where a.id_funcionario in (" . $id_funcionario . ")
                order by b.exame_extenso desc";
        return $sql;
    }

    public function Cassi_Agencia() {
        $sql = "select id, prefixo, dependencia, municipio, jurisdicao from cassi_agencia where status in (1) and prefixo = ? order by dependencia asc";
        return $sql;
    }

    public function Cassi_Agenda() {
        $sql = "select if(agenda.data_agendamento = '',0,DATE_FORMAT(agenda.data_agendamento, '%d/%c/%Y')) as data_agendamento, 
             agenda.horario as horario, situation.desc_situacao as situacao, medico.nome as obs 
             from cassi_agendamento agenda             
             inner join cassi_situacao situation on situation.id = agenda.id_cassi_situacao
             inner join wal_medico medico on medico.id_medico = agenda.id_medico
             where agenda.status in (1) and agenda.municipio = ?
             limit 1";
        return $sql;
    }

    public function excel_CASSI_desc_situacao() {
        $sql = "select desc_situacao from cassi_situacao where id = ?";
        return $sql;
    }

    public function excel_CASSI() {
        $sql = "select 'PRESTADOR - AMA' as prestador_ama, ativos.matricula as matricula, ativos.nome_ativo as funci, ativos.prefixo_agencia as prefixo,         
        if(ativos.id_sexo = 2,'F','M') as sexo, ativos.data_nascimento as data_nascimento,
        ativos.id_cassi_situacao as situacao, ativos.obs as obs, ativos.prefixo_agencia as prefixo_agencia 
        from cassi_ativos ativos         
        where ativos.status in (1) 
        order by ativos.id asc";
        return $sql;
    }

    public function estados_top_5() {
        $sql = "select count(a.id) as quantos, b.estado as uf
                from evento_convocacao a
                inner join wal_estabelecimento_2016 b on a.loja = b.cod_estabelecimento
                where year(a.data_ultima_alteracao) = 2016
                group by b.estado
                order by quantos desc
                limit 3";
        return $sql;
    }

    public function bandeira_top_5() {
        $sql = "select count(a.id) as temos, b.bandeira as bandeira 
                from wal_funcionarios a 
                inner join wal_flags b on a.id_wal_flags = b.id
                where a.periodo in ('2016a')
                group by a.id_wal_flags
                order by temos desc
                limit 5";
        return $sql;
    }

    public function exames_top_5() {
        $sql = "select count(a.id) as temos, b.exame_extenso as exame
                from wal_funcionarios_exames a
                inner join exames b on a.id_exame = b.id
                where a.id_exame not in (1) and year(a.data_ultima_alteracao) = 2016
                group by a.id_exame
                order by temos desc
                limit 5";
        return $sql;
    }

    public function usuarios_setor() {
        $sql = "select id,setor from usuarios_setores order by setor";
        return $sql;
    }

    public function Responsavel_Demanda($id) {
        $sql = "select id,nome_extenso from usuarios where setor in (" . $id . ") order by nome_extenso";
        return $sql;
    }

    public function Executantes_demanda() {
        $sql = "select id,nome_extenso from usuarios where status in (1) and setor not in (27,28,29,30,31) order by setor, nome_extenso";
        return $sql;
    }

    public function demanda_admin_listar_status() {
        $sql = "select id, status from demandas_status order by status asc";
        return $sql;
    }

    public function demanda_admin_listar_tiposs($setor) {
        $sql = "select id,tipo_demanda,sla,id_setor,user_executante,status from demandas_tipos_de_demandas where id_setor = " . $setor . " order by tipo_demanda";
        return $sql;
    }

    public function demanda_admin_listar_tipos() {
        $sql = "select a.id as id,a.tipo_demanda as tipo_demanda,a.sla as sla,b.setor as setor,a.status as status 
                from demandas_tipos_de_demandas a
                inner join usuarios_setores b on a.id_setor = b.id
                order by a.tipo_demanda";
        return $sql;
    }

    public function demanda_admin_listar_prazos() {
        $sql = "select id,prazo,tipo,status from demandas_prazos order by prazo asc";
        return $sql;
    }

    public function demanda_admin_listar_prazos_sla() {
        $sql = "select id, concat(prazo,' ',tipo) as prazo from demandas_prazos where status in (1) order by prazo asc";
        return $sql;
    }

    public function combo_demanda() {
        $sql = "select id, concat(prazo,' ',tipo) as prazo from demandas_prazos where status in (1) order by substring(3,0,tipo) desc";
        return $sql;
    }

    public function listar_demanda() {
        $sql = "select id,id_user_abertura,id_user_abertura_setor,destino_setor,id_responsavel,executantes,id_demanda,id_prazo,id_status,data_ultima_alteracao, data_fechamento from demandas order by id_status asc";
        return $sql;
    }

    public function listar_demanda_user($setor) {
        $sql = "select id,id_user_abertura,id_user_abertura_setor,destino_setor,id_responsavel,executantes,id_demanda,id_prazo,id_status,data_ultima_alteracao, data_fechamento from demandas where id_user_abertura_setor = " . $setor . " order by id_status asc";
        return $sql;
    }

    public function listar_demanda_userr($user) {
        $sql = "select id,id_user_abertura,id_user_abertura_setor,destino_setor,id_responsavel,executantes,id_demanda,id_prazo,id_status,data_ultima_alteracao, data_fechamento from demandas where id_user_abertura = " . $user . " order by id_status asc";
        return $sql;
    }

    public function listar_demanda_com_setor($setor) {
        $sql = "select id,id_user_abertura,id_user_abertura_setor,destino_setor,id_responsavel,executantes,id_demanda,id_prazo,id_status,data_ultima_alteracao from demandas where destino_setor = " . $setor . " order by id_status asc";
        return $sql;
    }

    public function listar_demanda_executante($id) {
        $sql = "select id,id_user_abertura,id_user_abertura_setor,destino_setor,id_responsavel,executantes,id_demanda,id_prazo,id_status,data_ultima_alteracao from demandas where id_status not in (2,3) and executantes = " . $id . " order by id_status asc";
        return $sql;
    }

    public function listar_demanda_executante_index($id) {
        $sql = "select id,id_user_abertura,id_user_abertura_setor,destino_setor,id_responsavel,executantes,id_demanda,id_prazo,id_status,data_ultima_alteracao from demandas where id_status not in (2,3) and executantes = " . $id . " order by id_status asc limit 3";
        return $sql;
    }

    public function listar_criador($id) {
        $sql = "select nome_extenso from usuarios where id = " . $id;
        return $sql;
    }

    public function listar_responsavel($id) {
        $sql = "select nome_extenso from usuarios where id = " . $id;
        return $sql;
    }

    public function listar_executante($id) {
        $sql = "select nome_extenso from usuarios where id = " . $id;
        return $sql;
    }

    public function listar_setores_usuarios($id) {
        $sql = "select id, setor, status from usuarios_setores where id = " . $id;
        return $sql;
    }

    public function listar_demanda_list($id) {
        $sql = "select tipo_demanda,sla from demandas_tipos_de_demandas where id = " . $id;
        return $sql;
    }

    public function status_list($id) {
        $sql = "select status from demandas_status where id = " . $id;
        return $sql;
    }

    public function status_list_all() {
        $sql = "select id, status from demandas_status order by status asc";
        return $sql;
    }

    public function status_list_all_quality() {
        $sql = "select id, status from demandas_status_qualidade order by id asc";
        return $sql;
    }

    public function status_prazo($id) {
        $sql = "select concat(prazo,' ',tipo) as prazim, prazo, tipo from demandas_prazos where status in (1) and id = " . $id;
        return $sql;
    }

    public function demandas_execute($id_demanda) {
        $sql = "select id_demanda,id_executante,obs,id_status_clone_demanda,id_status_qualidade,data_ultima_alteracao from demandas_execute where id_demanda = " . $id_demanda;
        return $sql;
    }

    public function demandas_execute_tenho($id_demanda) {
        $sql = "select count(id_demanda) as temos from demandas_execute where id_demanda = " . $id_demanda;
        return $sql;
    }

    public function listar_executantes_setor($setor) {
        $sql = "select id, nome_extenso from usuarios where status in (1) and setor = " . $setor;
        return $sql;
    }

    public function demandas_empresas_combo() {
        $sql = "select valuess, optionn from demandas_empresas_combo order by optionn asc";
        return $sql;
    }

    public function grafico_barra_setor($setor) {
        $sql = "select b.nome_extenso as nome, sum(if(a.id_status=1,1,0)) as abertos, sum(if(a.id_status=2,1,0)) as fechados 
                from demandas a
                inner join usuarios b on a.executantes = b.id
                where a.destino_setor = " . $setor . "
                group by b.nome_extenso
                order by b.nome_extenso";
        return $sql;
    }
    
    public function grafico_barra_setor_Geral() {
        $sql = "select b.nome_extenso as nome, sum(if(a.id_status=1,1,0)) as abertos, sum(if(a.id_status=2,1,0)) as fechados 
                from demandas a
                inner join usuarios b on a.executantes = b.id                
                group by b.nome_extenso
                order by b.nome_extenso";
        return $sql;
    }

    public function grafico_barra_setor_que_mais_pede($setor) {
        $sql = "select b.setor as setor,sum(if(a.id_status=1,1,0)) as abertos, sum(if(a.id_status=2,1,0)) as fechados
                from demandas a
                inner join usuarios_setores b on a.id_user_abertura_setor = b.id
                where destino_setor = " . $setor . " and id_user_abertura_setor not in (" . $setor . ")
                group by a.id_user_abertura_setor
                order by b.setor asc";
        return $sql;
    }
    
    public function grafico_barra_setor_que_mais_pede_Geral() {
        $sql = "select b.setor as setor,sum(if(a.id_status=1,1,0)) as abertos, sum(if(a.id_status=2,1,0)) as fechados
                from demandas a
                inner join usuarios_setores b on a.id_user_abertura_setor = b.id                
                group by a.id_user_abertura_setor
                order by b.setor asc";
        return $sql;
    }

    public function top_five_demandas($setor) {
        $sql = "select b.tipo_demanda as tipo_demanda, count(a.id) as demandas
                from demandas a
                inner join demandas_tipos_de_demandas b on a.id_demanda = b.id
                where a.destino_setor = " . $setor . "
                group by b.tipo_demanda
                order by demandas desc
                limit 5";
        return $sql;
    }
    
    public function top_five_demandas_Geral() {
        $sql = "select b.tipo_demanda as tipo_demanda, count(a.id) as demandas
                from demandas a
                inner join demandas_tipos_de_demandas b on a.id_demanda = b.id                
                group by b.tipo_demanda
                order by demandas desc
                limit 5";
        return $sql;
    }

}
