var x=false;
$(function() {
    $( "#dialog-confirm" ).dialog({
	  autoOpen: false,
      resizable: false,
      height:400,
      modal: true,
      buttons: {
        "Aceptar": function() {
          //$(this).attr("acepto", true);
          window.location.href=$("#btnEliminar").attr("href");
          $( this ).dialog( "close" );
          
        },
        Cancelar: function() {
    	  //$(this).attr("acepto",false);
          $( this ).dialog( "close" );
        }
      }
    });
  });
/*
function validar(){
	var controlador=false;
	console.log( $( "#dialog-confirm" ).dialog("open").attr("acepto"));
	//return x;
}
*/
$(document).ready(function(){
	$("#btnEliminar").on("click",function(ev){
		//alert("HOLA");
		ev.preventDefault();
		console.log( $( "#dialog-confirm" ).dialog("open").attr("acepto"));
	});
});

