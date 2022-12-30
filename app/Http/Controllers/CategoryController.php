<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LuggageCategory;
use App\Models\MappingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = LuggageCategory::get();
        return view('category.index',compact('categories'));
    }
    
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'category_name' => 'required',
            'weight_from' => 'required|lt:weight_until',
            'weight_until' => 'required'
        ]);
        
        DB::beginTransaction();
        try {
            $categoryStore=LuggageCategory::create([
                'name_category' => $request->category_name,
                'weight_from' => $request->weight_from,
                'weight_until' => $request->weight_until,
                'unit' => 'Kgs',
            ]);

            //select location untuk di insert ke mapping category
            $locations=Location::get();
            foreach ($locations as $location) {
                MappingCategory::create([
                    'id_location' => $location->id,
                    'id_category' => $categoryStore->id
                ]);
            }

            DB::commit();

            return redirect('/category')->with('success','Succes Add Data Category '.$request->category_name);
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/category')->with('failed','Failed Add Data Category '.$request->category_name);
        } 
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'category_name' => 'required',
            'weight_from' => 'required|lt:weight_until',
            'weight_until' => 'required'
        ]);
        
        DB::beginTransaction();
        try {
            LuggageCategory::where('id',$request->ctg_id)
            ->update([
                'name_category' => $request->category_name,
                'weight_from' => $request->weight_from,
                'weight_until' => $request->weight_until,
                'unit' => 'Kgs',
            ]);

            DB::commit();

            return redirect('/category')->with('success','Succes Update Data Category '.$request->category_name);
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/category')->with('failed','Failed Update Data Category '.$request->category_name);
        } 
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            LuggageCategory::where('id',$request->ctg_id)->delete();
            MappingCategory::where('id_category',$request->ctg_id)->delete();

            DB::commit();

            return redirect('/category')->with('success','Succes Delete Data Category');
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/category')->with('failed','Failed Delete Data Category');
        }
    }
}
