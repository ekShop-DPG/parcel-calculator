<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    //--------------- Define Variable

    var parcel_base_price=[],letters_base_price=[],documents_base_price=[],goods_base_price=[],parcel_hike_price=[],letters_hike_price=[],documents_hike_price=[],goods_hike_price=[],parcelPost_capacity=[],letterPost_capacity=[],parcel_weight_slot=[],letters_weight_slot=[],documents_weight_slot=[],goods_weight_slot=[],company_name= [],max_insured=0,insurancePrice_hike_per_slot=0,registeredParcel_price=0,insuranceBase_price = 0;
    var country_id, insurance_price_slot=0,reg_letter_post = 0,insured_letter_post=0,airSurcharge = 0;

    //=---------------------- select Country

    $('#sel_country').change(function () {
        clearvalue();
        $('.conditional_display').show();
        country_id = $(this).val();
        $("#parcel__wrap").html('');
        $("#specific_info").html('');
        $.get("country-company-data/" + country_id + "", function (data) {
            // console.log(data);
            max_insured = max_insured+data['security'][0].maximumInsurance_coverage;
            insurance_price_slot = data['security'][0].insurancePrice_slot;
            insurancePrice_hike_per_slot = insurancePrice_hike_per_slot+data['security'][0].insurancePrice_hike_per_slot;
            registeredParcel_price = registeredParcel_price+data['security'][0].registeredParcel_price;
            insuranceBase_price = insuranceBase_price+data['security'][0].insuranceBase_price;
            airSurcharge = data['companies'][0].airSurcharge;
            data['companies'].forEach((item,key) => {

                if(item.company_shortcode==="EM"){
                    parcel_base_price.push(item.parcel_base_price+item.parcel_base_price*15/100); 
                }else{
                    parcel_base_price.push(item.parcel_base_price);
                }
                item.company_shortcode.toLowerCase();
                letters_base_price.push(item.letters_base_price);
                documents_base_price.push(item.documents_base_price);
                goods_base_price.push(item.goods_base_price);
                parcel_hike_price.push(item.parcel_hike_price);
                letters_hike_price.push(item.letters_hike_price);
                documents_hike_price.push(item.documents_hike_price);
                goods_hike_price.push(item.goods_hike_price);
                parcel_weight_slot.push(item.parcel_weight_slot);
                letters_weight_slot.push(item.letters_weight_slot);
                documents_weight_slot.push(item.documents_weight_slot);
                goods_weight_slot.push(item.goods_weight_slot);
                parcelPost_capacity.push(item.parcelPost_capacity);
                letterPost_capacity.push(item.letterPost_capacity);
                company_name.push(item.company_shortcode.toLowerCase());
                // console.log(parcelPost_capacity);
                $("#ppmodelcountry").html(item.country_name);

                if(item.company_shortcode.toLowerCase()==='em'){
                    // set Modal Value
                    $("#emsvat").html(item.parcel_base_price*15/100);
                    $("#sfee").html( "100");
                }

                $("#parcel__wrap").append(
                    `<div class="shadow-sm rounded-3 mb-3 bg-opacity-10 bg-card px-3 pt-3" id="air" style="background-image: url(&quot;{{ asset('') }}bg_image/${item.bg_image}&quot;);background-color:rgba(${item.bg_color},0.1);">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <h3 style="font-weight: 300;"><img src="{{ asset('') }}/company_logo/${item.company_logo}" height="18px" alt=""> | ${item.name} <span style="font-size: 15px; font-weight: normal;"><i class="bi bi-clock-history" style="color:rgba(${item.bg_color},1)"></i> Delivery <strong>${item.delivery_days}</strong> Days</span></h3>
                                <span style="padding-top: 10px;"><strong><span class="parcel__price" style="font-size: 60px; line-height: 80px;color:rgba(${item.bg_color},1)" id="parcel_base_price${key}">0</span></strong> Tk. <a href="#" style="color: #000000;" data-bs-toggle="modal" data-bs-target="#parcelModal_test"><i class="bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="Click to View Rate Chart" aria-label="Click to View Rate Chart"></i></a></span>
                                ${
                                        (()=>{
                                        if(item.company_shortcode.toLowerCase()==='em'){
                                            return `<span>
                                        <img id="airaccountable" src="{{asset('')}}/assets/front/image/Registered-Seal.png" class="img-fluid float-end mt-3" style="max-width: 50px;" alt="">
                                        <img id="airinsured" src="{{ asset('') }}assets/front/image/shield-seal.png" class="airaccountable_2 img-fluid float-end mt-3 px-1" style="max-height: 50px; display: none;" alt="">
                                    </span>`
                                        }
                                        else{
                                            return `<span class="register_img">
                                                <img id="airaccountable" src="{{asset('')}}/assets/front/image/Registered-Seal.png" class="airaccountable img-fluid float-end mt-3" style="max-width: 50px; display: none;" alt="">
                                                <img id="airinsured" src="{{ asset('') }}assets/front/image/shield-seal.png" class="airaccountable_2 img-fluid float-end mt-3 px-1" style="max-height: 50px; display: none;" alt="">
                                            </span>`

                                        }
                                    })()
                                }
                                <br>
                                <h7><i class="fab fa-dropbox" style="color:rgba(${item.bg_color},1)" aria-hidden="true"></i> Parcel Post | <i class="fas fa-balance-scale" style="color:rgba(${item.bg_color},1)" aria-hidden="true"></i> Upto ${item.parcelPost_capacity}Kg</h7>
                            </div>
                            <span class="d-block d-sm-block d-md-block d-lg-none" style="padding: 10px 0 10px 0;"><hr></span>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <h5 class="card-title"><i class="fas fa-mail-bulk" style="color:rgba(${item.bg_color},1)" aria-hidden="true"></i> Letter Post (up to ${item.letterPost_capacity}kg)</h5>
                                <ul class="list-group list-group-flush bg-transparent">
                                    ${
                                        (()=>{
                                        if(item.company_shortcode.toLowerCase()==='em'){
                                            return `<li class="list-group-item bg-transparent">
                                        <i class="fas fa-envelope-open-text" style="color:rgba(${item.bg_color},1)" aria-hidden="true"></i> Letters <strong><span id="alecost" style="color:rgba(${item.bg_color},1);font-size: 30px; line-height: 16px;">N/A</span></strong>
                                    </li>
                                    <li class="list-group-item bg-transparent">
                                        <i class="bi bi-printer-fill" style="color:rgba(${item.bg_color},1)"></i>
                                        Documents <strong><span id="alecost" style="color:rgba(${item.bg_color},1);font-size: 30px; line-height: 16px;">N/A</span></strong>
                                    </li>
                                    <li class="list-group-item bg-transparent">
                                        <i class="fas fa-box" aria-hidden="true" style="color:rgba(${item.bg_color},1)"></i>
                                        Goods <strong><span id="alecost" style="color:rgba(${item.bg_color},1);font-size: 30px; line-height: 16px;">N/A</span></strong>
                                    </li>`;
                                        }else{
                                            return `<li class="list-group-item bg-transparent">
                                        <i class="fas fa-envelope-open-text" style="color:rgba(${item.bg_color},1)" aria-hidden="true"></i> Letters <strong><span style="color:rgba(${item.bg_color},1);font-size: 30px; line-height: 16px;" id="letters_base_price${key}">0</span></strong> Tk. <a href="#" style="color: #000000;" data-bs-toggle="modal" data-bs-target="#modal_letter${key}"><i class="bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="Click to View Rate Chart" aria-label="Click to View Rate Chart"></i></a>
                                    </li>
                                    <li class="list-group-item bg-transparent">
                                        <i class="bi bi-printer-fill" style="color:rgba(${item.bg_color},1)" aria-hidden="true"></i> Documents <strong><span style="color:rgba(${item.bg_color},1);font-size: 30px; line-height: 16px;" id="documents_base_price${key}">0</span></strong> Tk. <a href="#" style="color: #000000;" data-bs-toggle="modal" data-bs-target="#modal_letter${key}"><i class="bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="Click to View Rate Chart" aria-label="Click to View Rate Chart"></i></a>
                                    </li>
                                    <li class="list-group-item bg-transparent">
                                        <i class="fas fa-box" style="color:rgba(${item.bg_color},1)" aria-hidden="true"></i> Goods <strong><span style="color:rgba(${item.bg_color},1);font-size: 30px; line-height: 16px;" id="goods_base_price${key}">0</span></strong> Tk. <a href="#" style="color: #000000;" data-bs-toggle="modal" data-bs-target="#modal_letter${key}"><i class="bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="Click to View Rate Chart" aria-label="Click to View Rate Chart"></i></a>
                                    </li>`;
                                        }
                                    })()
                                }
                                    
                                </ul>
                            </div>
                            <div class="col-12" style="display: none;"><h7>Registration <span class="badge rounded-pill bg-success bg-opacity-25 text-success"><span id="fee">0</span> Tk.</span> | Insurance <span class="badge rounded-pill bg-success bg-opacity-25 text-success"><span id="insfee">0</span> Tk.</span></h7></div>
                        </div>
                    </div>`
                )
                $('#modal_letter_post').append(
                    `<div class="modal fade" id="modal_letter${key}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 750px">
                            <div class="modal-content bg-light bg-card"
                                style="background-image: url({{ asset('') }}/assets/front/image/corner-4.png);">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel" style="font-weight: 400;"><i
                                            class="fas fa-mail-bulk text-danger" aria-hidden="true"></i> Letter Post Rate for <span
                                            id="modelcountry" style="font-weight: 800;">${item.country_name}</span> (up to 2kg)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table text-center table-hover">
                                        <thead>
                                            <tr id="letter_post_content__thead">
                                                <th scope="col"><i class="fas fa-envelope-open-text" aria-hidden="true"></i> Letters
                                                </th>
                                                <th scope="col"><i class="bi bi-printer-fill"></i> Documents</th>
                                                <th scope="col"><i class="fas fa-box" aria-hidden="true"></i> Goods</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="letter_post_price_slot">
                                                <td>First ${item.letters_weight_slot}g <strong><span id="lemin${key}">${item.letters_base_price}</span></strong>Tk.</td>
                                                <td>First ${item.documents_weight_slot}g <strong><span id="pmmin${key}">${item.documents_base_price}</span></strong>Tk.</td>
                                                <td>First ${item.goods_weight_slot}g <strong><span id="spmin${key}">${item.goods_base_price}</span></strong>Tk.</td>
                                            </tr>
                                            <tr id="letter_post_calculation">
                                                <td>Additional ${item.letters_weight_slot}g <strong><span id="leaddi${key}">${item.letters_hike_price}</span></strong>Tk. <i
                                                    class="bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="" data-bs-original-title="2nd 20g or fraction thereof up to 2 kg"
                                                    aria-label="2nd 20g or fraction thereof up to 2 kg"></i></td>
                                            <td>Additional ${item.documents_weight_slot}g <strong><span id="pmaddi${key}">${item.documents_hike_price}</span></strong>Tk. <i
                                                    class="bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="" data-bs-original-title="2nd 100g or fraction thereof up to 2 kg"
                                                    aria-label="2nd 100g or fraction thereof up to 2 kg"></i></td>
                                            <td>Additional ${item.goods_weight_slot}g <strong><span id="spaddi${key}">${item.goods_hike_price}</span></strong>Tk. <i
                                                    class="bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="" data-bs-original-title="2nd 100g or fraction thereof up to 2 kg"
                                                    aria-label="2nd 100g or fraction thereof up to 2 kg"></i></td> 
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Charge for <span id="lewdata"></span>g <strong id="lecrg${key}">0</strong> Tk.</td>
                                                <td>Charge for <span id="pmwdata"></span>g <strong id="pmcrg${key}">0</strong> Tk.</td>
                                                <td>Charge for <span id="spwdata"></span>g <strong id="spcrg${key}">0</strong> Tk.</td>
                                            </tr>
                                        </tfoot>

                                    </table>
                                    <div class="text-center">Registration <span
                                            class="badge rounded-pill bg-secondary bg-opacity-25 text-secondary"><span
                                                class="modelfee">${reg_letter_post}</span> Tk.</span> | Insurance <span
                                            class="badge rounded-pill bg-secondary bg-opacity-25 text-secondary"><span
                                                id="modelinsfee${key}">${insured_letter_post}</span> Tk.</span> | Air Surcharge <span
                                            class="badge rounded-pill bg-secondary bg-opacity-25 text-secondary"><span class="modelas">${airSurcharge}</span>
                                            Tk. </span> <i class="bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-html="true" title="" data-bs-original-title="Only Applicable for Air Articles"
                                            aria-label="Only Applicable for Air Articles"></i> <span id="modelaccountable"
                                            style="display: none;">| <span
                                                class="badge rounded-pill bg-secondary bg-opacity-25 text-secondary"><i
                                                    class="bi bi-patch-check-fill"></i> Accountable</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`
                )

                $("#specific_info").append(
                    `<div class="col-4" style="" id="emsmodel">
                        <h5 class="card-title"><i class="
                        ${
                            (() => {

                                if (item.company_shortcode.toLowerCase()==='em') {
                                    return `fas fa-tachometer-alt text-primary`
                                } else if(item.company_shortcode.toLowerCase()==='am') {
                                    return `fas fa-plane-departure text-success`
                                }else{
                                    return `fas fa-ship text-warning`
                                }
                            })()
                        }
                            "
                                aria-hidden="true"></i> ${item.name}</h5>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent">First ${item.parcel_weight_slot}g <strong>
                                ${
                            (() => {

                                if (item.company_shortcode.toLowerCase()==='em') {
                                    return `<span id="emsmin">${item.parcel_base_price}</span>`
                                }else{
                                    return `<span id="emsmin">${item.parcel_base_price}</span>`
                                }
                            })()
                        }
                                
                                </strong> Tk.</li>
                            <li class="list-group-item bg-transparent">Additional ${item.parcel_weight_slot}g <strong><span
                                        id="emsaddi">${item.parcel_hike_price}</span></strong> Tk. <i class="bi bi-question-circle"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    title="2nd 250 gm or fraction thereof up to 20 kg"
                                    aria-label="2nd 250 gm or fraction thereof up to 20 kg"></i></li>
                        ${
                            (() => {

                                if (item.company_shortcode.toLowerCase()==='em') {
                                    return `<li class="list-group-item bg-transparent">Value Added Tax <strong>15</strong>%</li>`
                                }else{
                                    return ``
                                }
                            })()
                        }
                            <li class="list-group-item bg-transparent">Charge <span
                                    class="badge rounded-pill ${
                            (() => {

                                if (item.company_shortcode.toLowerCase()==='em') {
                                    return `bg-primary text-primary`
                                } else if(item.company_shortcode.toLowerCase()==='am') {
                                    return `bg-success text-success`
                                }else{
                                    return `bg-warning text-warning`
                                }
                            })()
                        } bg-opacity-25"
                                    style="font-size: 18px;"><span id="emscrg${key}">0</span> Tk.</span></li>
                        </ul>
                    </div>`
                )
            }); 
            // Call the calculation function
            setTimeout(() => {
                countryChangeCalculation(); 
            }, 1000)
        });
    });
    
    //------- End Letter Post Modal Contents

    $('.airaccountable').attr('style','display:none;max-width:50px')
    $('.airaccountable_2').attr('style','display:none;max-width:50px')

    //----------- Check Weight input

    var insuredInput = 0;
    $('#weight').keyup( function () {

        // Security Images Update
        $('input[name="parcelType"]').change(function () {
            if($(this).val()==0){
                $('.airaccountable').attr('style','display:none;max-width:50px')
                $('.airaccountable_2').attr('style','display:none;max-width:50px')
            }
            if($(this).val()==1){
                $('.airaccountable').attr('style','display:block;max-width:50px')
                $('.airaccountable_2').attr('style','display:none;max-width:50px')
                $("#sfee").html( "100")
            }
            if ($(this).val()==2) {
                $('.airaccountable_2').attr('style','display:block;max-width:50px')
                $('.airaccountable').attr('style','display:block;max-width:50px') 
                
            }
        })

        var upto = 20000;
        var letter_upto = 2000;
        var _weight = $(this).val();
        var totalAirSurcharge = 0;
        
        // Letter Post Data Value for popup
        $("#lewdata").html(_weight);
        $("#pmwdata").html(_weight);
        $("#spwdata").html(_weight);
        
        // Check Maximum Weight
        if(_weight > upto) {
            alert("Parcel weight can't be over 20kg");
            $(this).val($(this).val().slice(0,-1));
            return false;
        }
        
        $("#weightkg").val(_weight / 1000);
        $("#emscost").html(_weight * 1000);

        var calcPrice  = 0;

        if($('#parcelType2').is(":checked")){
            var sequreMoney = 100;
            var insuredValue = 0;

            for (let i = 0; i < company_name.length; i++) {
                if(company_name[i] ==="em"){
                    sequreMoney = 0;
                    return false;
                }                         
            }

            $('.airaccountable').attr('style','display:block;max-width:50px')
        }else if($('#parcelType1').is(':checked')) {
            var sequreMoney = 0;
            var insuredValue = 0;
        }

        if($('#parcelType3').is(':checked')){
            var sequreMoney = 100;
            var insuredValue = $('#insured').val();
            var insuredSlot = Math.ceil(insuredValue / insurance_price_slot );

            if(insuredSlot <= 0){
                calcPrice = 0;
            }else{
                calcPrice  = insurancePrice_hike_per_slot*insuredSlot;
                insured_letter_post = insured_letter_post+calcPrice;
            }
            $("#sfee").html(sequreMoney);
            for (let i = 0; i < company_name.length; i++) {
                $("#sinsfee")[i].html(calcPrice);
                $("#modelinsfee").html(calcPrice);
                
            }
        }
        
        if (_weight <= 0 || _weight == '') {
            for (let i = 0; i < parcel_base_price.length; i++) {
                $('#parcel_base_price'+[i]).html(0);
                $('#emscrg'+[i]).html(0)
            }

            for (let i = 0; i < letters_base_price.length; i++) {
                $('#letters_base_price'+[i]).html(0);
                $("#lecrg"+[i]).html(0)
            }

            for (let i = 0; i < documents_base_price.length; i++) {
                $('#documents_base_price'+[i]).html(0);
                $('#pmcrg'+[i]).html(0);
            }

            for (let i = 0; i < goods_base_price.length; i++) {
                $('#goods_base_price'+[i]).html(0);
                $('#spcrg'+[i]).html(0)
            }
        }else{
            for (let i = 0; i < parcel_base_price.length; i++) {

                var slot = Math.ceil(_weight / parcel_weight_slot[i]);

                if(slot == 1){
                    if(company_name[i] ==="em"){
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i]+calcPrice);
                        $('#emscrg'+[i]).html(parcel_base_price[i]+calcPrice);
                    }else{
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i]+sequreMoney+calcPrice) 
                        $('#emscrg'+[i]).html(parcel_base_price[i]+sequreMoney+calcPrice)
                    }
                }else{
                    slot = slot-1;
                    if(company_name[i] ==="em"){
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i]+parcel_hike_price[i] * slot+calcPrice);
                        $('#emscrg'+[i]).html(parcel_base_price[i]+parcel_hike_price[i] * slot+calcPrice)
                    }else{
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i] + sequreMoney+parcel_hike_price[i] * slot+calcPrice); 
                        $('#emscrg'+[i]).html(parcel_base_price[i] + sequreMoney+parcel_hike_price[i] * slot+calcPrice)
                    }
                    
                } 
            }

            for (let i = 0; i < letters_base_price.length; i++) {
                var slot = Math.ceil(_weight/letters_weight_slot[i]);
                totalAirSurcharge = airSurcharge * slot;

                if(slot == 1){
                    if(company_name[i]==="am"){
                        $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + calcPrice + totalAirSurcharge);
                        $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + calcPrice + totalAirSurcharge);
                    }else{
                        $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + calcPrice);
                        $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + calcPrice);
                    }

                }else{
                    slot = slot-1;

                    if(company_name[i]==="am"){
                        $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot + calcPrice + totalAirSurcharge);
                        $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot + calcPrice + totalAirSurcharge);
                        
                    }else{
                        $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot + calcPrice);
                        $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot + calcPrice);
                    }
                }  
            }

            for (let i = 0; i < documents_base_price.length; i++) {
                var slot = Math.ceil(_weight/documents_weight_slot[i]);
                // var totalAirSurcharge = airSurcharge * slot;

                if(slot == 1){
                    if(company_name[i]==="am"){
                        $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + calcPrice + totalAirSurcharge);
                        $('#pmcrg'+[i]).html(documents_base_price[i] + sequreMoney + calcPrice + totalAirSurcharge);
                    }else{
                        $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + calcPrice);
                        $('#pmcrg'+[i]).html(documents_base_price[i] + sequreMoney + calcPrice);
                    } 
                }else{
                    slot = slot-1;

                    if(company_name[i]==="am"){
                        $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot + calcPrice + totalAirSurcharge);
                        $('#pmcrg'+[i]).html(documents_base_price[i] + sequreMoney+documents_hike_price[i] * slot+calcPrice + totalAirSurcharge);
                    }else{
                        $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot + calcPrice);
                        $('#pmcrg'+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot + calcPrice);
                    }
                }
            }

            for (let i = 0; i < goods_base_price.length; i++) {
                var slot = Math.ceil(_weight/goods_weight_slot[i]+calcPrice);
                // var totalAirSurcharge = airSurcharge * slot;

                if(slot == 1){
                    if(company_name[i]==="am"){
                        $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + calcPrice + totalAirSurcharge);
                        $('#spcrg'+[i]).html(goods_base_price[i] + sequreMoney + calcPrice + totalAirSurcharge);
                    }else{
                        $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + calcPrice);
                        $('#spcrg'+[i]).html(goods_base_price[i] + sequreMoney + calcPrice);
                    }
                    
                }else{
                    slot = slot-1;

                    if(company_name[i]==="am"){
                        $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot + calcPrice + totalAirSurcharge);
                        $('#spcrg'+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot + calcPrice + totalAirSurcharge);
                    }else{
                        $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot + calcPrice);
                        $('#spcrg'+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot + calcPrice);
                    }
                }
            }
        }    

        //Add ban button
        if(_weight > letter_upto) {
            for (let i = 0; i < company_name.length; i++) {
                $("#letters_base_price"+[i]).html(`<i class="fas fa-ban fs-5" aria-hidden="true"></i>`)
                $("#documents_base_price"+[i]).html(`<i class="fas fa-ban fs-5" aria-hidden="true"></i>`)
                $("#goods_base_price"+[i]).html(`<i class="fas fa-ban fs-5" aria-hidden="true"></i>`)
            }
        }
    });


    //-------------- Check Sequrity Button Check

    $('input[name="parcelType"]').change(function () {
        var upto = 20000;
        var totalAirSurcharge =0;
        var _weight = $('#weight').val();
        if ($(this).val() == 0) {
            $("#modelinsfee").html(0)
            var insreg=document.querySelectorAll(".modelfee");

            for (let i = 0; i < insreg.length; i++) {
                insreg[i].innerText = "0";                
            }

            $("#sinsfee").html(0);
            var sequreMoney = 0;

            if (_weight <= 0 || _weight == '') {
                for (let i = 0; i < parcel_base_price.length; i++) {
                    $('#parcel_base_price'+[i]).html(0);
                }

                for (let i = 0; i < letters_base_price.length; i++) {
                    $('#letters_base_price'+[i]).html(0);
                }

                for (let i = 0; i < documents_base_price.length; i++) {
                    $('#documents_base_price'+[i]).html(0);
                }

                for (let i = 0; i < goods_base_price.length; i++) {
                    $('#goods_base_price'+[i]).html(0);
                }
            }else{
                for (let i = 0; i < parcel_base_price.length; i++) {
                    var slot = Math.ceil(_weight/parcel_weight_slot[i]);

                    if(slot == 1){
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i] + sequreMoney);
                        $('#emscrg'+[i]).html(parcel_base_price[i] + sequreMoney);
                    }else{
                        slot = slot-1;
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i] + sequreMoney + parcel_hike_price[i] * slot);
                        $('#emscrg'+[i]).html(parcel_base_price[i] + sequreMoney + parcel_hike_price[i] * slot);
                    }
                }

                for (let i = 0; i < letters_base_price.length; i++) {
                    var slot = Math.ceil(_weight/letters_weight_slot[i]);
                    var totalAirSurcharge = airSurcharge * slot;

                    if(slot == 1){
                        if(company_name[i]==="am"){
                            $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + totalAirSurcharge);
                            $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + totalAirSurcharge);
                        }else{
                            $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney);
                            $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney);
                        }

                    }else{
                        slot = slot-1;
                        
                        if(company_name[i]==="am"){
                            $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot + totalAirSurcharge);
                            $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot + totalAirSurcharge);
                        }else{
                            $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot);
                            $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot);                            
                        }
                    }  
                }

                for (let i = 0; i < documents_base_price.length; i++) {
                    var slot = Math.ceil(_weight/documents_weight_slot[i]);
                    // var totalAirSurcharge = airSurcharge * slot;

                    if(slot == 1){
                        if(company_name[i]==="am"){
                            $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + totalAirSurcharge);
                            $("#pmcrg"+[i]).html(documents_base_price[i] + sequreMoney + totalAirSurcharge);
                        }else{
                            $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney);
                            $("#pmcrg"+[i]).html(documents_base_price[i] + sequreMoney);
                        }

                    }else{
                        slot = slot-1;
                        if(company_name[i]==="am"){
                            $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot + totalAirSurcharge);
                            $("#pmcrg"+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot + totalAirSurcharge);
                        }else{
                            $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot);
                            $("#pmcrg"+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot);
                        }
                    }                    
                }

                for (let i = 0; i < goods_base_price.length; i++) {
                    var slot = Math.ceil(_weight/goods_weight_slot[i]);
                    // var totalAirSurcharge = airSurcharge * slot;

                    if(slot == 1){
                        if(company_name[i]==="am"){
                            $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + totalAirSurcharge);
                            $("#spcrg"+[i]).html(goods_base_price[i] + sequreMoney + totalAirSurcharge);
                        }else{
                            $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney);
                            $("#spcrg"+[i]).html(goods_base_price[i] + sequreMoney);                            
                        }

                    }else{
                        slot = slot - 1;
                        
                        if(company_name[i]==="am"){
                            $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot + totalAirSurcharge);
                            $("#spcrg"+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot + totalAirSurcharge);
                        }else{
                            $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot);
                            $("#spcrg"+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot);                                                      
                        }
                    }                    
                }
            }
        }

        if ($(this).val() == 1) {
            $("#modelinsfee").html(0);            
            var insreg=document.querySelectorAll(".modelfee");
            var totalAirSurcharge = 0;

            for (let i = 0; i < insreg.length; i++) {
                insreg[i].innerText = "100";                
            }

            $("#sinsfee").html(0);
            $("#sfee").html( "100");

            reg_letter_post = reg_letter_post+100;
            var sequreMoney = 100;

            if (_weight <= 0 || _weight == '') {
                for (let i = 0; i < parcel_base_price.length; i++) {
                    $('#parcel_base_price'+[i]).html(0);
                }

                for (let i = 0; i < letters_base_price.length; i++) {
                    $('#letters_base_price'+[i]).html(0);
                }

                for (let i = 0; i < documents_base_price.length; i++) {
                    $('#documents_base_price'+[i]).html(0);
                }

                for (let i = 0; i < goods_base_price.length; i++) {
                    $('#goods_base_price'+[i]).html(0);
                }

            }else{
                for (let i = 0; i < parcel_base_price.length; i++) {
                    var slot = Math.ceil(_weight/parcel_weight_slot[i]);
                    if(slot==1){
                        if(company_name[i] ==="em"){
                            $('#parcel_base_price'+[i]).html(parcel_base_price[i])
                            $('#emscrg'+[i]).html(parcel_base_price[i])
                        }else{
                            $('#parcel_base_price'+[i]).html(parcel_base_price[i]+sequreMoney)
                            $('#emscrg'+[i]).html(parcel_base_price[i]+sequreMoney) 
                        }
                        
                    }else{
                        slot = slot-1;
                        if(company_name[i] ==="em"){
                            $('#parcel_base_price'+[i]).html(parcel_base_price[i]+parcel_hike_price[i]*slot);
                            $('#emscrg'+[i]).html(parcel_base_price[i]+parcel_hike_price[i]*slot)
                        }else{
                            $('#parcel_base_price'+[i]).html(parcel_base_price[i]+sequreMoney+parcel_hike_price[i]*slot);
                            $('#emscrg'+[i]).html(parcel_base_price[i]+sequreMoney+parcel_hike_price[i]*slot)
                        }                        
                    }
                }

                for (let i = 0; i < letters_base_price.length; i++) {
                    var slot = Math.ceil(_weight/letters_weight_slot[i]);
                    var totalAirSurcharge = airSurcharge * slot;

                    if(slot == 1){                        
                        if(company_name[i]==="am"){
                            $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + totalAirSurcharge);
                            $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + totalAirSurcharge);
                        }else{
                            $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney);
                            $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney);
                        }

                    }else{
                        slot = slot-1;
                                                
                        if(company_name[i]==="am"){
                            $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot + totalAirSurcharge);
                            $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot + totalAirSurcharge);
                        }else{
                            $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot);
                            $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot);
                        }
                    }  
                }

                for (let i = 0; i < documents_base_price.length; i++) {
                    var slot = Math.ceil(_weight/documents_weight_slot[i]);
                    // var totalAirSurcharge = airSurcharge * slot;

                    if(slot == 1){                        
                        if(company_name[i]==="am"){
                            $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + totalAirSurcharge);
                            $("#pmcrg"+[i]).html(documents_base_price[i] + sequreMoney + totalAirSurcharge);
                        }else{
                            $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney);
                            $("#pmcrg"+[i]).html(documents_base_price[i] + sequreMoney);                            
                        }

                    }else{
                        slot = slot - 1;
                                                
                        if(company_name[i]==="am"){
                            $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot + totalAirSurcharge);
                            $("#pmcrg"+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot + totalAirSurcharge);
                        }else{
                            $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot);
                            $("#pmcrg"+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot);
                        }
                    }
                }

                for (let i = 0; i < goods_base_price.length; i++) {
                    var slot = Math.ceil(_weight/goods_weight_slot[i]);
                    // var totalAirSurcharge = airSurcharge * slot;

                    if(slot == 1){
                        if(company_name[i]==="am"){
                            $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + totalAirSurcharge);
                            $("#spcrg"+[i]).html(goods_base_price[i] + sequreMoney + totalAirSurcharge);
                        }else{
                            $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney);
                            $("#spcrg"+[i]).html(goods_base_price[i] + sequreMoney);                            
                        }

                    }else{
                        slot = slot - 1;
                                                
                        if(company_name[i]==="am"){
                            $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot + totalAirSurcharge);
                            $("#spcrg"+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot + totalAirSurcharge);
                        }else{
                            $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot);
                            $("#spcrg"+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot);                                                      
                        }
                    }                    
                }
            }
        }

        if ($(this).val() == 2) {
            var insreg=document.querySelectorAll(".modelfee");
            var totalAirSurcharge =0;
            for (let i = 0; i < insreg.length; i++) {
                insreg[i].innerText = "100";                
            }

            var sequreMoney = 100;

            if (_weight <= 0 || _weight == '') {
                for (let i = 0; i < parcel_base_price.length; i++) {
                    $('#parcel_base_price'+[i]).html(0);
                }

                for (let i = 0; i < letters_base_price.length; i++) {
                    $('#letters_base_price'+[i]).html(0);
                }

                for (let i = 0; i < documents_base_price.length; i++) {
                    $('#documents_base_price'+[i]).html(0);
                }

                for (let i = 0; i < goods_base_price.length; i++) {
                    $('#goods_base_price'+[i]).html(0);
                }

            }else{
                for (let i = 0; i < parcel_base_price.length; i++) {
                    var slot = Math.ceil(_weight/parcel_weight_slot[i]);

                    if(slot == 1){
                        if(company_name[i] ==="em"){
                            $('#parcel_base_price'+[i]).html(parcel_base_price[i])
                            $('#emscrg'+[i]).html(parcel_base_price[i])
                        }else{
                            $('#parcel_base_price'+[i]).html(parcel_base_price[i]+sequreMoney) 
                            $('#emscrg'+[i]).html(parcel_base_price[i]+sequreMoney)
                        } 
                        
                    }else{
                        slot = slot-1;
                        if(company_name[i] ==="em"){
                            $('#parcel_base_price'+[i]).html(parcel_base_price[i]+parcel_hike_price[i]*slot);
                            $('#emscrg'+[i]).html(parcel_base_price[i]+parcel_hike_price[i]*slot)
                        }else{
                            $('#parcel_base_price'+[i]).html(parcel_base_price[i]+sequreMoney+parcel_hike_price[i]*slot);
                            $('#emscrg'+[i]).html(parcel_base_price[i]+sequreMoney+parcel_hike_price[i]*slot)
                        }
                        
                    }
                }

                for (let i = 0; i < letters_base_price.length; i++) {
                    var slot = Math.ceil(_weight/letters_weight_slot[i]);
                    var totalAirSurcharge = airSurcharge * slot;

                    if(slot == 1){
                        if(company_name[i]==="am"){
                            $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + totalAirSurcharge);
                            $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + totalAirSurcharge);
                        }else{
                            $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney);
                            $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney);                                                        
                        }

                    }else{
                        slot = slot - 1;
                        
                        if(company_name[i]==="am"){
                            $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot + totalAirSurcharge);
                            $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot + totalAirSurcharge);
                        }else{
                            $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot);
                            $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + letters_hike_price[i] * slot);
                        }
                    }  
                }

                for (let i = 0; i < documents_base_price.length; i++) {
                    var slot = Math.ceil(_weight/documents_weight_slot[i]);
                    // var totalAirSurcharge = airSurcharge * slot;

                    if(slot == 1){
                        if(company_name[i]==="am"){
                            $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + totalAirSurcharge);
                            $('#pmcrg'+[i]).html(documents_base_price[i] + sequreMoney + totalAirSurcharge);
                        }else{
                            $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney);
                            $('#pmcrg'+[i]).html(documents_base_price[i] + sequreMoney);                            
                        }

                    }else{
                        slot = slot - 1;
                        
                        if(company_name[i]==="am"){
                            $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot + totalAirSurcharge);
                            $('#pmcrg'+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot + totalAirSurcharge);
                        }else{
                            $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot);
                            $('#pmcrg'+[i]).html(documents_base_price[i] + sequreMoney + documents_hike_price[i] * slot);
                        }
                    }                    
                }

                for (let i = 0; i < goods_base_price.length; i++) {
                    var slot = Math.ceil(_weight/goods_weight_slot[i]);
                    // var totalAirSurcharge = airSurcharge * slot;

                    if(slot == 1){
                        if(company_name[i]==="am"){
                            $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + totalAirSurcharge);
                            $('#spcrg'+[i]).html(goods_base_price[i] + sequreMoney + totalAirSurcharge);
                        }else{
                            $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney);
                            $('#spcrg'+[i]).html(goods_base_price[i] + sequreMoney);
                        }

                    }else{
                        slot = slot - 1;
                        
                        if(company_name[i]==="am"){
                            $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot + totalAirSurcharge);
                            $('#spcrg'+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot + totalAirSurcharge);
                        }else{
                            $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot);
                            $('#spcrg'+[i]).html(goods_base_price[i] + sequreMoney + goods_hike_price[i] * slot);                            
                        }
                    }                      
                }
            }
        }
    });

    
    //----------- Check insurance input
    $('#insured').keyup( function () {
        var totalAirSurcharge = 0;
        if($('#weight').val() > 0){
            var _insurance = $(this).val();
            insuredInput = $(this).val();
            var _weight = $("#weight").val();

            // Check Maximum Weight
            if(_insurance > max_insured) {
                alert("Parcel insurance can't be over " + max_insured);
                $(this).val($(this).val().slice(0,-1));
                return false;
            }
            
            if($('#parcelType2').is(":checked")){
                var sequreMoney = 100;
            }else if($('#parcelType3').is(':checked')) {
                var sequreMoney = 100;
            }else if($('#parcelType1').is(':checked')){
                var sequreMoney = 0;
            }

            var insured = 20;
            
            if(_insurance > 500){
                var insuredPrev = insured;
            }else if(_insurance <= 0 ) {
                insured = 0;
            }else{
                var insuredPrev = insured;
            }
            
            if(_insurance > 500 ) {
                var insured__ = insurancePrice_hike_per_slot;

                // Parcel Service
                for (let i = 0 ; i < parcel_base_price.length; i++) {

                    var slot = Math.ceil(_weight / parcel_weight_slot[i]); 
                    var insurance_slot = Math.ceil(_insurance / insurance_price_slot);

                    slot = slot - 1;
                    insurance_slot = insurance_slot - 1;

                    $("#sinsfee").html(insuredPrev + insured__ * insurance_slot);
                    $("#modelinsfee"+[i]).html(insuredPrev + insured__ * insurance_slot);
                                        
                    if(company_name[i] === "em"){
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i] + parcel_hike_price[i] * slot + insuredPrev + insured__ * insurance_slot);
                        $('#emscrg'+[i]).html(parcel_base_price[i] + parcel_hike_price[i] * slot + insuredPrev + insured__ * insurance_slot)
                    } else {                        
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i] + sequreMoney + parcel_hike_price[i] * slot + insuredPrev + insured__ * insurance_slot);
                        $('#emscrg'+[i]).html(parcel_base_price[i] + sequreMoney + parcel_hike_price[i] * slot + insuredPrev + insured__ * insurance_slot);
                    }
                }

                // Letters Service
                for (let i = 0; i < letters_base_price.length; i++) {
                    var slot = Math.ceil(_weight / letters_weight_slot[i]); 
                    var insurance_slot = Math.ceil(_insurance/insurance_price_slot);
                    var totalAirSurcharge = airSurcharge * slot;

                    slot = slot - 1;
                    insurance_slot = insurance_slot - 1;

                    if(company_name[i]==="am"){
                        $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + insuredPrev + insured__ * insurance_slot + letters_hike_price[i] * slot + totalAirSurcharge);
                        $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + insuredPrev + insured__ * insurance_slot + letters_hike_price[i] * slot + totalAirSurcharge);
                    }else{
                        $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + insuredPrev + insured__ * insurance_slot + letters_hike_price[i] * slot);
                        $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + insuredPrev + insured__ * insurance_slot + letters_hike_price[i] * slot);
                    }
                }

                // Documentes Service
                for (let i = 0; i < documents_base_price.length; i++) {
                    var slot = Math.ceil(_weight / documents_weight_slot[i]); 
                    var insurance_slot = Math.ceil(_insurance/insurance_price_slot);
                    // var totalAirSurcharge = airSurcharge * slot;

                    slot = slot - 1;
                    insurance_slot = insurance_slot - 1;                    

                    if(company_name[i]==="am"){
                        $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + insuredPrev + insured__ * insurance_slot + documents_hike_price[i] * slot + totalAirSurcharge);
                        $('#pmcrg'+[i]).html(documents_base_price[i] + sequreMoney + insuredPrev + insured__ * insurance_slot + documents_hike_price[i] * slot + totalAirSurcharge);
                    }else{
                        $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + insuredPrev + insured__ * insurance_slot + documents_hike_price[i] * slot);
                        $('#pmcrg'+[i]).html(documents_base_price[i] + sequreMoney + insuredPrev + insured__ * insurance_slot + documents_hike_price[i] * slot);                        
                    }
                }

                // Good Service
                for (let i = 0; i < goods_base_price.length; i++) {
                    var slot = Math.ceil(_weight / goods_weight_slot[i]); 
                    var insurance_slot = Math.ceil(_insurance/insurance_price_slot);
                    // var totalAirSurcharge = airSurcharge * slot;

                    slot = slot - 1;
                    insurance_slot = insurance_slot - 1;                    

                    if(company_name[i]==="am"){
                        $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + insuredPrev + insured__ * insurance_slot + goods_hike_price[i] * slot + totalAirSurcharge);
                        $('#spcrg'+[i]).html(goods_base_price[i] + sequreMoney + insuredPrev + insured__ * insurance_slot + goods_hike_price[i] * slot + totalAirSurcharge);
                    }else{
                        $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + insuredPrev + insured__ * insurance_slot + goods_hike_price[i] * slot);
                        $('#spcrg'+[i]).html(goods_base_price[i] + sequreMoney + insuredPrev + insured__ * insurance_slot + goods_hike_price[i] * slot);                        
                    }
                }

            }else {
                var totalAirSurcharge = 0;

                // Parcel Service
                for (let i = 0 ; i < parcel_base_price.length; i++) {

                    var slot = Math.ceil(_weight / parcel_weight_slot[i]);
                    slot = slot-1;

                    $("#sinsfee").html(insured);
                    $("#modelinsfee"+[i]).html(insured);
                    
                    if(company_name[i] === "em"){
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i] + parcel_hike_price[i] * slot + insured);
                        $('#emscrg'+[i]).html(parcel_base_price[i]+parcel_hike_price[i] * slot + insured)
                    } else {
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i] + parcel_hike_price[i] * slot + insured + sequreMoney);
                        $('#emscrg'+[i]).html(parcel_base_price[i]+parcel_hike_price[i] * slot + insured + sequreMoney);
                    }
                }

                // Letters Service
                for (let i = 0; i < letters_base_price.length; i++) {
                    var slot = Math.ceil(_weight / letters_weight_slot[i]);
                    var totalAirSurcharge = airSurcharge * slot;
                    slot = slot - 1;
                    
                    if(company_name[i]==="am"){
                        $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + insured + letters_hike_price[i] * slot + totalAirSurcharge);
                        $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + insured + letters_hike_price[i] * slot + totalAirSurcharge);
                    }else{
                        $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + insured + letters_hike_price[i] * slot);
                        $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + insured + letters_hike_price[i] * slot);                        
                    }
                }

                // Documentes Service
                for (let i = 0; i < documents_base_price.length; i++) {
                    var slot = Math.ceil(_weight / documents_weight_slot[i]);
                    // var totalAirSurcharge = airSurcharge * slot;

                    slot = slot-1;                    

                    if(company_name[i]==="am"){
                        $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + insured + documents_hike_price[i] * slot + totalAirSurcharge);
                        $("#lecrg"+[i]).html(documents_base_price[i] + sequreMoney + insured + documents_hike_price[i] * slot + totalAirSurcharge);
                    }else{
                        $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + insured + documents_hike_price[i] * slot);
                        $('#pmcrg'+[i]).html(documents_base_price[i] + sequreMoney + insured + documents_hike_price[i] * slot);                        
                    }
                }

                // Good Service
                for (let i = 0; i < goods_base_price.length; i++) {
                    var slot = Math.ceil(_weight / goods_weight_slot[i]);
                    // var totalAirSurcharge = airSurcharge * slot;
                    
                    slot = slot - 1;

                    if(company_name[i]==="am"){
                        $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + insured + goods_hike_price[i] * slot + totalAirSurcharge);
                        $('#spcrg'+[i]).html(goods_base_price[i] + sequreMoney + insured + goods_hike_price[i] * slot + totalAirSurcharge);
                    }else{
                        $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + insured + goods_hike_price[i] * slot);
                        $('#spcrg'+[i]).html(goods_base_price[i] + sequreMoney + insured + goods_hike_price[i] * slot);
                    }
                }
            }
        }
    });
    
    function countryChangeCalculation(){
        // Security Images Update
        $('input[name="parcelType"]').change(function () {
            if($(this).val()==0){
                $('.airaccountable').attr('style','display:none;max-width:50px')
                $('.airaccountable_2').attr('style','display:none;max-width:50px')
            }
            if($(this).val()==1){
                $('.airaccountable').attr('style','display:block;max-width:50px')
                $('.airaccountable_2').attr('style','display:none;max-width:50px')
                $("#sfee").html( "100")
            }
            if ($(this).val()==2) {
                $('.airaccountable_2').attr('style','display:block;max-width:50px')
                $('.airaccountable').attr('style','display:block;max-width:50px') 
                
            }
        })

        var upto = parcelPost_capacity[0]*1000;
        var letter_upto = letterPost_capacity[0]*1000;
        var _weight = $("#weight").val();
        
        // Letter Post Data Value for popup
        $("#lewdata").html(_weight);
        $("#pmwdata").html(_weight);
        $("#spwdata").html(_weight);
        
        // Check Maximum Weight
        if(_weight > upto) {
            alert(`Parcel weight can't be over ${upto/1000}kg`);
            $(this).val($(this).val().slice(0,-1));
            return false;
        }
        
        $("#weightkg").val(_weight / 1000);
        $("#emscost").html(_weight * 1000);

        var calcPrice  = 0;
        if($('#parcelType2').is(":checked")){
            var sequreMoney = registeredParcel_price;
            var insuredValue = 0;
            for (let i = 0; i < company_name.length; i++) {
                if(company_name[i].name ==="em"){
                    sequreMoney = 0;
                    return false;
                }                         
            } 
            $('.airaccountable').attr('style','display:block;max-width:50px')
        }else if($('#parcelType1').is(':checked')) {
            var sequreMoney = 0;
            var insuredValue = 0;
        }

        if($('#parcelType3').is(':checked')){
            var sequreMoney = registeredParcel_price;
            var prev_insured = 0;
            var insuredValue = $('#insured').val();
            var insuredSlot = Math.ceil(insuredValue / insurance_price_slot )-1;

            // Set first slot price of the insured 
            if(insuredValue>0){
                var prevCalcPrice = insuranceBase_price;
            }else{
                var prevCalcPrice = 0;
            }


            // Check insured slot
            if(insuredSlot<=0){
                calcPrice = 0;
            }
            else{
                calcPrice  = insurancePrice_hike_per_slot*insuredSlot + prevCalcPrice;
                // console.log(insur);
                // insured_letter_post = insured_letter_post+calcPrice;
            }

            $("#sinsfee").html(calcPrice);
            $("#modelinsfee").html(calcPrice);
        }
        
        if (_weight <= 0 || _weight == '') {
            for (let i = 0; i < parcel_base_price.length; i++) {
                $('#parcel_base_price'+[i]).html(0);
                $('#emscrg'+[i]).html(0)
            }

            for (let i = 0; i < letters_base_price.length; i++) {
                $('#letters_base_price'+[i]).html(0);
                $("#lecrg"+[i]).html(0);
            }

            for (let i = 0; i < documents_base_price.length; i++) {
                $('#documents_base_price'+[i]).html(0);
                $('#pmcrg'+[i]).html(0);
            }

            for (let i = 0; i < goods_base_price.length; i++) {
                $('#goods_base_price'+[i]).html(0);
                $('#spcrg'+[i]).html(0)
            }
        }else{
            for (let i = 0; i < parcel_base_price.length; i++) {

                var slot = Math.ceil(_weight / parcel_weight_slot[i]);
                if(slot == 1){
                    if(company_name[i] ==="em"){
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i]+calcPrice)
                        $('#emscrg'+[i]).html(parcel_base_price[i]+calcPrice)
                    }else{
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i]+sequreMoney+calcPrice) 
                        $('#emscrg'+[i]).html(parcel_base_price[i]+sequreMoney+calcPrice)
                    }
                }else{
                    slot = slot-1;
                    if(company_name[i] ==="em"){
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i]+parcel_hike_price[i] * slot+calcPrice);
                        $('#emscrg'+[i]).html(parcel_base_price[i]+parcel_hike_price[i] * slot+calcPrice)
                    }else{
                        $('#parcel_base_price'+[i]).html(parcel_base_price[i] + sequreMoney+parcel_hike_price[i] * slot+calcPrice); 
                        $('#emscrg'+[i]).html(parcel_base_price[i] + sequreMoney+parcel_hike_price[i] * slot+calcPrice)
                    }                    
                } 
            }

            for (let i = 0; i < letters_base_price.length; i++) {
                var slot = Math.ceil(_weight/letters_weight_slot[i]);
                var totalAirSurcharge = airSurcharge * slot;

                if(slot==1){
                    if(company_name[i]==="am"){
                        $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + calcPrice + totalAirSurcharge);
                        $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + calcPrice + totalAirSurcharge);
                    }else{
                        $('#letters_base_price'+[i]).html(letters_base_price[i]+sequreMoney+calcPrice);
                        $("#lecrg"+[i]).html(letters_base_price[i]+sequreMoney+calcPrice);
                    } 
                    $(".modelas").html(airSurcharge);
                }else{
                    slot = slot-1;
                    if(company_name[i]==="am"){
                        // alert(airSurcharge*slot);
                        // return false;
                        $('#letters_base_price'+[i]).html(letters_base_price[i] + sequreMoney + (letters_hike_price[i] * slot) + calcPrice + totalAirSurcharge);
                        $("#lecrg"+[i]).html(letters_base_price[i] + sequreMoney + (letters_hike_price[i] * slot) + calcPrice + totalAirSurcharge)
                    }else{
                        $('#letters_base_price'+[i]).html(letters_base_price[i]+sequreMoney+letters_hike_price[i]*slot+calcPrice);
                        $("#lecrg"+[i]).html(letters_base_price[i]+sequreMoney+letters_hike_price[i]*slot+calcPrice)
                    }
                    
                    $(".modelas").html(totalAirSurcharge);
                }  
            }

            for (let i = 0; i < documents_base_price.length; i++) {
                var slot = Math.ceil(_weight/documents_weight_slot[i]);
                // var totalAirSurcharge = airSurcharge * slot;

                if(slot==1){
                    if(company_name[i]==="am"){
                        $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + calcPrice + totalAirSurcharge) 
                        $('#pmcrg'+[i]).html(documents_base_price[i] + sequreMoney + calcPrice + totalAirSurcharge);
                    }else{
                        $('#documents_base_price'+[i]).html(documents_base_price[i]+sequreMoney+calcPrice) 
                        $('#pmcrg'+[i]).html(documents_base_price[i]+sequreMoney+calcPrice);
                    }
                    
                }else{
                    slot = slot-1;
                    if(company_name[i]==="am"){
                        $('#documents_base_price'+[i]).html(documents_base_price[i] + sequreMoney + (documents_hike_price[i] * slot) + calcPrice + totalAirSurcharge);
                        $('#pmcrg'+[i]).html(documents_base_price[i] + sequreMoney + (documents_hike_price[i] * slot) + calcPrice + totalAirSurcharge) 
                    }else{
                        $('#documents_base_price'+[i]).html(documents_base_price[i]+sequreMoney+documents_hike_price[i]*slot+calcPrice);
                        $('#pmcrg'+[i]).html(documents_base_price[i]+sequreMoney+documents_hike_price[i]*slot+calcPrice)
                    }
                }
            }

            for (let i = 0; i < goods_base_price.length; i++) {
                var slot = Math.ceil(_weight/goods_weight_slot[i]);
                // var totalAirSurcharge = airSurcharge * slot;

                if(slot==1){
                    if(company_name[i]==="am"){
                        $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + calcPrice + totalAirSurcharge) 
                        $('#pmcrg'+[i]).html(goods_base_price[i] + sequreMoney + calcPrice + totalAirSurcharge);
                    }else{
                        $('#goods_base_price'+[i]).html(goods_base_price[i]+sequreMoney+calcPrice) 
                        $('#pmcrg'+[i]).html(goods_base_price[i]+sequreMoney+calcPrice);
                    }                    
                }else{
                    slot = slot-1;
                    if(company_name[i]==="am"){
                        $('#goods_base_price'+[i]).html(goods_base_price[i] + sequreMoney + (goods_hike_price[i] * slot) + calcPrice + totalAirSurcharge);
                        $('#pmcrg'+[i]).html(goods_base_price[i] + sequreMoney + (goods_hike_price[i] * slot) + calcPrice + totalAirSurcharge) 
                    }else{
                        $('#goods_base_price'+[i]).html(goods_base_price[i]+sequreMoney+goods_hike_price[i]*slot+calcPrice);
                        $('#pmcrg'+[i]).html(goods_base_price[i]+sequreMoney+goods_hike_price[i]*slot+calcPrice)
                    }                    
                }
            }            
        }                

        //Add ban button
        if(_weight > letter_upto) {
            for (let i = 0; i < company_name.length; i++) {
                $("#letters_base_price"+[i]).html(`<i class="fas fa-ban fs-5" aria-hidden="true"></i>`)
                $("#documents_base_price"+[i]).html(`<i class="fas fa-ban fs-5" aria-hidden="true"></i>`)
                $("#goods_base_price"+[i]).html(`<i class="fas fa-ban fs-5" aria-hidden="true"></i>`)
            }
        }

        for (let i = 0; i < letters_base_price.length; i++) {
            $("#lemin"+[i]).html(letters_base_price[i])
        }

        for (let i = 0; i < documents_base_price.length; i++) {
            $("#pmmin"+[i]).html(documents_base_price[i])
        }

        for (let i = 0; i < goods_base_price.length; i++) {
            $("#spmin"+[i]).html(goods_base_price[i])
        }
    }

    function clearvalue(){

        parcel_base_price = [];
        letters_base_price = [];
        documents_base_price = [];
        goods_base_price = [];
        parcel_hike_price = [];
        letters_hike_price = [];
        documents_hike_price = [];
        goods_hike_price = [];
        parcelPost_capacity = [];
        letterPost_capacity = [];
        parcel_weight_slot = [];
        letters_weight_slot = [];
        documents_weight_slot = [];
        goods_weight_slot = [];
        company_name = [];

        max_insured = 0;
        insurancePrice_hike_per_slot = 0;
        country_id = 0;
        insurance_price_slot = 0;
        reg_letter_post = 0;
        insured_letter_post = 0;
        airSurcharge = 0;
        registeredParcel_price =0;
    }

</script>


<script src="{{ asset('') }}/assets/front/custom.js"></script>