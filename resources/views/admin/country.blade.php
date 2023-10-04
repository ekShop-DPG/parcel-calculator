@extends('admin.master')
@section('breadcum')
<div class="col-5 align-self-center">
    <h4 class="page-title">Dashboard</h4>
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Country Lists</li>
            </ol>
        </nav>
    </div>
</div>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="table__head d-flex align-items-center justify-content-between mb-4">
                <h2 class="heading" style="margin-bottom: 0">
                    Country Lists
                </h2>
                <a href="#" class=" btn btn-success" data-toggle="modal" data-target="#addCountry">Add Country</a>
            </div>
            <table id="countrytable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Country Name</th>
                        <th>Region</th>
                        <th>Air Surcharge</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($country as $key=>$item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->country_name }}</td>
                        <td>
                            {{ $item->region }}
                        </td>
                        <td>{{ $item->airSurcharge }}</td>
                        <td class=" d-flex align-items-center" style="column-gap: 5px">
                            <a href="#" class="country_edit btn btn-sm btn-primary" data-id='{{ $item->id }}'> <i class="fa fa-edit"></i></a>
                            <a href="" class="company_delete btn btn-sm btn-danger"> <i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    
            </table>
        </div>
    </div>
    {{-- Country Add Modal --}}

    <div class="modal fade" id="addCountry" tabindex="-1" role="dialog" aria-labelledby="addCountry" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 800px">
          <div class="modal-content mx-auto" style="min-width: 800px;">
            <div class="modal-header">
              <h5 class="modal-title" style="text-align: center" id="exampleModalLongTitle">Add Country</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('country.save') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Country Name</label>
                        <input type="text" class=" form-control" name="country_name" placeholder="Enter Country Name">
                        @error('country_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Country Short Code</label>
                        <input type="text" class=" form-control" name="country_code" placeholder="Enter Country Code">
                        @error('country_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Country Region</label>
                        <input type="text" class=" form-control" name="region" placeholder="Enter Country Region">
                        @error('region')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Air Surcharge</label>
                        <input type="number" class=" form-control" name="airSurcharge" placeholder="Enter Air Surcharge">
                        @error('airSurcharge')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
          </div>
        </div>
    </div>
    {{-- Country Edit Modal --}}
    <div class="modal fade" id="editCountry" tabindex="-1" role="dialog" aria-labelledby="addCountry" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 800px">
          <div class="modal-content mx-auto" style="min-width: 800px;">
            <div class="modal-header">
              <h5 class="modal-title" style="text-align: center" id="exampleModalLongTitle">Add Country</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="__countryedit">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Country Name</label>
                        <input type="text" class=" form-control" name="country_name" placeholder="Enter Country Name" id="country_name">
                        @error('country_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Country Short Code</label>
                        <input type="text" class=" form-control" name="country_code" placeholder="Enter Country Code" id="country_code">
                        @error('country_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Country Region</label>
                        <input type="text" class=" form-control" name="region" placeholder="Enter Country Region" id="region">
                        @error('region')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Air Surcharge</label>
                        <input type="number" class=" form-control" name="airSurcharge" placeholder="Enter Air Surcharge" id="surcharge">
                        @error('airSurcharge')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
          </div>
        </div>
    </div>

@endsection
