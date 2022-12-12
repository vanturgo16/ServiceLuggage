@extends('layouts.master')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Category</h4>
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
                    <a href="#">Category</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Category</h4>
                            <button class="btn btn-primary btn-round ml-auto btn-sm" data-toggle="modal" data-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Add Row
                            </button>
                        </div>
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <h4 class="modal-title">
                                            <span class="fw-mediumbold">Add</span> 
                                            <span class="fw-light">Category</span>
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Category Name</label>
                                                    <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ old('category_name') }}">
                                                    
                                                    @error('category_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Cost</label>
                                                    <input type="text" class="form-control @error('cost') is-invalid @enderror" id="cost" name="cost" value="{{ old('cost') }}">
                                                    
                                                    @error('cost')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Weight (in Kg)</label><br>
                                                    From
                                                    <input type="number" class="form-control @error('weight_from') is-invalid @enderror" id="weight_from" name="weight_from" value="{{ old('weight_from') }}">
                                                    @error('weight_from')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    Until
                                                    <input type="number" class="form-control @error('weight_until') is-invalid @enderror" id="weight_until" name="weight_until" value="{{ old('weight_until') }}">
                                                    @error('weight_until')
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
                            <table id="tableCategory" class="display table table-hover" >
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Weight Range</th>
                                        <th>Cost</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($categories as $item)
                                    <tr>
                                        <td>{{ $item->name_category }}</td>
                                        <td>{{ $item->weight_from." - ".$item->weight_until." (".$item->unit.")" }}</td>
                                        <td>{{ "Rp. ".number_format($item->cost,2,",",".") }}</td>
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
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h4 class="modal-title">
                                                        <span class="fw-mediumbold">Update</span> 
                                                        <span class="fw-light">Category</span>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                            <form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input type="hidden" name="ctg_id" id="ctg_id" value="{{ $item->id }}">
                                                                <label>Category Name</label>
                                                                <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ $item->name_category }}">
                                                                
                                                                @error('category_name')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Cost</label>
                                                                <input type="text" class="form-control @error('cost') is-invalid @enderror" id="cost" name="cost" value="{{ $item->cost }}">
                                                                
                                                                @error('cost')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Weight (in Kg)</label><br>
                                                                From
                                                                <input type="number" class="form-control @error('weight_from') is-invalid @enderror" id="weight_from" name="weight_from" value="{{ $item->weight_from }}">
                                                                @error('weight_from')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                                Until
                                                                <input type="number" class="form-control @error('weight_until') is-invalid @enderror" id="weight_until" name="weight_until" value="{{ $item->weight_until }}">
                                                                @error('weight_until')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
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
                                                        <span class="fw-light">Category</span>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                            <form action="{{ route('category.delete') }}" method="POST" enctype="multipart/form-data">
                                                @method('DELETE')
                                                @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Are You Sure Want to Delete {{ $item->name_category }} ?</label>
                                                                <input type="hidden" name="ctg_id" id="ctg_id" value="{{ $item->id }}">
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
        var table = $('#tableCategory').DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": true,
            "order":[],
        });
    });
</script>
@endsection