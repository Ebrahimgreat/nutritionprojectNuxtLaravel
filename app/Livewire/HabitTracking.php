<?php

namespace App\Livewire;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Filament\Forms\Components\Tabs;
use Livewire\Form;

class HabitTracking extends component
{
    public $tab1,$tab2,$tab3;

    public function mount()
    {
        $this->tab1=true;
        $this->tab2=false;
        $this->tab3=false;

    }




    public function render()
    {

        return view('livewire.habits',
        ['tab1'=>$this->tab1,
            'tab2'=>$this->tab2,
            'tab3'=>$this->tab3,]);
    }

    public function calculateStreak($date)
    {
        if($date!=date(today()))
        {

        }

    }



}
