<?php

namespace App\Livewire;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use App\Models\goals;

class GoalComponent extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [ ];

    public function form(Form $form): Form
    {
        return $form
           ->schema([
               Select::make('Goal')
               ->options($this->getFunctionName())
                   ->required(),




               ])

            ->statePath('data');




    }
    public function getFunctionName():array
    {
       return[
           0=>'Loose weight',
           1=>'Maintain weight',
           2=>'Gain weight',

       ];

    }



    public function render()
    {
        return view('livewire.goal-component',
       );
    }
}
