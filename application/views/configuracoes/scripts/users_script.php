<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo base_url('assets/js/plugin/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.colVis.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.tableTools.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugin/datatable-responsive/datatables.responsive.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/plugin/bootstrap-progressbar/bootstrap-progressbar.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js'); ?>"></script>

<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function () {
        pageSetUp();
        /* BASIC ;*/
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        /* TABLETOOLS */
        $('#datatable_tabletools').dataTable({
            // Tabletools options: 
            //   https://datatables.net/extensions/tabletools/button_options
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
            "oTableTools": {
                "aButtons": [
            "copy",
            "csv",
            "xls",
                    {
                        "sExtends": "pdf",
                        "sTitle": "FireDispatcher_PDF",
                        "sPdfMessage": "FireDispatcher PDF Export",
                        "sPdfSize": "letter"
            },
                    {
                        "sExtends": "print",
                        "sMessage": "Gerado por FireDispatcher <i>(Esc para fechar)</i>"
            }
        ],
				"sSwfPath": "http://127.0.0.1/firedispatcher/assets/js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
            },
            "autoWidth": true,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_tabletools) {
                    responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_datatable_tabletools.respond();
            }
        });
        /* END TABLETOOLS */
        
        $( "select" ).change(function() {
            var profile = $(this, "option:selected" ).val();
            var user = $(this, "option:selected" ).data('id');
            $.ajax({
                url: "changeUserProfile",
                data: {
                    user: user,
                    profile: profile
                },
                type: 'post',
                success: function(result){
                    var array =jQuery.parseJSON(result);
                    if (array.result === true) {
                        if (array.result === true) {
                            var title = "<b>Permissões alteradas</b>";
                            if (profile.length === 0){
                                var content = "Permissões do utilizador " + user + " removidas";
                            }else{
                                var content = "Permissões do utilizador " + user + " alteradas para <b>" + profile + "</b>";
                            }
                            var color = "#739E73";
                            var iconSmall = "fa fa-thumbs-up bounce animated";
                            var timeout = 40000;
                            smartAlert(title, content, color, iconSmall, timeout);
                        }
                        if (array.result === false) {
                            var title = "<b>Erro de permissões</b>";
                            var content = "Não tem permissões para executar esta operação";
                            var iconSmall = "fa fa-exclamation bounce animated";
                            var color = "#C46A69";
                            var timeout = 4000;
                            smartAlert(title, content, color, iconSmall, timeout);
                        }
                    } else {
                        var title = "<b>Erro</b>";
                        var content = "Ocorreu um erro!<br> Contacte o administrador";
                        var iconSmall = "fa fa-exclamation bounce animated";
                        var color = "#C46A69";
                        var timeout = 4000;
                        smartAlert(title, content, color, iconSmall, timeout);
                    }
                }
            });
        });
        
        $('#users').on("click", "button", function () {
            var user = $(this).data('id');
            $.ajax({
                url: "change_user_status",
                data: {
                    user: user
                },
                type: 'post',
                success: function (result) {
                    var array = jQuery.parseJSON(result);

                    if (array.result == true) {
                        if (array.status == 1) {
                            $("#" + user).text("Ativo");
                            $("#" + user).removeClass("btn-warning").addClass("btn-success");
                            var title = "<b>Conta Ativa</b>";
                            var content = "Conta do utilizador " + user + " ativada com sucesso!<br>Enviar email com informação?<p class='text-align-left'><a href='javascript:sendEmail(" + user + ");' class='btn btn-primary btn-sm'>Sim</a> <a href='javascript:void(0);' class='btn btn-danger btn-sm'>Não</a></p>";
                            var color = "#739E73";
                            var iconSmall = "fa fa-thumbs-up bounce animated";
                            var timeout = 40000;
                            smartAlert(title, content, color, iconSmall, timeout);
                        }
                        if (array.status == 0) {
                            $("#" + user).text("Inactivo");
                            $("#" + user).removeClass("btn-success").addClass("btn-warning");
                            var title = "<b>Conta Inativa</b>";
                            var content = "Conta do utilizador " + user + " desativada com sucesso!<br>Enviar email com informação?<p class='text-align-left'><a href='javascript:sendEmail(" + user + ");' class='btn btn-primary btn-sm'>Sim</a> <a href='javascript:void(0);' class='btn btn-danger btn-sm'>Não</a></p>";
                            var color = "#C79121";
                            var iconSmall = "fa fa-thumbs-up bounce animated";
                            var timeout = 40000;
                            smartAlert(title, content, color, iconSmall, timeout);
                        }
                    } else {
                        var title = "<b>Erro</b>";
                        var content = "Ocorreu um erro!<br> Contacte o administrador";
                        var iconSmall = "fa fa-exclamation bounce animated";
                        var color = "#C46A69";
                        var timeout = 4000;
                        smartAlert(title, content, color, iconSmall, timeout);
                    }
                }
            });
        });
        
    });
    

    function smartAlert(title, content, color, icon, time) {

        $.smallBox({
            title: title,
            content: content,
            color: color,
            iconSmall: icon,
            timeout: time
        });

    }
    

    function sendEmail(user){
        $.ajax({
            url: "send_status_email",
            data: {
                user: user
            },
            type: 'post',
            success: function (result) {
                var array = jQuery.parseJSON(result);

                if (array.result == true) {
                    var title = "<b>Email Enviado</b>";
                    var content = "Email enviado com sucesso para o utilizador " + user;
                    var color = "#739E73";
                    var iconSmall = "fa fa-thumbs-up bounce animated";
                    var timeout = 4000;
                    smartAlert(title, content, color, iconSmall, timeout);
                } else {
                    var title = "<b>Erro</b>";
                    var content = "Ocorreu um erro no envio do email!<br> Contacte o administrador";
                    var iconSmall = "fa fa-exclamation bounce animated";
                    var color = "#C46A69";
                    var timeout = 4000;
                    smartAlert(title, content, color, iconSmall, timeout);
                }
            }
        });
    }
</script>