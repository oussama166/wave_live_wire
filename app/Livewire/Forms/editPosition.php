<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class editPosition extends Form
{
    #[Validate("required")]
    public $position;
    #[Validate("required|numeric")]
    public $satrtDate;
    #[Validate("required|string|max:255")]
    public $description;


}
