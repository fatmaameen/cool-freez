<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;

trait PDFUploadTrait
{
    protected $appUrl;

    public function __construct()
    {
        $this->appUrl = Config::get('app.url');
    }
    public function uploadPDF($pdf_array, $path)
    {
        $pdf_names = [];
        foreach ($pdf_array as $pdf) {
            $pdf_name = time() . '_' . $pdf->getClientOriginalName();
            $pdf->move(public_path($path), $pdf_name);
            $pdf_names[] = $this->appUrl.'/'.$path.'/'.$pdf_name;
        }
        return $pdf_names;
    }

    public function removePDF($pdf_array, $path)
    {
        $pdf_array = json_decode($pdf_array, true);
        if (!empty($pdf_array)) {
            foreach ($pdf_array as $pdf) {
                $pdf = str_replace($this->appUrl, '', $pdf);
                $pdf_path = public_path($pdf);
                if (file_exists($pdf_path)) {
                    unlink($pdf_path);
                }
            }
            return true;
        }else {
            return false;
        }
    }
}
