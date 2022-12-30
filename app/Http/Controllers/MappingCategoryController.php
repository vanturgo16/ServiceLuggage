<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LuggageCategory;
use App\Models\MappingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MappingCategoryController extends Controller
{
    public function create($id_location)
    {
        $location=Location::where('id',$id_location)->first();

        $categories=MappingCategory::where('id_location',$id_location)
            ->select(
                'luggage_categories.*',
                'mapping_categories.cost'
            )
            ->leftJoin('luggage_categories','mapping_categories.id_category','luggage_categories.id')
            ->get();
        
        return view('mapping_category.create',compact('location','categories'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'cost' => 'required|numeric',
            'id_location' => 'required',
            'id_category' => 'required'
        ]);

        DB::beginTransaction();
        try {
            MappingCategory::where('id_location',$request->id_location)
            ->where('id_category',$request->id_category)
            ->update([
                'cost' => $request->cost
            ]);

            DB::commit();

            return redirect('/category-mapping/'.$request->id_location)->with('success','Succes Submit Mapping Category');
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/category-mapping/'.$request->id_location)->with('failed','Failed Submit Mapping Category');
        }
    }
}
