@extends('admin.master')
@section('breadcum')
<div class="col-5 align-self-center">
    <h4 class="page-title">Dashboard</h4>
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">API Users List</li>
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
                Api Users Lists
            </h2>
            @if (Session::has('message'))
                <div class=" alert alert-success">{{ Session::get('message') }}</div>
            @endif
            @if (Session::has('delete'))
                <div class=" alert alert-danger">{{ Session::get('delete') }}</div>
            @endif

            @error('api_username')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div>
                <a href="#" class=" btn btn-success" data-toggle="modal" data-target="#addApiUser">Add User</a>
                <a href="{{ route('ip.add') }}" class=" btn btn-danger">Add IP</a>
            </div>
        </div>
        <table id="countrytable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Api Username</th>
                    <th>Access Token Key</th>
                    <th>Status</th>
                    <th>IP Check Status</th>
                    <th>Counter</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($api_user_data as $key=>$item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->api_username }}</td>
                    <td>
                        {{ $item->access_token }}
                    </td>
                    <td>
                        @if ($item->is_active === 1)
                           <span class=" text-success"><i class="fas fa-circle"></i></span> 
                        @else
                            <span class=" text-danger"><i class="fas fa-circle"></i></span>  
                        @endif
                    </td>
                    <td>
                        @if ($item->ip_check === 1)
                           <span class=" text-success">ON</span> 
                        @else
                            <span class=" text-danger">OFF</span> 
                        @endif
                    </td>
                    <td>{{ $item->counter }}</td>
                    <td class=" d-flex align-items-center" style="column-gap: 5px">
                        <a href="#" class="api_user_edit btn btn-sm btn-primary" data-id='{{ $item->id }}'> <i class="fa fa-edit"></i></a>
                        <a href="{{ route('api_user.delete',$item->id) }}" class="company_delete btn btn-sm btn-danger disabled"> <i class="fa fa-trash"></i></a>
                        <a href="#" data-id='{{ $item->id }}' class="check_ip btn btn-sm btn-info"> <i class="fas fa-eye"></i> IP lists</a>
                    </td>
                </tr>
                @endforeach
                
        </table>
    </div>
</div>


{{-- Country Add Modal --}}

<div class="modal fade" id="addApiUser" tabindex="-1" role="dialog" aria-labelledby="addApiUser" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 800px">
      <div class="modal-content mx-auto" style="min-width: 800px;">
        <div class="modal-header">
          <h5 class="modal-title" style="text-align: center" id="exampleModalLongTitle">Add User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('api_user.save') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">User Name</label>
                    <input type="text" class=" form-control" name="api_username" placeholder="Enter User Name">
                </div>
                <button type="submit" class="btn btn-primary">Add User</button>
            </form>
        </div>
      </div>
    </div>
</div>

{{-- Api User Edit Modal --}}
<div class="modal fade" id="editapiUser" tabindex="-1" role="dialog" aria-labelledby="editapiUser" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 800px">
      <div class="modal-content mx-auto" style="min-width: 800px;">
        <div class="modal-header">
          <h5 class="modal-title" style="text-align: center" id="exampleModalLongTitle">Add Country</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="post" id="__useredit">
                @csrf
                <div class="mb-3">
                    <label class="form-label">User Name</label>
                    <input type="text" class=" form-control" name="user_name" placeholder="Enter Country Name" id="user_name" value="">
                    @error('user_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Access Token</label>
                    <input type="text" class=" form-control" name="access_token" placeholder="Enter Country Code" id="access_token" value="">
                    @error('access_token')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" id="is_active" class=" form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ip Check Status</label>
                    <select name="ip_check" id="ip_check" class=" form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    @error('ip_check')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
      </div>
    </div>
</div>

    {{-- Api User IP Edit Modal --}}
    <div class="modal fade" id="editapiUserIP" tabindex="-1" role="dialog" aria-labelledby="editapiUserIP" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 800px">
          <div class="modal-content mx-auto" style="min-width: 800px;">
            <div class="modal-header">
              <h5 class="modal-title" style="text-align: center" id="exampleModalLongTitle">Add Country</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table id="countrytable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>IP Address</th>
                            <th>Status</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="ip_lists">
                         
                </table>
            </div>
          </div>
        </div>
    </div>
@endsection

