<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\MappingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MappingItemController extends Controller
{
    public function create($id_location)
    {
        $location=Location::where('id',$id_location)->first();

        $items=MappingItem::where('id_location',$id_location)
            ->select(
                'items.*',
                'mapping_items.cost'
            )
            ->leftJoin('items','mapping_items.id_item','items.id')
            ->get();
        
        return view('mapping_item.create',compact('location','items'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'cost' => 'required|numeric',
            'id_location' => 'required',
            'id_item' => 'required'
        ]);

        DB::beginTransaction();
        try {
            MappingItem::where('id_location',$request->id_location)
            ->where('id_item',$request->id_item)
            ->update([
                'cost' => $request->cost
            ]);

            DB::commit();

            return redirect('/item-mapping/'.$request->id_location)->with('success','Succes Submit Mapping Item');
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/item-mapping/'.$request->id_location)->with('failed','Failed Submit Mapping Item');
        }
    }
}
