$(document).ready(function () {

    $('[data-visualizar]').on('click', showModalVisualizar);
    $('#btnCreate').on('click', showModalCreate);
    $('[data-edit]').on('click', showModalEdit);
    $('[data-destroy]').on('click', showModalDestroy);
    $formCreate = $('#formCreate');
    $formCreate.on('submit', storeTeacher);
    $formEliminar = $('#formDelete');
    $formEliminar.on('submit', destroyTeacher);
    $modalDelete = $('#modalDelete');
    $modalCreate = $('#modalCreate');
    $formEdit = $('#formEdit');
    $modalEdit = $('#modalEdit');
    $bodyEdit = $('#bodyEdit');
    $bodyDelete = $('#bodyDelete');
    $formEdit.on('submit', updateTeacher);
    $bodyShow = $('#bodyShow');
    $modalShow = $('#modalShow');

});

var $bodyShow;
var $modalCreate;
var $formCreate;
var $bodyEdit;
var $modalShow;
var $modalEdit;
var $formEdit;
var $bodyDelete;
var $modalDelete;
var $formEliminar;

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

function showModalEdit() {
    var id = $(this).data('edit');
    $.get('teachers/edit/'+id, function(data){
        console.log(data.name);
        $bodyEdit.find('[name="id"]').val(data.id);
        $bodyEdit.find('[name="name"]').val(data.name);
        $bodyEdit.find('[name="speciality"]').val(data.speciality);
        $bodyEdit.find('[name="years"]').val(data.years);
        $bodyEdit.find('[name="country"]').val(data.country);
        $bodyEdit.find('[name="phone"]').val(data.phone);
        var src = window.location.origin+'/images/teachers/'+data.image;
        if(data.image==null)
        {
            $('#image_preview').attr('src',window.location.origin+'/images/teachers/no_image.jpg');
        }
        else
        {
            $('#image_preview').attr('src',src);
        }
    });
    $modalEdit.modal('show');
}

function updateTeacher() {
    event.preventDefault();
    var createUrl = $formEdit.data('url');
    $.ajax({
        url: createUrl,
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);
            $modalEdit.modal('hide');
            $.toast({
                text : 'Profesor Actualizado correctamente.',
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

function destroyTeacher() {
    event.preventDefault();
    var id = $('#teacherDelete').val();
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
                    text : 'Profesor eliminado correctamente.',
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

function showModalDestroy() {
    var id = $(this).data('destroy');
    var name = $(this).data('name');
    $bodyDelete.find('[id="teacherDelete"]').val(id);
    $bodyDelete.find('[id="showName"]').html(name);
    $modalDelete.modal('show');
}


function showModalVisualizar() {
    var id = $(this).data('visualizar');
    $.get('teachers/edit/'+id, function(data){
        console.log(data.name);
        $bodyShow.find('[name="id"]').val(data.id);
        $bodyShow.find('[name="name"]').val(data.name);
        $bodyShow.find('[name="speciality"]').val(data.speciality);
        $bodyShow.find('[name="years"]').val(data.years);
        $bodyShow.find('[name="country"]').val(data.country);
        $bodyShow.find('[name="phone"]').val(data.phone);
        var src = window.location.origin+'/images/teachers/'+data.image;
        if(data.image==null)
        {
            $('#image_preview2').attr('src',window.location.origin+'/images/teachers/no_image.jpg');
        }
        else
        {
            $('#image_preview2').attr('src',src);
        }
    });
    $modalShow.modal('show');
}
