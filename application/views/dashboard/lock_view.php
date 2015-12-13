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
        
        <!-- page related CSS -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/lockscreen.min.css'); ?>">

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

    <style>
        #main{
            margin-left: 0px;
        }
    </style>
   
    </head>

    <body>

        <div id="main" role="main">

            <!-- MAIN CONTENT -->
            
            <?php 
            $attributes = array(
                'id' => 'lock-form',
                'class' => 'lockscreen animated flipInY'
            );

            echo form_open('home', $attributes, array('captcha' => ''));
            ?>
                <div class="logo">
                    <h1 class="semi-bold"><img src="<?php echo base_url('assets/img/logo-o.png'); ?>" alt="" /><?php echo " " . $this->config->item('title') ?></h1>
                </div>
                <div>
                    <img src="<?php echo base_url('assets/img/avatars/male.png'); ?>" alt="" width="120" height="120" />
                    <div>
                        <h1><i class="fa fa-user fa-3x text-muted air air-top-right hidden-mobile"></i>
                           <?php
                                echo $this->session->userdata('firstName') . " " . $this->session->userdata('lastName');
                            ?>
                            <small><i class="fa fa-lock text-muted"></i> &nbsp;Bloqueado</small></h1>
                        <p class="text-muted">
                            <a href="<?php echo $email; ?>"><?php echo $email; ?></a>
                        </p>

                        <div class="input-group">
                            <input class="form-control" name="lock" type="password" placeholder="Password">
                            <div class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-key"></i>
                                </button>
                            </div>
                        </div>
                        <p class="no-margin margin-top-5">
                            Entrar com outra conta? <a href="<?php echo base_url('home/sair'); ?>"> Clica aqui</a>
                        </p>
                    </div>

                </div>
                <p class="font-xs margin-top-5">
                    <?php echo $this->config->item('copyright'); ?>
                </p>
            </form>

        </div>

        <!--================================================== -->	

        <!--================================================== -->
        <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
        <script src="<?php echo base_url('assets/js/plugin/pace/pace.min.js'); ?>"></script>
        
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
            $("#lock-form").validate({

                // Rules for form validation
                rules: {
                    lock: {
                        required: true,
                        minlength: 5,
                        maxlength: 20
                    }
                },

                // Messages for form validation
                messages: {
                    lock: {
                        required: 'Por favor introduza a sua password'
                    }
                },

                // Ajax form submition
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        success: function () {
                            $("#lock-form").addClass('submited');
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