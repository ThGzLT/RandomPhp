<?php
namespace Atsargų_likučiai\Http\Controllers;

use Atsargų_likučiai\Record;
use Atsargų_likučiai\RecordsExport;
use Atsargų_likučiai\RecordTest;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
class PdfController extends Controller
{

    public function export_PDF()
    {
        // Fetch all customers from database
        $records = Record::get();
        $kopijos = RecordTest::all();
        // Send data to the view using loadView function of PDF facade
        // $pdf = PDF::loadHTML(' <h1>Test</h1>', compact('records'));

        $pdf = PDF::loadview('prasitestavimas', compact('records', 'kopijos'));

        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('customers.pdf');
    }

    public function pdfview(Request $request)
    {
        $records = Record::get();
        $kopijos = RecordTest::all();

        if($request->has('download')) {
            // pass view file
            $pdf = PDF::loadview('LenteleSpausdinimui', compact('records', 'kopijos'));
            // download pdf
            return $pdf->download('userlist.pdf');
        }
        return view('pdfview');
    }
}