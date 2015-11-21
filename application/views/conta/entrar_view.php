<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/materialize.min.css'); ?>" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>" media="screen,projection" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        body,
        html {
            background-color: #EDEDED !important;
        }
        
        .login_head {
            background: #5c6bc0;
            height: 226px;
        }
        
        .login_page {
            margin: -131px auto 90px;
            max-width: 404px;
        }
        
        .login_head_wrap {
            height: 75px;
            border: 0px;
            margin: 0px;
        }
        
        .login_form_wrap {
            background: #fff;
            padding: 44px 65px;
            border-radius: 2px;
            border: 0px;
            margin: 0px;
            max-width: none;
        }
        
        .footer {
            color: #5c6bc0;
            font-size: 13px;
            line-height: 16px;
            margin-top: 25px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid">

        <div class="login_head">
        </div>
        <div class="login_page">
            <form action="<?php echo base_url('conta/entrar');?>" method="post">
                <input type="hidden" name="captcha">
                <div class="row login_head_wrap">
                    <div class="col s2 left white-text">
                        <?php echo $this->config->item('title') . " " . $this->config->item('version'); ?>
                    </div>
                    <div class="col s2 right white-text">
                        <button class="btn-flat waves-effect waves-light indigo lighten-1" type="submit" value="entrar" name="entrar">
                            <i class="material-icons left white-text">send</i>
                        </button>
                    </div>
                </div>
                <?php if($alerta != null){ ?>
                    <div class="card-panel <?php echo $alerta['class']; ?>">
                        <p class="">
                            <?php echo $alerta['mensagem']; ?>
                        </p>
                    </div>
                    <?php } ?>
                        <div class="row login_form_wrap">

                            <div class="input-field">
                                <input id="utilizador" name="utilizador" type="number" class="validate" value="<?php echo set_value('utilizador'); ?>" required>
                                <label for="utilizador">utilizador</label>
                            </div>
                            <div class="input-field">
                                <input id="password" name="password" type="password" class="validate" value="<?php echo set_value('password'); ?>" required>
                                <label for="password">password</label>
                            </div>
                        </div>
            </form>
            <div class="footer">
                <p>Bem vindo ao
                    <?php echo $this->config->item('title'); ?>
                </p>
                <p>
                    <?php echo $this->config->item('copyright'); ?>
                </p>
            </div>
        </div>



    </div>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.1.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/materialize.min.js'); ?>"></script>
</body>

</html>