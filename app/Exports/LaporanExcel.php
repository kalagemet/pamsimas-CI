<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use App\ModelUser;
use App\AdminModel;
use App\ModelKeuangan;
use Indonesia;
use Auth;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
// ​code
class LaporanExcel implements FromView, ShouldAutoSize, WithEvents
{
    use Exportable;

    public function __construct(int $tahun)
    {
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        $tahun = $this->tahun;
        $data = ModelKeuangan::where('id_cabang', Auth::user()->id)->whereYear('created_at',$tahun)->get();
        if(count($data)==0){
            return redirect()->back()->with('error','Laporan tidak tersedia');
        }
        $user = ModelUser::find(Auth::user()->id);
        $desa = AdminModel::find(Auth::user()->id_admin)->desa;
        $user->lokasi = Indonesia::findVillage($desa)->name;
        $user->kec = Indonesia::findDistrict(Indonesia::findVillage($desa)->district_id)->name;
        $user->kab = Indonesia::findCity(Indonesia::findDistrict(Indonesia::findVillage($desa)->district_id)->city_id)->name;
        return view('document.excel', [
            'user' => $user,
            'data' => $data,
            'tgl'  => \Carbon\Carbon::now('Asia/Jakarta')
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                // Merging columns and row
                $event->sheet->mergeCells('A1:G1');
                $event->sheet->mergeCells('A2:G2');
                $event->sheet->mergeCells('A3:G3');
                // set aligmen
                $event->sheet->getDelegate()->getStyle('A1:G4')->applyFromArray( [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $event->sheet->getDelegate()->getStyle('A1:G1')->getFont()->setSize(14);
                // header
                $cellRange = 'A4:G4'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray(
                    [
                        'font' => array(
                            'color' => ['argb' => 'FFFFFF'],
                        )
                    ]
                );
                $event->sheet->getStyle($cellRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                //total
                $event->sheet->mergeCells('A'.($event->sheet->getHighestRow()-2).':F'.($event->sheet->getHighestRow()-2));
                $event->sheet->mergeCells('A'.($event->sheet->getHighestRow()-1).':F'.($event->sheet->getHighestRow()-1));
                $event->sheet->mergeCells('A'.$event->sheet->getHighestRow().':F'.$event->sheet->getHighestRow());
                // footer
                $cellRange = 'A'.($event->sheet->getHighestRow()-2).':G'.$event->sheet->getHighestRow(); // All footer
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray(
                    [
                        'font' => array(
                            'color' => ['argb' => 'FFFFFF'],
                        )
                    ]
                );
                $event->sheet->getStyle($cellRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('323232');
                $event->sheet->getDelegate()->getStyle('A'.($event->sheet->getHighestRow()-2).':F'.$event->sheet->getHighestRow())->applyFromArray( [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                //set total nilai
                $event->sheet->setCellValue('G'.($event->sheet->getHighestRow()-2), '=SUM(D5:D'.($event->sheet->getHighestRow()-3).')');
                $event->sheet->setCellValue('G'.($event->sheet->getHighestRow()-1), '=SUM(C5:D'.($event->sheet->getHighestRow()-3).')');
                $event->sheet->setCellValue('G'.$event->sheet->getHighestRow(), '=(E'.($event->sheet->getHighestRow()-3).')');

                //border
                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ];
                $event->sheet->getStyle(
                    'A4:' . 
                    $event->sheet->getHighestColumn() . 
                    $event->sheet->getHighestRow()
                )->applyFromArray($styleArray);
                
            },
        ];
    }
}