<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\BoAccount;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BoImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $collection = $collection->slice(2);

        foreach ($collection as $row)
        {
            $dateString = $row[9];
            BoAccount::create([
                'bo_id'           => $row[1],
                'name'            => $row[2],
                'ac_type'         => $row[3],
                'father_name'     => $row[4],
                'spouse_name'     => $row[4],
                'mother_name'     => $row[5],
                'address'         => $row[6],
                'cell_no'         => $row[7],
                'email'           => Str::lower($row[8]),
                // 'ac_open_date'    => Carbon::createFromFormat('d-M-Y', $dateString),
                'bank_account_no' => $row[10],
                'bank_name'       => $row[11],
                'branch_name'     => $row[12],
                'trader_code'     => $row[13],
            ]);
        }
    }
}
