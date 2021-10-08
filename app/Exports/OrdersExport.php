<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDate;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class OrdersExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, WithEvents
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
                $event->sheet->getStyle('A1:G1')->applyFromArray($styleArray);
            }

        ];

    }


    public function query()
    {
        return Order::query();
    }

    /**
    * @var Order $order
    */
    public function map($order): array
    {
        return [
            $order->id,
            $order->items,
            $order->descriptions,
            $order->quantity,
            $order->units.' tonnes',
            SharedDate::dateTimeToExcel($order->created_at),
            SharedDate::dateTimeToExcel($order->updated_at),
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
            'Created At',
            'Updated At'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,

        ];
    }
}
