$(document).ready(function() {
    $("form").validate({
        rules: {
            direccion: {
                required: true,
                
            },
            telefono: {
                required: true,
                number:true
            },
            idPersonaEncargada: {
                required: true,
                number:true
            },
        }
    })
}
)