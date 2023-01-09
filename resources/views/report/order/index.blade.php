@extends('layouts.master')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Report</h4>
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
                    <a href="{{ route('report.order.index') }}">Report Order</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form action="{{ route('report.order.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Report Order</h4>
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
                                Data Process Failed !
                            </div>
                            @endif    
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="defaultSelect">Report Type</label>
                                        <select class="form-control form-control @error('report_type') is-invalid @enderror" id="report_type" name="report_type">
                                            <option value="">-Choose Report Order Type-</option>
                                            <option value="detail" @if (old('report_type')=='detail') selected @endif>Detail Order</option>
                                            <option value="summary" @if (old('report_type')=='summary') selected @endif>Summary Order</option>
                                        </select>

                                        @error('report_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="defaultSelect">Order Status</label>
                                        <select class="form-control form-control @error('order_status') is-invalid @enderror" id="order_status" name="order_status">
                                            <option value="">-Choose Order Status-</option>
                                            <option value="all" @if (old('order_status')=='all') selected @endif>All</option>
                                            <option value="opened" @if (old('order_status')=='opened') selected @endif>Opened</option>
                                            <option value="waiting payment" @if (old('order_status')=='waiting payment') selected @endif>Waiting Payment</option>
                                            <option value="paid" @if (old('order_status')=='paid') selected @endif>Paid</option>
                                        </select>

                                        @error('order_status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="defaultSelect">Filter By Date</label>
                                        <select class="form-control form-control @error('filter_date') is-invalid @enderror" id="filter_date" name="filter_date">
                                            <option value="">-Choose Filtered By Date-</option>
                                            <option value="created date" @if (old('filter_date')=='created date') selected @endif>Order Created Date</option>
                                        </select>

                                        @error('filter_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>From</label>
                                        <input type="date" class="form-control @error('date_start') is-invalid @enderror" id="date_start" name="date_start" value="{{ old('date_start') }}">
                                        
                                        @error('date_start')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Until</label>
                                        <input type="date" class="form-control @error('date_finish') is-invalid @enderror" id="date_finish" name="date_finish" value="{{ old('date_finish') }}">
                                        
                                        @error('date_finish')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
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
<script >
    $(document).ready(function() {
        var table = $('#tableReportOrder').DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": true,
            "order":[],
        });
    });
</script>
@endsection