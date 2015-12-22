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
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-cog"></i> 
                <?php
                    $i = 0;
                    foreach ($breadcrumb as $bread) {
                        if($i == 1){
                            echo "<span> > ";
                        } else if ($i > 0){
                            echo ">";
                        }
                        echo " " . $bread . " ";
                        if ($i == 0){
                        }
                        $i ++;
                    }
                    echo "</span>";
                ?></h1>
            </div>

        </div>
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <div class="row">
                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-perfis" data-widget-fullscreenbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
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

                            <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Permissões</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                           <?php 

										print("<pre>".print_r($struct,true)."</pre>");
												if($profiles){
													
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
        
		<!-- Modal -->
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
																	echo '<label class="toggle">';
																	echo '<input type="checkbox" name="'. $pName . '-' . $vName . '" checked="checked">';
																	echo '<i data-swchon-text="ON" data-swchoff-text="OFF"></i>' . $vName . '</label>';
																}else{
																	echo '<label class="toggle">';
																	echo '<input type="checkbox" name="'. $pName . '-' . $vName . '">';
																	echo '<i data-swchon-text="ON" data-swchoff-text="OFF"></i>' . $vName . '</label>';
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
        
    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->