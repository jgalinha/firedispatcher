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
<?php   
        //TODO : Arranjar maneira de só aparecer com o widget
        if($page == "dashboard"){
            $this->load->view('widgets/scripts/users_widget_script.php');
        }
        if($page == "permissoes"){
            $this->load->view('widgets/scripts/permissoes_widget_script.php');
        }
?>
    </body>

    </html>