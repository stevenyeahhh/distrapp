$(document).ready(function() {
    $("form").validate({
        rules: {
            idTipoMedicamento: {required: true, number: true},
            fechaFabricacion: {required: true, date: true, regexp: "20[0-9]{2}-[0-9]{2}-[0-9]{2}"},
            fechaVencimiento: {required: true, date: true, regexp: "20[0-9]{2}-[0-9]{2}-[0-9]{2}"},
            cantidad: {required: true, number: true},
            bodega: {required: true, number: true},
        },messages:{
            idTipoMedicamento:"Ingrese tipo medicamento",bodega:"Ingrese Bodega"
        }
    });
    $("[name=fechaFabricacion]").datepicker({dateFormat:"yy-mm-dd"});
    $("[name=fechaVencimiento]").datepicker({dateFormat:"yy-mm-dd"});
});