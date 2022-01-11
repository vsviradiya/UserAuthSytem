@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            
            <div class="container">
                <div class="card-title mb-3">
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
                    {{ __('User Listing') }}
                    <a href="{{ url('create')}}"style="float: right; font-weight: 900;" class="create btn btn-info btn-sm" >
                        Create User
                    </a>
                </div>
                <table class="table table-sortable user_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subscriptionday</th>
                            <th>Unique_Id</th>
                            <th width="100px">#</th>
                            <th width="100px">#</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subscriptionday</th>
                            <th>Unique_Id</th>
                            <th width="100px">#</th>
                            <th width="100px">#</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
