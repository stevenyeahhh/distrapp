$(document).ready(function() {
    $("form").validate({
        rules: {
            nombre: {
                required: true,
                
            },
            telefono: {
                required: true,
                number:true
            },
            direccion: {
                required: true
            },
            idPersonaEncargada: {
                required: true,
                number:true
            },
        }
    })
}
)