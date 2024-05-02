<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\DataSheet;

use App\Models\DataSheet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Traits\ExcelFileTrait;

class AdminDataSheetController extends Controller
{
    use ExcelFileTrait;
    public function index()
    {
        $dataSheet = DataSheet::paginate(10);
        return view('MainDashboard.dataSheet.dataSheet' ,compact('dataSheet'));

    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xls,xlsx'
            ]);

            if (count(DataSheet::all()) > 0) {
                $this->delete('DataSheetExcelFile');
                DataSheet::truncate();
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
                        $this->upload($file, 'DataSheetExcelFile');
                        return redirect()->back()->with(['message' => 'Data imported successfully']);
                    } else {
                        DataSheet::create([
                            'brand' => $rowData[0],
                            'type' => $rowData[1],
                            'model' => $rowData[2],
                            'btu' => $rowData[3],
                            'cfm' => $rowData[4],
                            'gas' => $rowData[5],
                            'made_in' => $rowData[6],
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'something went wrong' . $e->getMessage()]);
        }
    }

    public function downloadFile()
    {
        $file = $this->download('DataSheetExcelFile');
        if ($file) {
            return response()->download($file);
        } else {
            return redirect()->back()->with(['error' => 'No files found in the folder']);
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => ['required', 'string'],
        ]);
        $search = $request->search;
        $models = DataSheet::where('model', 'LIKE', '%' . $search . '%')
            ->orWhere('brand', 'LIKE', '%' . $search . '%')->get();
        if ($models) {
            return redirect()->back()->with($$models);
        } else {
            return redirect()->back()->with(['Message' => "No Data Found"]);
        }
    }
}
