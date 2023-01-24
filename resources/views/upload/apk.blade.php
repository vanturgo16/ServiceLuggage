@extends('layouts.master')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Upload</h4>
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
                    <a href="{{ route('apk.index') }}">Upload APK</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form action="{{ route('apk.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Upload APK</h4>
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
                                    <li><strong>Data Process Failed !</strong></li>
                                    @foreach ($errors->all() as $error)
                                        <li><strong>{{ $error }}</strong></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif    
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {{-- <label>Choose File</label> --}}
                                        <input type="file" class="form-control-file @error('file') is-invalid @enderror" id="file" name="file">
                                    </div>

                                    @error('file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>      
                        </div>
                        <div class="card-action text-center">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection