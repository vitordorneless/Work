$(document).ready(function () {
    $("#abrir_demanda").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Demandas</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demanda_include.php');
    });
    
    $("#abrir_demandaa").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Demandas</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demanda_include.php');
    });
    
    $("#transferir_demanda").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Demandas</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demanda_transfer.php');
    });
    
    $("#demandas_admin_status").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Demandas</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demandas_admin_status_listar.php');
    });
    
    $("#demandas_admin_tipo_demandas").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Demandas</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demandas_admin_tipo_demandas_listar.php');
    });
    
    $("#demandas_admin_prazos").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Demandas</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demandas_admin_prazos_listar.php');
    });
    
    $("#listar_demanda").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");        
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Demandas</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demanda_list.php');
    });
    
    $("#executar_demanda").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Demandas</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demanda_execute_list.php');
    });
    
    $("#demandas_admin_status_ver").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Demandas</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demandas_admin_status.php');
    });
    
    $("#demandas_admin_indicadores").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Demandas</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demandas_admin_indicadores.php');
    });
    
    $("#demandas_vincular_funcionario").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Demandas</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demandas_vincular_funcionario.php');
    });    
    
    $("#trocar_senha").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");        
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Configurações</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('trocar_senha.php');
    });
    
    $("#usuario_adicionar").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");                
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Configurações</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('usuarios_adicionar.php');
    });
    
    $("#usuario_listar").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");                
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Configurações</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('usuarios_listar.php');
    });
    
    $("#adicionar_permissao").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");                
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Configurações</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('adicionar_permissao.php');
    });
    
    $("#editar_permissao").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");                
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Configurações</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('editar_permissao.php');
    });
    
    $("#setor_AMA_adicionar").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");                
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Configurações</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('setor_AMA_adicionar.php');
    });
    
    $("#setor_AMA_listar").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Configurações</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('setor_AMA_listar.php');
    });
    
    $("#demandas_admin_status").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Configurações</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demandas_admin_status_listar.php');
    });
    
    $("#demandas_admin_tipo_demandas").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Configurações</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demandas_admin_tipo_demandas_listar.php');
    });
    
    $("#demandas_admin_prazos").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Configurações</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demandas_admin_prazos_listar.php');
    });
    
    $("#demandas_admin_status_ver").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Configurações</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demandas_admin_status.php');
    });
    
    $("#demanda_desempenho_equipe").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Configurações</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demanda_desempenho_equipe.php');
    });
    
    $("#minhas_demandas").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Demandas</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('minhas_demandas.php');
    });
    
    $("#demanda_dashboard_team").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Demandas</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demanda_dashboard_team.php');
    });
    
    $("#demandas_geral").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Configurações</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('demandas_geral.php');
    });
    
    $("#rel_desempenho_geral").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#condeconde").empty();
        $("#refresca_cada_quarenta").empty();
        $("#refresca_cada_quarentaa").empty();
        $("#titulo_grafico").html("<h1><i class='icon-briefcase'></i>Relatórios</h1>");
        $("#conteudo_exclusivo").fadeIn('slow').load('rel_desempenho_geral.php');
    });
});