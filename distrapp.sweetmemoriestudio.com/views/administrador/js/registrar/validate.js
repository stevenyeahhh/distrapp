$(document).ready(function() {
    $("form").validate({
        rules: {
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
