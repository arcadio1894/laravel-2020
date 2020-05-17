$(document).ready(function () {
    $('[data-assign]').on('click', showModalAssign);

    $('[data-visualizar]').on('click', showModalVisualizar);
    $('[data-destroy]').on('click', showModalDestroy);
    $('[data-edit]').on('click', showModalEdit);
    $('#btnCreate').on('click', showModalCreate);
    $formCreate = $('#formCreate');
    $formCreate.on('submit', storeCourse);
    $formEliminar = $('#formDelete');
    $formEliminar.on('submit', destroyCourse);
    $formEdit = $('#formEdit');
    $formEdit.on('submit', updateCourse);
    $bodyEdit = $('#bodyEdit');
    $bodyShow = $('#bodyShow');
    $bodyDelete = $('#bodyDelete');
    $modalShow = $('#modalShow');
    $modalDelete = $('#modalDelete');
    $modalCreate = $('#modalCreate');
    $modalEdit = $('#modalEdit');

    $formAssign = $('#formAssign');
    $modalAssign = $('#modalAssign');
    $formAssign.on('submit', assignCourse);

    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };

    $.get('teachers/getAll', function(data){
        $('#teacher').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            },
            {
                name: 'profesores',
                source: substringMatcher(data)
            });
    });

});

var $bodyShow;
var $bodyDelete;
var $bodyEdit;
var $modalShow;
var $modalDelete;
var $formEliminar;
var $modalCreate;
var $formCreate;
var $modalEdit;
var $formEdit;

var $modalAssign;
var $formAssign;

function assignCourse() {
    event.preventDefault();
    var assignUrl = $formAssign.data('url');

    $.ajax({
        url: assignUrl,
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
                $modalAssign.modal('hide');
                $.toast({
                    text : 'Profesores asignados correctamente.',
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
                    //location.reload();
                }, 4000)
            }
        },
        error: function (data) {
            console.log(data)
        }
    });
}

function showModalAssign() {
    let name = $(this).data('name');
    let id = $(this).data('assign');
    $('#courseAssign').val(id);
    $('#assignTitle').html('Asignar profesores al curso '+name);
    $.get('teachers/getTeachers/'+id, function(data){
        console.log(data.teachers);
        console.log(data.teachersSelected);
        $("#teachers").html('');
        $(data.teachers).each(function(i, v){ // indice, valor
            console.log(v.name);
            console.log(v.id);
            if(jQuery.inArray(v.id, data.teachersSelected) !== -1)
            {
                $("#teachers").append('<option selected value= '+v.id+'>' + v.name + '</option>');
            }else{
                $("#teachers").append('<option value= '+v.id+'>' + v.name + '</option>');
            }
        });
        $("#teachers").select2();
    });
    $modalAssign.modal('show');
}

function showModalEdit() {
    var id = $(this).data('edit');
    $.get('courses/edit/'+id, function(data){
        console.log(data.name);
        $bodyEdit.find('[name="id"]').val(data.id);
        $bodyEdit.find('[name="name"]').val(data.name);
        $bodyEdit.find('[name="description"]').html(data.description);
        $bodyEdit.find('[name="price"]').val(data.price);
        $bodyEdit.find('[name="stars"]').val(data.stars);
        $bodyEdit.find('[name="hours"]').html(data.hours);
        var src = window.location.origin+'/images/courses/'+data.image;
        if(data.image==null)
        {
            $('#image_preview').attr('src',window.location.origin+'/images/courses/no_image.jpg');
        }
        else
        {
            $('#image_preview').attr('src',src);
        }
        ( data.active ) ? $("#radio_active").attr('checked', 'checked') : $("#radio_inactive").attr('checked', 'checked');
    });
    $modalEdit.modal('show');
}

function updateCourse() {
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
                    text : 'Curso registrado correctamente.',
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

function storeCourse() {
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
                    text : 'Curso registrado correctamente.',
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

function showModalVisualizar() {
    var name = $(this).data('name');
    var description = $(this).data('description');
    $bodyShow.find('[id="showName"]').html(name);
    $bodyShow.find('[id="showDescription"]').html(description);
    $modalShow.modal('show');
}
