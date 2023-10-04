@extends('admin.master')
@section('breadcum')
<div class="col-5 align-self-center">
    <h4 class="page-title">Dashboard</h4>
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Security Settings</li>
            </ol>
        </nav>
    </div>
</div>
@endsection
@section('content')

    @if ($message = Session::get('message'))
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" dat-autohide='true'
            data-delay="500" style="position: absolute; bottom: 30px; right: 20px;">
            <div class="toast-body text-success">
                {{ $message }}
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table__head d-flex align-items-center justify-content-between mb-4">
                        <h2 class="heading" style="margin-bottom: 0">
                            Security Settings
                        </h2>
                        <a href="#" class=" btn btn-success" data-toggle="modal" data-target="#addSecurity">Add Security</a>
                    </div>
                    
                    <div class="table-responsive overflow-auto" style=" width:auto; overflow:auto">
                        <table id="companyServices" class="table table-striped table-bordered display" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Registerd Parcel Price</th>
                                    <th>Insurance Base Price</th>
                                    <th>Insurance Price Slot</th>
                                    <th>Maximum Insurance Covarage</th>
                                    <th>Insurance Price Hike(Per Slot)</th>
                                    <th>ekshop parcel charge</th>
                                    <th>ekshop letter charge</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($security as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->registeredParcel_price }}</td>
                                        <td>
                                            {{ $item->insuranceBase_price }}
                                        </td>
                                        <td>
                                          {{ $item->insurancePrice_slot }}
                                        </td>
                                        <td>
                                            {{ $item->maximumInsurance_coverage }}
                                        </td>
                                        <td>
                                            {{ $item->insurancePrice_hike_per_slot }}
                                        </td>
                                        <td>
                                            {{ $item->ekshop_parcel_charge }}
                                        </td>
                                        <td>
                                            {{ $item->ekshop_letter_charge }}
                                        </td>
                                        <td class=" d-flex align-items-center" style="column-gap: 5px">
                                            <a href="#" class="security_edit btn btn-sm btn-primary" data-id='{{ $item->id }}'> <i
                                                    class="fa fa-edit"></i></a>
                                            <a href="{{ route('security.delete',$item->id) }}" class=" btn btn-sm btn-danger"> <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Security Modal --}}
    <div class="modal fade" id="addSecurity" tabindex="-1" role="dialog" aria-labelledby="addCompany" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 500px">
            <div class="modal-content mx-auto" style="min-width: 500px;">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align: center" id="exampleModalLongTitle">Security Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('security.save') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Registerd Parcel Price</label>
                                    <input type="number" class=" form-control" name="registeredParcel_price"
                                        placeholder="Enter registered parcel price">
                                    @error('registeredParcel_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Insurance Base Price</label>
                                    <input type="number" class="form-control" name="insuranceBase_price" placeholder="Enter Insurance Base Price">
                                    @error('insuranceBase_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Insurance Insurance Price Slot</label>
                                    <input type="number" class="form-control" name="insurancePrice_slot" placeholder="Insurance Insurance Price Slot">
                                    @error('insurancePrice_slot')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Maximum Coverage</label>
                                    <input type="number" class="form-control" name="maximumInsurance_coverage" placeholder="Insurance Insurance Price Slot">
                                    @error('maximumInsurance_coverage')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Insurance Price Hike(Per Slot)</label>
                                    <input type="number" class="form-control" name="insurancePrice_hike_per_slot" placeholder="Insurance Insurance Price Slot">
                                    @error('insurancePrice_hike_per_slot')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ekshop parcel charge</label>
                                    <input type="number" class="form-control" name="ekshop_parcel_charge" placeholder="ekshop parcel charge">
                                    @error('ekshop_parcel_charge')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ekshop letter charge</label>
                                    <input type="number" class="form-control" name="ekshop_letter_charge" placeholder="ekshop letter charge">
                                    @error('ekshop_letter_charge')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Security Edit --}}
    <div class="modal fade" id="editSecurity" tabindex="-1" role="dialog" aria-labelledby="addCompany" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 500px">
            <div class="modal-content mx-auto" style="min-width: 500px;">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align: center" id="exampleModalLongTitle">Security Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="security_edit" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Registerd Parcel Price</label>
                                    <input type="number" class=" form-control" name="registeredParcel_price"
                                        placeholder="Enter registered parcel price" id="registeredParcel_price">
                                    @error('registeredParcel_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Insurance Base Price</label>
                                    <input type="number" class="form-control" name="insuranceBase_price" placeholder="Enter Insurance Base Price" id="insuranceBase_price">
                                    @error('insuranceBase_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Insurance Insurance Price Slot</label>
                                    <input type="number" class="form-control" name="insurancePrice_slot" placeholder="Insurance Insurance Price Slot" id="insurancePrice_slot">
                                    @error('insurancePrice_slot')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Maximum Coverage</label>
                                    <input type="number" class="form-control" name="maximumInsurance_coverage" placeholder="Insurance Insurance Price Slot" id="maximumInsurance_coverage">
                                    @error('maximumInsurance_coverage')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Insurance Price Hike(Per Slot)</label>
                                    <input type="number" class="form-control" name="insurancePrice_hike_per_slot" placeholder="Insurance Insurance Price Slot" id="insurancePrice_hike_per_slot">
                                    @error('insurancePrice_hike_per_slot')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ekshop parcel charge</label>
                                    <input type="number" class="form-control" name="ekshop_parcel_charge" placeholder="ekshop parcel charge" id="ekshop_parcel_charge">
                                    @error('ekshop_parcel_charge')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ekshop letter charge</label>
                                    <input type="number" class="form-control" name="ekshop_letter_charge" placeholder="ekshop letter charge" id="ekshop_letter_charge">
                                    @error('ekshop_letter_charge')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="security_submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
