<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;
class FileUploadService
{
public function  download($data){

    if($data->hasFile('file')){

        $imgExtension = $data->file->getClientOriginalExtension();
        $fileName = time() . "-" . uniqid() . '.' . $imgExtension;
        $data->file->move(public_path('upload'),$fileName);

      return $fileName;
    };
  return   false;
}




public function image_destroy($id,$model)
{
  $model->where('id',$id)->delete();
    return redirect()->back()->with('success','Şəkil silindi');
}
}
