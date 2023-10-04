<div class="modal fade" id="parcelModal_test" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 780px;">
        <div class=" modal-content bg-light bg-card"
            style="background-image: url({{ asset('') }}/assets/front/image/corner-4.png);">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="font-weight: 400;"><i
                        class="fab fa-dropbox text-danger" aria-hidden="true"></i> Parcel Post Rate for <span
                        id="ppmodelcountry" style="font-weight: 800; text-transform: uppercase">USA</span> (up to 20kg)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row justify-content-center" id="specific_info">

                </div>
                <div class="text-center">
                    <span id="emsvatdisplay" style="">VAT (only for EMS) <span
                            class="badge rounded-pill bg-secondary bg-opacity-25 text-secondary">
                            <span id="emsvat">0</span> Tk.</span> <i class="bi bi-question-circle"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title=""
                            data-bs-bs-original-title="Only Applicable for Express Mail Service (EMS)"
                            aria-label="Only Applicable for Express Mail Service (EMS)"></i> | </span>Registration
                    <span class="badge rounded-pill bg-secondary bg-opacity-25 text-secondary"><span id="sfee">0</span>
                        Tk.</span> <i class="bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-html="true" title=""
                        title="Registration fee not applicable for Express Mail Services (EMS), EMS Registered by Default."
                        aria-label="Registration fee not applicable for Express Mail Services (EMS), EMS Registered by Default."></i>
                    | Insurance <span class="badge rounded-pill bg-secondary bg-opacity-25 text-secondary"><span
                            id="sinsfee">0</span> Tk.</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_letter_post">

</div>
