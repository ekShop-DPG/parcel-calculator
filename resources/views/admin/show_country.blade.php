@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Country</th>
                        <th>Company Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->country_name }}</td>
                        <td>
                            <div class="card">
                                <div class="card-body">
                                    {{ $item->companies->name }}
                                </div>
                            </div>
                        </td>
                    </tr> 
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection