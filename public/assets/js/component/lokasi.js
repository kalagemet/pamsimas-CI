$('#provinsi').on('change', function(e){
    console.log(e);
    var state_id = e.target.value;

    $.get('localhost:8000/get_kab?state_id=' + state_id, function(data) {
        console.log(data);
        $('#kabupaten').empty();
        $.each(data.cities, function(index,subCatObj){
            $('#kabupaten').append('<option value="'+subCatObj.id+'">'+subCatObj.name+'</option>');
        });
    });
});