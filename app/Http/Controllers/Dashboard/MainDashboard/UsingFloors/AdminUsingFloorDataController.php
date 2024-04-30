<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\UsingFloors;

use App\Models\UsingFloor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Traits\ExcelFileTrait;

class AdminUsingFloorDataController extends Controller
{
    use ExcelFileTrait;
    public function index()
    {
        $appLocale = app()->getLocale();
        $usingFloors =  UsingFloor::all();
        $filteredData = [];
        foreach ($usingFloors as $usingFloor) {
            $floor = $usingFloor->getTranslation('floor', $appLocale);
            $using = $usingFloor->getTranslation('using', $appLocale);
            $filteredData[] = [
                'id' => $usingFloor->id,
                'floor' => $floor,
                'using' => $using,
                'value' => $usingFloor->value,
            ];
        }
        return response()->json($filteredData);
    }

    public function store(request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xls,xlsx'
            ]);

            if (count(UsingFloor::all()) > 0) {
                $this->delete('usingFloorsExcelFile');
                UsingFloor::truncate();
            }

            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();

            foreach ($sheet->getRowIterator() as $row) {
                $rowData = [];
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }
                if ($row->getRowIndex() > 1) {
                    // if (array_filter($rowData, null) === []) {
                    //     $this->upload($file, 'usingFloorsExcelFile');
                    //     return response()->json(['message' => 'Data imported successfully']);
                    // } else {
                    $usingFloor = new UsingFloor();
                    $usingFloor
                        ->setTranslation('floor', 'en', $rowData[0])
                        ->setTranslation('floor', 'ar', $rowData[1])
                        ->setTranslation('using', 'en', $rowData[2])
                        ->setTranslation('using', 'ar', $rowData[3]);
                    $usingFloor->value = $rowData[4];
                    $usingFloor->save();
                    // }
                }
            }
            $this->upload($file, 'usingFloorsExcelFile');
            return response()->json(['message' => 'Data imported successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'something went wrong', 'errors' => $e->getMessage()]);
        }
    }

    public function downloadFile()
    {
        $file = $this->download('usingFloorsExcelFile');
        if ($file) {
            return response()->download($file);
        } else {
            return response()->json(['error' => 'No files found in the folder']);
        }
    }
}
