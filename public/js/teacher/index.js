$(document).ready(function () {
    $('[data-visualizar]').on('click', showModalVisualizar);
    $('[data-destroy]').on('click', showModalDestroy);
    $('[data-edit]').on('click', showModalEdit);
    $('#btnCreate').on('click', showModalCreate);
    $formEliminar = $('#formDelete');
    $formEliminar.on('submit', destroyTeacher);
    $formCreate = $('#formCreate');
    $formCreate.on('submit', storeTeacher);
    $formEdit = $('#formEdit');
    $formEdit.on('submit', updataTeacher);
    $modalCreate = $('#modalCreate');
    $bodyDelete = $('#bodyDelete');
    $bodyEdit = $('#bodyEdit');
    $modalDelete = $('#modalDelete');
    $modalEdit = $('#modalEdit');
    $bodyShow = $('#bodyShow');
    $modalShow = $('#modalShow');
});

var $modalCreate;
var $formCreate;
var $modalDelete;
var $formEliminar;
var $bodyDelete;
var $bodyEdit;
var $modalEdit;
var $formEdit;
var $bodyShow;
var $modalShow;

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

function showModalDestroy() {
    var id = $(this).data('destroy');
    var name = $(this).data('name');
    $bodyDelete.find('[id="teacherDelete"]').val(id);
    $bodyDelete.find('[id="showName"]').html(name);
    $modalDelete.modal('show');
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

function showModalEdit() {
    var id = $(this).data('edit');
    $.get('teachers/edit/'+id, function(data){
        console.log(data.image);
        $bodyEdit.find('[name="id"]').val(data.id);
        $bodyEdit.find('[name="name"]').val(data.name);
        $bodyEdit.find('[name="speciality"]').val(data.speciality);
        $bodyEdit.find('[name="years"]').val(data.years);
        $bodyEdit.find('[name="country"]').html(data.country);
        $bodyEdit.find('[name="phone"]').html(data.phone);
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

function updataTeacher() {
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
                    text : 'Profesor actualizado correctamente.',
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

function showModalVisualizar() {
  var id = $(this).data('visualizar');
  $.get('teachers/show/'+id, function(data){
      $bodyShow.find('[id="showName"]').html(data.name);
      $bodyShow.find('[id="showSpeciality"]').html(data.speciality);
      $bodyShow.find('[id="showYears"]').html(data.years);
      $bodyShow.find('[id="showCountry"]').html(data.country);
      $bodyShow.find('[id="showPhone"]').html(data.phone);
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
  $modalShow.modal('show');
}
