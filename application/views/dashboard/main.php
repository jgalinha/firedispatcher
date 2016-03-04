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
        <!--<div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> My Dashboard</span></h1>
            </div>

        </div>-->
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <div class="row">
                <!-- widgets -->
				<!-- NEW WIDGET START -->
				<article id="rcm" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">


					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-3" data-swchon-text="True" data-widget-editbutton="false" >
						<header role="heading">
							<h2><strong>Risco de Incêndio</strong></h2>	

							<ul id="widget-tab-1" class="nav nav-tabs pull-right">

								<li class="active">
									<a aria-expanded="true" data-toggle="tab" href="#hr1"> <i class="fa fa-lg fa-arrow-circle-o-down"></i> <span class="hidden-mobile hidden-tablet">Hoje</span> </a>
								</li>
								<li class="">
									<a aria-expanded="false" data-toggle="tab" href="#hr2"> <i class="fa fa-lg fa-arrow-circle-o-up"></i> <span class="hidden-mobile hidden-tablet">Amanhã</span></a>
								</li>

							</ul>	

							<span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>

						<!-- widget div-->
						<div role="content">

							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->

							</div>
							<!-- end widget edit box -->

							<!-- widget content -->
							<div class="widget-body no-padding">

								<!-- widget body text-->

								<div class="tab-content padding-10">
									<div class="tab-pane fade active in" id="hr1" align="center">
										<img src="http://www.ipma.pt/resources.www/transf/indices/rcm_dh.jpg" alt="Risco de incêndio para hoje" height="50%" width="50%">
									</div>
									<div class="tab-pane fade" id="hr2" align="center">

										<img src="http://www.ipma.pt/resources.www/transf/indices/rcm_da.jpg" alt="Risco de incêndio para amanhã" height="50%" width="50%">
	
									</div>
								</div>

								<!-- end widget body text-->

								<!-- widget footer -->
								
								<!-- end widget footer -->

							</div>
							<!-- end widget content -->

						</div>
						<!-- end widget div -->

					</div>

				</article>
				<!-- WIDGET END -->
                <?php
                    $this->load->view('widgets/users_widget.php', $users);
                ?>
            </div>
            <!--                  
                    foreach ($users as &$user){
                        foreach ($user as $key => $value) {
                            echo "Key: $key; Value: $value<br />\n";
                        }
                    }
            -->
        </section>
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->