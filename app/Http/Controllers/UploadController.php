<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload.apk');
    }

    public function uploadApk(Request $request)
    {
        // dd($request->file->getMimeType());
        $rules = [
            "file" => "required|mimes:zip"
        ];
    
        $customMessages = [
            'file.mimes' => 'The file must be a file of type: apk.'
        ];
    
        $this->validate($request, $rules, $customMessages);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $mimeType = $file->getClientOriginalExtension();
            $filename = 'Installer.'.$mimeType;
            //dd($filename);
            $upload = $file->move('storage/document', $filename);

            if($upload){
                return redirect('/apk')->with('success','Upload File Success');
            }
            else{
                return redirect('/apk')->with('success','Upload File Failed');
            }
        }
    }
}
