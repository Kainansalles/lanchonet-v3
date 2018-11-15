// Método para mostrar erros
function messageError(value){
    var e = {
        message: value
    };
    var t = $.notify(e, {
        type: 'danger',
        allow_dismiss: true,
        spacing: 10,
        timer: 2000,
        placement: {
            from: 'top',
            align: 'right'
        },
        offset: {
            x: 30,
            y: 30
        },
        delay: 1000,
        z_index: 10000,
        animate: {
            enter: "animated " + "bounceIn",
            exit: "animated " + "flipOutX"
        }
    });
}