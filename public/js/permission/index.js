$(document).ready(function () {
    $('[data-visualizar]').on('click', showModalVisualizar);
    $('[data-destroy]').on('click', showModalDestroy);
    $('[data-edit]').on('click', showModalEdit);
    $('#btnCreate').on('click', showModalCreate);
    $formEdit = $('#formEdit');
    $formEdit.on('submit', updatePermission);
    $formCreate = $('#formCreate');
    $formCreate.on('submit', storePermission);
    $formEliminar = $('#formDelete');
    $formEliminar.on('submit', destroyPermission);
    $bodyShow = $('#bodyShow');
    $bodyDelete = $('#bodyDelete');
    $bodyEdit = $('#bodyEdit');
    $modalShow = $('#modalShow');
    $modalEdit = $('#modalEdit');
    $modalDelete = $('#modalDelete');
    $modalCreate = $('#modalCreate');
});

var $bodyShow;
var $bodyEdit;
var $modalShow;
var $modalEdit;
var $formEdit;
var $modalCreate;
var $formCreate;
var $bodyDelete;
var $modalDelete;

function showModalCreate() {
    $modalCreate.modal('show');
}

function storePermission() {
    event.preventDefault();
    var createUrl = $formCreate.data('url');
    $.ajax({
        url: createUrl,
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
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
                $modalDelete.modal('hide');
                $.toast({
                    text : 'Permiso registrado correctamente.',
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

function updatePermission() {
    event.preventDefault();
    var updateUrl = $formEdit.data('url');

    $.ajax({
        url: updateUrl,
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
                $modalEdit.modal('hide');
                $.toast({
                    text : 'Permiso registrado correctamente.',
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

function showModalEdit() {
    var id = $(this).data('edit');
    $.get('permissions/edit/'+id, function(data){
        $bodyEdit.find('[name="id"]').val(data.id);
        $bodyEdit.find('[name="name"]').val(data.name);
        $bodyEdit.find('[name="description"]').html(data.description);
        $bodyEdit.find('[name="slug"]').val(data.slug);
    });
    $modalEdit.modal('show');
}

function showModalVisualizar() {
    var name = $(this).data('name');
    var slug = $(this).data('slug');
    var description = $(this).data('description');
    $bodyShow.find('[id="showName"]').html(name);
    $bodyShow.find('[id="showSlug"]').html(slug);
    $bodyShow.find('[id="showDescription"]').html(description);
    $modalShow.modal('show');
}

function showModalDestroy() {
    var id = $(this).data('destroy');
    var name = $(this).data('name');
    $bodyDelete.find('[id="permissionDelete"]').val(id);
    $bodyDelete.find('[id="showName"]').html(name);
    $modalDelete.modal('show');
}

function destroyPermission() {
    event.preventDefault();
    var id = $('#permissionDelete').val();
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
                    text : 'Permiso eliminado correctamente.',
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
