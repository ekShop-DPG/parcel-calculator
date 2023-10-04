

@extends('admin.master')
@section('breadcum')
<div class="col-5 align-self-center">
    <h4 class="page-title">Dashboard</h4>
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Parcel Service</li>
            </ol>
        </nav>
    </div>
</div>
@endsection
@section('content')
    <style>
       #countrySettings th.sorting{
           font-size: 12px !important;
           min-width: 90px;
           width: auto;
           text-transform: capitalize;
       }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="table__head d-flex align-items-center justify-content-between mb-4">
                <h2 class="heading" style="margin-bottom: 0">
                    Parcel Services Lists
                </h2>
                <a href="#" class=" btn btn-success" data-toggle="modal" data-target="#country_settings">Create Parcel Service</a>
            </div>
        </div>
        <div class="col-md-12 mx-auto table-responsive" style="overflow-x: auto">
            <table id="countrySettings" class="table table-sm table-striped row-border" style="width:auto">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Country Name</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Delivery Time</th>
                        <th scope="col">Parcel Post Capacity</th>
                        <th scope="col">Latter Post Capacity</th>
                        <th scope="col">Parcel Weight Slot</th>
                        <th scope="col">Letters Weight Slot</th>
                        <th scope="col">Documents Weight Slot</th>
                        <th scope="col">Goods Weight Slot</th>
                        <th scope="col">Parcel Base Price</th>
                        <th scope="col">Letters Base Price</th>
                        <th scope="col">Documents Base Price</th>
                        <th scope="col">Goods Base Price</th>
                        <th scope="col">Parcel Hike Price</th>
                        <th scope="col">Letters Hike Price</th>
                        <th scope="col">Documents Hike Price</th>
                        <th scope="col">Goods Hike Price</th>
                        <th scope="col"> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parcelservices as $key=>$item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->country_name }}</td>
                        <td>
                            {{ $item->name }}
                        </td>
                        <td>
                            <img src="{{ asset('') }}/company_logo/{{ $item->company_logo }}" alt="" width="100">
                        </td>
                        <td>{{ $item->delivery_days }} days</td>
                        <td>{{ $item->parcelPost_capacity }}kg</td>
                        <td>{{ $item->letterPost_capacity }}kg</td>
                        <td>
                            @if ($item->parcel_weight_slot)
                            {{ $item->parcel_weight_slot }}gm
                            @else
                                <strong>N/A</strong>
                            @endif
   
                        </td>
                        <td>
                            @if ($item->letters_weight_slot)
                            {{ $item->letters_weight_slot }}gm
                            @else
                                <strong>N/A</strong>
                            @endif
   
                        </td>
                        <td>
                            @if ($item->documents_weight_slot)
                            {{ $item->documents_weight_slot }}gm
                            @else
                                <strong>N/A</strong>
                            @endif
                        </td>
                        <td>
                            @if ($item->goods_weight_slot)
                            {{ $item->goods_weight_slot}}gm
                            @else
                                <strong>N/A</strong>
                            @endif
                        </td>
                        <td>{{ $item->parcel_base_price }}</td>
                        <td>
                            @if ($item->letters_base_price>0)
                            {{ $item->letters_base_price}}TK
                            @else
                                <strong>N/A</strong>
                            @endif
                        </td>
                        <td>
                            @if ($item->documents_base_price>0)
                            {{ $item->documents_base_price}}TK
                            @else
                                <strong>N/A</strong>
                            @endif
                        </td>
                        <td>
                            @if ($item->goods_base_price>0)
                            {{ $item->goods_base_price}}TK
                            @else
                                <strong>N/A</strong>
                            @endif
                        </td>
                        <td>
                            @if ($item->parcel_hike_price>0)
                            {{ $item->parcel_hike_price}}TK
                            @else
                                <strong>N/A</strong>
                            @endif
                        </td>
                        <td>
                            @if ($item->letters_hike_price>0)
                            {{ $item->letters_hike_price}}TK
                            @else
                                <strong>N/A</strong>
                            @endif
                        </td>
                        <td>
                            @if ($item->documents_hike_price>0)
                            {{ $item->documents_hike_price}}TK
                            @else
                                <strong>N/A</strong>
                            @endif
                        </td>
                        <td>
                            @if ($item->goods_hike_price>0)
                            {{ $item->goods_hike_price}}TK
                            @else
                                <strong>N/A</strong>
                            @endif
                        </td>
                        <td class=" d-flex align-items-center" style="column-gap: 5px">
                            <a href="#" class="countrySetting_edit btn btn-sm btn-primary" data-id='{{ $item->id }}'> <i class="fa fa-edit"></i></a>
                            <a href="{{ route('service.delete',$item->id) }}" class="company_delete btn btn-sm btn-danger"> <i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    
            </table>
        </div>
    </div>
    {{-- Country Settings Add Modal --}}

    <div class="modal fade" id="country_settings" tabindex="-1" role="dialog" aria-labelledby="country_settings" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 900px">
          <div class="modal-content mx-auto" style="min-width: 900px;">
            <div class="modal-header">
              <h5 class="modal-title" style="text-align: center" id="exampleModalLongTitle">Add Parcel Service</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('countrySettings.save') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Select Country</label>
                                <select name="country_id" id="country_id" class=" form-control">
                                    <option >--Select Country--</option>
                                    @foreach ($country_data as $item)
                                        <option value="{{ $item->id }}">{{ $item->country_name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Select Company</label>
                                <select name="company_id" id="check_company" class=" form-control">
                                    <option >--Select Company--</option>
                                    @foreach ($company_data as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Parcel Base Price</label>
                                <input type="number" class=" form-control" name="parcel_base_price" placeholder="Enter Parcel Base Price(TK)">
                                @error('parcel_base_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Parcel Hike Price</label>
                                <input type="number" class=" form-control" name="parcel_hike_price" placeholder="Enter Parcel Hike Price(Tk)">
                                @error('parcel_hike_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Letters Base Price</label>
                                <input type="number" class=" form-control" name="letters_base_price" placeholder="Enter Letters Base Price(TK)">
                                @error('letters_base_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Letters Hike Price</label>
                                <input type="number" class=" form-control" name="letters_hike_price" placeholder="Enter Letters Hike Price(TK)">
                                @error('letters_hike_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Documents Base Price</label>
                                <input type="number" class=" form-control" name="documents_base_price" placeholder="Enter Documents Base Price(TK)">
                                @error('documents_base_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Documents Hike Price</label>
                                <input type="number" class=" form-control" name="documents_hike_price" placeholder="Enter Documents Hike Price(TK)">
                                @error('documents_hike_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Goods Base Price</label>
                                <input type="number" class=" form-control" name="goods_base_price" placeholder="Enter Goods Base Price(TK)">
                                @error('goods_base_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Goods Hike Price</label>
                                <input type="number" class=" form-control" name="goods_hike_price" placeholder="Enter Goods Hike Price(TK)">
                                @error('goods_hike_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Delivery Days</label>
                                <input type="text" class=" form-control" name="delivery_days" placeholder="days-days">
                                @error('delivery_days')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Parcel Post Capacity</label>
                                <input type="number" class=" form-control" name="parcelPost_capacity" placeholder="Enter Parcel Post Capacity(kg)">
                                @error('parcelPost_capacity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Letter Post Capacity</label>
                                <input type="number" class=" form-control" name="letterPost_capacity" placeholder="Enter Letter Post Capacity(kg)">
                                @error('letterPost_capacity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Parcel Weight Slot</label>
                                <input type="number" class=" form-control" name="parcel_weight_slot" placeholder="Enter Parcel Weight Slot(gm)">
                                @error('parcel_weight_slot')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Letters Weight Slot</label>
                                <input type="number" class=" form-control" name="letters_weight_slot" placeholder="Enter Letters Weight Slot(gm)">
                                @error('letters_weight_slot')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Documents Weight Slot</label>
                                <input type="number" class=" form-control" name="documents_weight_slot" placeholder="Enter Documents Weight Slot(gm)">
                                @error('documents_weight_slot')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Goods Weight Slot</label>
                                <input type="number" class=" form-control" name="goods_weight_slot" placeholder="Enter Goods Weight Slot(gm)">
                                @error('goods_weight_slot')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label for="specials">Is Speacial Price?</label>
                                <input type="checkbox" name="is_special_price" id="specials">
                            </div>
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
          </div>
        </div>
    </div>


    {{-- Country Settings Edit Modal --}}
    <div class="modal fade" id="editCountrySettings" tabindex="-1" role="dialog" aria-labelledby="editCountrySettings" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 800px">
            <div class="modal-content mx-auto" style="min-width: 800px;">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align: center" id="exampleModalLongTitle">Add Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="__countrySettings" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Select Country</label>
                                    <select name="country_id" class=" form-control" id="countrySettingCountry">
                                        <option >--Select Country--</option>
                                        @foreach ($country_data as $item)
                                            <option value="{{ $item->id }}">{{ $item->country_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Select Company</label>
                                    <select name="company_id" id="check_company_id" class=" form-control">
                                        <option >--Select Company--</option>
                                        @foreach ($company_data as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Parcel Base Price(Tk)</label>
                                    <input type="number" class=" form-control" name="parcel_base_price" placeholder="Enter Parcel Base Price(Tk)" id="parcel_base_price">
                                    @error('parcel_base_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Parcel Hike Price(Tk)</label>
                                    <input type="number" class=" form-control" name="parcel_hike_price" placeholder="Enter Parcel Hike Price(Tk)" id="parcel_hike_price">
                                    @error('parcel_hike_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Letters Base Price(Tk)</label>
                                    <input type="number" class=" form-control" name="letters_base_price" placeholder="Enter Letters Base Price(Tk)" id="letters_base_price">
                                    @error('letters_base_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Letters Hike Price(Tk)</label>
                                    <input type="number" class=" form-control" name="letters_hike_price" placeholder="Enter Letters Hike Price(Tk)" id="letters_hike_price">
                                    @error('letters_hike_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Documents Base Price(Tk)</label>
                                    <input type="number" class=" form-control" name="documents_base_price" placeholder="Enter Documents Base Price(Tk)" id="documents_base_price">
                                    @error('documents_base_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Documents Hike Price(Tk)</label>
                                    <input type="number" class=" form-control" name="documents_hike_price" placeholder="Enter Documents Hike Price(Tk)" id="documents_hike_price">
                                    @error('documents_hike_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Goods Base Price(Tk)</label>
                                    <input type="number" class=" form-control" name="goods_base_price" placeholder="Enter Goods Base Price(Tk)" id="goods_base_price">
                                    @error('goods_base_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Goods Hike Price(Tk)</label>
                                    <input type="number" class=" form-control" name="goods_hike_price" placeholder="Enter Goods Hike Price(Tk)" id="goods_hike_price">
                                    @error('goods_hike_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Delivery Days</label>
                                    <input type="text" class=" form-control" name="delivery_days" placeholder="days-days" id="delivery_days">
                                    @error('delivery_days')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Parcel Post Capacity(kg)</label>
                                    <input type="number" class=" form-control" name="parcelPost_capacity" placeholder="Enter Parcel Post Capacity(gm)" id="parcel_post_capacity">
                                    @error('parcelPost_capacity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Letter Post Capacity(kg)</label>
                                    <input type="number" class=" form-control" name="letterPost_capacity" placeholder="Enter Letter Post Capacity" id="letter_post_capacity">
                                    @error('letterPost_capacity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Parcel Weight Slot(gm)</label>
                                    <input type="number" class=" form-control" name="parcel_weight_slot" placeholder="Enter Parcel Weight Slot" id="parcel_weight_slot">
                                    @error('parcel_weight_slot')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Letters Weight Slot(gm)</label>
                                    <input type="number" class=" form-control" name="letters_weight_slot" placeholder="Enter Letters Weight Slot" id="letters_weight_slot">
                                    @error('letters_weight_slot')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Documents Weight Slot(gm)</label>
                                    <input type="number" class=" form-control" name="documents_weight_slot" placeholder="Enter Documents Weight Slot" id="documents_weight_slot">
                                    @error('documents_weight_slot')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label class="form-label">Goods Weight Slot(gm)</label>
                                    <input type="number" class=" form-control" name="goods_weight_slot" placeholder="Enter Goods Weight Slot" id="goods_weight_slot">
                                    @error('goods_weight_slot')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <div class="form-group">
                                    <label for="specials">Is Speacial Price?</label>
                                    <input type="checkbox" name="is_special_price" id="specials">
                                </div>
                                
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
