<?php
namespace Atsargų_likučiai\Http\Controllers;

use Atsargų_likučiai\Record;
use Atsargų_likučiai\RecordsExport;
use Atsargų_likučiai\InvoicesExport;

use Atsargų_likučiai\RecordTest;
use Atsargų_likučiai\Skyriai;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

function export()
{
return Excel::download(new RecordsExport, 'users.xlsx');
}

}
?>