<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class editSalary extends Form
{
    #[Validate("required|numeric")]
    public $newSalary;
    #[Validate("required|numeric")]
    public $startDate;
    #[Validate("required|string|max:255")]
    public $description;

    public function submitChnangeSalary(): void
    {
        dd($this->all());
    }

}
