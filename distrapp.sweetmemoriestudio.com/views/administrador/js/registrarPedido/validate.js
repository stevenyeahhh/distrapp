$(document).ready(function() {
    $("form").validate({
        rules: {
            idEmpresa: {
                required: true,
                number:true
            },
            'tipoMedicamentos[]': {
                required: true,
                number:true
            },
            'cantidad[]': {
                required: true,
                number:true
            },
            idRepartidor: {
                required: true,
                number:true
            },
        }
    })
}
)