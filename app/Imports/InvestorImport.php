<?php

namespace App\Imports;

use App\UserInvestor;
use Maatwebsite\Excel\Concerns\ToModel;

class InvestorImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UserInvestor([
            //
        ]);
    }
}
