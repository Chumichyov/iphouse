<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportProducts implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::all([
            "id", "code", "title", "price", "amount"
        ]);
    }

    public function headings(): array
    {
        return ["#", "Артикул", "Название", "Цена", "Количество"];
    }
}
