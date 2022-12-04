<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::orderBy('id','desc')->get();
        return view('location.index',compact('locations'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'location_code' => 'required',
            'location_name' => 'required',
            'address' => 'required',
            'coordinate' => 'required',
            'location_photo' => 'required',
        ]);
        
        DB::beginTransaction();
        try {
            if($request->file('location_photo')){
                $photo=base64_encode(file_get_contents($request->file('location_photo')));
            }
            else{
                $photo="";
            }

            $ipAddress=$_SERVER['REMOTE_ADDR'];

            $locationStore=Location::create([
                'code' => $request->location_code,
                'loc_name' => $request->location_name,
                'loc_address' => $request->address,
                'coordinate' => $request->coordinate,
                'notes' => $request->notes,
                'loc_photo' => $photo,
                'ip_address' => $ipAddress,
            ]);

            DB::commit();

            return redirect('/location')->with('success','Succes Submit Data Location '.$request->location_name);
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/location')->with('failed','Failed Submit Data Location '.$request->location_name);
        }
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'location_code' => 'required',
            'location_name' => 'required',
            'address' => 'required',
            'coordinate' => 'required'
        ]);
        
        DB::beginTransaction();
        try {
            if($request->file('location_photo')){
                $photo=base64_encode(file_get_contents($request->file('location_photo')));
            }
            else{
                $photo="";
            }

            $ipAddress=$_SERVER['REMOTE_ADDR'];

            $locationStore=Location::where('id',$request->loc_id)
            ->update([
                'code' => $request->location_code,
                'loc_name' => $request->location_name,
                'loc_address' => $request->address,
                'coordinate' => $request->coordinate,
                'notes' => $request->notes,
                'loc_photo' => $photo,
                'ip_address' => $ipAddress
            ]);

            DB::commit();

            return redirect('/location')->with('success','Succes Update Data Location '.$request->location_name);
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/location')->with('failed','Failed Update Data Location '.$request->location_name);
        } 
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            if($request->file('location_photo')){
                $photo=base64_encode(file_get_contents($request->file('location_photo')));
            }
            else{
                $photo="";
            }

            $locationStore=Location::where('id',$request->loc_id)->delete();

            DB::commit();

            return redirect('/location')->with('success','Succes Delete Data Location');
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/location')->with('failed','Failed Delete Data Location');
        }
    }
}
