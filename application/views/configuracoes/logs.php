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
           <?php
            foreach ($breadcrumb as $bread) {
                echo "<li>" . $bread . "</li>";
            }
            ?>

        </ol>
        <!-- end breadcrumb -->

    </div>
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->
    <div id="content">
        
        <!-- widget grid -->
            <div class="row">
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-red" id="wid-id-perfis" data-widget-fullscreenbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
						<!-- widget options:
usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

data-widget-colorbutton="false"
data-widget-editbutton="false"
data-widget-togglebutton="false"
data-widget-deletebutton="false"
data-widget-fullscreenbutton="false"
data-widget-custombutton="false"
data-widget-collapsed="true"
data-widget-sortable="false"

-->
						<header>
							<span class="widget-icon"> <i class="fa fa-book"></i> </span>
							<h2>Visualizador de Logs</h2>
						</header>

						<!-- widget div-->
						<div>

							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->

							</div>
							<!-- end widget edit box -->

							<!-- widget content -->
							<div class="widget-body no-padding">
								<table data-order='[[ 3, "dsc" ]]' id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
									<thead>
										<tr>
											<th class="hasinput">
												<input type="text" class="form-control" placeholder="Filtrar Movimento" />
											</th>
											<th class="hasinput">
												<input type="text" class="form-control" placeholder="Filtrar Utilizador" />
											</th>
											<th class="hasinput">
												<input type="text" class="form-control" placeholder="Filtrar Log" />
											</th>
											<th class="hasinput icon-addon">
												<input id="dateselect_filter" type="text" placeholder="Filtrar Data" class="form-control datepicker" data-dateformat="yy-mm-dd">
												<label for="dateselect_filter" class="glyphicon glyphicon-calendar no-margin padding-top-15" rel="tooltip" title="" data-original-title="Filter Date"></label>
											</th>
										</tr>
										<tr>
											<th data-class="expand">Movimento</th>
											<th data-hide="phone,tablet">Utilizador</th>
											<th data-hide="phone,tablet">Log</th>
											<th data-hide="phone,tablet">Data</th>
										</tr>
									</thead>
									<tbody id="logs">
										<?php 

										//print("<pre>".print_r($profiles,true)."</pre>");
										if($logs){
											foreach ($logs as $log)
											{
												echo '<tr id="' . $log->_id . '">';
												echo "<td>" . $log->movement . "</td>";
												echo "<td>" . $log->user . "</td>";
												echo "<td><pre>".print_r($log->log,true)."</pre></td>";
												echo "<td>" . date('Y-m-d H:i:s', $log->_id->getTimestamp()) . "</td>";
												echo "</tr>";
											}
										}
										?>
									</tbody>
								</table>
							</div>
							<!-- end widget content -->

						</div>
						<!-- end widget div -->

					</div>
					<!-- end widget -->

				</article>
            </div>
            <!--                  
foreach ($users as &$user){
foreach ($user as $key => $value) {
echo "Key: $key; Value: $value<br />\n";
}
}
-->
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->