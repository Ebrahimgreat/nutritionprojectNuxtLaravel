<?php

namespace App\Livewire;

use DateTime;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Livewire\Component;

class CalenderComponent extends Component
{

    public function next($dateTime)
{
    $dateTime->modify('+1 month');

}






}
