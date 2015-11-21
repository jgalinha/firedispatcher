<!DOCTYPE html>
<html lang="<?php echo $this->config->item('lang'); ?>" id="extr-page">

<head>
    <meta charset="utf-8">
    <title>
        <?php echo $this->config->item('title') . " " .  $this->config->item('version'); ?>
    </title>
    <meta name="description" content="<?php echo $this->config->item('description'); ?>">
    <meta name="author" content="<?php echo $this->config->item('author'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- #CSS Links -->
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-production-plugins.min.css'); ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-production.min.css'); ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-skins.min.css'); ?>">

    <!-- SmartAdmin RTL Support -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-rtl.min.css'); ?>">

    <!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->

    <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp 
<link rel="stylesheet" type="text/css" media="screen" href=""> -->

    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon/favicon.ico'); ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url('assets/img/favicon/favicon.ico'); ?>" type="image/x-icon">

    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <!-- #APP SCREEN / ICONS -->
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
    <link rel="apple-touch-startup-image" href="<?php echo base_url('assets/img/splash/ipad-landscape.png'); ?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="<?php echo base_url('assets/img/splash/ipad-portrait.png'); ?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="<?php echo base_url('assets/img/splash/iphone.png'); ?>" media="screen and (max-device-width: 320px)">

</head>

<body class="animated fadeInDown">

    <header id="header">

        <div id="logo-group">
            <h2><?php echo $this->config->item('title'); ?></h2>
        </div>

        <span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs">Já tem conta?</span> <a href="<?php echo base_url('conta/entrar');?>" class="btn btn-danger">Entre aqui</a> </span>

    </header>

    <div id="main" role="main">

        <!-- MAIN CONTENT -->
        <div id="content" class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                    <div class="well no-padding">
                        <form action="<?php echo base_url('conta/registar'); ?>" id="smart-form-register" class="smart-form client-form" method="post">
                            <input type="hidden" name="registar" value="registar">
                            <header>
                                Registo
                            </header>
                            <?php 
                                if($alerta != null){
                                    print('<div class="alert alert-' . $alerta['class'] . ' alert-block">');
                                    print('<a class="close" data-dismiss="alert" href="#">×</a>');
                                    print('<h4 class="alert-heading">' . $alerta['cabeçalho'] . '</h4>');
                                    print($alerta['mensagem']);
                                    print('</div>');
                                } 
                            ?>
                                <fieldset>
                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="number" name="utilizador" placeholder="utilizador">
                                            <b class="tooltip tooltip-bottom-right">O seu número mecanográfico</b> </label>
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Endereço de Email">
                                            <b class=" tooltip tooltip-bottom-right ">O seu endereço de email</b> </label>
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-lock "></i>
                                            <input type="password" name="password" placeholder="Password" id="password">
                                            <b class="tooltip tooltip-bottom-right ">Não se esqueça da sua password</b> </label>
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-lock "></i>
                                            <input type="password" name="passwordConfirm" placeholder="Confirmação da password">
                                            <b class="tooltip tooltip-bottom-right">Não se esqueça da sua password</b> </label>
                                    </section>
                                </fieldset>

                                <fieldset>
                                    <div class="row ">
                                        <section class="col col-6 ">
                                            <label class="input ">
                                                <input type="text " name="firstname" placeholder="Primeiro Nome ">
                                            </label>
                                        </section>
                                        <section class="col col-6 ">
                                            <label class="input ">
                                                <input type="text " name="lastname" placeholder="Último Nome ">
                                            </label>
                                        </section>
                                    </div>

                                </fieldset>
                                <footer>
                                    <button type="submit " class="btn btn-primary ">
                                        Registar
                                    </button>
                                </footer>

                                <div class="message ">
                                    <i class="fa fa-check "></i>
                                    <p>
                                        Obrigado pelo seu registo!
                                    </p>
                                </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

    </div>

    <!--================================================== -->

    <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
    <script src="<?php echo base_url( 'assets/js/plugin/pace/pace.min.js'); ?>"></script>

    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        if (!window.jQuery) {
            document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
        }
    </script>

    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        if (!window.jQuery.ui) {
            document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
        }
    </script>

    <!-- IMPORTANT: APP CONFIG -->
    <script src="<?php echo base_url('assets/js/app.config.js'); ?>"></script>

    <!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
<script src="<?php echo base_url('assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js'); ?>"></script> -->

    <!-- BOOTSTRAP JS -->
    <script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>

    <!-- JQUERY VALIDATE -->
    <script src="<?php echo base_url('assets/js/plugin/jquery-validate/jquery.validate.min.js'); ?>"></script>

    <!-- JQUERY MASKED INPUT -->
    <script src="<?php echo base_url('assets/js/plugin/masked-input/jquery.maskedinput.min.js'); ?>"></script>

    <!--[if IE 8]>
			
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
			
		<![endif]-->

    <!-- MAIN APP JS FILE -->
    <script src="<?php echo base_url('assets/js/app.min.js'); ?>"></script>

    <script type="text/javascript">
        runAllForms();

        // Validation
        $(function () {
            // Validation
            $("#smart-form-register").validate({

                // Rules for form validation
                rules: {
                    utilizador: {
                        number: true,
                        required: true,
                        minlength: 7,
                        maxlength: 8
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength: 20
                    },
                    passwordConfirm: {
                        required: true,
                        minlength: 5,
                        maxlength: 20,
                        equalTo: '#password'
                    },
                    firstname: {
                        required: true
                    },
                    lastname: {
                        required: true
                    }
                },

                // Messages for form validation
                messages: {
                    utilizador: {
                        required: 'Por favor introduza o seu número mecanográfico'
                    },
                    email: {
                        required: 'Por favor introduza o seu email',
                        email: 'Por favor introduza um email válido'
                    },
                    password: {
                        required: 'Por favor introduza a sua password'
                    },
                    passwordConfirm: {
                        required: 'Por favor introduza a sua password mais uma vez',
                        equalTo: 'As passwords não são iguais'
                    },
                    firstname: {
                        required: 'Por favor introduza o seu primeiro nome'
                    },
                    lastname: {
                        required: 'Por favor introduza o seu último nome'
                    }
                },

                // Ajax form submition
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        success: function () {
                            $("#smart-form-register").addClass('submited');
                        }
                    });
                },

                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });

        });
    </script>

</body>

</html>