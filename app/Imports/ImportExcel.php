<?php

namespace App\Imports;

use App\Models\Contracts;
use App\Models\FamilyStatus;
use App\Models\Nationality;
use App\Models\Position;
use App\Models\User;
use App\Notifications\UserCreated;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportExcel implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $value) {
            // create user
            User::query()->firstOrCreate([
                'cin' => $value[1],
                'cnss' => $value[2],
                'email' => $value[3],
                'name' => $value[4],
                'lastname' => $value[5],
                'role' => $value[6],
                'birth_date' => $value[7],
                'password' => bcrypt('password12345'),
                'sexe' => $value[8],
                'phone' => $value[9],
                'addresse' => $value[10],
                'salary' => $value[11],
                'balance' => $value[12],
                'family_status_id' => FamilyStatus::query()
                    ->where('label', $value[13])
                    ->first()->id,
                'position_id' => Position::query()
                    ->where('label', $value[14])
                    ->first()->id,
                'nationality_id' => Nationality::query()
                    ->where('label', $value[15])
                    ->first()->id,
                'contract_id' => Contracts::query()
                    ->where('label', $value[16])
                    ->first()->id,
                'enable_status' => $value[17],
            ]);
            // Notify the user that has new account at the platform
            $user = User::find($value[0]);
            $user->notify(new UserCreated($user));
        }
    }
}
