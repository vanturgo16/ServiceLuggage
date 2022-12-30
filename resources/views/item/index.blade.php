@extends('layouts.master')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Other Item</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('home') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('item.index') }}">Other Item</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Other Items</h4>
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
                                            <span class="fw-light">Item</span>
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Item Name</label>
                                                    <input type="text" class="form-control @error('item_name') is-invalid @enderror" id="item_name" name="item_name" value="{{ old('item_name') }}">
                                                    
                                                    @error('item_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Unit</label><br>
                                                    <select name="unit" class="form-control @error('unit') is-invalid @enderror" id="unit">
                                                        <option value="">-- Select Unit --</option>
                                                        <option value="Piece">Piece</option>
                                                        <option value="Set">Set</option>
                                                    </select>
                                                    @error('unit')
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
                                        <th>Item Name</th>
                                        <th>Unit</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->unit }}</td>
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
                                                        <span class="fw-light">Item</span>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                            <form action="{{ route('item.update') }}" method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input type="hidden" name="item_id" id="item_id" value="{{ $item->id }}">
                                                                <input type="text" class="form-control @error('item_name') is-invalid @enderror" id="item_name" name="item_name" value="{{ $item->item_name }}">
                                                    
                                                                @error('item_name')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Unit</label><br>
                                                                <select name="unit" class="form-control @error('unit') is-invalid @enderror" id="unit">
                                                                    <option value="">-- Select Unit --</option>
                                                                    <option value="Piece" @if($item->unit == 'Piece') selected @endif>Piece</option>
                                                                    <option value="Set" @if($item->unit == 'Set') selected @endif>Set</option>
                                                                </select>
                                                                @error('unit')
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
                                                        <span class="fw-light">Item</span>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                            <form action="{{ route('item.delete') }}" method="POST" enctype="multipart/form-data">
                                                @method('DELETE')
                                                @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Are You Sure Want to Delete {{ $item->item_name }} ?</label>
                                                                <input type="hidden" name="item_id" id="item_id" value="{{ $item->id }}">
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