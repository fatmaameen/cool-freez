<?php

namespace App\Traits;

trait ImageUploadTrait
{
    public function upload($image,$path){
        $image_name = time().'_'.$image->getClientOriginalName();
        $image->move(public_path($path), $image_name);
        return $path.'/'.$image_name;
    }

    public function remove($image){
        $imagePath = public_path($image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
            return true;
        }else{
            return false;
        }
    }
}
