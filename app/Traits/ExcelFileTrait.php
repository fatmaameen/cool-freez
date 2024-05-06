<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait ExcelFileTrait
{
    public function download($folderName)
    {
        $folderPath = public_path($folderName);
        $files = File::files($folderPath);
        if (!empty($files)) {
            $filePath = $files[0];
            return $filePath;
        } else {
            return false;
        }
    }

        public function find($folderName)
    {
        $folderPath = public_path($folderName);
        $files = File::files($folderPath);
        if (!empty($files)) {
            $filePath = $files[0];
            return $filePath;
        } else {
            return false;
        }
    }

    public function upload($file, $folderName)
    {
        $fileName = $file->getClientOriginalName();
        $file->move(public_path($folderName), $fileName);
        return true;
    }

    public function delete($folderName)
    {
        $folderPath = public_path($folderName);
        if (File::isDirectory($folderPath)) {
            $files = File::files($folderPath);
            foreach ($files as $file) {
                File::delete($file);
            }
            return true;
        }
        return false;
    }
}
