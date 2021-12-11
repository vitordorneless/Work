<?php
session_cache_expire(30);
session_start();
if ($_SESSION["user_id"] == NULL) {
    session_destroy();
    header("Location:../../index.html");
}

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

include '../config/database_mysql.php';
include '../../class/ayuadame.php';
$pdo = Database::connect();
$querie = new Queries();
$date_default = new DateTime();
$hoje = $date_default->format('Y-m-d');
$permissao = new Permissoes();
$demandas = new Demandas();
$permissao->set_id_usuario($_SESSION['user_id']);
$array_permissao = $permissao->Dados_Permissoess($permissao->get_id_usuario());
$array_indicadores = $demandas->Indicadores_Demandas($array_permissao['id_usuario']);
$total_demandas = $demandas->Total_demandas();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Work ON <?php echo date('Y'); ?> - GRUPO AMA</title>   
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />        
        <meta name="description" content="Demandas">
        <meta name="author" content="Grupo TI - AMA">
        <link href="../../corporate/assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/fontello/css/fontello.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/animate-css/animate.min.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/nifty-modal/css/component.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" /> 
        <link href="../../corporate/assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet" /> 
        <link href="../../corporate/assets/libs/pace/pace.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/jquery-icheck/skins/all.css" rel="stylesheet" />        
        <link href="../../corporate/assets/libs/prettify/github.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/morrischart/morris.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/jquery-jvectormap/css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/jquery-clock/clock.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/bootstrap-calendar/css/bic_calendar.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/jquery-weather/simpleweather.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/bootstrap-xeditable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/css/style-responsive.css" rel="stylesheet" />        
        <link href="../../corporate/assets/libs/summernote/summernote.css" rel="stylesheet" type="text/css" />
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script><![endif]-->
        <link rel="shortcut icon" href="../../corporate/assets/img/favicon.ico">
        <link rel="apple-touch-icon" href="../../corporate/assets/img/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="../../corporate/assets/img/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="../../corporate/assets/img/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="../../corporate/assets/img/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="../../corporate/assets/img/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="../../corporate/assets/img/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="../../corporate/assets/img/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="../../corporate/assets/img/apple-touch-icon-152x152.png" />
        <script src="../../corporate/assets/libs/jquery/jquery-1.11.1.min.js"></script>
        <script src="../js/menu.js"></script>
        <script>var resizefunc = [];</script>        
        <script src="../../corporate/assets/libs/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../corporate/assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="../../corporate/assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"></script>
        <script src="../../corporate/assets/libs/jquery-detectmobile/detect.js"></script>
        <script src="../../corporate/assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"></script>
        <script src="../../corporate/assets/libs/ios7-switch/ios7.switch.js"></script>
        <script src="../../corporate/assets/libs/fastclick/fastclick.js"></script>
        <script src="../../corporate/assets/libs/jquery-blockui/jquery.blockUI.js"></script>
        <script src="../../corporate/assets/libs/bootstrap-bootbox/bootbox.min.js"></script>
        <script src="../../corporate/assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="../../corporate/assets/libs/jquery-sparkline/jquery-sparkline.js"></script>
        <script src="../../corporate/assets/libs/nifty-modal/js/classie.js"></script>
        <script src="../../corporate/assets/libs/nifty-modal/js/modalEffects.js"></script>
        <script src="../../corporate/assets/libs/sortable/sortable.min.js"></script>
        <script src="../../corporate/assets/libs/bootstrap-fileinput/bootstrap.file-input.js"></script>
        <script src="../../corporate/assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="../../corporate/assets/libs/bootstrap-select2/select2.min.js"></script>        
        <script src="../../corporate/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script> 
        <script src="../../corporate/assets/libs/pace/pace.min.js"></script>        
        <script src="../../corporate/assets/libs/prettify/prettify.js"></script>
        <script src="../../corporate/assets/js/init.js"></script>
        <script src="../../corporate/assets/libs/summernote/summernote.js"></script>
        <script src="../js/justGage.1.0.1/resources/js/raphael.2.1.0.min.js"></script>
        <script src="../js/justGage.1.0.1/resources/js/justgage.1.0.1.min.js"></script>	
    </head>
    <body class="fixed-left">
        <div id="wrapper">
            <div class="topbar">
                <div class="topbar-left">
                    <div class="logo">
                        <h1><img src="../../corporate/assets/img/logo.png" alt="Logo"></h1>
                    </div>
                    <button class="button-menu-mobile open-left">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="navbar-collapse2">                            
                            <ul class="nav navbar-nav navbar-right top-navbar">                                
                                <li class="dropdown iconify hide-phone"><a href="#" onclick="javascript:toggle_fullscreen()"><i class="icon-resize-full-2"></i></a></li>
                            </ul>
                        </div>                        
                    </div>
                </div>
            </div>            
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">                                        
                    <div class="form-group"></div>                    
                    <div class="clearfix"></div>                    
                    <div class="profile-info">
                        <div class="col-xs-4">
                            <a href="index.php" class="rounded-image profile-image"><img src="../../images/image_user/<?php echo utf8_encode($_SESSION['foto']); ?>"></a>
                        </div>
                        <div class="col-xs-8">                            
                            <div class="profile-text"><?php echo $_SESSION['nome_extenso']; ?></div>
                            <div class="profile-buttons">
                                <a href="#" id="trocar_senha" title="Alterar Senha"><i class="fa icon-key-2"></i></a>
                                <a href="#" id="abrir_demanda" title="Abrir Demanda" class="open-right"><i class="fa fa-tags"></i></a>
                                <a href="../Controller/sair.php" title="Sair"><i class="fa fa-power-off text-red-1"></i></a>
                            </div>
                        </div>
                    </div>                    
                    <div class="clearfix"></div>
                    <hr class="divider" />
                    <div class="clearfix"></div>                    
                    <div id="sidebar-menu">
                        <ul>
                            <li>
                                <a href='index.php'>
                                    <i class='icon-desktop'></i>
                                    <span>Meu Dashboard</span>                                     
                                </a>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['demandas'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-briefcase'></i>
                                    <span>Demandas</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li>
                                        <a tabindex="-1" href='#' id="abrir_demandaa">
                                            <i class='icon-tags'></i>
                                            <span>Abrir Demanda</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="listar_demanda">
                                            <i class='icon-tags'></i>
                                            <span>Listar/Editar Demanda</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="transferir_demanda">
                                            <i class='icon-tags'></i>
                                            <span>Transferir Demanda</span>
                                        </a>
                                    </li>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <i class='icon-briefcase'></i>
                                            <span>Demandas Múltiplas</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>                                                
                                                <a tabindex="-1"  href='#' id="demandas_abrir">
                                                    <i class='icon-tags'></i>
                                                    <span>Abrir Demanda</span>
                                                </a>
                                                <a tabindex="-1"  href='#' id="demandas_criar_tarefas">
                                                    <i class='icon-tasks'></i>
                                                    <span>Demandas - Tarefas</span>
                                                </a>                                                
                                            </li>                                            
                                        </ul>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="minhas_demandas">
                                            <i class='icon-tags'></i>
                                            <span>Minhas Demandas</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="executar_demanda">
                                            <i class='icon-tags'></i>
                                            <span>Executar Demanda</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="demanda_dashboard_team">
                                            <i class='icon-desktop'></i>
                                            <span>Dashboard Equipe</span>
                                        </a>
                                    </li> 
                                    <li>
                                        <a tabindex="-1" href='#' id="slas">
                                            <i class='icon-cogs'></i>
                                            <span>SLA</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['demandas'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-certificate'></i>
                                    <span>Certificados</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li>
                                        <a tabindex="-1" href='#' id="#">
                                            <i class='icon-print'></i>
                                            <span>Cipa</span>
                                        </a>
                                    </li>    
                                    <li>
                                        <a tabindex="-1" href='#' id="#">
                                            <i class='icon-search'></i>
                                            <span>Consulta Certificados</span>
                                        </a>
                                    </li>   
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['demandas'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-chart-area'></i>
                                    <span>Relatórios</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li>
                                        <a tabindex="-1" href='#' id="demanda_desempenho_equipe">
                                            <i class='icon-users'></i>
                                            <span>Desempenho Equipe</span>
                                        </a>
                                    </li>
                                    <!--<li>
                                        <a tabindex="-1" href='#' id="#">
                                            <i class='icon-user'></i>
                                            <span>Desempenho Individual</span>
                                        </a>
                                    </li>-->
                                    <li>
                                        <a tabindex="-1" href='#' id="rel_desempenho_geral">
                                            <i class='icon-globe'></i>
                                            <span>Desempenho Geral</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="#">
                                            <i class='icon-fire'></i>
                                            <span>Hot Tags</span>
                                        </a>
                                    </li>                             
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['super_admin'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-cogs'></i>
                                    <span>Configurações</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li>
                                        <a tabindex="-1" href='#' id="demandas_geral">
                                            <i class='icon-briefcase'></i>
                                            <span>Demandas Geral</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="demandas_admin_status_ver">
                                            <i class='icon-briefcase'></i>
                                            <span>Demandas Status</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="usuario_adicionar">
                                            <i class='icon-user-add'></i>
                                            <span>Adicionar Usuário</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="usuario_listar">
                                            <i class='icon-users'></i>
                                            <span>CRUD Usuário</span>
                                        </a>
                                    </li>                                            
                                    <li>
                                        <a tabindex="-1" href='#' id="adicionar_permissao">
                                            <i class='icon-adult'></i>
                                            <span>+ Permissões ao Usuário</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="editar_permissao">
                                            <i class='icon-adult'></i>
                                            <span>Permissões ao Usuário</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="setor_AMA_adicionar">
                                            <i class='icon-spread'></i>
                                            <span>Adicionar Setor</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="setor_AMA_listar">
                                            <i class='icon-spread'></i>
                                            <span>CRUD Setor</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="demandas_admin_status">
                                            <i class='icon-briefcase'></i>
                                            <span>CRUD Status Demandas</span>
                                        </a>                                                        
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="demandas_admin_tipo_demandas">
                                            <i class='icon-briefcase'></i>
                                            <span>CRUD Tipos/Demandas</span>
                                        </a>                                                        
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="demandas_admin_prazos">
                                            <i class='icon-briefcase'></i>
                                            <span>CRUD Prazos para SLA</span>
                                        </a>                                                        
                                    </li>                                    
                                </ul>
                            </li>
                        </ul>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>                    
                    <div class="clearfix"></div><br><br><br>
                </div>                
            </div>            
            <div class="content-page">                
                <div class="content">
                    <div class="col-md-12">
                        <div class="page-heading" id="titulo_grafico"><h1><i class='icon-desktop'></i>Meu Dashboard</h1></div>
                        <div class="row top-summary" id="refresca_cada_quarenta">
                            <div class="col-lg-3 col-md-6" style="display: block;">
                                <div class="widget green-2 animated fadeInDown">
                                    <div class="widget-content padding">
                                        <div class="widget-icon">
                                            <i class="fa fa-smile-o"></i>
                                        </div>
                                        <div class="text-box">
                                            <p class="maindata">NO PRAZO</p>
                                            <h2><span class="animate-number" data-value="<?php echo $array_indicadores['no_prazo']; ?>" data-duration="1500"></span></h2>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="widget-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <i class="fa fa-caret-right rel-change"></i> <b><?php echo bcdiv(bcdiv(bcadd($array_indicadores['no_prazo'], bcadd($array_indicadores['vence_hoje'], $array_indicadores['vencida'])), $array_indicadores['no_prazo'] == 0 ? 1 : $array_indicadores['no_prazo'], 2), 100, 2); ?>%</b> 
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6" style="display: block;">
                                <div class="widget orange-4 animated fadeInDown">
                                    <div class="widget-content padding">
                                        <div class="widget-icon">
                                            <i class="fa fa-meh-o"></i>
                                        </div>
                                        <div class="text-box">
                                            <p class="maindata">VENCENDO</p>
                                            <h2><span class="animate-number" data-value="<?php echo $array_indicadores['vence_hoje']; ?>" data-duration="1500">0</span></h2>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="widget-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <i class="fa fa-caret-right rel-change"></i> <b><?php echo bcdiv(bcdiv(bcadd($array_indicadores['no_prazo'], bcadd($array_indicadores['vence_hoje'], $array_indicadores['vencida'])), $array_indicadores['vence_hoje'] == 0 ? 1 : $array_indicadores['vence_hoje'], 2), 100, 2); ?>%</b>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6" style="display: block;">
                                <div class="widget red-1 animated fadeInDown">
                                    <div class="widget-content padding">
                                        <div class="widget-icon">
                                            <i class="fa fa-frown-o"></i>
                                        </div>
                                        <div class="text-box">
                                            <p class="maindata">VENCIDOS</p>
                                            <h2><span class="animate-number" data-value="<?php echo $array_indicadores['vencida']; ?>" data-duration="1500">0</span></h2>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="widget-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <i class="fa fa-caret-right rel-change"></i> <b><?php echo bcdiv(bcdiv(bcadd($array_indicadores['no_prazo'], bcadd($array_indicadores['vence_hoje'], $array_indicadores['vencida'])), $array_indicadores['vencida'] == 0 ? 1 : $array_indicadores['vencida'], 2), 100, 2); ?>%</b>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6" style="display: block;">
                                <div class="widget lightblue-1 animated fadeInDown">
                                    <div class="widget-content padding">
                                        <div class="widget-icon">
                                            <i class="fa fa-thumbs-up"></i>
                                        </div>
                                        <div class="text-box">
                                            <p class="maindata">REALIZADOS</b></p>
                                            <h2><span class="animate-number" data-value="<?php echo $array_indicadores['realizados']; ?>" data-duration="1500">0</span></h2>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="widget-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <i class="fa fa-caret-right rel-change"></i> <b><?php echo meise(date('m')); ?> <?php echo date('Y'); ?></b>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="row top-summary" id="refresca_cada_quarentaa">
                            <div class="col-md-3 portlets">
                                <div class="widget">                                
                                    <div class="widget-content padding">
                                        <div id="gauge2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 portlets">
                                <div class="widget">                                
                                    <div class="widget-content padding">
                                        <div id="gauge3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 portlets">
                                <div class="widget">                                
                                    <div class="widget-content padding">
                                        <div id="gauge"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 portlets">
                                <div class="widget">                                
                                    <div class="widget-content padding">
                                        <div id="gauge4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget" id="condeconde">
                            <div class="widget-header transparent">
                                <h2><strong>Últimas</strong> Demandas</h2>
                                <div class="additional-btn">
                                    <a href="#" class="widget-reload"><i class="icon-ccw-1"></i></a>
                                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                                </div>
                            </div>
                            <div class="widget-content">					
                                <div class="table-responsive">
                                    <table data-sortable class="table">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Demanda</th>
                                                <th>Data Abertura</th>
                                                <th>Status</th>
                                                <!--<th>Ação</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($pdo->query($querie->listar_demanda_executante_index($array_permissao['id_usuario'])) as $value) {
                                                $qq = $pdo->prepare($querie->listar_criador($value['id_user_abertura']));
                                                $qq->execute();
                                                $data_criador = $qq->fetch(PDO::FETCH_ASSOC);
                                                $qqq = $pdo->prepare($querie->listar_responsavel($value['id_responsavel']));
                                                $qqq->execute();
                                                $data_responsavel = $qqq->fetch(PDO::FETCH_ASSOC);
                                                $qqqq = $pdo->prepare($querie->listar_executante($value['executantes']));
                                                $qqqq->execute();
                                                $data_executante = $qqqq->fetch(PDO::FETCH_ASSOC);
                                                $qqqqq = $pdo->prepare($querie->listar_setores_usuarios($value['id_user_abertura_setor']));
                                                $qqqqq->execute();
                                                $data_setor = $qqqqq->fetch(PDO::FETCH_ASSOC);
                                                $qqqqqq = $pdo->prepare($querie->listar_demanda_list($value['id_demanda']));
                                                $qqqqqq->execute();
                                                $data_demanda = $qqqqqq->fetch(PDO::FETCH_ASSOC);
                                                $qqqqqqq = $pdo->prepare($querie->status_list($value['id_status']));
                                                $qqqqqqq->execute();
                                                $data_status = $qqqqqqq->fetch(PDO::FETCH_ASSOC);
                                                $qqqqqqqq = $pdo->prepare($querie->status_prazo($value['id_prazo']));
                                                $qqqqqqqq->execute();
                                                $data_prazo = $qqqqqqqq->fetch(PDO::FETCH_ASSOC);
                                                $dt_ult_alt = new DateTime($value['data_ultima_alteracao']);
                                                $dt_ult_altt = new DateTime($value['data_ultima_alteracao']);
                                                $dt_ult_alttt = new DateTime($value['data_ultima_alteracao']);
                                                $ano = $dt_ult_alttt->format('Y');
                                                $voucher = $ano.'0'.$value['id'];
                                                switch ($data_prazo['tipo']) {
                                                    case 'horas':
                                                        $dt_ult_alt->add(new DateInterval("PT" . $data_prazo['prazo'] . "H"));
                                                        if($dt_ult_alt->format('D') === "Sat"){
                                                            $dt_ult_alt->add(new DateInterval("P2D"));
                                                        }elseif($dt_ult_alt->format('D') === "Sun"){
                                                            $dt_ult_alt->add(new DateInterval("P1D"));
                                                        }
                                                        $comparador = $dt_ult_alt->format('Y-m-d');
                                                        break;
                                                    case 'dias':
                                                        $dt_ult_alt->add(new DateInterval("P" . $data_prazo['prazo'] . "D"));
                                                        if($dt_ult_alt->format('D') === "Sat"){
                                                            $dt_ult_alt->add(new DateInterval("P2D"));
                                                        }elseif($dt_ult_alt->format('D') === "Sun"){
                                                            $dt_ult_alt->add(new DateInterval("P1D"));
                                                        }
                                                        $comparador = $dt_ult_alt->format('Y-m-d');
                                                        break;
                                                    case 'semanas':
                                                        $dt_ult_alt->add(new DateInterval("P" . $data_prazo['prazo'] . "W"));
                                                        if($dt_ult_alt->format('D') === "Sat"){
                                                            $dt_ult_alt->add(new DateInterval("P2D"));
                                                        }elseif($dt_ult_alt->format('D') === "Sun"){
                                                            $dt_ult_alt->add(new DateInterval("P1D"));
                                                        }
                                                        $comparador = $dt_ult_alt->format('Y-m-d');
                                                        break;
                                                    case 'meses':
                                                        $dt_ult_alt->add(new DateInterval("P" . $data_prazo['prazo'] . "M"));
                                                        if($dt_ult_alt->format('D') === "Sat"){
                                                            $dt_ult_alt->add(new DateInterval("P2D"));
                                                        }elseif($dt_ult_alt->format('D') === "Sun"){
                                                            $dt_ult_alt->add(new DateInterval("P1D"));
                                                        }
                                                        $comparador = $dt_ult_alt->format('Y-m-d');
                                                        break;
                                                }
                                                $prazo_demanda = new DateTime($comparador);
                                                $hooje = new DateTime($hoje);
                                                $status = 0;
                                                if ($prazo_demanda < $hooje) {
                                                    $status = 1;
                                                    $semaforo = '<center><i class="fa fa-frown-o"></i></center>';
                                                    $aviso = 'Vencida: ' . $prazo_demanda->format('d/m/Y');
                                                } else if ($prazo_demanda > $hooje) {
                                                    $status = 2;
                                                    $semaforo = '<center><i class="fa fa-smile-o"></i></center>';
                                                    $aviso = 'No Prazo: ' . $prazo_demanda->format('d/m/Y');
                                                } else if ($prazo_demanda == $hooje) {
                                                    $status = 3;
                                                    $semaforo = '<center><i class="fa fa-meh-o"></center>';
                                                    $aviso = 'Venc. Hoje: ' . $prazo_demanda->format('d/m/Y');
                                                } elseif ($value['id_status'] === "3") {
                                                    $status = 4;
                                                }
                                                echo '<tr>';
                                                echo '<td>' . $voucher . '</td>';
                                                echo '<td>' . $data_demanda['tipo_demanda'] . '</td>';
                                                echo '<td>' . $dt_ult_altt->format('d/m/Y') . '</td>';
                                                if ($status === 1) {
                                                    $span = '<span class="label label-danger">' . $data_status['status'] . '</span>';
                                                } elseif ($status === 2) {
                                                    $span = '<span class="label label-success">' . $data_status['status'] . '</span>';
                                                } elseif ($status === 3) {
                                                    $span = '<span class="label label-warning">' . $data_status['status'] . '</span>';
                                                } elseif ($status === 4) {
                                                    $span = '<span class="label label-info">' . $data_status['status'] . '</span>';
                                                }
                                                echo '<td>' . $span . '</td>';
                                                //echo '<td><div class="btn-group btn-group-xs"><a data-toggle="tooltip" title="Ver" class="btn btn-default"><i class="fa fa-eye"></i></a><a data-toggle="tooltip" title="Editar" class="btn btn-default"><i class="fa fa-edit"></i></a></div></td>';
                                                echo '</tr>';
                                            }
                                            Database::disconnect();
                                            ?>                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">                        
                            <div class="col-lg-12 portlets" id="conteudo_exclusivo"></div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>
        <div class="md-overlay"></div>        
    </body>
    <script>
        var g = new JustGage({
            id: "gauge",
            value: <?php echo $array_indicadores['vencida']; ?>,
            min: 0,
            max: <?php echo $total_demandas['temos']; ?>,
            title: "Vencidos",
            label: "Total"
        });

        var g = new JustGage({
            id: "gauge2",
            value: <?php echo $array_indicadores['no_prazo']; ?>,
            min: 0,
            max: <?php echo $total_demandas['temos']; ?>,
            title: "No Prazo",
            label: "Total"
        });

        var g = new JustGage({
            id: "gauge3",
            value: <?php echo $array_indicadores['vence_hoje']; ?>,
            min: 0,
            max: <?php echo $total_demandas['temos']; ?>,
            title: "Vencendo",
            label: "Total"
        });
        var g = new JustGage({
            id: "gauge4",
            value: 50,
            min: 0,
            max: 100,
            title: "Desempenho",
            label: "Realizado"
        });

    </script>
</html>