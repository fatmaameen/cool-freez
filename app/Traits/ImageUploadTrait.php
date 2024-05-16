<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;

trait ImageUploadTrait
{
    protected $appUrl;

    public function __construct()
    {
        $this->appUrl = Config::get('app.url');
    }
    public function upload($image,$path){
        $image_name = time().'_'.$image->getClientOriginalName();
        $image->move(public_path($path), $image_name);
        return $this->appUrl.'/'.$path.'/'.$image_name;
    }
    
    public function remove($image){
        $image = str_replace($this->appUrl, '', $image);
        $imagePath = public_path($image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
            return true;
        }else{
            return false;
        }
    }


}
