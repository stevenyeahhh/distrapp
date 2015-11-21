$(document).ready(function(){
	$("[name='estado[]']").bootstrapSwitch();
	$(".chkEstado").on("switchChange.bootstrapSwitch",function(event,state){
		//console.log(event);
		//console.log(state);
		//alert($(this).val());
		$.ajax({
			url:CONTROLLERPATH+"cambiarEstadoUsuario",
			type:"POST",
			data:{
				usuario:$(this).val(),
				estado:state?1:0
			},
			error:function (error){
				console.log(error);
				$("<div class='mensaje alert alert-danger'></div>").insertBefore("h1").text("Ha ocurrido un error").append('<button type="button" class="close" data-dismiss="alert">&times;</button>').show().delay(100).fadeOut(5000);

			},
			success:function(success){
				console.log(success);
				
				$("<div class='mensaje alert alert-success'></div>").insertBefore("h1").text(success).append('<button type="button" class="close" data-dismiss="alert">&times;</button>').show().delay(100).fadeOut(5000);
			}
		});
	})
});