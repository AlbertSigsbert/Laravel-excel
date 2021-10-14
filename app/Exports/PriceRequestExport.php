<?php

namespace App\Exports;

use App\PriceRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDate;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PriceRequestExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, WithEvents
{
    use Exportable;

     /**
     * @return array
     */
    public function registerEvents(): array
    {
        $styleArray = [
            'font'=>[
                'bold' => true
            ]
        ];

        return [
            // Handle by a closure.
            AfterSheet::class => function(AfterSheet $event) use($styleArray)
            {
                //Aplying bold to headings
                $event->sheet->getStyle('A1:I1')->applyFromArray($styleArray);

                //Aplying thick border to headings
                $event->sheet->getStyle('A1:I1')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ]
                   ]);

                //Set column width to auto-size except for col C
                $columns = ['A','B', 'D','E','F','G','H','I'];

                foreach ($columns as $column ) {
                    $event->sheet->getColumnDimension($column)->setAutoSize(true);
                }

                //Set column C width to fixed size
                $event->sheet->getColumnDimension('C')->setWidth(72);

                //Set column C to wrap text
                $event->sheet->getStyle('C2:C'.($event->sheet->getHighestRow()))->getAlignment()->setWrapText(true);



                  //Finding total of cost in col G
                  $event->sheet->setCellValue('G'. ($event->sheet->getHighestRow()+1), '=SUM(G2:G'.$event->sheet->getHighestRow().')');

                 //Display Total strings
                 $event->sheet->setCellValue('B'. ($event->sheet->getHighestRow()), 'TOTAL');

                //  //Bold Total string
                 $event->sheet->getDelegate()->getStyle('B'. ($event->sheet->getHighestRow()))->getFont()->setBold(true);


                // //Bold Total value
                $event->sheet->getDelegate()->getStyle('G'. ($event->sheet->getHighestRow()))->getFont()->setBold(true);

                 //Aplying middle rows
                 $event->sheet->getStyle('A2'.':I'.($event->sheet->getHighestRow()-1))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'd3d3d3'],
                        ],
                    ]
                   ]);
                 //Aplying thick border to last row
                 $event->sheet->getStyle('A'.($event->sheet->getHighestRow()).':I'.($event->sheet->getHighestRow()))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ]
                   ]);








            }

        ];

    }


    public function query()
    {
        return PriceRequest::query();
    }

    /**
    * @var PriceRequest $priceRequest
    */
    public function map($priceRequest): array
    {
        return [
            $priceRequest->id,
            $priceRequest->items,
            $priceRequest->descriptions,
            $priceRequest->quantity,
            $priceRequest->units.' tonnes',
            $priceRequest->price,
            $priceRequest->cost,
            SharedDate::dateTimeToExcel($priceRequest->created_at),
            SharedDate::dateTimeToExcel($priceRequest->updated_at),
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'ItemName',
            'Descriptions',
            'Quantity',
            'Units',
            'Price',
            'Cost',
            'Created At',
            'Updated At'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_NUMBER,
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,

        ];
    }
}
