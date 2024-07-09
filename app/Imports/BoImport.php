<?php

namespace App\Imports;

use App\Models\BoAccount;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BoImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $collection = $collection->slice(5);

        foreach ($collection as $row)
        {
            BoAccount::create([
                'bo_id' => $row[1],
                'name' => $row[2],
                'ac_type' => $row[3],
            ]);
        }
    }
}
