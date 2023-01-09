<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function indexOrder()
    {
        return view('report.order.index');
    }

    public function submitReportOrder(Request $request)
    {
        //return view('report.order.show_detail');
        //dd($request->all());
        $request->validate([
            "report_type" => "required",
            "order_status" => "required",
            "filter_date" => "required",
            "date_start" => "required|date",
            "date_finish" => "required|date|after_or_equal:date_start"
        ]);

        $date_start=$request->date_start;
        $date_finish=$request->date_finish;

        if($request->report_type=='summary'){
            $query=Order::orderBY('id','asc')
                ->select(
                    'orders.*',
                    'users.name',
                    'locations.loc_name',
                    'banks.bank_name',
                )
                ->leftJoin('users','orders.id_user','users.id')
                ->leftJoin('locations','orders.id_location','locations.id')
                ->leftJoin('banks','orders.payment_by','banks.id');

            if($request->order_status != 'all'){
                $orders=$query->where('orders.order_status',$request->order_status);
            }
            
            $orders=$query->whereBetween(DB::raw("(STR_TO_DATE(orders.created_at,'%Y-%m-%d'))"), [$date_start, $date_finish])
            ->get();

            return view('report.order.show',compact('orders'));
        }
        elseif($request->report_type=='detail'){
            $query=DetailOrder::orderBY('id_order','asc')
                ->select(
                    'orders.*',
                    'users.name',
                    'locations.loc_name',
                    'banks.bank_name',
                    'items.item_name',
                    'detail_orders.weight',
                    'detail_orders.item_qty',
                    'detail_orders.item_cost',
                    'detail_orders.total',
                )
                ->leftJoin('items','items.id','detail_orders.id_item')
                ->leftJoin('orders','orders.id','detail_orders.id_order')
                ->leftJoin('users','orders.id_user','users.id')
                ->leftJoin('locations','orders.id_location','locations.id')
                ->leftJoin('banks','orders.payment_by','banks.id');

            if($request->order_status != 'all'){
                $orders=$query->where('orders.order_status',$request->order_status);
            }

            $orders=$query->whereBetween(DB::raw("(STR_TO_DATE(orders.created_at,'%Y-%m-%d'))"), [$date_start, $date_finish])
            ->get();

            //dd($orders);

            return view('report.order.show_detail',compact('orders'));
        }
    }
}
