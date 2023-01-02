<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::orderBy('bank_name','asc')->get();
        return view('bank.index',compact('banks'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            "bank_name" => "required",
            "branch" => "required",
            "type" => "required",
            "account_name" => "required",
            "account_number" => "required",
        ]);
        
        DB::beginTransaction();
        try {
            $categoryStore=Bank::create([
                'bank_name' => $request->bank_name,
                'branch' => $request->branch,
                'type' => $request->type,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
            ]);

            DB::commit();

            return redirect('/bank')->with('success','Succes Add Data Bank '.$request->bank_name);
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/bank')->with('failed','Failed Add Data Bank '.$request->bank_name);
        } 
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            "bank_name" => "required",
            "branch" => "required",
            "type" => "required",
            "account_name" => "required",
            "account_number" => "required",
        ]);
        
        DB::beginTransaction();
        try {
            Bank::where('id',$request->bank_id)
            ->update([
                'bank_name' => $request->bank_name,
                'branch' => $request->branch,
                'type' => $request->type,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
            ]);

            DB::commit();

            return redirect('/bank')->with('success','Succes Update Data Bank'.$request->bank_name);
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/bank')->with('failed','Failed Update Data Bank'.$request->bank_name);
        } 
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            Bank::where('id',$request->bank_id)->delete();

            DB::commit();

            return redirect('/bank')->with('success','Succes Delete Data Bank');
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/bank')->with('failed','Failed Delete Data Bank');
        }
    }
}
