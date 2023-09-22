<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{
    public function uploadFile($request,$name,$folder)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs($folder.'/'.$request->title,$file_name,'upload_attachments');

    }

    public function deleteFile($name)
    {
        $exists = Storage::disk('upload_attachments')->exists('library/'.$name);



        if($exists)
        {
            Storage::disk('upload_attachments')->delete('library/'.$name);

        }
    }
}
