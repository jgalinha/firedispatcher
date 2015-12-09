<!DOCTYPE html>
<html lang="<?php echo $this->config->item('lang'); ?>">

<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

    <title>
        <?php echo $this->config->item('title') . " " .  $this->config->item('version'); ?>
    </title>
    <meta name="description" content="<?php echo $this->config->item('description'); ?>">
    <meta name="author" content="<?php echo $this->config->item('author'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">


    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-production-plugins.min.css'); ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-production.min.css'); ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-skins.min.css'); ?>">

    <!-- SmartAdmin RTL Support  -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-rtl.min.css'); ?>">

    <!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->

    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon/favicon.ico'); ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url('assets/img/favicon/favicon.ico'); ?>" type="image/x-icon">

    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <!-- Specifying a Webpage Icon for Web Clip
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
    <link rel="apple-touch-icon" href="<?php echo base_url('assets/img/splash/sptouch-icon-iphone.png'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/splash/touch-icon-ipad.png'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('assets/img/splash/touch-icon-iphone-retina.png'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('assets/img/splash/touch-icon-ipad-retina.png'); ?>">

    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Startup image for web apps -->
    <!-- Startup image for web apps -->
    <link rel="apple-touch-startup-image" href="<?php echo base_url('assets/img/splash/ipad-landscape.png'); ?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="<?php echo base_url('assets/img/splash/ipad-portrait.png'); ?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="<?php echo base_url('assets/img/splash/iphone.png'); ?>" media="screen and (max-device-width: 320px)">


</head>

<!--

	TABLE OF CONTENTS.

	Use search to find needed section.

	===================================================================

	|  01. #CSS Links                |  all CSS links and file paths  |
	|  02. #FAVICONS                 |  Favicon links and file paths  |
	|  03. #GOOGLE FONT              |  Google font link              |
	|  04. #APP SCREEN / ICONS       |  app icons, screen backdrops   |
	|  05. #BODY                     |  body tag                      |
	|  06. #HEADER                   |  header tag                    |
	|  07. #PROJECTS                 |  project lists                 |
	|  08. #TOGGLE LAYOUT BUTTONS    |  layout buttons and actions    |
	|  09. #MOBILE                   |  mobile view dropdown          |
	|  10. #SEARCH                   |  search field                  |
	|  11. #NAVIGATION               |  left panel & navigation       |
	|  12. #RIGHT PANEL              |  right panel userlist          |
	|  13. #MAIN PANEL               |  main panel                    |
	|  14. #MAIN CONTENT             |  content holder                |
	|  15. #PAGE FOOTER              |  page footer                   |
	|  16. #SHORTCUT AREA            |  dropdown shortcuts area       |
	|  17. #PLUGINS                  |  all scripts and plugins       |

	===================================================================

	-->

<!-- #BODY -->
<!-- Possible Classes

		* 'smart-style-{SKIN#}'
		* 'smart-rtl'         - Switch theme mode to RTL
		* 'menu-on-top'       - Switch to top navigation (no DOM change required)
		* 'no-menu'			  - Hides the menu completely
		* 'hidden-menu'       - Hides the main menu but still accessable by hovering over left edge
		* 'fixed-header'      - Fixes the header
		* 'fixed-navigation'  - Fixes the main menu
		* 'fixed-ribbon'      - Fixes breadcrumb
		* 'fixed-page-footer' - Fixes footer
		* 'container'         - boxed layout mode (non-responsive: will not work with fixed-navigation & fixed-ribbon)
	-->

<body class="fixed-header minified smart-style-1">

    <!-- HEADER -->
    <header id="header">
        <div id="logo-group">

            <!-- PLACE YOUR LOGO HERE -->
            <span id="logo"></span>
            <!-- END LOGO PLACEHOLDER -->

            <!-- Note: The activity badge color changes when clicked and resets the number to 0
				Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
            <span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge"> 0 </b> </span>

            <!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
            <div class="ajax-dropdown">

                <!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio" name="activity" id="ajax/notify/mail.html"> Msgs (0) </label>
                    <label class="btn btn-default">
                        <input type="radio" name="activity" id="ajax/notify/notifications.html"> notificações (0) </label>
                    <label class="btn btn-default">
                        <input type="radio" name="activity" id="ajax/notify/tasks.html"> Tarefas (0) </label>
                </div>

                <!-- notification content -->
                <div class="ajax-notifications custom-scroll">

                    <div class="alert alert-transparent">
                        <h4>Clica nos botões acima para mostrar as mensagens</h4>
                    </div>

                    <i class="fa fa-lock fa-4x fa-border"></i>

                </div>
                <!-- end notification content -->

                <!-- footer: refresh area -->
                <span> Ultima atualização em: 12/12/2013 9:43AM
                                    <button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Carregando..." class="btn btn-xs btn-default pull-right">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                </span>
                <!-- end footer -->

            </div>
            <!-- END AJAX-DROPDOWN -->
        </div>


        <!-- pulled right: nav area -->
        <div class="pull-right">

            <!-- collapse menu button -->
            <div id="hide-menu" class="btn-header pull-right">
                <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
            </div>
            <!-- end collapse menu -->

            <!-- logout button -->
            <div id="logout" class="btn-header transparent pull-right">
                <span> <a href="<?php echo base_url('conta/sair'); ?>" title="Terminar Sessão" data-action="userLogout" data-logout-msg="Pode reforçar a segurança fechando o browser!"><i class="fa fa-sign-out"></i></a> </span>
            </div>
            <!-- end logout button -->

            <!-- logout button -->
            <div id="lock" class="btn-header transparent pull-right">
                <span> <a href="<?php echo base_url('conta/bloquear'); ?>" title="Bloquear" data-action="userLock" data-logout-msg="A sua sessão vai ficar bloqueada até fechar o browser!"><i class="fa fa-lock"></i></a> </span>
            </div>
            <!-- end logout button -->

            <!-- search mobile button (this is hidden till mobile view port) -->
            <div id="search-mobile" class="btn-header transparent pull-right">
                <span> <a href="javascript:void(0)" title="procurar"><i class="fa fa-search"></i></a> </span>
            </div>
            <!-- end search mobile button -->

            <!-- input: search field -->
            <form action="search.html" class="header-search pull-right">
                <input id="search-fld" type="text" name="param" placeholder="Procurar" data-autocomplete='[
					"ActionScript",
					"AppleScript",
					"Asp",
					"BASIC",
					"C",
					"C++",
					"Clojure",
					"COBOL",
					"ColdFusion",
					"Erlang",
					"Fortran",
					"Groovy",
					"Haskell",
					"Java",
					"JavaScript",
					"Lisp",
					"Perl",
					"PHP",
					"Python",
					"Ruby",
					"Scala",
					"Scheme"]'>
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>
                <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
            </form>
            <!-- end input: search field -->

            <!-- fullscreen button -->
            <div id="fullscreen" class="btn-header transparent pull-right">
                <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
            </div>
            <!-- end fullscreen button -->



        </div>
        <!-- end pulled right: nav area -->

    </header>
    <!-- END HEADER -->

    <!-- Left panel : Navigation area -->
    <!-- Note: This width of the aside area can be adjusted through LESS variables -->
    <aside id="left-panel">

        <!-- User info -->
        <div class="login-info">
            <span> <!-- User image size is adjusted inside CSS, it should stay as it -->

					<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
						<img src="<?php echo base_url('assets/img/avatars/sunny.png'); ?>" alt="me" class="online" />
						<span>
							José Galinha
						</span>
            <i class="fa fa-angle-down"></i>
            </a>

            </span>
        </div>
        <!-- end user info -->

        <!-- NAVIGATION : This navigation is also responsive-->
        <nav>
            <ul>
                <li class="active">
                    <a href="<?php echo base_url('home');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
                </li>
                <li>
                    <a href="inbox.html"><i class="fa fa-lg fa-fw fa-fire"></i> <span class="menu-item-parent">Bombeiros</span></a>
                </li>
            </ul>
        </nav>
        <span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

    </aside>
    <!-- END NAVIGATION -->

    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">

            <span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Atenção! Isto vai fazer reset nas suas configurações." data-html="true">
						<i class="fa fa-refresh"></i>
					</span>
            </span>

            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li>Home</li>
                <li>Dashboard</li>
            </ol>
            <!-- end breadcrumb -->

        </div>
        <!-- END RIBBON -->

        <!-- MAIN CONTENT -->
        <div id="content">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> My Dashboard</span></h1>
                </div>

            </div>
            <!-- widget grid -->
            <section id="widget-grid" class="">

            </section>
            <!-- end widget grid -->
        </div>
        <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN PANEL -->

    <!-- PAGE FOOTER -->
    <div class="page-footer">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <span class="txt-color-white"><?php echo $this->config->item('title'); ?> <span class="hidden-xs"> - <?php echo $this->config->item('description'); ?></span>
                <?php echo $this->config->item('copyright'); ?>
                    </span>
            </div>

        </div>
    </div>
    <!-- END PAGE FOOTER -->

    <!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
		Note: These tiles are completely responsive,
		you can add as many as you like
		-->
    <div id="shortcut">
        <ul>
            <li>
                <a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>Perfil </span> </span>
                </a>
            </li>
        </ul>
    </div>
    <!-- END SHORTCUT AREA -->

    <!--================================================== -->

    <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
    <script data-pace-options='{ "restartOnRequestAfter": true }' src="j<?php echo base_url('assets/js/plugin/pace/pace.min.js'); ?>"></script>

    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        if (!window.jQuery) {
            document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
        }
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        if (!window.jQuery.ui) {
            document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
        }
    </script>

    <!-- IMPORTANT: APP CONFIG -->
    <script src="<?php echo base_url('assets/js/app.config.js'); ?>"></script>

    <!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
    <script src="<?php echo base_url('assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js'); ?>"></script>

    <!-- BOOTSTRAP JS -->
    <script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>

    <!-- CUSTOM NOTIFICATION -->
    <script src="<?php echo base_url('assets/js/notification/SmartNotification.min.js'); ?>"></script>

    <!-- JARVIS WIDGETS -->
    <script src="<?php echo base_url('assets/js/smartwidgets/jarvis.widget.min.js'); ?>"></script>

    <!-- EASY PIE CHARTS -->
    <script src="<?php echo base_url('assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js'); ?>"></script>

    <!-- SPARKLINES -->
    <script src="<?php echo base_url('assets/js/plugin/sparkline/jquery.sparkline.min.js'); ?>"></script>

    <!-- JQUERY VALIDATE -->
    <script src="<?php echo base_url('assets/js/plugin/jquery-validate/jquery.validate.min.js'); ?>"></script>

    <!-- JQUERY MASKED INPUT -->
    <script src="<?php echo base_url('assets/js/plugin/masked-input/jquery.maskedinput.min.js'); ?>"></script>

    <!-- JQUERY SELECT2 INPUT -->
    <script src="<?php echo base_url('assets/js/plugin/select2/select2.min.js'); ?>"></script>

    <!-- JQUERY UI + Bootstrap Slider -->
    <script src="<?php echo base_url('assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js'); ?>"></script>

    <!-- browser msie issue fix -->
    <script src="<?php echo base_url('assets/js/plugin/msie-fix/jquery.mb.browser.min.js'); ?>"></script>

    <!-- FastClick: For mobile devices -->
    <script src="<?php echo base_url('assets/js/plugin/fastclick/fastclick.min.js'); ?>"></script>

    <!--[if IE 8]>

		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

		<![endif]-->

    <!-- Demo purpose only
<script src="js/demo.min.js"></script>-->

    <!-- MAIN APP JS FILE -->
    <script src="<?php echo base_url('assets/js/app.min.js'); ?>"></script>

    <!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
    <!-- Voice command : plugin -->
    <script src="<?php echo base_url('assets/js/speech/voicecommand.min.js'); ?>"></script>

    <!-- SmartChat UI : plugin -->
    <script src="<?php echo base_url('assets/js/smart-chat-ui/smart.chat.ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/smart-chat-ui/smart.chat.manager.min.js'); ?>"></script>

    <!-- PAGE RELATED PLUGIN(S) -->

    <!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
    <script src="<?php echo base_url('assets/js/plugin/flot/jquery.flot.cust.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugin/flot/jquery.flot.resize.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugin/flot/jquery.flot.time.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugin/flot/jquery.flot.tooltip.min.js'); ?>"></script>

    <!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
    <script src="<?php echo base_url('assets/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>

    <!-- Full Calendar -->
    <script src="<?php echo base_url('assets/js/plugin/moment/moment.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugin/fullcalendar/jquery.fullcalendar.min.js'); ?>"></script>

    <!--
   <script>
    $("#lock").click(function (e) {
        $.SmartMessageBox({
                title: "<i class='fa fa-sign-out txt-color-orangeDark'></i> Bloquear Sessão <span class='txt-color-orangeDark'><strong>" + $("#show-shortcut").text() + "</strong></span> ?",
                content: "This is a confirmation box. Can be programmed for button callback",
                buttons: '[Não][Sim]'
            }, function (ButtonPressed) {
                if (ButtonPressed === "Sim") {

                }
            }

        }); e.preventDefault();
    })
</script>
-->
    <!--
    <script>
        $("#lock").click(function (e) {;
            $.SmartMessageBox({
                title: "Smart Alert!",
                content: "This is a confirmation box. Can be programmed for button callback",
                buttons: '[No][Yes]'
            }, function (ButtonPressed) {
                if (ButtonPressed === "Yes") {
                    e.stopPropagation();
                }

                e.preventDefault()
            });

        })
    </script>
-->

</body>

</html>