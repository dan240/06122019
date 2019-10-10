<?php

namespace App\Exports;

use App\UserInvestor;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvestorExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserInvestor::all();
    }
}
