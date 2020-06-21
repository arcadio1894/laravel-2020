$(document).ready(function () {

    $('#btnCreate').on('click', showModalCreate);
    $formCreate = $('#formCreate');
    $formCreate.on('submit', storeTeacher);
    $modalCreate = $('#modalCreate');

    $('[data-email]').on('click', showModalEmail);
    $modalEmail = $('#modalEmail');
    $bodyEmail = $('#bodyEmail');
    $formEmail = $('#formEmail');
    $formEmail.on('submit', sendEmail);

});

var $modalEmail;
var $formEmail;
var $bodyEmail;

var $modalCreate;
var $formCreate;

function showModalEmail() {
    var teacher_id = $(this).data('email');
    $bodyEmail.find('[name="teacher_id"]').val(teacher_id);
    $modalEmail.modal('show');
}

function sendEmail() {
    event.preventDefault();
    var emailUrl = $formEmail.data('url');

    $.ajax({
        url: emailUrl,
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data != "") {
                console.log(data);
                for (var property in data){
                    $.toast({
                        text : data[property],
                        showHideTransition : 'slide',
                        bgColor : '#D15B47',
                        textColor : '#eee',
                        allowToastClose : false,
                        hideAfter : 5000,
                        stack : 10,
                        textAlign : 'left',
                        position : 'top-right',
                        icon: 'error',
                        heading: 'Error'
                    });
                }
            } else {
                $modalEmail.modal('hide');
                $.toast({
                    text : 'Email enviado correctamente.',
                    showHideTransition : 'slide',
                    bgColor : '#629B58',
                    textColor : '#eee',
                    allowToastClose : false,
                    hideAfter : 5000,
                    stack : 10,
                    textAlign : 'left',
                    position : 'top-right',
                    icon: 'success',
                    heading: 'Éxito'
                });
                setTimeout(function () {
                    location.reload();
                }, 4000)
            }
        },
        error: function (data) {
            console.log(data)
        }
    });
}

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
                location.reload();
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

