<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Storage;

trait ImageUploader{

  public function storeImage($image_file,$folder){

    $image_file->storeAs($folder,$image_file->hashName(),'uploads');
    return $image_file->hashName();
  }

  public function deleteImage($image_name,$folder){
    Storage::disk('uploads')->delete($folder.'/'.$image_name);
  }


  public function updateImage($image_file,$folder,$old_image_name){

      $this->deleteImage($old_image_name,$folder);
      return $this->storeImage($image_file,$folder);
  }


}
