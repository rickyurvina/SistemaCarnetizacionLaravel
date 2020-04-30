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
