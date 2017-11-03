const $select    = jQuery('.form-group select');
const $input     = jQuery('.form-group input');
const $form      = jQuery('#trabajo');
const $btnSubmit = jQuery('#trabajo .btn-submit');
const $cal       = jQuery('#trabajo');

//Estado activo de los campos//
const campoActive = (el) =>{

	jQuery(el)
		.focusin(function() {
			jQuery(this).parent().addClass('active')
		
		})
		.focusout(function() {

			let $self = jQuery(this);

			if (jQuery($self).val() != '' ){
				jQuery($self).parent().addClass('active')

			}else{
				jQuery($self).parent().removeClass('active')

			}
		});

};


jQuery(document).ready( ()=>{

	//inputs activos
	campoActive($input);

	//Selects activos

	$select.change(function () {
		let $self = jQuery(this);

		if(jQuery(this).val() != ''){
			jQuery($self)
			.parent().addClass('active')
		}else{
			jQuery($self)
			.parent().removeClass('active')

		}
	});


	//metodo para aceptar texto con espacios y caracteres especiales

	jQuery.validator.addMethod('letras', function(val, el){
		return this.optional(el) || /^[a-z" "ñÑáéíóúÁÉÍÓÚ,.;]+$/i.test(val);
	});

	jQuery.validator.addMethod("email", function(a, e) {
        return this.optional(e)||/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(a)
    });


	//Ubicacion de mensaje de error//
	const errorPlacement = (error, element)=>{
		error.insertAfter(element.parent())
	};

	$form.validate({
		// debug: true,

		errorElement: 'div',
		errorClass: 'msn-place',

		rules: {

		  nombre: 			{required:true,letras:true},
		  apellidos: 		{required:true,letras:true },
		  municipio: 		{ required:true },
		  ciudad: 			{ required:true  },
		  telefono: 		{ digits:true, minlength:9, maxlength:10 },
		  email: 			{required:true,	email:true},
		  politicas: 		{ required:true  }

		},


		messages: {
		  nombre:{
		  	required:'Indicanos tu nombre',
		  	letras: 'Solo ingresa letras'
		  },
		  apellidos:{
		  	required:'Indicanos tus apellidos',
		  	letras: 'Solo ingresa letras'
		  },
		  municipio:{
		  	required:'debes ingresar el lugar'
		  },
		  ciudad:{
		  	required:'debes ingresar una ciudad'
		  },
		  telefono:{
		  	digits:'Solo ingresa n&uacute;meros',
		  	minlength: 'N&uacute;mero no v&aacute;lido',
		  	maxlength: 'N&uacute;mero no v&aacute;lido'
		  },
		  email:{
		  	required: 'Indicanos un email' ,
		  	email: 'Formato de email inv&aacute;lido'
		  },
		  politicas:{
		  	required: 'Debes aceptar el aviso de privacidad'
		  }

		},
        submitHandler: function(form){
            var nombres = $("#nombres").val();
            var apellidos = $("#apellidos").val();
            var departamento = $("#departamento").val();
            var ciudad = $("#ciudad").val();
            var correo = $("#correo").val();
            var telefono = $("#telefono").val();
            $.post("usuario.php", {nombres: nombres, apellidos: apellidos, departamento: departamento,ciudad: ciudad, 
            correo: correo, telefono: telefono, accion: "insertar_usuario" }, function(data) {
                if(data){
                    alert("Correcto.");
                }else{
                    alert("ERROR.");
                }
            });
        }

	});


	$("#departamento").change(function() {
        $("#departamento option:selected").each(function() {
            departamento = $(this).val();
            $.post("usuario.php", {departamento: departamento, accion: "cargar_ciudad"}, function(data) {
                var options = '';
                var content = JSON.parse(data);
                if(content == ''){
                    options = '<option value="">Seleccione</option>';
                }else{
                    for (var i = 0; i < content.length; i++) {
                        options += '<option value="' + content[i]['idCiudad'] + '">' + content[i]['nombre'] + '</option>';
                    }
                }
                $("#ciudad").html(options);
            });
        });
    });

	
/*No pasar de acá para el DOM ready*/
});