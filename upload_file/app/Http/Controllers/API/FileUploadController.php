<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class FileUploadController extends Controller
{
    public function upload(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }
        if($file = $request->file('file')){

            $path = 'upload/';
            $name = $file->getClientOriginalName();
            $name_file = current(explode('.',$name));
            $new_file = $name_file.'.'.$file->getClientOriginalExtension();
            $file -> move($path,$new_file);
            $path_file = 'public/upload/'.$new_file;

            // $path = $file->store('public/upload');
            // $name = $file->getClientOriginalName();

            $files = new File();
            $files->name = $name;
            $files->path = $path_file;
            $files->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        //    $files->save();

            return response()->json([
                "message" => "File successfully uploaded",
                "name" => $name,
                "file" => $path_file,
            ]);
        }
    }
}
