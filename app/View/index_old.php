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
$permissao = new Permissoes();
$wal_ativos = new Wal_Ativos();
$diario = new Diario();
$tema_de_hoje = $diario->Dados_Diario();
$total = $wal_ativos->Contar_Wal_Ativos();
$porcentagem = $wal_ativos->Contar_Riscos_Ajustados();
$fizeram_periodicos = $wal_ativos->Contar_Wal_Ativos_fizeram_periodicos();
$ativo_erro = $wal_ativos->Contar_Wal_Ativos_error();
$permissao->set_id_usuario($_SESSION['user_id']);
$array_permissao = $permissao->Dados_Permissoess($permissao->get_id_usuario());
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Periódicos <?php echo date('Y'); ?> - GRUPO AMA Gestão</title>   
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta http-equiv="Pragma" content="no-cache">
        <meta name="description" content="">
        <meta name="keywords" content="coco bootstrap template, coco admin, bootstrap,admin template, bootstrap admin,">
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
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
    </head>
    <body class="fixed-left">
        <div id="wrapper">
            <div class="topbar">
                <div class="topbar-left">
                    <div class="logo">
                        <h1><a href="index.php"><img src="../../corporate/assets/img/logo.png" alt="Logo"></a></h1>
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
                                <li class="dropdown topbar-profile">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="rounded-image topbar-profile-image"><img src="../../images/image_user/<?php echo $_SESSION['foto']; ?>"></span> <strong><?php echo $_SESSION['nome_extenso']; ?></strong> <i class="fa fa-caret-down"></i></a>
                                    <ul class="dropdown-menu">                                        
                                        <li><a href="#" id="trocar_senha"><i class="icon-adult"></i> Trocar Senha</a></li>
                                        <li class="divider"></li>                                        
                                        <li><a class="md-trigger" href="#" id="sair" ><i class="icon-logout-1"></i> Sair</a></li>
                                    </ul>
                                </li>
                                <li class="right-opener"></li>
                            </ul>
                        </div>                        
                    </div>
                </div>
            </div>            
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="clearfix"></div>                    
                    <div class="profile-info">
                        <div class="col-xs-4">
                            <a href="index.php" class="rounded-image profile-image"><img src="../../images/image_user/<?php echo utf8_encode($_SESSION['foto']); ?>"></a>
                        </div>
                        <div class="col-xs-8">                            
                            <div class="profile-text">Bem Vindo <b><?php echo $_SESSION['nome_extenso']; ?></b></div>
                        </div>
                    </div>                    
                    <div class="clearfix"></div>
                    <hr class="divider" />
                    <div class="clearfix"></div>                    
                    <div id="sidebar-menu">
                        <ul>
                            <li class='has_sub'>                                
                                <a href='javascript:void(0);' <?php echo $array_permissao['super_admin'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-briefcase'></i>
                                    <span>Super Admin</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>                                    
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Usuários</span>
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href='#' id="usuario_adicionar">
                                                    <i class='icon-eye'></i>
                                                    <span>Adicionar Usuário</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="usuario_listar">
                                                    <i class='icon-edit-circled'></i>
                                                    <span>Listar / Editar / Excluir Usuário</span>
                                                </a>
                                            </li>                                            
                                            <li>
                                                <a tabindex="-1" href='#' id="adicionar_permissao">
                                                    <i class='icon-eye'></i>
                                                    <span>Adicionar Permissões ao Usuário</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="editar_permissao">
                                                    <i class='icon-edit-circled'></i>
                                                    <span>Editar Permissões ao Usuário</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="setor_AMA_adicionar">
                                                    <i class='icon-eye'></i>
                                                    <span>Adicionar Setor</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="setor_AMA_listar">
                                                    <i class='icon-edit-circled'></i>
                                                    <span>Listar / Editar / Excluir Setor</span>
                                                </a>
                                            </li>
                                            <?php
                                            $teste = $_SESSION["user_id"] == 1 ? 'style="display: block;"' : 'style="display: none;"';
                                            ?>
                                            <li>
                                                <a tabindex="-1" href='#' id="teste_page" <?php echo $teste;  ?>>
                                                    <i class='icon-info'></i>
                                                    <span>Testes</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="teste_page2" <?php echo $teste; ?>>
                                                    <i class='icon-info'></i>
                                                    <span>Testes 2</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="diario">
                                                    <i class='icon-book-2'></i>
                                                    <span>Diário</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>DMED</span>
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href='#' id="dmed_include">
                                                    <i class='icon-paper-plane'></i>
                                                    <span>Lançamentos</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="dmed_listar">
                                                    <i class='icon-paper-plane'></i>
                                                    <span>Listar Lançamentos</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="dmed_txt">
                                                    <i class='icon-paper-plane'></i>
                                                    <span>Gerar TXT</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!--<li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Projetos</span>
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href='#' id="dot_project">
                                                    <i class='icon-paper-plane'></i>
                                                    <span>Dot Project</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>-->
                                </ul>
                            </li>
                            <li class='has_sub'>                                
                                <a href='javascript:void(0);'  <?php echo $array_permissao['admin'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>> 
                                    <i class='icon-battery'></i>
                                    <span>Admin</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Demandas</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li class='has_sub'>
                                                <a href='javascript:void(0);'>
                                                    <span>Deveres Demandas</span> 
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="demandas_admin_status">
                                                            <i class='icon-star'></i>
                                                            <span>Adicionar / Editar Status de Tipos de Demandas</span>
                                                        </a>                                                        
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="demandas_admin_tipo_demandas">
                                                            <i class='icon-exclamation'></i>
                                                            <span>Adicionar / Editar Tipos de Demandas</span>
                                                        </a>                                                        
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="demandas_admin_prazos">
                                                            <i class='icon-time'></i>
                                                            <span>Adicionar / Editar Prazos para SLA</span>
                                                        </a>                                                        
                                                    </li>                                                    
                                                </ul>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="demandas_admin_status_ver">
                                                    <i class='icon-arrows-ccw'></i>
                                                    <span>Demandas Status</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="demandas_admin_indicadores"><i class='icon-anchor'></i><span>Indicadores</span></a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="#"><i class='icon-paper-plane'></i><span>Reports</span></a>
                                            </li>                                            
                                        </ul>
                                    </li>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Reuniões</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li class='has_sub'>
                                                <a href='javascript:void(0);'>
                                                    <span>Deveres Reuniões</span> 
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="reunion">
                                                            <i class='icon-exclamation'></i>
                                                            <span>Adicionar / Editar Tipo de Reunião</span>
                                                        </a>                                                        
                                                    </li>                                            
                                                </ul>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="#"><i class='icon-person'></i><span>Listar / Criar / Editar Reunião</span></a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="#"><i class='icon-print'></i><span>Gerar Ata de Reunião</span></a>
                                            </li>                                            
                                        </ul>
                                    </li>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Médicos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href='#' id="prestador_adicionar"><i class='icon-eye'></i><span>Adicionar Prestador</span></a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="prestador_listar"><i class='icon-edit-circled'></i><span>Listar / Editar / Excluir Prestador</span></a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="medico_adicionar"><i class='icon-eye'></i><span>Adicionar Médico</span></a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="medico_listar"><i class='icon-edit-circled'></i><span>Listar / Editar / Excluir Médicos</span></a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="medico_valores_listar"><i class='icon-edit-circled'></i><span>Renegociar Valores - Médicos</span></a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="funcao_adicionar"><i class='icon-eye'></i><span>Adicionar Especialidade</span></a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="funcao_listar"><i class='icon-edit-circled'></i><span>Listar / Editar / Excluir Especialidades</span></a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="hist_prospeccao_inc"><i class='icon-deviantart'></i><span>Incluir Histórico de Prospecção</span></a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="hist_prospeccao_listar"><i class='icon-deviantart'></i><span>Listar Histórico de Prospecção</span></a>
                                            </li>
                                            <li class='has_sub'>
                                                <a href='javascript:void(0);'>
                                                    <span>Contratos</span> 
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="gerar_contrato_prestador">
                                                            <i class='icon-paper-plane'></i>
                                                            <span>Gerar Contrato Prestador</span>
                                                        </a>                                                        
                                                    </li>
                                                    <!--<li>
                                                        <a tabindex="-1" href='#' id="reunion">
                                                            <i class='icon-paper-plane'></i>
                                                            <span>Gerar Aditivo de Contrato</span>
                                                        </a>                                                        
                                                    </li>-->
                                                    <li>
                                                        <a tabindex="-1" href='#' id="contratos_listar">
                                                            <i class='icon-paper-plane'></i>
                                                            <span>Listar Contratos</span>
                                                        </a>                                                        
                                                    </li>
                                                    <!--<li>
                                                        <a tabindex="-1" href='#' id="reunion">
                                                            <i class='icon-paper-plane'></i>
                                                            <span>Listar Aditivos de Contratos</span>
                                                        </a>                                                        
                                                    </li>-->
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>                                    
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Convocação</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1"  href='#' id="convocacao_adicionar">
                                                    <i class='icon-eye'></i>
                                                    <span>Adicionar Convocação</span>
                                                </a>
                                            </li>                                            
                                            <li>
                                                <a tabindex="-1"  href='#' id="convocacao_listar">
                                                    <i class='icon-edit-circled'></i>
                                                    <span>Listar / Editar / Excluir Convocação</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="responsavel_walmart_adicionar">
                                                    <i class='icon-eye'></i>
                                                    <span>Adicionar Responsável Walmart</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="responsavel_walmart_listar">
                                                    <i class='icon-edit-circled'></i>
                                                    <span>Listar / Editar / Excluir Responsável Walmart</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="pcmso_coord_listar">
                                                    <i class='icon-edit-circled'></i>
                                                    <span>Listar / Incluir / Editar / Excluir Coordenador PCMSO</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="off_down">
                                                    <i class='icon-export'></i>
                                                    <span>OffLine - Donwload</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Recursos Humanos</span>
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li class='has_sub'>
                                                <a href='javascript:void(0);'>
                                                    <span>Deveres RH</span> 
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="rh_estado_civil">
                                                            <i class='icon-exclamation'></i>
                                                            <span>Adicionar / Editar Estado Cívil</span>
                                                        </a>
                                                        <a tabindex="-1" href='#' id="rh_instrucao_escolar">
                                                            <i class='icon-exclamation'></i>
                                                            <span>Adicionar / Editar Grau de Instrução Escolar</span>
                                                        </a>
                                                        <a tabindex="-1" href='#' id="herval_tipo_agendamento">
                                                            <i class='icon-exclamation'></i>
                                                            <span>Adicionar / Editar Cor das Pessoas</span>
                                                        </a>
                                                        <a tabindex="-1" href='#' id="herval_tipo_agendamento">
                                                            <i class='icon-exclamation'></i>
                                                            <span>Adicionar / Editar Tipos de Deficiência</span>
                                                        </a>
                                                        <a tabindex="-1" href='#' id="herval_tipo_agendamento">
                                                            <i class='icon-exclamation'></i>
                                                            <span>Adicionar / Editar Departamentos</span>
                                                        </a>
                                                        <a tabindex="-1" href='#' id="herval_tipo_agendamento">
                                                            <i class='icon-exclamation'></i>
                                                            <span>Adicionar / Editar Funções</span>
                                                        </a>
                                                        <a tabindex="-1" href='#' id="herval_tipo_agendamento">
                                                            <i class='icon-exclamation'></i>
                                                            <span>Adicionar / Editar Vínculo Empregatício</span>
                                                        </a>
                                                        <a tabindex="-1" href='#' id="herval_tipo_agendamento">
                                                            <i class='icon-exclamation'></i>
                                                            <span>Adicionar / Editar Empresas Grupo AMA</span>
                                                        </a>
                                                        <a tabindex="-1" href='#' id="herval_tipo_agendamento">
                                                            <i class='icon-exclamation'></i>
                                                            <span>Adicionar / Editar Unidades Grupo AMA</span>
                                                        </a>                                                        
                                                    </li>                                            
                                                </ul>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="rh_lista_geral">
                                                    <i class='icon-eye'></i>
                                                    <span>Lista Geral</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="rh_funcionarios">
                                                    <i class='icon-eye'></i>
                                                    <span>Adicionar / Editar / Desligar Funcionarios Grupo AMA</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['lojas'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-megaphone'></i>
                                    <span>Lojas</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Periódicos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li><a tabindex="-1" href='#' id="periodicos_listar_perio"><i class='icon-edit-circled'></i><span>Listar Ativos Marcados</span></a></li>
<!--<li><a tabindex="-1" href='#' id="periodicos_listar"><i class='icon-edit-circled'></i><span>Listar</span></a></li>
<li><a tabindex="-1" href='#' id="periodicos_listar_tudo"><i class='icon-edit-circled'></i><span>Listar Base</span></a></li>
<li><a tabindex="-1" href='#' id="incluir_periodicos"><i class='icon-eye'></i><span>Incluir Periódicos</span></a></li>-->
                                        </ul>
                                    </li>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Riscos e Exames</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>                                                
                                                <a tabindex="-1"  href='#' id="riscos_e_exames_listar">
                                                    <i class='icon-eye'></i>
                                                    <span>Adicionar Riscos e Exames</span>
                                                </a>
                                                <a tabindex="-1"  href='#' id="riscos_e_exames_listar_editar">
                                                    <i class='icon-edit-circled'></i>
                                                    <span>Editar Riscos e Exames</span>
                                                </a>
                                                <a tabindex="-1"  href='#' id="verificar_ativos_listar">
                                                    <span>Verificar Ativos com Riscos e Exames</span>
                                                </a>
                                                <a tabindex="-1"  href='#' id="riscos_ativos_include">
                                                    <span>Adicionar Risco por Associado</span>
                                                </a>
                                                <a tabindex="-1"  href='#' id="riscos_ativos_edit">
                                                    <span>Editar Risco por Associado</span>
                                                </a>
                                                <a tabindex="-1"  href='#' id="txt_grafica_listar">
                                                    <span>Geração TXT para Gráfica</span>
                                                </a>
                                            </li>                                            
                                        </ul>
                                    </li>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Riscos e Exames 2016</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1"  href='#' id="riscos_e_exames_bandeira">
                                                    <i class='icon-flag'></i>
                                                    <span>Adicionar Riscos e Exames por Setor e Bandeira</span>
                                                </a>
                                                <a tabindex="-1"  href='#' id="editar_riscos_e_exames_bandeira">
                                                    <i class='icon-flag'></i>
                                                    <span>Editar Riscos e Exames por Setor e Bandeira</span>
                                                </a>
                                                <a tabindex="-1"  href='#' id="visualizar_riscos_e_exames_bandeira">
                                                    <i class='icon-flag'></i>
                                                    <span>Visualizar Riscos e Exames por Setor e Bandeira</span>
                                                </a>
                                                <a tabindex="-1"  href='#' id="txt_grafica_bandeira_listar">
                                                    <i class='icon-paper-plane'></i>
                                                    <span>Geração TXT para Gráfica</span>
                                                </a>
                                                <a tabindex="-1"  href='#' id="lista_nominal">
                                                    <i class='icon-list'></i>
                                                    <span>Lista Nominal por Loja</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="procurar_prestador">
                                                    <i class='icon-eye'></i>
                                                    <span>Procurar Prestador</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="procurar_prestador_loja">
                                                    <i class='icon-eye'></i>
                                                    <span>Procurar Prestador por Loja</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['convocacao'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-megaphone'></i>
                                    <span>Convocação</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>    
                                    <li class='has_sub'>
                                        <a tabindex="-1" href='javascript:void(0);'>
                                            <span>Convocar Lojas</span>
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1"  href='#' id="convocar_lojas_adicionar">
                                                    <i class='icon-eye'></i>
                                                    <span>Convocar Loja</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="convocar_lojas_listar">
                                                    <i class='icon-edit-circled'></i>
                                                    <span>Listar / Editar / Excluir Convocação de Loja</span>
                                                </a>
                                            </li>                                            
                                            <li>
                                                <a tabindex="-1"  href='#' id="convocar_datas_listar">
                                                    <i class='icon-eye'></i>
                                                    <span>Adicionar / Listar / Editar / Excluir Datas a Convocação</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="convocar_kits_adm">
                                                    <i class='icon-eye'></i>
                                                    <span>Kits - Administrativo</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a tabindex="-1"  href='#' id="convocar_lojas_medicos_adicionar">
                                            <i class='icon-edit-circled'></i>
                                            <span>Convocar Médicos</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1"  href='#' id="convocar_enviar">
                                            <i class='icon-eye'></i>
                                            <span>Enviar Convocação</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1"  href='#' id="convocar_efetivadas">
                                            <i class='icon-equalizer'></i>
                                            <span>Convocações Efetivadas</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['cassi'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-briefcase'></i>
                                    <span>CASSI</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Periódicos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1"  href='#' id="cassi_exames_marcar">
                                                    <i class='icon-eye'></i>
                                                    <span>Marcar Agendamento</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="cassi_exames_listar">
                                                    <i class='icon-edit-circled'></i>
                                                    <span>Editar Agendamentos</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="cassi_agendamento_enviar">
                                                    <i class='icon-mail-circled'></i>
                                                    <span>Enviar Agendamento via Email</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="cassi_buscar_nome">
                                                    <i class='icon-person'></i>
                                                    <span>Buscar Ativo pelo nome</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="cassi_lancamento_autonomo">
                                                    <i class='icon-adult'></i>
                                                    <span>Lançamento Autonômo</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="excel_CASSI">
                                                    <i class='icon-export'></i>
                                                    <span>Geração Excel CASSI</span>
                                                </a>
                                            </li>
                                            <li class='has_sub'>
                                                <a href='javascript:void(0);'>
                                                    <span>Funcionários CASSI</span> 
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>                                                    
                                                    <li>
                                                        <a tabindex="-1"  href='#' id="cassi_funcionarios_listar">
                                                            <i class='icon-eye'></i>
                                                            <span>Adicionar / Editar / Listar / Excluir Funcionários CASSI</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class='has_sub'>
                                                <a href='javascript:void(0);'>
                                                    <span>Carta Remessa</span> 
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a tabindex="-1"  href='#' id="cassi_carta_remessa_adicionar">
                                                            <i class='icon-eye'></i>
                                                            <span>Geração Carta Remessa CASSI</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1"  href='#' id="cassi_carta_remessa_listar">
                                                            <i class='icon-edit-circled'></i>
                                                            <span>Listar / Editar / Excluir Carta Remessa CASSI</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class='has_sub'>
                                                <a href='javascript:void(0);'>
                                                    <span>Consulta Médica</span> 
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <li class='has_sub'>
                                                        <a href='javascript:void(0);'>
                                                            <span>Solicitante CASSI</span> 
                                                            <span class="pull-right">
                                                                <i class="fa fa-angle-down"></i>
                                                            </span>
                                                        </a>
                                                        <ul>
                                                            <li>
                                                                <a tabindex="-1"  href='#' id="cassi_solicitante_listar">
                                                                    <i class='icon-exclamation'></i>
                                                                    <span>Adicionar / Editar / Listar / Excluir</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class='has_sub'>
                                                        <a href='javascript:void(0);'>
                                                            <span>Solicitar Exame</span> 
                                                            <span class="pull-right">
                                                                <i class="fa fa-angle-down"></i>
                                                            </span>
                                                        </a>
                                                        <ul>
                                                            <li>
                                                                <a tabindex="-1"  href='#' id="cassi_solicitar_exame">
                                                                    <i class='icon-exclamation'></i>
                                                                    <span>Adicionar / Editar / Listar / Excluir</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>                                                    
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['cassi_gerencial'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-briefcase'></i>
                                    <span>CASSI - Módulo Gerencial</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Periódicos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1"  href='#' id="cassi_indicadores_gerencial">
                                                    <i class='icon-barcode'></i>
                                                    <span>Indicadores</span>
                                                </a>
                                            </li>                                                                                        
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['indicadores_cassi'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-briefcase'></i>
                                    <span>CASSI - Indicadores</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Periódicos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1"  href='#' id="cassi_indicadoress">
                                                    <i class='icon-barcode'></i>
                                                    <span>Indicadores</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="cassi_graficos">
                                                    <i class='icon-pin'></i>
                                                    <span>Gráficos</span>
                                                </a>
                                            </li>                                            
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['indicadores_walmart'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-briefcase'></i>
                                    <span>WALMART - Indicadores</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Periódicos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1"  href='#' id="wal_indicadoress">
                                                    <i class='icon-barcode'></i>
                                                    <span>Indicadores 2015</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1"  href='#' id="wal_indicadoress2016">
                                                    <i class='icon-barcode'></i>
                                                    <span>Indicadores 2016</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['medicos_externo'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-cloud-thunder'></i>
                                    <span>Médicos - CASSI EXTERNO</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Periódicos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href='#' id="cassi_Medicos_lista_de_presenca">
                                                    <i class='icon-export-2'></i>
                                                    <span>Lista de Presença</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['medicos_walmart'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-cloud-thunder'></i>
                                    <span>Médicos - WALMART</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Periódicos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href='#' id="atendimento_periodico">
                                                    <i class='icon-tags'></i>
                                                    <span>Controle de Atendimento - Periódicos</span>
                                                </a>
                                                <!--<a tabindex="-1" href='#' id="atendimento_periodico_lojas">
                                                    <i class='icon-tags'></i>
                                                    <span>Controle de Atendimento - Periódicos por Lojas</span>
                                                </a>-->
                                                <a tabindex="-1" href='#' id="wal_caixas">
                                                    <i class='icon-tags'></i>
                                                    <span>Caixas</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="ativos_exists">
                                                    <i class='icon-eye'></i>
                                                    <span>Ver se Ativo Existe</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="ativos_include">
                                                    <i class='icon-eye'></i>
                                                    <span>Incluir Ativos Walmart</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="ativos_error">
                                                    <i class='icon-eye'></i>
                                                    <span>Ativos com Erros</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="error_send_to_doctors">
                                                    <i class='icon-eye'></i>
                                                    <span>Enviar Erros para Médicos</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="envelope_to_doctors">
                                                    <i class='icon-eye'></i>
                                                    <span>Listar Envelopes</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="pay_doctors">
                                                    <i class='icon-eye'></i>
                                                    <span>Pagamentos</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="troca_setor_wal">
                                                    <i class='icon-box'></i>
                                                    <span>Troca de setor/função Walmart</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="tracking_doctors">
                                                    <i class='icon-box'></i>
                                                    <span>Tracking</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="wal_doctors_report">
                                                    <i class='icon-eye'></i>
                                                    <span>Relatório Walmart</span>
                                                </a>
                                            </li>
                                            <li class='has_sub'>
                                                <a href='javascript:void(0);'>
                                                    <span>2016</span> 
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="atendimento_periodico2016">
                                                            <i class='icon-tags'></i>
                                                            <span>Controle de Atendimento - Periódicos 2016</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="ativos_error2016">
                                                            <i class='icon-eye'></i>
                                                            <span>Ativos com Erros</span>
                                                        </a>
                                                    </li>                                                    
                                                    <li>
                                                        <a tabindex="-1" href='#' id="ativos_exists2016">
                                                            <i class='icon-eye'></i>
                                                            <span>Ver se Ativo Existe</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="tracking_doctors2016">
                                                            <i class='icon-box'></i>
                                                            <span>Tracking</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="wal_doctors_report2016">
                                                            <i class='icon-eye'></i>
                                                            <span>Relatório Walmart eSocial</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="up_offline2016">
                                                            <i class='icon-blind'></i>
                                                            <span>Upload Arquivo Offline 2016</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="up_offlinelist">
                                                            <i class='icon-blind'></i>
                                                            <span>Listar Arquivo Offline 2016 Upados!</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="leitura_offline2016">
                                                            <i class='icon-window'></i>
                                                            <span>Carregar Arquivo Offline 2016</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['super_admin'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-cloud-thunder'></i>
                                    <span>Pequenas Empresas</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Periódicos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li class='has_sub'>
                                                <a href='javascript:void(0);'>
                                                    <span>Admin Empresas</span> 
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a tabindex="-1"  href='#' id="cargos_empresas_listar">
                                                            <i class='icon-eye'></i>
                                                            <span>Cargos Executivos</span>
                                                        </a>
                                                    </li>                                            
                                                </ul>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="tela_apresentacao">
                                                    <i class='icon-tags'></i>
                                                    <span>Controle</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="tela_apresentacao">
                                                    <i class='icon-tags'></i>
                                                    <span>Cadastro de Empresas</span>
                                                </a>
                                            </li>                                            
                                            <li>
                                                <a tabindex="-1" href='#' id="tela_apresentacao">
                                                    <i class='icon-tags'></i>
                                                    <span>Cadastro de Filiais</span>
                                                </a>
                                            </li>                            
                                            <li>
                                                <a tabindex="-1" href='#' id="tela_apresentacao">
                                                    <i class='icon-tags'></i>
                                                    <span>Cadastro de Funcionários via planilha</span>
                                                </a>
                                            </li>                                            
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>                            
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['relatorios'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-paper-plane'></i>
                                    <span>Relatórios Grupo AMA</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Periódicos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href='javascript:void(0);'>
                                                    <i class='icon-tags'></i>
                                                    <span>Gestão de Redes</span>
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="clinicas_x_medicos">
                                                            <i class='icon-tags'></i>
                                                            <span>Clínicas x Médicos</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="clinicas">
                                                            <i class='icon-tags'></i>
                                                            <span>Clínicas</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="consolidado">
                                                            <i class='icon-tags'></i>
                                                            <span>Consolidado</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='javascript:void(0);'>
                                                    <i class='icon-tags'></i>
                                                    <span>Registros</span>
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="registros_movimentacao_bradesco_upload">
                                                            <i class='icon-upload-3'></i>
                                                            <span>Upload TXT Bradesco</span>
                                                        </a>
                                                    </li>                                                    
                                                    <li>
                                                        <a tabindex="-1" href='#' id="registros_movimentacao_bradesco_file">
                                                            <i class='icon-tags'></i>
                                                            <span>Gerar TXT Bradesco</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="registro_relatorio">
                                                            <i class='icon-tags'></i>
                                                            <span>Gerar Movimentação Bradesco - Walmart</span>
                                                        </a>
                                                    </li>                                                    
                                                </ul>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='javascript:void(0);'>
                                                    <i class='icon-tags'></i>
                                                    <span>Walmart</span>
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="realizado_no_realizado">
                                                            <i class='icon-upload-3'></i>
                                                            <span>Relação Lojas - Realizado/Não Realizado</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="relatorio_anual_pcmso">
                                                            <i class='icon-upload-3'></i>
                                                            <span>Relatório Anual PCMSO</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['herval'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-adult'></i>
                                    <span>HERVAL</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Periódicos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li class='has_sub'>
                                                <a href='javascript:void(0);'>
                                                    <span>Deveres Herval</span> 
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="herval_tipo_agendamento"><i class='icon-exclamation'></i><span>Adicionar / Editar Tipos de Agendamento</span></a>
                                                    </li>                                            
                                                </ul>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="herval_sint_listar">
                                                    <i class='icon-tags'></i>
                                                    <span>Incluir / Editar / Sínteses</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="herval_agendamento">
                                                    <i class='icon-tags'></i>
                                                    <span>Incluir / Editar / Agendamentos / Convocações</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="herval_agendamento_individual_listar">
                                                    <i class='icon-tags'></i>
                                                    <span>Marcar Horários Individuais nas Convocações</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="herval_agendamento_enviar">
                                                    <i class='icon-tags'></i>
                                                    <span>Enviar Convocações via Email</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="herval_extras">
                                                    <i class='icon-tags'></i>
                                                    <span>Relação Extras</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="herval_extras_planilha">
                                                    <i class='icon-export'></i>
                                                    <span>Excel Relação Extras</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['herval_gerencial'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-adult'></i>
                                    <span>HERVAL Gerencial</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Periódicos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href='#' id="clinicas_x_medicos">
                                                    <i class='icon-tags'></i>
                                                    <span>Botar aqui</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['herval_indicadores'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-adult'></i>
                                    <span>HERVAL Indicadores</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Periódicos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href='#' id="clinicas_x_medicos">
                                                    <i class='icon-tags'></i>
                                                    <span>Botar aqui</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);' <?php echo $array_permissao['tst'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-adult'></i>
                                    <span>TST</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Trabalhos TST</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li class='has_sub'>
                                                <a href='javascript:void(0);'>
                                                    <span>Deveres TST</span> 
                                                    <span class="pull-right">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="tst_lojas_listar">
                                                            <i class='icon-tags'></i>
                                                            <span>Incluir / Editar / Excluir /Lojas</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="tst_lojas_funcoes_incluir">
                                                            <i class='icon-tags'></i>
                                                            <span>Incluir Funções e Descrições por Loja</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="tst_lojas_funcoes">
                                                            <i class='icon-tags'></i>
                                                            <span>Editar / Excluir / Funções e Descrições por Loja</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="tst_lojas_medicoes_incluir">
                                                            <i class='icon-tags'></i>
                                                            <span>Incluir Medições por Loja</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="tst_lojas_medicoes">
                                                            <i class='icon-tags'></i>
                                                            <span>Editar / Excluir / Medições por Loja</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="tst_nome_agenda_listar">
                                                            <i class='icon-tags'></i>
                                                            <span>Incluir / Editar / Excluir / Nome Agendamento</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="tst_nome_cargos_listar">
                                                            <i class='icon-tags'></i>
                                                            <span>Incluir / Editar / Excluir / Cargos</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="tst_tecnicos_listar">
                                                            <i class='icon-tags'></i>
                                                            <span>Incluir / Editar / Excluir / Técnicos</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="tst_tecnicos_listar">
                                                            <i class='icon-tags'></i>
                                                            <span>Incluir / Editar / Excluir / Condicionantes Contratos</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="tst_tecnicos_listar">
                                                            <i class='icon-tags'></i>
                                                            <span>Incluir / Editar / Excluir / CRONOGRAMA DE VISITAS TÉCNICAS</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="tst_tecnicos_listar">
                                                            <i class='icon-tags'></i>
                                                            <span>Gerar Contratos</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a tabindex="-1" href='#' id="tst_tecnicos_listar">
                                                            <i class='icon-tags'></i>
                                                            <span>Listar Contratos</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>                                            
                                            <li>
                                                <a tabindex="-1" href='#' id="tst_agendamento_listar">
                                                    <i class='icon-tags'></i>
                                                    <span>Incluir / Editar / Agendamentos/Convocações</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="tst_checklist">
                                                    <i class='icon-check'></i>
                                                    <span>Incluir / Editar / Checklist</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a tabindex="-1" href='#' id="tst_agendamento_enviar">
                                                    <i class='icon-tags'></i>
                                                    <span>Enviar Convocações via Email</span>
                                                </a>
                                            </li>                                            
                                            <li>
                                                <a tabindex="-1" href='#' id="tst_agendamento_enviados">
                                                    <i class='icon-tags'></i>
                                                    <span>Convocações Enviadas</span>
                                                </a>
                                            </li>                                            
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['tst_gerencial'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-adult'></i>
                                    <span>TST Gerencial</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>TST</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href='#' id="tst_log_operacoes">
                                                    <i class='icon-tags'></i>
                                                    <span>Log de Operações</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['tst_indicadores'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-adult'></i>
                                    <span>TST Indicadores</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>TST</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href='#' id="clinicas_x_medicos">
                                                    <i class='icon-tags'></i>
                                                    <span>Botar aqui</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'  <?php echo $array_permissao['demandas'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <i class='icon-briefcase'></i>
                                    <span>Demandas</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li class='has_sub'>
                                        <a href='javascript:void(0);'>
                                            <span>Processos</span> 
                                            <span class="pull-right">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href='#' id="abrir_demanda">
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
                                                <a tabindex="-1" href='#' id="executar_demanda">
                                                    <i class='icon-tags'></i>
                                                    <span>Executar Demanda</span>
                                                </a>
                                            </li>
                                        </ul>
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
                    <div class="row top-summary" id="refresca_cada_quarenta">
                        <div class="col-lg-3 col-md-6" <?php
                        if (($array_permissao['super_admin'] == 1) or ( $array_permissao['admin'] === 1) or ( $array_permissao['lojas'] === 1)
                                or ( $array_permissao['convocacao'] === 1) or ( $array_permissao['medicos_walmart'] === 1) or ( $array_permissao['indicadores_walmart'] === 1)
                                or ( $array_permissao['relatorios'] === 1) or ( $array_permissao['herval_indicadores'] === 1) or ( $array_permissao['herval_gerencial'] === 1) or ( $array_permissao['herval'] === 1)or ( $array_permissao['demandas'] === 1)) {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <div class="widget green-1 animated fadeInDown">
                                <div class="widget-content padding">
                                    <div class="widget-icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="text-box">
                                        <p class="maindata">Total <b>Ativos Walmart</b></p>
                                        <h2><span class="animate-number" data-value="<?php echo $total; ?>" data-duration="15500">0</span></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="widget-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <i class="fa fa-caret-up rel-change"></i> <b><?php echo $porcentagem; ?>%</b> Riscos e Exames Ajustados
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6" <?php
                        if (($array_permissao['super_admin'] == 1) or ( $array_permissao['admin'] === 1) or ( $array_permissao['lojas'] === 1)
                                or ( $array_permissao['convocacao'] === 1) or ( $array_permissao['medicos_walmart'] === 1) or ( $array_permissao['indicadores_walmart'] === 1)
                                or ( $array_permissao['relatorios'] === 1) or ( $array_permissao['herval_indicadores'] === 1) or ( $array_permissao['herval_gerencial'] === 1) or ( $array_permissao['herval'] === 1)
                                or ( $array_permissao['tst_indicadores'] === 1) or ( $array_permissao['tst_gerencial'] === 1) or ( $array_permissao['tst'] === 1) or ( $array_permissao['demandas'] === 1)) {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <div class="widget orange-4 animated fadeInDown">
                                <div class="widget-content padding">
                                    <div class="widget-icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="text-box">
                                        <p class="maindata">TOTAL <b>CONVOCADOS</b></p>
                                        <h2><span class="animate-number" data-value="0" data-duration="3000">0</span></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="widget-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <i class="fa fa-caret-down rel-change"></i> <b>0%</b> executados
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6" <?php
                        if (($array_permissao['super_admin'] == 1) or ( $array_permissao['admin'] === 1) or ( $array_permissao['lojas'] === 1)
                                or ( $array_permissao['convocacao'] === 1) or ( $array_permissao['medicos_walmart'] === 1) or ( $array_permissao['indicadores_walmart'] === 1)
                                or ( $array_permissao['relatorios'] === 1) or ( $array_permissao['herval_indicadores'] === 1) or ( $array_permissao['herval_gerencial'] === 1) or ( $array_permissao['herval'] === 1)
                                or ( $array_permissao['tst_indicadores'] === 1) or ( $array_permissao['tst_gerencial'] === 1) or ( $array_permissao['tst'] === 1) or ( $array_permissao['demandas'] === 1)) {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <div class="widget lightblue-1 animated fadeInDown">
                                <div class="widget-content padding">
                                    <div class="widget-icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="text-box">
                                        <p class="maindata">TOTAL <b>ASOS Corretos</b></p>
                                        <h2><span class="animate-number" data-value="<?php echo $fizeram_periodicos ?>" data-duration="3000"></span></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="widget-footer">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <i class="fa fa-caret-square-o-down rel-change"></i> <b><?php echo $ativo_erro; ?></b> ASOS com Erro
                                        </div>
                                        <div class="col-sm-6">
                                            <i class="fa fa-caret-up rel-change"></i> <b class="text-danger"><?php echo bcadd($fizeram_periodicos, $ativo_erro, 0); ?></b> ASOS Inseridos
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>                                
                            </div>                            
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-lg-8 portlets" id="conteudo_superior">
                            <div class="widget lightblue-2 animated fadeInDown">
                                <div class="widget-content padding">
                                    <div class="widget-icon">
                                        <i class="fa fa-key"></i>
                                    </div>
                                    <div class="text-box">
                                        <p class="maindata text-center">Diário do <b>Supremo</b></p>                                        
                                        <p class="maindata text-center"><b><?php echo $tema_de_hoje['history']; ?></b></p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="col-lg-8 portlets" id="conteudo"></div>
                        <div class="col-lg-4 portlets" id="conteudo_lateral"></div>
                        <div class="col-lg-12 portlets" id="conteudo_exclusivo"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 portlets" id="conteudo_inferior"></div>
                        <div class="col-lg-4 portlets" id="conteudo_lateral_inferior">
                            <div class="row" <?php echo $_SESSION['user_id'] == 1 ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                <table class="table table-striped table-noborder table-responsive">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-info" colspan="2">Novidades do Mundo Tecnológico!!</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Título!</th>
                                            <th class="text-center">Notícia!</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $xml = simplexml_load_file("http://g1.globo.com/dynamo/tecnologia/rss2.xml");
                                    $cont = 0;
                                    $limit = 3;
                                    foreach ($xml->channel->item as $item) {
                                        echo '<tr>';
                                        echo '<td class="text-center text-info"><small>' . $item->title . '</small></td>';
                                        echo '<td class="text-center text-info"><small>' . $item->description . '</small></td>';
                                        echo '</tr>';
                                        ++$cont;
                                        if ($cont == $limit) {
                                            break;
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>                        
                        <div class="row"><div class="col-lg-4 col-md-6 portlets"></div></div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 portlets"><div id="stock-app" class="widget green-3"><div class="widget-footer"></div></div></div>
                        </div>                    
                        <footer>
                            TI - Grupo Ama Gestão &copy; <?php echo date("Y"); ?>
                            <div class="footer-links pull-right">
                                <a href="#" class="md-trigger" id="sobre">Sobre</a>
                                <a href="#" class="md-trigger" id="suporte">Suporte</a>
                                <a href="#" class="md-trigger" id="termos_servico">Termos de Serviço</a>
                                <a href="#" class="md-trigger" id="juridico">Jurídico</a>
                                <a href="#" class="md-trigger" id="ajuda">Ajuda</a>
                                <a href="#" class="md-trigger" id="contato">Contato</a>
                                <a href="#" class="md-trigger" id="talk_folks">Converse com a TI</a>
                            </div>
                        </footer>                    
                    </div>
                </div>        
            </div>
            <div class="md-overlay"></div>        
    </body>
</html>