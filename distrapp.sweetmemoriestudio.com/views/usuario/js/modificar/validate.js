$(function() {
    $("#dialog-confirm2").dialog({
        autoOpen: false,
        resizable: false,
        height: 400,
        modal: true,
        buttons: {
            "Aceptar": function() {
                //$(this).attr("acepto", true);
                $("[name=f1]").submit();
                $(this).dialog("close");

            },
            Cancelar: function() {
                //$(this).attr("acepto",false);
                $(this).dialog("close");
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
$(document).ready(function() {
    $("#btnGuardar").on("click", function(ev) {
        //alert("HOLA");
        //ev.preventDefault();
        console.log($("#dialog-confirm2").dialog("open").attr("acepto"));
    });
    $("form").validate({
        rules: {
            nombre: {
                required: true
            },
            apellido: {
                required: true
            },
            contrasena: {
                required: true
            },
            telefono: {
                number: true,
                required: true
            }
        },
        messages: {
            telefono: "Ingrese teléfono",
            nombre: "Ingrese nombre",
            apellido: "Ingrese apellido",
            contrasena: "Ingrese contraseña",
        }
    });
});

