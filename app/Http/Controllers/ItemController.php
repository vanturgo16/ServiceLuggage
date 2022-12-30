<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Location;
use App\Models\MappingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::get();
        return view('item.index',compact('items'));
    }
    
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'item_name' => 'required',
            'unit' => 'required'
        ]);
        
        DB::beginTransaction();
        try {
            $itemStore=Item::create([
                'item_name' => $request->item_name,
                'unit' => $request->unit
            ]);

            //select location untuk di insert ke mapping Item
            $locations=Location::get();
            foreach ($locations as $location) {
                MappingItem::create([
                    'id_location' => $location->id,
                    'id_item' => $itemStore->id
                ]);
            }

            DB::commit();

            return redirect('/item')->with('success','Succes Add Data Item '.$request->item_name);
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/item')->with('failed','Failed Add Data Item '.$request->item_name);
        } 
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'item_name' => 'required',
            'unit' => 'required'
        ]);
        
        DB::beginTransaction();
        try {
            Item::where('id',$request->item_id)
            ->update([
                'item_name' => $request->item_name,
                'unit' => $request->unit
            ]);

            DB::commit();

            return redirect('/item')->with('success','Succes Update Data Item '.$request->item_name);
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/item')->with('failed','Failed Update Data Item '.$request->item_name);
        } 
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            Item::where('id',$request->item_id)->delete();
            MappingItem::where('id_item',$request->item_id)->delete();

            DB::commit();

            return redirect('/item')->with('success','Succes Delete Data Item');
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/item')->with('failed','Failed Delete Data Item');
        }
    }
}
