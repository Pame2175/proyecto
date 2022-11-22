	/*=============================================
AGREGAR MULTIMEDIA CON DROPZONE
=============================================*/

var arrayFiles = [];

$(".multimediaFisica").dropzone({

	url: "/",
	addRemoveLinks: true,
	acceptedFiles: "image/jpeg, image/png",
	maxFilesize: 2, //2mb
	maxFiles: 10, 	//maximo 10 archivos
	init: function(){

		this.on("addedfile", function(file){

			arrayFiles.push(file);

			// console.log("arrayFiles", arrayFiles);

		})

		this.on("removedfile", function(file){

			var index = arrayFiles.indexOf(file);

			arrayFiles.splice(index, 1);

			// console.log("arrayFiles", arrayFiles);

		})

	}

})


/*=============================================
GUARDAR EL PRODUCTO
=============================================*/

var multimediaFisica = null;



$(".guardarProducto").click(function(){

	/*=============================================
	PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
	=============================================*/

	if($(".tituloProducto").val() != "" && arrayFiles != "" ){

		/*=============================================
	   	PREGUNTAMOS SI VIENEN IMÁGENES PARA MULTIMEDIA O LINK DE YOUTUBE
	   	=============================================*/

	   		if(arrayFiles.length > 0 ){

	   			var listaMultimedia = [];
	   			var finalFor = 0;

	   			for(var i = 0; i < arrayFiles.length; i++){

	   				var datosMultimedia = new FormData();
	   				datosMultimedia.append("file", arrayFiles[i]);
	   				datosMultimedia.append("nombre_denunciante", $(".nombre_denunciante").val());
					datosMultimedia.append("celular", $(".celular").val());
					datosMultimedia.append("cedula", $(".cedula").val());
					datosMultimedia.append("direccion", $(".direccion").val());
					datosMultimedia.append("denunciante_cod", $(".denunciante_cod").val());
					datosMultimedia.append("estados", $(".estados").val());
					datosMultimedia.append("tituloProducto", $(".tituloProducto").val());
					
					
					$.ajax({
						url:"productos.ajax.php",
						method: "POST",
						data: datosMultimedia,
						cache: false,
						contentType: false,
						processData: false,
						beforeSend: function() {
						    $('.guardarProducto').html("Enviando ...");
						 },
						success: function(respuesta){
							
							listaMultimedia.push({"foto" : respuesta})
							multimediaFisica = JSON.stringify(listaMultimedia);
							

							if((finalFor + 1) == arrayFiles.length){

								agregarMiProducto(multimediaFisica); 
								finalFor = 0; 

							}

							finalFor++;
							
							$('.guardarProducto').html("Guardar producto");
							
							
							
						}

					})

	   			}

	   		}

	   		

	}else{
		swal({
	      title: "Rellenar todos los campos",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

		return;
	}

})


function agregarMiProducto(imagen){

		/*=============================================
		ALMACENAMOS TODOS LOS CAMPOS DE PRODUCTO
		=============================================*/
		var nombre_denunciante= $(".nombre_denunciante").val();
		var celular = $(".celular").val();
		var cedula = $(".cedula").val();
		var direccion= $(".direccion").val();
		var denunciante_cod= $(".denunciante_cod").val();
		var estados= $(".estados").val();
		var tituloProducto = $(".tituloProducto").val();


	 	var datosProducto = new FormData();
	 	datosProducto.append("nombre_denunciante", nombre_denunciante);
	 	datosProducto.append("celular", celular);
	 	datosProducto.append("cedula", cedula);
	 	datosProducto.append("direccion", direccion);
	 	datosProducto.append("denunciante_cod", denunciante_cod);
	 	datosProducto.append("estados", estados);
		datosProducto.append("tituloProducto", tituloProducto);
		
		datosProducto.append("multimedia", imagen);
		$.ajax({
				url:"productos.ajaxSubida.php",
				method: "POST",
				data: datosProducto,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
				    $('.guardarProducto').html("Enviando ...");
				 },
				success: function(respuesta){
						
					// console.log("respuesta", respuesta);

					if(respuesta == "ok"){

						swal2({
						  type: "success",
						  title: "El producto ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							$('.guardarProducto').html("Guardar producto");
							window.location = "./";

							}
						})
					}else if(respuesta == "error"){
						swal({
						  type: "error",
						  title: "¡Ocurrio un error!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
						  $('.guardarProducto').html("Guardar producto");	
							
						})
					}

				}

		})


}
