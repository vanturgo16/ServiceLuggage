@extends('layouts.master')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Location</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Location</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Location</h4>
                            <button class="btn btn-primary btn-round ml-auto btn-sm" data-toggle="modal" data-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Add Row
                            </button>
                        </div>
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <h4 class="modal-title">
                                            <span class="fw-mediumbold">Add</span> 
                                            <span class="fw-light">Location</span>
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                <form action="{{ route('location.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Code</label>
                                                    <input type="text" class="form-control @error('location_code') is-invalid @enderror" id="location_code" name="location_code" value="{{ old('location_code') }}">
                                                    
                                                    @error('location_code')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control @error('location_name') is-invalid @enderror" id="location_name" name="location_name" value="{{ old('location_name') }}">
                                                    
                                                    @error('location_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="comment">Address</label>
                                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2" cols="5">
                                                        {{ old('address') }}
                                                    </textarea>

                                                    @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="comment">Notes (Optional)</label>
                                                    <textarea class="form-control" id="notes" name="notes" rows="2" cols="5">
                                                        {{ old('notes') }}
                                                    </textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Coordinate</label>
                                                    <input type="text" class="form-control @error('coordinate') is-invalid @enderror" id="coordinate"  name="coordinate" value="{{ old('coordinate') }}">
                                                    
                                                    @error('coordinate')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">Example file input</label>
                                                    <input type="file" class="form-control-file @error('location_photo') is-invalid @enderror" id="location_photo" name="location_photo">
                                                    
                                                    @error('location_photo')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                                </div>
                            </div>
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
                            <table id="tableLocation" class="display table table-hover" >
                                <thead>
                                    <tr>
                                        <th>Code Location</th>
                                        <th>Name Location</th>
                                        <th>Address</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($locations as $item)
                                    <tr>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->loc_name }}</td>
                                        <td>{{ $item->loc_address }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-warning btn-round ml-auto btn-sm" data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                                    <i class="fa fa-edit"></i>
                                                    Edit
                                                </button>
                                                <button class="btn btn-danger btn-round ml-1 btn-sm" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- Modal Edit --}}
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h4 class="modal-title">
                                                        <span class="fw-mediumbold">Update</span> 
                                                        <span class="fw-light">Location</span>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                            <form action="{{ route('location.update') }}" method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="hidden" name="loc_id" id="loc_id" value="{{ $item->id }}">
                                                            <div class="form-group">
                                                                <label>Code</label>
                                                                <input type="text" class="form-control @error('location_code') is-invalid @enderror" id="location_code" name="location_code" value="{{ $item->code }}">
                                                                
                                                                @error('location_code')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" class="form-control @error('location_name') is-invalid @enderror" id="location_name" name="location_name" value="{{ $item->loc_name }}">
                                                                
                                                                @error('location_name')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="comment">Address</label>
                                                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2" cols="5">
                                                                    {{ $item->loc_address }}
                                                                </textarea>
            
                                                                @error('address')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="comment">Notes (Optional)</label>
                                                                <textarea class="form-control" id="notes" name="notes" rows="2" cols="5">
                                                                    {{ $item->notes }}
                                                                </textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Coordinate</label>
                                                                <input type="text" class="form-control @error('coordinate') is-invalid @enderror" id="coordinate"  name="coordinate" value="{{ $item->coordinate }}">
                                                                
                                                                @error('coordinate')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlFile1">Example file input</label>
                                                                <input type="file" class="form-control-file @error('location_photo') is-invalid @enderror" id="location_photo" name="location_photo">
                                                                
                                                                @error('location_photo')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <img src="{{ 'data:image/png;base64,'.$item->loc_photo }}" class="img-fluid" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer no-bd">
                                                    <button type="submit" id="updateButton" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal Delete --}}
                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h4 class="modal-title">
                                                        <span class="fw-mediumbold">Delete</span> 
                                                        <span class="fw-light">Location</span>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                            <form action="{{ route('location.delete') }}" method="POST" enctype="multipart/form-data">
                                                @method('DELETE')
                                                @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Are You Sure Want to Delete {{ $item->loc_name }} ?</label>
                                                                <input type="hidden" name="loc_id" id="loc_id" value="{{ $item->id }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer no-bd">
                                                    <button type="submit" id="deleteButton" class="btn btn-primary">Delete</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
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
        var table = $('#tableLocation').DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": true,
            "order":[],
        });
    });
</script>
@endsection