<script type="text/javascript">

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

        pageSetUp();

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