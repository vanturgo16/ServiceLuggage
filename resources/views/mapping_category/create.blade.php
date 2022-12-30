@extends('layouts.master')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Info Location</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Location Code</label>
                                    <br>
                                    {{ $location->code }}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Location Name</label>
                                    <br>
                                    {{ $location->loc_name }}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Location Address</label>
                                    <br>
                                    {{ $location->loc_address }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Categories</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success bg-success text-light" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if (session('failed'))
                        <div class="alert alert-danger bg-danger text-light" role="alert">
                            {{ session('failed') }}
                        </div>
                        @endif
                        
                        @if (count($errors)>0)
                        <div class="alert alert-warning bg-warning text-light" role="alert">
                            <ul>
                                <strong>Data Process Failed !</strong>
                                @foreach ($errors->all() as $error)
                                    <li><strong>{{ $error }}</strong></li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="tableMapping" class="display table table-hover" >
                                <thead>
                                    <tr>
                                        <th>Name Category</th>
                                        <th>Weight Range</th>
                                        <th style="width: 30%">Cost</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $item)
                                        <tr>
                                            <form action="{{ route('mappingctg.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <td>{{ $item->name_category }}</td>
                                            <td>{{ $item->weight_from." - ".$item->weight_until." (".$item->unit.")" }}</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="cost" name="cost" value="{{ $item->cost }}" placeholder="contoh input: 10000">
                                                    <input type="hidden" class="form-control" id="id_location" name="id_location" value="{{ $location->id }}">
                                                    <input type="hidden" class="form-control" id="id_category" name="id_category" value="{{ $item->id }}">
                                                </div>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary btn-round ml-auto btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                    Submit Data
                                                </button>
                                            </td>
                                            </form>
                                        </tr>
                                    @endforeach       
                                </tbody>
                            </table>
                        </div>            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script >
    $(document).ready(function() {
        var table = $('#tableMapping').DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": true,
            "order":[],
        });
    });
</script>
@endsection