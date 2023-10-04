@extends('admin.master')

@section('breadcum')
<div class="col-5 align-self-center">
    <h4 class="page-title">Dashboard</h4>
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">API User IP</li>
            </ol>
        </nav>
    </div>
</div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4 mx-auto">
            @if (Session::has('success'))
                <div class=" alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <form action="{{ route('ip.create') }}" method="post" id="__useredit">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Ip Number</label>
                    <input type="text" class=" form-control" name="ip_address" placeholder="Enter Ip Address" id="ip_address" value="">
                    @error('ip_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Access Token</label>
                    <select name="api_user_id" id="api_user_id" class=" form-control">
                        <option value="">Select User</option>
                        @foreach ($user_api as $item)
                            <option value="{{ $item->id }}">{{ $item->api_username }}</option>
                        @endforeach
                    </select>
                    @error('api_user_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection