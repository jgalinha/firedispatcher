
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

    })

</script>