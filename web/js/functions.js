var URL = 'http://localhost/learnSym/web/app_dev.php/';


$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select a state",
        allowClear: true,
        closeOnSelect:true
    });

    $("#example1").DataTable();

    // show hide the field to add table name if a field is table type
    $('#tableNameField').hide();
    $('.fieldType').change(function () {
        $('#tableNameField').hide();
        if (this.value == 'TABLE'){
            $('#tableNameField').show();
        }
    });

    // control word type if is synonym or not

    if($('.form-check .isSynonym').prop('checked')){
        hideShowWordForm(true);
    }else{
        hideShowWordForm(false);
    }

    $('.isSynonym').change(function () {

        if (this.checked){
            hideShowWordForm(true);
        }else{
            hideShowWordForm(false);
        }
    });

    function hideShowWordForm(isSynonym) {
        if (isSynonym){
            $('#synonymSelect').show();
            $('#definitionInput').hide();
        }else{
            $('#synonymSelect').hide();
            $('#definitionInput').show();
        }
    }

    // to delete word

    $('.deleteBtn').click(function (e) {
        e.preventDefault();

        var itemId = $(this).attr('id');
        if(confirm('would you delete this item ?')){
            $.ajax({
                url: URL + 'api/words/delete/' + itemId,
                method: 'Delete',
                success: function (data) {
                    if (data.isSynonym) {
                        $('#word-'+itemId).remove();
                    }else{
                        $(window).attr('location',URL + 'words');
                    }
                },
                error: function () {
                }
            });
        }

    });

    $('.fieldToDelete').click(function (e) {
       e.preventDefault();
       var fieldId = $(this).attr('id');
       if(confirm('Are you sure to delete this field')){
           $.ajax({
               url: URL + 'api/fields/delete/' + fieldId,
               method: 'Delete',
               success: function (data) {
                   $('#field-'+fieldId).remove();
               },
               error: function (error) {

               }
           });
       }
    });

    $('.btnToDeleteCategory').click(function (e) {
        e.preventDefault();
        var catId = $(this).attr('id');
        if (confirm('Are you sure to delete this category and there fields')){
            $.ajax({
                url : URL + 'api/category/delete/'+ catId,
                method: 'Delete',
                success: function (data) {
                    $('#category-'+catId).remove();
                },
                error: function (error) {

                }
            });
        }
    })

});





