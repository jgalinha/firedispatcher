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
        <section id="widget-grid" class="">
            <div class="row">
				<!-- NEW WIDGET START -->
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-red" id="wid-id-utilizadores" data-widget-editbutton="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2>Utilizadores</h2>
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
								<table data-order='[[ 0, "asc" ], [ 1, "asc" ]]' id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
									<thead>
										<tr>
											<th data-hide="phone,tablet">Estado</th>
											<th data-hide="phone">Nº Mec.</th>
											<th data-class="expand">Nome</th>
											<th data-hide="phone,tablet">Email</th>
											<th data-hide="phone,tablet">Tag</th>
											<th data-hide="phone,tablet">Permissões</th>
										</tr>
									</thead>
									<tbody id="users">
											<?php
											if($users){
												foreach ($users as $user){
													$label = " ";
													if($user['status'] == 1) {
														$label = '<button id="' . $user['user'] . '"class="btn btn-success btn-xs" data-id="' . $user['user'] . '">Ativo</button>';
													}
													if($user['status'] == 0) {
														$label = '<button id="' . $user['user'] . '"class="btn btn-warning btn-xs" data-id="' . $user['user'] . '">Inactivo</button>';
													}
													if($user['activated'] == 0) {
														$label = '<button class="btn btn-danger btn-xs">Por Confirmar</button>';
													}
													echo "<tr>"; 
													echo "<td>" . $label . "</td>"; 
													echo "<td>" . $user['user'] . "</td>"; 
													echo "<td>" . $user['firstName'] . " " . $user['lastName'] . "</td>"; 
													echo "<td>" . $user['email'] . "</td>"; 
													echo '<td>
													<input class="form-control tagsinput" value="' . $user['type'].' " data-role="tagsinput">
													</td>';
													echo '<td><form class="smart-form"><label class="select"><select data-id="' . $user['user'] . '" class="input-s" id="type">';
													echo '<option></option>';
													foreach ($profiles as $profile){
														if($user['roles'] === $profile->name){
															echo '<option selected="selected" data-id="' . $user['user'] . '" value ="' . $profile->name . '">' . $profile->name . '</option>';	
														} else {

															echo '<option data-id="' . $user['user'] . '" value ="' . $profile->name . '">' . $profile->name . '</option>';	
														}
													}
													echo "</select></label></form></td>";
													echo "</tr>"; 
												}
											}?>
										
									</tbody>
								</table>
							</div>
							<!-- end widget content -->

						</div>
						<!-- end widget div -->

					</div>
					<!-- end widget -->

				</article>
				<!-- WIDGET END -->
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