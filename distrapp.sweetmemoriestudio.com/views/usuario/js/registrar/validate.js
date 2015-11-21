$(document).ready(function() {
    $("form").validate({
        rules: {
            idRol:{required:true,number:true},
            nombre: {
                required: true
            },
            apellido: {
                required: true
            },
            id: {
                required: true,
                number:true
            },
            contrasena: {
                required: true
            },
            telefono: {
                required: true,
                number:true
            }
        }
    })
}
)
