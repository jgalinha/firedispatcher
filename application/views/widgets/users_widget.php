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

                <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>
                        <tr>
                            <th data-hide="phone,tablet">Estado</th>
                            <th data-hide="phone">Nº Mec.</th>
                            <th data-class="expand">Nome</th>
                            <th data-hide="phone,tablet">Email</th>
                            <th data-hide="phone,tablet">Perfil</th>
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
								if($user['type'] == "God"){ 
									echo '<td><span class="label label-warning">' . $user['type'] . '</span></td>'; 
								} else { 
									echo "<td>" . $user['type'] . "</td>"; 
								}
								if($user['roles'] == "God Mod"){ 
									echo '<td><span class="label label-warning">' . $user['roles'] . '</span></td>'; 
								} else { 
									echo "<td>" . $user['roles'] . "</td>"; 
								} 
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