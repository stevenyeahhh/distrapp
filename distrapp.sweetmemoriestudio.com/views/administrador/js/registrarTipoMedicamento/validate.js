$(document).ready(function() {
    $("form").validate({
        rules: {
            codigoBarras: {
                required: true,
                number:true
            },
            descripcion: {
                required: true
            }
        }
    })
}
)