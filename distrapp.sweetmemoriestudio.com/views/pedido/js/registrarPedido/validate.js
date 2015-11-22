$(document).on("click", ".btn-control-agregar", function (ev) {
    var tipoMedicamento=$("#tipoMedicamentos");
    var cantidad=$("#cantidad").val();
    var costo=$("option:selected",tipoMedicamento).attr("costo")*cantidad;
    
//    $("option:selected",tipoMedicamento).css("display","none")
    
    $(".contenedor-forms").append("<tr><td><input type='hidden' name='tipoMedicamentos[]' value='"+tipoMedicamento.val()+"' >"+$("option:selected",tipoMedicamento).text()+"</td>"+
            "<td><input type='hidden' name='cantidad[]' value='"+cantidad+"' >"+cantidad+"</td>"+
            "<td>"+costo+"</td>"+
            "</tr>")
    
    var divCosto=$(".select-option-costo");
    divCosto.text((divCosto.text()/1)+costo);
    $("option:selected",tipoMedicamento).remove();
});
//PENDIENTE: devolver el elemento (dar un botón de regresar el tipo de medicamento a la lista) y darle las proiedades necesarias para ponerlo de nuevo en la tabla