
 <!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo base_url('assets/js/plugin/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.colVis.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.tableTools.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugin/datatable-responsive/datatables.responsive.min.js'); ?>"></script>
<script type="text/javascript">

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

        pageSetUp();
		
		/* BASIC ;*/ 
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;

		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};

		$('#dt_basic').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
			"t"+
			"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});

		/* END BASIC */
		
        // PAGE RELATED SCRIPTS

        $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
        $('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span').attr('title', 'Abrir ramo').on('click', function(e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(':visible')) {
                children.hide('fast');
                $(this).attr('title', 'Abrir ramo').find(' > i').removeClass().addClass('fa fa-lg fa-plus-circle');
            } else {
                children.show('fast');
                $(this).attr('title', 'Fechar ramo').find(' > i').removeClass().addClass('fa fa-lg fa-minus-circle');
            }
            e.stopPropagation();
        });		
		
		runAllForms();
		$(function () {
			// Validation
			$("#perfil-form").validate({
				// Rules for form validation
				rules: {
					nome: {
						required: true,
					},
					descricao: {
						required: true,
					}
				},
				// Messages for form validation
				messages: {
					nome: {
						required: 'Por favor introduza o nome do perfil',
					},
					descricao: {
						required: 'Por favor introduza a descrição do perfil',
					}
				},
				// Ajax form submition
				submitHandler: function (form) {
					$(form).ajaxSubmit({
						success: function () {
							$("#perfil-form").addClass('submited');
						}
					});
				},
				// Do not change code below
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				}
			});
		});

    });

</script>


<script type="text/javascript">

	$('#perfis').on("click", "button", function () {
		var profile = $(this).data('profile');
		console.log(profile);
		var op = $(this).data('original-title');
		if(op == "Apagar"){
			var title = "<b>Eliminação de Perfil</b>";
			var content = "Deseja realmente remover o perfil <b>" + profile + "</b>?<p class='text-align-left'><a href='javascript:removeProfile(\"" + profile + "\");' class='btn btn-primary btn-sm'>Sim</a> <a href='javascript:void(0);' class='btn btn-danger btn-sm'>Não</a></p>";
			var color = "#C46A69";
			var iconSmall = "fa fa-thumbs-up bounce animated";
			var timeout = 40000;
			smartAlert(title, content, color, iconSmall, timeout);
		} else if(op == "Editar"){
			editProfile(profile);
		}
		
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
	
	function editProfile(profile){
		$.ajax({
			url: "<?php echo base_url();?>configuracoes/getProfile",
			data: {
				profile: profile
			},
			type: 'POST',
			success: function (result) {				
				var array = jQuery.parseJSON(result);
				//tree(array.result.permissions);
				$("#perfil-edit-form input[name='nomeEdit']").val(array.result.name);
				$("#perfil-edit-form textarea[name='descricaoEdit']").val(array.result.description);
				$('#myModalEdit').modal('show');
				$.each( array.result.permissions, function( key, value ) {
					if( (typeof value === "object") && (value !== null) )
					{
						if (value.sub){
							$.each(value, function(key2, value2){
								if((typeof value2 === "object") && (value2 !== null)){
									if(value2.view){
										$("#perfil-edit-form input[name='" + value2.name + "-Consultar-Editar']").prop('checked', true)
									} else {
										$("#perfil-edit-form input[name='" + value2.name + "-Consultar-Editar']").prop('checked', false)
									}
									if(value2.edit){
										$("#perfil-edit-form input[name='" + value2.name + "-Editar-Editar']").prop('checked', true)
									} else {
										$("#perfil-edit-form input[name='" + value2.name + "-Editar-Editar']").prop('checked', false)
									}
								}
							})
						} else {
							if(value.view){
								$("#perfil-edit-form input[name='" + value.name + "-Consultar-Editar']").prop('checked', true)
							} else {
								$("#perfil-edit-form input[name='" + value.name + "-Consultar-Editar']").prop('checked', false)
							}
							if(value.edit){
								$("#perfil-edit-form input[name='" + value.name + "-Editar-Editar']").prop('checked', true)
							} else {
								$("#perfil-edit-form input[name='" + value.name + "-Editar-Editar']").prop('checked', false)
							}	
						}
					}
				});
			}
		});
		
	}
	
	function tree(array){
		$.each( array, function( key, value ) {
			if(typeof value === 'object'){
				
			}
		});
	}
	
	function toggle(){
		
	}
	
	function removeProfile(profile){
		console.log(profile);
		$.ajax({
			url: "<?php echo base_url();?>configuracoes/removeProfile",
			data: {
				profile: profile
			},
			type: 'POST',
			success: function (result) {
				var array = jQuery.parseJSON(result);
				if (array.result == true) {
					var title = "<b>Perfil removido</b>";
					var content = "O perfil <b>" + profile + "</b> foi removido com sucesso";
					var color = "#739E73";
					var iconSmall = "fa fa-thumbs-up bounce animated";
					var timeout = 4000;
					deleteRow(profile);
					location.reload();
					smartAlert(title, content, color, iconSmall, timeout);
				} else {
					var title = "<b>Erro!</b>";
					var content = "Ocorreu um erro ao remover o perfil <b>" + profile + "</b>!<br> Contacte o administrador";
					var iconSmall = "fa fa-exclamation bounce animated";
					var color = "#C46A69";
					var timeout = 4000;
					smartAlert(title, content, color, iconSmall, timeout);
				}
			}
		});
	}
	
	function deleteRow(rowid)  
	{   
		var row = document.getElementById(rowid);
		var table = row.parentNode;
		while ( table && table.tagName != 'TABLE' )
			table = table.parentNode;
		if ( !table )
			return;
		table.deleteRow(row.rowIndex);
	}
	
</script>