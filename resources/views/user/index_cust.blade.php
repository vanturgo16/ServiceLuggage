@extends('layouts.master')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">User Customer</h4>
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
                    <a href="{{ route('user.indexCust') }}">User</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of User</h4>
                            {{-- <button class="btn btn-primary btn-round ml-auto btn-sm" data-toggle="modal" data-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Add User
                            </button> --}}
                        </div>
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <h4 class="modal-title">
                                            <span class="fw-mediumbold">Add</span> 
                                            <span class="fw-light">User</span>
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name" name="user_name" value="{{ old('user_name') }}">
                                                    
                                                    @error('user_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control @error('user_email') is-invalid @enderror" id="user_email" name="user_email" value="{{ old('user_email') }}">
                                                    
                                                    @error('user_email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                                    
                                                    @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control @error('user_password') is-invalid @enderror" id="user_password" name="user_password" value="{{ old('user_password') }}">
                                                    
                                                    @error('user_password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password" value="{{ old('confirm_password') }}">
                                                    
                                                    @error('confirm_password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="defaultSelect">Role</label>
                                                    <select name="user_role" class="form-control @error('user_role') is-invalid @enderror" id="user_role">
                                                        <option value="">-- Select Role --</option>
                                                        <option value="Super Admin">Super Admin</option>
                                                        <option value="Administrator">Administrator</option>
                                                        <option value="Operator">Operator</option>
                                                    </select>

                                                    @error('user_role')
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Verified At</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>{{ $item->email_verified_at }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                {{-- <button class="btn btn-warning btn-round ml-auto btn-sm" data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                                    <i class="fa fa-edit"></i>
                                                    Edit Profile
                                                </button>
                                                <button class="btn btn-warning btn-round ml-1 btn-sm" data-toggle="modal" data-target="#editPassModal{{ $item->id }}">
                                                    <i class="fa fa-edit"></i>
                                                    Reset Password
                                                </button>
                                                <button class="btn btn-danger btn-round ml-1 btn-sm" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                    Delete
                                                </button> --}}
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- Modal Edit Profile--}}
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h4 class="modal-title">
                                                        <span class="fw-mediumbold">Update</span> 
                                                        <span class="fw-light">Profile</span>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                            <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <input type="hidden" name="usr_id" id="usr_id" value="{{ $item->id }}">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name" name="user_name" value="{{ $item->name }}">
                                                            
                                                            @error('user_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" class="form-control @error('user_email') is-invalid @enderror" id="user_email" name="user_email" value="{{ $item->email }}">
                                                            
                                                            @error('user_email')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $item->phone }}">
                                                            
                                                            @error('phone')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="defaultSelect">Role</label>
                                                            <select name="user_role" class="form-control @error('user_role') is-invalid @enderror" id="user_role">
                                                                <option value="">-- Select Role --</option>
                                                                <option value="Super Admin" @if($item->role == 'Super Admin') selected @endif>Super Admin</option>
                                                                <option value="Administrator" @if($item->role == 'Administrator') selected @endif>Administrator</option>
                                                                <option value="Operator" @if($item->role == 'Operator') selected @endif>Operator</option>
                                                            </select>
        
                                                            @error('user_role')
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

                                    {{-- Modal Edit Password--}}
                                    <div class="modal fade" id="editPassModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header no-bd">
                                                    <h4 class="modal-title">
                                                        <span class="fw-mediumbold">Reset</span> 
                                                        <span class="fw-light">Password</span>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                            <form action="{{ route('user.update.password') }}" method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <input type="hidden" name="usr_id" id="usr_id" value="{{ $item->id }}">
                                                            <label>Password</label>
                                                            <input type="password" class="form-control @error('user_password') is-invalid @enderror" id="user_password" name="user_password" value="{{ old('user_password') }}">
                                                            
                                                            @error('user_password')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Confirm Password</label>
                                                            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password" value="{{ old('confirm_password') }}">
                                                            
                                                            @error('confirm_password')
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
                                                        <span class="fw-light">User</span>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                            <form action="{{ route('user.delete') }}" method="POST" enctype="multipart/form-data">
                                                @method('DELETE')
                                                @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Are You Sure Want to Delete {{ $item->name }} ?</label>
                                                                <input type="hidden" name="usr_id" id="usr_id" value="{{ $item->id }}">
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