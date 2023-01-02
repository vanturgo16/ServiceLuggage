<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Location;
use App\Models\MappingBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MappingBankController extends Controller
{
    public function create($id_location)
    {
        $location=Location::where('id',$id_location)->first();

        $banks=MappingBank::where('id_location',$id_location)
            ->select(
                'mapping_banks.*',
                'banks.bank_name',
                'banks.type',
                'banks.account_name',
                'banks.account_number'
            )
            ->leftJoin('banks','mapping_banks.id_bank','banks.id')
            ->get();
        
        $bankInfos=Bank::orderBY('bank_name','asc')->get();
        
        return view('mapping_bank.create',compact('location','banks','bankInfos'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'id_location' => 'required',
            'bank' => 'required'
        ]);

        //cek dulu sudah ada atau belum
        $cekBank=MappingBank::where('id_location',$request->id_location)
        ->where('id_bank',$request->bank)
        ->count();

        //jika belum ada simpan
        if($cekBank == '0'){
            DB::beginTransaction();
            try {
                $storeMappingBank=MappingBank::create([
                    'id_location' => $request->id_location,
                    'id_bank' => $request->bank
                ]);
                DB::commit();
                return redirect('/bank-mapping/'.$request->id_location)->with('success','Success Add Bank');
            }
            catch (\Throwable $e) {
                DB::rollback();
                return redirect('/bank-mapping/'.$request->id_location)->with('failed','Failed Add Bank');
            }
        }
        else{
            return redirect('/bank-mapping/'.$request->id_location)->with('failed','Bank Already Exist in This Location');
        }
    }

    public function delete(Request $request)
    {
        //dd($request->all());

        DB::beginTransaction();
        try {
            MappingBank::where('id_bank',$request->id_bank)
            ->where('id_location',$request->id_location)
            ->delete();

            DB::commit();

            return redirect('/bank-mapping/'.$request->id_location)->with('success','Success Delete Bank');
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/bank-mapping/'.$request->id_location)->with('faled','Failed Delete Bank');
        }
    }
}
