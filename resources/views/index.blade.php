@extends('master')
@section('content')
<main style="background: #EDF2F9">
    <div class="main_content d-flex flex-column justify-content-center" style="padding-bottom: 70px">
        <div class="container">
            <div class="row align-items-center" style="margin-top: 105px; margin-bottom: 10px;">
                <div class="col-sm-12 col-lg-4 mb-sm-4">
                    <div class="left_box"
                        style="background-image:url('{{ asset('') }}/assets/front/image/post-office logo.png')">
                        <div class="select_country">
                            <label for="country">
                                <i class="bi bi-geo-alt"></i>
                                Destination Country
                            </label>
                            <div class="input-group mb-3">
                                <select id="sel_country" class="form-control block">
                                    <option value="0">- Select -</option>
                                    @foreach ($country as $item)
                                        <option value="{{ $item->id }}">{{ $item->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="conditional_display">
                            <label for="weight" class="form-label">
                                <i class="bi bi-minecart-loaded"></i>
                                Weight
                            </label>
                            <div class="input-group mb-3">
                                <input class="weight form-control block" type="number" name="weight" id="weight"
                                    style="text-align: right;" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Up to 20,000gm / 20kg" aria-label="Up to 20,000gm / 20kg">
                                <span class="input-group-text" id="basic-addon2">gm</span>
                                <input class="weight form-control block" type="text" value="0" id="weightkg"
                                    style="text-align: right;" readonly="">
                                <input type="hidden" name="pws" id="pws" value="0">
                                <span class="input-group-text" id="basic-addon2"
                                    style="border-top-right-radius: 5px;border-bottom-right-radius:5px">kg</span>
                            </div>
                            <label for="parcelType"><i class="bi bi-shield"></i> Security</label>
                            <div class="form-check" style="padding-left: 50px;">
                                <input type="radio" id="parcelType1" class="parcelType form-check-input"
                                    name="parcelType" value="0" checked="">
                                <label class="form-check-label" for="parcelType1">Regular</label>
                            </div>
                            <div class="form-check" style="padding-left: 50px;">
                                <input type="radio" id="parcelType2" class="parcelType form-check-input"
                                    name="parcelType" value="1">
                                <label class="form-check-label" for="parcelType2">
                                    <i class="far fa-registered"></i> Registred
                                </label>
                                <i class="bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="It will cost additional 100 BDT"></i>
                            </div>
                            <div class="form-check" style="padding-left: 50px;">
                                <input type="radio" class="parcelType form-check-input" id="parcelType3"
                                    name="parcelType" value="2">
                                <label class="form-check-label" for="parcelType3">
                                    <i class="bi bi-shield-check"></i>
                                    Insured
                                    <i class="bi bi-question-circle" data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="This is Insured, when you issue, insured parcel it will also be registred.!">
                                    </i>
                                    <div class="input-group">
                                        <input type="number" disabled class="form-control block"
                                            placeholder="Insurance Amount" id="insured" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Up to 10,000 Tk.">
                                        <span class="input-group-text" id="basic-addon2">Tk.</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-8" id="parcel__wrap">

                </div>
            </div>
        </div>
    </div>
</main>
@endsection