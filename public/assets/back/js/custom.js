$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.country_edit').click(function(e){
        e.preventDefault();

        var country_id = $(this).data('id');
        $('#__countryedit').attr('action','/update/country/'+country_id);
        $('#editCountry').modal('show');
        $.get('/edit/country/'+country_id,function(data){
            $("#country_name").val(data[0].country_name);
            $("#country_code").val(data[0].country_code);
            $("#region").val(data[0].region);
            $("#surcharge").val(data[0].airSurcharge)
        });
    });
    $('.security_edit').click(function(e){
        e.preventDefault();
        $('#editSecurity').modal('show');
        var security_id = $(this).data('id');
        $('#security_edit').attr('action','/update/security/'+security_id);
        $('#security_edit').modal('show');
        $.get('/edit/security/'+security_id,function(data){
            $("#registeredParcel_price").val(data[0].registeredParcel_price);
            $("#insuranceBase_price").val(data[0].insuranceBase_price);
            $("#insurancePrice_slot").val(data[0].insurancePrice_slot);
            $("#maximumInsurance_coverage").val(data[0].maximumInsurance_coverage);
            $("#insurancePrice_hike_per_slot").val(data[0].insurancePrice_hike_per_slot);
            $("#ekshop_parcel_charge").val(data[0].ekshop_parcel_charge);
            $("#ekshop_letter_charge").val(data[0].ekshop_letter_charge);
        });
    });

    // Api user Edit ajax 
    $('.api_user_edit').click(function(e){
        e.preventDefault();
        $('#editapiUser').modal('show');
        var user_id = $(this).data('id');
        $('#__useredit').attr('action','/update/api/user/'+user_id);
        $.get('/edit/api/user/'+user_id,function(data){
            $('#user_name').val(data.api_username);
            $('#access_token').val(data.access_token);
            $('#is_active').val(data.is_active);
        });
    });
  
    // Api user IP ajax 
    $('.check_ip').click(function(e){
        $('#ip_lists').html('');
        e.preventDefault();
        $('#editapiUserIP').modal('show');
        let ip_user_id = $(this).data('id');
        // $('#ip_dit').attr('action','/update/api/user/id/'+user_id);
        $.get('/edit/api/user/ip/'+ip_user_id,function(data){
            console.log(data);
            data.forEach((item,key) => {
                $('#ip_lists').append(
                    `<tr>
                    <td>${key+1}</td>
                    <td>${item.ip_address}</td>
                    <td>
                    ${
                        (()=>{
                            if(item.is_active === 1){
                               return `<span class=" badge badge-success">
                                    active
                                </span>`
                            }else{
                                return `<span class=" badge badge-danger">
                                Inactive
                                </span>` 
                            }
                        })()
                    }
                    </td>
                    <td>
                        <a href="/edit/ip/active/${item.id}" class=" btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                        <a href="/edit/ip/disable/${item.id}" class=" btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                    </td>
                    <td class=" d-flex align-items-center" style="column-gap: 5px">
                        <a href="#" class="company_delete btn btn-sm btn-danger disabled"> <i class="fa fa-trash"></i></a>
                    </td>
                </tr>    `
                )
            });
        });
    });

    $('.company_edit').click(function(e){
        e.preventDefault();
        var url = $('meta[name="base_url"]').attr('content');
        $('#editCompany').modal('show');
        var company_id = $(this).data('id');
        $('#update_company').attr('action','/update/company/'+company_id);
        $.get('/edit/company/'+company_id,function(data){ 
            $('#bg_color').val(data[0].bg_color);
            $('#goods_weight').val(data[0].goods_weight_slot);
            $('#doc_weight').val(data[0].documents_weight_slot);
            $('#letter_weight').val(data[0].letters_weight_slot);
            $('#parcel_weight').val(data[0].parcel_weight_slot);
            $('#company_name').val(data[0].name);
            $('#company_logo').val(data[0].company_logo);  
            $('#bg_image').val(data[0].bg_image);         
        });
    });
    $('.countrySetting_edit').click(function(e){
        e.preventDefault();
        var url = $('meta[name="base_url"]').attr('content');
        $('#editCountrySettings').modal('show');
        var countrySetting_id = $(this).data('id');
        $('#__countrySettings').attr('action','/update/countrySettings/'+countrySetting_id);
        $.get('/edit/company/service/'+countrySetting_id,function(data){ 
            $('#countrySettingCountry').val(data.country_id).change();       
            $('#check_company_id').val(data.company_id).change();        
            $('#parcel_base_price').val(data.parcel_base_price);        
            $('#parcel_hike_price').val(data.parcel_hike_price);        
            $('#letters_base_price').val(data.letters_base_price);        
            $('#letters_hike_price').val(data.letters_hike_price);        
            $('#documents_base_price').val(data.documents_base_price);        
            $('#documents_hike_price').val(data.documents_hike_price);        
            $('#goods_base_price').val(data.goods_base_price);        
            $('#goods_hike_price').val(data.goods_hike_price);        
            $('#delivery_days').val(data.delivery_days);        
            $('#parcel_post_capacity').val(data.parcelPost_capacity);        
            $('#letter_post_capacity').val(data.letterPost_capacity);        
            $('#parcel_weight_slot').val(data.parcel_weight_slot);        
            $('#letters_weight_slot').val(data.letters_weight_slot);        
            $('#documents_weight_slot').val(data.documents_weight_slot);        
            $('#goods_weight_slot').val(data.goods_weight_slot);        
            $('#specials').val(data.is_special_price);        
        });
    });
// $('#country_id').on('change',function(){
//     var country_id = $(this).val();
//     $('#check_company').on('change',function(){
//         var company_check_id= $(this).val();
//         $.get('/check/company/'+company_check_id+'/'+country_id,function(response){ 
//             console.log(response);
//             if(response==1){
//                 alert('This company already belongs to this country. Please select another.');
//                 return false;
//             }
//         })
//     })

// })
})