<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\BoAccount;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class BoImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $collection = $collection->slice(2);

        foreach ($collection as $row) {
            $boId = $row[1];
            $email = Str::lower($row[8]);

            $boAccountExists = BoAccount::where('bo_id', $boId)->exists();

            if (!$boAccountExists) {
                BoAccount::create([
                    'bo_id'           => $boId,
                    'name'            => $row[2],
                    'ac_type'         => $row[3],
                    'father_name'     => $row[4],
                    'spouse_name'     => $row[4],
                    'mother_name'     => $row[5],
                    'address'         => $row[6],
                    'cell_no'         => $row[7],
                    'email'           => $email,
                    'bank_account_no' => $row[10],
                    'bank_name'       => $row[11],
                    'branch_name'     => $row[12],
                    'trader_code'     => $row[13],
                ]);
            }

            $userExists = User::where('trading_code', $boId)->exists();

            if (!$userExists) {
                $baseEmail = Str::lower($row[8]);
                $uniqueEmail = $baseEmail;
                $i = 1;
                while (User::where('email', $uniqueEmail)->exists()) {
                    $uniqueEmail = $baseEmail . $i;
                    $i++;
                }

                User::create([
                    'name'            => $row[2],
                    'profile_image'   => 'placeholder-profile.jpg',
                    'father_name'     => $row[4],
                    'spouse_name'     => $row[4],
                    'mother_name'     => $row[5],
                    'email'           => $uniqueEmail,
                    'mobile'          => $row[7],
                    'whatsapp'        => $row[7],
                    'address'         => $row[6],
                    'trading_code'    => $row[1],
                    'bank_name'       => $row[11],
                    'branch_name'     => $row[12],
                    'routing_number'  => NULL,
                    'bank_account_no' => $row[10],
                    'role'            => 'user',
                    'password'        => Hash::make('123456'),
                    'status'          => 'deactive',
                    'created_at'      => Carbon::now(),
                ]);
            }
        }
    }
}
