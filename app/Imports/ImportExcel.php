<?php

namespace App\Imports;

use App\Models\Contracts;
use App\Models\ExperienceLevels;
use App\Models\FamilyStatus;
use App\Models\Nationality;
use App\Models\Position;
use App\Models\User;
use App\Notifications\UserCreated;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportExcel implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // cin	cnss	email	name	lastname	role	birth date	hiring date	gendar	phone	adresse	salary	balance	experience level	family status 	nationality	position	contract	Is Enable

        foreach ($collection as $value) {
            // dd($value);
            // create user
            User::query()->firstOrCreate([
                'cin' => $value['cin'],
                'cnss' => $value['cnss'],
                'email' => $value['email'],
                'name' => $value['name'],
                'lastname' => $value['lastname'],
                'role' => $value['role'],
                'birth_date' => $value['birth_date'],
                'password' => bcrypt('password12345'),
                'hiring_date' => $value['hiring_date'],
                'sexe' => $value['gendar'],
                'phone' => $value['phone'],
                'adresse' => $value['adresse'],
                'salary' => $value['salary'],
                'balance' => $value['balance'],
                'experience_level_id' => ExperienceLevels::query()
                    ->where('label', $value['experience_level'])
                    ->pluck('id')
                    ->first(),
                'family_status_id' => FamilyStatus::query()
                    ->where('label', $value['family_status'])
                    ->pluck('id')
                    ->first(),
                'nationality_id' => Nationality::query()
                    ->where('label', $value['nationality'])
                    ->pluck('id')
                    ->first(),
                'position_id' => Position::query()
                    ->where('label', $value['position'])
                    ->pluck('id')
                    ->first(),
                'contract_id' => Contracts::query()
                    ->where('label', $value['contract'])
                    ->pluck('id')
                    ->first(),
                'enable_status' => $value['is_enable'] ? 1 : 0,
            ]);
            // Notify the user that has new account at the platform
            $user = User::find($value['cin']);
            $user->notify(new UserCreated($user));
        }
    }
}
