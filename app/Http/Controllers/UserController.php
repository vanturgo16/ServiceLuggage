<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users=User::where('role','<>','User')->get();
        return view('user.index',compact('users'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'user_name' => 'required',
            'user_email' => 'required',
            'user_password' => 'required',
            'confirm_password' => 'required|same:user_password',
            'user_role' => 'required',
            'phone' => 'required',
        ]);

        DB::beginTransaction();
        try {
            User::create([
                'name' => $request->user_name,
                'email' => $request->user_email,
                'password' => Hash::make($request->user_password),
                'phone' => $request->phone,
                'role' => $request->user_role,
            ]);
            DB::commit();
            // all good

            return redirect('/user')->with('success','Succes Add User '.$request->user_name);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect('/user')->with('failed','Failed Add User '.$request->user_name);
        }
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'user_name' => 'required',
            'user_email' => 'required',
            'user_role' => 'required',
            'phone' => 'required',
        ]);

        DB::beginTransaction();
        try {
            User::where('id',$request->usr_id)
            ->update([
                'name' => $request->user_name,
                'email' => $request->user_email,
                'password' => Hash::make($request->user_password),
                'phone' => $request->phone,
                'role' => $request->user_role,
            ]);
            DB::commit();
            // all good

            return redirect('/user')->with('success','Succes Add User '.$request->user_name);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect('/user')->with('failed','Failed Add User '.$request->user_name);
        }
    }

    public function updatePassword(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'user_password' => 'required',
            'confirm_password' => 'required|same:user_password'
        ]);

        DB::beginTransaction();
        try {
            User::where('id',$request->usr_id)
            ->update([
                'password' => Hash::make($request->user_password)
            ]);
            DB::commit();
            // all good

            return redirect('/user')->with('success','Succes Reset Password');
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect('/user')->with('failed','Failed Reset Password');
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            User::where('id',$request->usr_id)->delete();

            DB::commit();

            return redirect('/user')->with('success','Succes Delete Data User');
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect('/user')->with('failed','Failed Delete Data User');
        }
    }

    public function indexCust()
    {
        $users=User::where('role','User')->get();
        return view('user.index_cust',compact('users'));
    }

    public function verifiedUser($id)
    {
        $id = decrypt($id);

        //cek sudah verified atau belum
        $cekVerif=User::where('id',$id)->first();
        if($cekVerif->email_verified_at == ''){
            $now=Carbon::now();
            DB::beginTransaction();
            try {
                User::where('id',$id)->update([
                    'email_verified_at' => $now
                ]);

                DB::commit();

                $message = 'Success Verified Your Account';
                return view('verified.index',compact('message'));
            }
            catch (\Throwable $e) {
                DB::rollback();

                $message = 'Failed Verified Your Account';
                return redirect('verified.index',compact('message'));
            }
        }
        else{
            $message = 'Your Account Already Verified';
            return view('verified.index',compact('message'));
        }
    }
}
