$(document).ready(function () {

    $('#btnCreate').on('click', showModalCreate);
    $formCreate = $('#formCreate');
    $formCreate.on('submit', storeTeacher);
    $modalCreate = $('#modalCreate');

});

var $modalCreate;
var $formCreate;

function showModalCreate() {
    $modalCreate.modal('show');
}

function storeTeacher() {
    event.preventDefault();
    var createUrl = $formCreate.data('url');
    $.ajax({
        url: createUrl,
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);
            $modalCreate.modal('hide');
            $.toast({
                text : 'Profesor registrado correctamente.',
                showHideTransition : 'slide',
                bgColor : '#629B58',
                textColor : '#eee',
                allowToastClose : false,
                hideAfter : 4000,
                stack : 10,
                textAlign : 'left',
                position : 'top-right',
                icon: 'success',
                heading: 'Éxito'
            });
            setTimeout(function () {
                //location.reload();
            }, 4000)
        },
        error: function (data) {
            for (var property in data.responseJSON.errors){
                $.toast({
                    text : data.responseJSON.errors[property],
                    showHideTransition : 'slide',
                    bgColor : '#D15B47',
                    textColor : '#eee',
                    allowToastClose : false,
                    hideAfter : 4000,
                    stack : 10,
                    textAlign : 'left',
                    position : 'top-right',
                    icon: 'error',
                    heading: 'Error'
                });
            }
        }
    });
}

