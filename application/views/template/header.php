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
                <span> <a href="<?php echo base_url('home/sair'); ?>" title="Terminar Sessão" data-action="userLogout" data-logout-msg="Pode reforçar a segurança fechando o browser!"><i class="fa fa-sign-out"></i></a> </span>
            </div>
            <!-- end logout button -->

            <!-- logout button -->
            <div id="lock" class="btn-header transparent pull-right">
                <span> <a href="<?php echo base_url('home/bloquear'); ?>" title="Bloquear" data-action="userLock" data-logout-msg="A sua sessão vai ficar bloqueada até fechar o browser!"><i class="fa fa-lock"></i></a> </span>
            </div>
            <!-- end logout button -->

            <!-- search mobile button (this is hidden till mobile view port) -->
            <div id="search-mobile" class="btn-header transparent pull-right">
                <span> <a href="javascript:void(0)" title="procurar"><i class="fa fa-search"></i></a> </span>
            </div>
            <!-- end search mobile button -->

            <!-- input: search field -->
            <form action="#" class="header-search pull-right">
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