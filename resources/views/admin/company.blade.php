@extends('admin.master')

@section('breadcum')
<div class="col-5 align-self-center">
    <h4 class="page-title">Dashboard</h4>
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Company Lists</li>
            </ol>
        </nav>
    </div>
</div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">  
                <div class="card-body">  
                    <div class="table__head d-flex align-items-center justify-content-between mb-4">
                        <h2 class="heading" style="margin-bottom: 0">
                            Company Lists
                        </h2>
                        <a href="#" class=" btn btn-success" data-toggle="modal" data-target="#addCompany">Add Company</a>
                    </div>                  
                    <div class="table-responsive overflow-auto" style=" width:auto; overflow:auto">
                        <table id="companyServices" class="table table-striped table-bordered display" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company Name</th>
                                    <th>Image</th>
                                    <th>Parcel Weight Slot</th>
                                    <th>Letters Weight Slot</th>
                                    <th>Documents Weight Slot</th>
                                    <th>Goods Weight Slot</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($company as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <img src="{{ asset('') }}/company_logo/{{ $item->company_logo }}" alt="" width="100">
                                        </td>
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
                                                {{ $item->goods_weight_slot }}gm
                                            @else
                                                <strong>N/A</strong>
                                            @endif
                                        </td>
                                        <td class=" d-flex align-items-center" style="column-gap: 5px">
                                            <a href="#" class="company_edit btn btn-sm btn-primary" data-id='{{ $item->id }}'> <i
                                                    class="fa fa-edit"></i></a>
                                            <a href="{{ route('company.delete',$item->id) }}" class="company_delete btn btn-sm btn-danger"> <i
                                                    class="fa fa-trash"></i></a>
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
    {{-- Company Add Modal --}}
    <div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="addCompany" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 800px">
            <div class="modal-content mx-auto" style="min-width: 800px;">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align: center" id="exampleModalLongTitle">Add Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('company.save') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class=" form-control" name="company_name"
                                        placeholder="Enter Company Name">
                                    @error('company_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Company Unicode</label>
                                    <input type="text" class=" form-control" name="company_shortcode"
                                        placeholder="Enter Company Unicode">
                                    @error('company_shortcode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Company Logo</label>
                                    <input type="file" class="form-control" name="company_logo" placeholder="Upload ">
                                    @error('company_logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="mb-3">
                                    <label class="form-label">BG Image</label>
                                    <input type="file" class="form-control" name="bg_image" placeholder="Upload Background Image">
                                    @error('bg_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">BG Color</label>
                                    <input type="color" class="form-control" name="bg_color" placeholder="Select Background Color" style="width:50px">
                                    @error('bg_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> --}}
                                <div class=" card">
                                    <div class=" card-header">
                                        <h4>Parcel Post</h4>
                                    </div>
                                    <div class=" card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Parcel Weight Slot</label>
                                            <input type="number" name="parcel_weight_slot" class=" form-control"
                                                placeholder="Enter Parcel Weight Slot">
                                            @error('parcel_weight_slot')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" card">
                                    <div class=" card-header">
                                        <h4>Letter Post</h4>
                                    </div>
                                    <div class=" card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Letters Weight Slot</label>
                                            <input type="number" class="form-control" name="letters_weight_slot"
                                                placeholder="Enter Letter Weight Slot">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Documents Weight Slot</label>
                                            <input type="number" class="form-control" name="documents_weight_slot"
                                                placeholder=" Enter Docments Weight Slot">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Goods Weight Slot</label>
                                            <input type="number" class="form-control" name="goods_weight_slot"
                                                placeholder="Enter Goods Weight Slot">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editCompany" tabindex="-1" role="dialog" aria-labelledby="editCompany" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 800px">
            <div class="modal-content mx-auto" style="min-width: 800px;">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align: center" id="exampleModalLongTitle">Add Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_company" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" id="company_name" class=" form-control" name="company_name"
                                        placeholder="Enter Company Name">
                                    @error('company_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Company Unicode</label>
                                    <input type="text" id="company_shortcode" class=" form-control" name="company_shortcode"
                                        placeholder="Enter Company Unicode">
                                    @error('company_shortcode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Company Logo</label>
                                    <input type="file" id="company_logo" class="form-control" name="company_logo" placeholder="Upload ">
                                    @error('company_logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <img src="" alt="" id="company_logo_img">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">BG Image</label>
                                    <input type="file" id="bg_image" class="form-control" name="bg_image" placeholder="Upload Background Image">
                                    @error('bg_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="mb-3">
                                    <label class="form-label">BG Color</label>
                                    <input type="color" id="bg_color" class="form-control" name="bg_color" placeholder="Select Background Color" style="width:50px">
                                    @error('bg_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> --}}
                                <div class=" card">
                                    <div class=" card-header">
                                        <h4>Parcel Post</h4>
                                    </div>
                                    <div class=" card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Parcel Weight Slot</label>
                                            <input type="number" id="parcel_weight" name="parcel_weight_slot" class=" form-control"
                                                placeholder="Enter Parcel Weight Slot">
                                            @error('parcel_weight_slot')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" card">
                                    <div class=" card-header">
                                        <h4>Letter Post</h4>
                                    </div>
                                    <div class=" card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Letters Weight Slot</label>
                                            <input type="number" id="letter_weight" class="form-control" name="letters_weight_slot"
                                                placeholder="Enter Letter Weight Slot">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Documents Weight Slot</label>
                                            <input type="number"id="doc_weight" class="form-control" name="documents_weight_slot"
                                                placeholder=" Enter Docments Weight Slot">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Goods Weight Slot</label>
                                            <input type="number" id="goods_weight" class="form-control" name="goods_weight_slot"
                                                placeholder="Enter Goods Weight Slot">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Company Edit Modal --}}

@endsection
