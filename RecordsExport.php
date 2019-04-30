<?php
namespace Atsargų_likučiai;
use Atsargų_likučiai\Record;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;

date_default_timezone_set('Etc/GMT-3');


class RecordsExport implements FromView, WithHeadings, WithEvents, WithMapping

{
    public function view(): View
    {
        return view('LenteleSpausdinimui', [
            'kopijos' => RecordTest::all()
        ]);
    }

    public function headings(): array
{
return [

'Produkto kodas',
'Produktas',
'Matas',
'Kiekis',
    'Aprasymas'
];
}


    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers



                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14)->getActiveSheet()->insertNewRowBefore(1, 5)
                    ->mergeCells('A1:C1')
                    ->getCell('A1')
                    ->setValue('VšĮ KLAIPĖDOS UNIVERSITETINĖ LIGONINĖ');

                $event->sheet->getDelegate()
                    ->getStyle('A2:G2')->getAlignment()->setHorizontal('center')
                    ->getActiveSheet()
                    ->mergeCells('A2:G2')
                    ->getCell('A2')
                    ->setValue("INŽINIERINIS TECHNIKOS DEPARTAMENTAS");

                $event->sheet->getDelegate()
                    ->getStyle('A3:G3')->getAlignment()->setHorizontal('center')
                    ->getActiveSheet()
                    ->mergeCells('A3:G3')
                    ->getCell('A3')
                    ->setValue("SKYRIUS");

                $event->sheet->getDelegate()
                    ->getStyle('A4:G4')->getAlignment()->setHorizontal('center')
                    ->getActiveSheet()
                    ->mergeCells('A4:G4')
                    ->getCell('A4')
                    ->setValue("MEDŽIAGŲ PAREIKALAVIMAS IŠ MATERIALINIŲ VERTYBIŲ SANDĖLIO");

                $event->sheet->getDelegate()
                    ->getStyle('A5:G5')->getAlignment()->setHorizontal('center')
                    ->getActiveSheet()
                    ->mergeCells('A5:G5')
                    ->getCell('A5')
                    ->setValue(date('Y-m-d H:i:s'));





                $skaiciususer = isset(Auth::user()->id) ? Auth::user()->id : Auth::user()->email;

                $SKAICIUS = 1;
                $kopijos = RecordTest::all();
                foreach ($kopijos as $recor) {

                if ($recor->tag == $skaiciususer) {
                    $SKAICIUS++;
                }
            }

                $x = 8; //eiluciu skaicius ismetamu
                for ($x = 8; $x <= $SKAICIUS + 6; $x++) {


                    $event->sheet->getDelegate()->getStyle($cellRange)->getActiveSheet()
                        ->setCellValue(
                            'G'. $x,
                            '=SUM(E'.$x .'*F'. $x .')'
                        );

                }









                     $TKR =  $SKAICIUS + 8;
                $TKR1 = $SKAICIUS + 9;
                $TKR2 = $SKAICIUS + 6;
                $event->sheet->getDelegate()->getStyle($cellRange)->getActiveSheet()->insertNewRowBefore($SKAICIUS + 8, 1);

                $event->sheet->getDelegate()
                    ->getStyle('A' . $TKR . ':B' . $TKR )->getAlignment()->setHorizontal('left')
                    ->getActiveSheet()
                    ->mergeCells('A' . $TKR . ':B' . $TKR )
                    ->getCell('A' . $TKR)
                    ->setValue("SUTINKU:");


                $event->sheet->getDelegate()
                    ->getStyle('D' . $TKR . ':F' . $TKR )->getAlignment()->setHorizontal('right')
                    ->getActiveSheet()
                    ->getCell('D' . $TKR)
                    ->setValue("Gavėjas:");

                      $event->sheet->getDelegate()
                          ->getStyle('E' . $TKR . ':F' . $TKR )->getAlignment()->setHorizontal('left')
                          ->getActiveSheet()
                          ->mergeCells('E' . $TKR . ':F' . $TKR )
                    ->getCell ('E' . $TKR)
                    ->setValue(  isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email );

                $event->sheet->getDelegate()
                    ->getStyle('A' . $TKR1 . ':B' . $TKR1 )->getAlignment()->setHorizontal('center')
                    ->getActiveSheet()
                    ->mergeCells('A' . $TKR1 . ':B' . $TKR1 )
                    ->getCell('A' . $TKR1)
                    ->setValue("Inžinerinio technikos departamento vadovas");


                $event->sheet->getDelegate()->getStyle('A7:G' .  $TKR2)
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                $event->sheet->getDelegate()->getStyle($cellRange)->getActiveSheet()->getPageSetup()
                    ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->getDelegate()->getStyle($cellRange)->getActiveSheet()->getPageSetup()
                    ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
                $event->sheet->getDelegate()->getPageMargins()->setTop(1);
                $event->sheet->getDelegate()->getPageMargins()->setRight(0.5);
                $event->sheet->getDelegate()->getPageMargins()->setLeft(0.5);
                $event->sheet->getDelegate()->getPageMargins()->setBottom(1);


                $event->sheet->getDelegate()->getStyle('A7:A'.$x)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('C7:G7')
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY);

                $event->sheet->getDelegate()->getStyle('C7:G'.$x)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('A7:G7')->getFont()
                    ->setBold(true);

                $event->sheet->getDelegate()->getStyle('A'.$TKR.':F'.$TKR)->getFont()
                    ->setBold(true);
                $event->sheet->getDelegate()->getStyle('A1:G6')->getFont()
                    ->setBold(true);




                $event->sheet->getDelegate()->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(80);
                $event->sheet->getDelegate()->getColumnDimension('E')->setAutoSize(true);;
                $event->sheet->getDelegate()->getColumnDimension('F')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('G')->setAutoSize(true);


            },
        ];

    }


 public function map($recordstest): array
    {
        return [

            $recordstest->Produkto_kodas,
            $recordstest->produktas,
            $recordstest->matas,
            $recordstest->kiekis,
            $recordstest->aprasymas,
        ];
    }

}
/*   public function collection()
   {
       $skaiciususer = isset(Auth::user()->id) ? Auth::user()->id : Auth::user()->email;
       return DB::table('recordstest')->select('produktas','Produkto_kodas', 'matas', 'kiekis', 'aprasymas')->get();


   } */
?>