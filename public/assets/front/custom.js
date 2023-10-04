$(document).ready(function () {
    $('.conditional_display').hide();
    
    $('input[name="parcelType"]').change(function () {
        if ($(this).val()==2) {
            $("#insured").removeAttr('disabled')
        }else{
            $("#insured").attr('disabled','true')
            $('#insured').val('');
        }
    });
})
