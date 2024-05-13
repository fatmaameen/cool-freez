<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\DataSheet;

use App\Models\DataSheet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\type;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Traits\ExcelFileTrait;

class AdminDataSheetController extends Controller
{
    use ExcelFileTrait;
    public function index()
    {
        $dataSheet = DataSheet::paginate(10);
        return view('MainDashboard.dataSheet.dataSheet', compact('dataSheet'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xls,xlsx'
            ]);

            if (count(DataSheet::all()) > 0) {
                DataSheet::truncate();
            }
            $brands = self::getBrands();
            $types = self::getTypes();
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
                        $this->delete('DataSheetExcelFile');
                        $this->upload($file, 'DataSheetExcelFile');
                        $notification = array(
                            'message' => trans('main_trans.adding'),
                          'alert-type' => 'success'
                            );
                              return redirect()->back()->with($notification);
                    } elseif (!in_array(strtolower($rowData[0]), $brands) || !in_array(strtolower($rowData[1]), $types)) {
                        if ($this->restore()) {
                            return redirect()->back()->withErrors(['errors' => __('main_trans.brand_or_type_not_found')]);
                        } else {
                            return redirect()->back()->withErrors(['errors' => __('main_trans.upload_valid_file')]);
                        }
                    } else {
                        DataSheet::create([
                            'brand' => strtolower($rowData[0]),
                            'type' => strtolower($rowData[1]),
                            'model' => strtolower($rowData[2]),
                            'btu' => $rowData[3],
                            'cfm' => $rowData[4],
                            'gas' => strtolower($rowData[5]),
                            'made_in' => strtolower($rowData[6]),
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['errors' => 'something went wrong' . $e->getMessage()]);
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
        $models = DataSheet::where('model', 'LIKE', '%' . strtolower($search) . '%')
            ->orWhere('brand', 'LIKE', '%' . strtolower($search) . '%')->get();
        if ($models) {
            return redirect()->back()->with($$models);
        } else {
            return redirect()->back()->with(['Message' => "No Data Found"]);
        }
    }

    private static function getBrands()
    {
        $brands = brand::all();
        $bransData = [];
        foreach ($brands as $brand) {
            $brand = $brand->getTranslation('brand', 'en');
            $bransData[] = $brand;
        }
        return $bransData;
    }

    private static function getTypes()
    {
        $types = type::all();
        $typesData = [];
        foreach ($types as $type) {
            $type = $type->getTranslation('type', 'en');
            $typesData[] = $type;
        }
        return $typesData;
    }

    public function restore()
    {
        try {
            if (count(DataSheet::all()) > 0) {
                DataSheet::truncate();
            }
            $file = $this->find('DataSheetExcelFile');
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();
            foreach ($sheet->getRowIterator() as $row) {
                $rowData = [];
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }
                if ($row->getRowIndex() > 1) {
                    if (array_filter($rowData, null) === []) {
                        return true;
                    } else {
                        DataSheet::create([
                            'brand' => strtolower($rowData[0]),
                            'type' => strtolower($rowData[1]),
                            'model' => strtolower($rowData[2]),
                            'btu' => $rowData[3],
                            'cfm' => $rowData[4],
                            'gas' => strtolower($rowData[5]),
                            'made_in' => strtolower($rowData[6]),
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
