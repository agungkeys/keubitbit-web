<?php

namespace App\Exports;

use App\Models\Mailist;
use Maatwebsite\Excel\Concerns\FromCollection;

class MailistsExport implements FromCollection
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return ["ID", "Email"];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Mailist::select('id', 'email')->get();
    }
}
