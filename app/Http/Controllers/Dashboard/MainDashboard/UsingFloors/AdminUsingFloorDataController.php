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
        return view('MainDashboard.floors.floors_list' ,compact('filteredData'));
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
                    if (array_filter($rowData, null) === []) {
                        $this->upload($file, 'usingFloorsExcelFile');
                        // return response()->json(['message' => 'Data imported successfully']);
                        $notification = array(
                            'message' => trans('main_trans.adding'),
                            'alert-type' => 'success'
                            );
                              return redirect()->back()->with($notification);
                    } else {
                    $usingFloor = new UsingFloor();
                    $usingFloor
                        ->setTranslation('floor', 'en', $rowData[0])
                        ->setTranslation('floor', 'ar', $rowData[1])
                        ->setTranslation('using', 'en', $rowData[2])
                        ->setTranslation('using', 'ar', $rowData[3]);
                    $usingFloor->value = $rowData[4];
                    $usingFloor->save();
                    }
                }
            }
            $this->upload($file, 'usingFloorsExcelFile');
            $notification = array(
                'message' => trans('main_trans.adding'),
                'alert-type' => 'success'
                );
                  return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // return redirect()->back()->with(['message' => 'something went wrong', 'errors' => $e->getMessage()]);
            $notification = array(
                'message' => trans('main_trans.something_error'),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function downloadFile()
    {
        $file = $this->download('usingFloorsExcelFile');
        if ($file) {
            return response()->download($file);
        } else {
            // return redirect()->back()->with(['error' => 'No files found in the folder']);
            $notification = array(
                'message' => trans('main_trans.no_files'),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
