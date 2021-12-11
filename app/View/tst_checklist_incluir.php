<?php
include '../config/database_mysql.php';
$pdo = Database::connect();
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca_tst_tipo_agendamento").load('tst_checklist_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca_tst_tipo_agendamento").load('tst_checklist_listar.php');
            }
        });
        
        $("#luz_emergencia_sim").is(":checked") === true ? $('#luz_emergencia_quantas').attr("disabled", true) : $('#luz_emergencia_quantas').attr("disabled", false);

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_CASSI").empty();
            var id_agendamento = $("#id_agendamento").val();
            var horario_trabalho = $("#horario_trabalho").val();
            var inicio_vistoria = $("#inicio_vistoria").val();
            var termino_vistoria = $("#termino_vistoria").val();
            var data_vistoria = $("#data_vistoria").val();
            var area_total = $("#area_total").val();
            var pe_direito = $("#pe_direito").val();
            var id_paredes = $("#id_paredes").val();
            var id_piso = $("#id_piso").val();
            var id_forro = $("#id_forro").val();
            var id_iluminacao = $("#id_iluminacao").val();
            var id_lampadas = $("#id_lampadas").val();
            var id_ventilacao = $("#id_ventilacao").val();
            var id_tst_checklist_controle_limpeza_arcondicionado = $("#id_tst_checklist_controle_limpeza_arcondicionado").val();
            var agua_pc = $("#agua_pc").val();
            var agua_validade = $("#agua_validade").val();
            var po_pc = $("#po_pc").val();
            var po_validade = $("#po_validade").val();
            var gas_pc = $("#gas_pc").val();
            var gas_validade = $("#gas_validade").val();            
            var luz_emergencia_sim = $("#luz_emergencia_sim").is(":checked") === true ? 1 : 0;
            var luz_emergencia_quantas = $("#luz_emergencia_quantas").val();
            var luz_emergencia_nao = $("#luz_emergencia_nao").is(":checked") === true ? 1 : 0;
            var id_saida_de_emergencia = $("#id_saida_de_emergencia").val();
            var id_tst_checklist_rota_saida_extintores = $("#id_tst_checklist_rota_saida_extintores").val();
            var numero_funcionarios_quantos = $("#numero_funcionarios_quantos").val();
            var numero_funcionarios_no_possui_cipa = $("#numero_funcionarios_no_possui_cipa").is(":checked") === true ? 1 : 0;
            var numero_funcionarios_possui_cipa = $("#numero_funcionarios_possui_cipa").is(":checked") === true ? 1 : 0;
            var numero_funcionarios_colaborador_designado = $("#numero_funcionarios_colaborador_designado").is(":checked") === true ? 1 : 0;
            var id_tst_checklist_epi = $("#id_tst_checklist_epi").val();
            var id_tst_checklist_trei_epi_epc = $("#id_tst_checklist_trei_epi_epc").val();
            var id_tst_checklist_entrega_epi = $("#id_tst_checklist_entrega_epi").val();
            var id_tst_checklist_insta_eletrica = $("#id_tst_checklist_insta_eletrica").val();
            var id_tst_checklist_atividades_ambiente = $("#id_tst_checklist_atividades_ambiente").val();
            var id_tst_checklist_atividades_ambiente_interno = $("#id_tst_checklist_atividades_ambiente_interno").val();
            var id_tst_checklist_refeicoes = $("#id_tst_checklist_refeicoes").val();
            var id_tst_checklist_local_refeicoes = $("#id_tst_checklist_local_refeicoes").val();
            var id_tst_checklist_insta_sanitarias = $("#id_tst_checklist_insta_sanitarias").val();
            var id_tst_checklist_pertence_funcionarios = $("#id_tst_checklist_pertence_funcionarios").val();
            var id_tst_checklist_avaliacao_ambiente_trab = $("#id_tst_checklist_avaliacao_ambiente_trab").val();
            var id_tst_checklist_seg_integracao = $("#id_tst_checklist_seg_integracao").val();
            var id_tst_checklist_trein_seg = $("#id_tst_checklist_trein_seg").val();
            var id_tecnicos = $("#id_tecnicos").val();
            var sugestao_melhoria = $("#sugestao_melhoria").val();

            if ($("#horario_trabalho").val() === '')
            {
                $("#horario_trabalho_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o horário de trabalho...</div>"),
                        $("#horario_trabalho").focus();
                return false;
            } else {
                $("#horario_trabalho_error").empty();
            }
            
            if ($("#inicio_vistoria").val() === '')
            {
                $("#inicio_vistoria_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Início da Vistoria...</div>"),
                $("#inicio_vistoria").focus();
                return false;
            } else {
                $("#inicio_vistoria_error").empty();
            }
            
            if ($("#termino_vistoria").val() === '')
            {
                $("#termino_vistoria_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Término da Vistoria...</div>"),
                $("#termino_vistoria").focus();
                return false;
            } else {
                $("#termino_vistoria_error").empty();
            }
            
            if ($("#data_vistoria").val() === '')
            {
                $("#data_vistoria_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a data da Vistoria...</div>"),
                $("#data_vistoria").focus();
                return false;
            } else {
                $("#data_vistoria_error").empty();
            }
            
            if ($("#area_total").val() === '')
            {
                $("#area_total_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe a área Total...</div>"),
                $("#area_total").focus();
                return false;
            } else {
                $("#area_total_error").empty();
            }
            
            if ($("#pe_direito").val() === '')
            {
                $("#pe_direito_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o Pé Direito...</div>"),
                $("#pe_direito").focus();
                return false;
            } else {
                $("#pe_direito_error").empty();
            }

            if ($("#id_paredes").val() === 'na')
            {
                $("#id_paredes_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_paredes").focus();
                return false;
            } else {
                $("#id_paredes_error").empty();
            }
            
            if ($("#id_piso").val() === 'na')
            {
                $("#id_piso_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_piso").focus();
                return false;
            } else {
                $("#id_piso_error").empty();
            }
            
            if ($("#id_forro").val() === 'na')
            {
                $("#id_forro_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_forro").focus();
                return false;
            } else {
                $("#id_forro_error").empty();
            }

            if ($("#id_iluminacao").val() === 'na')
            {
                $("#id_iluminacao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_iluminacao").focus();
                return false;
            } else {
                $("#id_iluminacao_error").empty();
            }

            if ($("#id_lampadas").val() === 'na')
            {
                $("#id_lampadas_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_lampadas").focus();
                return false;
            } else {
                $("#id_lampadas_error").empty();
            }
            
            if ($("#id_ventilacao").val() === 'na')
            {
                $("#id_ventilacao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_ventilacao").focus();
                return false;
            } else {
                $("#id_ventilacao_error").empty();
            }
            
            if ($("#id_tst_checklist_controle_limpeza_arcondicionado").val() === 'na')
            {
                $("#id_tst_checklist_controle_limpeza_arcondicionado_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_controle_limpeza_arcondicionado").focus();
                return false;
            } else {
                $("#id_tst_checklist_controle_limpeza_arcondicionado_error").empty();
            }
            
            if ($("#id_tst_checklist_controle_limpeza_arcondicionado").val() === 'na')
            {
                $("#id_tst_checklist_controle_limpeza_arcondicionado_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_controle_limpeza_arcondicionado").focus();
                return false;
            } else {
                $("#id_tst_checklist_controle_limpeza_arcondicionado_error").empty();
            }
            
            if ($("#agua_pc").val() === '')
            {
                $("#extintores_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                $("#agua_pc").focus();
                return false;
            } else {
                $("#extintores_error").empty();
            }
            
            if ($("#agua_validade").val() === '')
            {
                $("#extintores_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                $("#agua_validade").focus();
                return false;
            } else {
                $("#extintores_error").empty();
            }
            
            if ($("#po_pc").val() === '')
            {
                $("#extintores_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                $("#po_pc").focus();
                return false;
            } else {
                $("#extintores_error").empty();
            }
            
            if ($("#po_validade").val() === '')
            {
                $("#extintores_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                $("#po_validade").focus();
                return false;
            } else {
                $("#extintores_error").empty();
            }
            
            if ($("#gas_pc").val() === '')
            {
                $("#extintores_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                $("#gas_pc").focus();
                return false;
            } else {
                $("#extintores_error").empty();
            }
            
            if ($("#gas_validade").val() === '')
            {
                $("#extintores_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                $("#gas_validade").focus();
                return false;
            } else {
                $("#extintores_error").empty();
            }

            if ($("#id_saida_de_emergencia").val() === 'na')
            {
                $("#id_saida_de_emergencia_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_saida_de_emergencia").focus();
                return false;
            } else {
                $("#id_saida_de_emergencia_error").empty();
            }
            
            if ($("#id_tst_checklist_rota_saida_extintores").val() === 'na')
            {
                $("#id_tst_checklist_rota_saida_extintores_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_rota_saida_extintores").focus();
                return false;
            } else {
                $("#id_tst_checklist_rota_saida_extintores_error").empty();
            }
            
            if ($("#numero_funcionarios_quantos").val() === '')
            {
                $("#numero_funcionarios_quantos_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe o horário de trabalho...</div>"),
                        $("#numero_funcionarios_quantos").focus();
                return false;
            } else {
                $("#numero_funcionarios_quantos_error").empty();
            }
            
            if ($("#id_tst_checklist_epi").val() === 'na')
            {
                $("#id_tst_checklist_epi_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_epi").focus();
                return false;
            } else {
                $("#id_tst_checklist_epi_error").empty();
            }
            
            if ($("#id_tst_checklist_trei_epi_epc").val() === 'na')
            {
                $("#id_tst_checklist_trei_epi_epc_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_trei_epi_epc").focus();
                return false;
            } else {
                $("#id_tst_checklist_trei_epi_epc_error").empty();
            }
            
            if ($("#id_tst_checklist_entrega_epi").val() === 'na')
            {
                $("#id_tst_checklist_entrega_epi_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_entrega_epi").focus();
                return false;
            } else {
                $("#id_tst_checklist_entrega_epi_error").empty();
            }
            
            if ($("#id_tst_checklist_insta_eletrica").val() === 'na')
            {
                $("#id_tst_checklist_insta_eletrica_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_insta_eletrica").focus();
                return false;
            } else {
                $("#id_tst_checklist_insta_eletrica_error").empty();
            }
            
            if ($("#id_tst_checklist_atividades_ambiente").val() === 'na')
            {
                $("#id_tst_checklist_atividades_ambiente_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_atividades_ambiente").focus();
                return false;
            } else {
                $("#id_tst_checklist_atividades_ambiente_error").empty();
            }
            
            if ($("#id_tst_checklist_atividades_ambiente_interno").val() === 'na')
            {
                $("#id_tst_checklist_atividades_ambiente_interno_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_atividades_ambiente_interno").focus();
                return false;
            } else {
                $("#id_tst_checklist_atividades_ambiente_interno_error").empty();
            }
            
            if ($("#id_tst_checklist_refeicoes").val() === 'na')
            {
                $("#id_tst_checklist_refeicoes_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_refeicoes").focus();
                return false;
            } else {
                $("#id_tst_checklist_refeicoes_error").empty();
            }
            
            if ($("#id_tst_checklist_local_refeicoes").val() === 'na')
            {
                $("#id_tst_checklist_local_refeicoes_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_local_refeicoes").focus();
                return false;
            } else {
                $("#id_tst_checklist_local_refeicoes_error").empty();
            }
            
            if ($("#id_tst_checklist_insta_sanitarias").val() === 'na')
            {
                $("#id_tst_checklist_insta_sanitarias_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_insta_sanitarias").focus();
                return false;
            } else {
                $("#id_tst_checklist_insta_sanitarias_error").empty();
            }
            
            if ($("#id_tst_checklist_pertence_funcionarios").val() === 'na')
            {
                $("#id_tst_checklist_pertence_funcionarios_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_pertence_funcionarios").focus();
                return false;
            } else {
                $("#id_tst_checklist_pertence_funcionarios_error").empty();
            }
            
            if ($("#id_tst_checklist_avaliacao_ambiente_trab").val() === 'na')
            {
                $("#id_tst_checklist_avaliacao_ambiente_trab_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_avaliacao_ambiente_trab").focus();
                return false;
            } else {
                $("#id_tst_checklist_avaliacao_ambiente_trab_error").empty();
            }
            
            if ($("#id_tst_checklist_seg_integracao").val() === 'na')
            {
                $("#id_tst_checklist_seg_integracao_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_seg_integracao").focus();
                return false;
            } else {
                $("#id_tst_checklist_seg_integracao_error").empty();
            }
            
            if ($("#id_tst_checklist_trein_seg").val() === 'na')
            {
                $("#id_tst_checklist_trein_seg_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>"),
                        $("#id_tst_checklist_trein_seg").focus();
                return false;
            } else {
                $("#id_tst_checklist_trein_seg_error").empty();
            }

            if ($("#sugestao_melhoria").val() === '')
            {
                obs = 'Não Informado';
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/tst_checklist_incluir.php",
                data: "id_agendamento=" + id_agendamento + "&horario_trabalho=" + horario_trabalho + "&inicio_vistoria=" + inicio_vistoria + 
                        "&termino_vistoria=" + termino_vistoria + "&data_vistoria=" + data_vistoria + "&area_total=" + area_total + "&pe_direito=" + pe_direito + 
                        "&id_paredes=" + id_paredes + "&id_piso=" + id_piso + "&id_forro=" + id_forro + "&id_iluminacao=" + id_iluminacao + 
                        "&id_lampadas=" + id_lampadas + "&id_ventilacao=" + id_ventilacao + "&id_tst_checklist_controle_limpeza_arcondicionado=" + id_tst_checklist_controle_limpeza_arcondicionado + "&agua_pc=" + agua_pc + 
                        "&agua_validade=" + agua_validade + "&po_pc=" + po_pc + "&po_validade=" + po_validade + "&gas_pc=" + gas_pc + 
                        "&gas_validade=" + gas_validade + "&luz_emergencia_sim=" + luz_emergencia_sim + "&luz_emergencia_quantas=" + luz_emergencia_quantas + "&luz_emergencia_nao=" + luz_emergencia_nao + 
                        "&id_saida_de_emergencia=" + id_saida_de_emergencia + "&id_tst_checklist_rota_saida_extintores=" + id_tst_checklist_rota_saida_extintores + "&numero_funcionarios_quantos=" + numero_funcionarios_quantos + "&numero_funcionarios_no_possui_cipa=" + numero_funcionarios_no_possui_cipa + 
                        "&numero_funcionarios_possui_cipa=" + numero_funcionarios_possui_cipa + "&numero_funcionarios_colaborador_designado=" + numero_funcionarios_colaborador_designado + "&id_tst_checklist_epi=" + id_tst_checklist_epi + "&id_tst_checklist_trei_epi_epc=" + id_tst_checklist_trei_epi_epc + 
                        "&id_tst_checklist_entrega_epi=" + id_tst_checklist_entrega_epi + "&id_tst_checklist_insta_eletrica=" + id_tst_checklist_insta_eletrica + "&id_tst_checklist_atividades_ambiente=" + id_tst_checklist_atividades_ambiente + "&id_tst_checklist_atividades_ambiente_interno=" + id_tst_checklist_atividades_ambiente_interno + 
                        "&id_tst_checklist_refeicoes=" + id_tst_checklist_refeicoes + "&id_tst_checklist_local_refeicoes=" + id_tst_checklist_local_refeicoes + "&id_tst_checklist_insta_sanitarias=" + id_tst_checklist_insta_sanitarias + "&id_tst_checklist_pertence_funcionarios=" + id_tst_checklist_pertence_funcionarios + 
                        "&id_tst_checklist_avaliacao_ambiente_trab=" + id_tst_checklist_avaliacao_ambiente_trab + "&id_tst_checklist_seg_integracao=" + id_tst_checklist_seg_integracao + "&id_tst_checklist_trein_seg=" + id_tst_checklist_trein_seg + "&id_tecnicos=" + id_tecnicos + 
                        "&sugestao_melhoria=" + sugestao_melhoria,
                beforeSend: function () {
                    $("#conteudo_CASSI").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
                },
                success: function (response) {
                    $("#conteudo_CASSI").html(response),
                            $("#form")[0].reset(),
                            $("#refresca_tst_tipo_agendamento").load('tst_checklist_listar.php');
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">
    <h2><strong>Incluir</strong> Checklist TST</h2>
    <div class="additional-btn">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    </div>
</div>
<div class="modal-body">
    <div id="basic-form">
        <form id="form" method="POST">            
            <div class="form-group">
                <label for="label_data_agendamento">Horário de Trabalho:</label>
                <input type="time" class="form-control" id="horario_trabalho" name="horario_trabalho">
                <input type="hidden" id="id_agendamento" name="id_agendamento" value="<?php echo $id; ?>">
                <div class="form-inline" id="horario_trabalho_error"></div>
            </div>
            <div class="form-group">
                <label for="label_data_agendamento">Início Vistoria:</label>
                <input type="time" class="form-control" id="inicio_vistoria" name="inicio_vistoria">
                <div class="form-inline" id="inicio_vistoria_error"></div>
            </div>
            <div class="form-group">
                <label for="label_data_agendamento">Término Vistoria:</label>
                <input type="time" class="form-control" id="termino_vistoria" name="termino_vistoria">
                <div class="form-inline" id="termino_vistoria_error"></div>
            </div>
            <div class="form-group">
                <label for="label_data_agendamento">Data Vistoria:</label>
                <input type="date" class="form-control" id="data_vistoria" name="data_vistoria">
                <div class="form-inline" id="data_vistoria_error"></div>
            </div>
            <div class="form-group">
                <label for="label_data_agendamento">Área Total:</label>
                <input type="text" class="form-control" id="area_total" name="area_total">
                <div class="form-inline" id="area_total_error"></div>
            </div>
            <div class="form-group">
                <label for="label_data_agendamento">Pé Direito:</label>
                <input type="text" class="form-control" id="pe_direito" name="pe_direito">
                <div class="form-inline" id="pe_direito_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Paredes:</label>
                <select class="form-control" id="id_paredes" name="id_paredes">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql0 = "select id, itens from tst_checklist_paredes where status in (1) order by itens asc";
                    foreach ($pdo->query($sql0) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_paredes_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Piso:</label>
                <select class="form-control" id="id_piso" name="id_piso">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql1 = "select id, itens from tst_checklist_piso where status in (1) order by itens asc";
                    foreach ($pdo->query($sql1) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_piso_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Forro:</label>
                <select class="form-control" id="id_forro" name="id_forro">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql2 = "select id, itens from tst_checklist_forro where status in (1) order by itens asc";
                    foreach ($pdo->query($sql2) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_forro_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Iluminação:</label>
                <select class="form-control" id="id_iluminacao" name="id_iluminacao">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql3 = "select id, itens from tst_checklist_iluminacao where status in (1) order by itens asc";
                    foreach ($pdo->query($sql3) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_iluminacao_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Lampadas:</label>
                <select class="form-control" id="id_lampadas" name="id_lampadas">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql4 = "select id, itens from tst_checklist_lampadas where status in (1) order by itens asc";
                    foreach ($pdo->query($sql4) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_lampadas_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Ventilação:</label>
                <select class="form-control" id="id_ventilacao" name="id_ventilacao">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql5 = "select id, itens from tst_checklist_ventilacao where status in (1) order by itens asc";
                    foreach ($pdo->query($sql5) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_ventilacao_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Controle de Limpeza Filtros Ar Condicionado:</label>
                <select class="form-control" id="id_tst_checklist_controle_limpeza_arcondicionado" name="id_tst_checklist_controle_limpeza_arcondicionado">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql6 = "select id, itens from tst_checklist_controle_limpeza_arcondicionado where status in (1) order by itens asc";
                    foreach ($pdo->query($sql6) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_controle_limpeza_arcondicionado_error"></div>
            </div>
            <div class="form-group">
                <label for="label_data_agendamento">Extintores:</label>
                <table class="table table-noborder table-message">
                    <tr>
                        <td>Água</td>
                        <td><input type="text" class="form-control" id="agua_pc" name="agua_pc"></td>
                        <td><input type="date" class="form-control" id="agua_validade" name="agua_validade"></td>
                    </tr>
                    <tr>
                        <td>Pó Químico</td>
                        <td><input type="text" class="form-control" id="po_pc" name="po_pc"></td>
                        <td><input type="date" class="form-control" id="po_validade" name="po_validade"></td>
                    </tr>
                    <tr>
                        <td>Gás Carbonico</td>
                        <td><input type="text" class="form-control" id="gas_pc" name="gas_pc"></td>
                        <td><input type="date" class="form-control" id="gas_validade" name="gas_validade"></td>
                    </tr>
                </table>                
                <div class="form-inline" id="extintores_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Luzes de Emergência:</label>                
                <table>
                    <tr>
                        <td>                                
                            <input type="checkbox" id="luz_emergencia_sim" name="luz_emergencia_sim"> Sim                                
                        </td>
                        <td>                                
                            Quantas?<input type="text" id="luz_emergencia_quantas" name="luz_emergencia_quantas">
                        </td>
                        <td>                                
                            <input type="checkbox" id="luz_emergencia_nao" name="luz_emergencia_nao"> Não                                
                        </td>
                    </tr>
                </table>                
                <div class="form-inline" id="id_luzes_emergencia_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Saída de Emergência:</label>
                <select class="form-control" id="id_saida_de_emergencia" name="id_saida_de_emergencia">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql7 = "select id, itens from tst_checklist_saida_emerg where status in (1) order by itens asc";
                    foreach ($pdo->query($sql7) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_saida_de_emergencia_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Sinalização Rota, Saída, Extintores:</label>
                <select class="form-control" id="id_tst_checklist_rota_saida_extintores" name="id_tst_checklist_rota_saida_extintores">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql8 = "select id, itens from tst_checklist_rota_saida_extintores where status in (1) order by itens asc";
                    foreach ($pdo->query($sql8) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_rota_saida_extintores_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Número de Funcionários:</label>                
                <table>
                    <tr>
                        <td>                                
                            Quantidade?<input type="text" id="numero_funcionarios_quantos" name="numero_funcionarios_quantos">
                        </td>
                        <td>
                            <input type="checkbox" id="numero_funcionarios_no_possui_cipa" name="numero_funcionarios_no_possui_cipa"> Não Possui CIPA
                        </td>
                        <td>                                
                            <input type="checkbox" id="numero_funcionarios_possui_cipa" name="numero_funcionarios_possui_cipa"> Possui CIPA
                        </td>
                        <td>                                
                            <input type="checkbox" id="numero_funcionarios_colaborador_designado" name="numero_funcionarios_colaborador_designado"> Colaborador Designado
                        </td>
                    </tr>
                </table>                
                <div class="form-inline" id="id_num_funcionarios_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">EPI:</label>
                <select class="form-control" id="id_tst_checklist_epi" name="id_tst_checklist_epi">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql9 = "select id, itens from tst_checklist_epi where status in (1) order by itens asc";
                    foreach ($pdo->query($sql9) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_epi_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Treinamento de EPI e EPC:</label>
                <select class="form-control" id="id_tst_checklist_trei_epi_epc" name="id_tst_checklist_trei_epi_epc">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql10 = "select id, itens from tst_checklist_trei_epi_epc where status in (1) order by itens asc";
                    foreach ($pdo->query($sql10) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_trei_epi_epc_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Utiliza Ficha de Entrega de EPI:</label>
                <select class="form-control" id="id_tst_checklist_entrega_epi" name="id_tst_checklist_entrega_epi">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql11 = "select id, itens from tst_checklist_entrega_epi where status in (1) order by itens asc";
                    foreach ($pdo->query($sql11) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_entrega_epi_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Instalação Elétrica:</label>
                <select class="form-control" id="id_tst_checklist_insta_eletrica" name="id_tst_checklist_insta_eletrica">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql12 = "select id, itens from tst_checklist_insta_eletrica where status in (1) order by itens asc";
                    foreach ($pdo->query($sql12) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_entrega_epi_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">As atividades são realizadas em ambiente:</label>
                <select class="form-control" id="id_tst_checklist_atividades_ambiente" name="id_tst_checklist_atividades_ambiente">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql13 = "select id, itens from tst_checklist_atividades_ambiente where status in (1) order by itens asc";
                    foreach ($pdo->query($sql13) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_atividades_ambiente_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Ambiente interno:</label>
                <select class="form-control" id="id_tst_checklist_atividades_ambiente_interno" name="id_tst_checklist_atividades_ambiente_interno">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql14 = "select id, itens from tst_checklist_atividades_ambiente_interno where status in (1) order by itens asc";
                    foreach ($pdo->query($sql14) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_atividades_ambiente_interno_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Refeições:</label>
                <select class="form-control" id="id_tst_checklist_refeicoes" name="id_tst_checklist_refeicoes">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql15 = "select id, itens from tst_checklist_refeicoes where status in (1) order by itens asc";
                    foreach ($pdo->query($sql15) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_refeicoes_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Local para refeições, refeitório, cozinha:</label>
                <select class="form-control" id="id_tst_checklist_local_refeicoes" name="id_tst_checklist_local_refeicoes">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql16 = "select id, itens from tst_checklist_local_refeicoes where status in (1) order by itens asc";
                    foreach ($pdo->query($sql16) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_refeicoes_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Instalações Sanitárias:</label>
                <select class="form-control" id="id_tst_checklist_insta_sanitarias" name="id_tst_checklist_insta_sanitarias">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql17 = "select id, itens from tst_checklist_insta_sanitarias where status in (1) order by itens asc";
                    foreach ($pdo->query($sql17) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_insta_sanitarias_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Armários para guarda dos pertences dos funcionários:</label>
                <select class="form-control" id="id_tst_checklist_pertence_funcionarios" name="id_tst_checklist_pertence_funcionarios">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql18 = "select id, itens from tst_checklist_pertence_funcionarios where status in (1) order by itens asc";
                    foreach ($pdo->query($sql18) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_pertence_funcionarios_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Avaliação geral ambiente de trabalho:</label>
                <select class="form-control" id="id_tst_checklist_avaliacao_ambiente_trab" name="id_tst_checklist_avaliacao_ambiente_trab">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql19 = "select id, itens from tst_checklist_avaliacao_ambiente_trab where status in (1) order by itens asc";
                    foreach ($pdo->query($sql19) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_avaliacao_ambiente_trab_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">A empresa incorpora Segurança na Integração:</label>
                <select class="form-control" id="id_tst_checklist_seg_integracao" name="id_tst_checklist_seg_integracao">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql20 = "select id, itens from tst_checklist_seg_integracao where status in (1) order by itens asc";
                    foreach ($pdo->query($sql20) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_seg_integracao_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">A empresa realiza algum tipo de treinamento de segurança:</label>
                <select class="form-control" id="id_tst_checklist_trein_seg" name="id_tst_checklist_trein_seg">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql21 = "select id, itens from tst_checklist_trein_seg where status in (1) order by itens asc";
                    foreach ($pdo->query($sql21) as $value) {
                        echo '<option value="' . $value['id'] . '">' . utf8_encode($value['itens']) . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_tst_checklist_trein_seg_error"></div>
            </div>
            <div class="form-group">
                <label for="label_uf">Vistoriador:</label>
                <select multiple class="form-control" id="id_tecnicos" name="id_tecnicos">
                    <option selected value="na">
                        Selecione...
                    </option>
                    <?php
                    $sql22 = "select nome, id from tst_tecnicos where status in (1) order by nome asc";
                    foreach ($pdo->query($sql22) as $value) {
                        echo '<option value="' . $value['id'] . '">' . $value['nome'] . '</option>';
                    }
                    ?>
                </select>
                <div class="form-inline" id="id_cargo_error"></div>
            </div>
            <div class="form-group">
                <label for="label_obs">Sugestão de Melhoria:</label>
                <textarea class="form-control" id="sugestao_melhoria" name="sugestao_melhoria" placeholder="Informe aqui, dados adicionais!!"></textarea>
                <div class="form-inline" id="obs_error"></div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-pinterest pull-right" id="envia" type="submit">Salvar Checklist <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
            </div>
            <?php Database::disconnect(); ?>
        </form>
    </div>
</div>
<div class="modal-footer">
    <div id="conteudo_CASSI"></div>
</div>