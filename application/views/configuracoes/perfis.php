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
        <div class="row">

        </div>
        <!-- widget grid -->
        <section id="widget-grid" class="">
           <div class="row">
           <article class="col-sm-12">
				<?php 
				if($alerta){
				?>
			   	<div class="alert alert-<?php echo $alerta['class']; ?> fade in">
					<button class="close" data-dismiss="alert">×</button>
					<i class="fa-fw fa fa-<?php echo $alerta['icon']; ?>"></i>
				   <strong><?php echo $alerta['cabeçalho']; ?></strong>
					<?php echo $alerta['mensagem']; ?>
				</div>
				<?php
				}
				?>
           </article>       
           </div>
            <div class="row">
                <!-- NEW WIDGET START -->
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
                            <span class="widget-icon"> <i class="fa fa-cog"></i> </span>
                            <h2>Perfis de Utilizador</h2>
                            
							<div class="widget-toolbar">
								<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
									Adicionar perfil
								</button>
							</div>
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
                            <?php 
								if(!$profiles){
									print('<div class="alert alert-info no-margin fade in">
										<i class="fa-fw fa fa-info"></i>
										Não existem registos para mostar!
									</div>');
								}
								?>

								<table data-order='[[ 3, "dsc" ]]' id="dt_basic" class="table table-bordered">
                                    <thead>
                                        <tr>
											<th data-class="expand">Nome</th>
											<th data-hide="phone,tablet">Descrição</th>
											<th data-hide="always">Data de criação</th>
											<th data-hide="always">Data da última alteração</th>
											<th data-hide="always">Permissões</th>
											<th data-hide="phone,tablet">Operações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="perfis">
                                    <?php 

										//print("<pre>".print_r($profiles,true)."</pre>");
												if($profiles){
													foreach ($profiles as $profile)
													{
														echo '<tr id="' . $profile->name . '">';
														echo "<td>" . $profile->name . "</td>";
														echo "<td>" . $profile->description . "</td>";
														echo "<td>" . date('H:i:s d-m-Y', $profile->create_date->sec) . "</td>";
														echo "<td>" . date('H:i:s d-m-Y', $profile->last_edit->sec) . "</td>";
														echo "<td><pre>".print_r($profile->permissions,true)."</pre></td>";
														//echo date('Y-m-d H:i:s', $profile['last_edit']->sec);
														echo '<td><button data-id="'. $profile->_id .'" data-profile="'. $profile->name .'" class="btn btn-xs btn-default" data-original-title="Editar"><i class="fa fa-pencil"></i></button>';
														echo '<button data-profile="'. $profile->name .'" class="btn btn-xs btn-default" data-original-title="Apagar"><i class="fa fa-times"></i></button></td>';
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
        </section>
        <!-- end widget grid -->
        
		<!-- Modal Adicionar Perfil -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title">
							Adicionar perfil
						</h4>
					</div>
					<div class="modal-body no-padding">
						<form id="perfil-form" class="smart-form" method="post" action="<?php echo base_url('configuracoes/perfis'); ?>">
							<fieldset>
								<section>
									<div class="row">
										<div class="col col-md-12">
											<label class="input">
												<input type="text" name="nome" placeholder="Nome do perfil" required>
												<input type="hidden" name="captcha">
											</label>
										</div>
									</div>
								</section>

								<section>
									<div class="row">
										<div class="col col-md-12">
											<label class="textarea textarea-expandable"> 										
												<textarea class="custom-scroll" rows="3" name="descricao" placeholder="Descrição do perfil" required></textarea> 
											</label>
										</div>
									</div>
								</section>
								<section>
									<div class="row">
										<div class="col col-md-12">
											<h5>Permissões</h5>
											<div class="well well-sm well-primary tree">
												<ul>
													<li>
														<span><i class="fa fa-lg fa-home"></i> <?php echo $this->config->item('title'); ?></span>
														<ul>
															<?php
															
															function toggle($value, $vName, $pName){
																if($value){
																	echo '<label class="checkbox inline-block">';
																	echo '<input type="checkbox" name="'. $pName . '-' . $vName . '" checked="checked">';
																	echo '<i></i>' . $vName . '</label>';
																}else{
																	echo '<label class="checkbox inline-block">';
																	echo '<input type="checkbox" name="'. $pName . '-' . $vName . '">';
																	echo '<i></i>' . $vName . '</label>';
																}
															}

															function tree($struct){
																foreach ($struct as $st){
																	if(is_array($st)){
																		if($st['sub']){
																			echo '<li>';
																			echo '<span><i class="fa fa-lg fa-plus-circle"></i> ' . $st['name'] . '</span>';
																			echo "<ul>";
																			tree($st);
																			echo "</ul>";
																			echo '</li>';   
																		}else{
																			echo '<li>';
																			echo '<span><i class="fa fa-lg fa-plus-circle"></i> ' . $st['name'] . '</span>';
																			echo "<ul>";
																			echo '<li style="display:none"><span><i class="icon-leaf"></i> ';
																			toggle($st['view'], "Consultar", $st['name']);
																			echo '</span></li>';
																			echo '<li style="display:none"><span><i class="icon-leaf"></i> ';
																			toggle($st['view'], "Editar", $st['name']);
																			echo '</span></li>';
																			echo "</ul>";
																			echo '</li>';    
																		}
																	}
																}
															}                                                
															tree($struct);
															?>
														</ul>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</section>
							</fieldset>

							<footer>
								<button type="submit" name="guardar" value="guardar" class="btn btn-primary">
									Guardar
								</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">
									Cancelar
								</button>

							</footer>
						</form>						


					</div>

				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- Fim Modal Adicionar Perfil -->
		<!-- Modal Editar Perfil-->
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title">
							Editar perfil
						</h4>
					</div>
					<div class="modal-body no-padding">
						<form id="perfil-edit-form" class="smart-form" method="post" action="<?php echo base_url('configuracoes/perfis'); ?>">
							<fieldset>
								<section>
									<div class="row">
										<div class="col col-md-12">
											<label class="input">
												<input type="text" name="nomeEdit" placeholder="Nome do perfil" required>
												<input type="hidden" name="captcha">
												<input type="hidden" name="id">
											</label>
										</div>
									</div>
								</section>

								<section>
									<div class="row">
										<div class="col col-md-12">
											<label class="textarea textarea-expandable"> 										
												<textarea class="custom-scroll" rows="3" name="descricaoEdit" placeholder="Descrição do perfil" required></textarea> 
											</label>
										</div>
									</div>
								</section>
								<section>
									<div class="row">
										<div class="col col-md-12">
											<h5>Permissões</h5>
											<div class="well well-sm well-primary tree">
												<ul>
													<li>
														<span><i class="fa fa-lg fa-home"></i> <?php echo $this->config->item('title'); ?></span>
														<ul>
															<?php
															$editar = "editar";
															function toggle_editar($value, $vName, $pName){
																if($value){
																	echo '<label class="checkbox inline-block">';
																	echo '<input type="checkbox" name="'. $pName . '-' . $vName . '" checked="checked">';
																	echo '<i></i>' . $vName . '</label>';
																}else{
																	echo '<label class="checkbox inline-block">';
																	echo '<input type="checkbox" name="'. $pName . '-' . $vName . '-Editar">';
																	echo '<i></i>' . $vName . '</label>';
																}
															}

															function tree_editar($struct){
																foreach ($struct as $st){
																	if(is_array($st)){
																		if($st['sub']){
																			echo '<li>';
																			echo '<span><i class="fa fa-lg fa-plus-circle"></i> ' . $st['name'] . '</span>';
																			echo "<ul>";
																			tree_editar($st);
																			echo "</ul>";
																			echo '</li>';   
																		}else{
																			echo '<li>';
																			echo '<span><i class="fa fa-lg fa-plus-circle"></i> ' . $st['name'] . '</span>';
																			echo "<ul>";
																			echo '<li style="display:none"><span><i class="icon-leaf"></i> ';
																			toggle_editar($st['view'], "Consultar", $st['name']);
																			echo '</span></li>';
																			echo '<li style="display:none"><span><i class="icon-leaf"></i> ';
																			toggle_editar($st['view'], "Editar", $st['name']);
																			echo '</span></li>';
																			echo "</ul>";
																			echo '</li>';    
																		}
																	}
																}
															}                                                
															tree_editar($struct);
															?>
														</ul>
														
													</li>
												</ul>
											</div>
										</div>
									</div>
								</section>
							</fieldset>

							<footer>
								<button type="submit" name="editar" value="editar" class="btn btn-primary">
									Guardar
								</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">
									Cancelar
								</button>

							</footer>
						</form>						


					</div>

				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- Modal Editar Perfil -->
    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->