<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportExcel implements FromCollection
{
    /**
     * @return array
     */
    public function collection()
    {
        $headers = [
            'id',
            'cin',
            'cnss',
            'email',
            'name',
            'lastname',
            'role',
            'birth date',
            'hiring date',
            'gendar',
            'phone',
            'adresse',
            'salary',
            'balance',
            'experience level',
            'family status ',
            'nationality',
            'position',
            'contract',
            'Is Enable',
        ];

        // Fetch users and convert to a collection
        $data = User::query()
            ->with(['position', 'contracts', 'experienceLevel'])
            ->get()
            ->map(function ($user) {
                return [
                    $user->id,
                    $user->cin,
                    $user->cnss,
                    $user->email,
                    $user->name,
                    $user->lastname,
                    $user->role,
                    $user->birth_date,
                    $user->hiring_date,
                    $user->sexe,
                    $user->phone,
                    $user->adresse,
                    $user->salary,
                    $user->balance,
                    $user->experienceLevel['label'] ?? null,
                    $user->familyStatus['label'] ?? null,
                    $user->nationality['label'] ?? null,
                    $user->position['label'] ?? null,
                    $user->contracts['label'] ?? null,
                    $user->enable_status ? 'Yes' : 'No',
                ];
            });

        // Convert headers and data into a single collection;
        $collection = collect([$headers]);
        return $collection->concat($data);
    }
}
