$(function () {
    $('#select-institution').on('change',onSelectInstitutionChange);
});

function onSelectInstitutionChange() {
    const institution_id = $(this).val();
    if (!institution_id) {
        $('#select-course').html('<option value="">Seleccione Curso</option>');
        return;
    }
    //AJAX
    $.get('/api/institution/'+institution_id+'/courses', function (data) {
        let html_select = '<option value="">Seleccione Curso</option>';
        for (var i=0;i<data.length; ++i)
           html_select+='<option value="'+data[i].id+'">'+data[i].CUR_NOMBRE+'</option>';
       // console.log(html_select);
       $('#select-course').html(html_select);
    });
}

$(function () {
    $('#select-institution').on('change',onSelectInstitutionChange2);
});

function onSelectInstitutionChange2() {
    const institution_id=$(this).val();
    if (!institution_id) {
        $('#select-student').html('<option value="">Seleccione Estudiante</option>');
        return;
    }
    //AJAX
    $.get('/api/institution/'+institution_id+'/students', function (data) {
        let html_select = '<option value="">Seleccione Estudiante</option>';
        for (var i=0;i<data.length; ++i)
            html_select+='<option value="'+data[i].id+'">'+data[i].EST_NOMBRES+" "+data[i].EST_APELLIDOS+'</option>';
            $('#select-student').html(html_select);
    });
}

$(function () {
    $('#select-student').on('change',onSelectStudent);
});
function onSelectStudent() {
    const student_id=$(this).val();
    $.get('/api/institution/'+student_id+'/student', function (data) {
        // alert(data[0].EST_NOMBRES)
        for (var i=0;i<data.length; ++i){
            $('#input-name').val(data[i].EST_NOMBRES+" "+data[i].EST_APELLIDOS)
            $('#input-email').val(data[i].EST_CORREO)
            $('#input-cedula').val(data[i].EST_CEDULA)
            $('#input-password').val(data[i].EST_CEDULA)
            $('#input-password-confirm').val(data[i].EST_CEDULA)
        }
    });
}

$(function () {
    $('#select-organisation').on('change',onSelectInstitutionChange3);
});

function onSelectInstitutionChange3() {
    const institution_id=$(this).val();
    if (!institution_id) {
        $('#select-user').html('<option value="">Seleccione Usuario</option>');
        return;
    }
    //AJAX
    $.get('/api/institution/'+institution_id+'/persons', function (data) {
        let html_select = '<option value="">Seleccione Usuario</option>';
        for (var i=0;i<data.length; ++i)
            html_select+='<option value="'+data[i].id+'">'+data[i].PER_NOMBRES+" "+data[i].PER_APELLIDOS+'</option>';
            $('#select-user').html(html_select);
    });
}

$(function () {
    $('#select-user').on('change',onSelectUser);
});
function onSelectUser() {
    const student_id=$(this).val();
    $.get('/api/institution/'+student_id+'/person', function (data) {
        for (var i=0;i<data.length; ++i){
            $('#input-name').val(data[i].PER_NOMBRES+" "+data[i].PER_APELLIDOS)
            $('#input-email').val(data[i].PER_CORREO)
            $('#input-cedula').val(data[i].PER_CEDULA)
            $('#input-password').val(data[i].PER_CEDULA)
            $('#input-password-confirm').val(data[i].PER_CEDULA)
        }
    });
}


