<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\baseController as APIBaseController;
use App\Http\Controllers\Controller;
use App\Mail\verifiedUserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class apiController extends APIBaseController
{
    public function login(Request $request)
    {
        //dd('hai');

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $auth=Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if($auth){
            $token='PB'.$request->email;
            $user = Auth::user(); 
            $success['token'] =  $user->createToken($token) -> accessToken; 
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'Authentication Successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'phone' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $password = Hash::make($request->password);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'phone' => $request->phone,
            'role' => 'User',
        ]);

        $success['name'] =  $user->name;
        //$url = 'http://127.0.0.1:8000/verified-user/'.encrypt($user->id);
        $url = 'https://penitipan.gotrain.id/verified-user/'.encrypt($user->id);

        $details = [
            'user_name' => $user->name,
            'url' => $url
        ];

        $recipient=$request->email;
        //$recipient='vanturgo16@gmail.com';

        Mail::to($recipient)
        ->send(new verifiedUserMail($details));
   
        return $this->sendResponse($success, 'User register successfully.');
    }
}
