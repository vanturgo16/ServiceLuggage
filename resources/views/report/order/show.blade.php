@extends('layouts.master')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">View Report Order</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Order</h4>
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
                            <table id="tableOrder" class="display table table-hover" >
                                <thead>
                                    <tr>
                                        <th>Order No</th>
                                        <th>Created At</th>
                                        <th>Customer</th>
                                        <th>Location</th>
                                        <th>Date Start Deposit</th>
                                        <th>Date Finish Deposit</th>
                                        <th>Days</th>
                                        <th>Subtotal</th>
                                        <th>Discount</th>
                                        <th>Grand Total</th>
                                        <th>Order Status</th>
                                        <th>Deposit Status</th>
                                        <th>Paid at</th>
                                        <th>Payment By</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_no }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->loc_name }}</td>
                                        <td>{{ $order->date_start }}</td>
                                        <td>{{ $order->date_finish }}</td>
                                        <td>{{ $order->day_count }}</td>
                                        <td>{{ $order->subtotal }}</td>
                                        <td>{{ $order->discount }}</td>
                                        <td>{{ $order->grandtotal }}</td>
                                        <td>{{ $order->order_status }}</td>
                                        <td>{{ $order->rent_status }}</td>
                                        <td>{{ $order->paid_at }}</td>
                                        <td>{{ $order->bank_name }}</td>
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
        var table = $('#tableOrder').DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": true,
            "order":[],
            "dom": 'Bfrtip',
            "buttons": [{
                title: 'List Order', 
                text: '<i class="fas fa-file-excel"></i> Export to Excel', 
                extend: 'excel' 
            },{
                title: 'List Order', 
                text: '<i class="fas fa-file-pdf"></i> Export to PDF', 
                extend: 'pdf',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }]
        });
    });
</script>
@endsection