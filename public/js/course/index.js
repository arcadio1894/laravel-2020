$(document).ready(function () {
    $('[data-visualizar]').on('click', showModalVisualizar);
    $('[data-destroy]').on('click', showModalDestroy);
    $('#btnCreate').on('click', showModalCreate);
    $formEliminar = $('#formDelete');
    $formEliminar.on('submit', destroyCourse);
    $bodyShow = $('#bodyShow');
    $bodyDelete = $('#bodyDelete');
    $modalShow = $('#modalShow');
    $modalDelete = $('#modalDelete');
    $modalCreate = $('#modalCreate');
});

var $bodyShow;
var $bodyDelete;
var $modalShow;
var $modalDelete;
var $formEliminar;
var $modalCreate;

function showModalCreate() {
    $modalCreate.modal('show');
}

function showModalVisualizar() {
    var name = $(this).data('name');
    var description = $(this).data('description');
    $bodyShow.find('[id="showName"]').html(name);
    $bodyShow.find('[id="showDescription"]').html(description);
    $modalShow.modal('show');
}

function showModalDestroy() {
    var id = $(this).data('destroy');
    var name = $(this).data('name');
    $bodyDelete.find('[id="courseDelete"]').val(id);
    $bodyDelete.find('[id="showName"]').html(name);
    $modalDelete.modal('show');
}

function destroyCourse() {
    event.preventDefault();
    var id = $('#courseDelete').val();
    var deleteUrl = $formEliminar.data('url')+'/'+id;
    $.ajax({
        url: deleteUrl,
        method: 'DELETE',
        data: $formEliminar.serializeArray(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data != "") {
                console.log(data);
                for (var property in data){
                    $.toast({
                        text : data[property],
                        showHideTransition : 'slide',  // It can be plain, fade or slide
                        bgColor : '#D15B47',              // Background color for toast
                        textColor : '#eee',            // text color
                        allowToastClose : false,       // Show the close button or not
                        hideAfter : 3000,              // `false` to make it sticky or time in miliseconds to hide after
                        stack : 3,                     // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
                        textAlign : 'left',            // Alignment of text i.e. left, right, center
                        position : 'top-right',       // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
                        icon: 'error',
                        heading: 'Error'
                    });
                }
            } else {
                $modalDelete.modal('hide');
                $.toast({
                    text : 'Curso eliminado correctamente.',
                    showHideTransition : 'slide',  // It can be plain, fade or slide
                    bgColor : '#629B58',              // Background color for toast
                    textColor : '#eee',            // text color
                    allowToastClose : false,       // Show the close button or not
                    hideAfter : 3000,              // `false` to make it sticky or time in miliseconds to hide after
                    stack : 3,                     // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
                    textAlign : 'left',            // Alignment of text i.e. left, right, center
                    position : 'top-right',       // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
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